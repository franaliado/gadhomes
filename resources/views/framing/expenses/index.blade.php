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


    <h1>List of Expenses - {{ Auth::user()->name }}</h1> 
    <br> 

    <a href="{{ url('/expenses/'.$user_id.'/create') }}" class="btn btn-danger">
        <i class="fa fa-plus"> Add Expense</i>
    </a> 
    <br/><br/>


    <table class="table table-light table-hover" border='1' >
        <thead class="thead-light" bgcolor="red" style="color:white">
            <tr>
                <th style="text-align:center;vertical-align: middle">#</th>
                <th style="text-align:center;vertical-align: middle">Type Expense</th>
                <th style="text-align:center;vertical-align: middle">Date</th>
                <th style="text-align:center;vertical-align: middle">Description</th>
                <th style="text-align:center;vertical-align: middle">Type Pay</th>
                <th style="text-align:center;vertical-align: middle">Card</th>
                <th style="text-align:center;vertical-align: middle">Amount</th>
                <th colspan = "2" style="text-align:center;vertical-align: middle">Actions</th>
            </tr>
        </thead>

        <tbody>
 
            @if (count($expenses) > 0)
                @foreach ($expenses as $expense)

                    @switch ($expense->type_expense)
                    @case(1)
                        @php $type_expense = "Gas"; @endphp
                        @break
                    @case(2)
                        @php $type_expense = "Tools"; @endphp
                        @break
                    @case(3)
                        @php $type_expense = "Invoices"; @endphp
                        @break
                    @default
                        @php $type_expense = "Others"; @endphp
                    @endswitch

                    @switch ($expense->type_pay)
                    @case(1)
                        @php $type_pay = "Check"; @endphp
                        @break
                    @case(2)
                        @php $type_pay = "Cash"; @endphp
                        @break
                    @default
                        @php $type_pay = "Card"; @endphp
                    @endswitch

                    @switch ($expense->card)
                    @case(1)
                        @php $card = "Personal`s Card"; @endphp
                        @break
                    @case(2)
                        @php $card = "Saul`s Card"; @endphp
                        @break
                    @default
                        @php $card = "GAD`s Card"; @endphp
                    @endswitch

                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>  
                        <td align="center">{{ $type_expense }}</td>
                        <td align="center">{{date("m-d-Y", strtotime($expense->date))}}</td>
                        <td align="left">{{ $expense->description }}</td>
                        <td align="center">{{ $type_pay }}</td>
                        <td align="center">{{ $card }}</td>
                        <td align="right">{{ number_format($expense->amount, 2, '.', ',') }}</td>

                        <td align='center'> 
                            <form method="GET" action="{{ url('/expenses/'.$expense->id.'/'.$user_id.'/edit') }}">
                                @csrf
                                {{ method_field('EDIT')}}  
                                <button type="submit" class="btn btn-primary btn-sm" title="Edit" alt="Edit")>
                                    <i class="fa fa-pen"> </i>
                                </button>                          
                            </form>
                        </td>
                        <td align='center'>
                            <form method="post" action="{{ url('/expenses/'.$expense->id.'/'.$user_id) }}">
                                @csrf
                                {{ method_field('DELETE')}}  
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this Expense?')" title="Delete" alt="Delete">
                                    <i class="fa fa-trash-alt"> </i>
                                </button>                          
                            </form>
                        </td>
                    </tr>              
                @endforeach
            @else
                <tr>
                    <td colspan="10" align="center">No Expenses</td>
                </tr>
            @endif   
       
        </tbody>
    </table>
@endsection
