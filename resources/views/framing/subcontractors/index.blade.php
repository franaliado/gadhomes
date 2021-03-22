@extends('layout')

@section('content')
    <h1>List of Subcontractors</h1>
    <br/>
    <a href="{{ url('/subcontractors/create') }}" class="btn btn-danger">
        <i class="fa fa-plus"> Add Subcontractor</i></a>
    <br/><br/>

    
    <div class="col-md-4">
        <form class="form-inline ml-3">

            <input class="float-right"  size="30" type="search" name="search" placeholder="Search">
            <button type="submit" class="btn btn-navbar">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    <br><br>

    <table id="subcontractors-table" class="table table-striped table-bordered" border='1' >
        <thead class="thead-light" bgcolor="red" style="color:white">
            <tr>
                <th>#</th>
                <th style="text-align:left;vertical-align: middle">Name</th>
                <th style="text-align:center;vertical-align: middle">Phone</th>
                <th style="text-align:center;vertical-align: middle">Email</th>
                <th colspan = "1" style="text-align:center;vertical-align: middle">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($subcontractors as $subcontractor)
                <tr>
                    <td>{{ $loop->iteration }}</td>    
                    <td>{{ $subcontractor-> name }}</td>  

                    <td align="center">{{ $subcontractor-> phone }}</td>
                    <td align="center">{{ $subcontractor-> email }}</td>
                    <td align='center'> 
                        <form method="GET" action="{{ url('/subcontractors/'.$subcontractor->id. '/edit') }}">
                            @csrf
                            {{ method_field('EDIT')}}  
                            <button type="submit" class="btn btn-primary btn-sm" title="Edit" alt="Edit")>
                                <i class="fa fa-pen"> </i>
                            </button>                          
                        </form>
                    </td>
                    <!--
                    <td align='center'>
                        <form method="post" action="{{ url('/subcontractors/'.$subcontractor->id) }}">
                            @csrf
                            {{ method_field('DELETE')}}  
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this subcontractor?')" title="Delete" alt="Delete">
                                <i class="fa fa-trash-alt"> </i>
                            </button>                          
                        </form>
                    </td>
                    -->
                </tr>                
            @endforeach

        </tbody>
    </table>
    {{ $subcontractors -> links() }}
@endsection




