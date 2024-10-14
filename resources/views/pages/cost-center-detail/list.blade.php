@extends('templates.home')

@section('aside')
<x-navbar.main active="/cost/center/detail"></x-navbar.main>
@endsection
@php

use App\Utils\Numbers;
$count = $natures->count();

@endphp

@section('content')
<h2> Coût Géneral par Centre </h2>

<x-table>
    <thead>
        <tr>
            <th rowspan="2"> Rubrique </th>
            <th rowspan="2"> Unité d'oeuvre </th>
            <th rowspan="2"> Nature </th>

            @foreach ($centers as $center)
            <th colspan="{{ $count + 1 }}"> {{ $center->label }} </th>
            @endforeach

            <th colspan="{{ $count }}"> Coût total </th>
        </tr>

        <tr>

            @foreach ($centers as $center)
            <th> Poucentage  </th>
                @foreach ($natures as $nature)
                <th> {{ $nature->label }} </th>
                @endforeach
            @endforeach

            @foreach ($natures as $nature)
            <th> {{ $nature->label }} </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
        <tr>
            <td> {{ $row->label }} </td>
            <td> {{ $row->unit }} </td>
            <td> {{ $row->nature }} </td>

            @foreach ($centers as $center)
            <td align="right"> {{ Numbers::format($row->details[$center->label]['percentage'] * 100) }} % </td>
                @foreach ($natures as $nature)
                <td align="right"> {{ Numbers::format($row->details[$center->label][$nature->label]) }} </td>
                @endforeach
            @endforeach

            @foreach ($natures as $nature)
            <td align="right"> {{ Numbers::format($row->details['total'][$nature->label]) }} </td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection
