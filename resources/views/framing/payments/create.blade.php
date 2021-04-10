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


        <div class="form-box3" id="create-payment">
        <div class="header"><b>Add New Payment</b></div>
        <form method="POST" action="{{ url('/payments/'.$subcontractor_id.'/store') }}">
            @csrf

            <div class="body bg-gray">

                    <!-- Registros -->

   
                <div class="row g-3">
                    <div class="form-group row col-md-4">
                        <label for="date" class="col-md-6 col-form-label text-md-right">{{ __('Date') }}</label>
                        <div class="col-md-12">
                            <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date" autofocus placeholder="Date">
    
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="type" class="col-md-6 col-form-label text-md-right">{{ __('Type') }}</label>
    
                        <div class="col-md-12">
                            <select id="type" name="type" class="form-control">
                                <option value="1">Cash</option>
                                <option value="2">Check</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="amount" class="col-md-12 col-form-label text-md-right">{{ __('Amount') }}</label>
                        <div class="col-md-12">
                            <input id="amount" type="number" step="0.01" style="text-align:right;" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount" autofocus placeholder="0.00">

                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

            <div class="footer">
                <a href="{{ url('/payments/'.$subcontractor_id) }}" class="btn bg-red">
                    <i class="fa fa-arrow-left"> Back</i>
                </a>
                <button type="submit" class="btn bg-red">
                    <i class="fa fa-check-circle"> Save</i>
                </button>
            </div>
        </form>
        </div>

@endsection
