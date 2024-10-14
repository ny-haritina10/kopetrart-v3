@extends('templates.home')

@section('aside')
<x-navbar.main active="/center"></x-navbar.main>
@endsection

@php use App\Utils\Numbers; @endphp

@section('content')

<h2>
    <x-button.add href="/center/create"></x-button.add>
    Liste des Centres
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
                <x-button.edit href="/center/{{ $row->id }}/edit"></x-button.edit>
                <x-button.delete href="/center/{{ $row->id }}"></x-button.delete>
            </td>

            <td> {{ $row->label }} </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection
