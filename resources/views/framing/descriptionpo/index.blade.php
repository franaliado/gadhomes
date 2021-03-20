@extends('layout')

@section('content')

    <h1>Descriptions of Purchase Order Nº {{ $orders->num_po }}</h1>
    <br/>

    <a href="{{ url('/descriptionpo/'.$orders->id.'/'.$house_id.'/create') }}" class="btn btn-danger">
        <i class="fa fa-plus"> Add Description </i>
    </a> 
    <br/><br/>


    <table class="table table-light table-hover" border='1' >
        <thead class="thead-light" bgcolor="red" style="color:white">
            <tr>
                <th>#</th>
                <th style="text-align:center;vertical-align: middle">Description</th>
                <th style="text-align:center;vertical-align: middle">Option</th>
                <th style="text-align:center;vertical-align: middle">Qty P.O.</th>
                <th style="text-align:center;vertical-align: middle">Unit Price<t/h>
                <th colspan = "2" style="text-align:center;vertical-align: middle">Actions</th>
            </tr>
        </thead>

        <tbody>
 
            @if (count($descriptionpos) > 0)
                @foreach ($descriptionpos as $descriptionpo)
                    <tr>
                        <td>{{ $loop->iteration }}</td>    
                        <td align="left">{{ $descriptionpo->description }}</td>
                        <td align="center">{{ $descriptionpo->option }}</td>
                        <td align="right">{{ $descriptionpo->qty_po }}</td>
                        <td align="right">{{ $descriptionpo->unit_price }}</td>

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
