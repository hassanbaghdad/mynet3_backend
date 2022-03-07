<?php

namespace App\Http\Controllers\Cards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cards_model;

class cards_controller extends Controller
{
    public function get_cards()
    {
        $cards = cards_model::where('card_isdel',0)->get();

        return response()->json($cards,200);
    }

    public function add_card(Request $request)
    {
        $card = new cards_model();

        $card->card_name = $request->card_name;
        $card->card_priceDinar = $request->card_priceDinar;
        $card->card_priceDO = $request->card_priceDO;

        if($card->save())
        {
            return response()->json(['msg'=>'تم اضاف الاشتراك بنجاح'],200);
        }
    }
    public function edit_card(Request $request)
    {
        cards_model::where('card_id',$request->card_id)->update([
            'card_name'=>$request->card_name,
            'card_priceDinar'=>$request->card_priceDinar,
            'card_priceDO'=>$request->card_priceDO
        ]);

       return response()->json(['msg'=>'تم اضاف الاشتراك بنجاح'],200);
        
    }
    public function delete_card(Request $request)
    {
        cards_model::where('card_id',$request->card_id)->update([
            'card_isdel'=>1
        ]);

       return response()->json(['msg'=>'تم حذف الاشتراك بنجاح'],200);
        
    }
}
