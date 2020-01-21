@extends('pv.tempvv')
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
          @if($data->status_project=='revisi')
          <button class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#edit"><li class="fa fa-edit"></li> Confirm Type PKP</button>
          @endif
          @if($promo==0)
					<a href="{{ route('promo1',$data->id_pkp_promo)}}" class="btn btn-primary btn-sm" type="button"><li class="fa fa-plus"></li> Add Data</a>
          @elseif($promo>=0)
          @endif
          @if(auth()->user()->role->namaRule != 'user_produk')
            @if($data->status_project=="revisi")
            <a href="{{ route('datapengajuan')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
            <button class="btn btn-primary btn-sm" title="note" data-toggle="modal" data-target="#data{{ $data->id_pkp_promo  }}"><i class="fa fa-edit"></i> Edit Timeline</a></button>
            <!-- Modal -->
            <div class="modal" id="data{{ $data->id_pkp_promo  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Timeline Project : {{$data->project_name}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></h3>
                  </div>
                  <div class="modal-body">
                    <div class="row x_panel">
                      <form class="form-horizontal form-label-left" method="POST" action="{{ Route('TMubah',$data->id_pkp_promo)}}" novalidate>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12 text-center">Deadline for sending Sample</label>
                      <div class="col-md-4 col-sm-9 col-xs-12">
                        <input type="date" class="form-control" value="{{$data->jangka}}" name="jangka" id="jangka" placeholder="start date">
                      </div>
                      <div class="col-md-4 col-sm-9 col-xs-12">
                        <input type="date" class="form-control" value="{{$data->waktu}}" name="waktu" id="waktu" placeholder="end date">
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
									  <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>
									  {{ csrf_field() }}
								  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Modal Selesai -->
            @elseif($data->status_project=="draf")
            <a href="{{ route('drafpromo')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
				    @elseif($data->status_project=="sent" || $data->status_project=="proses")
            <a href="{{ route('listpromo')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
					  @endif
            @if($data->status_project!="draf" && $data->status_project!="close")
            @if(auth()->user()->role->namaRule === 'pv_lokal')
            <button class="btn btn-dark btn-sm" title="note" data-toggle="modal" data-target="#priority{{ $data->id_pkp_promo  }}"><i class="fa fa-edit"></i> Update priority</a></button>
            <!-- Modal -->
            <div class="modal" id="priority{{ $data->id_pkp_promo  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Priority
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal form-label-left" method="POST" action="{{ Route('prioritaspromo',$data->id_pkp_promo)}}" novalidate>
                    <label class="control-label col-md-3 col-sm-3 col-xs-12 text-center">Priority Project</label>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                    <select name="prioritas" id="prioritas" class="form-control col-md-9 col-sm-12 col-xs-12">
                      <option value="{{$data->prioritas}}" disabled selected>
                      @if($data->prioritas==1) Prioritas 1
                      @elseif($data->prioritas==2) Prioritas 2
                      @elseif ($data->prioritas==3) Prioritas 3
                      @endif
                      </option>
                      <option value="1">Prioritas 1</option>
                      <option value="2">Prioritas 2</option>
                      <option value="3">Prioritas 3</option>
                    </select>
                    </div>
                  </div>
                  <div class="modal-footer">
									  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</button>
									  {{ csrf_field() }}
								  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Modal Selesai -->
            @endif
            @endif
          @elseif(auth()->user()->role->namaRule == 'user_produk')
          <a href="{{ route('listprojectpromo')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
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
                <th class="text-center">Revisi</th>
                <th>Perevisi</th>
                <th>Last update</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @if($promo==0)
              @elseif($promo>=0)
              @foreach($pkp as $pkp)
              <tr>
                <th class="text-center">{{ $pkp->revisi }}.{{ $pkp->turunan }}</th>
								<th>{{ $pkp->datapromoo->perevisi }}</th>
                <th>{{ $pkp->datapromoo->last_update }}</th>
                <th class="text-center">
                  @if($pkp->status_data=='active')
                  <span class="label label-primary" style="color:white">Active</span>
                  @elseif($pkp->status_data=='inactive')
                  <span class="label label-danger" style="color:white">Inactive</span>
                  @endif
                </th>
                <th class="text-center">
                  <a class="btn btn-info" href="{{ Route('lihatpromo',['id_pkp_promo' => $pkp->id_pkp_promoo, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
									@if($pkp->status_promo!='sent')
                  <a class="btn btn-warning" href="{{ route('promo11', ['id_pkp_promo' => $pkp->id_pkp_promoo, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                  @endif
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

@endsection