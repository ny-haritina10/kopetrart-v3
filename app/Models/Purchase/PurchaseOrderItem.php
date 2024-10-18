<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Misc\Product;

class PurchaseOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_purchase_order',
        'id_product',
        'description',
        'quantity',
        'unit_price',
        'total_price',
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}