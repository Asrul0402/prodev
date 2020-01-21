@extends('pv.tempvv')
@section('title', 'Data')
@section('judulhalaman')
@section('content')

<div class="row">
  <div class="x_panel">
		<div class="x_title">
			<h3><li class="fa fa-folder"></li> Data Project</h3>
		</div>
		<div class="x_content">
			<table class="table table-bordered">
				<thead>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th>Brand</th>
						<th class="text-center">Hilo</th>
						<th class="text-center">L-Men</th>
						<th class="text-center">Nutrisari</th>
						<th class="text-center">WRP</th>
						<th class="text-center">Tropicana Slim</th>
						<th class="text-center">Heavenly Blush</th>
						<th class="text-center">Ekspor</th>
					</tr>
					<tr>
						<th>jumlah</th>
						<td class="text-center">{{$hhilo}}</td>
						<td class="text-center">{{$hlmen}}</td>
						<td class="text-center">{{$hnr}}</td>
						<td class="text-center">{{$hwrp}}</td>
						<td class="text-center">{{$hts}}</td>
						<td class="text-center">{{$hhb}}</td>
						<td class="text-center">{{$hekspor}}</td>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<div class="row">
  <div class="x_panel">
		<div class="x_title">
			<h3><li class="fa fa-folder"></li> Data Project</h3>
		</div>
		<div class="x_content">
			<table class="table table-bordered">
				<thead>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th>Status</th>
						<th class="text-center">Draf</th>
						<th class="text-center">Sent</th>
						<th class="text-center">revisi</th>
						<th class="text-center">Proses</th>
						<th class="text-center">Close</th>
					</tr>
					<tr>
						<th>jumlah</th>
						<td class="text-center">{{$hdraf}}</td>
						<td class="text-center">{{$hsent}}</td>
						<td class="text-center">{{$hrevisi}}</td>
						<td class="text-center">{{$hproses}}</td>
						<td class="text-center">{{$hclose}}</td>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

@endsection