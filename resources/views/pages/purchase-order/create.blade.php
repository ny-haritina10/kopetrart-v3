@extends('templates.home')

@section('aside')
    <x-navbar.main active="/purchase_order"></x-navbar.main>
@endsection

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Créer un Bon de Commande</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('purchase_order.store') }}" method="POST" id="purchaseOrderForm">
            @csrf
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4>Informations sur l'Acheteur :</h4>
                    <div class="form-group">
                        <label for="buyer_name">Nom :</label>
                        <input type="text" class="form-control @error('buyer_name') is-invalid @enderror" id="buyer_name" name="buyer_name" value="{{ old('buyer_name') }}" required>
                        @error('buyer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="buyer_address">Adresse :</label>
                        <textarea class="form-control @error('buyer_address') is-invalid @enderror" id="buyer_address" name="buyer_address" required>{{ old('buyer_address') }}</textarea>
                        @error('buyer_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="buyer_phone">Téléphone :</label>
                        <input type="tel" class="form-control @error('buyer_phone') is-invalid @enderror" id="buyer_phone" name="buyer_phone" value="{{ old('buyer_phone') }}" required>
                        @error('buyer_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="buyer_email">Email :</label>
                        <input type="email" class="form-control @error('buyer_email') is-invalid @enderror" id="buyer_email" name="buyer_email" value="{{ old('buyer_email') }}" required>
                        @error('buyer_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <h4>Articles :</h4>
            <div id="products-container">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <select class="form-control product-select @error('products') is-invalid @enderror" name="product_id">
                            <option value="">Sélectionnez un produit</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control product-quantity" name="quantity" min="1">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary add-product">Ajouter</button>
                    </div>
                </div>
                @error('products')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div id="selected-products"></div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">Créer un Bon de Commande</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productsContainer = document.getElementById('products-container');
            const selectedProducts = document.getElementById('selected-products');
            const purchaseOrderForm = document.getElementById('purchaseOrderForm');

            productsContainer.addEventListener('change', function(event) {
                if (event.target.classList.contains('product-select')) {
                    const quantityInput = event.target.closest('.row').querySelector('.product-quantity');
                    quantityInput.disabled = !event.target.value;
                }
            });

            productsContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('add-product')) {
                    const row = event.target.closest('.row');
                    const productSelect = row.querySelector('.product-select');
                    const productId = productSelect.value;
                    const productName = productSelect.options[productSelect.selectedIndex].text;
                    const quantity = row.querySelector('.product-quantity').value;

                    if (productId && quantity > 0) {
                        const productDiv = document.createElement('div');
                        productDiv.className = 'row mb-2';
                        productDiv.innerHTML = `
                            <div class="col-md-6">${productName}</div>
                            <div class="col-md-4">Quantité: ${quantity}</div>
                            <div class="col-md-2"><button type="button" class="btn btn-danger btn-sm remove-product">Supprimer</button></div>
                            <input type="hidden" name="product[${productId}][id]" value="${productId}">
                            <input type="hidden" name="product[${productId}][quantity]" value="${quantity}">
                        `;
                        selectedProducts.appendChild(productDiv);

                        productSelect.value = '';
                        const quantityInput = row.querySelector('.product-quantity');
                        quantityInput.value = 1;
                        quantityInput.disabled = true;
                    }
                }
            });

            selectedProducts.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-product')) {
                    event.target.closest('.row').remove();
                }
            });

            purchaseOrderForm.addEventListener('submit', function(event) {
                if (selectedProducts.children.length === 0) {
                    event.preventDefault();
                    alert('Veuillez sélectionner au moins un produit.');
                }
            });
        });
    </script>
@endsection