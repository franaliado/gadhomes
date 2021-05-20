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
                                <option value="">---- Please Select ----</option>
                                <option value="Started">Started</option>
                                <option value="Billed">Billed</option>
                                <option value="Paid">Paid</option>
                            </select>
                        </div>
                    </td>
                    <td width="250px">
                        <label for="community" class="col-md-6 col-form-label text-md-right">{{ __('Community') }}</label>
                        <select id="community" name="community" class="form-control" required onchange="MyFunctionCom(this)">
                            <option value="">---- Please Select ----</option>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="subcontractor" class="col-md-6 col-form-label text-md-right">{{ __('Subcontractor') }}</label>
                        <select id="subcontractor" name="subcontractor" class="form-control" required onchange="MyFunctionSub(this)">
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
        $(document).ready(function(){
            $("#status").on('change', (function(event){
                var status=$(this).val();
                if($.trim(status) != ''){
                    $.get('community', {status: status}, function(community){
                        $('#community').empty();
                        $.each(community, function(index, value){
                            $('#community').append("<option value='"+ index + "'>"+ value +"</option>");
                        });
                    });
                }
            });
        });
    </script> 

@endsection
