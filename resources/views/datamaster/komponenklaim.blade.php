@extends('pv.tempvv')
@section('title', 'Kemas')
@section('judulhalaman','Kemas')
@section('content')

<div class="row">
	<div class="x_panel">
	<a href="{{route('exportklaim')}}" class="btn btn-info"><li class="fa fa-download"></li> Export Data Klaim</a>
		<table class="Table table-bordered">
			<thead>
				<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
					<td width="10px">No</td>
					<td>Komponen</td>
                    <td>Klaim</td>
                    <td>Persyaratan</td>
				</tr>
			</thead>
			<tbody>
				@php
					$no = 0;
				@endphp
				@foreach($klaim as $klaim)
				<tr>
					<td>{{++$no}}</td>
					<td>{{$klaim->komponen}}</td>
					<td>{{$klaim->klaim}}</td>
					<td>{{$klaim->persyaratan}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection