<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Stock\Stock;
use Illuminate\Http\Request;

use App\Models\Misc\Product;
use App\Models\Customer\Customer;
use App\Models\Sale\Sale;

class SaleController extends Controller
{

    private $form_view = 'pages.sale.form';
    private $list_view = 'pages.sale.list';

    public function index()
    {
        $sales = Sale::with(['product', 'customer'])->latest()->get();
        return view($this->list_view, compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        $customers = Customer::all();
        return view($this->form_view, compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'id_product' => 'required|exists:product,id',
            'id_customer' => 'required|exists:customers,id',
            'quantity' => 'required|integer|min:1',
            'sale_date' => 'required|date',
        ]);

        $sale_price = Product::get_selling_price($validated_data['id_product'])->selling_price;
        $validated_data['sale_price'] = $sale_price;

        Sale::create($validated_data);
        Stock::sale($validated_data['id_product'], $validated_data['quantity']);

        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
    }

    public function edit(Sale $sale)
    {
        $products = Product::all();
        $customers = Customer::all();
        return view($this->form_view, compact('sale', 'products', 'customers'));
    }

    public function update(Request $request, Sale $sale)
    {
        $validated_data = $request->validate([
            'id_product' => 'required|exists:product,id',
            'id_customer' => 'required|exists:customers,id',
            'quantity' => 'required|integer|min:1',
            'sale_date' => 'required|date',
        ]);

        $sale_price = Product::get_selling_price($validated_data['id_product'])->selling_price;
        $validated_data['sale_price'] = $sale_price;

        $sale->update($validated_data);

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}