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

    <h1>List of Communities</h1>
    <img src="/images/logos/GAD_Logo6.png" class="pull-right" width="20%" height="20%">
    <br><br>

    <a href="{{ url('/community/create') }}" class="btn btn-danger">
        <i class="fa fa-plus"> Add Community</i>
    </a> 
    <br><br><br>

    <table class="table table-light table-hover" border='1' >
        <thead class="thead-light" bgcolor="red" style="color:white">
            <tr>
                <th style="text-align:center;vertical-align: middle;width:60px">#</th>
                <th style="text-align:center;vertical-align: middle">Name</th>
                 @if (Auth::user()->role == 1)
                    <th colspan = "1" style="text-align:center;vertical-align: middle;width:120px">Actions</th>
                @endif
            </tr>
        </thead>

        <tbody>
 
            @if (count($community) > 0)
                @foreach ($community as $community)
                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>    
                        <td align="left">{{ $community->name }}</td>


                        @if (Auth::user()->role == 1)
                            <td align='center'> 
                                <form method="GET" action="{{ url('/community/'.$community->id.'/edit') }}">
                                    @csrf
                                    {{ method_field('EDIT')}}  
                                    <button type="submit" class="btn btn-primary btn-sm" title="Edit" alt="Edit")>
                                        <i class="fa fa-pen"> </i>
                                    </button>                          
                                </form>
                            </td>
                        @endif
                    </tr>              
                @endforeach
            @else
                <tr>
                    <td colspan="10" align="center">No Communities</td>
                </tr>
            @endif   
       
        </tbody>
    </table>
    <a href="{{ URL('/home') }}" class="btn bg-red">
        <i class="fa fa-arrow-left"> Back</i>
    </a>
@endsection
