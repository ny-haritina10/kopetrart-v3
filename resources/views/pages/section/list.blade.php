@extends('templates.home')

@section('aside')
<x-navbar.main active="/section"></x-navbar.main>
@endsection

@php use App\Utils\Numbers; @endphp

@section('content')

<h2>
    <x-button.add href="/section/create"></x-button.add>
    Liste des Rubriques
</h2>

@include('includes.message')

<x-table>
    <thead>
        <th> Actions </th>

        <th> Libellé </th>
        <th> Unité d'oeuvre </th>
        <th> Nature </th>
        <th> Incorporabilité </th>
    </thead>

    <tbody>
        @foreach ($data as $row)
        <tr>
            <td>
                <x-button.edit href="/section/{{ $row->id }}/edit"></x-button.edit>
                <x-button.delete href="/section/{{ $row->id }}"></x-button.delete>
            </td>

            <td> {{ $row->label }} </td>
            <td> {{ $row->unit }} </td>
            <td> {{ $row->nature }} </td>
            <td> {{ $row->incorporation }} </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection
