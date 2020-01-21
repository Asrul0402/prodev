@extends('manager.tempmanager')
@section('title', 'Daftar PKP')
@section('judulhalaman','Form PKP')
@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="card-headerx_title">
			@foreach($data as $data)
      <h3><li class="fa fa-star"></li> Project Name : {{ $data->project_name}}</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <table>
						<thead>
							<tr><td>Brand</td><td> : {{$data->brand}}</td></tr>
							<tr><td>Type PKP</td><td> : 
              @if($data->type==1)
              Maklon
              @elseif($data->type==2)
              Internal
              @elseif($data->type==3)
              Maklon/Internal
              @endif</td></tr>
              <tr><td>Promo Number</td><td> : {{$data->promo_number}}{{$data->ket_no}}</td></tr>
							<tr><td>Created</td><td> : {{$data->created_date}}</td></tr>
							<tr><td>Author</td><td> : {{$data->Author}}</td></tr>
						</thead>
					</table><br>
					<a href="{{ route('listpromoo')}}" class="btn btn-danger" type="button"><li class="fa fa-share"></li> Back</a>
          @if($data->type==3)
          <button class="btn btn-warning"  data-toggle="modal" data-target="#edit"><li class="fa fa-edit"></li> Confirm Type PKP</button>
          @endif
          <button class="btn btn-primary"  data-toggle="modal" data-target="#alihkan"><li class="fa fa-paper-plane"></li> Divert Project</button>
          <?php $last = Date('j-F-Y'); ?>
            @if(Auth::user()->departement->dept!='RKA')
            @if($data->status_terima=='proses')
            <form class="form-horizontal form-label-left" method="POST" action="{{ route('approvepromo1',$data->id_pkp_promo) }}" novalidate>
              <input type="hidden" value="{{$last}}" name="tgl">
              <button type="submit" class="btn btn-dark"><li class="fa fa-check"></li> Approve data</button>
              {{ csrf_field() }}
            </form>
            @endif
          @elseif(Auth::user()->departement->dept=='RKA')
            @if($data->status_terima2=='proses')
            <form class="form-horizontal form-label-left" method="POST" action="{{ route('approvepromo2',$data->id_pkp_promo) }}" novalidate>
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
					<table class="Table table-striped no-border">
            <thead>
              <tr>
                <th>Revisi</th>
                <th>PKP Number</th>
                <th>Revised By</th>
                <th>Prioritas</th>
                <th>Last update</th>
                <th width="10px" class="text-center">Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
            @if($promo==0)
            @elseif($promo>=0)
            @foreach($pkp as $pkp)
              <tr>
                <th class="text-center">{{ $pkp->revisi }}.{{ $pkp->turunan }}</th>
                <th>{{$pkp->datapromoo->promo_number}}{{$pkp->datapromoo->ket_no}}</th>
								<th>{{ $pkp->datapromoo->perevisi }}</th>
                <th>
                  @if($pkp->datapromoo->prioritas=='1')
                  <span class="label label-danger">High Priority</span>
                  @elseif($pkp->datapromoo->prioritas=='2')
                  <span class="label label-warning">Standar Priority</span>
                  @elseif($pkp->datapromoo->prioritas=='3')
                  <span class="label label-primary">Low Priority</span>
                  @endif
                </th>
                <th>{{ $pkp->datapromoo->last_update }}</th>
                <th class="text-center">
                @if($pkp->status_data=='active')
                <span class="label label-primary" style="color:white">Active</span>
                @elseif($pkp->status_data=='inactive')
                <span class="label label-danger" style="color:white">Inactive</span>
                @endif
                </th>
                <th class="text-center">
                  <a class="btn btn-info" href="{{ Route('promolihat',['id_pkp_promo' => $pkp->id_pkp_promoo, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                  {{csrf_field()}}
                </th>
              </tr>
            @endforeach
            @endif
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
        </button></h3>
      </div>
      <div class="modal-body">
      <form class="form-horizontal form-label-left" method="POST" action="{{ route('edittypepromo',$data->id_pkp_promo) }}" novalidate>
        <div class="form-group row">
          <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Type</label>
          <div class="col-md-11 col-sm-9 col-xs-12">
            <select name="type" class="form-control form-control-line" id="type">
            <option readonly value="{{$data->type}}">
            @if($data->type==1)
            Maklon
            @elseif($data->type==2)
            Internal
            @elseif($data->type==3)
            Maklon/Internal
            @endif</option>
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
      <form class="form-horizontal form-label-left" method="POST" action="{{ route('alihkanpromo',$data->id_pkp_promo) }}" novalidate>
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