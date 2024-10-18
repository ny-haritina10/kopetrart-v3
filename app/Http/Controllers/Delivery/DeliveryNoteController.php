<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery\DeliveryNote;
use App\Models\Purchase\PurchaseOrder;

class DeliveryNoteController extends Controller
{
    private $list_view = "pages.delivery-note.list";
    private $create_view = "pages.delivery-note.create";
    private $show_view = "pages.delivery-note.show";

    
    public function index()
    {
        $delivery_notes = DeliveryNote::with('purchaseOrder')
            ->orderBy('created_at', 'desc')
            ->get();
        return view($this->list_view, compact('delivery_notes'));
    }

    public function send($id)
    {
        $delivery_note = DeliveryNote::findOrFail($id);
        $delivery_note->update(['is_sent' => true]);
        
        return redirect()->back()
            ->with('success', 'Le bon de livraison a été envoyé au client avec succès');
    }

    public function create($id_purchase_order)
    {
        $purchase_order = PurchaseOrder::findOrFail($id_purchase_order);
        return view($this->create_view, compact('purchase_order'));
    }

    public function store(Request $request, $id_purchase_order)
    {
        $validated = $request->validate([
            'delivery_date' => 'required|date'
        ]);

        $purchase_order = PurchaseOrder::findOrFail($id_purchase_order);
        
        $delivery_note = DeliveryNote::create([
            'delivery_number' => 'DN' . now()->format('ymd') . rand(1000, 9999),
            'id_purchase_order' => $id_purchase_order,
            'delivery_date' => $validated['delivery_date']
        ]);

        return redirect()->route('delivery_note.show', $delivery_note->id)
            ->with('success', 'Bon de livraison créé avec succès');
    }

    public function show($id)
    {
        $delivery_note = DeliveryNote::with('purchaseOrder.items')->findOrFail($id);
        return view($this->show_view, compact('delivery_note'));
    }
}