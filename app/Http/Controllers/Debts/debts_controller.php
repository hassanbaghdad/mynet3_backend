<?php

namespace App\Http\Controllers\Debts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class debts_controller extends Controller
{
    public function get_debts_to_us()
    {
        $debts_to_us= DB::select("SELECT brig_name, cost_id,cost_phone,cost_name,cost_user,max(Sand_nextdate) as Sand_nextdate, Sand_dateto ,(sum( Sand_money )-sum( Sand_moneyin))as 'Sand_carry' FROM sand ,brig,costumer where cost_isdel = 0 and Sand_isdel=0 and Sand_cosFk=cost_id and brig_id=cost_bregFk group by cost_id,cost_name,cost_user,brig_name,cost_phone having (sum( Sand_money )-sum( Sand_moneyin)) >0");
        return response()->json($debts_to_us,200);
    }

    public function get_debts_to_them()
    {
        $debts_to_them= DB::select("SELECT brig_name, cost_id,cost_phone,cost_name,cost_user,max(Sand_nextdate) as Sand_nextdate, Sand_dateto ,(sum( Sand_money )-sum( Sand_moneyin))as 'Sand_carry' FROM sand ,brig,costumer where cost_isdel = 0 and Sand_isdel=0 and Sand_cosFk=cost_id and brig_id=cost_bregFk group by cost_id,cost_name,cost_user,brig_name,cost_phone having (sum( Sand_money )-sum( Sand_moneyin)) < 0");
        return response()->json($debts_to_them,200);
    }

    
    public function get_credits_di(Request $request)
    {
         $credits = DB::select("SELECT 'دينار' as 'currency', tree_name,brig_userAflet ,brig_name ,Sand_id,
            Sand_money,Sand_moneyin,
            Sand_withdrawal as 'cost_price',
            Sand_desc as 'sand_desc',   
            1.00*Sand_money-(Sand_withdrawal) as 'gain'     
                , Sand_date      , Sand_notes        , sand_user ,Sand_operation
                FROM sand,tree,brig where Sand_dod=1  and  Sand_isdel=0 and brig_isdel=0 and Sand_fkBrig=brig_id and tree_id=Sand_moneyType 
                order by Sand_id desc");
     
     return response()->json($credits,200);
    }
    
     public function get_credits_do(Request $request)
    {
         $credits = DB::select("SELECT 'دولار' as 'currency', tree_name,brig_userAflet ,brig_name ,Sand_id,
            Sand_money,Sand_moneyin,
            Sand_withdrawal as 'cost_price',
            Sand_desc as 'sand_desc',   
            1.00*Sand_money-(Sand_withdrawal) as 'gain'     
                , Sand_date      , Sand_notes        , sand_user ,Sand_operation
                FROM sand,tree,brig where Sand_dod=0  and  Sand_isdel=0 and brig_isdel=0 and Sand_fkBrig=brig_id and tree_id=Sand_moneyType 
                order by Sand_id desc");
     
     return response()->json($credits,200);
    }
}
