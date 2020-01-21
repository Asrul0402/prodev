@extends('admin.tempadmin')

@section('title', 'Data SubBrand')

@section('judulhalaman','Data Master')

@section('content')

<div class="row">
  @if (session('status'))
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('status') }}
    </div>
  </div>
  @elseif(session('error'))
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('error') }}
    </div>
  </div>
  @endif
</div>

<!-- Subbrand -->
<div class="card">
  <div class="card-header">
    <h5>List Departement</h5>
  </div>
  <div class="card-block">
    <a type="button" class="btn btn-info" data-toggle="modal" data-target="#add_subbrand" id="tambah"><i class="fa fa-plus"></i> Tambah Subbrand</a>
	  <div class="dt-responsive table-responsive">
      <table class="table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Subbrand</th>
            <th>Brand</th>
            <th>Manager</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($subbrands as $subbrand)
          <tr>
            <td>{{ $subbrand->id }}</td>
            <td>{{ $subbrand->subbrand }}</td>
            <td>{{ $subbrand->brand->brand }}</td>
            <td>{{ $subbrand->user->name }}</td>
            <td>
              {!! Form::open(['method' => 'Delete', 'route' => ['subbrand.destroy', $subbrand->id]]) !!}
              <a class="btn-sm btn-primary" href="{{ route('subbrand.edit',$subbrand->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              <button class="btn-sm btn-danger" onclick="return confirm('Hapus Subbrand ?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
              {!! Form::close() !!}
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

<!-- Add New  Subbrand-->
<div class="modal fade" id="add_subbrand" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah Subbrand</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('subbrand.store') }}">
        <label for="" class="control-label">Subbrand</label>
        <input class="form-control" id="subbrand" name="subbrand" placeholder="Subbrand" value="{{ old('subbrand') }}" required /><br>
        <label for="" class="control-label">Brand</label><br>
        <select id="brand" name="brand" class="form-control" style="width:450px;">
          @foreach($brands as $brand) 
          <option value="{{  $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->brand}}</option>
          @endforeach
        </select><br>
        <label for="" class="control-label">Manager</label><br>
        <select id="manager" name="manager" class="form-control" style="width:450px;">
          @foreach($users as $user) 
          <option value="{{  $user->id }}" {{ old('manager') == $user->id ? 'selected' : '' }}>{{ $user->role->namaRule}} - {{ $user->name }}</option>
          @endforeach
        </select><br><br>
        {{ csrf_field() }}
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Submit</button>
        <a type="button" class="btn btn-danger" data-dismiss="modal" class="fa fa-times"></i> BATAL</a>
        </form>
      </div>
    </div>
  </div>
</div>

@section('s')
<script type="text/javascript">
  $('#manager').select2();
  $('#brand').select2();
</script>
@endsection