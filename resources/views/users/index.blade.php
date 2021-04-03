@extends('layout')

@section('content')
    <h1>List of Users</h1>
    <br/>
    <a href="{{ url('/users/create') }}" class="btn btn-danger">
        <i class="fa fa-plus"> Add User</i></a>
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
                <th style="text-align:center;vertical-align: middle">User Name</th>
                <th style="text-align:center;vertical-align: middle">Position</th>
                <th style="text-align:center;vertical-align: middle">Role</th>
                <th style="text-align:center;vertical-align: middle">Phone</th>
                <th style="text-align:center;vertical-align: middle">Email</th>
                <!--<th colspan = "1" style="text-align:center;vertical-align: middle">Actions</th> -->
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                @switch (strlen($user->role))
                @case(1)
                    @php $role = "Administrator"; @endphp
                    @break
                @case(2)
                    @php $role = "Superintendent"; @endphp
                    @break
                @case(3)
                    @php $role = "Assistant"; @endphp
                    @break
                @default
                    @php $role = "Vendor"; @endphp
                @endswitch

                <tr>
                    <td>{{ $loop->iteration }}</td>    
                    <td>{{ $user-> name }}</td>  
                    <td align="center">{{ $user-> username }}</td>
                    <td align="center">{{ $user-> position }}</td>
                    <td align="center">{{ $role }}</td>
                    <td align="center">{{ $user-> phone }}</td>
                    <td align="center">{{ $user-> email }}</td>
                    <!--
                    <td align='center'> 
                        <form method="GET" action="{{ url('/users/'.$user->id. '/edit') }}">
                            @csrf
                            {{ method_field('EDIT')}}  
                            <button type="submit" class="btn btn-primary btn-sm" title="Edit" alt="Edit")>
                                <i class="fa fa-pen"> </i>
                            </button>                          
                        </form>
                    </td>
                    
                    <td align='center'>
                        <form method="post" action="{{ url('/users/'.$user->id) }}">
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
    {{ $users -> links() }}
@endsection




