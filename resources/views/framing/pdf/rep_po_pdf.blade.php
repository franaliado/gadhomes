<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Report of Pucharse Orders</title>
	<style>

		table {
			border-collapse:collapse;
		}
		.table {
			margin-bottom: 10px;
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

	    @page { margin: 30px 50px; }
		#header { position: fixed; left: 0px; top: -150px; right: 0px; height: 150px; }
		#footer { position: fixed; left: 0px; bottom: -100px; right: 0px; height: 130px; text-align: center; }
		#footer .page:after { content: counter(page); }

	</style>
</head>

<body>
	<div class="row">
		<table id="po-table"  border='0' width="100%";>
			<tr style="font-size:12px;">
				<td align="left" colspan="5">
					<p><strong>Date: {{ date("m-d-Y") }}</strong></p>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;vertical-align: middle" colspan="4">
					<br>
					<img src="data:image/png;base64,{{ $logo }}" class="pull-left"  width="150px" height="70px"/>
					<br><FONT SIZE=4><b>Report of Pucharse Orders</b></font><br><br><br>
				</td>
			</tr>
		</table>

		@if($FromDate == "Null")
			@if($paid == "Yes")
				<p align="center"><FONT SIZE=3><strong>PAID</strong></font></p>
			@else
				<p align="center"><FONT SIZE=3><strong>UNPAID</strong></font></p>
			@endif
		@else
			<table id="po-table2"  border='0' width="70%"; style="margin: 0 auto;">
				<tr align="center" style="font-size: 12px; font-weight: bold; color: black" bgcolor="#D5DBDB">
					<td align="center" style="width:5px">
						<b>Paid</b>
					</td>
					<td align="center" style="width:10px">
						<b>From</b>
					</td>
					<td align="center" style="width:10px">
						<b>To</b>
					</td>
				</tr>

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

	<div id="footer">
		<p class="page">Page </p>
	</div>

	<div id="content">
		<table id="houses-table" class="table" border='1' width="100%";>
			<thead class="thead-light">
				<tr style="font-size: 12px; font-weight: bold; color: black" bgcolor="#D5DBDB" >
					<td style="text-align:center;vertical-align: middle;width:60px">#</td>
					<td style="text-align:center;vertical-align: middle">Nº P.O.</td>
					<td style="text-align:center;vertical-align: middle">Type P.O.</td>
					<td style="text-align:center;vertical-align: middle">Date P.O.</td>
					<td style="text-align:center;vertical-align: middle">Amount</td>
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

				<tr>
					<td align="right" colspan="5"> 
						<h4><strong>TOTAL: &emsp;&emsp;&emsp;$  {{ number_format($total, 2, '.', ',') }} </strong></h4>
					</td>
				</tr>

			</tbody>
		</table>
	</div>
</body>
</html>