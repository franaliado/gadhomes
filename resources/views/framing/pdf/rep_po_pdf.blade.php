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
					<td style="text-align:center;vertical-align: middle">
						<br>
						<img src="data:image/png;base64,{{ $logo }}" class="pull-left"  width="150px" height="70px"/>
						<br><FONT SIZE=4><b>Report of Pucharse Orders</b></font><br><br>
					</td>
				</tr>
			</table>
		</div>
		
		<div class="row">
			@if($FromDate == "Null")
			@if($paid == "Yes")
				<p align="center"><FONT SIZE=3><strong>PAID</strong></font></p>
			@else
				<p align="center"><FONT SIZE=3><strong>UNPAID</strong></font></p>
			@endif
		@else
			<table class="" align="center" width="60%">
					<tr align="center" style="font-size: 12px; font-weight: bold; color: black" bgcolor="#D5DBDB">
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

		<table id="houses-table" class="table" border='1' width="100%";>
			<thead class="thead-light">
				<tr style="font-size: 12px; font-weight: bold; color: black" bgcolor="#D5DBDB" >
					<td style="text-align:center;vertical-align: middle;width:60px">#</td>
					<td style="text-align:center;vertical-align: middle">Nº P.O.</td>
					<td style="text-align:center;vertical-align: middle">Type P.O.</td>
					<td style="text-align:center;vertical-align: middle">Date P.O.</td>
				</tr>
			</thead>
	
			<tbody>
				@foreach ($orders as $order)			
					<tr>
						<td align="center">{{ $loop->iteration }}</td>    
						<td align="center">{{ $order->num_po }}</td>
						<td align="center">{{ $order->type_PO }}</td> 
						<td align="center">{{date("m-d-Y", strtotime($order->date_order))}}</td>  
					</tr>                
				@endforeach
			</tbody>
		</table>

	</section>
</body>
</html>