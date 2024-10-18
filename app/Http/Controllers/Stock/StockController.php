<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Stock\Stock;
use App\Models\Misc\Product;

class StockController extends Controller
{

    private $list_view = 'pages.stock.list';
    private $form_view = 'pages.stock.form';

    public function index()
    {
        $stocks = Stock::with('product')->get();
        return view($this->list_view, compact('stocks'));
    }

    public function create()
    {
        $products = Product::all();
        return view($this->form_view, compact('products'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'id_product' => 'required|exists:product,id|unique:stocks,id_product',
            'quantity' => 'required|integer|min:0',
        ]);

        Stock::create($validated_data);

        return redirect()->route('stocks.index')->with('success', 'Stock entry created successfully.');
    }

    public function edit(Stock $stock)
    {
        return view($this->form_view, compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $validated_data = $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $stock->update($validated_data);

        return redirect()->route('stocks.index')->with('success', 'Stock entry updated successfully.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Stock entry deleted successfully.');
    }
}