@extends('layout')

@section('content')


<section class="rep_houses" style="padding: 20px;">
	<a href="{{ URL('/rep_houses') }}" class="btn bg-red">
		<i class="fa fa-arrow-left"> Back</i>
	</a>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6"><strong>Date: {{ date("m-d-Y") }}</strong></div>
			<div class="col-md-6"><a href="/rep_houses_PDF/{{$status}}/{{$community_id}}/{{$subcontractor_id}}" class="btn btn-default pull-right"><i class="fa fa-download"></i></a></div>
		</div>
		<div class="row">
			<div class="col-md-11">
				<div class="col-md-1"><img src="/images/logos/GAD_Logo6.png" class="pull-left" width="450%" height="450%"></div>
				<h3 align="center">Report of Houses</h3>
				<h4 align="center">
					@php $num =""; @endphp
					@if($status <> "0")
						<b>Status:</b> {{$status}}
						@php $num = " - "; @endphp
					@endif
					@if($community_id <> 0)
						{{$num}}<b>Community:</b> {{$community->name}}
					@endif
					@if($subcontractor_id <> 0)
						<br><b>Subcontractor:</b> {{$subcontractor->name}}
					@endif
				</h4>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<table id="houses-table" style="magin-top:500px" class="table table-striped table-bordered" border='1' >
					<thead class="thead-light" bgcolor="red" style="color:white">
						<tr>
							<th style="text-align:center;vertical-align: middle">#</th>
							@if ($status == "0") 
								<th style="text-align:center;vertical-align: middle">Status</th>
							@endif	
							@if ($community_id == "0")
								<th style="text-align:center;vertical-align: middle">Community</th>
							@endif	
							<th style="text-align:center;vertical-align: middle">Address</th>
							<th style="text-align:center;vertical-align: middle">Lot</th>
							@if ($subcontractor_id == "0")
								<th style="text-align:center;vertical-align: middle">Subcontractor</th>
							@endif	
							@if ($status == "0" or $status == "Paid") 
								<th style="text-align:center;vertical-align: middle">Paid Out</th>
								<th style="text-align:center;vertical-align: middle">All</th>
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
			
							<tr>
								<td align="center">{{ $loop->iteration }}</td> 
								@if ($status == "0") 
									<td align="center">{{ $house->status }}</td>  
								@endif
								@if ($community_id == "0")
									<td align="center">{{ $house->community->name }}</td>
								@endif
								<td align="left">{{ $house->address }}</td>  
								<td align="center">{{ $lot }}</td>
								@if ($subcontractor_id == "0")
									<td align="center">{{ $house->subcontractorName }}</td>
								@endif 
								@if ($status == "0" or $status == "Paid")  
									<td align="center">{{ $house->paid_out }}</td> 
									@if ($house->paid_all == 1)
										<td align="center"><i class='fa fa-check' aria-hidden='true'></td>
									@else
										<td align="center"></td>
									@endif  
								@endif
							</tr>                
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

@endsection