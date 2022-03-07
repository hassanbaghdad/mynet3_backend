<?php

namespace App\Http\Controllers\Towers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\towers_model;
use DB;

class towers_controller extends Controller
{
    public function get_towers()
    {
        //$towers = towers_model::where('brig_isdel',0)->get();
        $towers = DB::select("SELECT brig_id,brig.brig_name,brig_main,brig_month,brig_type,brig_user,brig_pass,brig_passOnline,brig_month,brig_address,brig_note, COUNT(cost_id) AS count_customers FROM brig LEFT JOIN costumer ON brig.brig_id = costumer.cost_bregFk WHERE brig.brig_isdel=0 GROUP BY brig_id ORDER BY count_customers DESC");
        return response()->json($towers,200);
    }

    public function add_tower(Request $request)
    {
        $tower = new towers_model();

        $tower->brig_name = $request->brig_name;
        $tower->brig_main = $request->brig_main;
        $tower->brig_user = $request->brig_user;
        $tower->brig_pass = $request->brig_pass;
        $tower->brig_passOnline = $request->brig_passOnline;
        $tower->brig_type = $request->brig_type;
        $tower->brig_month = $request->brig_month;
        $tower->brig_address = $request->brig_address;
        $tower->brig_note = $request->brig_note;

        if($tower->save())
        {
            return response()->json(['msg'=>'تم حفظ البرج بنجاح'],200);

        }
        
    }
    public function edit_tower(Request $request)
    {
        towers_model::where('brig_id',$request->brig_id)->update([
            'brig_name' => $request->brig_name,
            'brig_main' => $request->brig_main,
            'brig_user' => $request->brig_user,
            'brig_pass' => $request->brig_pass,
            'brig_passOnline' => $request->brig_passOnline,
            'brig_type' => $request->brig_type,
            'brig_month' => $request->brig_month,
            'brig_address' => $request->brig_address,
            'brig_note' => $request->brig_note

        ]);

        return response()->json(['msg'=>'تم تعديل البرج بنجاح'],200);

    }
    public function delete_tower(Request $request)
    {
        towers_model::where('brig_id',$request->brig_id)->update([
            'brig_isdel'=>1
        ]);

        return response()->json(['msg'=>'تم حذف البرج بنجاح'],200);
    }
}
