<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\items_model;

class items_controller extends Controller
{
    public function get_items()
    {
        $items = items_model::where('item_isdel',0)->get();
        return response()->json($items,200);
    }

    public function add_item(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required',
            
            
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $item = new items_model();

        $item->item_name = $request->item_name;
        $item->item_cat = $request->item_cat;
        $item->item_priceDinar = $request->item_priceDinar;
        $item->item_priceDolar = $request->item_priceDolar;
        $item->item_priceSale = $request->item_priceSale;
        $item->item_count = $request->item_count;
        $item->item_type = $request->item_type;
        $item->item_store = $request->item_store;
        $item->item_size = $request->item_size;
        $item->item_color = $request->item_color;
        $item->item_barcode = $request->item_barcode;

        if($item->save())
        {
            return response()->json(['msg'=>'تم اضافة المادة بنجاح'],200);
        }else{
            return response()->json(['msg'=>'فشل اضافة المادة '],400);
        }

    }

    public function edit_item(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|integer',
            'item_name' => 'required',
            
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        items_model::where('item_id',$request->item_id)->update([
            'item_name' => $request->item_name,
            'item_cat' => $request->item_cat,
            'item_priceDinar' => $request->item_priceDinar,
            'item_priceDolar' => $request->item_priceDolar,
            'item_priceSale' => $request->item_priceSale,
            'item_count' => $request->item_count,
            'item_type' => $request->item_type,
            'item_store' => $request->item_store,
            'item_size' => $request->item_size,
            'item_color' => $request->item_color,
            'item_barcode' => $request->item_barcode,
        ]);
        
        return response()->json(['msg'=>'تم تعديل المادة بنجاح'],200);

    }

    public function delete_item(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        items_model::find($request->item_id)->update([
            'item_isdel'=>1
        ]);

        return response()->json(['msg'=>'تم حذف المادة بنجاح'],200);
    }
}
