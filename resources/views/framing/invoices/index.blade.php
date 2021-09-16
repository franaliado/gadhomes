@extends('layout')

@section('content')

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
	<a href="{{ URL('/orders/'.$house_id) }}" class="btn bg-red">
		<i class="fa fa-arrow-left"> Back</i>
	</a>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6"><strong>Date: {{ date("m-d-Y", strtotime($invoice->created_at)) }}</strong></div>
			<div class="col-md-6"><a href="/invoicePdf/{{ $invoice->idInvoice }}" class="btn btn-default pull-right"><i class="fa fa-download"></i></a></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-1"><img src="/images/logos/GAD_Logo6.png" class="pull-left" width="450%" height="450%"></div>
				<br><h3 align="center">INVOICE: {{ $invoice->num_invoice }}</h3>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered">
					<tr>
						<td><strong>Gad Framing Inc. Vendor extra net</strong></td>
						<td><strong>Ship to: DR HORTON America´s Buliders</strong></td>
					</tr>
					<tr>
						<td>
							<p><strong>Vendor: </strong> 2962210857 & 2442210856</p>
							<p><strong>Phone: </strong> (850) 598-1758 - (850) 401-8477</p>
							<p><strong>Owner: </strong> Saul Francisco - Cristian Espinoza</p>
							<p><strong>Email: </strong> gaditasflaming1@gmail.com</p>
							<p><strong>Address: </strong> 2084 Sherman Avenue. Panama City FL. 32401</p>
						</td>
						<td>
							<p><strong>Address: </strong> D.R. Horton - Panama City <br>&emsp;&emsp;&emsp;:25366 Profit Drive Daphne Al. 36526</p>
							<p><strong>Phone: </strong> (251) 447-0471</p>
							<p><strong>Fax: </strong> (251) 447-0471</p>
						</td>
					</tr>
					<tr>
						<td>
							<p><strong>Super Intendent: </strong> {{ $invoice->name_Superint }}</p>
							<p><strong>Phone: </strong> {{ $invoice->phone_Superint }}</p>
						</td>
						<td>
							<p><strong>Community: </strong> {{ $invoice->communityName }}</p>
							<p><strong>Address: {{ $invoice->houseAddress }}</strong> </p>
							<p><strong>PO: </strong> {{ $invoice->num_po }}</p>
							<p><strong>Lot: </strong> {{ $lot }}</p>
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
						<td align="center">QTY</td>
						<td align="center">Unit Price</td>
						<td align="center">Extension</td>
					</tr>
					@php($total = 0)
					@foreach($descriptions as $d)
					@php($total += ($d->unit_price * $d->qty_po))
					<tr>
						<td>
							<p class="pull-left">{{ $d->description }}</p>
							<p class="pull-right">{{ $d->option }}</p>
						</td>
						<td align="right">{{ number_format($d->qty_po, 2, '.', ',') }}</td>
						<td align="right">{{ number_format($d->unit_price, 3, '.', ',') }}</td>
						<td align="right">{{ number_format($d->unit_price * $d->qty_po, 2, '.', ',') }}</td>						
					</tr>
					@endforeach
					<tr>
						<td colspan="4">
							<p class="pull-right">Total&emsp;&emsp;&emsp;$  {{ number_format($total, 2, '.', ',') }}</p>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</section>

@endsection
