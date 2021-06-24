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
		@if($users == 0)
			@php($descrip_user = "")	
		@else
			@php ($descrip_user = "User: {{$users}}")
		@endif
		<div class="row">
			<div class="col-md-11">
				<div class="col-md-1"><img src="/images/logos/GAD_Logo6.png" class="pull-left" width="450%" height="450%"></div>
				<h3 align="center">REPORT OF EXPENSES</h3>
				<h4 align="center">
					@if($users <> 0)
						<b>User:</b> {{$user->name}}
					@endif
					@if($type_expense <> "0")
							- <b>Type Expense:</b> {{$type_expense}}
					@endif
					@if($type_pay <> "0")
						- <b>Type Payment:</b> {{$type_pay}}
					@endif
					@if($users <> 0)<br>@endif
					@if($FromDate <> "Null") <b>From:</b> {{date("m-d-Y", strtotime($FromDate))}}  <b>To:</b> {{date("m-d-Y", strtotime($ToDate))}}@endif
				</h4>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<table id="houses-table" style="magin-top:500px" class="table table-striped table-bordered" border='1' >
					<thead class="thead-light" bgcolor="red" style="color:white">
						<tr>
							<th style="text-align:center;vertical-align: middle">#</th>
							@if ($users == "0") 
								<th style="text-align:center;vertical-align: middle">User</th>
							@endif	
							@if ($type_expense == "0")
								<th style="text-align:center;vertical-align: middle">Expenses</th>
							@endif
							<th style="text-align:center;vertical-align: middle">Date</th>
							<th style="text-align:center;vertical-align: middle">Description</th>
							@if ($type_pay == "0")  
								<th style="text-align:center;vertical-align: middle">Payment Type</th>
							@endif
							@if ($type_pay == "Card" or $type_pay == "0")
								<th style="text-align:center;vertical-align: middle">Card</th>
							@endif
							<th style="text-align:center;vertical-align: middle">Amount</th>
						</tr>
					</thead>
			
					<tbody>
						@php($total = 0)
						@foreach ($expenses as $expense)
							@php ($total += ($expense->amount))			
							<tr>
								<td align="center">{{ $loop->iteration }}</td> 
								@if ($users == "0") 
									<td align="center">{{ $expense->users->name }}</td>
								@endif
								@if ($type_expense == "0")  
									<td align="center">{{ $expense->type_expense }}</td>
								@endif
								<td align="center">{{date("m-d-Y", strtotime($expense->date))}}</td>
								<td align="left">{{ $expense->description }}</td> 
								@if ($type_pay == "0")  
									<td align="center">{{ $expense->type_pay }}</td>
								@endif
								@if ($type_pay == "Card" or $type_pay == "0")
									<td align="center">{{ $expense->card }}</td>
								@endif
								<td align="right">{{ number_format($expense->amount, 2, '.', ',') }}</td>
							</tr>                
						@endforeach
						<tr>
							<td colspan = "8" style="text-align:right;vertical-align: middle;font-size:16px;">
								<b>Total:</b> &nbsp;&nbsp; {{ number_format($total, 2, '.', ',') }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section> 

@endsection