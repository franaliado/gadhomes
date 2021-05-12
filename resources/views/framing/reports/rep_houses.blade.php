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


        <div class="form-box3" id="report-houses">
        <div class="header"><b>Report of Houses</b></div>
        <form method="GET" action="{{ url('/rep_houses_options') }}">
            @csrf

            <div class="body bg-gray">

                    <!-- Registros -->

                <br>
                <table align="center">
                    <tr>
                        <td>
                            <input class="form-check-input" type="radio" name="rephouses" id="rephouses" value="1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                            Order by Communities
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="form-check-input" type="radio" name="rephouses" id="rephouses" value="2">
                            <label class="form-check-label" for="flexRadioDefault2">
                            Order by Subcontrators
                            </label>
                        </td>
                    </tr>
                </table>
                <br>
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
        </div>

@endsection
