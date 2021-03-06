@extends('formula.tempformula')
@section('title', 'Dasboard')
@section('judul', 'Dasboard')
@section('content')

<div class="row top_tiles">
  <a href="{{route('listprojectpkp')}}" type="button">
  <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-file"></i></div>
      <div class="count">{{$pkp}}</div>
      <h3>PKP</h3>
      <p> belum selesai <a href="{{Route('drafpkp')}}">(Click To See Details)</a></p>
    </div>
  </div>  
  </a>
  <a href="{{route('listprojectpromo')}}" type="button">
  <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-file"></i></div>
      <div class="count">{{$promo}}</div>
      <h3>PKP Promo</h3>
      <p>belum selesai <a href="{{Route('drafpromo')}}">(Click To See Details)</a></p>
    </div>
  </div>  
  </a>
  <a href="{{route('listprojectpdf')}}" type="button" >
  <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-file"></i></div>
      <div class="count">{{$pdf}}</div>
      <h3>PDFe & PDFp</h3>
      <p>belum selesai <a href="{{Route('drafpdf')}}">(Click To See Details)</a></p>
    </div>
  </div>
  </a>
</div>
<div class="row"><br><br><br><br><br><br><br><br><br>
  <div class="x_panel">
    <center><h1><li class="fa fa-star-o"></li><b> Welcome To Product Development!!..</h1></center>
	</div>
</div>

@endsection