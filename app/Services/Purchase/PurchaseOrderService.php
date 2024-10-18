<?php

namespace App\Services\Purchase;

use App\Models\Purchase\PurchaseOrder;
use App\Models\Stock\Stock;
use App\Models\Misc\Product;
use App\Services\Proformat\ProformatService;

class PurchaseOrderService
{
    protected $proformat_service;

    public function __construct(ProformatService $proformat_service)
    {
        $this->proformat_service = $proformat_service;
    }

    public function create_order(array $data): PurchaseOrder
    {
        $order = PurchaseOrder::create([
            'order_number' => $this->generate_order_number(),
            'order_date' => now(),
            'buyer_name' => $data['buyer_name'],
            'buyer_address' => $data['buyer_address'],
            'buyer_phone' => $data['buyer_phone'],
            'buyer_email' => $data['buyer_email'],
            'total_amount' => 0,
        ]);

        $total_amount = $this->create_order_items($order, $data['product']);
        $order->update(['total_amount' => $total_amount]);

        return $order;
    }

    public function validate_stock(PurchaseOrder $order): array
    {
        $items = $order->items()->get();
        $insufficient_stock = [];
        
        foreach ($items as $item) {
            $stock = Stock::where('id_product', $item->id_product)->first();
            
            if (!$stock || $stock->quantity < $item->quantity) {
                $insufficient_stock[] = [
                    'id' => $item->id_product,
                    'product' => $item->description,
                    'requested' => $item->quantity,
                    'available' => $stock ? $stock->quantity : 0,
                    'quantity_needed' => $stock ? 
                        $item->quantity - $stock->quantity : 
                        $item->quantity
                ];
            }
        }

        if (!empty($insufficient_stock)) {
            $this->create_proformat_for_insufficient_stock($order, $insufficient_stock);
        }

        return $insufficient_stock;
    }

    private function create_proformat_for_insufficient_stock(PurchaseOrder $order, array $insufficient_stock): void 
    {
        $proformatData = [
            'buyer_name' => $order->buyer_name,
            'buyer_address' => $order->buyer_address,
            'buyer_phone' => $order->buyer_phone,
            'buyer_email' => $order->buyer_email,
            'products' => array_map(function($item) {
                return [
                    'id' => $item['id'],
                    'quantity' => $item['quantity_needed']
                ];
            }, $insufficient_stock)
        ];

        $this->proformat_service->create_proformat($proformatData);
    }

    private function create_order_items(PurchaseOrder $order, array $products): float
    {
        $total_amount = 0;

        foreach ($products as $product_data) {
            $product = Product::find($product_data['id']);
            $unit_price = Product::get_unit_price($product->id)->price_unit;
            $total_price = $unit_price * $product_data['quantity'];
            $total_amount += $total_price;

            $order->items()->create([
                'id_product' => $product->id,
                'description' => $product->label,
                'quantity' => $product_data['quantity'],
                'unit_price' => $unit_price,
                'total_price' => $total_price,
            ]);
        }

        return $total_amount;
    }

    private function generate_order_number(): string
    {
        return 'PO' . now()->format('ymd') . rand(1000, 9999);
    }
}