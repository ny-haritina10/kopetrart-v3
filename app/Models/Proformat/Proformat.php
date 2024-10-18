<?php

namespace App\Models\Proformat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proformat extends Model
{
    use HasFactory;

    protected $table = 'proformat';

    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'buyer_name',
        'buyer_address',
        'buyer_phone',
        'buyer_email',
        'total_amount',
        'shipping_cost',
        'status'
    ];

    protected $casts = [
        'invoice_date' => 'date',
    ];

    public function items()
    {
        return $this->hasMany(ProformatItem::class, 'id_proformat');
    }
}