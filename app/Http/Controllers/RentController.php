<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentCard;
use App\Models\Book;
use App\Models\Paidorders;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RentController extends Controller
{
    public function index(){
      $bookCart = RentCard::with('bookcart')->where('user_id' , Auth::id())->where('book_status',1)->orderBy('id', 'DESC')->get();
      return  view('addtocart',compact('bookCart'));
    }


      public function contact_us(){
        return  view('contact_us');
      }

      public function about_us(){
        return  view('about_us');
      }

    public function rentNow($bookId){
        $user = Auth::user();
        $book = Book::find($bookId);
        $rentalPrice = $book->market_price * 0.10;
        $existingRentCard = RentCard::where('user_id', $user->id)->where('book_status',1)
        ->where('book_id', $book->id)
        ->first();
        if ($existingRentCard) {
              $existingRentCard->qty = 1; 
              $existingRentCard->save();
      } else {
        $rentCard = new RentCard([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'qty' => 1, // Default value
            'days' => 1, // Default value
            'book_status' => 1, // Default value
            'return_status' => 0, // Default value
            'rent_price' => $rentalPrice,
            't_price' => $rentalPrice, // Initially, t_price is the same as rental_price
        ]);
          $rentCard->save();
      }
        return redirect()->route('dashboard')->with('success', 'Book add to cart successfully');
    }

    // public function delete($rent_ids){
    //   $rent_id = decrypt($rent_ids);
    //     $user = Auth::user();
    //     if (!empty($rent_id)) {
    //       $bookcart = RentCard::find($rent_id);
    //       if($bookcart!=''){
    //         $bookcart->delete();
    //         return redirect()->route('addcart')->with('success', 'Remove successfully');
    //     }      
    //     }
    //     return redirect()->back()->with('success', 'Invalid book ID or book not found');
      
    //   }

      public function delete($rent_ids) {
        try {
            $rent_id = decrypt($rent_ids);
    
            if (!empty($rent_id)) {
                $bookcart = RentCard::find($rent_id);
    
                if ($bookcart != null) {
                    $bookcart->delete();
                    return redirect()->route('addcart')->with('success', 'Remove successfully');
                }
            }
    
            return abort(404);;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
           abort(404);
        }
    }
    

public function updateRentCart(Request $request)
{

    $userId = auth()->user()->id;
    $Id = $request->input('id');
    $bookId = $request->input('bookId');
    $quantity = $request->input('quantity');
    $day = $request->input('day');
    $total = $request->input('total');

    $rentCart = RentCard::where('user_id', $userId)->where('id',$Id)->where('book_id', $bookId)->first();

    if ($rentCart) {
        $rentCart->qty = $quantity;
        $rentCart->days = $day;
        $rentCart->t_price = $total;
        $rentCart->save();
        
        return response()->json(['message' => 'RentCart updated successfully']);
    } else {
        return response()->json(['message' => 'RentCart not found'], 404);
    }
}

public function return_book($order_id){
  $returnitems = Paidorders::with(['rentOrder','paidOrder'])->where('order_id',$order_id)->orderBy('id', 'DESC')->first();
  $currentDate = now();
  $orderDate = Carbon::parse($returnitems->created_at);
 
  $lastreturnDate = $orderDate->addDays($returnitems->rentOrder->days);
 
      if ($currentDate->greaterThan($lastreturnDate)) {
        $daysDifference = $currentDate->diffInDays($lastreturnDate);
        $payAmount = $daysDifference * $returnitems->rentOrder->qty * $returnitems->rentOrder->rent_price;
        return  view('return_book',compact('returnitems','daysDifference','payAmount'));
      
      }else{
        $daysDifference = 0; 
        $payAmount = $daysDifference * $returnitems->rentOrder->qty * $returnitems->rentOrder->rent_price;
        return  view('return_book',compact('returnitems','daysDifference','payAmount'));
      }
}

public function store(Request $request, $order_id){
  RentCard::where('id', $order_id)->update(['return_status' => 1]);
  return redirect()->route('paidorder.index')->with('success', 'Return successfully');
}


}