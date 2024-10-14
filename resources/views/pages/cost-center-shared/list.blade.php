@extends('templates.home')

@section('aside')
<x-navbar.main active="/cost/center/shared"></x-navbar.main>
@endsection
@php use App\Utils\Numbers; @endphp

@section('content')
<h2> Répartition des Coûts </h2>

@foreach ($structures as $structure)
<h3> {{ $structure->label }} </h3>
<div class="chart-wrap" style="height: 400px">
    <chart type="doughnut">
        <labels>
            @foreach ($data['data'] as $row)
            <label> {{ $row->label }} </label>
            @endforeach
        </labels>
        <dataset>
            @foreach ($data['data'] as $row)
            <data> {{ $row->share[$structure->id]->price }} </data>
            @endforeach
        </dataset>
    </chart>
</div>
@endforeach
</div>

<h3> Détails </h3>

<x-table>
    <thead>
        <tr>
            <th> Centre </th>
            <th> Coût direct </th>
            @foreach ($structures as $structure)
                <th> {{ $structure->label }} </th>
                <th> Clés </th>
                @endforeach
            <th> Coût total </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['data'] as $row)
        <tr>
            <td> {{ $row->label }} </td>
            <td align="right"> {{ Numbers::format($row->price) }} </td>
            @foreach ($structures as $structure)
                <td align="right"> {{ Numbers::format($row->share[$structure->id]->price) }} </td>
                <td align="right"> {{ Numbers::format($row->share[$structure->id]->key * 100, 2) }} % </td>
                @endforeach
            <td align="right"> {{ Numbers::format($row->price_total) }} </td>
        </tr>
        @endforeach
        <tr>
            <td align="right"> TOTAL GENERAL </td>
            <td align="right"> {{ Numbers::format($data['total']['direct']) }} </td>
            @foreach ($structures as $structure)
                <td align="right"> {{ Numbers::format($data['total']['shared'][$structure->id]) }} </td>
                <td></td>
                @endforeach
            <td align="right"> {{ Numbers::format($data['total']['total']) }} </td>
        </tr>
    </tbody>
</x-table>
@endsection
