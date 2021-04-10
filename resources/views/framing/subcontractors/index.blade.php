@extends('layout')

@section('content')
    <h1>List of Subcontractors</h1>
    <br/>
    <a href="{{ url('/subcontractors/create') }}" class="btn btn-danger">
        <i class="fa fa-plus"> Add New Subcontractor</i></a>
    <br/><br/>

    
    <div class="col-md-4">
        <form class="form-inline ml-3">

            <input class="float-right"  size="30" type="search" name="search" placeholder="Search">
            <button type="submit" class="btn btn-navbar">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    <br><br>

    <table id="subcontractors-table" class="table table-striped table-bordered" border='1' >
        <thead class="thead-light" bgcolor="red" style="color:white">
            <tr>
                <th style="text-align:center;vertical-align: middle">#</th>
                <th style="text-align:left;vertical-align: middle">Name</th>
                <th style="text-align:center;vertical-align: middle">Phone</th>
                <th style="text-align:center;vertical-align: middle">Email</th>
                <th style="text-align:center;vertical-align: middle">Total Amount <br>to Pay</th>
                <th colspan = "4" style="text-align:center;vertical-align: middle">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($subcontractors as $subcontractor)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>    
                    <td>{{ $subcontractor-> name }}</td>  

                    <td align="center">{{ $subcontractor-> phone }}</td>
                    <td align="center">{{ $subcontractor-> email }}</td>

                    @php $totalhouses = 0; @endphp
                    @foreach ($subcontractor->houses as $houses)
                        @php $totaladditional = 0; @endphp
                        @foreach ($houses->additional as $additional)
                            @php $totaladditional += $additional->amount; @endphp
                        @endforeach
                        @php $totalhouses += ($houses->amount_assigned_subc + $totaladditional); @endphp
                    @endforeach

                    @php $totaltools = 0; @endphp
                    @foreach ($subcontractor->tools as $tools)
                        @php $totaltools += $tools->amount; @endphp
                    @endforeach

                    @php $totalpayments = 0; @endphp
                    @foreach ($subcontractor->payments as $payments)
                        @php $totalpayments += $payments->amount; @endphp
                    @endforeach

                    @php $total = $totalhouses - $totaltools - $totalpayments; @endphp

                    <td align="right">{{ number_format($total, 2, '.', ',') }}</td>

                    <td align='center'> 
                        <form method="GET" action="{{ url('/subcontractors/'.$subcontractor->id. '/edit') }}">
                            @csrf
                            {{ method_field('EDIT')}}  
                            <button type="submit" class="btn btn-primary btn-sm" title="Edit" alt="Edit")>
                                <i class="fa fa-pen"> </i>
                            </button>                          
                        </form>
                    </td>
                    <td align='center'>
                        <a href="{{ url('/tools/'.$subcontractor->id) }}"">

                            <button type="button" class="btn btn-success btn-sm" title="Tools" alt="Tools">
                                <i class="">Tools</i>
                            </button>                          
                        </a>
                    </td>
                    <td align='center'>
                        <a href="{{ url('/payments/'.$subcontractor->id) }}"">

                            <button type="button" class="btn btn-success btn-sm" title="Payments" alt="Payments">
                                <i class="">Pay</i>
                            </button>                          
                        </a>
                    </td>
                    <td align='center'>
                        <a href="/resume/{{$subcontractor->id}}">

                            <button type="button" class="btn btn-warning btn-sm" title="Resume" alt="Resume">
                                <i class="fa fa-clipboard-check"> </i>
                            </button>                          
                        </a>
                    </td>
                    <!--
                    <td align='center'>
                        <form method="post" action="{{ url('/subcontractors/'.$subcontractor->id) }}">
                            @csrf
                            {{ method_field('DELETE')}}  
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this subcontractor?')" title="Delete" alt="Delete">
                                <i class="fa fa-trash-alt"> </i>
                            </button>                          
                        </form>
                    </td>
                    -->
                </tr>                
            @endforeach

        </tbody>
    </table>
    {{ $subcontractors -> links() }}
    <br>
    <a href="{{ URL('/subcontractor_amount') }}" class="btn bg-red">
        <i class="fa fa-arrow-left"> Back</i>
    </a>
@endsection




