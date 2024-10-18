<?php

namespace App\Models\Sale;

use App\Models\Misc\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Customer\Customer;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_product',
        'id_customer',
        'quantity',
        'sale_date',
        'sale_price'
    ];

    protected $casts = [
        'sale_date' => 'date',
        'sale_price' => 'decimal:2',
    ];

    public function product()
    { 
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}