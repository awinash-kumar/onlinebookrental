<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Book;
use App\Models\RentCard;

class DashboardController extends Controller
{
    
    public function index(Request $request)
    {
        if (Auth::user()->role_id == 1) {
            $totalUsers = User::where('role_id', 2)->count();
            $totalbook = Book::count();
            $totalMarketPrice = Book::sum('market_price');
            $totalRentalbook = RentCard::count();
            $custmor = User::where('role_id', 2)->OrderBy('id', 'DESC')->paginate(10);
            $data = compact('custmor', 'totalUsers', 'totalbook', 'totalMarketPrice','totalRentalbook');
            return view('dashboard', $data);
        } else {
            // dd($request);
            $search = $request->search ?? "";
            if($search !=''){
                $book = Book::with('userCart')->where('title','LIKE',"%$search%")->orderBy('id', 'DESC')->paginate(12);
            }else{
                $book = Book::with('userCart')->orderBy('id', 'DESC')->paginate(12);
            }
           
            $data = compact('book');
            return view('user', $data);
        }
    }

}
