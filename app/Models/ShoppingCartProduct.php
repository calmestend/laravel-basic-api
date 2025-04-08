<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCartProduct extends Model
{
    protected $fillable = [
        'stock_id',
        'user_id',
        'quantity'
    ];


    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
