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


        <div class="form-box3" id="create-community">
        <div class="header"><b>Add New Community</b></div>
        <form method="POST" action="{{ url('/community/store') }}">
            @csrf

            <div class="body bg-gray">

                    <!-- Registros -->

                <div class="row g-3">
                    <div class="form-group row col-md-4">
                        <label for="name" class="col-md-6 col-form-label text-md-right">{{ __('Community Name') }}</label>
                        <div class="col-md-12">
                            <input id="name" type="text" maxlength="150" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <a href="{{ url('/community') }}" class="btn bg-red">
                    <i class="fa fa-arrow-left"> Back</i>
                </a>
                <button type="submit" class="btn bg-red">
                    <i class="fa fa-check-circle"> Save</i>
                </button>
            </div>
        </form>
        </div>
        </div>

@endsection
