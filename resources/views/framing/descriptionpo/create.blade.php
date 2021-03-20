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


        <div class="form-box3" id="create-description">
        <div class="header"><b>Add New Description PO</b></div>
        <form method="POST" action="{{ url('/descriptionpo/'.$order_id.'/'.$house_id.'/store') }}">
            @csrf

            <div class="body bg-gray">

                    <!-- Registros -->

   
                <div class="row g-3">
                    <div class="form-group row col-md-4">
                        <label for="description" class="col-md-6 col-form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-12">
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus placeholder="Description">

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="option" class="col-md-6 col-form-label text-md-right">{{ __('Option') }}</label>
                        <div class="col-md-12">
                            <input id="option" type="text" class="form-control @error('option') is-invalid @enderror" name="option" value="{{ old('option') }}" autocomplete="option" autofocus placeholder="Option">

                            @error('option')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="form-group row col-md-4">
                        <label for="qty_po" class="col-md-12 col-form-label text-md-right">{{ __('Qty PO') }}</label>
                        <div class="col-md-12">
                            <input id="qty_po" type="number" step="0.01" style="text-align:right;" class="form-control @error('qty_po') is-invalid @enderror" name="qty_po" value="{{ old('qty_po') }}" required autocomplete="qty_po" autofocus placeholder="0.00">

                            @error('qty_po')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="unit_price" class="col-md-12 col-form-label text-md-right">{{ __('Unit Price') }}</label>
                        <div class="col-md-12">
                            <input id="unit_price" type="number" step="0.01" style="text-align:right;" class="form-control @error('unit_price') is-invalid @enderror" name="unit_price" value="{{ old('unit_price') }}" required autocomplete="unit_price" autofocus placeholder="0.00">
    
                            @error('unit_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

            <div class="footer">
                <a href="{{ url('/descriptionpo/'.$order_id.'/'.$house_id) }}" class="btn bg-red">
                    <i class="fa fa-arrow-left"> Back</i>
                </a>
                <button type="submit" class="btn bg-red">
                    <i class="fa fa-check-circle"> Save</i>
                </button>
            </div>
        </form>
        </div>

@endsection
