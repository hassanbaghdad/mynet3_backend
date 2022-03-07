<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\users_model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class users_controller extends Controller
{
    public function get_users()
    {
        $users = users_model::where('user_isdel',0)->get();

        return response()->json($users,200);
    }

    public function add_user(Request $request)
    {
        $user = new users_model();

        $user->Fullname = $request->Fullname;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->user_level = $request->user_level;
        $user->user_active = 1;
        
        $user->user_isdel = 0;
        
        if($user->save())
        {
            return response()->json(['msg'=>'تم حفظ المشرف بنجاح'],200);
        }
    }

    public function edit_user(Request $request)
    {
        $users = users_model::where('username',$request->username)->get();
        if(count($users) >0 && $users[0]->user_id != $request->user_id)
        {
            return response()->json(['msg'=>'عفوا اسم المستخدم موجود بالفعل'],403);
        }

        // if($request->username == auth()->user()->username && count($users) > 0)
        // {
            
            
            if($request->password !="" && $request->password != null)
            {
                users_model::where('user_id',$request->user_id)->update([
                    'Fullname'=>$request->Fullname,
                    'username'=>$request->username,
                    'password'=>Hash::make($request->password),
                    'user_level'=>$request->user_level,
                    
                ]);
                return response()->json(['msg'=>'تم تعديل المشرف بنجاح'],200);

            }else{
                users_model::where('user_id',$request->user_id)->update([
                    'Fullname'=>$request->Fullname,
                    'username'=>$request->username,
                    'user_level'=>$request->user_level,
                    
                ]);
                return response()->json(['msg'=>'تم تعديل المشرف بنجاح'],200);
            }
       // }

        
        
        
    }

    public function delete_user(Request $request)
    {
        users_model::where('user_id',$request->user_id)->update([
            'user_isdel'=>1
        ]);
        return response()->json(['msg'=>'تم حذف المشرف بنجاح'],200);
    }
    
}
