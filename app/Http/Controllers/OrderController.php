<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Paidorders;
use App\Models\RentCard;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{

    public function index(Request $request)
        {
            $search = $request->search ?? "";
            if($search !=''){
                $orderCard = Payment::where('transaction_id','LIKE',"%$search%")->orwhere('order_number','LIKE',"%$search%")->paginate(10);
            }else{ 
                $orderCard = Payment::orderBy('id', 'DESC')->paginate(10); 
        
            }
                    
            return view('order')->with(compact('orderCard'));
        }

  
        public function show($tran_id){
            $orderdetail = Paidorders::with(['rentpaidOrder','paidOrder'])->where('transaction_id',$tran_id)->orderBy('id', 'DESC')->get();
            // dd($orderdetail);
            return view('order_details')->with(compact('orderdetail'));
          }
}