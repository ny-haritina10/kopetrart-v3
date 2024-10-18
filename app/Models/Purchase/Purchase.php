<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier\Supplier;

use App\Models\Misc\Product;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['id_product', 'id_supplier', 'quantity', 'purchase_date', 'unit_cost'];

    protected $casts = [
        'purchase_date' => 'date',
        'unit_cost' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }
}