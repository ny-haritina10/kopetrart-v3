<?php

namespace App\Http\Controllers\Proformat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Misc\Product;
use App\Models\Proformat\ProformatItem;
use App\Models\Proformat\Proformat;

class ProformatController extends Controller
{
    private $show_view = "pages.proformat.show";
    private $create_view = "pages.proformat.create";
    private $list_view = "pages.proformat.list";  

    public function index()  
    {
        $data = Proformat::orderBy('invoice_date', 'desc')->get();
        return view($this->list_view, compact('data'));
    }

    public function accept($id)
    {
        $proforma = Proformat::find($id);

        if (!$proforma) {
            return redirect()->route('proformat.index')->with('error', 'Proforma not found.');
        }

        $proforma->update(['status' => 'Accepted']);

        return redirect()->route('proformat.index')->with('success', 'Proforma accepted and sent to Client successfully.');
    }

    public function reject($id)
    {
        $proforma = Proformat::find($id);

        if (!$proforma) {
            return redirect()->route('proformat.index')->with('error', 'Proforma not found.');
        }
        
        $proforma->delete();

        return redirect()->route('proformat.index')->with('success', 'Proforma rejected and deleted successfully.');
    }

    public function show(int $id)
    {
        $proforma = Proformat::find($id);
        return view($this->show_view, compact('proforma'));
    }

    public function create()
    {
        $products = Product::list();
        return view($this->create_view, compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buyer_name' => 'required',
            'buyer_address' => 'required',
            'buyer_phone' => 'required',
            'buyer_email' => 'required|email',
            'product_ids' => 'required|array',
            'product_ids.*' => 'required|exists:product,id',
        ]);

        $proforma = Proformat::create([
            'invoice_number' => 'PHH' . now()->format('ymd') . rand(1000, 9999),
            'invoice_date' => now(),
            'buyer_name' => $request->buyer_name,
            'buyer_address' => $request->buyer_address,
            'buyer_phone' => $request->buyer_phone,
            'buyer_email' => $request->buyer_email,
            'shipping_cost' => 25.00,
            'total_amount' => 0,
        ]);

        $total_amount = 0;

        foreach ($request->product_ids as $productId) {
            $product = Product::find($productId);
            $unit_price = Product::get_unit_price($productId)->price_unit;
            $total_price = $unit_price; 
            $total_amount += $total_price;

            ProformatItem::create([
                'id_proformat' => $proforma->id,
                'id_product' => $productId,
                'description' => $product->label,
                'quantity' => 0,
                'unit_price' => $unit_price,
                'total_price' => $total_price,
            ]);
        }

        $proforma->update(['total_amount' => $total_amount + $proforma->shipping_cost]);
        return redirect()->route('proformat.index')->with('success', 'Proforma invoice created successfully');
    }
}