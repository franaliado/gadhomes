@extends('layout')

@section('content')


<section class="rep_houses" style="padding: 20px;">
	<a href="{{ URL('/rep_houses') }}" class="btn bg-red">
		<i class="fa fa-arrow-left"> Back</i>
	</a>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6"><strong>Date: {{ date("m-d-Y") }}</strong></div>
			<div class="col-md-6"><a href="/rep_houses_PDF/{{$status}}/{{$community->id}}/{{$subcontractor->id}}" class="btn btn-default pull-right"><i class="fa fa-download"></i></a></div>
		</div>
		<div class="row">
			<div class="col-md-11">
				<h1 align="left">GAD FRAMING INC.</h1> 
				<h3 align="center">Report of Houses</h3>
				<h4 align="center"><b>Status:</b> {{$status}} -
				<b>Community:</b> {{$community->name}} -
				<b>Subcontractor:</b> {{$subcontractor->name}}</h4>
			</div>
			<div class="col-md-1"><img src="/images/logo_invoice.jpg" class="pull-right"></div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<table id="houses-table" style="magin-top:500px" class="table table-striped table-bordered" border='1' >
					<thead class="thead-light" bgcolor="red" style="color:white">
						<tr>
							<th style="text-align:center;vertical-align: middle">#</th>
							<th style="text-align:center;vertical-align: middle">Address</th>
							<th style="text-align:center;vertical-align: middle">Lot</th>
							<th style="text-align:center;vertical-align: middle">Start Date</th>
							<th style="text-align:center;vertical-align: middle">Without PO<t/h>
						</tr>
					</thead>
			
					<tbody>
						@foreach ($houses as $house)
			
							@switch ($house->withoutpo)
								@case(0)
									@php $withoutpo = "No"; @endphp
									@break
								@default
									@php $withoutpo = "Yes"; @endphp
							@endswitch
			
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
								<td align="center">{{ $loop->iteration }}</td>    
								<td align="left">{{ $house->address }}</td>  
								<td align="center">{{ $lot }}</td>
								<td align="center">{{date("m-d-Y", strtotime($house->start_date))}}</td>
								<td align="center">{{ $withoutpo }}</td>
							</tr>                
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

@endsection