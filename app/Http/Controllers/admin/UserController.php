<?php

namespace App\Http\Controllers\admin;

use App\DataTables\ReportedUserDataTable;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Js;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function  userList(UsersDataTable $dataTable){
        return $dataTable->render('user.user-list');
    }
    public function userCreate(Request $request){
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'gender'   => 'required',
            'language'   => 'required',
            'mobileNumber'   => 'required|max:10|min:6',
            'emailId'   => 'required|email|unique:tbl_user',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['status' => false, 'message' => $error]);
        }
        $image = time().'.'.$request->photo->extension();

        $request->photo->move(public_path('images'), $image);
        $imageName = public_path('images').$image;

        $user = $request->all();
        $user['name'] = $request->name;
        $user['password'] = bcrypt($request->password);
        $user['emailId'] = $request->emailId;
        $user['mobileNumber'] = $request->mobileNumber;
        $user['gender'] = $request->gender;
        $user['language'] = implode(',', $request->language);
        $user['followers'] = 0;
        $user['flowing'] = 0;
        $user['postbyuser'] = 0;
        $user['profilePicLink'] = $imageName;

        $data = new User();
        $data->fill($user)->save();

        if ($data) {
            $response['status'] = true;
            $response['message'] = 'User added Successfully';
            return response()->json($response);
        }else{
            $response['status'] = false;
            $response['message'] = 'Something Wrong';
            return response()->json($response);
        }
     }
     public function userEdit(Request $request){

        $userData = User::select('*')->where('userId',$request->id)->first();

        $language = explode(",",$userData->language);
        if ($userData) {
            $response['status'] = true;
            $response['data'] = $userData;
            $response['language'] = $language;
            return response()->json($response);
        }else{
            $response['status'] = false;
            return response()->json($response);
        }
     }

     public function userUpdate(Request $request){

        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'gender'   => 'required',
            'language'   => 'required',
            'mobileNumber'   => 'required|max:10|min:6',
            'emailId'   => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['status' => false, 'message' => $error]);
        }

        $user = User::where('userId',$request->userId)->first();
        if($request->has('photo')){
            $image = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images'), $image);
            $imageName = asset('images/' . $image);
            File::delete($user->profilePicLink);
        } else {
            $imageName = $user->profilePicLink;
        }
        $user1 = User::select('*')
        ->where('userId',$request->userId)
        ->update([
               'name' => $request->name,
                'emailId' => $request->emailId,
                'mobileNumber' => $request->mobileNumber,
                'gender' => $request->gender,
                'language' => implode(',',$request->language),
                'followers' => $request->followers,
                'flowing' => $request->flowing ,
                'postbyuser' => $request->postbyuser ,
                'profilePicLink' => $imageName
            ]);

        if ($user1) {
            $response['status'] = true;
            $response['message'] = 'User Updated Successfully';
            return response()->json($response);
        }else{
            $response['status'] = false;
            $response['message'] = 'Something Wrong';
            return response()->json($response);
        }
    }
    public function userStatus(Request $request)
    {
        $user = User::where('userId',$request->user_id)->update([ 'status' => $request->status]);

        if($user){
            return response()->json(['success'=>'Status change successfully.']);
        }else{
            return response()->json(['success'=>'Something Wrong.']);
        }
    }
    public function userDelete(Request $request) {
        $user = User::select('*')->where('userId',$request->id);
        if (!empty($user->profilePicLink) && File::exists($user->profilePicLink)) {
            File::delete($user->profilePicLink);
        }
        $user->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
    public function reportedUser(ReportedUserDataTable $dataTable ){
        return $dataTable->render('user.report-user');
    }
}
