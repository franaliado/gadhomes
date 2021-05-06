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


        <div class="form-box3" id="report-subcontractors">
        <div class="header"><b>Report of Subcontractors</b></div>
        <form method="POST" action="{{ url('/houses') }}">
            @csrf

            <div class="body bg-gray">

                    <!-- Registros -->

   
                <div class="row g-3">
                    <div class="form-group row col-md-4">
                        <label for="subcontractor" class="col-md-6 col-form-label text-md-right">{{ __('Subcontractor') }}</label>
    
                        <div class="col-md-12">
                            <select id="subcontractor" name="subcontractor" class="form-control" required>
                                <option value="0">All</option>
                                @foreach($subcontractors as $subcontractor)
                                    <option value="{{ $subcontractor->id }}" "{{ old('subcontractor') == $subcontractor->id ? 'selected': "" }}"> {{ $subcontractor->name }} </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="date_from" class="col-md-6 col-form-label text-md-right">{{ __('From') }}</label>
                        <div class="col-md-12">
                            <input id="date_from" type="date" max="date_until" class="form-control @error('date_from') is-invalid @enderror" name="date_from" value="{{ old('date_from') }}" required autocomplete="date_from" autofocus>

                            @error('date_from')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="date_until" class="col-md-6 col-form-label text-md-right">{{ __('Until') }}</label>
                        <div class="col-md-12">
                            <input id="date_until" type="date" class="form-control @error('date_until') is-invalid @enderror" name="date_until" value="{{ old('date_until') }}" required autocomplete="date_until" autofocus>

                            @error('date_until')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div> 
                    
                </div>

            <div class="footer">
                <a href="{{ URL('/home') }}" class="btn bg-red">
                    <i class="fa fa-arrow-left"> Back</i>
                </a>
                <button type="submit" class="btn bg-red">
                    <i class="fa fa-print"> Report</i>
                </button>
            </div>
        </form>
        </div>

    <script>
        $(document).ready(function() {
            $('#date_from').datepicker();
        });
        ");
        
        $objResponse->addScript("
        $(document).ready(function() {
            $('#date_until').datepicker();
        });
        ");
    </script>

@endsection
