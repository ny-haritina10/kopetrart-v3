@extends('templates.home')

@section('aside')
<x-navbar.main active="/receipt_notes"></x-navbar.main>
@endsection

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des Bons de Réception</h2>
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
                            <th>N° Réception</th>
                            <th>N° Livraison</th>
                            <th>N° Commande</th>
                            <th>Client</th>
                            <th>Date de Réception</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($receipt_notes as $receipt_note)
                            <tr>
                                <td>{{ $receipt_note->receipt_number }}</td>
                                <td>{{ $receipt_note->deliveryNote->delivery_number }}</td>
                                <td>{{ $receipt_note->deliveryNote->purchaseOrder->order_number }}</td>
                                <td>{{ $receipt_note->deliveryNote->purchaseOrder->buyer_name }}</td>
                                <td>{{ $receipt_note->receipt_date->format('d/m/Y') }}</td>
                                <td>
                                    @if($receipt_note->is_signed)
                                        <span class="badge bg-success">Signé</span>
                                    @else
                                        <span class="badge bg-warning">En attente</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('receipt_note.show', $receipt_note->id) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                        
                                        @if(!$receipt_note->is_signed)
                                            <form action="{{ route('receipt_note.sign', $receipt_note->id) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="btn btn-success btn-sm"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir signer ce bon de réception?')">
                                                    <i class="fas fa-signature"></i> Signer
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Aucun bon de réception trouvé
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

@push('styles')
<style>
    .table td, .table th {
        vertical-align: middle;
    }
    
    .btn-group {
        gap: 0.25rem;
    }
</style>
@endpush