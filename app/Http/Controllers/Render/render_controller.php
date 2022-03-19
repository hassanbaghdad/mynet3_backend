<?php

namespace App\Http\Controllers\Render;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cards_model;
use App\Models\sand_model;
use App\Models\ui_customers;
use App\Models\ui_towers;
use App\Models\ui_cards;
use App\Models\ui_bills;
use App\Models\ui_users;
use App\Models\ui_debts_to_us;
use App\Models\ui_debts_to_them;
use App\Models\ui_credits;
use App\Models\settings_model;

use DB;
use Illuminate\Support\Facades\Auth;

class render_controller extends Controller
{
    public function render()
    {
        $cards = cards_model::where('card_isdel',0)->get();
        $towers = DB::select("SELECT brig_id,brig.brig_name,brig_main,brig_month,brig_type,brig_user,brig_pass,brig_passOnline,brig_month,brig_address,brig_note, COUNT(cost_id) AS count_customers FROM brig LEFT JOIN costumer ON brig.brig_id = costumer.cost_bregFk WHERE brig.brig_isdel=0 GROUP BY brig_id ORDER BY count_customers DESC");
        $ui_customers = ui_customers::where('route','customers')->where('user_id',auth()->user()->user_id)->get();
        $ui_towers = ui_towers::where('route','towers')->where('user_id',auth()->user()->user_id)->get();
        $ui_cards = ui_cards::where('route','cards')->where('user_id',auth()->user()->user_id)->get();
        $ui_bills = ui_bills::where('route','bills')->where('user_id',auth()->user()->user_id)->get();
        $ui_users = ui_bills::where('route','users')->where('user_id',auth()->user()->user_id)->get();
        $ui_debts_to_us = ui_debts_to_us::where('route','debts-to-us')->where('user_id',auth()->user()->user_id)->get();
        $ui_debts_to_them = ui_debts_to_them::where('route','debts-to-them')->where('user_id',auth()->user()->user_id)->get();
        $ui_credits = ui_credits::where('route','credits')->where('user_id',auth()->user()->user_id)->get();
        $settings = settings_model::where('id',1)->get();

        $token = auth()->user()->createToken('API Token')->plainTextToken;
        $user = auth()->user();
        $user["token"] = $token;

        return response()->json([
            'cards'=>$cards,
            'towers'=>$towers,
            'settings'=>$settings,
            'ui_customers'=>$ui_customers,
            'ui_towers'=>$ui_towers,
            'ui_cards'=>$ui_cards,
            'ui_bills'=>$ui_bills,
            'ui_users'=>$ui_users,
            'ui_debts_to_us'=>$ui_debts_to_us,
            'ui_debts_to_them'=>$ui_debts_to_them,
            'ui_credits'=>$ui_credits,
            
            
            'user'=>$user
        ],200);
    }
}
