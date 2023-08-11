<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboard() {
        $data['users'] = User::count();
        $data['video'] = Video::count();
        return view('dashboard',$data);
    }
}
