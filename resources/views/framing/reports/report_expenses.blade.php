@extends('layout')

@section('content')


<section class="rep_houses" style="padding: 20px;">
	<a href="{{ URL('/rep_expenses') }}" class="btn bg-red">
		<i class="fa fa-arrow-left"> Back</i>
	</a>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6"><strong>Date: {{ date("m-d-Y") }}</strong></div>
			<div class="col-md-6"><a href="/rep_expenses_PDF/{{$users}}/{{$type_expense}}/{{$type_pay}}/{{$FromDate}}/{{$ToDate}}" class="btn btn-default pull-right"><i class="fa fa-download"></i></a></div>
		</div>
		<div class="row">
			<div class="col-md-11">
				<h1 align="center">GAD FRAMING INC.</h1>
				<h3 align="center">REPORT OF EXPENSES</h3>
			</div>
			<div class="col-md-1"><img src="/images/logo_invoice.jpg" class="pull-right"></div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<table id="houses-table" style="magin-top:500px" class="table table-striped table-bordered" border='1' >
					<thead class="thead-light" bgcolor="red" style="color:white">
						<tr>
							<th style="text-align:center;vertical-align: middle">#</th>
							<th style="text-align:center;vertical-align: middle">User</th>
							<th style="text-align:center;vertical-align: middle">Expenses</th>
							<th style="text-align:center;vertical-align: middle">Date</th>
							<th style="text-align:center;vertical-align: middle">Description</th>
							<th style="text-align:center;vertical-align: middle">Payment Type</th>
							<th style="text-align:center;vertical-align: middle">Card</th>
							<th style="text-align:center;vertical-align: middle">Amount</th>
						</tr>
					</thead>
			
					<tbody>
						@foreach ($expenses as $expense)			
							<tr>
								<td align="center">{{ $loop->iteration }}</td> 
								<td align="center">{{ $expense->users->name }}</td>   
								<td align="center">{{ $expense->type_expense }}</td>
								<td align="center">{{date("m-d-Y", strtotime($expense->date))}}</td>
								<td align="left">{{ $expense->description }}</td>  
								<td align="center">{{ $expense->type_pay }}</td>
								<td align="center">{{ $expense->card }}</td>
								<td align="right">{{ number_format($expense->amount, 2, '.', ',') }}</td>
							</tr>                
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

@endsection