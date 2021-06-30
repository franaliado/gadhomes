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

	body { font-family: DejaVu Sans, sans-serif; }

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
				<br><FONT SIZE=3><b>REPORT OF HOUSES</b></font><br><br>
				<FONT SIZE=2>
					@php $num =""; @endphp
					@if($status <> "0")
						<b>Status:</b> {{$status}}
						@php $num = " - "; @endphp
					@endif
					@if($community_id <> 0)
						{{$num}}<b>Community:</b> {{$community->name}}
					@endif
					@if($subcontractor_id <> 0)
						<br><b>Subcontractor:</b> {{$subcontractor->name}}
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
			<tr style="font-size: 12px; font-weight: bold; color: black" bgcolor="#D5DBDB" >
				<td style="text-align:center;vertical-align: middle">#</td>
				@if ($status == "0") 
					<td style="text-align:center;vertical-align: middle">Status</td>
				@endif	
				@if ($community_id == "0")
					<td style="text-align:center;vertical-align: middle">Community</td>
				@endif	
				<td style="text-align:center;vertical-align: middle">Address</td>
				<td style="text-align:center;vertical-align: middle">Lot</td>
				@if ($subcontractor_id == "0")
					<td style="text-align:center;vertical-align: middle">Subcontractor</td>
				@endif	
				@if ($status == "0" or $status == "Paid") 
					<td style="text-align:center;vertical-align: middle">Paid Out</td>
					<td style="text-align:center;vertical-align: middle">All</td>
				@endif
			</tr>
		</thead>
	
		<tbody>
			@foreach ($houses as $house)

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
					@if ($status == "0") 
						<td align="center">{{ $house->status }}</td>  
					@endif
					@if ($community_id == "0")
						<td align="center">{{ $house->community->name }}</td>
					@endif
					<td align="left">{{ $house->address }}</td>  
					<td align="center">{{ $lot }}</td>
					@if ($subcontractor_id == "0")
						<td align="center">{{ $house->subcontractorName }}</td>
					@endif 
					@if ($status == "0" or $status == "Paid")  
						<td align="center">{{ $house->paid_out }}</td> 
						@if ($house->paid_all == 1)
							<td align="center"><b><span>&#x2714;</span></b></td>
						@else
							<td align="center"></td>
						@endif  
					@endif
				</tr>                
			@endforeach
		</tbody>
	</table>
  </div>
</body>