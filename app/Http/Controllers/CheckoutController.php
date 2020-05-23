<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkSubscription');

    }
    public function index()
    {
        return view('checkout');
    }

    public function subscribePlan(Request $request)
    {
        $user = auth()->user();
        return $user->newSubscription($request->product, $request->product)->create(request()->paymentM);
    }
}
