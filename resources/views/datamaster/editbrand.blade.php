@extends('admin.tempadmin')
@section('title', 'Edit DataBrand')
@section('judulhalaman', 'Edit data Brand')
@section('content')

<div class="card">
  <div class="card-header">
    <h5>Edit Data</h5>
  </div>
  <div class="card-block">
    <form method="POST" action="{{ route('brand.update',$brand->id) }}">
      <label for="nama_produk" class="control-label">Brand</label>
      <input class="form-control" id="brand" name=brand placeholder="Brand" value="{{ $brand->brand }}" required />
      {{ csrf_field() }}
      <br><br>
      <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Simpan Perubahan</button>
      <a type="button" class="btn btn-danger" id="xx" href="{{ route('brand.index') }}"><i class="fa fa-times"></i> BATAL</a>
    </form>
  </div>
</div>

@endsection