@extends('admin.tempadmin')

@section('title', 'Data')

@section('judulhalaman','Data Form PKP & PDF')

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

<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="btn-group">
        <a href="{{route('editform1')}}" type="submit" class="btn btn-info" ><i class="fa fa-edit"></i> Edit Data Form PDF & PKP</a>
      </div>
      <div class="btn-group">
        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-plus"></i> Tambah Data Form </button>
        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" role="menu">
          <li><a class="dropdown-item waves-light waves-effect" data-toggle="modal" data-target="#NW"><i class="fa fa-plus-circle"></i> Jenis</a>
          </li>
          <li><a class="dropdown-item waves-light waves-effect" data-toggle="modal" data-target="#NW2"><i class="fa fa-plus-circle"></i> Kategori</a>
          </li>
          <li class="divider"></li>
          <li><a class="dropdown-item waves-light waves-effect" data-toggle="modal" data-target="#NW3"><i class="fa fa-plus-circle"></i> SubKategori</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>      

<div class="row">
  <div class="col-sm-6">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-file"> Data Form PDF</li></h3>
      </div>
      <div class="card-block">
        <div class="dt-responsive table-responsive">
        <table class="Table table-striped table-bordered nowrap">
          <thead>
        	  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <th width="5%">No</th>
              <th class="text-center" width="30%">Jenis</th>
              <th class="text-center">Kategori</th>           
              <th class="text-center">Status</th>      
            </tr>
				  </thead>
				  <tbody>
				  @php $nol = 0; @endphp
          @foreach($kat as $kat)
				  @if($kat->jenis->status=='active')
            @if($kat->jenis->form=='PDF')
              @if($kat->status=='active')
					    <tr>
					      <td class="text-center">{{ ++$nol }}</td>
					  	  <td>{{ $kat->jenis->nama }}</td>
					  	  <td>{{ $kat->nama_kategori }}</td>
					  	  <td class="text-center"><span class="label label-primary">{{ $kat->status }}</span></td>
					    </tr>
              @endif
            @endif
				  @endif
				  @endforeach
				  </tbody>
			  </table>
	      </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="x_panel">
      <div class="x_title">
      <h3><li class="fa fa-file"> Data Form PKP</li></h3>
      </div>
      <div class="card-block">
        <div class="dt-responsive table-responsive">
        <table class="Table table-striped table-bordered">
          <thead>
        	  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <th width="5%" class="text-cennter">No</th>
              <th class="text-center" width="30%">Jenis</th>
              <th class="text-center">Kategori</th>           
              <th class="text-center">Status</th>      
            </tr>
				  </thead>
				  <tbody>
				  @php
          	$nol = 0;
      	  @endphp
          @foreach($kategori as $kate)
				    @if($kate->jenis->status=='active')
              @if($kate->status=='active')
                @if($kate->jenis->form=='PKP')
						      <tr>
                    <td class="text-center">{{ ++$nol }}</td>
                    <td>{{ $kate->jenis->nama }}</td>
                    <td>{{ $kate->nama_kategori }}</td>
                    <td class="text-center"><span class="label label-primary">{{ $kate->status}}</span></td>
						      </tr>
                @endif
              @endif
            @endif
			    @endforeach
				  </tbody>
			  </table>
	      </div>
      </div>
    </div>
  </div>
</div>

<!-- Jenis -->
<div class="modal" id="NW" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">                 
        <h3 class="modal-title" id="exampleModalLabel">Tambah Jenis Form </h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal form-label-left" method="POST" action="{{ route('tambahjenis') }}" novalidate>
      <div class="form-group row">
        <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Form</label>
        <div class="col-md-11 col-sm-9 col-xs-12">
          <select name="form" class="form-control form-control-line" id="">
            <option value="PKP">PKP</option>
            <option value="PDF">PDF</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12">Jenis</label>
        <div class="col-md-11 col-sm-9 col-xs-12">
          <input type="text" placeholder="Jenis Form" required name="jenis" id="jenis" class="form-control col-md-12 col-xs-12">
        </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Submit</button>
      </div>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Jenis selesai -->

<!-- Kategori -->
<div class="modal" id="NW2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">                 
        <h3 class="modal-title" id="exampleModalLabel">Tambah Kategori Form </h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal form-label-left" method="POST" action="{{ route('tambahkate') }}" novalidate>
        <div class="form-group row">
          <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Jenis</label>
          <div class="col-md-11 col-sm-9 col-xs-12">
            <select name="jenis" class="form-control form-control-line" id="jenis">
            <option >pilih jenis</option>
            @foreach($jenisnya as $key => $value)
            <option value="{{ $value->id_jenis }}">{{ $value->nama }}</option>
            @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12">Kategori</label>
          <div class="col-md-11 col-sm-9 col-xs-12">
            <input type="text" placeholder="kategori Form" required name="kategori" id="kategori" class="form-control col-md-12 col-xs-12">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Submit</button>
        {{ csrf_field() }}
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Ktegori Selesai -->

<!-- SubKtegori -->
<div class="modal" id="NW3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">                 
        <h3 class="modal-title" id="exampleModalLabel" >Tambah SubKategori Form </h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal form-label-left" method="POST" action="{{ route('tambahsub') }}" novalidate>
        <div class="form-group row">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Kategori</label>
          <div class="col-md-10 col-sm-9 col-xs-12">
          <select name="kategori" class="form-control form-control-line" id="kategori">
            @foreach($kategori as $key => $value)
              <option value="{{ $value->id }}">{{ $value->nama_kategori }}</option>
            @endforeach
          </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">SubKategori</label>
          <div class="col-md-10 col-sm-9 col-xs-12">
            <input type="text" placeholder="subkategori Form" required name="subkategori" id="subkategori" class="form-control col-md-12 col-xs-12">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Submit</button>
        {{ csrf_field() }}
      </div>
      </form>
    </div>
  </div>
</div>
<!-- SubKategori Selesai -->
@endsection