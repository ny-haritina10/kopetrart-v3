@extends('templates.home')

@section('aside')
<x-navbar.main active="/expense"></x-navbar.main>
@endsection

@php use App\Utils\Numbers; @endphp

@section('content')

<h2>
    <x-button.add href="/expense/create"></x-button.add>
    Liste des Charges
</h2>

@include('includes.message')

<x-table>
    <thead>
        <th> Actions </th>

        <th> Rubrique </th>
        <th> Quantité </th>
        <th> Prix </th>
        <th> Date </th>
    </thead>

    <tbody>
        @foreach ($data as $row)
        <tr>
            <td>
                <x-button.edit href="/expense/{{ $row->id }}/edit"></x-button.edit>
                <x-button.delete href="/expense/{{ $row->id }}"></x-button.delete>
            </td>

            <td> {{ $row->label }} </td>
            <td align="right"> {{ Numbers::format($row->quantity) }} </td>
            <td align="right"> {{ Numbers::format($row->price) }} </td>
            <td> {{ $row->date }} </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection
