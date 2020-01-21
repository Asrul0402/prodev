@extends('admin.tempadmin')

@section('title', 'Edit Maklon')

@section('judulnya','Edit Maklon')

@section('content')

<div class="card">
  <div class="card-header">
    <h5>Edit Data</h5>
  </div>
  <div class="card-block">
    <form method="POST" action="{{ route('maklon.update',$maklon->id) }}">
      <label for="" class="control-label">Maklon</label>
      <input class="form-control" id="maklon" name="maklon" placeholder="Maklon" value="{{ $maklon->maklon }}" required />
      <label for="" class="control-label">Keterangan</label>
      <input class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="{{ $maklon->keterangan }}" required />
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
      <br><br>
      <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Simpan Perubahan</button>
      <a type="button" class="btn btn-danger" id="xx" href="{{ route('maklon.index') }}"><i class="fa fa-times"></i> BATAL</a>
    </form>
  </div>
</div>

@endsection