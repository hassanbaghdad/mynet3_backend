<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\customers_model;
use App\Models\sand_model;
use Illuminate\Support\Facades\Auth;


class customers_controller extends Controller
{
    public function get_customers()
    {
       //  $customers = DB::select("SELECT  cost_id,cost_name, cost_user, cost_pass, cost_phone, cost_address, cost_sms,cost_secter, cost_ipNano, cost_userNano, cost_passNano, cost_bregFk, brig_name, brig_type,brig_month,Sand_cardtype,
       // DATEDIFF(MAX(Sand_dateto),NOW()) AS remaining_days FROM costumer INNER JOIN brig ON cost_bregFk=brig_id LEFT JOIN sand ON costumer.cost_id = Sand_cosfk and Sand_isdel=0 WHERE cost_isdel=0  GROUP BY cost_id");
        
        $customers = DB::select("SELECT * FROM costumer LEFT JOIN brig ON cost_bregFk=brig_id AND cost_isdel = 0");
        return response()->json($customers,200);
       
    }
    public function get_customers_speed()
    {
     
        $customers = DB::select("SELECT * FROM costumer LEFT JOIN Sand ON costumer.cost_id = Sand.Sand_cosFk LEFT JOIN brig ON costumer.cost_bregFk=brig.brig_id WHERE cost_isdel=0");
        return response()->json($customers,200);
       
    }
    

    public function get_customer_details(Request $request)
    {
        //$details = DB::select("SELECT cost_name,cost_user,card_name,Sand_dateto,card_id ,DATEDIFF(sand.Sand_dateto,NOW()) AS `remaining_days`,SUM(sand.Sand_money)-SUM(sand.Sand_moneyin) AS `remaining_money` FROM costumer, brig,sand,card where costumer.cost_bregFk=brig.brig_id AND costumer.cost_id = sand.Sand_cosfk AND costumer.cost_cardFk=card.card_id and cost_isdel=0 and costumer.cost_id=$request->cost_id GROUP BY costumer.cost_name order by costumer.cost_id desc LIMIT 1");
        $details = DB::select("SELECT cost_name,cost_user,MAX(Sand_dateto) AS 'Sand_dateto' ,Sand_cardtype ,DATEDIFF(MAX(Sand.Sand_dateto),NOW()) AS `remaining_days`,(SELECT SUM(Sand_money)-SUM(Sand_moneyin) FROM Sand WHERE Sand_cosfk=costumer.cost_id) AS 'remaining_money' FROM costumer JOIN Sand ON costumer.cost_id = Sand.Sand_cosfk WHERE cost_isdel=0 and Sand.Sand_isdel=0 and costumer.cost_id=$request->cost_id ORDER BY Sand.Sand_id DESC LIMIT 1");
        
        if(count($details) < 1)
        {
            $details = customers_model::where('cost_id',$request->cost_id)->where('cost_isdel',0)->get();
            
            $details[0]->remaining_days = 0;
            $details[0]->card_name = "لم يشترك بعد";
            $details[0]->Sand_dateto = null;
            $details[0]->remaining_money = 0;
            
        }
        $details[0]->card_name = $details[0]->Sand_cardtype;
        return response()->json($details,200);
    }

    public function add_customer(Request $request)
    {
        $customer = new customers_model();

        $customer->cost_name=$request->cost_name;
        $customer->cost_user=$request->cost_user;
        $customer->cost_pass=$request->cost_pass;
        $customer->cost_phone=$request->cost_phone;
        $customer->cost_address=$request->cost_address;
        $customer->cost_secter=$request->cost_secter;
        $customer->cost_sms=$request->cost_sms;
        $customer->cost_userNano=$request->cost_userNano;
        $customer->cost_passNano=$request->cost_passNano;
        $customer->cost_ipNano=$request->cost_ipNano;
        $customer->cost_bregFk=$request->cost_bregFk;
        $customer->cost_state=1;

        if($customer->save())
        {
            return response()->json(['msg'=>'تم حفظ المشترك بنجاح'],200);
        }
    }
    public function edit_customer(Request $request)
    {
        customers_model::where('cost_id',$request->cost_id)->update([
            'cost_name'=>$request->cost_name,
            'cost_user'=>$request->cost_user,
            'cost_pass'=>$request->cost_pass,
            'cost_phone'=>$request->cost_phone,
            'cost_address'=>$request->cost_address,
            'cost_secter'=>$request->cost_secter,
            'cost_sms'=>$request->cost_sms,
            'cost_userNano'=>$request->cost_userNano,
            'cost_passNano'=>$request->cost_passNano,
            'cost_ipNano'=>$request->cost_ipNano,
            'cost_bregFk'=>$request->cost_bregFk,
            'cost_state'=>1,
        ]);

    
            return response()->json(['msg'=>'تم تعديل المشترك بنجاح'],200);
        
    }
    public function delete_customer(Request $request)
    {
        customers_model::where('cost_id',$request->cost_id)->update([
            'cost_isdel'=>1,
        ]);

    
            return response()->json(['msg'=>'تم حذف المشترك بنجاح'],200);
        
    }

