@extends('layout')

@section('content')

@switch (strlen($resume->houseLot))
@case(1)
	@php $lot = "000" . $resume->houseLot; @endphp
	@break
@case(2)
	@php $lot = "00" . $resume->houseLot; @endphp
	@break
@case(3)
	@php $lot = "0" . $resume->houseLot; @endphp
	@break
@default
	@php $lot = $resume->houseLot; @endphp
@endswitch 

@php($totalgen = $resume->houseAmountAssigned)

<section class="resume" style="padding: 20px;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6"><strong>Date: {{ date("m-d-Y") }}</strong></div>
			<!--<div class="col-md-6"><a href="/resumePdf/{{ $resume->house_id }}" class="btn btn-default pull-right"><i class="fa fa-download"></i></a></div> -->
		</div>
		<div class="row">
			<div class="col-md-11">
				<h1 align="center">GAD FRAMING INC.</h1>
				<h3 align="center">RESUME</h3>
			</div>
			<div class="col-md-1"><img src="/images/logo_invoice.jpg" class="pull-right"></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered">
					<tr>
						<td><strong>House</strong></td>
						<td><strong>Subcontractor</strong></td>
					</tr>
					<tr>
						<td>
							<p><strong>Community: </strong> {{ $resume->communityName }}</p>
							<p><strong>Address: </strong> {{ $resume->houseAddress }}</p>
							<p><strong>Lot: </strong>{{ $lot }}</p>
						</td>
						<td>
							<p><strong>Subcontractor: </strong> {{ $resume->subcontractorName }}</p>
							<p><strong>Phone: </strong> {{ $resume->subcontractorPhone }}</p>
							<p><strong>Email: </strong> {{ $resume->subcontractorEmail }}</p>
							<p><strong>Amount Assigned: </strong> $ {{ number_format($resume->houseAmountAssigned, 2, '.', ',') }}</p>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="row">
			<!-- Additional -->
			<div class="col-md-6" style="float:left;">
				<table class="table table-bordered">
					<tr>
						<td align="center" colspan="3"><strong>ADDITIONAL</strong></td>
					</tr>
					<tr>
						<td align="left"><strong>Description</strong></td>
						<td align="center"><strong>Date</strong></td>
						<td align="right"><strong>Amount</strong></td>
					</tr>
					@php($totaladd = 0)
					@foreach($additional as $add)
						@php($totaladd += ($add->amount))
						<tr>
							<td align="left">{{ $add->description }}</td>
							<td align="center">{{date("m-d-Y", strtotime($add->date))}}</td>
							<td align="right">{{ number_format($add->amount, 2, '.', ',') }}</td>						
						</tr>
					@endforeach
					@php($totalgen += $totaladd)
					<tr>
						<td colspan="4">
							<p class="pull-right"><strong>Total Additional</strong>&emsp;&emsp;&emsp;$  {{ number_format($totaladd, 2, '.', ',') }}</p>
						</td>
					</tr>
				</table>
			</div>

			<!-- Tools -->
			<div class="col-md-6" style="float:left;">
				<table class="table table-bordered">
					<tr>
						<td align="center" colspan="3"><strong>TOOLS</strong></td>
					</tr>
					<tr>
						<td align="left"><strong>Description</strong></td>
						<td align="center"><strong>Date</strong></td>
						<td align="right"><strong>Amount</strong></td>
					</tr>
					@php($totaltool = 0)
					@foreach($tools as $tool)
						@php($totaltool += ($tool->amount))
						<tr>
							<td align="left">{{ $tool->description }}</td>
							<td align="center">{{date("m-d-Y", strtotime($tool->date))}}</td>
							<td align="right">{{ number_format($tool->amount, 2, '.', ',') }}</td>						
						</tr>
					@endforeach
					@php($totalgen -= $totaltool)
					<tr>
						<td colspan="4">
							<p class="pull-right"><strong>Total Tools</strong>&emsp;&emsp;&emsp;$  {{ number_format($totaltool, 2, '.', ',') }}</p>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="row">
			<!-- Payments -->
			<div class="col-md-6" style="float:left;">
				<table class="table table-bordered">
					<tr>
						<td align="center" colspan="3"><strong>PAYMENTS</strong></td>
					</tr>
					<tr>
						<td align="center"><strong>Date</strong></td>
						<td align="center"><strong>Type</strong></td>
						<td align="right"><strong>Amount</strong></td>
					</tr>
					@php($totalpay = 0)
					@foreach($payments as $payment)
						@php ($totalpay += ($payment->amount))

						@switch ($payment->type)
						@case(1)
							@php ($type = "Cash")
							@break
						@default
							@php ($type = "Check")
						@endswitch

						<tr>
							<td align="center">{{date("m-d-Y", strtotime($payment->date))}}</td>
							<td align="center">{{ $type }}</td>
							<td align="right">{{ number_format($payment->amount, 2, '.', ',') }}</td>						
						</tr>
					@endforeach
					@php($totalgen -= $totalpay)
					<tr>
						<td colspan="4">
							<p class="pull-right"><strong>Total Payments</strong>&emsp;&emsp;&emsp;$  {{ number_format($totalpay, 2, '.', ',') }}</p>
						</td>
					</tr>
				</table>
			</div>

			<!-- Totals -->
			<div class="col-md-6">
				<table class="table table-bordered">
					<tr>
						<td align="right">
							<strong>AMOUNT ASSIGNED:</strong>&emsp;&emsp;&emsp;$  {{ number_format($resume->houseAmountAssigned, 2, '.', ',') }}
						</td>
					</tr>
					<tr>
						<td align="right" >
							<strong>ADDITIONAL:</strong>&emsp;&emsp;&emsp;+ $  {{ number_format($totaladd, 2, '.', ',') }}
						</td>
					</tr>
					<tr>
						<td align="right" >
							<strong>TOOLS:</strong>&emsp;&emsp;&emsp;- $  {{ number_format($totaltool, 2, '.', ',') }}
						</td>
					</tr>
					<tr>
						<td align="right" >
							<strong>PAYMENTS:</strong>&emsp;&emsp;&emsp;- $  {{ number_format($totalpay, 2, '.', ',') }}
						</td>
					</tr>
					<tr>
						<td align="right" >
							<h4><strong>TOTAL: &emsp;&emsp;&emsp;$  {{ number_format($totalgen, 2, '.', ',') }}</strong></h4>
						</td>
					</tr>

				</table>
			</div>

		</div>
	</div>
	<a href="{{ URL('/subcontractor_amount') }}" class="btn bg-red">
		<i class="fa fa-arrow-left"> Back</i>
	</a>
</section>

@endsection
