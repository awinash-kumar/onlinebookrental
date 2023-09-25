<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Paidorders extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'order_id',
        'book_id',
       
    ];

    protected $table = "paidorder";
    public function rentOrder()
    {
        return $this->belongsTo(RentCard::class, 'order_id')->where('user_id', Auth::id())->where('book_status',0);
    }

    public function rentpaidOrder()
    {
        return $this->belongsTo(RentCard::class, 'order_id')->where('book_status',0);
    }


    public function paidOrder()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
