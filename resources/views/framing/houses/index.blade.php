@extends('layout')

@section('content')
    <h1>Listado de Casas</h1>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Community</th>
                <th>Address</th>
                <th>Lot</th>
                <th>State</th>
                <th>Date</th>
                <th>Subcontractor</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($houses as $house)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    
                    <td>{{ $house->community->name_community }}</td>
                    <td>{{ $house->address }}</td>
                    <td>{{ $house->lot }}</td>
                    <td>{{ $house->state }}</td>
                    <td>{{ $house->start_date }}</td>
                    <td>{{ $house->subcontractor_id }}</td>
                    <td>Edit|Delete</td>
                </tr>                
            @endforeach

        </tbody>
    </table>


@endsection
