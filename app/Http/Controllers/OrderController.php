<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Delivery;
use App\Models\Food;
use App\Models\Order_food;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderResource;
use App\Http\Resources\DeliveryResource;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use GeneralTrait;
  

     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        
        
        if (!Auth::check()) {
            return response()->json(['error' => 'يرجى توفير الرمز المميز للوصول إلى هذا الطلب'], 401);
        }
        else{
        $validator = Validator::make($request->all(),[
        'title' => 'required',
        'restaurant_id' => 'required|exists:restaurants,id',
        'food_id' => 'required|exists:food,id',
        'quantity' => 'required',
         
    ]);
        $order = new Order;
        
       
    $order->title = $request->input('title');
    $order->restaurant_id = $request->input('restaurant_id');
    
    if ($validator->fails()) {
        return $this->apiResponse(null,false,$validator->errors(),400);
        
    }
    $order->save();
     
    
    $totalamount = 0;
    
        

        
    
 $orderDetail = new Order_food();
 
    $orderDetail->order_id = $order->id;
        $orderDetail->food_id =$request->input('food_id');  
        $orderDetail->quantity = $request->input('quantity');
 
        $orderDetail->save();
     
        $menuItem = Food::find($orderDetail->food_id);
        $totalamount+= $menuItem->price *$orderDetail->quantity;
             
    
    $order->total_cost= $totalamount;
    $order->save(); 
    $user = auth()->user();
     $delivery = new Delivery();
    $delivery->user_id = $user->id;
    $delivery->order_id = $order->id;
    $delivery->delivery_type = $request->input('delivery_type');
    $delivery->save(); 
    $orders=OrderResource::make($order);
    $deliverys=DeliveryResource::make($delivery);
    return $this->apiResponse([$orders,$deliverys]);
}
    }


}
