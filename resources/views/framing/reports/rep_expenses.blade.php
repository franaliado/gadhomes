@extends('layout')

@section('content')
    <script>
        $(function() {
            var users = @json($users);
            var expenses = @json($expenses);

            var listExp = [];
            var listPay = [];

            $("#user").on('change', function() {
                let val = $(this).val();
                listExp = [];
                $('#type_expense').empty();
                $('#type_expense').append("<option value='0'>All</option>");
                listPay = [];
                $('#type_pay').empty();
                $('#type_pay').append("<option value='0'>All</option>");
                $.each(expenses, function(index, value){
                    if(value.user_id==val) {
                        if(!listExp.includes(value.type_expense)) {
                            listExp.push(value.type_expense);
                        }
                    }
                });
                $.each(listExp, function(i, v) {
                    $('#type_expense').append("<option value='"+ v + "'>"+ v +"</option>");
                });
            });

            $("#type_expense").on('change', function() {
                let val = $(this).val();
                listPay = [];
                $('#type_pay').empty();
                $('#type_pay').append("<option value='0'>All</option>");

                $.each(expenses, function(index, value){
                    if(value.user_id==$("#user").val()) {
                        if(value.type_expense == val) {
                            if(!listPay.includes(value.type_pay)) {
                                listPay.push(value.type_pay);
                            }
                        }
                    }
                });
                $.each(listPay, function(i, v) {
                    $('#type_pay').append("<option value='"+ v + "'>"+ v +"</option>");
                });

            });

        });

        var actualizarLista = function() {

        }
    </script>

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


        <div class="form-box3" id="report-expenses">
        <div class="header"><b>Report of Expenses</b></div>
        <form method="POST" action="{{ url('/report_expenses') }}">
            @csrf

            <div class="body bg-gray">

                    <!-- Registros -->
   
                <div class="row g-3">
                    <div class="form-group row col-md-4">
                        <label for="user" class="col-md-6 col-form-label text-md-right">{{ __('User') }}</label>
    
                        <div class="col-md-12">
                            <select id="user" name="user" class="form-control" required>
                                <option value="0" selected>All</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" "{{ old('user') == $user->id ? 'selected': "" }}"> {{ $user->name }} </option>
                                @endforeach
                            </select>

                        </div>
                    </div>  

                    <div class="form-group row col-md-4">
                        <label for="type_expense" class="col-md-6 col-form-label text-md-right">{{ __('Expenses') }}</label>
    
                        <div class="col-md-12">
                            <select id="type_expense" name="type_expense" class="form-control" required>
                                <option value="0" selected>All</option>
                            </select>
                        </div>
                    </div>  
                    
                    <div class="form-group row col-md-4">
                        <label for="type_pay" class="col-md-6 col-form-label text-md-right">{{ __('Payment Type') }}</label>
    
                        <div class="col-md-12">
                            <select id="type_pay" name="type_pay" class="form-control" required>
                                <option value="0" selected>All</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="form-group row col-md-4">
                        <label for="FromDate" class="col-md-6 col-form-label text-md-right">{{ __('From') }}</label>
                        <div class="col-md-12">
                            <input id="FromDate" type="date" class="form-control @error('FromDate') is-invalid @enderror" name="FromDate" value="{{ old('FromDate') }}"  required autocomplete="FromDate" autofocus>

                            @error('FromDate')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row col-md-4">
                        <label for="ToDate" class="col-md-6 col-form-label text-md-right">{{ __('To') }}</label>
                        <div class="col-md-12">
                            <input id="ToDate" type="date" class="form-control @error('ToDate') is-invalid @enderror" name="ToDate" value="{{ old('ToDate') }}" required autocomplete="ToDate" autofocus>

                            @error('ToDate')
                                <span class="invalid-feedback" role="alert">
                                    <font color="red"><strong>{{ $message }}</strong></font>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer">
                <a href="{{ URL('/home') }}" class="btn bg-red">
                    <i class="fa fa-arrow-left"> Back</i>
                </a>
                <button type="reset" class="btn bg-red" >
                    <i class="fa fa-refresh"> Reset</i>
                </button>
                <button type="submit" class="btn bg-red">
                    <i class="fa fa-print"> Report</i>
                </button>
            </div>
        </form>
        </div>
        </div>

@endsection
