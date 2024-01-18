<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Delivery;
use App\Http\Traits\GeneralTrait1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\DeliveryResource;
class UserController extends Controller
{
    use GeneralTrait1;
    public function register(Request $request){
        try{
        $registerUserData = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|min:8'
        ]);
        $user = User::create([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'password' => Hash::make($registerUserData['password']),
            'uuid' => Str::uuid()->toString(),
        ]);
        

        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
      
        return $this->apiResponse($user,true,null,$token,200);
     
    }
    catch(Excaption $ex){
        return $this->apiResponse(null,false,$ex->getMessage(),null,500);
        
    }
         
    }
    public function login(Request $request){
        try{
        $loginUserData = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|min:8'
        ]);
        $user = User::where('email',$loginUserData['email'])->first();
        if(!$user )
        {
             
            return $this->apiResponse(null,false,"Invalid email",null,404);
        }
        else if (!Hash::check($loginUserData['password'],$user->password)){
             
            return $this->apiResponse(null,false,"Invalid password",null,404);
        }
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
      
        return $this->apiResponse($user,true,null,$token,200);
    }
    catch(Excaption $ex){
        return $this->apiResponse(null,false,$ex->getMessage(),null,500);
        
    }
    }
    public function logout(){
        try {
            auth()->user()->tokens()->delete();
    
            return $this->apiResponse(null,true,"logged out",null,200);
        } catch(Excaption $ex){
            return $this->apiResponse(null,false,$ex->getMessage(),null,500);
            
        }
         
    }
    public function ordersuser()
    {
        $user = auth()->user();
        $userOrders = Delivery::where('user_id', $user->id)->with('order')->get();
        $deliverysorder=DeliveryResource::make($userOrders);
        return response()->json($userOrders);
    }
}
