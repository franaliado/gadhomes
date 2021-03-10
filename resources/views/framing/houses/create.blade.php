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


        <div class="form-box3" id="create-houses">
        <div class="header"><b>Add New House</b></div>
        <form method="POST" action="{{ url('/houses') }}">
            @csrf

            <div class="body bg-gray">

                    <!-- Registros -->

   
                <div class="row g-3">
                    <div class="form-group row col-md-4">
                        <label for="address" class="col-md-6 col-form-label text-md-right">{{ __('Address') }}</label>
                        <div class="col-md-12">
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus placeholder="Address">

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="community" class="col-md-6 col-form-label text-md-right">{{ __('Community') }}</label>
    
                        <div class="col-md-12">
                            <select id="community" name="community" class="form-control" value="{{ old('community') }}" required>
                                <option value="">---- Please Select ----</option>
                                @foreach($communitys as $community)
                                    <option value="{{ $community->id }}"> 
                                         {{ $community->name }} 
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="lot" class="col-md-6 col-form-label text-md-right">{{ __('Lot') }}</label>
                        <div class="col-md-12">
                            <input id="lot" type="number" min="1" max="99" class="form-control @error('lot') is-invalid @enderror" name="lot" value="{{ old('lot') }}" required autocomplete="lot" autofocus placeholder="Lot">

                            @error('lot')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="form-group row col-md-4">
                        <label for="status" class="col-md-6 col-form-label text-md-right">{{ __('Status') }}</label>
    
                        <div class="col-md-12">
                            <select id="status" name="status" class="form-control">
                                <option value="1">Started</option>
                                <option value="2">Billed</option>
                                <option value="3">Paid</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="start_date" class="col-md-6 col-form-label text-md-right">{{ __('Start Date') }}</label>
                        <div class="col-md-12">
                            <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" required autocomplete="start_date" autofocus placeholder="Start Date">

                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <br/>
                        <div class="form-check">
                            <input id="withoutpo" name="withoutpo" class="icheck" type="checkbox" value="1">
                            <label class="form-check-label" for="withoutpo">
                                Without PO
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="form-group row col-md-4">
                        <label for="subcontractor" class="col-md-6 col-form-label text-md-right">{{ __('Subcontractor') }}</label>
    
                        <div class="col-md-12">
                            <select id="subcontractor" name="subcontractor" class="form-control" required>
                                <option value="">---- Please Select ----</option>
                                @foreach($subcontractors as $subcontractor)
                                    <option value="{{ $subcontractor->id }}" "{{ old('subcontractor') == $subcontractor->id ? 'selected': "" }}"> {{ $subcontractor->name }} </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="amount_assigned_subc" class="col-md-12 col-form-label text-md-right">{{ __('Amount Assigned SubContractor') }}</label>
                        <div class="col-md-12">
                            <input id="amount_assigned_subc" type="number" step="0.01" style="text-align:right;" class="form-control @error('amount_assigned_subc') is-invalid @enderror" name="amount_assigned_subc" value="{{ old('amount_assigned_subc') }}" required autocomplete="amount_assigned_subc" autofocus placeholder="0.00">

                            @error('amount_assigned_subc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

            <div class="footer">
                <a href="{{ URL('/houses') }}" class="btn bg-red">Back</a>
                <button type="submit" class="btn bg-red">Save</button>
            </div>
        </form>
        </div>

@endsection
