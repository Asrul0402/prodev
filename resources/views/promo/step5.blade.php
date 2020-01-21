@extends('pv.tempvv')
@section('title', 'Data Tambahan PKP')
@section('judulhalaman','Data Tambahan PKP')
@section('content')

<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-10">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href="" ><span class="nmbr">1</span>Information</a></li>
        <li class="active"><a href=""><span class="nmbr">2</span>Data</a></li>
        <li class="active"><a href=""><span class="nmbr">3</span>Products</a></li>
        <li class="completed"><a href=""><span class="nmbr">4</span>File & Image</a></li>
      </ul>
    </div>
  </div>
</div>
<br>

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

@if (count($errors) > 0)
<div class="alert alert-danger">
  <strong>Whoops!</strong> There were some problems with your input.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

@if(session('success'))
<div class="alert alert-success">
   {{ session('success') }}
</div> 
@endif

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
			<h3 class="jumbotron"><li class=" fa fa-upload"></li> File Upload</h3>
      <form method="post" action="{{url('uploadpromo')}}" enctype="multipart/form-data">
		  {{csrf_field()}}
			<div class="input-group control-group increment" >
      @foreach($id_pkp as $pkp)
			<input type="hidden" value="{{ $pkp->datapromoo->id_pkp_promo }}" name="id">
			<input type="hidden" value="{{ $pkp->turunan }}" name="turunan">
      @endforeach
				<input type="file" name="filename[]" class="form-control" multiple>
		  </div>
			<button type="submit" class="btn btn-primary" style="margin-top:10px"> Submit</button>
	    </form>        
		</div>
	</div>
</div>

@foreach($coba as $pdf)
<div class="col-md-3">
  <div class="x_panel">
    <div class="x_title">
			<h5><li class=" fa fa-file"> {{$pdf->filename }}</li></h5>
    </div>
		<div class="card-body">
		<embed src="{{ Storage::url($pdf->lokasi)}}" width="210px" height="210px" type="">
		<a href="{{ Route('destroydata',$pdf->id_pictures) }}" type="button" class="btn btn-danger" data-toggle="tooltip" title="Delete"><li class="fa fa-trash-o"></li></a>
    <button class="btn btn-info" data-toggle="modal" data-target="#NW{{ $pdf->id_pictures }}" data-toggle="tooltip" title="Show"><li class="fa fa-eye"></li></button>
      <!-- Modal -->
      <div class="modal" id="NW{{ $pdf->id_pictures }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">                 
              <h3 class="modal-title" id="exampleModalLabel">File Data
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></h3>
            </div>
            <div class="modal-body">
            <embed src="{{ Storage::url($pdf->lokasi)}}" width="765px" height="670" type="">
            </div>
            <div class="modal-footer"></div>
          </div>
        </div>
      </div>
      <!-- Modal Selesai -->
    </div>
  </div>
</div>
@endforeach

<div class="col-md-12">
  <div class="x_panel">
    @foreach($id_pkp as $pkp)
    <a href="{{ Route('rekappromo',$pkp->id_pkp_promoo) }}" class="btn btn-info col-md-12" >Finish</a>
    @endforeach
	</div>   
</div>
@endsection