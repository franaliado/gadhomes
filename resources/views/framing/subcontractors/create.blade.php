@extends('layout')

@section('content')

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


        <div class="form-box3" id="create-subcontractors">
        <div class="header"><b>Add New Subcontractor</b></div>
        <form method="POST" action="{{ url('/subcontractors') }}">
            @csrf

            <div class="body bg-gray">

                    <!-- Registros -->

   
                <div class="row g-3">
                    <div class="form-group row col-md-4">
                        <label for="name" class="col-md-6 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-12">
                            <input id="name" type="text" maxlength="50" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="phone" class="col-md-6 col-form-label text-md-right">{{ __('Phone') }}</label>
                        <div class="col-md-12">
                            <input id="phone" type="text" maxlength="15" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="Phone">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
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
                </div>
            </div>

            <div class="footer">
                <a href="{{ URL('/subcontractors') }}" class="btn bg-red">
                    <i class="fa fa-arrow-left"> Back</i>
                </a>
                <button type="submit" class="btn bg-red">
                    <i class="fa fa-check-circle"> Save</i>
                </button>
            </div>
        </form>
        </div>

@endsection
