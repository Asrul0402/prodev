@extends('pv.tempvv')
@section('title', 'Request PKP Promo')
@section('judulhalaman','Form PKP Promo')
@section('content')

<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-10">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href="" ><span class="nmbr">1</span>Information</a></li>
        <li class="completed"><a href=""><span class="nmbr">2</span>Data</a></li>
        <li class="active"><a href=""><span class="nmbr">3</span>Products</a></li>
        <li class="active"><a href=""><span class="nmbr">4</span>File & Image</a></li>
      </ul>
    </div>
  </div>
</div><br>
<div class="">
@foreach($pkp as $pkp)
<form class="form-horizontal form-label-left" method="POST" action="{{ route('datapromo1') }}" novalidate>
  <input type="hidden" value="{{ $pkp->id_pkp_promo}}" name="id_promo" id="id_promo">
  @endforeach
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-puzzle-piece"> PKP Promo</li></h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Promo Idea*</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <input required="required" id="promo_idea" class="form-control col-md-12 col-xs-12" type="text" name="promo_idea">
            </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12">Dimension*</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
              <input required="required" id="dimension" class="form-control col-md-12 col-xs-12" type="text" name="dimension">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Application*</label>
            <div class="col-md-10 col-sm-9 col-xs-12">
              <input required="required" id="application" class="form-control col-md-12 col-xs-12" type="text" name="application">
            </div>
          </div>
					<div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Promo Readiness*</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
              <input required="required" id="promo" class="form-control col-md-12 col-xs-12" type="date" name="promo">
            </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12">RTO*</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <input required="required" id="rto" class="form-control col-md-12 col-xs-12" type="date" name="rto">
            </div>
          </div>
          <div class="ln_solid"></div>
          <center><button class="btn btn-primary" type="submit"><li class="fa fa-plus"></li> Submit And Next</button></center>
          {{ csrf_field() }}
        </div>
      </div>
    </div>
  </div>	
</form>
</div>
@endsection