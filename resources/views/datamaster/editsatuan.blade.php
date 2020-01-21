@extends('admin.tempadmin')

@section('title', 'Edit Satuan')

@section('judulnya','Edit satuan')

@section('content')

<div class="card">
  <div class="card-header">
    <h5>Edit Data</h5>
  </div>
  <div class="card-block">
    <form method="POST" action="{{ route('satuan.update', $satuan->id) }}">
      <label for="" class="control-label">Satuan</label>
      <input class="form-control" id="satuan" name="satuan" placeholder="Satuan" value="{{ $satuan->satuan }}" required />
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
      <br><br>
      <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Simpan Perubahan</button>
      <a type="button" class="btn btn-danger" id="xx" href="{{ route('satuan.index') }}"><i class="fa fa-times"></i> BATAL</a>
    </form>
  </div>
</div>

@endsection