    public function active_net(Request $request)
    {
        $sand = new sand_model();

        $sand->Sand_date = $request->sand_date;
        $sand->Sand_money = $request->sand_money;
        $sand->Sand_moneyin = $request->moneyin;
        $sand->Sand_moneyType = 1;
        $sand->Sand_cardtype = $request->card_name;
        $sand->Sand_cosfk = $request->sand_costFk;
        $sand->Sand_isdel = 0;
        $sand->Sand_withdrawal_iq = 0;
        $sand->Sand_moneyCarry = 0;
        $sand->sand_user = auth()->user()->Fullname;
        $sand->Sand_month = $request->months;
        $sand->Sand_fkBrig = $request->sand_FkBrig;
        $sand->Sand_notes = $request->sand_notes;
        $sand->Sand_datefrom = $request->sand_datefrom;
        $sand->Sand_dateto = $request->sand_dateto;
        
        customers_model::where('cost_id',$request->sand_costFk)->update([
            'cost_cardFk'=>$request->card_id
        ]);
        if($sand->save())
        {
            return response()->json(['msg'=>'تم التفعيل بنجاح'],200);
        }
    }

    public function get_customer_debts(Request $request)
    {
        $info = DB::select("SELECT cost_name ,cost_user, (SELECT SUM(Sand_money)-SUM(Sand_moneyin) FROM Sand WHERE Sand_cosfk=costumer.cost_id ) AS 'debts' FROM costumer left join Sand ON costumer.cost_id = Sand.Sand_cosFk WHERE costumer.cost_id=$request->cost_id AND costumer.cost_isdel=0 and Sand.Sand_isdel=0 GROUP BY cost_name");
        return response()->json($info,200);
    }

    public function add_debt(Request $request)
    {
        $sand = new sand_model();
        $sand->Sand_cosFk = $request->cost_id;
        $sand->Sand_money = $request->sand_money;
        $sand->Sand_moneyin = $request->sand_moneyin;
        $sand->Sand_moneyType = 6;
        $sand->Sand_moneyCarry = 0;
        $sand->Sand_withdrawal_iq = 0;
        $sand->Sand_date= $request->sand_date;
        $sand->Sand_nextdate= $request->sand_nextdate;
        $sand->sand_user = auth()->user()->Fullname;
        if($sand->save())
        {
            return response()->json(['msg'=>'تم حفظ وصل الدين بنجاح'],200);
        }
    }

    public function payoff(Request $request)
    {
        $sand = new sand_model();
        $sand->Sand_cosFk = $request->cost_id;
        $sand->Sand_money = $request->sand_money;
        $sand->Sand_moneyin = $request->sand_moneyin;
        $sand->Sand_moneyType = 2;
        $sand->Sand_withdrawal_iq = 0;
        $sand->Sand_moneyCarry = 0;
        $sand->Sand_date= $request->sand_date;
        $sand->sand_user = auth()->user()->Fullname;
        if($sand->save())
        {
            return response()->json(['msg'=>'تم حفظ وصل التسديد بنجاح'],200);
        }
    }

    public function get_sands_customer(Request $request)
    {
        $sands = DB::select("SELECT Sand_id,Sand_date,Sand_dateto,Sand_moneyType,Sand_money,Sand_moneyin,Sand_cardtype,sand_user,cost_name,cost_user FROM Sand JOIN costumer ON Sand.sand_cosFk = costumer.cost_id WHERE costumer.cost_isdel=0 AND Sand.Sand_isdel=0 AND costumer.cost_id=$request->cost_id");
        
        return response()->json($sands,200);
    }

    
}
