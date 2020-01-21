@extends('admin.tempadmin')

@section('title', 'Edit SubBrand')

@section('judulhalaman','Edit SubBrand')

@section('content')

<div class="card">
  <div class="card-header">
    <h5>Edit Data</h5>
  </div>
  <div class="card-block">
    <form method="POST" action="{{ route('subbrand.update',$subbrand->id) }}">
      <label for="" class="control-label">Subbrand</label>
      <input class="form-control" id="subbrand" name="subbrand" value="{{ $subbrand->subbrand }}" required /><br>
      <label for="" class="control-label">Brand</label><br>
      <select id="brand" name="brand" class="form-control" style="width:500px;">
        @foreach($brands as $brand) 
        <option value="{{  $brand->id }}" {{ $subbrand->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->brand}}</option>
        @endforeach
      </select><br>
      <label for="" class="control-label">Manager</label><br>
      <select id="manager" name="manager" class="form-control" style="width:500px;">
        @foreach($users as $user) 
        <option value="{{  $user->id }}" {{ $subbrand->user_id == $user->id ? 'selected' : '' }}>{{ $user->role->namaRule}} - {{ $user->name }}</option>
         @endforeach
      </select><br><br>
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
      <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Simpan Perubahan</button>
      <a type="button" class="btn btn-danger" id="xx" href="{{ route('subbrand.index') }}"><i class="fa fa-times"></i> BATAL</a>
    </form>
  </div>
</div>

@endsection

@section('s')
<script type="text/javascript">
	$('#manager').select2({
    placeholder: "Pilih User Sebagai Manager",
    allowClear: true
	});
	$('#brand').select2({
    placeholder: "Pilih Brand",
    allowClear: true
	});
</script>
@endsection