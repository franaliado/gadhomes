<section class="invoice" style="padding: 20px;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">Date: {{ $invoice->date_order }}</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<h1>GAD FRAMING INC.</h1>
				<h3>INVOICE: {{ $invoice->num_invoice }}</h3>
			</div>
			<div class="col-md-4"><img src="/images/logo_invoice.jpg" class="pull-right"></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered">
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
				<table class="table table-bordered">
					<tr>
						<td>
							<p class="pull-left">Description</p>
							<p class="pull-right">Option</p>
						</td>
						<td>QTY</td>
						<td>Unit Price</td>
						<td>Extension</td>
					</tr>
					<tr>
						<td>
							<p class="pull-left">{{ $invoice->description }}</p>
							<p class="pull-right">{{ $invoice->option }}</p>
						</td>
						<td>{{ $invoice->qty_po }}</td>
						<td>{{ $invoice->unit_price }}</td>
						<td>{{ number_format($invoice->unit_price * $invoice->qty_po, 2, ',', '.') }}</td>						
					</tr>
					<tr>
						<td colspan="4">
							<p class="pull-right">Total&emsp;&emsp;&emsp;{{ number_format($invoice->unit_price * $invoice->qty_po, 2, ',', '.') }}</p>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</section>