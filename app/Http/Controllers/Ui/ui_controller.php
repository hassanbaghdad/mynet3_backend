<?php

namespace App\Http\Controllers\Ui;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ui_customers;
use App\Models\ui_towers;
use App\Models\ui_cards;
use App\Models\ui_bills;
use App\Models\ui_users;
use App\Models\ui_debts_to_us;
use App\Models\ui_debts_to_them;
use App\Models\ui_credits;

use Illuminate\Support\Facades\Auth;

class ui_controller extends Controller
{
    public function tobool($value)
    {
        if($value == 1 || $value == "1" || $value == true || $value == "true")
        {
            return 1;
        }else{
            return 0;
        }
    }
    public function get_ui_customers()
    {
        $ui = ui_customers::where('user_id',auth()->user()->user_id)->where('route','customers')->get();
        return response()->json($ui,200);
    }

    
    public function save_ui_customers(Request $request)
    {
        $u = ui_customers::where('user_id',auth()->user()->user_id)->where('route','customers')->LIMIT(1)->get();

        if(count($u) > 0)
        {
            ui_customers::where('user_id',auth()->user()->user_id)->where('route','customers')->update([
                'col_cost_address'=>$this->tobool($request->col_cost_address),
                'col_cost_admin'=>$this->tobool($request->col_cost_admin),
                'col_cost_brig'=>$this->tobool($request->col_cost_brig),
                'col_cost_id' =>$this->tobool($request->col_cost_id),
                'col_cost_ipNano'=>$this->tobool($request->col_cost_ipNano),
                'col_cost_name'=>$this->tobool($request->col_cost_name),
                'col_cost_pass'=>$this->tobool($request->col_cost_pass),
                'col_cost_passNano'=>$this->tobool($request->col_cost_passNano),
                'col_cost_phone'=>$this->tobool($request->col_cost_phone),
                'col_cost_user'=>$this->tobool($request->col_cost_user),
                'col_cost_userNano'=>$this->tobool($request->col_cost_userNano),
                'col_remaining_days'=>$this->tobool($request->col_remaining_days),
                'col_remaining_days2'=>$this->tobool($request->col_remaining_days2),
                'col_cost_secter'=>$this->tobool($request->col_cost_secter)
            ]);
            
            return response()->json(['msg'=>'تم التعديل بنجاح'],200);
        }else{
                $ui = new ui_customers();
                $ui->route="customers";
                $ui->user_id=auth()->user()->user_id;
                $ui->col_cost_address=$this->tobool($request->col_cost_address);
                $ui->col_cost_admin=$this->tobool($request->col_cost_admin);
                $ui->col_cost_brig=$this->tobool($request->col_cost_brig);
                $ui->col_cost_id =$this->tobool($request->col_cost_id);
                $ui->col_cost_ipNano=$this->tobool($request->col_cost_ipNano);
                $ui->col_cost_name=$this->tobool($request->col_cost_name);
                $ui->col_cost_pass=$this->tobool($request->col_cost_pass);
                $ui->col_cost_passNano=$this->tobool($request->col_cost_passNano);
                $ui->col_cost_phone=$this->tobool($request->col_cost_phone);
                $ui->col_cost_user=$this->tobool($request->col_cost_user);
                $ui->col_cost_userNano=$this->tobool($request->col_cost_userNano);
                $ui->col_remaining_days=$this->tobool($request->col_remaining_days);
                $ui->col_remaining_days2=$this->tobool($request->col_remaining_days2);
                $ui->col_cost_secter=$this->tobool($request->col_cost_secter);

                if($ui->save())
                {
                    $ui2 = ui_customers::where('user_id',auth()->user()->user_id)->where('route','customers')->get();
                    return response()->json(['msg'=>'تم ألحفظ بنجاح','ui'=>$ui2],200);
                }
        }
    }
    public function get_ui_towers()
    {
        $ui = ui_towers::where('user_id',auth()->user()->user_id)->where('route','towers')->get();
        return response()->json($ui,200);
    }
    public function save_ui_towers(Request $request)
    {
        $u = ui_towers::where('user_id',auth()->user()->user_id)->where('route','towers')->LIMIT(1)->get();

        if(count($u) > 0)
        {
            ui_towers::where('user_id',auth()->user()->user_id)->where('route','towers')->update([
                'col_brig_main'=> $this->tobool($request->col_brig_main),
                'col_brig_name'=> $this->tobool($request->col_brig_name),
                'col_brig_type'=> $this->tobool($request->col_brig_type),
                'col_count_customers'=>$this->tobool($request->col_count_customers),
                'route'=>'towers'
            ]);
            
            return response()->json(['msg'=>'تم التعديل بنجاح'],200);
        }else{
                $ui = new ui_towers();
                $ui->route="towers";
                $ui->col_brig_main=$this->tobool($request->col_brig_main);
                $ui->col_brig_name=$this->tobool($request->col_brig_name);
                $ui->col_brig_type=$this->tobool($request->col_brig_type);
                $ui->col_count_customers=$this->tobool($request->col_count_customers);
                $ui->user_id=auth()->user()->user_id;
                $ui->route='towers';

                if($ui->save())
                {
                    $ui2 = ui_towers::where('user_id',auth()->user()->user_id)->where('route','towers')->get();
                    return response()->json(['msg'=>'تم ألحفظ بنجاح','ui'=>$ui2],200);
                }
        }
    }

    



