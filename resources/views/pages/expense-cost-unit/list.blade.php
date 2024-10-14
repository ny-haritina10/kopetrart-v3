@extends('templates.home')

@section('aside')
<x-navbar.main active="/cost/expense"></x-navbar.main>
@endsection

@php use App\Utils\Numbers; @endphp

@section('content')
<h2> Coût Unitaire Charge </h2>

<x-table>
    <thead>
        <tr>
            <th> Unité d'oeuvre </th>
            <th> Date </th>
            <th> Quantité </th>
            <th> Coût total </th>
            <th> Coût unitaire </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
        <tr>
            <td> {{ $row->unit }} de {{ $row->label }} </td>
            <td> {{ $row->date }} </td>
            <td align="right"> {{ Numbers::format($row->quantity) }} </td>
            <td align="right"> {{ Numbers::format($row->price_total) }} </td>
            <td align="right"> {{ Numbers::format($row->price_unit) }} </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection
