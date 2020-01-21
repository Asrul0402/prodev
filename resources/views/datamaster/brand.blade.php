@extends('admin.tempadmin')

@section('title', 'Data Brand')

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

<!-- BRAND -->
<div class="card">
  <div class="card-header">
    <h5>List Brand</h5>
  </div>
  <a type="button" class="btn btn-info" data-toggle="modal" data-target="#add_brand" id="tambah"><i class="fa fa-plus"></i> Tambah Brand</a>
  <div class="card-block">
    <div class="dt-responsive table-responsive">
      <table class="table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Brand</th>
            <th>Created</th>
            <th>Updated</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($brands as $brand)
          <tr>
            <td>{{ $brand->id }}</td>
            <td>{{ $brand->brand }}</td>
            <td>{{ $brand->created_at }}</td>
            <td>{{ $brand->updated_at }}</td>
            <td class="text-center">
              <a class="btn-sm btn-primary" href="{{ route('brand.edit',$brand->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              <a class="btn-sm btn-danger" onclick="return confirm('Hapus Bahan Baku ?')" data-toggle="tooltip" title="Delete" href="{{ route('brand.destroy',$brand->id) }}"><i class="fa fa-trash-o"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
<!-- Add New Brand-->
<div class="modal fade" id="add_brand" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah Brand</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('brand.store') }}">
        <label for="nama_produk" class="control-label">Brand</label>
        <input class="form-control" id="brand" name=brand placeholder="Brand" required />
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
<script type="text/javascript"></script>
@endsection