    public function get_ui_cards()
    {
        $ui = ui_cards::where('user_id',auth()->user()->user_id)->where('route','cards')->get();
        return response()->json($ui,200);
    }
    public function save_ui_cards(Request $request)
    {
        $u = ui_cards::where('user_id',auth()->user()->user_id)->where('route','cards')->LIMIT(1)->get();

        if(count($u) > 0)
        {
            ui_cards::where('user_id',auth()->user()->user_id)->where('route','cards')->update([
                'col_card_name'=>$this->tobool($request->col_card_name),
                'col_card_priceDinar'=>$this->tobool($request->col_card_priceDinar),
                'col_card_priceDO'=>$this->tobool($request->col_card_priceDO),
                'route'=>'cards'
            ]);
            
            return response()->json(['msg'=>'تم التعديل بنجاح'],200);
        }else{
                $ui = new ui_cards();
                $ui->route="cards";
                $ui->col_card_name=$this->tobool($request->col_card_name);
                $ui->col_card_priceDinar=$this->tobool($request->col_card_priceDinar);
                $ui->col_card_priceDO=$this->tobool($request->col_card_priceDO);
                $ui->user_id=auth()->user()->user_id;
                $ui->route='cards';

                if($ui->save())
                {
                    $ui2 = ui_cards::where('user_id',auth()->user()->user_id)->where('route','cards')->get();
                    return response()->json(['msg'=>'تم ألحفظ بنجاح','ui'=>$ui2],200);
                }
        }
    }



    public function get_ui_bills()
    {
        $ui = ui_bills::where('user_id',auth()->user()->user_id)->where('route','bills')->get();
        return response()->json($ui,200);
    }
    public function save_ui_bills(Request $request)
    {
        $u = ui_bills::where('user_id',auth()->user()->user_id)->where('route','bills')->LIMIT(1)->get();

        if(count($u) > 0)
        {
            ui_bills::where('user_id',auth()->user()->user_id)->where('route','bills')->update([
                'col_Sand_id'=>$this->tobool($request->col_Sand_id),
                'col_Sand_date'=>$this->tobool($request->col_Sand_date),
                'col_Sand_moneyType'=>$this->tobool($request->col_Sand_moneyType),
                'col_Sand_money'=>$this->tobool($request->col_Sand_money),
                'col_Sand_moneyin'=>$this->tobool($request->col_Sand_moneyin),
                'col_Sand_cardtype'=>$this->tobool($request->col_Sand_cardtype),
                'col_cost_name'=>$this->tobool($request->col_cost_name),
                'col_cost_user'=>$this->tobool($request->col_cost_user),
                'col_sand_user'=>$this->tobool($request->col_sand_user),
                
                'route'=>'bills'
            ]);
            
            return response()->json(['msg'=>'تم التعديل بنجاح'],200);
        }else{
                $ui = new ui_bills();
                $ui->route="bills";
                $ui->col_Sand_id=$this->tobool($request->col_Sand_id);
                $ui->col_Sand_date=$this->tobool($request->col_Sand_date);
                $ui->col_Sand_moneyType=$this->tobool($request->col_Sand_moneyType);
                $ui->col_Sand_money=$this->tobool($request->col_Sand_money);
                $ui->col_Sand_moneyin=$this->tobool($request->col_Sand_moneyin);
                $ui->col_Sand_cardtype=$this->tobool($request->col_Sand_cardtype);
                $ui->col_cost_name=$this->tobool($request->col_cost_name);
                $ui->col_cost_user=$this->tobool($request->col_cost_user);
                $ui->col_sand_user=$this->tobool($request->col_sand_user);
                
                $ui->route="bills";
              

                $ui->user_id=auth()->user()->user_id;
                

                if($ui->save())
                {
                    $ui2 = ui_bills::where('user_id',auth()->user()->user_id)->where('route','bills')->get();
                    return response()->json(['msg'=>'تم ألحفظ بنجاح','ui'=>$ui2],200);
                }
        }
    }

