<?php

namespace App\Services\Invoice;

use App\Models\Invoice\Invoice;
use App\Models\General\Exercice;
use App\Models\Sale\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Stock\Stock;
use App\Models\Purchase\Purchase;
use App\Models\Misc\Product;

class InvoiceService
{
    public function mark_as_paid(Invoice $invoice)
    {
        DB::beginTransaction();
        try {
            $this->update_invoice_status($invoice);
            $this->create_accounting_entries($invoice);

            foreach($invoice->receiptNote->deliveryNote->purchaseOrder->items as $item)
            {
                if ($invoice->receiptNote->deliveryNote->purchaseOrder->type === 'ACHAT')
                {
                    $validated_data = [
                        'id_product' => $item->id_product,
                        'id_supplier' => 1,     // fix supplier id for now
                        'quantity' => $item->quantity,
                        'purchase_date' => $invoice->receiptNote->deliveryNote->purchaseOrder->order_date,
                    ];

                    $product = Product::findOrFail($validated_data['id_product']);
                    $unit_cost = Product::get_selling_price($product->id)->selling_price;

                    $validated_data['unit_cost'] = $unit_cost;
    
                    Purchase::create($validated_data);
                    Stock::purchase($item->id_product, $item->quantity);
                }

                else if ($invoice->receiptNote->deliveryNote->purchaseOrder->type === 'VENTE')
                {
                    $validated_data = [
                        'id_product' => $item->id_product,
                        'id_customer' => 1,  // fix customers for now
                        'quantity' => $item->quantity,
                        'sale_date' => $invoice->receiptNote->deliveryNote->purchaseOrder->order_date,
                    ];

                    $sale_price = Product::get_selling_price($validated_data['id_product'])->selling_price;
                    $validated_data['sale_price'] = $sale_price;
    
                    Sale::create($validated_data);
                    Stock::sale($item->id_product, $item->quantity);
                }
            }
            
            DB::commit();
            return true;
        } 
        
        catch (\Exception $e) {
            DB::rollback();
            Log::error('Mark as paid error log: ' . $e->getMessage());
            throw $e;
        }
    }

    private function update_invoice_status(Invoice $invoice)
    {
        $invoice->update(['is_paid' => true]);
    }

    private function create_accounting_entries(Invoice $invoice)
    {
        $this->create_debit_entry($invoice);
        $this->create_credit_entry($invoice);
    }

    private function create_debit_entry(Invoice $invoice)
    {
        Exercice::create([
            'no_account' => 512, // Bank account
            'id_exercice_year' => 1,
            'label' => "Paiement facture " . $invoice->invoice_number,
            'debit' => $invoice->total_amount,
            'credit' => 0,
            'date' => now(),
        ]);
    }

    private function create_credit_entry(Invoice $invoice)
    {
        Exercice::create([
            'no_account' => 411, // Client account
            'id_exercice_year' => 1,
            'label' => "Paiement facture " . $invoice->invoice_number,
            'debit' => 0,
            'credit' => $invoice->total_amount,
            'date' => now(),
        ]);
    }
}