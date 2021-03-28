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


    <h1>List of Payments</h1> 
    <br> 
    <b>{{ $house->address }} - {{ $lot }} - {{ $house->subcontractor->name }}</b>
    <br>
    Amount Assigned SubContractor:  {{ number_format($house->amount_assigned_subc, 2, '.', ',') }}
    <br>
    Total Amount Available: {{ number_format($totalavailable, 2, '.', ',') }}
    <br><br>

    <a href="{{ url('/payments/'.$house->id.'/create') }}" class="btn btn-danger">
        <i class="fa fa-plus"> Add Payment</i>
    </a> 
    <br/><br/>


    <table class="table table-light table-hover" border='1' >
        <thead class="thead-light" bgcolor="red" style="color:white">
            <tr>
                <th style="text-align:center;vertical-align: middle">#</th>
                <th style="text-align:center;vertical-align: middle">Date</th>
                <th style="text-align:center;vertical-align: middle">Type</th>
                <th style="text-align:center;vertical-align: middle">Amount</th>
                <th colspan = "2" style="text-align:center;vertical-align: middle">Actions</th>
            </tr>
        </thead>

        <tbody>
 
            @if (count($payments) > 0)
                @foreach ($payments as $payment)

                    @switch ($payment->type)
                    @case(1)
                        @php $type = "Cash"; @endphp
                        @break
                    @default
                        @php $type = "Check"; @endphp
                    @endswitch

                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>    
                        <td align="center">{{date("m-d-Y", strtotime($payment->date))}}</td>
                        <td align="center">{{ $type }}</td>
                        <td align="right">{{ number_format($payment->amount, 2, '.', ',') }}</td>

                        <td align='center'> 
                            <form method="GET" action="{{ url('/payments/'.$payment->id.'/'.$house->id.'/edit') }}">
                                @csrf
                                {{ method_field('EDIT')}}  
                                <button type="submit" class="btn btn-primary btn-sm" title="Edit" alt="Edit")>
                                    <i class="fa fa-pen"> </i>
                                </button>                          
                            </form>
                        </td>
                        <td align='center'>
                            <form method="post" action="{{ url('/payments/'.$payment->id.'/'.$house->id) }}">
                                @csrf
                                {{ method_field('DELETE')}}  
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this Payment?')" title="Delete" alt="Delete">
                                    <i class="fa fa-trash-alt"> </i>
                                </button>                          
                            </form>
                        </td>
                    </tr>              
                @endforeach
            @else
                <tr>
                    <td colspan="10" align="center">No Payments</td>
                </tr>
            @endif   
       
        </tbody>
    </table>
    <a href="{{ URL('/subcontractor_amount') }}" class="btn bg-red">
        <i class="fa fa-arrow-left"> Back</i>
    </a>
@endsection
