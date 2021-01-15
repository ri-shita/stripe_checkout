<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function index(Request $request){
        \Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                  'name' => 'T-shirt',
                ],
                'unit_amount' => 2000,
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://localhost:8000/success',
            'cancel_url' => 'http://localhost:8000/cancel',
        ]);

        return response()->json(['id'=>$session->id,'status'=>200]);
    }

    public function success(){

    }
    public function faliure(){
        
    }
}
