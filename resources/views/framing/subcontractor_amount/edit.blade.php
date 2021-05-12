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


        <div class="form-box3" id="edit-amount">
        <div class="header"><b>Edit Amount Assigned SubContractor</b></div>
        <form method="POST" action="{{ url('/subcontractor_amount/'.$house->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="body bg-gray">

                    <!-- Registros -->   
                <div class="row g-3">
                    <div class="form-group row col-md-4">
                        <label for="amount_assigned_subc" class="col-md-12 col-form-label text-md-right">{{ __('Amount Assigned SubContractor') }}</label>
                        <div class="col-md-12">
                            <input id="amount_assigned_subc" type="number" step="0.01" style="text-align:right;" class="form-control @error('amount_assigned_subc') is-invalid @enderror" name="amount_assigned_subc" value="{{ old('amount_assigned_subc', $house->amount_assigned_subc) }}" autocomplete="amount_assigned_subc" autofocus placeholder="0.00">
                       
                            @error('amount_assigned_subc')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <a href="{{ URL('/subcontractor_amount') }}" class="btn bg-red">
                    <i class="fa fa-arrow-left">  Back</i>
                </a>
                <button type="submit" class="btn bg-red">
                    <i class="fa fa-check-circle">  Save</i>
                </button>
            </div>
        </form>
        </div>
        </div>

@endsection