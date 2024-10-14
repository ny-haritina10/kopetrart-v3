@extends('templates.home')

@section('aside')
<x-navbar.main active="/cost/product"></x-navbar.main>
@endsection

@php use App\Utils\Numbers; @endphp

@section('content')
<h2> Coût Unitaire Produit </h2>

<div class="chart-wrap" style="height: 400px">
    <chart type="doughnut">

        <labels>
            @foreach ($shares['data'] as $share)
            <label> {{ $share->label }} </label>
            @endforeach
        </labels>

        <dataset>
            @foreach ($shares['data'] as $share)
            <data> {{ $share->price_total }} </data>
            @endforeach
        </dataset>
    </chart>
</div>

<h3> Détails </h3>
<x-table>
    <tbody>
        @foreach ($data as $row)
        <tr>
            <th> Unité d'oeuvre </th>
            <td> {{ $row->unit }} de {{ $row->label }} </td>
        </tr>
        <tr>
            <th> Quantité </th>
            <td align="right"> {{ Numbers::format($row->quantity) }} </td>
        </tr>
        @foreach ($shares['data'] as $share)
        <tr>
            <th> Coût {{ $share->label }} </th>
            <td align="right"> {{ Numbers::format($share->price_total) }} </td>
        </tr>
        @endforeach
        <tr>
            <th> Coût total </th>
            <td align="right"> {{ Numbers::format($row->price_total) }} </td>
        </tr>
        <tr>
            <th> Coût unitaire </th>
            <td align="right"> {{ Numbers::format($row->price_unit) }} </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection
