@extends('layout')

@section('content')
    <h1>List of Houses with Subcontractors</h1>
    <br/>
    
    <div class="col-md-4">
        <form class="form-inline ml-3">

            <input class="float-right"  size="30" type="search" name="search" placeholder="Search">
            <button type="submit" class="btn btn-navbar">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    <br><br>

    <table id="houses-table" class="table table-striped table-bordered" border='1' >
        <thead class="thead-light" bgcolor="red" style="color:white">
            <tr>
                <th style="text-align:center;vertical-align: middle">#</th>
                <th style="text-align:left;vertical-align: middle">Address</th>
                <th style="text-align:center;vertical-align: middle">Community</th>
                <th style="text-align:center;vertical-align: middle">Lot</th>
                <th style="text-align:center;vertical-align: middle">Subcontractor</th>
                <th style="text-align:center;vertical-align: middle">Amount Assigned <br> SubContractor</th>
                <th colspan = "5" style="text-align:center;vertical-align: middle">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($houses as $house)

                @switch (strlen($house->lot))
                    @case(1)
                        @php $lot = "000" . $house->lot; @endphp
                        @break
                    @case(2)
                        @php $lot = "00" . $house->lot; @endphp
                        @break
                    @case(3)
                        @php $lot = "0" . $house->lot; @endphp
                        @break
                    @default
                        @php $lot = $house->lot; @endphp
                @endswitch

                <tr>
                    <td>{{ $loop->iteration }}</td>    
                    <td>{{ $house->address }}</td>  
                    <td align="center">{{ $house->community->name }}</td>
                    <td align="center">{{ $lot }}</td>
                    <td align="left">{{ $house->subcontractor->name }}</td>
                    <td align="right">{{ number_format($house->amount_assigned_subc, 2, '.', ',') }}</td>
                    <td align='center'> 
                        <form method="GET" action="{{ url('/subcontractor_amount/'.$house->id. '/edit') }}">
                            @csrf
                            {{ method_field('EDIT')}}  
                            <button type="submit" class="btn btn-primary btn-sm" title="Edit  Amount Assigned" alt="Edit")>
                                <i class="fa fa-pen"> </i>
                            </button>                          
                        </form>
                    </td>
                    <td align='center'>
                        <a href="{{ url('/additional/'.$house->id) }}"">

                            <button type="button" class="btn btn-success btn-sm" title="Additional" alt="Additional">
                                <i class="fa fa-coins"> </i>
                            </button>                          
                        </a>
                    </td>
                    <td align='center'>
                        <a href="{{ url('/tools/'.$house->id) }}"">

                            <button type="button" class="btn btn-success btn-sm" title="Tools" alt="Tools">
                                <i class="fa fa-comment-dollar"> </i>
                            </button>                          
                        </a>
                    </td>
                    <td align='center'>
                        <a href="{{ url('/payments/'.$house->id) }}"">

                            <button type="button" class="btn btn-success btn-sm" title="Payments" alt="Payments">
                                <i class="fa fa-funnel-dollar"> </i>
                            </button>                          
                        </a>
                    </td>
                    <td align='center'>
                        <a href="{{ url('/orders/'.$house->id) }}"">

                            <button type="button" class="btn btn-warning btn-sm" title="Resume" alt="Resume">
                                <i class="fa fa-clipboard-check"> </i>
                            </button>                          
                        </a>
                    </td>

                </tr>                
            @endforeach

        </tbody>
    </table>
    {{ $houses -> links() }}
@endsection




