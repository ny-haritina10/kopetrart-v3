<?php

namespace App\Http\Controllers\Receipt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receipt\ReceiptNote;
use App\Models\Delivery\DeliveryNote;

class ReceiptNoteController extends Controller
{
    private $list_view = "pages.receipt-note.list";
    private $create_view = "pages.receipt-note.create";
    private $show_view = "pages.receipt-note.show";

    public function index()
    {
        $receipt_notes = ReceiptNote::with(['deliveryNote.purchaseOrder'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view($this->list_view, compact('receipt_notes'));
    }

    public function create($id_delivery_note)
    {
        $delivery_note = DeliveryNote::with('purchaseOrder.items')->findOrFail($id_delivery_note);
        return view($this->create_view, compact('delivery_note'));
    }

    public function store(Request $request, $id_delivery_note)
    {
        $validated = $request->validate([
            'receipt_date' => 'required|date'
        ]);

        $delivery_note = DeliveryNote::findOrFail($id_delivery_note);
        
        $receipt_note = ReceiptNote::create([
            'receipt_number' => 'RN' . now()->format('ymd') . rand(1000, 9999),
            'id_delivery_note' => $id_delivery_note,
            'receipt_date' => $validated['receipt_date']
        ]);

        return redirect()->route('receipt_note.show', $receipt_note->id)
            ->with('success', 'Bon de réception créé avec succès');
    }

    public function show($id)
    {
        $receipt_note = ReceiptNote::with('deliveryNote.purchaseOrder.items')
            ->findOrFail($id);
        return view($this->show_view, compact('receipt_note'));
    }

    public function sign($id)
    {
        $receipt_note = ReceiptNote::findOrFail($id);
        $receipt_note->update(['is_signed' => true]);
        
        return redirect()->back()
            ->with('success', 'Le bon de réception a été signé avec succès');
    }
}