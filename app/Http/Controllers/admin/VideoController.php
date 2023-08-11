<?php

namespace App\Http\Controllers\admin;

use App\DataTables\ReportedVideoDataTable;
use App\Http\Controllers\Controller;
use App\Models\ReportedVideo;
use App\Models\Video;
use Illuminate\Http\Request;

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
}
