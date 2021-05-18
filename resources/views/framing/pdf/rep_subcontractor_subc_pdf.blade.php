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
			margin-bottom: 5px;
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

		<div class="row">
			<div>Date: {{ date("m-d-Y") }}</div>
		</div>
		<div class="row">
			<table width="100%">
				<tr>
					<td>
						<h1>GAD FRAMING INC.</h1>
					</td>
					<td align="right">
						<img src="data:image/png;base64,{{ $logo }}" class="pull-right"/>
					</td>
				</tr>
			</table>
		</div>
		<div class="row">
			<table class="" align="center" width="60%">
				<thead class="thead-light">
					<tr align="center" style="font-size: 12px; font-weight: bold; color: black" bgcolor="#D5DBDB">
						<td>
							<b>Subcontractor</b>
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
						<p><FONT SIZE=3><strong> {{ $subcontractor->name }}</strong></font></p>
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

		@php $totalhouses = 0; @endphp
		@foreach ($subcontractor->houses as $houses)
			@php $totaladditional = 0; @endphp
			@foreach ($houses->additional as $additional)
				@php $totaladditional += $additional->amount; @endphp
			@endforeach
			@php $totalhouses += ($houses->amount_assigned_subc + $totaladditional); @endphp
		@endforeach
		@php($totalgen = $totalhouses)

		<table border="0" width="100%">
			<tr>
				<td width="50%" valign="top">
					<!-- Payments -->
					<table class="table" style="font-size: 10pt" width="100%">
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
							<td colspan="3" align="right">
								<strong>Total Payments</strong>&emsp;&emsp;&emsp;$  {{ number_format($totalpay, 2, '.', ',') }}
							</td>
						</tr>
					</table>
				</td>
				
				<td width="50%" valign="top">
					<!-- Tools -->
					<table class="table" style="font-size: 10pt" width="100%">
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
							<td colspan="3" align="right">
								<strong>Total Tools</strong>&emsp;&emsp;&emsp;$  {{ number_format($totaltool, 2, '.', ',') }}
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td width="50%" valign="top">
				</td>
				<td width="50%" valign="top">
					<!-- Totals -->
					<table class="table" width="100%">
						<tr>
							<td align="right" style="font-size: 10pt">
								<strong>TOTAL AMOUNT TO PAY:</strong>&emsp;&emsp;&emsp;$  {{ number_format($totalhouses, 2, '.', ',') }}
							</td>
						</tr>
						<tr>
							<td align="right" style="font-size: 10pt">
								<strong>Total Payments:</strong>&emsp;&emsp;&emsp;- $  {{ number_format($totalpay, 2, '.', ',') }}
							</td>
						</tr>
						<tr>
							<td align="right" style="font-size: 10pt">
								<strong>Total Tools:</strong>&emsp;&emsp;&emsp;- $  {{ number_format($totaltool, 2, '.', ',') }}
							</td>
						</tr>
						<tr>
							<td align="right" style="font-size: 12pt">
								<strong>TOTAL: &emsp;&emsp;&emsp;$  {{ number_format($totalgen, 2, '.', ',') }}</strong>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

	</section>
</body>
</html>