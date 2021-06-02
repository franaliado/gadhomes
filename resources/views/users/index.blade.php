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
                <th style="text-align:center;vertical-align: middle">Active</th>
                <th colspan = "2" style="text-align:center;vertical-align: middle">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                @switch ($user->role)
                @case(1)
                    @php $role = "Level 1"; @endphp
                    @break
                @case(2)
                    @php $role = "Level 2"; @endphp
                    @break
                @case(3)
                    @php $role = "Level 3"; @endphp
                    @break
                @default
                    @php $role = "Level 4"; @endphp
                @endswitch

                @switch ($user->active)
                @case(1)
                    @php $active = "Yes"; @endphp
                    @break
                @default
                    @php $active = "No"; @endphp
                @endswitch

                <tr>
                    <td>{{ $loop->iteration }}</td>    
                    <td>{{ $user-> name }}</td>  
                    <td align="center">{{ $user-> username }}</td>
                    <td align="center">{{ $user-> position }}</td>
                    <td align="center">{{ $role }}</td>
                    <td align="center">{{ $user-> phone }}</td>
                    <td align="center">{{ $user-> email }}</td>
                    <td align="center">{{ $active }}</td>
                    
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
                        <form method="GET" action="{{ url('/users/'.$user->id. '/reset') }}">
                            @csrf
                            {{ method_field('EDIT')}}  
                            <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Do you want to reset the Password for this User?')" title="Reset Password" alt="Reset Password")>
                                <i class="fa fa-lock"> </i>
                            </button>                          
                        </form>
                    </td>
                </tr>                
            @endforeach

        </tbody>
    </table>
    {{ $users -> links() }}
@endsection




