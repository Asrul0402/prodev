@extends('admin.tempadmin')

@section('title', 'Data Maklon')

@section('judulnya','Data Maklon')

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

<!-- Maklon -->
<div class="card">
  <div class="card-header">
    <h5>List Satuan</h5>
  </div>
  <div class="card-block">
    <a type="button" class="btn btn-info" data-toggle="modal" data-target="#add_maklon"><i class="fa fa-plus"></i> Tambah Maklon </a>
	  <div class="dt-responsive table-responsive">
      <table class="table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Maklon</th>
            <th>Keterangan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($maklons as $maklon)
        @if($maklon->id)
          <tr>
            <td>{{ $maklon->id }}</td>
            <td>{{ $maklon->maklon }}</td>
            <td>{{ $maklon->keterangan }}</td>
            <td>
              {!! Form::open(['method' => 'Delete', 'route' => ['maklon.destroy', $maklon->id]]) !!}
              <a class="btn-sm btn-primary" href="{{ route('maklon.edit',$maklon->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              <button class="btn-sm btn-danger" onclick="return confirm('Hapus Maklon ?')"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
              {!! Form::close() !!}
            </td>
          </tr>
         @endif
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

@endsection

<!-- Add New Maklon-->
<div class="modal fade" id="add_maklon" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah Maklon</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('maklon.store') }}">
        <label for="" class="control-label">Maklon</label>
        <input class="form-control" id="maklon" name="maklon" placeholder="Maklon" value="{{ old('maklon') }}" required />
        <label for="" class="control-label">Keterangan</label>
        <input class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="{{ old('keterangan') }}" required />
        {{ csrf_field() }}              
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Submit</button>
        <a type="button" class="btn btn-danger" id="xx" href="#"><i class="fa fa-times"></i> BATAL</a>
        </form>        
      </div>
    </div>
  </div>
</div>

@section('s')
<script type="text/javascript">
</script>
@endsection

