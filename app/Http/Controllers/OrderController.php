<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{

public function Pick_store(Request $request)
{

        $request['status']="created";

          Order::create($request->all());
          $data['msg']="pick up created successfully";
    return response()->json($data,200);

}
public function picking_up(Request $request)
{
    $id=$request->id;
    $data['picking_up']=Order::where('status','created')->get();
    return response()->json($data,200);

}

public function picking_delete(Request $request)
{
    $id=$request->id;
    $order=Order::where('id',$id)->where('status','created')->first();

   if($order)
   {

    $order->delete();
    $data['msg']="pick up deleted successfully";
    return response()->json($data,200);



   }


}
public function picking_edit(Request $request)
{
    $id=$request->id;
    $order=Order::where('id',$id)->where('status','created')->first();
    if($order)
    {
          $order->update([$request->all()]);

    }


    $data['msg']="pick up upadte successfully";
    return response()->json($data,200);

}


    public function productTrackOrder(Request $request){
        // return $request->all();
        $order=Order::where('user_id',auth()->user()->id)->where('order_number',$request->order_number)->first();
        if($order){
            $data['order']=$order;

            if($order->status=="pennding"){
            $data['msg']=['Your order has been pennding. please wait.'];
            return response()->json($data,200);

            }
            elseif($order->status=="cancelled"){
                $data['msg']=['Your order has been pennding. please wait.'];
                return response()->json($data,200);

            }   elseif($order->status=="created"){
                $data['msg']=['Your order has been created'];
                return response()->json($data,200);

            }
            elseif($order->status=="delivered"){
                $data['msg']=['Your order has been pennding'];
                return response()->json($data,200);


            }

        }
        else{
            $data['msg']=['Invalid order numer please try again'];
            return response()->json( $data,200);
        }
    }

}
