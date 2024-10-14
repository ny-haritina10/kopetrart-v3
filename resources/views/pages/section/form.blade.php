@extends('templates.home')

@section('aside')
<x-navbar.main active="/section"></x-navbar.main>
@endsection

@php
    $no_account = old('no_account') ?? $item->no_account ?? '';
    $label = old('label') ?? $item->label ?? '';
    $id_unit = old('id-unit') ?? $item->id_unit ?? '';
    $id_nature = old('id-nature') ?? $item->id_nature ?? '';
    $id_incorporation = old('id-incorporation') ?? $item->id_nature ?? '';
@endphp

@section('content')
<x-form.main :action="$form_action" :method="$form_method">
    <h2> {{ $form_title }} </h2>

    <x-form.input name="no-account" type="text" :value="$no_account"> Nº de Compte </x-form.input>
    <x-form.input name="label" type="text" :value="$label"> Libellé </x-form.input>
    <x-form.select name="id-unit" :options="$units" :value="$id_unit"> Unité d'oeuvre </x-form.select>
    <x-form.select name="id-nature" :options="$natures" :value="$id_nature"> Nature </x-form.select>
    <x-form.select name="id-incorporation" :options="$incorporations" :value="$id_incorporation"> Incorporation </x-form.select>

</x-form.main>
@endsection
