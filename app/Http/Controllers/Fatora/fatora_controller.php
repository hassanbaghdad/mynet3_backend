<?php

namespace App\Http\Controllers\Fatora;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\fatora_model;
use App\Models\items_model;
use App\Models\item_fatora_model;
use Illuminate\Support\Facades\Auth;

use Validator;


class fatora_controller extends Controller
{
    public function get_customer_fatora_debts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cost_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $debts = DB::select("SELECT IFNULL( sum( fatora_total_my )- sum( fatora_wasel_him),0 ) as debts FROM fatora where(fatora_type = 2 or fatora_type = 22) and fatora_isdel = 0 and fatora_cosfk =$request->cost_id");
        
        return response()->json($debts[0],200);
    }

    public function save_fatora(Request $request)
    {
        
        $fatora = new fatora_model();

       //return response()->json($request->item_fatora,200);
        $fatora_id = fatora_model::create([
            'fatora_number'      => $request->fatora['fatora_number'],
            'fatora_date'        => $request->fatora['fatora_date'],
            'fatora_numberItems' => count($request->item_fatora),
            'fatora_total_my'    => $request->fatora['fatora_total_my'],
            'fatora_wasel_him'   => $request->fatora['fatora_wasel_him'],
            'fatora_user'        => auth()->user()->Fullname,
            'fatora_type'        => 22,
            'fatora_cosfk'       => $request->fatora['fatora_cosfk'],
            'fatora_notes'       => $request->fatora['fatora_notes'],
            'fatora_SaveDate'    => $request->fatora['fatora_SaveDate'],

        ])->fatora_id;
        
        foreach($request->item_fatora as $item)
        {
            $item_f = new item_fatora_model();
            
            $item_f->item_fatora_itemfk = $item['item_id'];
            $item_f->item_fatora_count = $item['item_count'];
            $item_f->item_fatora_price = $item['item_priceSale'];
            $item_f->item_fatora_note = $request->fatora['fatora_notes'];
            $item_f->item_fatorafk = $fatora_id;
            $item_f->item_fatora_buy = $item['item_priceDinar'];
            $item_f->item_fatora_barcode = $item['item_barcode'];
            $item_count = items_model::where('item_id',$item['item_id'])->first('item_count')->item_count;
            
           $new_count = (float)$item_count-(float)$item['item_count'];
           //return response()->json(['a'=>$item['item_count'],'b'=>$item_count],200);
            items_model::where('item_id',$item['item_id'])->where('item_isdel',0)->update(['item_count'=>$new_count]);
          
            $item_f->save();
            
        }
        $items = items_model::where('item_isdel',0)->get();
        return response()->json(['msg'=>'تم حفظ الفاتورة بنجاح','items'=>$items],200);
   

    }


    public function get_sell_foater()
    {
        $foater_sell = DB::select("SELECT fatora_id,fatora_number,cost_name,fatora_date,fatora_numberItems,fatora_total_my,fatora_wasel_him,fatora_pushtype,fatora_type,fatora_notes,fatora_SaveDate,fatora_user FROM fatora inner join costumer ON fatora.fatora_cosfk=costumer.cost_id WHERE cost_isdel=0 AND fatora_isdel=0");
        return response()->json($foater_sell,200);
    }

    public function delete_sell_fatora(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fatora_id' => 'integer|required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        fatora_model::where('fatora_id',$request->fatora_id)->update([
            'fatora_isdel'=>1
        ]);
        item_fatora_model::where('item_fatora_itemfk',$request->fatora_id)->update([
            'item_fatora_isdel'=>1
        ]);
        
        return response()->json(['msg'=>'تم حذف الفاتورة بنجاح'],200);
    }

    public function get_fatora_debts_for_us()
    {
        $debts = DB::select("SELECT cost_id, cost_name,cost_user,cost_phone ,sum( fatora_total_my) fatora_total_my , sum( fatora_wasel_him) fatora_wasel_him ,(sum( fatora_total_my )- sum( fatora_wasel_him)) carry FROM fatora,costumer where (fatora_type = 2 or fatora_type = 22) and fatora_isdel = 0 and fatora_cosfk = cost_id group by cost_id, cost_name,cost_user,cost_phone having(sum( fatora_total_my )> sum( fatora_wasel_him))");
        return response()->json($debts,200);
    }
    public function get_fatora_debts_for_them()
    {
        $debts = DB::select("SELECT cost_id, cost_name,cost_user,cost_phone ,sum( fatora_total_my) fatora_total_my , sum( fatora_wasel_him) fatora_wasel_him ,(sum( fatora_total_my )- sum( fatora_wasel_him)) carry FROM fatora,costumer where (fatora_type = 2 or fatora_type = 22) and fatora_isdel = 0 and fatora_cosfk = cost_id group by cost_id, cost_name,cost_user,cost_phone having(sum( fatora_total_my )< sum( fatora_wasel_him))");
        return response()->json($debts,200);
    }
    
}
