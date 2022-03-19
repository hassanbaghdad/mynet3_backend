<?php

namespace App\Http\Controllers\Backups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backups_model;
use Spatie\Multitenancy\Models\Tenant;
use Illuminate\Support\Facades\File; 

class backups_controller extends Controller
{

    public function get_backups()
    {
        $backups = backups_model::all();
        return response()->json($backups,200);
    }

    public function create_backup()
    {
        $backups = backups_model::orderBy('back_id','ASC')->get();
        if(count($backups) > 4)
        {
            if (file_exists(public_path('app/backups/'.Tenant::current()->name.'/'.$backups[0]->back_name))) {
                //unlike(public_path('app/backups/'.Tenant::current()->name.'/'.$backups[0]->back_name));
                File::delete(public_path('app/backups/'.Tenant::current()->name.'/'.$backups[0]->back_name));
            }
            backups_model::where('back_id',$backups[0]->back_id)->delete();
        }
        \Illuminate\Support\Facades\Artisan::call('backup:database');
        return response()->json(['msg'=>'تم انشاء نسخة احتياطية بنجاح'],200);
    }
    public function delete_backup(Request $request)
    {
        backups_model::where('back_id',$request->back_id)->delete();
        if (file_exists(public_path('app/backups/'.Tenant::current()->name.'/'.$request->back_name))) {
            //unlike(public_path('app/backups/'.Tenant::current()->name.'/'.$request->back_name));
            File::delete(public_path('app/backups/'.Tenant::current()->name.'/'.$request->back_name));
            return response()->json(['msg'=>'تم حذف النسخة الاحتياطية بنجاح'],200);
        }
    }
}
