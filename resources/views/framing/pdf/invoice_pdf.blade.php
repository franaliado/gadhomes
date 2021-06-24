<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Invoice</title>
	<style>
		html, body {
			font-family: 'Open Sans', sans-serif;
			margin: 0 !important;
			padding: 0 !important;
		}
		table {
			width: 100%;
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

	@switch (strlen($invoice->houseLot))
	@case(1)
		@php $lot = "000" . $invoice->houseLot; @endphp
		@break
	@case(2)
		@php $lot = "00" . $invoice->houseLot; @endphp
		@break
	@case(3)
		@php $lot = "0" . $invoice->houseLot; @endphp
		@break
	@default
		@php $lot = $invoice->houseLot; @endphp
	@endswitch 	

	<section class="invoice" style="padding: 20px;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12"><strong>Date: {{ date("m-d-Y", strtotime($invoice->created_at)) }}</strong></div>
			</div>
			<div class="row">
				<table>
					<tr>
						<td>
							<img src="data:image/png;base64,{{ $logo }}" class="pull-left"  width="25%" height="60%"/>
							<h3>INVOICE: {{ $invoice->num_invoice }}</h3>
						</td>
					</tr>
				</table>

			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<tr>
							<td><strong>Gad Framing Inc. Vendor extra net</strong></td>
							<td><strong>Ship to: DR HORTON America´s Buliders</strong></td>
						</tr>
						<tr>
							<td>
								<p><strong>Vendor:</strong> 2962210857 & 2442210856</p>
								<p><strong>Phone:</strong> (850) 598-1758 - (850) 401-8477</p>
								<p><strong>Owner:</strong> Saul Francisco - Cristian Espinoza</p>
								<p><strong>Email:</strong> gaditasflaming1@gmail.com</p>
								<p><strong>Address:</strong> 4137 Corbin Rd. Panama City FL. 32404</p>
							</td>
							<td>
								<p><strong>Address:</strong> D.R. Horton - Panama City <br>&emsp;&emsp;&emsp;:25366 Profit Drive Daphne Al. 36526</p>
								<p><strong>Phone:</strong> (251) 447-0471</p>
								<p><strong>Fax:</strong> (251) 447-0471</p>
							</td>
						</tr>
						<tr>
							<td>
								<p><strong>Super Intendent:</strong> {{ $invoice->name_Superint }}</p>
								<p><strong>Phone:</strong> {{ $invoice->phone_Superint }}</p>
							</td>
							<td>
								<p><strong>Community:</strong> {{ $invoice->communityName }}</p>
								<p><strong>Address:{{ $invoice->houseAddress }}</strong> </p>
								<p><strong>PO:</strong> {{ $invoice->num_po }}</p>
								<p><strong>Lot:</strong> {{ $lot }}</p>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<tr>
							<td>
								<table class="no-table">
									<tr>
										<td style="text-align:left">Description</td>
										<td style="text-align:right">Option</td>
									</tr>
								</table>
							</td>
							<td align="center">QTY</td>
							<td align="center">Unit Price</td>
							<td align="center">Extension</td>
						</tr>
						@php($total = 0)
						@foreach($descriptions as $d)
						@php($total += ($d->unit_price * $d->qty_po))
						<tr>
							<td>
								<table class="no-table">
									<tr>
										<td style="text-align:left">{{ $d->description }}</td>
										<td style="text-align:right">{{ $d->option }}</td>
									</tr>
								</table>
							</td>
							<td align="right">{{ number_format($d->qty_po, 2, '.', ',') }}</td>
							<td align="right">{{ number_format($d->unit_price, 3, '.', ',') }}</td>
							<td align="right">{{ number_format($d->unit_price * $d->qty_po, 2, '.', ',') }}</td>						
						</tr>
						@endforeach
						<tr>
							<td colspan="4" style="text-align:right">
								<p>Total&emsp;&emsp;&emsp;$ {{ number_format($total, 2, '.', ',') }}</p>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</section>
</body>
</html>