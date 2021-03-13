@extends('layout')

@section('content')
    <h1>List of Purchase Orders</h1>
    <br/>
    @if (count($orders) < 2)
        <a href="{{ url('/orders/'.$house_id. '/create') }}" class="btn btn-danger">
            <i class="fa fa-plus"> Add PO </i>
        </a> 
    @else
        <a class="btn btn-secondary">
            <i class="fa fa-plus"> Add PO </i>
        </a> 
    @endif
    <br/><br/>


    <table class="table table-light table-hover" border='1' >
        <thead class="thead-light" bgcolor="red" style="color:white">
            <tr>
                <th>#</th>
                <th style="text-align:center;vertical-align: middle">Nº P.O.</th>
                <th style="text-align:center;vertical-align: middle">Description</th>
                <th style="text-align:center;vertical-align: middle">Option</th>
                <th style="text-align:center;vertical-align: middle">Date P.O.</th>
                <th style="text-align:center;vertical-align: middle">Qty P.O.</th>
                <th style="text-align:center;vertical-align: middle">Unit Price<t/h>
                <th style="text-align:center;vertical-align: middle">Superintendent</th>
                <th style="text-align:center;vertical-align: middle">Phone Sup</th>
                <th colspan = "2" style="text-align:center;vertical-align: middle">Actions</th>
            </tr>
        </thead>

        <tbody>
 
            @if (count($orders) > 0)
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>    
                        <td>{{ $order->num_po }}</td>  
                        <td align="left">{{ $order->description }}</td>
                        <td align="center">{{ $order->option }}</td>
                        <td align="center">{{date("d-m-Y", strtotime($order->date_order))}}</td>
                        <td align="right">{{ $order->qty_po }}</td>
                        <td align="right">{{ $order->unit_price }}</td>
                        <td align="center">{{ $order->name_Superint }}</td>
                        <td align="center">{{ $order->phone_Superint }}</td>

                        <td align='center'> 
                            <form method="GET" action="{{ url('/orders/'.$order->id. '/edit') }}">
                                @csrf
                                {{ method_field('EDIT')}}  
                                <button type="submit" class="btn btn-primary btn-sm" title="Edit" alt="Edit")>
                                    <i class="fa fa-pen"> </i>
                                </button>                          
                            </form>
                        </td>
                        <td align='center'>
                            <form method="post" action="{{ url('/orders/'.$order->id.'/'.$house_id) }}">
                                @csrf
                                {{ method_field('DELETE')}}  
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this PO?')" title="Delete" alt="Delete">
                                    <i class="fa fa-trash-alt"> </i>
                                </button>                          
                            </form>
                        </td>
                    </tr>              
                @endforeach
            @else
                <tr>
                    <td colspan="10" align="center">No Purchase Orders</td>
                </tr>
            @endif   
       


        </tbody>
    </table>
    <a href="{{ URL('/houses') }}" class="btn bg-red">
        <i class="fa fa-arrow-left"> Back</i>
    </a>
@endsection
