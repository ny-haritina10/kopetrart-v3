@extends('templates.home')

@section('aside')
<x-navbar.main active="/invoice"></x-navbar.main>
@endsection

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des Factures</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>N° Facture</th>
                            <th>Client</th>
                            <th>Date Facture</th>
                            <th>Montant Total</th>
                            <th>Statut</th>
                            <th>Date Échéance</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->invoice_number }}</td>
                                <td>{{ $invoice->receiptNote->deliveryNote->purchaseOrder->buyer_name }}</td>
                                <td>{{ $invoice->invoice_date->format('d/m/Y') }}</td>
                                <td>{{ number_format($invoice->total_amount, 2) }} €</td>
                                <td>
                                    @if($invoice->is_paid)
                                        <span class="badge bg-success">Payée</span>
                                    @else
                                        <span class="badge bg-warning">En attente</span>
                                    @endif
                                </td>
                                <td>{{ $invoice->payment_due_date->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('invoice.show', $invoice->id) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                        
                                        @if(!$invoice->is_paid)
                                            <form action="{{ route('invoice.mark_paid', $invoice->id) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="btn btn-success btn-sm"
                                                        onclick="return confirm('Confirmer le paiement de cette facture?')">
                                                    <i class="fas fa-check"></i> Marquer payée
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Aucune facture trouvée
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection