@extends('pv.tempvv')
@section('title', 'Request PKP')
@section('judulhalaman','Request PKP')
@section('content')

<div class="row">
	<div class="x_panel">
	<a href="{{route('exportBpom')}}" class="btn btn-info"><li class="fa fa-download"></li> Export Data BPOM</a>
		<table class="Table table-bordered">
			<thead>
				<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
					<td width="7px"></td>
					<td>No kategori</td>
					<td>kategori pangan</td>
					<td>jenis mikroba</td>
					<td>n</td>
					<td>c</td>
					<td>m</td>
					<td>M</td>
					<td>Metode Analisa</td>
				</tr>
			</thead>
			<tbody>
				@php
					$no = 0;
				@endphp
				@foreach($pangan as $pangan)
				<tr>
					<td>{{++$no}}</td>
					<td class="text-right">{{$pangan->no_kategori}}</td>
					<td>{{$pangan->kategori}}</td>
					<td>{{$pangan->mikroba->jenis_mikroba}}</td>
					<td>{{$pangan->mikroba->n}}</td>
					<td>{{$pangan->mikroba->c}}</td>
					<td>{{$pangan->mikroba->mk}}</td>
					<td>{{$pangan->mikroba->Mb}}</td>
					<td>{{$pangan->mikroba->metode_analisa}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection