<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Render\render_controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['username','password']);
        if (!Auth::attempt($credentials)) {
            
            return response()->json(['msg'=>'اسم المستخدم او كلمة المرور غير صحيحة'],401);
        }
        $token = auth()->user()->createToken('API Token')->plainTextToken;
        $user = auth()->user();
        $user["token"] = $token;

        $render = new render_controller();
        return $render->render();
        //return response()->json($user,200);


    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json(['msg'=>'تم تسجيل الخروج بنجاح'],200);


    }

    
}