    public function get_ui_users()
    {
        $ui = ui_users::where('user_id',auth()->user()->user_id)->where('route','users')->get();
        return response()->json($ui,200);
    }
    public function save_ui_users(Request $request)
    {
        $u = ui_users::where('user_id',auth()->user()->user_id)->where('route','users')->LIMIT(1)->get();

        if(count($u) > 0)
        {
            ui_users::where('user_id',auth()->user()->user_id)->where('route','users')->update([
                'col_Fullname'=>$this->tobool($request->col_Fullname),
                'col_username'=>$this->tobool($request->col_username),
                'col_user_level'=>$this->tobool($request->col_user_level),
                
                
                'route'=>'users'
            ]);
            
            return response()->json(['msg'=>'تم التعديل بنجاح'],200);
        }else{
                $ui = new ui_users();
                $ui->route="users";
                $ui->col_Fullname=$this->tobool($request->col_Fullname);
                $ui->col_username=$this->tobool($request->col_username);
                $ui->col_user_level=$this->tobool($request->col_user_level);
               
                $ui->user_id=auth()->user()->user_id;
                

                if($ui->save())
                {
                    $ui2 = ui_users::where('user_id',auth()->user()->user_id)->where('route','users')->get();
                    return response()->json(['msg'=>'تم ألحفظ بنجاح','ui'=>$ui2],200);
                }
        }
    }

    public function get_ui_debts_to_us()
    {
        $ui = ui_debts_to_us::where('user_id',auth()->user()->user_id)->where('route','debts-to-us')->get();
        return response()->json($ui,200);
    }
    public function save_ui_debts_to_us(Request $request)
    {
        $u = ui_debts_to_us::where('user_id',auth()->user()->user_id)->where('route','debts-to-us')->LIMIT(1)->get();

        if(count($u) > 0)
        {
            ui_debts_to_us::where('user_id',auth()->user()->user_id)->where('route','debts-to-us')->update([
                'col_cost_name'=>$this->tobool($request->col_cost_name),
                'col_cost_user'=>$this->tobool($request->col_cost_user),
                'col_cost_phone'=>$this->tobool($request->col_cost_phone),
                'col_brig_name'=>$this->tobool($request->col_brig_name),
                'col_Sand_dateto'=>$this->tobool($request->col_Sand_dateto),
                'col_Sand_nextdate'=>$this->tobool($request->col_Sand_nextdate),
                'col_Sand_carry'=>$this->tobool($request->col_Sand_carry),
                
                
                'route'=>'debts-to-us'
            ]);
            
            return response()->json(['msg'=>'تم التعديل بنجاح'],200);
        }else{
                $ui = new ui_debts_to_us();
                $ui->route="debts-to-us";
                $ui->col_cost_name=$this->tobool($request->col_cost_name);
                $ui->col_cost_user=$this->tobool($request->col_cost_user);
                $ui->col_cost_phone=$this->tobool($request->col_cost_phone);
                $ui->col_brig_name=$this->tobool($request->col_brig_name);
                $ui->col_Sand_dateto=$this->tobool($request->col_Sand_dateto);
                $ui->col_Sand_nextdate=$this->tobool($request->col_Sand_nextdate);
                $ui->col_Sand_carry=$this->tobool($request->col_Sand_carry);
               
                $ui->user_id=auth()->user()->user_id;
                

                if($ui->save())
                {
                    $ui2 = ui_debts_to_us::where('user_id',auth()->user()->user_id)->where('route','debts-to-us')->get();
                    return response()->json(['msg'=>'تم ألحفظ بنجاح','ui'=>$ui2],200);
                }
        }
    }


