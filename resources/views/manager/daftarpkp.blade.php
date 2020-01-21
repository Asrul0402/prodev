@extends('manager.tempmanager')
@section('title', 'Daftar PKP')
@section('judulhalaman','Form PKP')
@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
			@foreach($data as $data)
        <h3><li class="fa fa-star"></li> Project Name : {{ $data->project_name}}</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <table>
						<thead>
							<tr><td>Brand</td><td> : {{$data->id_brand}}</td></tr>
							<tr><td>Type PKP</td><td> : 
              @if($data->type==1)
              Maklon
              @elseif($data->type==2)
              Internal
              @elseif($data->type==3)
              Maklon/Internal
              @endif</td></tr>
              <tr><td>PKP Number</td><td> : {{$data->pkp_number}}{{$data->ket_no}}</td></tr>
							<tr><td>Created</td><td> : {{$data->created_date}}</td></tr>
							<tr><td>Author</td><td> : {{$data->author}}</td></tr>
						</thead>
					</table><br>
					<a href="{{ route('listpkprka')}}" class="btn btn-danger" type="button"><li class="fa fa-share"></li> Back</a>
				  @if($data->type==3)
          @if($data->status_terima!='proses' || $data->status_terima2!='proses')
          <button class="btn btn-warning"  data-toggle="modal" data-target="#edit"><li class="fa fa-edit"></li> Confirm Type PKP</button>
          @endif
          @endif
          @if($data->status_project!='close' && $data->status_project!='revisi')
          <button class="btn btn-primary"  data-toggle="modal" data-target="#alihkan"><li class="fa fa-paper-plane"></li> Divert Project</button>
          @endif
          <?php $last = Date('j-F-Y'); ?>
          @if(Auth::user()->departement->dept!='RKA')
            @if($data->status_terima=='proses')
            <form class="form-horizontal form-label-left" method="POST" action="{{ route('approve1',$data->id_project) }}" novalidate>
              <input type="hidden" value="{{$last}}" name="tgl">
              <button type="submit" class="btn btn-dark"><li class="fa fa-check"></li> Approve data</button>
              {{ csrf_field() }}
            </form>
            @endif
          @elseif(Auth::user()->departement->dept=='RKA')
            @if($data->status_terima2=='proses')
            <form class="form-horizontal form-label-left" method="POST" action="{{ route('approve2',$data->id_project) }}" novalidate>
              <input type="hidden" value="{{$last}}" name="tgl">
              <button type="submit" class="btn btn-dark"><li class="fa fa-check"></li> Approve data</button>
              {{ csrf_field() }}
            </form>
            @endif
          @endif
        </div>
      </div>
			@endforeach
    </div>
  </div>    
</div>

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-list"></li> Daftar Project </h3>
      </div>
      <div class="card-block">
        <div class="x_content">
					<table class="table table-striped no-border">
            <thead>
              <tr>
                <th>Revisi</th>
                <th>PKP Number</th>
                <th>Revised By</th>
                <th>Priority</th>
                <th>Last update</th>
                <th width="10px" class="text-center">Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($datapkp as $pkp)
                <th>{{ $pkp->revisi }}.{{ $pkp->turunan }}</th>
                <th>{{ $pkp->datapkpp->pkp_number }}{{ $pkp->datapkpp->ket_no }}</th>
								<th>{{ $pkp->datapkpp->perevisi }}</th>
                <th>
                  @if($pkp->datapkpp->prioritas=='1')
                  <span class="label label-danger">High Priority</span>
                  @elseif($pkp->datapkpp->prioritas=='2')
                  <span class="label label-warning">Standar Priority</span>
                  @elseif($pkp->datapkpp->prioritas=='3')
                  <span class="label label-primary">Low Priority</span>
                  @endif
                </th>
                <th>{{ $pkp->datapkpp->last_update }}</th>
                <th class="text-center">
                  @if($pkp->status_data=='active')
                  <span class="label label-primary" style="color:white">Active</span>
                  @elseif($pkp->status_data=='inactive')
                  <span class="label label-danger" style="color:white">Inactive</span>
                  @endif
                </th>
                <th class="text-center">
                  @if($pkp->datapkpp->type==1 && $pkp->gambaran_proses==NULL)
                    @if($pkp->status_terima!='proses' || $pkp->status_terima2!='proses')
                    <button class="btn btn-info" data-toggle="modal" data-target="#maklon{{$pkp->id_pkp}}" totle="Show"><i class="fa fa-eye"></i></a></button>
                    <div class="modal" id="maklon{{$pkp->id_pkp}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <!-- modal -->
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title text-left" id="exampleModalLabel">Tambah Data Maklon
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></h3>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{ Route('Gproses',['id_pkp' => $pkp->id_pkp, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" novalidate>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-3 col-xs-12">Gambaran Proses</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea name="proses" id="proses"30" rows="5" class="form-control col-md-12 col-xs-12"></textarea>
                            </div>
					                </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Submit</button>
                            {{ csrf_field() }}
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                    <!-- modal Selesai -->
                  </div>
                    @endif
                  @else
                    @if($data->status_terima!='proses' || $data->status_terima2!='proses')
                    <a class="btn btn-info" href="{{ Route('pkplihat',['id_pkp' => $pkp->id_pkp, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                    @endif
                  @endif
                  {{csrf_field()}}
                </th>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>    
</div>

<!-- modal -->
<div class="modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">                 
        <h3 class="modal-title" id="exampleModalLabel">Confirm Type PKP
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h3>
      </div>
      <div class="modal-body">
      <form class="form-horizontal form-label-left" method="POST" action="{{ route('edittype',$data->id_project) }}" novalidate>
        <div class="form-group row">
          <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Type</label>
          <div class="col-md-11 col-sm-9 col-xs-12">
            <select name="type" class="form-control form-control-line" id="type">
            @foreach($pkp1 as $pkp1)
            <option readonly value="{{$pkp1->type}}">
            @if($pkp1->type==1)
            Maklon
            @elseif($pkp1->type==2)
            Internal
            @elseif($pkp1->type==3)
            Maklon/Internal
            @endif</option>
            @endforeach
            <option value="1">Maklon</option>
            <option value="2">Internal</option>
            <option value="3">Maklon & Internal</option>
            </select>
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
<!-- modal selesai -->

<!-- modal -->
<div class="modal" id="alihkan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">                 
        <h3 class="modal-title" id="exampleModalLabel">Divert Project
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h3>
      </div>
      <div class="modal-body">
      <form class="form-horizontal form-label-left" method="POST" action="{{ route('alihkan',$data->id_project) }}" novalidate>
        <div class="form-group row">
          <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Dept1</label>
          <div class="col-md-11 col-sm-9 col-xs-12">
            <select name="tujuankirim" class="form-control form-control-line" id="type">
            <option disabled selected>{{$data->departement->dept}} ({{$data->departement->nama_dept}})</option>
            @foreach($dept as $dept)
              <option value="{{$dept->id}}">{{$dept->dept}} ({{$dept->nama_dept}})</option>
            @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Dept2</label>
          <div class="col-md-11 col-sm-9 col-xs-12">
            <select name="tujuankirim2" class="form-control form-control-line" id="type">
            @if($data->tujuankirim2==0)
              <option value="0" selected>No Departement Selected</option>
              @elseif($data->tujuanlirim2==1)
              <option selected>{{$data->departement2->dept}} ({{$data->departement2->nama_dept}})</option>
              
              @endif<option value="1">RKA</option>
              <option value="0">No Departement Selected</option>
            </select>
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
<!-- modal selesai -->
@endsection