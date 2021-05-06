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


        <div class="form-box3" id="edit-houses">
        <div class="header"><b>Edit House</b></div>
        <form method="POST" action="{{ url('/houses/' . $house->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="body bg-gray">

                    <!-- Registros -->   
                <div class="row g-3">
                    <div class="form-group row col-md-4">
                        <label for="address" class="col-md-6 col-form-label text-md-right">{{ __('Address') }}</label>
                        <div class="col-md-12">
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $house->address) }}" required autocomplete="address" autofocus placeholder="Address">

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="community" class="col-md-6 col-form-label text-md-right">{{ __('Community') }}</label>
    
                        <div class="col-md-12">
                            <select id="community" name="community" class="form-control" value="{{ old('community') }}" required>
                                @foreach($communitys as $community)                               
                                    <option value="{{ $community->id }}" {{ $community->id == $house->community_id  ? 'selected' : '' }}>
                                         {{ $community->name }} 
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="lot" class="col-md-6 col-form-label text-md-right">{{ __('Lot') }}</label>
                        <div class="col-md-12">
                            <input id="lot" type="number" min="1" max="9999" class="form-control @error('lot') is-invalid @enderror" name="lot" value="{{ old('lot', $house->lot) }}" required autocomplete="lot" autofocus placeholder="Lot">

                            @error('lot')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
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
                                <option value="Started" {{ $house->status == Started  ? 'selected' : '' }}>Started</option>
                                <option value="Billed" {{ $house->status == Billed  ? 'selected' : '' }}>Billed</option>
                                <option value="Paid" {{ $house->status == Paid  ? 'selected' : '' }}>Paid</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="start_date" class="col-md-6 col-form-label text-md-right">{{ __('Start Date') }}</label>
                        <div class="col-md-12">
                            <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date', $house->start_date) }}" required autocomplete="start_date" autofocus placeholder="Start Date">

                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <br/>
                        <div class="form-check">
                            <input type="hidden" name="withoutpo" value="0"/>
                            <input id="withoutpo" name="withoutpo" class="icheck" type="checkbox" value="1" {{ $house->withoutpo || old('withoutpo', 0) === 1 ?  'checked' : ''}}>
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
                                    <option value="{{ $subcontractor->id }}" {{ $subcontractor->id == $house->subcontractor_id  ? 'selected' : '' }}>
                                        {{ $subcontractor->name }} 
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="form-group row col-md-4">
            <!--            <label for="amount_assigned_subc" class="col-md-12 col-form-label text-md-right">{{ __('Amount Assigned SubContractor') }}</label>
                        <div class="col-md-12">
                            <input id="amount_assigned_subc" type="number" step="0.01" style="text-align:right;" class="form-control @error('amount_assigned_subc') is-invalid @enderror" name="amount_assigned_subc" value="{{ old('amount_assigned_subc', $house->amount_assigned_subc) }}" autocomplete="amount_assigned_subc" autofocus placeholder="0.00">
                        -->
                            @error('amount_assigned_subc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

            <div class="footer">
                <a href="{{ URL('/houses') }}" class="btn bg-red">
                    <i class="fa fa-arrow-left">  Back</i>
                </a>
                <button type="submit" class="btn bg-red">
                    <i class="fa fa-check-circle">  Edit</i>
                </button>
            </div>
        </form>
        </div>

@endsection