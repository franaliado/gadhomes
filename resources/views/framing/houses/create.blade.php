@extends('layout')

@section('content')

        @if($errors->any())
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-danger" role="alert">
                    <ul>
                    @foreach($errors->all() as $error)
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
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus placeholder="Address">

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
                            <select id="community" name="community" class="form-control" required>
                                <option value="">---- Please Select ----</option>
                                @foreach($communitys as $community)
                                    <option value="{{ $community->id }}" {{ old('community') == $community->id ? 'selected' : '' }}> 
                                         {{ $community->name }} 
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="lot" class="col-md-6 col-form-label text-md-right">{{ __('Lot') }}</label>
                        <div class="col-md-12">
                            <input id="lot" type="number" min="1" max="9999" class="form-control @error('lot') is-invalid @enderror" name="lot" value="{{ old('lot') }}" required autocomplete="lot" autofocus placeholder="Lot">

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
                                <option value="Pending">Pending</option>
                                <option value="Billed">Billed</option>
                                <option value="Paid">Paid</option>
                                <option value="Paid PO1">Paid PO1</option>
                                <option value="Paid PO2">Paid PO2</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="start_date" class="col-md-6 col-form-label text-md-right">{{ __('Start Date') }}</label>
                        <div class="col-md-12">
                            <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" autocomplete="start_date" autofocus>

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
                            <select id="subcontractor" name="subcontractor" class="form-control">
                                <option value="">---- Please Select ----</option>
                                @foreach($subcontractors as $subcontractor)
                                    <option value="{{ $subcontractor->id }}" {{ old('subcontractor') == $subcontractor->id ? 'selected': '' }}> {{ $subcontractor->name }} </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <a href="{{ URL('/houses') }}" class="btn bg-red">
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
