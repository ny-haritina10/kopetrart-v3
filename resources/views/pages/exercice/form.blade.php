@extends('templates.home')

@section('aside')
<x-navbar.main active="/exercice"></x-navbar.main>
@endsection

@php
    $no_account = old('no-account') ?? $item->no_account ?? '';
    $id_exercice_year = old('id-exercice-year') ?? $item->id_exercice_year ?? '';
    $label = old('label') ?? $item->label ?? '';
    $date = old('date') ?? $item->date ?? '';
    $debit = old('debit') ?? $item->debit ?? '0';
    $credit = old('credit') ?? $item->credit ?? '0';
@endphp

@section('content')
<x-form.main :action="$form_action" :method="$form_method">
    <h2> {{ $form_title }} </h2>

    <x-form.input name="no-account" type="text" :value="$no_account"> Numéro de compte </x-form.input>
    <x-form.input name="label" type="text" :value="$label"> Libellé </x-form.input>
    <x-form.select name="id-exercice-year" :options="$exercice_years" :value="$id_exercice_year"> Année d'exercice </x-form.select>
    <x-form.input name="debit" type="number" :value="$debit"> Débit </x-form.input>
    <x-form.input name="credit" type="number" :value="$credit"> Crédit </x-form.input>
    <x-form.input name="date" type="date" :value="$date"> Date </x-form.input>

</x-form.main>
@endsection
