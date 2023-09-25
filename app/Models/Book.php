<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
        'description',
        'cover_image',
        'market_price',
    ];

    public function userCart(){
        return $this->hasOne(RentCard::class, 'book_id')->where('user_id', Auth::id())->where('book_status',1);
    }

    
}
