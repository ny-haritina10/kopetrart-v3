<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use App\Models\Misc\Product;
use App\Models\Misc\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $list_view = 'pages.product.list';
    private $form_view = 'pages.product.form';
    /**
     * Display a listing of the resource.
     */
    public function index()
    { return view($this->list_view)->with('data', Product::list()); }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view($this->form_view)->with([
            'item' => Product::find($id),
            'units' => Unit::options(),
            'form_action' => '/product/'.$id,
            'form_method' => 'PUT',
            'form_title' => 'Modification du Produit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'label' => 'required|string',
            'id-unit' => 'required|exists:unit,id',
            'quantity' => 'required|numeric|gte:0',
        ]);

        $product = Product::find($id);
        $product->label = trim($request->input('label'));
        $product->id_unit = trim($request->input('id-unit'));
        $product->quantity = trim($request->input('quantity'));

        $product->save();

        return redirect('/product')->with('success', 'Produit modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
