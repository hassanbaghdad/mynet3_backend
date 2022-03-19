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
        $user->user_name = $request->user_name;
        $user->user_pass = Hash::make($request->user_pass);
        $user->user_level = $request->user_level;
        $user->user_type = $request->user_type;
        $user->user_active = 1;
        $user->user_isdel = 0;
        
        if($user->save())
        {
            return response()->json(['msg'=>'تم حفظ المشرف بنجاح'],200);
        }
    }

    public function edit_user(Request $request)
    {
        $users = users_model::where('user_name',$request->user_name)->get();
        if(count($users) >0 && $users[0]->user_id != $request->user_id)
        {
            return response()->json(['msg'=>'عفوا اسم المستخدم موجود بالفعل'],403);
        }

        // if($request->username == auth()->user()->username && count($users) > 0)
        // {
            
            
            if($request->user_pass !="" && $request->user_pass != null)
            {
                users_model::where('user_id',$request->user_id)->update([
                    'Fullname'=>$request->Fullname,
                    'user_name'=>$request->user_name,
                    'user_pass'=>Hash::make($request->user_pass),
                    'user_level'=>$request->user_level,
                    'user_type'=>$request->user_type,
                ]);
                return response()->json(['msg'=>'تم تعديل المشرف بنجاح'],200);

            }else{
                users_model::where('user_id',$request->user_id)->update([
                    'Fullname'=>$request->Fullname,
                    'user_name'=>$request->user_name,
                    'user_level'=>$request->user_level,
                    'user_type'=>$request->user_type,
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
