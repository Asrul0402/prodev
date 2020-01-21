@extends('admin.tempadmin')

@section('title', 'Data curren')

@section('judulnya', 'Data curren')

@section('content')

<div class="card">
  <div class="card-header">
    <h5>Edit Data</h5>
  </div>
  <div class="card-block">
    <form method="POST" action="{{ route('curren.update',$curren->id) }}">
      <label for="" class="control-label">Currency</label>
      <input class="form-control" id="currency" name="currency" placeholder="Currency" value="{{ $curren->currency }}" required />
      <label for="" class="control-label">Harga</label>
      <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" required value="{{ $curren->harga }}"/>
      <label for="" class="control-label">Keterangan</label>
      <input class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="{{ $curren->keterangan }}" required />
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
      <br><br>
      <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Simpan Perubahan</button>
      <a type="button" class="btn btn-danger" id="xx" href="{{ route('curren.index') }}"><i class="fa fa-times"></i> BATAL</a>
    </form>
  </div>
</div>

@endsection