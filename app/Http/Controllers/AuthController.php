<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Render\render_controller;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function username()
    {
        return 'user_name';
    }
    public function login2(Request $request)
    {
        //$credentials = $request->only(['username','password']);
        //$request->merge(['password' => $request->user_pass]);

        $validator = Validator::make($request->all(), [
            $this->username() => 'required',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!Auth::attempt($validator->validated())) {
            
            return response()->json(['msg'=>'اسم المستخدم او كلمة المرور غير صحيحة'],401);
            //return response()->json($validator->validated(),401);

        }
        $u = User::where('user_name',$request->user_name)->first();
        
        if($u->user_isdel == 1 && $u->user_active == 0)
        {
            return response()->json(['msg'=>'عفوا لايمنك الدخول بهذا الحساب'],401);
        }
        $token = auth()->user()->createToken('API Token')->plainTextToken;
        $user = auth()->user();
        $user["token"] = $token;

        $render = new render_controller();
        return $render->render();
        //return response()->json($user,200);


    }
    public function login(Request $request)
    {
    
        
        $validator = Validator::make($request->all(), [
            $this->username() => 'required',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!Auth::attempt($validator->validated())) {
            
            return response()->json(['msg'=>'اسم المستخدم او كلمة المرور غير صحيحة'],401);
    
        }
        $u = User::where('user_name',$request->user_name)->first();
        
        if($u->user_isdel == 1 && $u->user_active == 0)
        {
            return response()->json(['msg'=>'عفوا لايمنك الدخول بهذا الحساب'],401);
        }
        $token = auth()->user()->createToken('API Token')->plainTextToken;
        $user = auth()->user();
        $user["access_token"] = $token;
        $user["level"] = $user["user_level"];

        return response()->json($user,200);


    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json(['msg'=>'تم تسجيل الخروج بنجاح'],200);


    }

    
}
