<html>
<head>
  <style>
	table {
		width: 100%;
		border-collapse:collapse;
	}
	.table {
		margin-bottom: -120px;
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
    @page { margin: 180px 50px; }
    #header { position: fixed; left: 0px; top: -150px; right: 0px; height: 150px; }
    #footer { position: fixed; left: 0px; bottom: -250px; right: 0px; height: 130px; text-align: center; }
    #footer .page:after { content: counter(page); }
  </style>
<body>
  <div id="header">
	<table id="houses-table"  border='0' >
		<tr style="font-size:12px;">
			<td align="left">
				<p><strong>Date: {{ date("m-d-Y") }}</strong></p>
			</td>
		</tr>
		<tr>
			<td style="text-align:center;vertical-align: middle">
				<img src="data:image/png;base64,{{ $logo }}" class="pull-left"  width="25%" height="60%"/>
				<br><FONT SIZE=4><b>REPORT OF EXPENSES</b></font><br><br>
				<FONT SIZE=2>
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
					@if($FromDate <> "Null") 
						<b>From: </b>{{date("m-d-Y", strtotime($FromDate))}} 
						<b>To: </b>{{date("m-d-Y", strtotime($ToDate))}}
					@endif
				</font>
			</td>
		</tr>
	</table>
   </div>

  <div id="footer">
    <p class="page">Page </p>
  </div>
  <div id="content">
	<table id="houses-table" class="table" border='1' >
		<thead class="thead-light">
			@php ($cols = 4)
			<tr style="font-size: 12px; font-weight: bold; color: black" bgcolor="D5DBDB" >
				<td style="text-align:center;vertical-align: middle">#</td>
				@if ($users == "0") 
					<td style="text-align:center;vertical-align: middle">User</td>
					@php ($cols = $cols + 1)
				@endif	
				@if ($type_expense == "0")
					<td style="text-align:center;vertical-align: middle">Expenses</td>
					@php ($cols = $cols + 1)
				@endif
				<td style="text-align:center;vertical-align: middle">Date</td>
				<td style="text-align:center;vertical-align: middle">Description</td>
				@if ($type_pay == "0")  
					<td style="text-align:center;vertical-align: middle">Payment Type</td>
					@php ($cols = $cols + 1)
				@endif
				@if ($type_pay == "Card" or $type_pay == "0")
					<td style="text-align:center;vertical-align: middle">Card</td>
					@php ($cols = $cols + 1)
				@endif
				<td style="text-align:center;vertical-align: middle">Amount</td>
				</tr>
		</thead>
	
		<tbody>
			@php($total = 0)
			@foreach ($expenses as $expense)
				@php ($total += ($expense->amount))				
				<tr style="font-size: 12px;">
					<td align="center">{{ $loop->iteration }}</td> 
					@if ($users == "0") 
						<td align="center">{{ $expense->users->name }}</td>
					@endif
					@if ($type_expense == "0")  
						<td align="center">{{ $expense->type_expense }}</td>
					@endif
					<td align="center" NOWRAP>{{date("m-d-Y", strtotime($expense->date))}}</td>
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
				<td colspan = "{{$cols}}" style="text-align:right;vertical-align: middle;font-size:16px;">
					<b>Total:</b> &nbsp;&nbsp; {{ number_format($total, 2, '.', ',') }}{{$cols}}
				</td>
			</tr>
		</tbody>
	</table>
  </div>
</body>