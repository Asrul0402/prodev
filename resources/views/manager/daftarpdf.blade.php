@extends('manager.tempmanager')
@section('title', 'Daftar PDF')
@section('judulhalaman','Daftar PDF')
@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
			@foreach($data as $data)
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
          <a href="{{ route('listpdfrka')}}" class="btn btn-danger" type="button"><li class="fa fa-share"></li> Kembali</a>
          @if($data->status_project!='close')
          <button class="btn btn-primary"  data-toggle="modal" data-target="#alihkan"><li class="fa fa-paper-plane"></li> Divert Project</button>
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
                  <form class="form-horizontal form-label-left" method="POST" action="{{ route('alihkanpdf',$data->id_project_pdf) }}" novalidate>
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
          @endif
          <?php $last = Date('j-F-Y'); ?>
          @if(Auth::user()->departement->dept!='RKA')
            @if($data->status_terima=='proses')
            <form class="form-horizontal form-label-left" method="POST" action="{{ route('approvepdf1',$data->id_project_pdf) }}" novalidate>
              <input type="hidden" value="{{$last}}" name="tgl">
              <button type="submit" class="btn btn-dark"><li class="fa fa-check"></li> Approve data</button>
              {{ csrf_field() }}
            </form>
            @endif
          @elseif(Auth::user()->departement->dept=='RKA')
            @if($data->status_terima2=='proses')
            <form class="form-horizontal form-label-left" method="POST" action="{{ route('approvepdf2',$data->id_project_pdf) }}" novalidate>
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
                <th>PDF Number</th>
                <th>Revised By</th>
                <th>Priority</th>
                <th>Last update</th>
                <th width="10px" class="text-center">Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
			        @foreach($pdf as $data)
								@if($hitung==0)
								@else($hitung!=0)
                <th>{{ $data->revisi }}.{{ $data->turunan }}</th>
                <th> {{$data->pdf_number}}{{$data->ket_no}}</th>
								<th>{{ $data->perevisi }}</th>
                <th>
                  @if($data->prioritas=='1')
                  <span class="label label-danger">High Priority</span>
                  @elseif($data->prioritas=='2')
                  <span class="label label-warning">Standar Priority</span>
                  @elseif($data->prioritas=='3')
                  <span class="label label-primary">Low Priority</span>
                  @endif
                </th>
                <th>{{ $data->last_updated }}</th>
                <th class="text-center">
                @if($data->status_pdf=='active')
                <span class="label label-primary" style="color:white">Active</span>
                @elseif($data->status_pdf=='inactive')
                <span class="label label-danger" style="color:white">Inactive</span>
                @endif
                </th>
                <th class="text-center">
                  <a class="btn btn-info" href="{{ Route('pdflihat',['id_project_pdf' => $data->id_project_pdf, 'revisi' => $data->revisi, 'turunan' => $data->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                  {{csrf_field()}}
                </th>
                @endif
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