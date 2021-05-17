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
    #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; }
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
			<td>
				<FONT SIZE=5><b>GAD FRAMING INC.</b></font><br><br>
				<FONT SIZE=4><b>REPORT OF EXPENSES</b></font><br><br>
				<FONT SIZE=2>
				@if ($users <> "0") User: {{$user->name}} @endif	
				@if($type_expense <> "0") Type Expense: {{$type_expense}} @endif
				@if($type_pay <> "0") Type Payment: {{$type_pay}} @endif
				@if($FromDate <> "Null") <br>From: {{$FromDate}}  To: {{$ToDate}}@endif
				</font>
			</td>
			<td>
				<img src="data:image/png;base64,{{ $logo }}" class="pull-right"/>
			</td>
		</tr>
	</table>
	<br>
   </div>
  <div id="footer">
    <p class="page">Page </p>
  </div>
  <div id="content">
	<table id="houses-table" class="table" border='1' >
		<thead class="thead-light">
			<tr style="font-size: 12px; font-weight: bold; color: black" bgcolor="D5DBDB" >
				<td style="text-align:center;vertical-align: middle">#</td>
				@if ($users == "0") 
					<td style="text-align:center;vertical-align: middle">User</td>
				@endif	
				@if ($type_expense == "0")
					<td style="text-align:center;vertical-align: middle">Expenses</td>
				@endif	
				<td style="text-align:center;vertical-align: middle">Date</td>
				<td style="text-align:center;vertical-align: middle">Description</td>
				@if ($type_pay == "0")  
					<td style="text-align:center;vertical-align: middle">Payment Type</td>
				@endif
				@if ($type_pay == "Card" or $type_pay == "0")					
					<td style="text-align:center;vertical-align: middle">Card</td>
				@endif	
				<td style="text-align:center;vertical-align: middle">Amount</td>
			</tr>
		</thead>
	
		<tbody>
			@foreach ($expenses as $expense)			
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
		</tbody>
	</table>
  </div>
</body>