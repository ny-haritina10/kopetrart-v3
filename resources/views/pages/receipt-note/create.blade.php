@extends('templates.home')

@section('aside')
<x-navbar.main active="/receipt_notes"></x-navbar.main>
@endsection

@section('content')
<div class="container mt-4">
    <h2>Créer un Bon de Réception</h2>
    <h4>Bon de Livraison: {{ $delivery_note->delivery_number }}</h4>

    <form action="{{ route('receipt_note.store', $delivery_note->id) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="receipt_date">Date de Réception</label>
            <input type="date" 
                   class="form-control @error('receipt_date') is-invalid @enderror" 
                   id="receipt_date" 
                   name="receipt_date" 
                   required>
            @error('receipt_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Créer le Bon de Réception</button>
    </form>
</div>
@endsection