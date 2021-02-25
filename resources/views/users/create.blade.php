@extends('layout')

@section('content')
        <div class="form-box" id="login-box">
            <div class="header">Register New Membership</div>
            <form method="POST" action="{{ url('/users') }}">
                @csrf

                <div class="body bg-gray">

                      <!-- Registros -->
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>     
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full Name">
        
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>
        
                        <div class="col-md-12">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="User Name">
        
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cargo" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>
        
                        <div class="col-md-12">
                            <input id="cargo" type="text" class="form-control @error('cargo') is-invalid @enderror" name="cargo" value="{{ old('cargo') }}" required autocomplete="cargo" autofocus placeholder="Position">
        
                            @error('cargo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nivel" class="col-md-4 col-form-label text-md-right">{{ __('Access Level') }}</label>
        
                        <div class="col-md-12">
                            <select id="nivel" name="nivel" class="form-control">
                                <option value="1">Administrator</option>
                                <option value="2">Superintendente</option>
                                <option value="3">Assistant</option>
                                <option value="4">Vendor</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-8 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        
                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
        
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
        
                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
        
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-8 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
        
                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Retype Password">
                        </div>
                    </div>
                </div>

                <div class="footer">                    

                    <button type="submit" class="btn bg-red btn-block">Sign me up</button>
         
                </div>
            </form>
        </div>
@endsection


