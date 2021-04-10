@extends('layout')

@section('content')

    <h1>List of Payments</h1>
    
    <br> 
    <b>Subcontractor: {{ $subcontractor->name }}</b>
    <br>

    Total Payments: {{ number_format($totalpayments, 2, '.', ',') }}</font>

    <br><br>
 

    <a href="{{ url('/payments/'.$subcontractor->id.'/create') }}" class="btn btn-danger">
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
                            <form method="GET" action="{{ url('/payments/'.$payment->id.'/'.$subcontractor->id.'/edit') }}">
                                @csrf
                                {{ method_field('EDIT')}}  
                                <button type="submit" class="btn btn-primary btn-sm" title="Edit" alt="Edit")>
                                    <i class="fa fa-pen"> </i>
                                </button>                          
                            </form>
                        </td>
                        <td align='center'>
                            <form method="post" action="{{ url('/payments/'.$payment->id.'/'.$subcontractor->id) }}">
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
    <a href="{{ URL('/subcontractors') }}" class="btn bg-red">
        <i class="fa fa-arrow-left"> Back</i>
    </a>
@endsection
