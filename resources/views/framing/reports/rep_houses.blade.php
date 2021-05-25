@extends('layout')

@section('content')

<script>
    $(document).ready(function(){
        var communitys = @json($communitys);
        var subcontractors = @json($subcontractors);
        var houses = @json($houses);


        $("#status").on('change', (function(event){
            var status=$(this).val();
            if($.trim(status) != ''){
                $('#community').empty();
                $('#community').append("<option value=''>---- Please Select ----</option>");
                $('#subcontractor').empty();
                $('#subcontractor').append("<option value=''>---- Please Select ----</option>");
                var comunidades = [];
                $.each(houses, function(index, value){
                    if(value.status==status) {
                        if(!comunidades.includes(value.community_id)) {
                            comunidades.push(value.community_id);
                        }
                    }
                });
                $.each(comunidades, function(i, v) {
                    let c = communitys.find(function(e, index) {if(e.id == v)return e;});
                    $('#community').append("<option value='"+ v + "'>"+ c.name +"</option>");
                });
            }
        }));

        $("#community").on('change', (function(event){
            var comm=$(this).val();
            if($.trim(comm) != ''){
                $('#subcontractor').empty();
                $('#subcontractor').append("<option value=''>---- Please Select ----</option>");
                var subcontratores = [];
                $.each(houses, function(index, value){
                    if(value.status==$('#status').val()) {
                        let c = communitys.find(function(e, index) {if(e.id == $("#community").val())return e;});
                        if(value.community_id==c.id) {
                            if(!subcontratores.includes(value.subcontractor_id)) {
                                subcontratores.push(value.subcontractor_id);
                            }
                        }
                    }
                });


                $.each(subcontratores, function(i, v) {
                    let s = subcontractors.find(function(e, index) {if(e.id == v)return e;});
                    $('#subcontractor').append("<option value='"+ v + "'>"+ s.name +"</option>");
                });
            }
        }));
    });
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


    <div class="form-box3" id="report-houses">
    <div class="header"><b>Report of Houses</b></div>
    <form method="GET" action="{{ url('/report_houses_options') }}">
        @csrf

        <div class="body bg-gray">

                <!-- Registros -->

            <br>
            <table align="center" border="0" cellpadding="5" >
                <tr>
                    <td rowspan="2" align="center">
                        <label for="status" class="col-md-6 col-form-label text-md-right">{{ __('Status') }}</label>
                        <div class="col-md-12">
                            <select id="status" name="status" class="form-control" style="width:250px">
                                <option value="">---- Please Select ----</option>
                                <option value="Pending">Pending</option>
                                <option value="Billed">Billed</option>
                                <option value="Paid">Paid</option>
                                <option value="Paid PO1">Paid PO1</option>
                                <option value="Paid PO2">Paid PO2</option>
                            </select>
                        </div>
                    </td>
                    <td width="250px">
                        <label for="community" class="col-md-6 col-form-label text-md-right">{{ __('Community') }}</label>
                        <select id="community" name="community" class="form-control" required>
                            <option value="">---- Please Select ----</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="subcontractor" class="col-md-6 col-form-label text-md-right">{{ __('Subcontractor') }}</label>
                        <select id="subcontractor" name="subcontractor" class="form-control" required>
                            <option value="">---- Please Select ----</option>
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



@endsection
