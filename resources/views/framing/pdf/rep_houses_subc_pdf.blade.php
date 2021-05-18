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
	.table thead{
		border-spacing: 10px;
		padding: 15px;		
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
				<FONT SIZE=4><b>REPORT OF HOUSES</b></font><br><br>
				<FONT SIZE=2>
				Status: {{$status}}<br>
				Subcontractor: {{$subcontractor->name}}
				</font>			
			</td>
			<td>
				<img src="data:image/png;base64,{{ $logo }}" class="pull-right"/>
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
			<tr style="font-size: 12px; font-weight: bold; color: black" bgcolor="D5DBDB" >
				<td style="text-align:center;vertical-align: middle">#</td>
				<td style="text-align:center;vertical-align: middle">Community</td>
				<td style="text-align:center;vertical-align: middle">Lot</td>
				<th style="text-align:center;vertical-align: middle">Address</td>
				<td style="text-align:center;vertical-align: middle">Start Date</td>
				<td style="text-align:center;vertical-align: middle">Status</td>
				<td style="text-align:center;vertical-align: middle">Without<br>PO</td>
			</tr>
		</thead>

		<tbody>
			@foreach ($houses as $house)

				@switch ($house->withoutpo)
					@case(0)
						@php $withoutpo = "No"; @endphp
						@break
					@default
						@php $withoutpo = "Yes"; @endphp
				@endswitch

				@switch (strlen($house->lot))
					@case(1)
						@php $lot = "000" . $house->lot; @endphp
						@break
					@case(2)
						@php $lot = "00" . $house->lot; @endphp
						@break
					@case(3)
						@php $lot = "0" . $house->lot; @endphp
						@break
					@default
						@php $lot = $house->lot; @endphp
				@endswitch

				<tr style="font-size: 12px;">
					<td align="center">{{ $loop->iteration }}</td>    
					<td align="center">{{ $house->community->name }}</td>
					<td align="center">{{ $lot }}</td>
					<td align="left">{{ $house->address }}</td>  
					<td align="center" NOWRAP>{{date("m-d-Y", strtotime($house->start_date))}}</td>
					<td align="center">{{ $house->status }}</td>
					<td align="center">{{ $withoutpo }}</td>
				</tr>                
			@endforeach
		</tbody>
	</table>
  </div>
</body>