    public function get_ui_debts_to_them()
    {
        $ui = ui_debts_to_them::where('user_id',auth()->user()->user_id)->where('route','debts-to-them')->get();
        return response()->json($ui,200);
    }
    public function save_ui_debts_to_them(Request $request)
    {
        $u = ui_debts_to_them::where('user_id',auth()->user()->user_id)->where('route','debts-to-them')->LIMIT(1)->get();

        if(count($u) > 0)
        {
            ui_debts_to_them::where('user_id',auth()->user()->user_id)->where('route','debts-to-them')->update([
                'col_cost_name'=>$this->tobool($request->col_cost_name),
                'col_cost_user'=>$this->tobool($request->col_cost_user),
                'col_cost_phone'=>$this->tobool($request->col_cost_phone),
                'col_brig_name'=>$this->tobool($request->col_brig_name),
                'col_Sand_dateto'=>$this->tobool($request->col_Sand_dateto),
                'col_Sand_nextdate'=>$this->tobool($request->col_Sand_nextdate),
                'col_Sand_carry'=>$this->tobool($request->col_Sand_carry),
                
                
                'route'=>'debts-to-them'
            ]);
            
            return response()->json(['msg'=>'تم التعديل بنجاح'],200);
        }else{
                $ui = new ui_debts_to_them();
                $ui->route="debts-to-them";
                $ui->col_cost_name=$this->tobool($request->col_cost_name);
                $ui->col_cost_user=$this->tobool($request->col_cost_user);
                $ui->col_cost_phone=$this->tobool($request->col_cost_phone);
                $ui->col_brig_name=$this->tobool($request->col_brig_name);
                $ui->col_Sand_dateto=$this->tobool($request->col_Sand_dateto);
                $ui->col_Sand_nextdate=$this->tobool($request->col_Sand_nextdate);
                $ui->col_Sand_carry=$this->tobool($request->col_Sand_carry);
               
                $ui->user_id=auth()->user()->user_id;
                

                if($ui->save())
                {
                    $ui2 = ui_debts_to_them::where('user_id',auth()->user()->user_id)->where('route','debts-to-them')->get();
                    return response()->json(['msg'=>'تم ألحفظ بنجاح','ui'=>$ui2],200);
                }
        }
    }


    public function get_ui_credits()
    {
        $ui = ui_credits::where('user_id',auth()->user()->user_id)->where('route','credits')->get();
        return response()->json($ui,200);
    }
    public function save_ui_credits(Request $request)
    {
        $u = ui_credits::where('user_id',auth()->user()->user_id)->where('route','credits')->LIMIT(1)->get();

        if(count($u) > 0)
        {
            ui_credits::where('user_id',auth()->user()->user_id)->where('route','credits')->update([
                'col_Sand_id'=>$this->tobool($request->col_Sand_id),
                'col_Sand_date'=>$this->tobool($request->col_Sand_date),
                'col_Sand_money'=>$this->tobool($request->col_Sand_money),
                'col_Sand_moneyin'=>$this->tobool($request->col_Sand_moneyin),
                'col_Sand_notes'=>$this->tobool($request->col_Sand_notes),
                'col_sand_user'=>$this->tobool($request->col_sand_user),
                'col_sand_desc'=>$this->tobool($request->col_sand_desc),
                'col_Sand_operation'=>$this->tobool($request->col_Sand_operation),
                'col_cost_price'=>$this->tobool($request->col_cost_price),
                'col_gain'=>$this->tobool($request->col_gain),
                'col_currency'=>$this->tobool($request->col_currency),
                'col_userAflet'=>$this->tobool($request->col_userAflet),
                'col_brig_name'=>$this->tobool($request->col_brig_name),
                'col_tree_name'=>$this->tobool($request->col_tree_name),
                
                'route'=>'credits'
            ]);
            
            return response()->json(['msg'=>'تم التعديل بنجاح'],200);
        }else{
                $ui = new ui_credits();
                $ui->route="credits";
                $ui->col_Sand_id=$this->tobool($request->col_Sand_id);
                $ui->col_Sand_date=$this->tobool($request->col_Sand_date);
                $ui->col_Sand_money=$this->tobool($request->col_Sand_money);
                $ui->col_Sand_moneyin=$this->tobool($request->col_Sand_moneyin);
                $ui->col_Sand_notes=$this->tobool($request->col_Sand_notes);
                $ui->col_sand_user=$this->tobool($request->col_sand_user);
                $ui->col_sand_desc=$this->tobool($request->col_sand_desc);
                $ui->col_Sand_operation=$this->tobool($request->col_Sand_operation);
                $ui->col_cost_price=$this->tobool($request->col_cost_price);
                $ui->col_gain=$this->tobool($request->col_gain);
                $ui->col_currency=$this->tobool($request->col_currency);
                $ui->col_userAflet=$this->tobool($request->col_userAflet);
                $ui->col_brig_name=$this->tobool($request->col_brig_name);
                $ui->col_tree_name=$this->tobool($request->col_tree_name);
                
               
                $ui->user_id=auth()->user()->user_id;
                

                if($ui->save())
                {
                    $ui2 = ui_credits::where('user_id',auth()->user()->user_id)->where('route','credits')->get();
                    return response()->json(['msg'=>'تم ألحفظ بنجاح','ui'=>$ui2],200);
                }
        }
    }


    
}
