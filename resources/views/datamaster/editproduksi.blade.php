@extends('admin.tempadmin')

@section('title', 'Edit Produksi')

@section('judulhalaman','Data Master')

@section('content')

<div class="card">
  <div class="card-header">
    <h5>Edit Data</h5>
  </div>
  <div class="card-block">
    <form method="POST" action="{{ route('produksi.update',$produksi->id) }}">
      <label for="" class="control-label">Produksi</label>
      <input class="form-control" id="Produksi" name="Produksi" placeholder="Produksi" value="{{ $produksi->produksi }}" required />
      <label for="" class="control-label">Keterangan</label>
      <input class="form-control" id="Keterangan" name="Keterangan" placeholder="Keterangan" value="{{ $produksi->keterangan }}" required />
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
      <br><br>
      <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Simpan Perubahan</button>
      <a type="button" class="btn btn-danger" id="xx" href="{{ route('produksi.index') }}"><i class="fa fa-times"></i> BATAL</a>
    </form>
  </div>
</div>

@endsection