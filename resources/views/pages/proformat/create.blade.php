@extends('templates.home')

@section('aside')
    <x-navbar.main active="/proformat"></x-navbar.main>
@endsection

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Créer une Facture Proforma</h1>

        <form action="{{ route('proformat.store') }}" method="POST" id="proformaForm">
            @csrf
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4>Informations sur l'Acheteur :</h4>
                    <div class="form-group">
                        <label for="buyer_name">Nom :</label>
                        <input type="text" class="form-control" id="buyer_name" name="buyer_name" required>
                    </div>
                    <div class="form-group">
                        <label for="buyer_address">Adresse :</label>
                        <textarea class="form-control" id="buyer_address" name="buyer_address" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="buyer_phone">Téléphone :</label>
                        <input type="tel" class="form-control" id="buyer_phone" name="buyer_phone" required>
                    </div>
                    <div class="form-group">
                        <label for="buyer_email">Email :</label>
                        <input type="email" class="form-control" id="buyer_email" name="buyer_email" required>
                    </div>
                </div>
            </div>

            <h4>Articles :</h4>
            <div id="products-container">
                <div class="row mb-3">
                    @foreach($products as $product)
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="product_ids[]" value="{{ $product->id }}" id="product-{{ $product->id }}">
                                <label class="form-check-label" for="product-{{ $product->id }}">
                                    {{ $product->label }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Créer une Facture Proforma</button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#proformaForm').on('submit', function(e) {
                if ($('input[name="product_ids[]"]:checked').length === 0) {
                    e.preventDefault();
                    alert('Veuillez sélectionner au moins un produit.');
                }
            });
        });
    </script>
    @endpush
@endsection