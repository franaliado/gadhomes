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

    <h1>List of Tools</h1> 
    <img src="/images/logos/GAD_Logo6.png" class="pull-right" width="20%" height="20%">
    <br> 
    <b>Subcontractor: {{ $subcontractor->name }}</b>
    <br>
    Total Tools: {{ number_format($totaltools, 2, '.', ',') }}</font>
    <br><br>
    <a href="{{ url('/tools/'.$subcontractor->id.'/create') }}" class="btn btn-danger">
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
                @if (Auth::user()->role == 1)
                    <th colspan = "2" style="text-align:center;vertical-align: middle">Actions</th>
                @endif
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

                        @if (Auth::user()->role == 1)
                            <td align='center'> 
                                <form method="GET" action="{{ url('/tools/'.$tool->id.'/'.$subcontractor->id.'/edit') }}">
                                    @csrf
                                    {{ method_field('EDIT')}}  
                                    <button type="submit" class="btn btn-primary btn-sm" title="Edit" alt="Edit")>
                                        <i class="fa fa-pen"> </i>
                                    </button>                          
                                </form>
                            </td>
                            <td align='center'>
                                <form method="post" action="{{ url('/tools/'.$tool->id.'/'.$subcontractor->id) }}">
                                    @csrf
                                    {{ method_field('DELETE')}}  
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this Tool?')" title="Delete" alt="Delete">
                                        <i class="fa fa-trash-alt"> </i>
                                    </button>                          
                                </form>
                            </td>
                        @endif
                    </tr>              
                @endforeach
            @else
                <tr>
                    <td colspan="10" align="center">No Tools</td>
                </tr>
            @endif   
       
        </tbody>
    </table>
    <a href="{{ URL('/subcontractors') }}" class="btn bg-red">
        <i class="fa fa-arrow-left"> Back</i>
    </a>
@endsection
