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

        <div class="form-box3" id="create-expense">
        <div class="header"><b>Add New Expense</b></div>
        <form method="POST" action="{{ url('/expenses/'.$user_id.'/store') }}">
            @csrf

            <div class="body bg-gray">

                    <!-- Registros -->

   
                <div class="row g-3">
                    <div class="form-group row col-md-4">
                        <label for="type_expense" class="col-md-6 col-form-label text-md-right">{{ __('Expenses') }}</label>
    
                        <div class="col-md-12">
                            <select id="type_expense" name="type_expense" class="form-control">
                                <option value="Gas">Gas</option>
                                <option value="Tools-Materials">Tools-Materials</option>
                                <option value="Bills">Bills</option>
                                <option value="Foods">Foods</option>
                                <option value="Hotels">Hotels</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="description" class="col-md-6 col-form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-12">
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description" autofocus placeholder="Description">

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>

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
                </div>

                <div class="row g-3">
                    <div class="form-group row col-md-4">
                        <label for="type_pay" class="col-md-6 col-form-label text-md-right">{{ __('Payment Type') }}</label>
    
                        <div class="col-md-12">
                            <select id="type_pay" name="type_pay" class="form-control" onchange="myFunction(this)">
                                <option value="Check">Check</option>
                                <option value="Cash">Cash</option>
                                <option value="Card">Card</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="card" class="col-md-6 col-form-label text-md-right">{{ __('Card') }}</label>
    
                        <div class="col-md-12">
                            <select id="card" name="card" class="form-control" disabled required>
                                <option value="">---- Please Select ----</option>
                                <option value="Personal`s Card">Personal`s Card</option>
                                @if ($user_id <> 1)
                                    <option value="Saul`s Card">Saul`s Card</option>
                                @endif 
                                <option value="GAD`s Card">GAD`s Card</option>
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
                <a href="{{ url('/expenses/'.$user_id) }}" class="btn bg-red">
                    <i class="fa fa-arrow-left"> Back</i>
                </a>
                <button type="submit" class="btn bg-red">
                    <i class="fa fa-check-circle"> Save</i>
                </button>
            </div>
        </form>
        </div>

        <script>
            function myFunction(selectObject) {
                var value = selectObject.value;
                if (value == "Card") {
                    $("#card").attr("disabled",false);
                } else {
                    $("#card").val("");
                    $("#card").attr("disabled",true);
                }
            }
        </script>

@endsection
