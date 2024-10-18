<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Purchase\PurchaseOrderItem;
class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'order_date',
        'buyer_name',
        'buyer_address',
        'buyer_phone',
        'buyer_email',
        'total_amount',
    ];

    protected $casts = [
        'order_date' => 'date',
    ];

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }
}