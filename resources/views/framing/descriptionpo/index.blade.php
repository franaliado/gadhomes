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

    <h1>Descriptions of Purchase Order Nº {{ $orders->num_po }}</h1>
    <br/>
    @if (Auth::user()->role == 1)
        <a href="{{ url('/descriptionpo/'.$orders->id.'/'.$house_id.'/create') }}" class="btn btn-danger">
            <i class="fa fa-plus"> Add Description </i>
        </a> 
    @endif
    <br/><br/>


    <table class="table table-light table-hover" border='1' >
        <thead class="thead-light" bgcolor="red" style="color:white">
            <tr>
                <th>#</th>
                <th style="text-align:center;vertical-align: middle">Description</th>
                <th style="text-align:center;vertical-align: middle">Option</th>
                <th style="text-align:center;vertical-align: middle">Qty P.O.</th>
                <th style="text-align:center;vertical-align: middle">Unit Price<t/h>
                @if (Auth::user()->role == 1)
                    <th colspan = "2" style="text-align:center;vertical-align: middle">Actions</th>
                @endif
            </tr>
        </thead>

        <tbody>
 
            @if (count($descriptionpos) > 0)
                @foreach ($descriptionpos as $descriptionpo)
                    <tr>
                        <td>{{ $loop->iteration }}</td>    
                        <td align="left">{{ $descriptionpo->description }}</td>
                        <td align="center">{{ $descriptionpo->option }}</td>
                        <td align="right">{{ number_format($descriptionpo->qty_po, 2, '.', ',') }}</td>
                        <td align="right">{{ number_format($descriptionpo->unit_price, 3, '.', ',') }}</td>

                        @if (Auth::user()->role == 1)
                            <td align='center'> 
                                <form method="GET" action="{{ url('/descriptionpo/'.$descriptionpo->id.'/'.$orders->id.'/'.$house_id.'/edit') }}">
                                    @csrf
                                    {{ method_field('EDIT')}}  
                                    <button type="submit" class="btn btn-primary btn-sm" title="Edit" alt="Edit")>
                                        <i class="fa fa-pen"> </i>
                                    </button>                          
                                </form>
                            </td>
                            <td align='center'>
                                <form method="post" action="{{ url('/descriptionpo/'.$descriptionpo->id.'/'.$orders->id.'/'.$house_id) }}">
                                    @csrf
                                    {{ method_field('DELETE')}}  
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this Description?')" title="Delete" alt="Delete">
                                        <i class="fa fa-trash-alt"> </i>
                                    </button>                          
                                </form>
                            </td>
                        @endif
                    </tr>              
                @endforeach
            @else
                <tr>
                    <td colspan="10" align="center">No Descriptions</td>
                </tr>
            @endif   
       


        </tbody>
    </table>
    <a href="{{ URL('/orders/'.$house_id) }}" class="btn bg-red">
        <i class="fa fa-arrow-left"> Back</i>
    </a>
@endsection
