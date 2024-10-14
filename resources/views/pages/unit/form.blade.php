@extends('templates.home')

@section('aside')
<x-navbar.main active="/unit"></x-navbar.main>
@endsection

@php
    $label = old('label') ?? $item->label ?? '';
@endphp

@section('content')
<x-form.main :action="$form_action" :method="$form_method">
    <h2> {{ $form_title }} </h2>

    <x-form.input name="label" type="text" :value="$label"> Libellé </x-form.input>

</x-form.main>
@endsection
