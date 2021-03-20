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
	<section class="invoice" style="padding: 20px;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">Date: {{ $invoice->date_order }}</div>
			</div>
			<div class="row">
				<table>
					<tr>
						<td>
							<h1>GAD FRAMING INC.</h1>
							<h3>INVOICE: {{ $invoice->num_invoice }}</h3>
						</td>
						<td>
							<img src="data:image/png;base64,{{ $logo }}" class="pull-right"/>
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
								<p><strong>Phone:</strong> (850)598-1758 - (850401-8477)</p>
								<p><strong>Owner:</strong> Saul Francisco - Cristian Espinoza</p>
								<p><strong>Email:</strong> gaditasflaming1@gmail.com</p>
								<p><strong>Adress:</strong> 4137 Corbin Rd. Panama City FL. 32404</p>
							</td>
							<td>
								<p><strong>Adress:</strong> D.R. Horton - Panama City <br>&emsp;&emsp;&emsp;:25366 Profit Drive Daphne Al. 36526</p>
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
								<p><strong>Adress:{{ $invoice->houseAddress }}</strong> </p>
								<p><strong>PO:</strong> {{ $invoice->num_po }}</p>
								<p><strong>Lot:</strong> {{ $invoice->houseLot }}</p>
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
							<td>QTY</td>
							<td>Unit Price</td>
							<td>Extension</td>
						</tr>
						<tr>
							<td>
								<table class="no-table">
									<tr>
										<td style="text-align:left">{{ $invoice->description }}</td>
										<td style="text-align:right">{{ $invoice->option }}</td>
									</tr>
								</table>
							</td>
							<td>{{ $invoice->qty_po }}</td>
							<td>{{ $invoice->unit_price }}</td>
							<td>{{ number_format($invoice->unit_price * $invoice->qty_po, 2, ',', '.') }}</td>						
						</tr>
						<tr>
							<td colspan="4" style="text-align:right">
								<p>Total&emsp;&emsp;&emsp;{{ number_format($invoice->unit_price * $invoice->qty_po, 2, ',', '.') }}</p>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</section>
</body>
</html>