@extends('pv.tempvv')
@section('title', 'Request PDF')
@section('judulhalaman','Form Request PDFp & PDFe')
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

<div class="x_panel">
  <a href="{{route('lala')}}" class="btn btn-danger btn-sm"><li class="fa fa-share"></li> Back</a>
</div>
<div class="">
  <form class="form-horizontal form-label-left" method="POST" action="{{ route('datapdf') }}" novalidate>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-6">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-file-archive-o"></li> Project</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Project Type**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select id="product_type" required name="product_type" class="form-control" >
                <option disabled selected>-- Select One --</option>
                <option value="PDFe">PDFe</option>
                <option value="PDEp">PDFp</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Author</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="author" value="{{ Auth::user()->name }}" class="form-control col-md-12 col-xs-12" type="text" name="author" readonly>
            </div>
          </div>
          <?php $date = Date('j-F-Y'); ?>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="date" value="{{$date}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="date" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Type**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select required="required" id="type" name="type" class="form-control" >
                <option disabled selected>-- Select One --</option>
                @foreach($type as $type)
                <option value="{{  $type->id }}">{{  $type->type }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-edit"></li> Brand Concept</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Project Name**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required="required" id="project_name" class="form-control col-md-12 col-xs-12" type="text" name="project_name">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Brand**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select required="required" id="brand" name="brand" class="form-control" >
                <option disabled selected>-- Select One --</option>
                @foreach($brand as $brand)
                <option value="{{  $brand->brand }}">{{  $brand->brand }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Country**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required="required" id="country" class="form-control col-md-12 col-xs-12" type="text"  name="country">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Reference**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required="required" id="reference" class="form-control col-md-12 col-xs-12" type="text" placeholder="Reference Regulation" name="reference">
            </div>
          </div>
          <hr>
        </div>
      </div>
    </div>
  </div>
  <div class="x_panel">
    <div class="col-md-6 col-md-offset-5">
      <button type="reset" class="btn btn-danger">Reset</button>
      <button type="submit" class="btn btn-primary">Submit</button>
      {{ csrf_field() }}
    </div>
  </div>
</form>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $(".btn-success").click(function(){
      var html = $(".clone").html();
      $(".increment").after(html);
  });
  $("body").on("click",".btn-danger",function(){
    $(this).parents(".control-group").remove();
  });
  });
</script>
@endsection
