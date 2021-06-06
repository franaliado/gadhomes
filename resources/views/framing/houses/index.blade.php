@extends('layout')

@section('content')

    @if(session('success'))
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="alert alert-success" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    </div>
    </div>
    @endif

    <h1>List of Houses</h1>
    <br/>

    <a href="{{ url('/houses/create') }}" class="btn btn-danger">
        <i class="fa fa-plus"> Add House</i></a>
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

    <table id="houses-table" class="table table-striped table-bordered" border='1' >
        <thead class="thead-light" bgcolor="red" style="color:white">
            <tr>
                <th style="text-align:center;vertical-align: middle">#</th>
                <th style="text-align:left;vertical-align: middle">Address</th>
                <th style="text-align:center;vertical-align: middle">Community</th>
                <th style="text-align:center;vertical-align: middle">Lot</th>
                <th style="text-align:center;vertical-align: middle">Status</th>
                <th style="text-align:center;vertical-align: middle;width:120px">Paid Out</th>
                <th style="text-align:center;vertical-align: middle">Paid All</th>
                <th style="text-align:center;vertical-align: middle">Subcontractor</th>
                @if (Auth::user()->role == 1)
                    <th colspan = "2" style="text-align:center;vertical-align: middle">Actions</th>                   
                @else
                    <th colspan = "1" style="text-align:center;vertical-align: middle">Actions</th>           
                @endif
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

                @if ($house->subcontractor)
                    @php $SubcontractorName = $house->subcontractor->name; @endphp
                @else
                    @php $SubcontractorName = ""; @endphp
                @endif
            
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>    
                    <td>{{ $house->address }}</td>  
                    <td align="center">{{ $house->community->name }}</td>
                    <td align="center">{{ $lot }}</td>
                    <td align="center">{{ $house->status }}</td>
                    <td align="center">{{$house->paid_out}}</td>
                    @if ($house->paid_all == 1)
                        <td align="center"><i class='fa fa-check' aria-hidden='true'></td>
                    @else
                        <td align="center"></td>
                    @endif
                    <td align="left">{{ $SubcontractorName }}</td>
                    @if (Auth::user()->role == 1)
                        <td align='center'> 
                            <form method="GET" action="{{ url('/houses/'.$house->id. '/edit') }}">
                                @csrf
                                {{ method_field('EDIT')}}  
                                <button type="submit" class="btn btn-primary btn-sm" title="Edit" alt="Edit")>
                                    <i class="fa fa-pen"> </i>
                                </button>                          
                            </form>
                        </td>
                    @endif
                    <td align='center'>
                        <a href="{{ url('/orders/'.$house->id) }}"">

                            <button type="button" class="btn btn-success btn-sm" title="PO" alt="PO">
                                <i class="fa fa-clipboard-check"> </i>
                            </button>                          
                        </a>
                    </td>
                </tr>                
            @endforeach
        </tbody>
    </table>
@endsection




