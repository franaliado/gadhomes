<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Resume</title>
	<style>
		html, body {
			font-family: 'Open Sans', sans-serif;
			margin: 0 !important;
			padding: 0 !important;
		}
		table {
			border-collapse:collapse;
		}
		.table {
			margin-bottom: 25px;
		}
		.table td {
			border: solid 1px #ccc !important;
			border-spacing: 0px;
			padding: 10px;
		}
		.no-table td {
			border: none !important;
		}
		
		.pull-left {
			float: left;
		}
		.pull-right {
			float: right;
		}

	</style>
</head>
<body>
	<section class="resume" style="padding: 20px;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">Date: {{ date("m-d-Y") }}</div>
			</div>
			<div class="row">
				<table width="100%">
					<tr>
						<td>
							<h1>GAD FRAMING INC.</h1>
							<h3>PAYMENT SUMMARY</h3>
						</td>
						<td align="right">
							<img src="data:image/png;base64,{{ $logo }}" class="pull-right"/>
						</td>
					</tr>
				</table>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table" width="100%">
						<tr>
							<td><strong>SUBCONTRACTOR:  </strong> {{ $resume->name }}</td>
							<td>
								<p><strong>Phone:  </strong> {{ $resume->phone }}</p>
								<p><strong>Email:  </strong> {{ $resume->email }}</p>
							</td>
						</tr>
					</table>
				</div>
			</div>

			@php($totalgen = $totalhouses)

			<div class="row">
				<!-- Payments -->
				<div class="col-md-6" style="float:left">
					<table class="table" width="50%" style="font-size: 10pt" >
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
							<td colspan="4" style="text-align:right">
								<strong>Total Payments</strong>&emsp;&emsp;&emsp;$  {{ number_format($totalpay, 2, '.', ',') }}
							</td>
						</tr>
					</table>
				</div>

				<!-- Tools -->
				<div class="col-md-6" style="float:left" >
					<table class="table" width="50%" style="font-size: 10pt">
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
							<td colspan="4" style="text-align:right">
								<strong>Total Tools</strong>&emsp;&emsp;&emsp;$  {{ number_format($totaltool, 2, '.', ',') }}
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
					<table class="table">
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

			<div class="row">
				<div class="col-12" style="float:left;">
					<FONT SIZE=3>I received: __________________________</font><br><br>
					<FONT SIZE=3>Date: _________________________</font>
				</div>
			</div>
		</div>

	</section>
</body>
</html>