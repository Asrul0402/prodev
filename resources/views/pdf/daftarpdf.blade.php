@extends('pv.tempvv')
@section('title', 'Daftar PDF')
@section('judulhalaman','Daftar PDF')
@section('content')

@foreach($data as $data)
<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-star"></li> Project Name : {{ $data->project_name}}</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <table>
						<thead>
							<tr><td>Brand</td><td> : {{$data->id_brand}}</td></tr>
							<tr><td>Type</td><td> : {{$data->type->type}}</td></tr>
              <tr><td>PDF Number</td><td> : {{$data->pdf_number}}{{$data->ket_no}}</td></tr>
							<tr><td>Created</td><td> : {{$data->created_date}}</td></tr>
							<tr><td>Author</td><td> : {{$data->author}}</td></tr>
						</thead>
					</table><br>
					@if($hitung==0)
					<a href="{{ route('pdf1',$data->id_project_pdf)}}" class="btn btn-primary btn-sm" type="button"><li class="fa fa-plus"></li> Add Data</a>
					@elseif($hitung>=1)
					@endif
          @if(auth()->user()->role->namaRule!='user_produk')
            @if($data->status_project=="revisi")
            <a href="{{ route('datapengajuan')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
            <button class="btn btn-primary btn-sm" title="note" data-toggle="modal" data-target="#data{{ $data->id_project_pdf  }}"><i class="fa fa-edit"></i> Edit Timeline</a></button>
            <!-- Modal -->
            <div class="modal" id="data{{ $data->id_project_pdf  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                   <h3 class="modal-title" id="exampleModalLabel">Timeline Project : {{$data->project_name}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button></h3>
                  </div>
                  <form class="form-horizontal form-label-left" method="POST" action="{{ Route('TMubahpdf',$data->id_project_pdf)}}" novalidate>    
                  <div class="modal-body">
                    <div class="row x_panel">
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
            @elseif($data->status_project!="draf" && $data->status_project!="revisi")
            <a href="{{ route('listpdf')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
            @elseif($data->status_project=="draf")
            <a href="{{ route('drafpdf')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
            @endif
            
            @if($data->status_project!="draf" && $data->status_project!="close")
            @if(auth()->user()->role->namaRule === 'pv_global')
            <button class="btn btn-dark btn-sm" title="note" data-toggle="modal" data-target="#priority{{ $data->id_project  }}"><i class="fa fa-edit"></i> Update priority</a></button>
            <!-- Modal -->
            <div class="modal" id="priority{{ $data->id_project_pdf  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Priority
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal form-label-left" method="POST" action="{{ Route('prioritaspdf',$data->id_project)}}" novalidate>
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
          <a href="{{ route('listprojectpdf')}}" class="btn btn-danger" btn-sm type="button"><li class="fa fa-share"></li> Back</a>
          @endif
				</div>
      </div>
    </div>
    @endforeach
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
                <th width="10px" class="text-center">Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
			        @foreach($pdf as $data)
							 @if($hitung==0)
						   @else($hitung!=0)
              <tr>
                <th>{{ $data->revisi }}.{{ $data->turunan }}</th>
								<th>{{ $data->perevisi }}</th>
                <th>{{ $data->last_updated }}</th>
                <th class="text-center">
                @if($data->status_pdf=='active')
                <span class="label label-primary" style="color:white">Active</span>
                @elseif($data->status_pdf=='inactive')
                <span class="label label-danger" style="color:white">Inactive</span>
                @endif
                </th>
                <th class="text-center">
                @if($data->kemas_eksis!=NULL)
                  <a class="btn btn-info" href="{{ Route('lihatpdf',['id_project_pdf' => $data->id_project_pdf, 'revisi' => $data->revisi, 'turunan' => $data->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                @endif
                @endif
                  @if($data->status_data!='sent')
								  <a class="btn btn-warning" href="{{ route('pdf2',['id_project_pdf' => $data->id_project_pdf, 'revisi' => $data->revisi, 'turunan' => $data->turunan])}}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
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
@endsection