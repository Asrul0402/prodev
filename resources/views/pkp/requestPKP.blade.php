@extends('pv.tempvv')

@section('title', 'Request PKP')

@section('judulhalaman','Request PKP')

@section('content')

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

<div class="x_panel">
  <div class="btn-group col-md-12 col-sm-12 col-xs-12">
    <button class="btn btn-info btn-block" data-toggle="modal" data-target="#NW1" type="button"><li class="fa fa-plus"></li> Use Tempale</button>
  </div>
</div>

<form class="form-horizontal form-label-left" method="POST" action="{{ route('datapkp') }}" novalidate>
<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="x_panel" style="min-height:240px">
      <div class="x_title">
        <h3><li class="fa fa-file-archive-o"></li> Project</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
        <?php $last = Date('j-F-Y'); ?>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Create </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input id="last" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="last" required="required" type="text" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Jenis**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select name="jenis" id="jenis" class="form-control">
                @foreach($menu as $menu)
                <option value="{{$menu->jenis_menu}}">{{$menu->jenis_menu}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Type**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <select required id="type" name="type" class="form-control" >
              <option disabled selected value="">-- Select One --</option>
              <option value="1">Maklon</option>
              <option value="2">Internal</option>
              <option value="3">Maklon/Internal</option>
            </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xs-12">
    <div class="x_panel"  style="min-height:240px">
      <div class="x_title">
        <h3><li class="fa fa-file-archive-o"> </li> Project</h3>
      </div>
      <div class="card-block">
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Project Name **</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input id="name" class="form-control col-md-12 col-xs-12" type="text" name="name" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Brand **</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select required id="brand" name="brand" class="form-control" >
              <option disabled selected value="">-- Select One --</option>
              @foreach($brand as $brand)
              <option value="{{  $brand->brand }}">{{  $brand->brand }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Author</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input readonly id="author" value="{{ Auth::user()->name }}" class="form-control col-md-12 col-xs-12" type="text" name="author">
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
  <div class="x_panel">
    <div class="card-block col-md-6 col-md-offset-5">
      <button type="reset" class="btn btn-danger">Reset</button>
      <button type="submit" class="btn btn-primary">Submit</button>
      {{ csrf_field() }}
    </div>
  </div>
</div>
</form>

<!-- Template -->
<div class="modal" id="NW1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Template PKP
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h3>
      </div>
      <div class="modal-body">
      <form class="form-horizontal form-label-left" method="POST" action="{{ route('tambahkate') }}" novalidate>
        <table class="table table-bordered" width="100%">
          <thead>
            <tr>
              <td width="5%">no</td>
              <td>No_pkp</td>
              <td>Brand</td>
              <td>Nama Project</td>
              <td>Author</td>
              <td></td>
            </tr>
          </thead>
          @php
            $nol = 0;
          @endphp
          @foreach($pkp1 as $pkp)
            <tr>
              <th class="text-center">{{ ++$nol }}</th>
              <th>{{ $pkp->pkp_number }}{{ $pkp->ket_no }}</th>
              <th>{{ $pkp->id_brand }}</th>
              <th>{{ $pkp->project_name }}</th>
              <th>{{ $pkp->author }}</th>
              <th class="text-center">
                <a class="btn btn-warning" onclick="return confirm('Yakin akan gunakan temp ini ?')" href="{{Route('temppkp',$pkp->id_project)}}"><i class="fa fa-check"></i></a>
              </th>
            </tr>
          @endforeach
        </table>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Selesai -->
@endsection
