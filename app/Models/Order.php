<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_num',
        'order_status',
    ];

    public function orderCarts()
    {
        return $this->hasMany(RentCard::class, 'user_id', 'user_id');
    }
}
