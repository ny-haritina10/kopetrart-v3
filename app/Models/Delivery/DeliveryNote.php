<?php

namespace App\Models\Delivery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase\PurchaseOrder;
use App\Models\Receipt\ReceiptNote;

class DeliveryNote extends Model
{
    protected $fillable = [
        'delivery_number',
        'id_purchase_order',
        'delivery_date',
        'is_sent'
    ];

    protected $casts = [
        'delivery_date' => 'datetime'
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'id_purchase_order');
    }

    public function receiptNote()
    {
        return $this->hasOne(ReceiptNote::class, 'id_delivery_note');
    }
}
