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

    <h1>List of Purchase Orders <br> {{ $house->address }} - {{ $lot }}</h1>
    <br/>
    @if (count($orders) < 8)
        <a href="{{ url('/orders/'.$house->id. '/create') }}" class="btn btn-danger">
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
                <th style="text-align:center;vertical-align: middle">#</th>
                <th style="text-align:center;vertical-align: middle">Nº P.O.</th>
                <th style="text-align:center;vertical-align: middle">Date P.O.</th>
                <th style="text-align:center;vertical-align: middle">Superintendent</th>
                <th style="text-align:center;vertical-align: middle">Phone Sup</th>
                <th colspan = "4" style="text-align:center;vertical-align: middle">Actions</th>
            </tr>
        </thead>

        <tbody>
 
            @if (count($orders) > 0)
                @foreach ($orders as $order)
                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>    
                        <td align="center">{{ $order->num_po }}</td>  
                        <td align="center">{{date("m-d-Y", strtotime($order->date_order))}}</td>
                        <td align="center">{{ $order->name_Superint }}</td>
                        <td align="center">{{ $order->phone_Superint }}</td>

                        <td align='center'> 
                            <form method="GET" action="{{ url('/orders/'.$order->id. '/'.$house->id.'/edit') }}">
                                @csrf
                                {{ method_field('EDIT')}}  
                                <button type="submit" class="btn btn-primary btn-sm" title="Edit" alt="Edit")>
                                    <i class="fa fa-pen"> </i>
                                </button>                          
                            </form>
                        </td>
                        <td align='center'>
                            <a href="{{ url('/descriptionpo/'.$order->id.'/'.$house->id) }}"">
                                <button type="button" class="btn btn-success btn-sm" title="Descriptions" alt="Descriptions">
                                    <i class="fa fa-clipboard-list"> </i>
                                </button>                          
                            </a>
                        </td>

                        <td align='center'>
                            <a href="/invoice/{{ $order->idInvoice }}/{{$house->id}}">
                                <button type="button" class="btn btn-warning btn-sm" title="Invoice" alt="Invoice">
                                    <i class="fa fa-file-text" aria-hidden="true"></i>
                                </button> 
                            </a>
                        </td>

                        <td align='center'>
                            <form method="post" action="{{ url('/orders/'.$order->id.'/'.$house->id) }}">
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
