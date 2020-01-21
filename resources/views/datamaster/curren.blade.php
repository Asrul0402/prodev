@extends('admin.tempadmin')

@section('title', 'Data currency')

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

<!-- Currency -->
<div class="card">
  <div class="card-header">
    <h5>List Currency</h5>
  </div>
  <div class="card-block">
    <a type="button" class="btn btn-info" data-toggle="modal" data-target="#add_curren"><i class="fa fa-plus"></i> Tambah Currency </a>
	  <div class="dt-responsive table-responsive">
      <table class="table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Currency</th>
            <th>Harga</th>
            <th>Keterangan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($currens as $curren)
          <tr>
            <td>{{ $curren->id }}</td>
            <td>{{ $curren->currency }}</td>
            <td>{{ $curren->harga }}</td>
            <td>{{ $curren->keterangan }}</td>
            <td>
              {!! Form::open(['method' => 'Delete', 'route' => ['curren.destroy', $curren->id]]) !!}
              <a class="btn-sm btn-primary" href="{{ route('curren.edit',$curren->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              <button class="btn-sm btn-danger" onclick="return confirm('Hapus currency ?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
              {!! Form::close() !!}
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6" id="add" style="background-color:#2f323a;display:none">
    <div class="form-panel" >
      <h4><i class="fa fa-plus"></i> Tambah Currency</h4>
      <form method="POST" action="{{ route('curren.store') }}">
        <label for="" class="control-label">Currency</label>
        <input class="form-control" id="currency" name="currency" placeholder="Currency" value="{{ old('currency') }}" required />
        <label for="" class="control-label">Harga</label>
        <input type="number" step=any class="form-control" id="harga" name="harga" placeholder="Harga" required value="{{ old('harga') }}"/>
        <label for="" class="control-label">Keterangan</label>
        <input class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="{{ old('keterangan') }}" required />
        {{ csrf_field() }}
        <br><br>
        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Submit</button>
        <a type="button" class="btn btn-danger" id="xx" href="#"><i class="fa fa-times"></i> BATAL</a>
      </form>
    </div>
  </div>
</div>

@endsection

<!-- Add New  Currency-->
<div class="modal fade" id="add_curren" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah Currency</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('curren.store') }}">
          <label for="" class="control-label">Currency</label>
          <input class="form-control" id="currency" name="currency" placeholder="Currency" value="{{ old('currency') }}" required />
          <label for="" class="control-label">Harga</label>
          <input type="number" step=any class="form-control" id="harga" name="harga" placeholder="Harga" required value="{{ old('harga') }}"/>
          <label for="" class="control-label">Keterangan</label>
          <input class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="{{ old('keterangan') }}" required />
          {{ csrf_field() }}
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Submit</button>
        <a type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> BATAL</a>
        </form>
      </div>      
    </div>
  </div>
</div>

@section('s')
<script type="text/javascript">
</script>
@endsection

