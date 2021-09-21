@extends('layout')

@section('content')

<section class="resume" style="padding: 20px;">
	<a href="{{ URL('/rep_po') }}" class="btn bg-red">
		<i class="fa fa-arrow-left"> Back</i>
	</a>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6"><strong>Date: {{ date("m-d-Y") }}</strong></div>
			<div class="col-md-6"><a href="/rep_po_PDF/{{$paid}}/{{$FromDate}}/{{$ToDate}}" class="btn btn-default pull-right"><i class="fa fa-download"></i></a></div>
		</div>
		<div class="row">
			<div class="col-md-11">
				<br>
				<div class="col-md-1"><img src="/images/logos/GAD_Logo6.png" class="pull-left" width="200px" height="100px"></div>
				<br><h2 align="center">Report of Pucharse Orders</h2><br>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				@if($FromDate == "Null")
					@if($paid == "Yes")
						<p align="center"><FONT SIZE=5><strong>PAID</strong></font></p>
					@else
						<p align="center"><FONT SIZE=5><strong>UNPAID</strong></font></p>
					@endif
				@else
					<table class="" align="center" width="60%">
						<thead class="thead-light" bgcolor="red" style="color:white">
							<tr align="center">
								<td>
									<b>Paid</b>
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
								<p><FONT SIZE=3><strong> {{ $paid }}</strong></font></p>
							</td>
							<td>
								<p><FONT SIZE=3><strong>{{date("m-d-Y", strtotime($FromDate))}}</strong></font></p>
							</td>
							<td
								<p><FONT SIZE=3><strong>{{date("m-d-Y", strtotime($ToDate))}}</strong></font></p>
							</td>
						</tr>
					</table>
				@endif
			</div>
		</div>


		<div class="row">
			<div class="col-md-12">
				<table id="houses-table" style="magin-top:500px" class="table table-striped table-bordered" border='1' >
					<thead class="thead-light" bgcolor="red" style="color:white">
						<tr>
							<th style="text-align:center;vertical-align: middle;width:60px">#</th>
							<th style="text-align:center;vertical-align: middle">Nº P.O.</th>
							<th style="text-align:center;vertical-align: middle">Type P.O.</th>
							<th style="text-align:center;vertical-align: middle">Date P.O.</th>
							<th style="text-align:center;vertical-align: middle">Amount</th>
						</tr>
					</thead>
			
					<tbody>
						@php $total = 0; @endphp
						@foreach ($orders as $order)	
							@php $totaldescriptionpo = 0; @endphp	
							@foreach ($descriptionpos as $descriptionpo)
								@if ($descriptionpo->order_id == $order->id)
									@php $totaldescriptionpo += ($descriptionpo->unit_price * $descriptionpo->qty_po); @endphp
								@endif
							@endforeach

							<tr>
								<td align="center">{{ $loop->iteration }}</td>    
								<td align="center">{{ $order->num_po }}</td>
								<td align="center">{{ $order->type_PO }}</td> 
								<td align="center">{{date("m-d-Y", strtotime($order->date_order))}}</td>  
								<td align="right">{{ number_format($totaldescriptionpo, 2, '.', ',') }}</td>
							</tr>   
							@php $total += $totaldescriptionpo; @endphp        
						@endforeach
					</tbody>
					<tr>
						<td align="right" colspan="5"> 
							<h4><strong>TOTAL: &emsp;&emsp;&emsp;$  {{ number_format($total, 2, '.', ',') }} </strong></h4>
						</td>
					</tr>
				</table>
			</div>
		</div>

	</div>
</section>

@endsection
