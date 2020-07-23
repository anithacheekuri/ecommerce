<?php

namespace App\Http\Controllers;

use App\Order;
use App\Mail\OrderPaid;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Provider;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{

    public function getExpressCheckout($orderId)
    {
       
        $checkoutData = $this->checkoutData($orderId);

        $provider = new ExpressCheckout();

        $response = $provider->setExpressCheckout($checkoutData);

        return redirect($response['paypal_link']);
    }

    private function checkoutData($orderId)
    {
       // $cart = \Cart::session(auth()->id());

       /* $cartItems = array_map(function ($item) use($cart) {
            return [
                'name' => $item['name'],
                'price' => $item['price'],
                'qty' => $item['quantity']

            ];
        }, $cart->getContent()->toarray());*/
echo "papaa";
exit;


        $checkoutData = [
            'items' => $cartItems,
            'return_url' => route('paypal.success', $orderId),
            'cancel_url' => route('paypal.cancel'),
            'invoice_id' => uniqid(),
            'invoice_description' => " Order description ",
            'total' => $cart->getSubTotal(),
            'shipping_discount' => $cart->getSubTotal() - $cart->getTotal()

        ];

        return $checkoutData;
    }

    public function cancelPage()
    {
        dd('payment failed');
    }


    public function getExpressCheckoutSuccess(Request $request, $orderId)
    {

     

        $token = $request->get('token');
        $payerId = $request->get('PayerID');
        $provider = new ExpressCheckout();
        $checkoutData = $this->checkoutData($orderId);

        $response = $provider->getExpressCheckoutDetails($token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            // Perform transaction on PayPal
            $payment_status = $provider->doExpressCheckoutPayment($checkoutData, $token, $payerId);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

            if(in_array($status, ['Completed','Processed'])) {
                $order = Order::find($orderId);
                $order->is_paid = 1;
                $order->save();

                //send mail

                Mail::to($order->user->email)->send(new OrderPaid($order));


                return redirect()->route('home')->withMessage('Payment successful!');
            }

        }

        return redirect()->route('home')->withError('Payment UnSuccessful! Something went wrong!');


    }

//////

public function wel()
    {


        return view('products.welcome');
    }

public function payment()
    {

  
        $data = [];
        $data['items'] = [
            [
                'name' => 'anitha',
                'price' => 100,
                'desc'  => 'Description',
                'qty' => 1
            ]
        ];
  
        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = 100;

  
        $provider = new ExpressCheckout;
  
        $response = $provider->setExpressCheckout($data);
  
        $response = $provider->setExpressCheckout($data, true);

      
  
        return redirect($response['paypal_link']);
    }
   
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }
  
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $response = $provider->getExpressCheckoutDetails($request->token);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Your payment was successfully. You can create success page here.');
        }
  
        dd('Something is wrong.');
    }

}
