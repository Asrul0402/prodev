@extends('admin.tempadmin')

@section('title', 'Approval')

@section('judulhalaman','Edit Data Form')

@section('content')

<div class="row">
  <div class="col-sm-6">
    <div class="x_panel">
      <div class="x_title">
        <h4><li class="fa fa-edit"> Data Form PDF</li></h4>
      </div>
      <div class="card-block">
        <div class="dt-responsive table-responsive">
          <table class="table table-striped table-bordered nowrap">
            <thead>
        	  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <th width="5%" class="text-center">No</th>
              <th>Jenis</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">Type</th>
              <th class="text-center" width="28%">action</th>
            </tr>
				    </thead>
				    <tbody>
				    @php
            	$nol = 0;
      	    @endphp
            @foreach($kategori as $kat)
              @if($kat->jenis->status=='active')
              <tr>
              @if($kat->jenis->form=='PDF')
                <td class="text-center">{{ ++$nol }}</td>
                <td>{{ $kat->jenis->nama}}</td>
                <td>{{ $kat->nama_kategori }}</td>
                <td>{{ $kat->jenis->form }}</td>
                <td class="text-center">
                @if($kat->status=='active' )
                <a href="{{Route('openkat',$kat->id)}}" class="btn btn-info">{{ $kat->status }}</a> 
                @elseif( $kat->status=='inactive')
                <a href="{{Route('blokkat',$kat->id)}}" class="btn btn-danger">{{ $kat->status }}</a>
                @endif
                <button class="btn btn-warning" data-toggle="modal" data-target="#NW{{$kat->id}}" title="Edit"><i class="fa fa-edit"></i></button>
                  <!-- Jenis -->
                  <div class="modal" id="NW{{$kat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">                 
                          <h3 class="modal-title" id="exampleModalLabel">Ubah Data 
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button> </h3>
                        </div>
                        <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{route('editkat',$kat->id)}}" novalidate>
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12">Data</label>
                          <div class="col-md-11 col-sm-9 col-xs-12">
                            <input type="text" value="{{$kat->nama_kategori}}" required name="kat" id="kat" class="form-control col-md-12 col-xs-12">
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
                  </div>
                  <!-- Jenis selesai -->
                </td>
              @endif
              </tr>
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
        <h4><li class="fa fa-edit"> Data Form PKP</li></h4>
      </div>
      <div class="card-block">
        <div class="dt-responsive table-responsive">
        <table class="table table-striped table-bordered nowrap">
          <thead>
          	<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <th width="5%" class="text-center">No</th>
              <th>Jenis</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">Type</th>
              <th class="text-center" width="28%">action</th>
            </tr>
			  	</thead>
			  	<tbody>
			  	@php
        	$nol = 0;
      	  @endphp
          @foreach($kategori as $kat)
            @if($kat->jenis->status=='active')
            <tr>
            @if($kat->jenis->form=='PKP')
              <td  class="text-center">{{ ++$nol }}</td>
              <td>{{ $kat->jenis->nama }}</td>
              <td>{{ $kat->nama_kategori }}</td>
              <td>{{ $kat->jenis->form }}</td>
              <td class="text-center">
                @if($kat->status=='active' )
                <a href="{{Route('openkat',$kat->id)}}" class="btn btn-info">{{ $kat->status }}</a> 
                @elseif( $kat->status=='inactive')
                <a href="{{Route('blokkat',$kat->id)}}" class="btn btn-danger">{{ $kat->status }}</a>
                @endif
                <button class="btn btn-warning" data-toggle="modal" data-target="#NW{{$kat->id}}" title="Edit"><i class="fa fa-edit"></i></button>
                  <!-- Jenis -->
                  <div class="modal" id="NW{{$kat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">                 
                          <h3 class="modal-title" id="exampleModalLabel">Ubah Data 
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button> </h3>
                        </div>
                        <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{route('editkat',$kat->id)}}" novalidate>
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12">Data</label>
                          <div class="col-md-11 col-sm-9 col-xs-12">
                            <input type="text" value="{{$kat->nama_kategori}}" required name="kat" id="kat" class="form-control col-md-12 col-xs-12">
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
                  </div>
                  <!-- Jenis selesai -->
              </td>
            @endif
            </tr>
            @endif
          @endforeach
				  </tbody>
			  </table>
	      </div>
      </div>
    </div>  
  </div>
</div>

<div class="col-sm-12">
  <div class="x_panel">
    <div class="card-block">
      <center><a href="{{ Route('editform3')}}" class="btn btn-success">Next</a></center>
    </div>
  </div>
</div>  
@endsection