<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PackagePlan;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function makePayment(Request $request)
    {
        // $currency=1;
        $currency = currency_exchange(EXCHNAGE);
       // $currency=round($currency,2);
        $plan = Plan::find($request->plan_id);
        $user = User::find(Auth::user()->id)->first();
        $packagehistory = PackagePlan::where('user_id', Auth::user()->id)->where('package_name', $plan->plan_name)->get();
       
        if ($request->plan_type == 0) {
            $amount = $plan->plan_amount;  
            $total= round($amount* $currency,2) ;       
            $discount = 0;
            $yearly = $plan->plan_amount * $currency;
        } else {
            $yearly = round($plan->plan_amount * ($request->plan_type == 0 ? 1 : 12));
            $discount = round($plan->plan_amount * ($request->plan_type == 0 ? 1 : 12) / 100 * $plan->plan_discount);
            $amount = round(($plan->plan_amount * ($request->plan_type == 0 ? 1 : 12) - $discount) / 12);
             $total= round(($yearly-$discount) * $currency,2);
                         }
       // dd($total);
        $provider = new PayPalClient;      

        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('agent.buy.plan.store'),
                "cancel_url" => route('agent.cancel.payment'),
            ],
            "purchase_units" => [
                0 => [
                    "reference_id" => $request->plan_id."-". $request->plan_type."-". $discount,
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $total
                    ]
                ]
            ]
        ]);
       
        if (isset($response['id']) && $response['id'] != null) {           
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            $notification = array(
                'message' => 'Something went wrong.',
                'alert-type' => 'warning'
            );
            return redirect()
                ->route('agent.cancel.payment')
            ->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong.',
                'alert-type' => 'warning'
            );
            return redirect()
                ->route('agent.cancel.payment')
                ->with($notification);
        }
    }
    public function handlePayment(Request $request)
    {
        $amount=100;
        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment'),
                "cancel_url" => route('cancel.payment'),
            ],
            "purchase_units" => [
                0 => [                    
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount . ".00"
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            $notification = array(
                'message' => 'Something went wrong.',
                'alert-type' => 'warning'
            );
            return redirect()
                ->route('cancel.payment')
            ->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong.',
                'alert-type' => 'warning'
            );
            return redirect()
                ->route('agent.buy.package')
            ->with($notification);
        }
    }

    public function paymentCancel()
    {
        $notification = array(
            'message' => 'You have canceled the transaction.',
            'alert-type' => 'warning'
        );
        return redirect()
            ->route('agent.buy.package')
        ->with($notification);
    }

    public function paymentSuccess(Request $request)
    {
       
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $notification = array(
                'message' => 'Transaction complete.',
                'alert-type' => 'success'
            );
            return redirect()
                ->route('agent.buy.package.package_history')
            ->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong.',
                'alert-type' => 'warning'
            );
            return redirect()
                ->route('agent.buy.package')
            ->with($notification);
               
        }
    }
}
