<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\Purchase\PurchaseOrder;
use App\Models\Misc\Product;

use App\Models\Proformat\Proformat;
use App\Models\Proformat\ProformatItem;

use App\Services\Purchase\PurchaseOrderService;

class PurchaseOrderController extends Controller
{
    private $list_view = "pages.purchase-order.list";
    private $create_view = "pages.purchase-order.create";
    private $show_view = "pages.purchase-order.show";

    protected $purchase_order_service;
    
    public function __construct(PurchaseOrderService $purchase_order_service)
    {
        $this->purchase_order_service = $purchase_order_service;
    }

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
        $validated = $request->validate([
            'buyer_name' => 'required|string|max:255',
            'buyer_address' => 'required|string',
            'buyer_phone' => 'required|string',
            'buyer_email' => 'required|email',
            'product' => 'required|array|min:1',
            'product.*.id' => 'required|exists:product,id',
            'product.*.quantity' => 'required|integer|min:1',
            'type' => 'required|in:VENTE,ACHAT' 
        ]);

        // Store the purchase order with type
        $order = $this->purchase_order_service->create_order($validated);

        return redirect()->route('purchase_order.show', $order->id)
            ->with('success', 'Purchase Order created successfully');
    }


    public function show(int $id)
    {
        $purchase_order = PurchaseOrder::find($id);
        return view($this->show_view, compact('purchase_order'));
    }

    public function validate(int $id)
    {
        $order = PurchaseOrder::findOrFail($id);

        // check stock if it's a sale
        if ($order->type === 'VENTE')
        {
            $insufficient_stock = $this->purchase_order_service->validate_stock($order);
            
            if (!empty($insufficient_stock)) {
                $error_message = $this->format_insufficient_stock_message($insufficient_stock);
                return redirect()->back()
                    ->with('error', $error_message)
                    ->with('info', 'A Proforma invoice has been created for the insufficient items.');
            }
        }

        $order->update(['is_validated' => true]);
        
        return redirect()->back()
            ->with('success', 'Stock validation successful. All items are available.');
    }

    private function format_insufficient_stock_message(array $insufficient_stock): string
    {
        $message = "Insufficient stock for the following items:\n";
        foreach ($insufficient_stock as $item) {
            $message .= "- {$item['product']}: Requested {$item['requested']}, ";
            $message .= "Available {$item['available']}\n";
        }
        
        return $message;
    }
}