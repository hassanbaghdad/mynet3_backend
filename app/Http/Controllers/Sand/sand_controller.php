<?php

namespace App\Http\Controllers\Sand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sand_model;
use App\Models\customers_model;
use Illuminate\Support\Facades\Auth;
use DB;

class sand_controller extends Controller
{
    public function get_bills()
    {
        $bills = DB::select("SELECT * FROM sand INNER JOIN costumer on sand.Sand_cosFk = costumer.cost_id where (Sand_moneyin + Sand_money)<>0 and sand.Sand_isdel !=1 and costumer.cost_isdel=0 order by sand.Sand_date DESC");
         
        return response()->json($bills,200);
    }
 
    public function delete_bill(Request $request)
    {
        sand_model::where('Sand_id',$request->Sand_id)->update([
            'Sand_isdel'=>1
        ]) ;  
        return response()->json(['msg'=>'تم حذف الوصل بنجاح'],200);
    }

    
}
