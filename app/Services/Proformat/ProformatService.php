<?php

namespace App\Services\Proformat;

use App\Models\Proformat\Proformat;
use App\Models\Proformat\ProformatItem;
use App\Models\Misc\Product;

class ProformatService
{
    public function create_proformat(array $data): Proformat
    {
        $proforma = Proformat::create([
            'invoice_number' => $this->generate_invoice_number(),
            'invoice_date' => now(),
            'buyer_name' => $data['buyer_name'],
            'buyer_address' => $data['buyer_address'],
            'buyer_phone' => $data['buyer_phone'],
            'buyer_email' => $data['buyer_email'],
            'shipping_cost' => 25.00,
            'total_amount' => 0,
            'status' => 'Pending'
        ]);

        $total_amount = $this->create_proformat_items($proforma, $data['products']);
        $proforma->update(['total_amount' => $total_amount + $proforma->shipping_cost]);

        return $proforma;
    }

    private function create_proformat_items(Proformat $proforma, array $products): float
    {
        $total_amount = 0;

        foreach ($products as $productData) {
            $product = Product::find($productData['id']);
            $unit_price = Product::get_unit_price($product->id)->price_unit;
            $quantity = $productData['quantity'] ?? 0;
            $total_price = 0;

            if ($quantity === 0)
            { $total_price += $unit_price;  }
            else 
            { $total_price += ($unit_price * $quantity); }

            $total_amount += $total_price;
            ProformatItem::create([
                'id_proformat' => $proforma->id,
                'id_product' => $product->id,
                'description' => $product->label,
                'quantity' => $quantity,
                'unit_price' => $unit_price,
                'total_price' => $total_price,
            ]);
        }

        return $total_amount;
    }

    private function generate_invoice_number(): string
    {
        return 'PHH' . now()->format('ymd') . rand(1000, 9999);
    }
}