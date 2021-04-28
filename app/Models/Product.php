<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id',
                'subcategory_id',
                'title',
                'slug',
                'price',
                'discount',
                'quantity',
                'unit',
                'shipping',
                'details',
                'status',
                'featured',
    ];

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
}
