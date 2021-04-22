<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
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
	<section class="invoice" style="padding: 20px;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">Date: {{ date("m-d-Y") }}</div>
			</div>
			<div class="row">
				<table>
					<tr>
						<td>
							<h1>GAD FRAMING INC.</h1>
							<h3>PAYMENT SUMMARY</h3>
						</td>
						<td>
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
				<table border="0" width="100%">
					<tr>
						<td width="50%">
							<table class="table">
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
						</td>
						<td>

							<!-- Tools -->
							<table class="table">
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
						</td>
					</tr>
				</table>



			</div>
		</div>
	</section>
</body>
</html>