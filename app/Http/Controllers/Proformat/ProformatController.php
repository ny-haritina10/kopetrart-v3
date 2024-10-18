<?php

namespace App\Http\Controllers\Proformat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Misc\Product;
use App\Models\Proformat\ProformatItem;
use App\Models\Proformat\Proformat;

use App\Services\Proformat\ProformatService;

class ProformatController extends Controller
{
    private $show_view = "pages.proformat.show";
    private $create_view = "pages.proformat.create";
    private $list_view = "pages.proformat.list";  

    protected $proformat_service;
    
    public function __construct(ProformatService $proformat_service)
    {
        $this->proformat_service = $proformat_service;
    }

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
        $validated = $request->validate([
            'buyer_name' => 'required',
            'buyer_address' => 'required',
            'buyer_phone' => 'required',
            'buyer_email' => 'required|email',
            'product_ids' => 'required|array',
            'product_ids.*' => 'required|exists:product,id',
        ]);

        $products = array_map(function($id) {
            return ['id' => $id];
        }, $validated['product_ids']);

        $proforma = $this->proformat_service->create_proformat([
            'buyer_name' => $validated['buyer_name'],
            'buyer_address' => $validated['buyer_address'],
            'buyer_phone' => $validated['buyer_phone'],
            'buyer_email' => $validated['buyer_email'],
            'products' => $products
        ]);

        return redirect()->route('proformat.index')
            ->with('success', 'Proforma invoice created successfully');
    }
}