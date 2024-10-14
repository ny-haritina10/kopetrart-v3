@extends('templates.home')

@section('aside')
<x-navbar.main active="/center"></x-navbar.main>
@endsection

@php
    $label = old('label') ?? $item->label ?? '';
    $id_unit = old('id-unit') ?? $item->id_unit ?? '';
    $quantity = old('quantity') ?? $item->quantity ?? '';
@endphp

@section('content')
<x-form.main :action="$form_action" :method="$form_method">
    <h2> {{ $form_title }} </h2>

    <x-form.input name="label" type="text" :value="$label"> Libellé </x-form.input>
    <x-form.select name="id-unit" :options="$units" :value="$id_unit"> Unité d'oeuvre </x-form.select>
    <x-form.input name="quantity" type="number" :value="$quantity"> Quantité </x-form.input>


</x-form.main>
@endsection
