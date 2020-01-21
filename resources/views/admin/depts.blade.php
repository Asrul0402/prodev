@extends('admin.tempadmin')

@section('title', 'DataDepartement')

@section('judulhalaman','User Management')

@section('content')

@if (session('status'))
<div class="row">
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
</div>
@endif

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-industry"> List Departement</li></h3>
  </div>
  <div class="card-block">
    <a type="button" class="btn btn-info" data-toggle="modal" data-target="#add_dept"><i class="fa fa-plus"></i> Tambah Departement</a>
	  <div class="dt-responsive table-responsive">
      <table class="table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th class="text-center">ID</th>
            <th class="text-center">Departement</th>
            <th class="text-center">Keterangan (Nama Departement) </th>
            <th class="text-center">Manager</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($depts as $dept)
          <tr>
            <td class="text-center">{{ $dept->id}}</td>
            <td class="text-center">{{ $dept->dept}}</td>
            <td class="text-center">{{ $dept->nama_dept}}</td>
            <td class="text-center">
              @foreach($users as $user)
              @if($user->id == $dept->manager_id)
              {{ $user->name}}
              @endif 
              @endforeach
            </td>
            <td class="text-center"> 
              <a class="btn-sm btn-primary" href="{{ route('updatedept',$dept->id) }}"><i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i> </a> &nbsp
              <a class="btn-sm btn-danger" onclick="return confirm('Are You Sure ?')" href="{{ route('deldept',$dept->id) }}" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

<!-- Add New Departement -->
<div class="modal fade" id="add_dept" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah Departement</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <form method="POST" action="{{ route('adddept') }}">
      <div class="modal-body">
        <label for="" class="control-label">Departement</label>
        <input class="form-control" id="dept" name="dept" placeholder="Ex. RKA" required />
        <label for="" class="control-label">Keterangan</label>
        <input class="form-control" id="nama_dept" name="nama_dept" placeholder="Ex. R&D Packaging and Service" required />
        <label for="" class="control-label">Manager</label><br>
        <select id="manager" name="manager" class="form-control" style="width:450px;">
          @foreach($users as $user) 
          <option value="{{  $user->id }}" {{ old('manager') == $user->id ? 'selected' : '' }}>{{ $user->role->namaRule}} - {{ $user->name }}</option>
          @endforeach
        </select><br><br>
        {{ csrf_field() }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

@section('s')
<script type="text/javascript">
$('#manager').select2({
  placeholder: "Pilih User Sebagai Manager",
  allowClear: true
});
</script>
@endsection

