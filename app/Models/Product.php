<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory;
    use Searchable;
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

    public function searchableAs()
    {
        return 'tajamandi_products';
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
}
