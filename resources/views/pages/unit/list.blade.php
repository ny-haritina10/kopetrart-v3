@extends('templates.home')

@section('aside')
<x-navbar.main active="/unit"></x-navbar.main>
@endsection

@php use App\Utils\Numbers; @endphp

@section('content')

<h2>
    <x-button.add href="/unit/create"></x-button.add>
    Liste des Unités d'Oeuvre
</h2>

@include('includes.message')

<x-table>
    <thead>
        <th> Actions </th>

        <th> Libellé </th>
    </thead>

    <tbody>
        @foreach ($data as $row)
        <tr>
            <td>
                <x-button.edit href="/unit/{{ $row->id }}/edit"></x-button.edit>
                <x-button.delete href="/unit/{{ $row->id }}"></x-button.delete>
            </td>

            <td> {{ $row->label }} </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection
