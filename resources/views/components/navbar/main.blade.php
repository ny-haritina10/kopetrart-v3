<div class="fx__navbar shadow">
    <div class="fx__navbar-brand"> 
        <h1> <a href="/cost/center/detail"> Kopetrart </a> </h1> <br>

        <div class="head" style="text-align: left; padding-left: 10%">
            <p> 
                <i class="fas fa-user-tie"></i>
                Connecté: <b>{{ auth()->user()->role->label }}</b>
            </p> 
            
            <p>
                <i class="fas fa-sign-out-alt"></i>            
                <a href="/logout"> Déconnexion </a>
            </p>
        </div>
    </div>

    <div class="fx__navbar-section">
        <h3 class="fx__navbar-subtitle"> Admin </h3>
        <ul class="fx__navbar-list">
            <x-navbar.item href="/roles" :active="$active"> <i class="fas fa-users-cog"></i> Role </x-navbar.item>
        </ul>
    </div>

    <div class="fx__navbar-section">
        <h3 class="fx__navbar-subtitle"> Proformat </h3>
        <ul class="fx__navbar-list">
            <x-navbar.item href="{{ route('proformat.create') }}" :active="$active"> 
                <i class="fas fa-file-invoice"></i> Demande de proformat 
            </x-navbar.item>
            <x-navbar.item href="{{ route('proformat.index') }}" :active="$active"> 
                <i class="fas fa-list-alt"></i> Liste Proformat  
            </x-navbar.item>
        </ul>
    </div>

    <div class="fx__navbar-section">
        <h3 class="fx__navbar-subtitle"> Bon de commande </h3>
        <ul class="fx__navbar-list">
            <x-navbar.item href="{{ route('purchase_order.create') }}" :active="$active"> 
                <i class="fas fa-file-signature"></i>Création bon de commande 
            </x-navbar.item>
            <x-navbar.item href="{{ route('purchase_order.index') }}" :active="$active"> 
                <i class="fas fa-clipboard-list"></i>Liste bon de commande  
            </x-navbar.item>
        </ul>
    </div>

    <div class="fx__navbar-section">
        <h3 class="fx__navbar-subtitle"> Bon de livraison </h3>
        <ul class="fx__navbar-list">
            <x-navbar.item href="{{ route('delivery_note.index') }}" :active="$active"> 
                <i class="fas fa-clipboard-list"></i>Liste bon de livraison  
            </x-navbar.item>
        </ul>
    </div>

    <div class="fx__navbar-section">
        <h3 class="fx__navbar-subtitle"> Bon de réception </h3>
        <ul class="fx__navbar-list">
            <x-navbar.item href="{{ route('receipt_note.index') }}" :active="$active"> 
                <i class="fas fa-clipboard-list"></i>Liste bon de réception  
            </x-navbar.item>
        </ul>
    </div>
    
    <div class="fx__navbar-section">
        <h3 class="fx__navbar-subtitle"> Achat </h3>
        <ul class="fx__navbar-list">
            <x-navbar.item href="{{ route('purchases.create') }}" :active="$active"> 
                <i class="fas fa-shopping-cart"></i>Achat produit 
            </x-navbar.item>
            <x-navbar.item href="{{ route('purchases.index') }}" :active="$active"> 
                <i class="fas fa-list"></i>Liste achat  
            </x-navbar.item>
        </ul>
    </div>

    <div class="fx__navbar-section">
        <h3 class="fx__navbar-subtitle"> Vente </h3>
        <ul class="fx__navbar-list">
            <x-navbar.item href="{{ route('sales.create') }}" :active="$active"> 
                <i class="fas fa-cash-register"></i>Vente produit 
            </x-navbar.item>
            <x-navbar.item href="{{ route('sales.index') }}" :active="$active"> 
                <i class="fas fa-receipt"></i>Liste vente  
            </x-navbar.item>
        </ul>
    </div>

    <div class="fx__navbar-section">
        <h3 class="fx__navbar-subtitle"> Stock </h3>
        <ul class="fx__navbar-list">
            <x-navbar.item href="{{ route('stocks.create') }}" :active="$active"> 
                <i class="fas fa-box"></i>Stock initial 
            </x-navbar.item>
        </ul>

        <ul class="fx__navbar-list">
            <x-navbar.item href="{{ route('stocks.index') }}" :active="$active"> 
                <i class="fas fa-warehouse"></i>Etat de stock 
            </x-navbar.item>
        </ul>
    </div>

    <div class="fx__navbar-section">
        <h3 class="fx__navbar-subtitle"> Général </h3>
        <ul class="fx__navbar-list">
            <x-navbar.item href="/exercice" :active="$active"> <i class="fas fa-book"></i> Ecriture </x-navbar.item>
            <x-navbar.item href="/expense" :active="$active"> <i class="fas fa-file-invoice-dollar"></i> Charge </x-navbar.item>
        </ul>
    </div>

    <div class="fx__navbar-section">
        <h3 class="fx__navbar-subtitle"> Coûts </h3>
        <ul class="fx__navbar-list">
            <x-navbar.item href="/cost/expense" :active="$active"> <i class="fas fa-calculator"></i> Coût Unitaire Charge </x-navbar.item>
            <x-navbar.item href="/cost/product" :active="$active"> <i class="fas fa-tags"></i> Coût Unitaire Produit </x-navbar.item>
            <x-navbar.item href="/cost/center/detail" :active="$active"> <i class="fas fa-chart-pie"></i> Coût Géneral par Centre </x-navbar.item>
            <x-navbar.item href="/cost/center/shared" :active="$active"> <i class="fas fa-chart-bar"></i> Répartition des Coûts </x-navbar.item>
        </ul>
    </div>

    <div class="fx__navbar-section">
        <h3 class="fx__navbar-subtitle"> Autre </h3>
        <ul class="fx__navbar-list">
            <x-navbar.item href="/section" :active="$active"> <i class="fas fa-th-list"></i> Rubrique </x-navbar.item>
            <x-navbar.item href="/unit" :active="$active"> <i class="fas fa-ruler"></i> Unité d'oeuvre </x-navbar.item>
            <x-navbar.item href="/center" :active="$active"> <i class="fas fa-building"></i> Centre </x-navbar.item>
            <x-navbar.item href="/product" :active="$active"> <i class="fas fa-cubes"></i> Produit </x-navbar.item>
        </ul>
    </div>
</div>