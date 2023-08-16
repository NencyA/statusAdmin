<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Hashtag;
use Illuminate\Http\Request;
use App\DataTables\HashtadCategoryDataTable;
use App\Models\HastagCategory;
use App\Models\UploadVideo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function category(HashtadCategoryDataTable $dataTable)
    {
        $tothashTags = Hashtag::whereNotNull('hashtag')
            ->where('hashtag', '<>', '')
            ->pluck('hashtag')
            ->toArray();

        $UploadVideoHashtag = UploadVideo::all('hashtag')->toArray();

        $hashtags = [];

        foreach ($UploadVideoHashtag as $record) {
            if (!empty($record['hashtag'])) {
                $hashtagsList = explode(' ', $record['hashtag']);
                foreach ($hashtagsList as $hashtag) {
                    $cleanHashtag = trim($hashtag, '# '); // Remove leading '#' and spaces
                    if (!empty($cleanHashtag)) {
                        $hashtags[] = '#' . $cleanHashtag; // Add the '#' back
                    }
                }
            }
        }

        $uniqueHashtags = array_unique(array_merge($hashtags, $tothashTags));
        return $dataTable->render('category.category', compact('uniqueHashtags'));
    }

    public function categoryEdit(Request $request)
    {
        $tothashTags = Hashtag::whereNotNull('hashtag')
            ->where('hashtag', '<>', '')
            ->pluck('hashtag')
            ->toArray();

        $UploadVideoHashtag = UploadVideo::all('hashtag')->toArray();

        $hashtags = [];

        foreach ($UploadVideoHashtag as $record) {
            if (!empty($record['hashtag'])) {
                $hashtagsList = explode(' ', $record['hashtag']);
                foreach ($hashtagsList as $hashtag) {
                    $cleanHashtag = trim($hashtag, '# '); // Remove leading '#' and spaces
                    if (!empty($cleanHashtag)) {
                        $hashtags[] = '#' . $cleanHashtag; // Add the '#' back
                    }
                }
            }
        }

        $allHashtags = array_merge($hashtags, $tothashTags);
        $uniqueHashtags = array_values(array_unique($allHashtags));

        $category = HastagCategory::find($request->id);
        $hashtag = explode(' ', $category->hashtag);

        if ($category) {
            $response['status'] = true;
            $response['data'] = $category;
            $response['hashTags'] = $uniqueHashtags;
            $response['selectedhashTags'] = $hashtag;
            return response()->json($response);
        } else {
            $response['status'] = false;
            return response()->json($response);
        }
    }

    public function categoryupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categoryU' => 'required',
            'hashTagU' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['status' => false, 'message' => $error]);
        }

        $updateData = [
            'name' => $request->categoryU,
        ];

        if ($request->hashTagU) {
            $allhashTag = implode(' ', $request->hashTagU);
            $updateData['hashtag'] = $allhashTag;
        }
        HastagCategory::where('id', $request->categoryId)->update($updateData);
        $response = [];
        $response['status'] = true;
        $response['message'] = "Category updated successfully";
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'hashTag' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['status' => false, 'message' => $error]);
        }

        $checkcat = HastagCategory::where('name', $request->category)->first();
        if ($checkcat) {
            $response['status'] = false;
            $response['message'] = "This category is already used";
            return response()->json($response);
        }

        foreach ($request->hashTag as $hashTag) {
            Hashtag::updateOrCreate(
                ['hashtag' => $hashTag],
                ['hashcount' => DB::raw('hashcount + 1')]
            );
        }

        $allhashTag = implode(' ', $request->hashTag);
        $category = $request->category;

        HastagCategory::create([
            'name' =>  $category,
            'hashtag' => $allhashTag,
        ]);

        $response = [];
        $response['status'] = true;
        $response['message'] = "Category added successfully";
        return response()->json($response);
    }

    public function destroy($id)
    {
        $video = HastagCategory::find($id);
        if ($video) {
            $video->delete();
        }
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
