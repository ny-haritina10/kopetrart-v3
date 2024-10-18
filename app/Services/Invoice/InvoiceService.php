<?php

namespace App\Services\Invoice;

use App\Models\Invoice\Invoice;
use App\Models\General\Exercice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceService
{
    public function mark_as_paid(Invoice $invoice)
    {
        DB::beginTransaction();
        
        try {
            $this->update_invoice_status($invoice);
            $this->create_accounting_entries($invoice);
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
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