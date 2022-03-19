<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\settings_model;

class settings_controller extends Controller
{
    public function get_settings()
    {
        $settings = settings_model::where('id',1)->get();

        return response()->json($settings,200);
    }

    public function save_settings(Request $request)
    {
        settings_model::where('id',1)->update([
            'site_name'=>$request->site_name,
            'current_dollar'=>$request->current_dollar,
            'dark'=>$request->dark,
        ]);
        return response()->json(['msg'=>'تم حفظ الاعدادات'],200);  
    }
}
