<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\DataTables\SettingsDataTable;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function  login(){
        return view('login');
    }
    public function loginCheck(Request $request){
        $validator = Validator::make($request->all(), [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['status' => false, 'message' => $error]);
        }
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            $response['status'] = true;
            $response['message'] = 'Login Successfully';
            return response()->json($response);
        }else{
            $response['status'] = false;
            $response['message'] = 'Something Wrong';
            return response()->json($response);
        }
     }
     public function settings(SettingsDataTable $dataTable){
        $data['adminData'] = Admin::select('*')->first();
        return view('settings.settings',$data);
     }
     
     public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'newpwd' => 'required|min:6|required_with:conpwd|same:conpwd',
            'conpwd' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['status' => false, 'message' => $error]);
        }

        $auth = Auth::guard('admin')->user();
        if (!Hash::check($request->get('oldpwd'), $auth->password))
        {
            $response['status'] = false;
            $response['message'] = 'Old Password is Invalid';
            return response()->json($response);
        }
        $user =  Admin::find($auth->id);
        $user->password =  bcrypt($request->newpwd);
        $user->save();
        $response['status'] = true;
        $response['message'] = 'Password Changed Successfully';
            return response()->json($response);

     }
     public function submitForgetPasswordForm(Request $request)
     {
         $request->validate([
             'email' => 'required|email|exists:admin',
         ]);

         $token = Str::random(64);
         $user1 = Admin::select('*')
         ->where('email',$request->email)
         ->update([
                'token' => $token,
             ]);
         Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
             $message->to($request->email);
             $message->subject('Reset Password');
         });

         return back()->with('message', 'We have e-mailed your password reset link!');
     }

     public function showResetPasswordForm($token) {
        return view('forgetPasswordLink', ['token' => $token]);
     }

     public function submitResetPasswordForm(Request $request)
      {
          $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:admin',
                'password' => 'min:6|required_with:conpassword|same:conpassword',
                'conpassword' => 'required'
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return response()->json(['status' => false, 'message' => $error]);
            }

          $updatePassword = Admin::select('*')->where(['email' => $request->email,'token' => $request->token])
                              ->first();
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }

          $user = Admin::where('email', $request->email)
                      ->update(['password' => bcrypt($request->password)]);
            Auth::guard('admin')->logout();
          $request->session()->flush();
        if($user){
            $response['status'] = true;
            $response['message'] = 'Your password has been changed!';
            return response()->json($response);
        }else{
            $response['status'] = false;
            $response['message'] = 'Something Wrong';
            return response()->json($response);
        }
      }
      public function logout(Request $request)
      {
          Auth::guard('admin')->logout();
          $request->session()->flush();
          return redirect('/');
      }
}
