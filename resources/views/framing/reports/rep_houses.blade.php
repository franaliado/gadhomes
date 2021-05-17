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
    <form method="GET" action="{{ url('/report_houses_options') }}">
        @csrf

        <div class="body bg-gray">

                <!-- Registros -->

            <br>
            <table align="center" border="0" cellpadding="10" >
                <tr>
                    <td rowspan="2">
                        <label for="status" class="col-md-6 col-form-label text-md-right">{{ __('Status') }}</label>
                        <div class="col-md-12">
                            <select id="status" name="status" class="form-control">
                                <option value="Started">Started</option>
                                <option value="Billed">Billed</option>
                                <option value="Paid">Paid</option>
                            </select>
                        </div>
                    </td>
                    <td width="250px">
                        <input class="form-check-input" type="radio" name="rephouses" id="rephouses" value="1" checked @change="myFunction(this)">
                        <label class="form-check-label" for="flexRadioDefault1">
                        Order by Communities
                        </label>

                        <label for="community" class="col-md-6 col-form-label text-md-right">{{ __('Community') }}</label>
                        <select id="community" name="community" class="form-control" required>
                            <option value="">---- Please Select ----</option>
                            @foreach($communitys as $community)
                                <option value="{{ $community->id }}" {{ old('community') == $community->id ? 'selected' : '' }}> 
                                        {{ $community->name }} 
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="form-check-input" type="radio" name="rephouses" id="rephouses" value="2" onclick="myFunction(this)">
                        <label class="form-check-label" for="flexRadioDefault2">
                        Order by Subcontractors
                        </label>

                        <label for="subcontractor" class="col-md-6 col-form-label text-md-right">{{ __('Subcontractor') }}</label>
                        <select id="subcontractor" name="subcontractor" class="form-control" required>
                            <option value="">---- Please Select ----</option>
                            @foreach($subcontractors as $subcontractor)
                                <option value="{{ $subcontractor->id }}" {{ old('subcontractor') == $subcontractor->id ? 'selected' : '' }}> 
                                        {{ $subcontractor->name }} 
                                </option>
                            @endforeach
                        </select>
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

    <script>
        function myFunction(selectObject) {
            alert("Entro");
            var value = selectObject.value;
            if (value == "1") {
                $("#community").attr("disabled",false);
                $("#subcontractor").attr("disabled",true);
                $("#subcontractor").val("");
            } else {
                $("#community").attr("disabled",true);
                $("#subcontractor").attr("disabled",false);
                $("#community").val("");
            }
        }


        $(document).ready(function(){
            alert("Entro 2");
            $('input[type=radio][name=rephouses]').change(function() {
                if (this.value == 1) {
                    alert("Select Male");
                }else if (this.value == 2) {
                    alert("Select Female");
                }
            });
      
        });
    </script>

@endsection
