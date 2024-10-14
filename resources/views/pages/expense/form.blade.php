@extends('templates.home')

@section('aside')
<x-navbar.main active="/expense"></x-navbar.main>
@endsection

@php
    $id_section = old('id-section') ?? $item->id_section ?? '';
    $quantity = old('quantity') ?? $item->quantity ?? '';
    $price = old('price') ?? $item->price ?? '';
    $date = old('date') ?? $item->date ?? '';
    $percentages = collect(old('percentage') ?? $percentages?->values() ?? []);
@endphp

@section('content')
<x-form.main :action="$form_action" :method="$form_method">
    <h2> {{ $form_title }} </h2>

    <x-form.select name="id-section" :options="$sections" :value="$id_section"> Rubrique </x-form.select>
    <x-form.input name="quantity" type="number" :value="$quantity"> Quantité </x-form.input>
    <x-form.input name="price" type="number" :value="$price"> Prix </x-form.input>
    <x-form.input name="date" type="date" :value="$date"> Date </x-form.input>

    <br>
    <h4> Distribution </h4>
    @error('percentage')
        <div class="alert alert-danger"> {{ $message }} </div>
    @enderror
    @foreach ($centers as $i => $center)
        <x-form.input name="percentage[]" error="percentage.{{ $i }}" type="number" :value="$percentages->get($i) ?? 0"> Pourcentage {{ $center->label }} </x-form.input>
    @endforeach

</x-form.main>
@endsection
