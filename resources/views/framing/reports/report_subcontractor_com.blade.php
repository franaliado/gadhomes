@extends('layout')

@section('content')

<section class="resume" style="padding: 20px;">
	<a href="{{ URL('/rep_subcontractors') }}" class="btn bg-red">
		<i class="fa fa-arrow-left"> Back</i>
	</a>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6"><strong>Date: {{ date("m-d-Y") }}</strong></div>
			<div class="col-md-6"><a href="/rep_subcontractor_com_PDF/{{$community->id}}/{{$FromDate}}/{{$ToDate}}" class="btn btn-default pull-right"><i class="fa fa-download"></i></a></div>
		</div>
		<div class="row">
			<div class="col-md-11">
				<br>
				<h1 align="center">GAD FRAMING INC.</h1>
				<h2 align="center">Report of Subcontractors for Communities</h2>
			</div>
			<div class="col-md-1"><img src="/images/logo_invoice.jpg" class="pull-right"></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="" align="center" width="60%">
					<thead class="thead-light" bgcolor="red" style="color:white">
						<tr align="center">
							<td>
								<b>Community</b>
							</td>
							<td>
								<b>From</b>
							</td>
							<td>
								<b>To</b>
							</td>
						</tr>
					</thead>
					<tr align="center">
						<td>
							<p><FONT SIZE=3><strong> {{ $community->name }}</strong></font></p>
						</td>
						<td>
							<p><FONT SIZE=3><strong>{{date("m-d-Y", strtotime($FromDate))}}</strong></font></p>
						</td>
						<td
							<p><FONT SIZE=3><strong>{{date("m-d-Y", strtotime($ToDate))}}</strong></font></p>
						</td>
					</tr>
				</table>
			</div>
		</div>


		<div class="row">
			<div class="col-md-12">
				<table id="houses-table" style="magin-top:500px" class="table table-striped table-bordered" border='1' >
					<thead class="thead-light" bgcolor="red" style="color:white">
						<tr>
							<th style="text-align:center;vertical-align: middle">#</th>
							<th style="text-align:center;vertical-align: middle">Subcontractor</th>
							<th style="text-align:center;vertical-align: middle">Amount to Pay</th>
							<th style="text-align:center;vertical-align: middle">Tools</th>
							<th style="text-align:center;vertical-align: middle">Payments</th>
							<th style="text-align:center;vertical-align: middle">Total</th>
						</tr>
					</thead>
			
					<tbody>
						@foreach ($houses as $house)
							@php $total = 0; @endphp
							@php $totalpayments = 0; @endphp
							@foreach ($house->subcontractor->payments as $payments)
								@if ($payments->date >= $FromDate and $payments->date <= $ToDate)
									@php $totalpayments += $payments->amount; @endphp
								@endif
							@endforeach

							@php $totaltools = 0; @endphp
							@foreach ($house->subcontractor->tools as $tools)
								@if ($tools->date >= $FromDate and $tools->date <= $ToDate)
									@php $totaltools += $tools->amount; @endphp
								@endif
							@endforeach

							@php $total = $house->Total - $totalpayments - $totaltools; @endphp
							<tr>
								<td align="center">{{ $loop->iteration }}</td>    
								<td align="left">{{ $house->subcontractor->name }}</td>  
								<td align="right">{{ number_format($house->Total, 2, '.', ',') }}</td>
								<td align="right">{{ number_format($totaltools, 2, '.', ',') }}</td>
								<td align="right">{{ number_format($totalpayments, 2, '.', ',') }}</td>
								<td align="right">{{ number_format($total, 2, '.', ',') }}</td>
							</tr>                
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div>
</section>

@endsection
