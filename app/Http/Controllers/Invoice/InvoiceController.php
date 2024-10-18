<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Invoice\Invoice;
use App\Models\Receipt\ReceiptNote;

class InvoiceController extends Controller
{
    private $list_view = "pages.invoice.list";
    private $create_view = "pages.invoice.create";
    private $show_view = "pages.invoice.show";

    public function index()
    {
        $invoices = Invoice::with('receiptNote.deliveryNote.purchaseOrder')
            ->orderBy('created_at', 'desc')
            ->get();
        return view($this->list_view, compact('invoices'));
    }

    public function create($id_receipt_note)
    {
        $receipt_note = ReceiptNote::with('deliveryNote.purchaseOrder.items')
            ->findOrFail($id_receipt_note);
        return view($this->create_view, compact('receipt_note'));
    }

    public function store(Request $request, $id_receipt_note)
    {
        $validated = $request->validate([
            'payment_method' => 'required|string',
            'payment_due_date' => 'required|date',
            'tax_rate' => 'required|numeric|min:0|max:100'
        ]);

        $receipt_note = ReceiptNote::with('deliveryNote.purchaseOrder.items')
            ->findOrFail($id_receipt_note);

        // Calculate totals
        $subtotal = $receipt_note->deliveryNote->purchaseOrder->items->sum(function($item) {
            return $item->quantity * $item->unit_price;
        });
        
        $tax_amount = ($subtotal * $validated['tax_rate']) / 100;
        $total_amount = $subtotal + $tax_amount;

        $invoice = Invoice::create([
            'invoice_number' => 'INV' . now()->format('ymd') . rand(1000, 9999),
            'id_receipt_note' => $id_receipt_note,
            'invoice_date' => now(),
            'payment_due_date' => $validated['payment_due_date'],
            'payment_method' => $validated['payment_method'],
            'subtotal' => $subtotal,
            'tax_rate' => $validated['tax_rate'],
            'tax_amount' => $tax_amount,
            'total_amount' => $total_amount
        ]);

        return redirect()->route('invoice.show', $invoice->id)
            ->with('success', 'Facture créée avec succès');
    }

    public function show($id)
    {
        $invoice = Invoice::with('receiptNote.deliveryNote.purchaseOrder.items')
            ->findOrFail($id);
        return view($this->show_view, compact('invoice'));
    }

    public function mark_as_paid($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update(['is_paid' => true]);
        
        return redirect()->back()
            ->with('success', 'La facture a été marquée comme payée');
    }
}