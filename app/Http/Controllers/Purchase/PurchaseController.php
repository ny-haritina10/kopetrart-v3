<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Purchase\Purchase;
use App\Models\Misc\Product;
use App\Models\Supplier\Supplier;
use App\Models\Stock\Stock;

class PurchaseController extends Controller
{

    private $form_view = 'pages.purchase.form';
    private $list_view = 'pages.purchase.list';


    public function index()
    {
        $purchases = Purchase::with(['product', 'supplier'])->latest()->get();
        return view($this->list_view, compact('purchases'));
    }

    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view($this->form_view, compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'id_product' => 'required|exists:product,id',
            'id_supplier' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'purchase_date' => 'required|date',
        ]);

        $product = Product::findOrFail($validated_data['id_product']);
        $unit_cost = Product::get_selling_price($product->id)->selling_price;

        $validated_data['unit_cost'] = $unit_cost;

        // creathe purchase record and update stocks
        Purchase::create($validated_data);
        Stock::purchase($product->id, $validated_data['quantity']);

        return redirect()->route('purchases.index')->with('success', 'Purchase created successfully.');
    }

    public function edit(Purchase $purchase)
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view($this->form_view, compact('purchase', 'products', 'suppliers'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $validatedData = $request->validate([
            'id_product' => 'required|exists:product,id',
            'id_supplier' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'purchase_date' => 'required|date',
        ]);

        $product = Product::findOrFail($validatedData['id_product']);
        $unit_cost = Product::get_selling_price($product->id)->selling_price;

        $validatedData['unit_cost'] = $unit_cost;
        $purchase->update($validatedData);

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully.');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully.');
    }
}