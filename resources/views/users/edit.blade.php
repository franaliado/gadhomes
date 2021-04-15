@extends('layout')

@section('content')

        @if(session('success'))
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-danger" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        </div>
        </div>
        @endif

        @if(session('error'))
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-danger" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        </div>
        </div>
        @endif

        @if(isset($error))
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
	    <div class="alert alert-danger" role="alert">
		<ul>
		  @foreach($errors as $error)
                    <li>{{ $error }}</li>
		  @endforeach
		</ul>
            </div>
        </div>
        </div>
        @endif


        <div class="form-box2" id="edit-users">
        <div class="header"><b>Edit User</b></div>
        <form method="POST" action="{{ url('/users/'.$user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="body bg-gray">
 
                    <!-- Registros -->   
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus placeholder="Full Name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                        <div class="col-md-12">
                            <input id="username" type="text" maxlength="12" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}" required autocomplete="username" autofocus placeholder="User Name">

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>

                        <div class="col-md-12">
                            <input id="position" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{ old('position', $user->position) }}" required autocomplete="position" autofocus placeholder="Position">

                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                        <div class="col-md-12">
                            <select id="role" name="role" class="form-control">
                                <option value="1" {{ $user->role == 1  ? 'selected' : '' }}>Administrator</option>
                                <option value="2" {{ $user->role == 2  ? 'selected' : '' }}>Superintendent</option>
                                <option value="3" {{ $user->role == 3  ? 'selected' : '' }}>Assistant</option>
                                <option value="4" {{ $user->role == 4  ? 'selected' : '' }}>Vendor</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-8 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                        <div class="col-md-12">
                            <input id="phone" type="text" maxlength="15" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}" required autocomplete="phone" autofocus placeholder="Phone Number">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-8 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" placeholder="Email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>
            </div>
            

            <div class="footer">
                <a href="{{ URL('/users') }}" class="btn bg-red">
                    <i class="fa fa-arrow-left">  Back</i>
                </a>
                <button type="submit" class="btn bg-red">
                    <i class="fa fa-check-circle">  Edit</i>
                </button>
            </div>
        </form>
        </div>

@endsection