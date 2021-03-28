@extends('layout')

@section('content')

@switch (strlen($house->lot))
@case(1)
    @php $lot = "000" . $house->lot; @endphp
    @break
@case(2)
    @php $lot = "00" . $house->lot; @endphp
    @break
@case(3)
    @php $lot = "0" . $house->lot; @endphp
    @break
@default
    @php $lot = $house->lot; @endphp
@endswitch


    <h1>List of Tools</h1> 
    <br> 
    <b>{{ $house->address }} - {{ $lot }} - {{ $house->subcontractor->name }}</b>
    <br>
    Amount Assigned SubContractor:  {{ number_format($house->amount_assigned_subc, 2, '.', ',') }}
    <br>
    Total Amount Available: {{ number_format($totalavailable, 2, '.', ',') }}
    <br><br>

    <a href="{{ url('/tools/'.$house->id.'/create') }}" class="btn btn-danger">
        <i class="fa fa-plus"> Add Tool</i>
    </a> 
    <br/><br/>


    <table class="table table-light table-hover" border='1' >
        <thead class="thead-light" bgcolor="red" style="color:white">
            <tr>
                <th style="text-align:center;vertical-align: middle">#</th>
                <th style="text-align:center;vertical-align: middle">Description</th>
                <th style="text-align:center;vertical-align: middle">Date</th>
                <th style="text-align:center;vertical-align: middle">Amount</th>
                <th colspan = "2" style="text-align:center;vertical-align: middle">Actions</th>
            </tr>
        </thead>

        <tbody>
 
            @if (count($tools) > 0)
                @foreach ($tools as $tool)
                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>    
                        <td align="left">{{ $tool->description }}</td>
                        <td align="center">{{date("m-d-Y", strtotime($tool->date))}}</td>
                        <td align="right">{{ number_format($tool->amount, 2, '.', ',') }}</td>

                        <td align='center'> 
                            <form method="GET" action="{{ url('/tools/'.$tool->id.'/'.$house->id.'/edit') }}">
                                @csrf
                                {{ method_field('EDIT')}}  
                                <button type="submit" class="btn btn-primary btn-sm" title="Edit" alt="Edit")>
                                    <i class="fa fa-pen"> </i>
                                </button>                          
                            </form>
                        </td>
                        <td align='center'>
                            <form method="post" action="{{ url('/tools/'.$tool->id.'/'.$house->id) }}">
                                @csrf
                                {{ method_field('DELETE')}}  
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this Tool?')" title="Delete" alt="Delete">
                                    <i class="fa fa-trash-alt"> </i>
                                </button>                          
                            </form>
                        </td>
                    </tr>              
                @endforeach
            @else
                <tr>
                    <td colspan="10" align="center">No Tools</td>
                </tr>
            @endif   
       
        </tbody>
    </table>
    <a href="{{ URL('/subcontractor_amount') }}" class="btn bg-red">
        <i class="fa fa-arrow-left"> Back</i>
    </a>
@endsection
