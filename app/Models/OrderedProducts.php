<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'status_id',
        'reason'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }
}
