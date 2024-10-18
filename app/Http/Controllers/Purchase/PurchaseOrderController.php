<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\Purchase\PurchaseOrder;
use App\Models\Misc\Product;
use App\Models\Stock\Stock;

use App\Models\Proformat\Proformat;
use App\Models\Proformat\ProformatItem;

class PurchaseOrderController extends Controller
{
    private $list_view = "pages.purchase-order.list";
    private $create_view = "pages.purchase-order.create";
    private $show_view = "pages.purchase-order.show";

    public function index()
    {
        $orders = PurchaseOrder::orderBy('created_at', 'desc')->get();
        return view($this->list_view, compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view($this->create_view, compact('products'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'buyer_name' => 'required|string|max:255',
            'buyer_address' => 'required|string',
            'buyer_phone' => 'required|string',
            'buyer_email' => 'required|email',
            'product' => 'required|array|min:1', 
            'product.*.id' => 'required|exists:product,id', 
            'product.*.quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->route('purchase_order.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $order = PurchaseOrder::create([
            'order_number' => 'PO' . now()->format('ymd') . rand(1000, 9999),
            'order_date' => now(),
            'buyer_name' => $request->buyer_name,
            'buyer_address' => $request->buyer_address,
            'buyer_phone' => $request->buyer_phone,
            'buyer_email' => $request->buyer_email,
            'total_amount' => 0,
        ]);

        $total_amount = 0;

        foreach ($request->product as $product_data) {
            $product = Product::find($product_data['id']);
            
            $total_price = Product::get_unit_price($product->id)->price_unit * $product_data['quantity'];
            $total_amount += $total_price;

            $order->items()->create([
                'id_product' => $product->id,
                'description' => $product->label,
                'quantity' => $product_data['quantity'],
                'unit_price' => Product::get_unit_price($product->id)->price_unit,
                'total_price' => $total_price,
            ]);
        }

        $order->update(['total_amount' => $total_amount]);

        return redirect()->route('purchase_order.show', $order->id)->with('success', 'Purchase Order created successfully');
    }

    public function show(int $id)
    {
        $purchase_order = PurchaseOrder::find($id);
        return view($this->show_view, compact('purchase_order'));
    }

    public function validate(int $id)
    {
        $purchase_order = PurchaseOrder::find($id);
        
        if (!$purchase_order) {
            return redirect()->back()->with('error', 'Purchase Order not found');
        }

        $items = $purchase_order->items()->get();
        $insufficient_stock = [];

        // Check each item against current stock
        foreach ($items as $item) {
            $stock = Stock::where('id_product', $item->id_product)->first();
            
            if (!$stock) {
                $insufficient_stock[] = [
                    'product' => $item->description,
                    'requested' => $item->quantity,
                    'available' => 0,
                    'product_id' => $item->id_product,
                    'quantity_needed' => $item->quantity
                ];
                continue;
            }

            if ($stock->quantity < $item->quantity) {
                $insufficient_stock[] = [
                    'product' => $item->description,
                    'requested' => $item->quantity,
                    'available' => $stock->quantity,
                    'product_id' => $item->id_product,
                    'quantity_needed' => $item->quantity - $stock->quantity
                ];
            }
        }

        if (count($insufficient_stock) > 0) {
            // Create error message
            $error_message = "Insufficient stock for the following items:\n";
            foreach ($insufficient_stock as $item) {
                $error_message .= "- {$item['product']}: Requested {$item['requested']}, Available {$item['available']}\n";
            }

            // Create a new proforma for insufficient items
            $proforma = Proformat::create([
                'invoice_number' => 'PHH' . now()->format('ymd') . rand(1000, 9999),
                'invoice_date' => now(),
                'buyer_name' => 'Kopetrart Company Inc.',
                'buyer_address' => 'Andoharanofotsy, Tana 101',
                'buyer_phone' => 3459554,
                'buyer_email' => 'kopetrart.company@gmail.com',
                'shipping_cost' => 25.00,
                'total_amount' => 0,
            ]);

            $total_amount = 0;

            // Create proforma items for each insufficient item
            foreach ($insufficient_stock as $item) {
                $product = Product::find($item['product_id']);
                $unit_price = Product::get_unit_price($item['product_id'])->price_unit;
                $total_price = $unit_price * $item['quantity_needed'];
                $total_amount += $total_price;

                ProformatItem::create([
                    'id_proformat' => $proforma->id,
                    'id_product' => $item['product_id'],
                    'description' => $item['product'],
                    'quantity' => $item['quantity_needed'],
                    'unit_price' => $unit_price,
                    'total_price' => $total_price,
                ]);
            }

            $proforma->update(['total_amount' => $total_amount + $proforma->shipping_cost]);

            // Return with both the error message and proforma creation notification
            return redirect()->back()
                ->with('error', $error_message)
                ->with('info', 'A Proforma invoice has been created for the insufficient items (#' . $proforma->invoice_number . ')');
        }

        return redirect()->back()->with('success', 'Stock validation successful. All items are available.');
    }
}