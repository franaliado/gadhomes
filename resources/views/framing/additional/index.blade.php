@extends('layout')

@section('content')

    @if(session('success'))
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="alert alert-success" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    </div>
    </div>
    @endif

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


    <h1>List of Additional</h1> 
    <br> 
    <b>{{ $house->address }} - {{ $lot }} - {{ $house->subcontractor->name }}</b>
    <br>
    Amount Assigned SubContractor:  {{ number_format($house->amount_assigned_subc, 2, '.', ',') }}
    <br>
    Total additional:  {{ number_format($totaladittional, 2, '.', ',') }}
    <br>
    Total Amount Available: {{ number_format($totalavailable, 2, '.', ',') }}
    <br><br>

    <a href="{{ url('/additional/'.$house->id.'/create') }}" class="btn btn-danger">
        <i class="fa fa-plus"> Add Additional</i>
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
 
            @if (count($additional) > 0)
                @foreach ($additional as $additional)
                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>    
                        <td align="left">{{ $additional->description }}</td>
                        <td align="center">{{date("m-d-Y", strtotime($additional->date))}}</td>
                        <td align="right">{{ number_format($additional->amount, 2, '.', ',') }}</td>

                        <td align='center'> 
                            <form method="GET" action="{{ url('/additional/'.$additional->id.'/'.$house->id.'/edit') }}">
                                @csrf
                                {{ method_field('EDIT')}}  
                                <button type="submit" class="btn btn-primary btn-sm" title="Edit" alt="Edit")>
                                    <i class="fa fa-pen"> </i>
                                </button>                          
                            </form>
                        </td>
                        <td align='center'>
                            <form method="post" action="{{ url('/additional/'.$additional->id.'/'.$house->id) }}">
                                @csrf
                                {{ method_field('DELETE')}}  
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this Additional?')" title="Delete" alt="Delete">
                                    <i class="fa fa-trash-alt"> </i>
                                </button>                          
                            </form>
                        </td>
                    </tr>              
                @endforeach
            @else
                <tr>
                    <td colspan="10" align="center">No Additional</td>
                </tr>
            @endif   
       
        </tbody>
    </table>
    <a href="{{ URL('/subcontractor_amount') }}" class="btn bg-red">
        <i class="fa fa-arrow-left"> Back</i>
    </a>
@endsection
