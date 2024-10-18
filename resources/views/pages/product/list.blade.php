@extends('templates.home')

@section('aside')
<x-navbar.main active="/product"></x-navbar.main>
@endsection

@php use App\Utils\Numbers; @endphp

@section('content')

<h2> Produit </h2>

@include('includes.message')

<x-table>
    <thead>
        <th> Actions </th>
        <th> Libellé </th>
        <th> Unité d'oeuvre </th>
        <th> Quantité </th>
    </thead>

    <tbody>
        @foreach ($data as $row)
        <tr>
            <td>
                <x-button.edit href="/product/{{ $row->id }}/edit"></x-button.edit>
            </td>

            <td> {{ $row->label }} </td>
            <td> {{ $row->unit }} </td>
            <td> {{ $row->quantity }} </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection
