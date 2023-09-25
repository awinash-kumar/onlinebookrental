<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RentCard extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'book_id',
        'qty',
        'days',
        'book_status',
        'return_status',
        'rent_price',
        't_price',
    ];

    public function bookcart()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

}
