<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleStock extends Model
{
    protected $fillable = [
        'stock_id',
        'sale_id',
        'quantity'
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
