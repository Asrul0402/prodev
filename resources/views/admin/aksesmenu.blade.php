@extends('admin.tempadmin')
@section('title', 'Akses Menu')
@section('judulhalaman','Akses Menu ')
@section('content')

<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-bars"> Tambah Akses Menu</li></h3>
      </div>
	    <div class="card-block">
	      <form class="form-horizontal form-label-left" method="POST" action="{{route('menu')}}" novalidate>
        <div class="form-group row">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Menu</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="menu" id="menu">
          </div><br><br>
					<label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Type</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="jenis" id="jenis" class="form-control">
							@foreach($type as $type)
            	<option value="{{$type->jenis}}">{{$type->jenis}}</option>
							@endforeach
						</select>
          </div>
					<label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Akses</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
						@foreach($menu1 as $menu1)
						<input type="checkbox" name="akses[]" id="akses" value="{{$menu1->datamenu->id}}">{{$menu1->datamenu->namaRule}}<br>
						@endforeach
          </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Sent</button>
            {{ csrf_field() }}
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-bars"> Tambah Jenis Menu</li></h3>
      </div>
	    <div class="card-block">
	    <form class="form-horizontal form-label-left" method="POST" action="{{route('jenismenu')}}" novalidate>
        <div class="form-group row">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Type</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select name="type_menu" id="type_menu" class="form-control">
							@foreach($data as $type)
            	<option value="{{$type->jenis}}">{{$type->jenis}}</option>
							@endforeach
						</select>
          </div>
					<br><br>
					<label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Jenis</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" name="jenis_menu" id="jenis_menu" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Sent</button>
          {{ csrf_field() }}
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection