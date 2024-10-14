@extends('templates.home')

@section('aside')
<x-navbar.main active="/exercice"></x-navbar.main>
@endsection

@php use App\Utils\Numbers; @endphp

@section('content')

<h2>
    <x-button.add href="/exercice/create"></x-button.add>
    Liste des Ecritures
</h2>

@include('includes.message')

<x-table>
    <thead>
        <th> Actions </th>

        <th> Nº de Compte </th>
        <th> Année d'exercice </th>
        <th> Libellé </th>
        <th> Date </th>
        <th> Débit </th>
        <th> Crédit </th>
    </thead>

    <tbody>
        @foreach ($data as $row)
        <tr>
            <td>
                <x-button.edit href="/exercice/{{ $row->id }}/edit"></x-button.edit>
                <x-button.delete href="/exercice/{{ $row->id }}"></x-button.delete>
            </td>

            <td> {{ $row->no_account }} </td>
            <td> {{ $row->exercice_year }} </td>
            <td> {{ $row->label }} </td>
            <td> {{ $row->date }} </td>
            <td align="right"> {{ Numbers::format($row->debit) }} </td>
            <td align="right"> {{ Numbers::format($row->credit) }} </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection
