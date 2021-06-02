@extends('layout')

@section('content')

        @if(isset($error))
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="alert alert-danger" role="alert">
                  <p>{{ $error }}</p>
              </div>
            </div>
          </div>
        @endif

        <div class="form-box2" id="create-users">
            <div class="header">Register New Membership</div>
            <form method="POST" action="{{ url('/users/store') }}">
                @csrf

                <div class="body bg-gray">

                      <!-- Registros -->
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full Name">

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
                            <input id="username" type="text" maxlength="12" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="User Name">

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
                            <input id="position" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{ old('position') }}" required autocomplete="position" autofocus placeholder="Position">

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
                                <option value="1">Level 1</option>
                                <option value="2">Level 2</option>
                                <option value="3">Level 3</option>
                                <option value="4">Level 4</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-8 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                        <div class="col-md-12">
                            <input id="phone" type="text" maxlength="15" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="Phone Number">

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
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-12">
                            <input id="password" type="password" maxlength="15" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" min='6' class="col-md-8 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-12">
                            <input id="password-confirm" type="password" maxlength="15" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Retype Password">
                        </div>
                    </div>
                </div>

                <div class="footer">
                    <a href="{{ URL('/users') }}" class="btn bg-red">
                        <i class="fa fa-arrow-left"> Back</i>
                    </a>
                    <button type="submit" class="btn bg-red">
                        <i class="fa fa-check-circle"> Save</i>
                    </button>
                </div>
            </form>
        </div>
@endsection
