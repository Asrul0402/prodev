@extends('admin.tempadmin')

@section('title', 'Edit SubKategori')

@section('judulhalaman','Data Master')

@section('content')

<div class="card">
  <div class="card-header">
    <h5>Edit Data</h5>
  </div>
  <div class="card-block">
    <form method="POST" action="{{ route('subkategori.update',$subkategori->id) }}">
      <label for="" class="control-label">SubKategori</label>
      <input class="form-control" id="subkategori" name="subkategori" placeholder="SubKategori" value="{{ $subkategori->subkategori }}" required />
      <label for="" class="control-label">Pembulatan</label>
      <input type="number" step=any class="form-control" id="pembulatan" name="pembulatan" placeholder="Harga" required value="{{ $subkategori->pembulatan }}"/>
      <label for="" class="control-label">Kategori</label><br>
      <select id="kategori" name="kategori" class="form-control" style="width:500px;">
        @foreach($kategoris as $kategori) 
        <option value="{{  $kategori->id }}" {{ $subkategori->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->kategori}}</option>
        @endforeach
      </select>
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
      <br><br>
      <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Simpan Perubahan</button>
      <a type="button" class="btn btn-danger" id="xx" href="{{ route('subkategori.index') }}"><i class="fa fa-times"></i> BATAL</a>
    </form>
  </div>
</div>

@endsection

@section('s')
<script type="text/javascript">
  $('#kategori').select2();
</script>
@endsection