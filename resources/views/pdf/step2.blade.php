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

<div class="row">
  @include('formerrors')
  <div class="col-md-3"></div>
  <div class="col-md-8">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="completed"><a href="" ><span class="nmbr">1</span>Information</a></li>
        <li class="active"><a href=""><span class="nmbr">2</span>PDF</a></li>
        <li class="active"><a href=""><span class="nmbr">3</span>File & Image</a></li>
      </ul>
    </div>
  </div>
</div>
<br>

@foreach($pdf as $pdf)
<div class="">
  <form class="form-horizontal form-label-left" method="POST" action="{{ route('pertamaa',['pdf_id' => $pdf->pdf_id, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan]) }}" novalidate>
  <div class="row">
    <div class="col-md-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-file-archive-o"></li> {{$pdf->project_name}}</h3>
        </div>
        <div class="card-block">
          <div class="x_content">
            <div class="col-md-12 col-xs-12">
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Created date**</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input disabled value="{{$pdf->created_date}}" id="last" class="form-control col-md-12 col-xs-12" name="last" required="required" type="text">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Project name**</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input id="name" value="{{$pdf->project_name}}" class="form-control col-md-12 col-xs-12" type="text" name="name">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">County**</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input id="revisi" value="{{$pdf->country}}" class="form-control col-md-12 col-xs-12" type="text" name="country">
                </div>
              </div>
					    <?php
              $kode = $pdf->id_project;
              $noUrut = (int) substr($kode, 3, 3);
              $noUrut++;
              $tanggal = Date("Y");
              $kode = sprintf("%03s_", $noUrut) . $tanggal;
              ?>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">No.PDF</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input id="author" disabled value="{{$kode}}/PDF_{{ $pdf->project_name }}_{{ $pdf->id_brand }}_{{ $pdf->revisi }}.{{ $pdf->turunan }}" class="form-control col-md-12 col-xs-12" type="text" name="author">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xs-12">
      <div class="x_panel" style="min-height:276px">
        <div class="x_title">
          <h3><li class="fa fa-file-archive-o"></li> {{$pdf->project_name}}</h3>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">type project **</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input id="project" value="{{ $pdf->product_type }}" disabled class="form-control col-md-12 col-xs-12" type="text" name="project" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Brand **</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select name="brand" id="brand" class="form-control">
              <option value="{{ $pdf->id_brand }}" readoly selected>{{ $pdf->id_brand }}</option>
              @foreach($brand as $brand)
              <option value="{{$brand->brand}}">{{$brand->brand}}</option>
              @endforeach
            </select>
          </div>
        </div>
				 <?php $date = Date('j-F-Y'); ?>
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Revised By **</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input id="perevisi" value="{{ Auth::user()->name }}" class="form-control col-md-12 col-xs-12" type="text" name="perevisi">
            <input required id="date" value="{{$date}}" required="required" class="form-control col-md-12 col-xs-12" type="hidden" name="date">
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Request**</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input id="perevisi" value="{{ $pdf->reference }}" class="form-control col-md-12 col-xs-12" type="text" name="request">
					</div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="x_panel">
  <div class="card-block col-md-6 col-md-offset-5">
    <button type="submit" class="btn btn-primary">Save And Next</button>
    {{ csrf_field() }}
  </div>
</div>
@endforeach
  </form>
@endsection
