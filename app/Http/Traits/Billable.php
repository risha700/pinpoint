<?php


namespace App\Http\Traits;


use App\Order;
use App\OrderProduct;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\App;

trait Billable
{





    public function getNumbers()
    {

        $tax = config('cart.tax')/100;
        $discount = session()->get('coupon')['value']?? 0;
        $discount_code = session()->get('coupon')['name']?? 0;
        $newSubtotal = (Cart::subtotal() - $discount);
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal + $newTax ;
        return collect([

            'discount'=>$discount,
            'discount_code'=>$discount_code,
            'newSubtotal'=>$newSubtotal,
            'newTax'=>$newTax,
            'newTotal'=>$newTotal,

        ]);

    }

    public function persist($request, $error){
        $order = Order::create([
            'user_id'=>auth()->id()?:null,
            'email'=> $request->email,
            'last4'=> $request->last4,
            'name'=> $request->name,
            'phone'=> $request->phone,
            'address'=> $request->address,
            'city'=> $request->city,
            'state'=> $request->state,
            'zip'=> $request->zip,
            'discount'=> $this->getNumbers()->get('discount'),
            'discount_code'=> $this->getNumbers()->get('discount_code'),
            'tax'=> $this->getNumbers()->get('newTax'),
            'subtotal'=> $this->getNumbers()->get('newSubtotal'),
            'total'=> $this->getNumbers()->get('newTotal'),
            'error'=>$error,


        ]);

        foreach (Cart::content() as $item){

            OrderProduct::create([

                'order_id'=>$order->id,
                'product_id'=>$item->model->id,
                'quantity'=>$item->qty,

            ]);
        }

        return $order;
    }


    public function charge($request){


        $content = Cart::instance('default')->content()->map(function ($item){

            return $item->model->slug. ' | ' .$item->qty. ' | '.$item->options;
        })->values()->toJson();

        $originalAmount = Cart::instance('default')->total()/100;
        $newTotal = $this->getNumbers()->get('newTotal')/100;
        $discounted =$this->getNumbers()->get('discount')/100;


        $charge = Stripe::charges()->create([
            'amount' => $discounted ? $newTotal : $originalAmount,
            'source'   => $request->stripeToken,
            'currency' => 'USD',
            'description'   => 'Order',
            'receipt_email'   => $request->email,
            'metadata'   => [
                'original_price'=>$originalAmount,
                'contents'=>$content,
                'quantity'=>Cart::instance('default')->count(),
                'discount'=>$discounted,
                'name'=>$request->name,
                'phone'   => $request->phone,
                'address'=>$request->address,
                'address2'=>$request->address2,
                'zip'=>$request->zip,
                'city'=>$request->city,
                'state'=>$request->state,

            ],
        ]);

    }


    public function generateInvoice($order){


        $pdf = App::make('dompdf.wrapper');
        return $pdf->loadView('pdf.invoice',compact('order'))

            ->save(public_path().'/orders/invoices/invoice'.$order->id.'.pdf');

    }

}