@extends('pv.tempvv')
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
                @endif
              </td></tr>
              <tr><td>PKP Number</td><td> : {{$data->pkp_number}}{{$data->ket_no}}</td></tr>
							<tr><td>Created</td><td> : {{$data->created_date}}</td></tr>
							<tr><td>Author</td><td> : {{$data->author}}</td></tr>
						</thead>
					</table><br>
          @if($data->status_project=='revisi')
          <button class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#edit"><li class="fa fa-edit"></li> Edit Type PKP</button>
          @endif
					@if($hitung==0)
					<a href="{{ route('bagian2',$data->id_project)}}" class="btn btn-primary btn-sm" type="button"><li class="fa fa-plus"></li> Add Data</a>
					@elseif($hitung>=1)
					@endif
          @if(auth()->user()->role->namaRule != 'user_produk')
            @if($data->status_project=="revisi")
            <a href="{{ route('datapengajuan')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
            <button class="btn btn-primary btn-sm" title="note" data-toggle="modal" data-target="#data{{ $data->id_project  }}"><i class="fa fa-edit"></i> Edit Timeline</a></button>
            <!-- Modal -->
            <div class="modal" id="data{{ $data->id_project  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <form class="form-horizontal form-label-left" method="POST" action="{{ Route('TMubahpkp',$data->id_project)}}" novalidate>
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
									  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</button>
									  {{ csrf_field() }}
								  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Modal Selesai -->
            @elseif($data->status_project=="draf" )
            <a href="{{ route('drafpkp')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
            @elseif($data->status_project=="sent" || $data->status_project=="close")
            <a href="{{ route('listpkp')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
            @endif
            @if($data->status_project!='draf' && $data->status_project!="close")
            @if(auth()->user()->role->namaRule === 'pv_lokal')
            <button class="btn btn-dark btn-sm" title="note" data-toggle="modal" data-target="#priority{{ $data->id_project  }}"><i class="fa fa-edit"></i> Update priority</a></button>
            <!-- Modal -->
            <div class="modal" id="priority{{ $data->id_project  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Priority
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal form-label-left" method="POST" action="{{ Route('prioritas',$data->id_project)}}" novalidate>
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
          @elseif(auth()->user()->role->namaRule === 'user_produk')
          <a href="{{ route('listprojectpkp')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
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
                <th>Revised By</th>
                <th>Last update</th>
                <th>Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($datapkp as $pkp)
                <th>{{ $pkp->revisi }}.{{ $pkp->turunan }}</th>
								<th>{{ $pkp->datapkpp->perevisi }}</th>
                <th>{{ $pkp->datapkpp->last_update }}</th>
                <th>{{ $pkp->status_data }}</th>
                <th class="text-center">
                  @if($pkp->kemas_eksis!=NULL)
                  <a class="btn btn-info" href="{{ Route('lihatpkp',['id_pkp' => $pkp->id_pkp,'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                    @endif
                    @if($pkp->status_pkp!='sent')
                      @if($pkp->status_data=='active')
									    <a class="btn btn-warning" href="{{ route('bagian1', ['id_pkp' => $pkp->id_pkp,'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
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
@endsection