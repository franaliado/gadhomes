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
						<br>
						<FONT SIZE=5><b>GAD FRAMING INC.</b></font><br><br>
						<FONT SIZE=4><b>Report of Subcontractors for Communities</b></font><br><br>
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
							<b>Communnity</b>
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

		<table id="houses-table" class="table" border='1' width="100%";>
			<thead class="thead-light">
				<tr style="font-size: 12px; font-weight: bold; color: black" bgcolor="#D5DBDB" >
					<td style="text-align:center;vertical-align: middle">#</td>
					<td style="text-align:center;vertical-align: middle">Subcontractor</td>
					<td style="text-align:center;vertical-align: middle">Amount to Pay</td>
					<td style="text-align:center;vertical-align: middle">Tools</td>
					<td style="text-align:center;vertical-align: middle">Payments</td>
					<td style="text-align:center;vertical-align: middle">Total</td>
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
					<tr style="font-size: 12px;">
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

	</section>
</body>
</html>