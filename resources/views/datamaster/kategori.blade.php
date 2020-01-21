@extends('admin.tempadmin')

@section('title', 'Data Kategori')

@section('judulnya','Data Kategori')

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

<!-- Kategori -->
<div class="card">
  <div class="card-header">
    <h5>List Kategori</h5>
  </div>
  <div class="card-block">
    <a type="button" class="btn btn-info" data-toggle="modal" data-target="#add_kategori"><i class="fa fa-plus"></i> Tambah Kategori </a>
	  <div class="dt-responsive table-responsive">
      <table class="table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Kategori</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($kategoris as $kategori)
        <tr>
          <td>{{ $kategori->id }}</td>
          <td>{{ $kategori->kategori }}</td>
          <td>
            {!! Form::open(['method' => 'Delete', 'route' => ['kategori.destroy', $kategori->id]]) !!}
            <a class="btn-sm btn-primary" href="{{ route('kategori.edit',$kategori->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
            <button class="btn-sm btn-danger" onclick="return confirm('Hapus Kategori ?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
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

<!-- Add New  -->
<div class="modal fade" id="add_kategori" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah Kategori</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('kategori.store') }}">
        <label for="" class="control-label">Kategori</label>
        <input class="form-control" id="kategori" name="kategori" placeholder="Kategori" value="{{ old('Kategori') }}" required />
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