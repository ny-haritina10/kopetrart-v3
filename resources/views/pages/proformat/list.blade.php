@extends('templates.home')

@section('aside')
<x-navbar.main active="/proformat"></x-navbar.main>
@endsection

@php use App\Utils\Numbers; @endphp

@section('content')

<h2> Factures Proforma </h2>

@include('includes.message')

<div class="mb-4">
    <x-button.add href="{{ route('proformat.create') }}">Créer une Nouvelle Proforma</x-button.add>
</div>

<x-table>
    <thead>
        <th> Actions </th>
        <th> Numéro de Facture </th>
        <th> Date </th>
        <th> Nom de l'Acheteur </th>
        <th> Status </th>
    </thead>

    <tbody>
        @foreach ($data as $row)
        <tr>
            <td>
                <x-button.show href="{{ route('proformat.show', $row->id) }}">Consulter</x-button.show>

                @if ($row->status === 'Pending')
                    <x-button.accept href="{{ route('proformat.accept', $row->id) }}">Accepter</x-button.accept>
                    <x-button.delete href="{{ route('proformat.reject', $row->id) }}">Refuser</x-button.delete>
                @endif
            </td>
            <td> {{ $row->invoice_number }} </td>
            <td> {{ $row->invoice_date->format('Y-m-d') }} </td>
            <td> {{ $row->buyer_name }} </td>
            <td> {{ $row->status }} </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection