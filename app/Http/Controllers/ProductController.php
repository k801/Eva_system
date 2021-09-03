<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
class ProductController extends Controller
{


    public function add_order(Request $request)
    {

        $address=$request["address"];
        $notes=$request["notes"];
        $client_id=$request["client_id"];
       $zone=$request["zone"];
       $city=$request["city"];
       $is_voucher=$request["is_voucher"];
       $voucher_id=$request["voucher_id"];
       $voucher_name=$request["v_name"];
       $products=$request->all()["products"];

// get information client
$client=DB::table('web_users')->where('id',$client_id)->first();

//get unique order id
$order_id = mt_rand(10000,100000);

// insert into  default values orders table
DB::table("orders")->insert([
    "client_id" =>$client_id,
    "client_mobile" =>$client->mobile,
    "order_id" =>0,
    "items_c" =>0,
    "total" =>0,
    "is_voucher" =>0,
    "voucher_id" =>0,
    "voucher_value" =>0,
    "shipping_value" =>0,
    "voucher_value" =>0,
    "payment_method" =>0,
    "payment_type" =>0,
    "ins_months" =>0,
    "type" =>0,
    "status" =>0,
    "order_integration" =>0,
    "mobile_wallet" =>0,
    "date" =>date('Y-m-d'),
    "time" =>date('Y-m-d H:i:s'),

  ]);


// insert data order_items
      $total_qty=0;
      $total_total=0;
       foreach ($products as $key => $vals)
        {

        $item_id=$vals["id"];
        $item_qty=$vals["quantity"];

        $item=DB::table('items')->where('id', $item_id)->first();
        $total=$item_qty*$item->price;
        $total_total=$total_total+$total;
        $total_qty=+$item_qty;
        DB::table("order_items")->insert([
            "client_id" =>$client_id,
            "order_id" =>$order_id,
            "item_id" => $item_id,
            "item_name" =>$item->name,
            "item_qty" =>$item_qty,
            "item_price" =>$item->price,
            "total" =>$total,
            "seller" =>0,
        ]);
        print_r($total."<br>");

    }  //end foreach
    // dd($total_total);
// check vochuer
$sum_all_all_vouchers=0;
if($is_voucher==1)
      {
          $all_vouchers=DB::table("coupon")->select("*")->where("user",$voucher_id)->where('v_name',$voucher_name)->get();
          $sum_all_all_vouchers=0;
          foreach ($all_vouchers as $voucher_sums) {
              $sum_all_all_vouchers=$sum_all_all_vouchers+$voucher_sums->amount;
      }
    }
// update orders info
DB::table("orders")->where("client_id",$client_id)->update([
    "client_id" =>$client_id,
    "client_mobile" =>$client->mobile,
    "order_id" =>$order_id,
    "items_c" =>$total_qty,
    "total" =>$total_total-$sum_all_all_vouchers,
    "is_voucher" =>$is_voucher,
    "voucher_id" =>$voucher_id,
    "shipping_value" =>0,
    "voucher_value" =>$sum_all_all_vouchers,
    "payment_method" =>0,
    "payment_type" =>0,
    "ins_months" =>0,
    "type" =>0,
    "status" =>0,
    "order_integration" =>0,
    "mobile_wallet" =>0,
    "date" =>date('Y-m-d'),
    "time" =>date('H:i:s'),

]);
// insert into order_addres_info table
DB::table("order_addres_info")->insert([
    'order_id'=>$order_id,
    'client_id'=>$client_id,
    'first_name'=>$client->name,
    'last_name'=>$client->l_name,
    'city'=>$city,
    'zone'=>$zone,
    'address'=>$client->address,
    'mail'=>$client->email,
    'mobile'=>$client->mobile,
    'notes'=>$notes,


    ]);


$data["msg"]=["order register seccufelly"];
return Response::json($data,200);

    }





    }






