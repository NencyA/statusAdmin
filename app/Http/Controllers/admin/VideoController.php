<?php

namespace App\Http\Controllers\admin;

use App\DataTables\ReportedVideoDataTable;
use App\Http\Controllers\Controller;
use App\Models\ReportedVideo;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\DataTables\UserVideoDataTable;
use Illuminate\Support\Facades\Validator;
use App\Models\UploadVideo;
use App\Models\User;
use App\Models\Hashtag;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    public function reportedVideo(ReportedVideoDataTable $dataTable) {
        return $dataTable->render('reportedvideo.reportedvideo');
    }
    public function reportedVideoData(Request $request){
        $data = Video::select('*')->where('id',$request->id)->first();
        if ($data) {
            $response['status'] = true;
            $response['data'] = $data;
            return response()->json($response);
        }else{
            $response['status'] = false;
            return response()->json($response);
        }
    }
    public function userVideo(UserVideoDataTable $dataTable)
    {
        $emailIds = User::pluck('emailId')->toArray();
        $hashTags = Hashtag::whereNotNull('hashtag')
            ->where('hashtag', '<>', '')
            ->pluck('hashtag')
            ->toArray();
        return $dataTable->render('video.video', compact('emailIds', 'hashTags'));
    }

    public function userVideoedit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'videoId' => 'required|integer',
            'emailIdU' => 'required|email',
            'hashTagU' => 'required',
            'videos' => 'nullable|array|min:1',
            'videos.*' => 'file|mimes:mp4',
            'descriptionU' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['status' => false, 'message' => $error]);
        }

        $video = $request->file('videos');

        $updateData = [
            'user_mailid' => $request->emailIdU,
            'description' => $request->descriptionU,
            'language' => $request->languageU,
        ];

        if ($request->hashTagU) {
            $allhashTag = implode(' ', $request->hashTagU);
            $updateData['hashtag'] = $allhashTag;
        }

        if ($video) {
            // $filename = $video->getClientOriginalName();
            // $path = $video->storeAs('public/videos', $filename);
            // $cleanedPath = str_replace('public/videos/', '', $path);

            // $updateData['filename'] = $cleanedPath;
            // $updateData['path'] = $path;
            $updateData['video_file_name'] = $video->getClientOriginalName();
        }
        UploadVideo::where('id', $request->videoId)->update($updateData);
        $response = [];
        $response['status'] = true;
        $response['message'] = "Video updated successfully";
        return response()->json($response);
    }

    public function destroy($id)
    {
        $video = UploadVideo::find($id);
        if ($video) {
            $video->delete();
        }
        return redirect()->back()->with('success', 'Video deleted successfully.');
    }
    public function videoEdit(Request $request)
    {
        $video = UploadVideo::find($request->id);
        $hashTag = Hashtag::whereNotNull('hashtag')
            ->where('hashtag', '<>', '')
            ->pluck('hashtag')
            ->toArray();
        $selectedhashTag = explode(" ", $video->hashtag);
        if ($video) {
            $response['status'] = true;
            $response['data'] = $video;
            $response['hashTags'] = $hashTag;
            $response['selectedhashTags'] = $selectedhashTag;
            return response()->json($response);
        } else {
            $response['status'] = false;
            return response()->json($response);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emailId' => 'required|email',
            'hashTag' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['status' => false, 'message' => $error]);
        }

        foreach ($request->hashTag as $hashTag) {
            Hashtag::updateOrCreate(
                ['hashtag' => $hashTag],
                ['hashcount' => DB::raw('hashcount + 1')]
            );
        }

        $allhashTag = implode(' ', $request->hashTag);
        $description = $request->description;
        $language = $request->input('language');

        $emailId = $request->input('emailId');
        $videos = $request->file('videos');

        foreach ($videos as $video) {
            $filename = $video->getClientOriginalName();
            $video->storeAs($filename);
            // $cleanedPath = str_replace('public/videos/', '', $path);

            UploadVideo::create([
                'name' => 'admin',
                'profilePicLink' => 'https://techgujju.online/web-wp/image/image_2022-10-11-06-31-02_63450da6ad038.jpg',
                'hashtag' => $allhashTag,
                'description' => $description,
                'video_file_name' => $video->getClientOriginalName(),
                'language' => $language,
                'user_mailid' => $emailId,
            ]);
        }

        $response['status'] = true;
        $response['message'] = "Video added successfully";
        return response()->json($response);
    }
}
