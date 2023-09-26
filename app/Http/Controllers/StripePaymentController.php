<?php
    
namespace App\Http\Controllers;
     
use Illuminate\Http\Request;
use Exception;
use Session;
use Stripe\StripeClient;
use Stripe;
use App\Models\RentCard;
use App\Models\Paidorders;
use App\Models\Payment;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
     
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {

        $payNow = RentCard::where('user_id' , Auth::id())->where('book_status',1)->sum('t_price');
        $data = compact('payNow');
        return view('stripe',$data);
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $stripe = new \Stripe\StripeClient('sk_test_51NqUt4SDt1oMRJsJeb961xWsstvNsks3mUbzAonIb8NdGBvO6Vr4uLwmklalID9NeSPr1EBWxAG8NSqHWSooP2Py00xmlTT8DZ');
        try {
            $payNow = RentCard::where('user_id' , Auth::id())->where('book_status',1)->sum('t_price');
            $orderpaidbook = RentCard::with('bookcart')->where('user_id' , Auth::id())->where('book_status',1)->orderBy('id', 'DESC')->get();
            $stripe = new StripeClient(env('STRIPE_SECRET'));
            $value = $stripe->paymentIntents->create([
                'confirm' => true,
                'amount' =>   $payNow * 100,
                'currency' => 'inr',
                'payment_method' => $request->payment_method,
                'description' => 'Demo payment with stripe',
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never'
                ],
                'off_session' => true,
            ]);
            $this->savepaymentOrders($value,$orderpaidbook);
        } catch (Exception $th) {
            return back()->with('error', "There was a problem processing your payment");
        }
        return to_route('dashboard')->with('success', 'Payment successfully!');
    }

    public function savepaymentOrders($value,$orderpaidbook)
    {
        
        try {
            $status = Payment::create([
                'transaction_id' => $value->id,
                'user_id' => Auth::id(),
                'status' => $value->status, 
                'order_number' =>  'ORD' . Str::random(8),
                'amount' => $value->amount / 100,
            ]);
            if ($status) {
                foreach($orderpaidbook as $paidbook){
                    $p = Paidorders::create([
                        'transaction_id' => $status->id,
                        'order_id' => $paidbook->id,
                        'book_id' => $paidbook->book_id,
                    ]);
                }
               rentCard::where('user_id', Auth::id())->update(['book_status' => 0]); 
            }  
        } catch (Exception $e) {
            return back()->with('error', "There was a problem processing your payment");
        }
    }


    public function return_payment($order_id)
    {

        $returnitems = Paidorders::with(['rentOrder','paidOrder'])->where('order_id',$order_id)->orderBy('id', 'DESC')->first();
        $currentDate = now();
        $orderDate = Carbon::parse($returnitems->created_at);
        $lastreturnDate = $orderDate->addDays($returnitems->rentOrder->days);
        $daysDifference = $currentDate->diffInDays($lastreturnDate);
        $payAmount = $daysDifference * $returnitems->rentOrder->qty * $returnitems->rentOrder->rent_price;
       
        $lastreturnDate = $orderDate->addDays($returnitems->rentOrder->days);
        return view('return_stripe',compact('returnitems','payAmount'));
    }

    public function store(Request $request, $order_id)
    {
        $stripe = new \Stripe\StripeClient('sk_test_51NqUt4SDt1oMRJsJeb961xWsstvNsks3mUbzAonIb8NdGBvO6Vr4uLwmklalID9NeSPr1EBWxAG8NSqHWSooP2Py00xmlTT8DZ');
        try {
            $returnitems = Paidorders::with(['rentOrder','paidOrder'])->where('order_id',$order_id)->orderBy('id', 'DESC')->first();
            $currentDate = now();
            $orderDate = Carbon::parse($returnitems->created_at);
            $lastreturnDate = $orderDate->addDays($returnitems->rentOrder->days);
            $daysDifference = $currentDate->diffInDays($lastreturnDate);
            $payAmount = $daysDifference * $returnitems->rentOrder->qty * $returnitems->rentOrder->rent_price;
            $stripe = new StripeClient(env('STRIPE_SECRET'));
            $value = $stripe->paymentIntents->create([
                'confirm' => true,
                'amount' =>   $payAmount * 100,
                'currency' => 'inr',
                'payment_method' => $request->payment_method,
                'description' => 'Demo payment with stripe',
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never'
                ],
                'off_session' => true,
            ]);
            $this->savereturnpaymentOrders($order_id);
        } catch (Exception $th) {
            return back()->with('error', "There was a problem processing your payment");
        }
        return to_route('dashboard')->with('success', 'Payment successfully!');
    }

    public function savereturnpaymentOrders($order_id){
        RentCard::where('id', $order_id)->update(['return_status' => 1]);
        return redirect()->route('paidorder.index')->with('success', 'Return successfully');
    }
   
}