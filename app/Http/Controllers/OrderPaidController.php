<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Paidorders;
use App\Models\RentCard;
use Illuminate\Support\Facades\Auth;

class OrderPaidController extends Controller
{
    public function index(Request $request){
       $search = $request->search ?? "";
       if($search !=''){
        $paidOrders = Payment::where('transaction_id','LIKE',"%$search%")->orwhere('order_number','LIKE',"%$search%")->get();

      }else{ 
        $paidOrders = Payment::where('user_id' , Auth::id())->orderBy('id', 'DESC')->get();
      }
        
        return  view('paidorder',compact('paidOrders'));
      }

      public function show($id){
      $orderdetail = Paidorders::with(['rentOrder','paidOrder'])->where('transaction_id',$id)->orderBy('id', 'DESC')->get();
     return view('paidorderdetails')->with(compact('orderdetail'));
      }
}
