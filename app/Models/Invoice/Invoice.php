<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Receipt\ReceiptNote;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'id_receipt_note',
        'invoice_date',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'total_amount',
        'payment_method',
        'is_paid',
        'payment_due_date'
    ];

    protected $casts = [
        'invoice_date' => 'datetime',
        'payment_due_date' => 'datetime',
        'is_paid' => 'boolean',
        'subtotal' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2'
    ];

    public function receiptNote(): BelongsTo
    {
        return $this->belongsTo(ReceiptNote::class, 'id_receipt_note');
    }
}