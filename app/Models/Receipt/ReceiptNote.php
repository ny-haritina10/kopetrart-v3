<?php

namespace App\Models\Receipt;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Delivery\DeliveryNote;
use App\Models\Invoice\Invoice;

class ReceiptNote extends Model
{
    protected $fillable = [
        'receipt_number',
        'id_delivery_note',
        'receipt_date',
        'is_signed'
    ];

    protected $casts = [
        'receipt_date' => 'datetime',
        'is_signed' => 'boolean'
    ];

    public function deliveryNote(): BelongsTo
    {
        return $this->belongsTo(DeliveryNote::class, 'id_delivery_note');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'id_receipt_note');
    }
}