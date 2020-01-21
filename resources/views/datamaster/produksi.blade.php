@extends('admin.tempadmin')

@section('title', 'Data Produksi')

@section('judulnya','Data Produksi')

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

<!-- Produksi -->
<div class="card">
  <div class="card-header">
    <h5>List Produksi</h5>
  </div>
  <div class="card-block">
    <a type="button" class="btn btn-info" data-toggle="modal" data-target="#add_produksi"><i class="fa fa-plus"></i> Tambah Produksi </a>
		<div class="dt-responsive table-responsive">
      <table class="table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Produksi</th>
            <th>Keterangan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($produksis as $produksi)
          <tr>
            <td>{{ $produksi->id }}</td>
            <td>{{ $produksi->produksi }}</td>
            <td>{{ $produksi->keterangan }}</td>
            <td>
              {!! Form::open(['method' => 'Delete', 'route' => ['produksi.destroy', $produksi->id]]) !!}
              <a class="btn-sm btn-primary" href="{{ route('produksi.edit',$produksi->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              <button class="btn-sm btn-danger" onclick="return confirm('Hapus Produksi ?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
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
      <h4><i class="fa fa-plus"></i> Tambah Produksi</h4>
      <form method="POST" action="{{ route('produksi.store') }}">
        <label for="" class="control-label">Produksi</label>
        <input class="form-control" id="Produksi" name="Produksi" placeholder="Produksi" value="{{ old('Produksi') }}" required />
        <label for="" class="control-label">Keterangan</label>
        <input class="form-control" id="Keterangan" name="Keterangan" placeholder="Keterangan" value="{{ old('keterangan') }}" required />
        {{ csrf_field() }}
        <br><br>
        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Submit</button>
        <a type="button" class="btn btn-danger" id="xx" href="#"><i class="fa fa-times"></i> BATAL</a>
      </form>
		</div>
  </div>
</div>

@endsection

<!-- Add New  -->
<div class="modal fade" id="add_produksi" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah Produksi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('produksi.store') }}">
        <label for="" class="control-label">Produksi</label>
        <input class="form-control" id="Produksi" name="Produksi" placeholder="Produksi" value="{{ old('Produksi') }}" required />
        <label for="" class="control-label">Keterangan</label>
        <input class="form-control" id="Keterangan" name="Keterangan" placeholder="Keterangan" value="{{ old('keterangan') }}" required />
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