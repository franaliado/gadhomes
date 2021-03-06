@extends('layout')

@section('content')
    <h1>List of Houses</h1>
    <br/>
    <a href="{{ url('/houses/create') }}" class="btn btn-danger">Add House</a>
    <br/><br/>
    <table class="table table-light table-hover" border='0' >
        <thead class="thead-light" bgcolor="#BFC9CA">
            <tr>
                <th>#</th>
                <th>Community</th>
                <th>Address</th>
                <th scope="col">Lot</th>
                <th>State</th>
                <th>Start Date</th>
                <th>Without PO<t/h>
                <th>Subcontractor</th>
                <th>Amount Asig <Br> SubCont</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($houses as $house)

                @switch ($house->state)
                    @case(1)
                        @php $state = "Started"; @endphp
                        @break
                    @case(2)
                        @php $state = "Billed"; @endphp
                        @break
                    @default
                        @php $state = "Paid"; @endphp
                @endswitch

                @switch ($house->withoutpo)
                    @case(0)
                        @php $withoutpo = "No"; @endphp
                        @break
                    @default
                        @php $withoutpo = "Yes"; @endphp
                @endswitch

                <tr>
                    <td>{{ $loop->iteration }}</td>      
                    <td>{{ $house->community->name }}</td>
                    <td>{{ $house->address }}</td>
                    <td align="center">{{ $house->lot }}</td>
                    <td align="center">{{ $state }}</td>
                    <td align="center">{{date("d-m-Y", strtotime($house->start_date))}}</td>
                    <td align="center">{{ $withoutpo }}</td>
                    <td>{{ $house->subcontractor->name }}</td>
                    <td align="right">{{ $house->amount_assigned_subc}}</td>
                    <td>Edit|Delete</td>
                </tr>                
            @endforeach

        </tbody>
    </table>
    {{ $houses -> links() }}
@endsection
