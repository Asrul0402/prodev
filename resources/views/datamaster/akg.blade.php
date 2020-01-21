@extends('pv.tempvv')
@section('title', 'Request PKP')
@section('judulhalaman','Request PKP')
@section('content')

<div class="row">
	<div class="x_panel">
	<a href="{{route('exportAkg')}}" class="btn btn-info"><li class="fa fa-download"></li> Export Data AKG</a>
		<table class="Table table-bordered">
			<thead>
				<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
					<td width="10px">No</td>
					<td>Zat Gizi</td>
					<td>Satuan</td>
					<td>Umum</td>
					<Td>Bayi</Td>
					<td>Anak 7-23 Bulan</td>
					<td>Anak 2-5 tahun</td>
					<td>Ibu Hamil</td>
					<td>Ibu Menyusui</td>
				</tr>
			</thead>
			<tbody>
				@php
					$no = 0;
				@endphp
				@foreach($akg as $akg)
				<tr>
					<td>{{++$no}}</td>
					<td>{{$akg->zat_gizi}}</td>
					<td class="text-center">{{$akg->satuan}}</td>
					<td class="text-right">{{$akg->umum}}</td>
					<td class="text-right">{{$akg->bayi}}</td>
					<td class="text-right">{{$akg->anak7_23bulan}}</td>
					<td class="text-right">{{$akg->anak2_5tahun}}</td>
					<td class="text-right">{{$akg->ibu_hamil}}</td>
					<td class="text-right">{{$akg->ibu_menyusui}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection