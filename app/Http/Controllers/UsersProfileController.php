<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $user = auth()->user();
        return view('profile' , compact('user'));
    }

    public function changePlanPage(){
        $user = auth()->user();
       if($user->subscribed('price_HHscK4hA3OppYy') || $user->subscribed('price_HHseeeuTgOe3DY')){
            return view('changePlan' , compact('user'));
       }
    return redirect()->back()->with('message' , 'Kindly Subscribe to a plan before change');
    }


    public function updatePlan(Request $request){

        $validation = Validator::make($request->all() , [
            'plan'  => 'required'
        ]);
        if($validation->fails()){
            return redirect()->back()->with('message' , $validation->errors()->first());
        }

        $user = auth()->user();
        $userPlan = $user->subscriptions->first()->name;
        if($userPlan == $request->plan){
            return redirect()->back()->with('message' , 'you are already suscribe to this plan');
        }
        $user->subscription($userPlan)->swap($request->plan);
        return redirect()->back()->with('message' , 'you have successfully changed the plan');

    }


}
