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

        <div class="form-box2" id="change-password">
        <div class="header"><b>Change Password</b></div>
        <form method="POST" action="{{ url('/users/passwordchange/'. Auth::user()->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="body bg-gray">
 
                    <!-- Registros -->   
                    <div class="form-group row">
                        <div class="form-group row">
                            <label for="actualpassword" class="col-md-4 col-form-label text-md-right">{{ __('Actual Password') }}</label>
    
                            <div class="col-md-12">
                                <input id="actualpassword" type="password" maxlength="15" class="form-control @error('actualpassword') is-invalid @enderror" name="actualpassword" required autocomplete="actualpassword" placeholder="Actual Password">
    
                                @error('actualpassword')
                                    <span class="invalid-feedback" role="alert">
                                        <font color="red"><strong>{{ $message }}</strong></font>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
    
                            <div class="col-md-12">
                                <input id="password" type="password" maxlength="15" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password">
    
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <font color="red"><strong>{{ $message }}</strong></font>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="password-confirm" min='6' class="col-md-8 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>
    
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" maxlength="15" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Retype New Password">
                            </div>
                        </div>
                    </div>
   
            </div>
            

            <div class="footer">
                <a href="{{ URL('/home') }}" class="btn bg-red">
                    <i class="fa fa-arrow-left">  Back</i>
                </a>
                <button type="submit" class="btn bg-red">
                    <i class="fa fa-check-circle">  Edit</i>
                </button>
            </div>
        </form>
        </div>

@endsection