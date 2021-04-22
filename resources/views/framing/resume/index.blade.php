@extends('layout')

@section('content')

<section class="resume" style="padding: 20px;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6"><strong>Date: {{ date("m-d-Y") }}</strong></div>
			<!--<div class="col-md-6"><a href="/resumePdf/{{ $resume->subcontractor_id }}/{{ $totalhouses }}" class="btn btn-default pull-right"><i class="fa fa-download"></i></a></div> -->
		</div>
		<div class="row">
			<div class="col-md-11">
				<h1 align="center">GAD FRAMING INC.</h1>
				<h3 align="center">PAYMENT SUMMARY</h3>
			</div>
			<div class="col-md-1"><img src="/images/logo_invoice.jpg" class="pull-right"></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered">
					<tr>
						<td>
							<p><FONT SIZE=3><strong>SUBCONTRACTOR:  </strong> {{ $resume->name }}</font></p>
						</td>
						<td>
							<p><FONT SIZE=3><strong>Phone:  </strong> {{ $resume->phone }}</font></p>
							<p><FONT SIZE=3><strong>Email:  </strong> {{ $resume->email }}</font></p>
						</td>
					</tr>
				</table>
			</div>
		</div>

		@php($totalgen = $totalhouses)
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
			<!-- Totals -->
			<div class="col-md-6" style="float:left;">
			</div>
			<div class="col-md-6" style="float:left;">
				<table class="table table-bordered">
					<tr>
						<td align="right">
							<strong>TOTAL AMOUNT TO PAY:</strong>&emsp;&emsp;&emsp;$  {{ number_format($totalhouses, 2, '.', ',') }}
						</td>
					</tr>
					<tr>
						<td align="right" >
							<strong>Total Payments:</strong>&emsp;&emsp;&emsp;- $  {{ number_format($totalpay, 2, '.', ',') }}
						</td>
					</tr>
					<tr>
						<td align="right" >
							<strong>Total Tools:</strong>&emsp;&emsp;&emsp;- $  {{ number_format($totaltool, 2, '.', ',') }}
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
		<br>
		<FONT SIZE=3>I received: __________________________</font><br><br>
			<FONT SIZE=3>Date: _________________________</font>
		<br><br>
	</div>
	<a href="{{ URL('/subcontractors') }}" class="btn bg-red">
		<i class="fa fa-arrow-left"> Back</i>
	</a>
</section>

@endsection
