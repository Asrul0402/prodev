@extends('pv.tempvv')
@section('title', 'SKU')
@section('judulhalaman','SKU')
@section('content')

<div class="row">
	<div class="x_panel">
	<a href="{{route('exportsku')}}" class="btn btn-info"><li class="fa fa-download"></li> Export Data SKU</a>
		<table class="Table table-bordered">
			<thead>
				<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
					<td width="10px">No</td>
					<td>No Formula</td>
                    <td>Nama Produk</td>
                    <td>no</td>
                    <td>Nama SKU</td>
                    <td>Kode Item</td>
				</tr>
			</thead>
			<tbody>
				@php
					$no = 0;
				@endphp
				@foreach($sku as $sku)
				<tr>
					<td>{{++$no}}</td>
					<td>{{$sku->no_formula}}</td>
                    <td>{{$sku->nama_produk}}</td>
                    <td>{{$sku->no}}</td>
                    <td>{{$sku->nama_sku}}</td>
                    <td>{{$sku->kode_items}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection