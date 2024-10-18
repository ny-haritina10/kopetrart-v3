<?php

namespace App\Models\Proformat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Misc\Product;

class ProformatItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_proformat',
        'id_product',
        'description',
        'quantity',
        'unit_price',
        'total_price',
    ];

    public function proformat()
    {
        return $this->belongsTo(Proformat::class, 'id_proformat');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}