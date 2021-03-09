@extends('layout')

@section('content')
    <h1>List of Houses</h1>
    <br/>
    <a href="{{ url('/houses/create') }}" class="btn btn-danger">Add House</a>
    <br/><br/>
    <table class="table table-light table-hover" border='1' >
        <thead class="thead-light" bgcolor="red" style="color:white">
            <tr>
                <th>#</th>
                <th style="text-align:left;vertical-align: middle">Address</th>
                <th style="text-align:center;vertical-align: middle">Community</th>
                <th style="text-align:center;vertical-align: middle">Lot</th>
                <th style="text-align:center;vertical-align: middle">Status</th>
                <th style="text-align:center;vertical-align: middle">Start Date</th>
                <th style="text-align:center;vertical-align: middle">Without PO<t/h>
                <th style="text-align:center;vertical-align: middle">Subcontractor</th>
                <th style="text-align:center;vertical-align: middle">Amount Assigned <Br> SubCont</th>
                <th colspan = "2" style="text-align:center;vertical-align: middle">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($houses as $house)

                @switch ($house->status)
                    @case(1)
                        @php $status = "Started"; @endphp
                        @break
                    @case(2)
                        @php $status = "Billed"; @endphp
                        @break
                    @default
                        @php $status = "Paid"; @endphp
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
                    <td>{{ $house->address }}</td>  
                    <td align="center">{{ $house->community-> name }}</td>
                    <td align="center">{{ $house->lot }}</td>
                    <td align="center">{{ $status }}</td>
                    <td align="center">{{date("d-m-Y", strtotime($house->start_date))}}</td>
                    <td align="center">{{ $withoutpo }}</td>
                    <td align="left">{{ $house->subcontractor->name }}</td>
                    <td align="right" class ="pr-5">{{ $house->amount_assigned_subc}}</td>
                    <td align='center'> 
                        <form method="GET" action="{{ url('/houses/'.$house->id. '/edit') }}">
                            @csrf
                            {{ method_field('EDIT')}}  
                            <button type="submit" class="redondo-edit" title="Edit" alt="Edit")>E</button>                          
                        </form>
                    </td>
                    <td align='center'>
                        <form method="post" action="{{ url('/houses/'.$house->id) }}">
                            @csrf
                            {{ method_field('DELETE')}}  
                            <button type="submit" class="redondo-delete" onclick="return confirm('Do you want to delete this record?')" title="Delete" alt="Delete">X</button>                          
                        </form>
                    </td>
                    <!--
                        <img class = "icon" height="16" width="16" title="Edit" alt="Edit" src="adminlte/img/edit.png" >
                        &nbsp;&nbsp;
  
                        <a title="Delete" href="{{ url('/houses/'.$house->id) }}" onclick="return confirm('Do you want to delete this record?')" class="dropdown-item">
                            <img class = "icon" height="16" width="16" title="Delete" alt="Delete" src="adminlte/img/delete.png" >
                        </a>

                    </td>
                    -->
                </tr>                
            @endforeach

        </tbody>
    </table>
    {{ $houses -> links() }}
@endsection
