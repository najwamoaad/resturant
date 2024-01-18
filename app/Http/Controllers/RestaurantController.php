<?php

namespace App\Http\Controllers;
 
use App\Models\Restaurant;
use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     use GeneralTrait;
    public function index()
    {
        $restaurants = Restaurant::with('foods')->get();
       // $food = $restaurants->foods->pluck('name');
        if (response()) {
         
            
            return $this->apiResponse($restaurants);}
            else {
             return $this->notFoundResponse('not found response');
         }
       
    }
 
 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
    $foods = $restaurant->foods;

    return response()->json([
        'restaurant' => $restaurant,
        'foods' => $foods
    ]);
    }
 

 

 
    public function searchRestaurants(Request $request)
{
    $cuisine=$request->input('cuisine');
    $address=$request->input('address');

        
         
    $restaurants = Restaurant::where('cuisine', $cuisine)
    ->where('address', $address)
    ->get();
    
        if (response()) {
         
            
            return $this->apiResponse($restaurants);}
            else {
             return $this->notFoundResponse('not found response');
         }
}
}
