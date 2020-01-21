@extends('pv.tempvv')
@section('title', 'Request PKP')
@section('judulhalaman','Request PKP')
@section('content')

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-8">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href="" ><span class="nmbr">1</span>Information</a></li>
        <li class="completed"><a href=""><span class="nmbr">2</span>PKP</a></li>
        <li class="active"><a href=""><span class="nmbr">3</span>File & Image</a></li>
      </ul>
    </div>
  </div>
</div><br>

<form class="form-horizontal form-label-left" method="POST" action="{{ route('tippp') }}" novalidate>
<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-file"></li> Background</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <div class="form-group row">
            <input type="hidden" value="{{ $id_pkp->id_project }}" name="id">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Idea*</label>
            <div class="col-md-10 col-sm-10 col-xs-12">
              <textarea name="idea" id="idea" class="col-md-11 col-sm-12 col-xs-12" ></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Target Market</label>
            <label class="control-label col-md-1 col-sm-3 col-xs-12" for="last-name">Gender*:</label>
            <div class="col-md-8 col-sm-3 col-xs-12">
              <select id="gender"  name="gender" class="form-control" >
                <option disabled selected>-- Select Gender --</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="Male dan Female">Male & Female</option>
              </select>
            </div><br><br><br>
            <div class="form-group row">
              <label for="middle-name" class="control-label col-md-1 col-sm-3 col-xs-12"></label>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
              <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> &nbsp  &nbsp Age Range form* : </label>
              <div class="col-md-2 col-sm-3 col-xs-12">
                <input type="number"  name="dariumur" id="dariumur" class="form-control col-md-12 col-xs-12">
              </div>
              <div class="col-md-1 col-sm-3 col-xs-12  text-center"> To </div>
              <div class="col-md-2 col-sm-3 col-xs-12">
                <input type="number" name="sampaiumur" id="sampaiumur" class="form-control col-md-12 col-xs-12">
              </div>
              <label for="middle-name" class="control-label col-md-1 col-sm-2 col-xs-12">SES* </label>
              <div class="col-md-2 col-sm-6 col-xs-12">
                <select class="form-control form-control-line items" name="ses[]"   multiple="multiple">
                  <option disabled="">-- Select One --</option>
                  @foreach($ses as $ses)
                  <option value="{{$ses->ses}}">{{$ses->ses}}</option>
                  @endforeach
                </select>
              </div>
              </div>
          </div>
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-3 col-xs-12">Uniqueness of Idea* </label>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <select class="form-control form-control-line" name="uniq_idea" >
                <option disabled="" selected="">-- Select One --</option>
                @foreach($idea as $idea)
                <option value="{{ $idea->uniqueness_of_idea }}">{{ $idea->uniqueness_of_idea }}</option>
                @endforeach
              </select>
            </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12">Estimated*</label>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <select class="form-control form-control-line" name="estimated" >
                <option disabled="" selected="">-- Select Estimated potential market --</option>
                @foreach($market as $market)
                <option value="{{ $market->estimasi_market }}">{{ $market->estimasi_market }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">reason*</label>
            <div class="col-md-10 col-sm-10 col-xs-12">
              <textarea name="reason" id="reason" class="col-md-11 col-sm-12 col-xs-12" ></textarea>
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-search"></li> Market Analysis</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Launch* </label> &nbsp
      		  <input type="radio" name="data" oninput="template()" id="radio_temp"> Launch periode  &nbsp &nbsp
     			  <input type="radio" name="data" oninput="kalender()" id="radio_cal"> Launch date &nbsp &nbsp
          </div>
          <div id="tampilkan"></div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Aisle Placement*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" placeholder="Aisle Placement"  name="aisle" id="aisle" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Comperitor*</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <input type="text" placeholder="Comperitor"  name="competitor" id="" class="form-control col-md-12 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12">Competitive*</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <input type="text" placeholder="Competitive Advantage"  name="Competitive" id="" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-2 col-sm-9 col-xs-12" >
              <label class="control-label col-md-12 col-sm-3 col-xs-12">Sales Forecast*</label> 
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12" style="overflow-x: scroll;">
              <table class="table table-bordered table-hover" id="tabledata">
        				<tbody>
        				  <tr id='tr_clone'>
                    <td><input type="number" name="forecast[]" width="500px" class="form-control"></td>
                    <td>
                      <select name="satuan[]" class="form-control items">
                        <option disabled selected>--> Select One <--</option>
                        <option value="1 Bulan Pertama">1 Bulan Pertama</option>
                        <option value="2 Bulan Pertama">2 Bulan Pertama</option>
                        <option value="3 Bulan Pertama">3 Bulan Pertama</option>
                      </select>
                    </td>
                    <td>
                      <button id="add_data" type="button" class="btn btn-info btn-sm pull-left tr_clone_add"><li class="fa fa-plus"></li> Add Forecast</button>
                    </td>
                  </tr>
        					<tr id='addrow1'></tr>
        				</tbody>
      				</table>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Selling Price (Before PPN)*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="number"  name="Selling_price" id="Selling_price" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Consumer Price*</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <input type="number" placeholder="Consumer Price"  name="consumer_price" id="consumer_price" class="form-control col-md-12 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12">UOM*</label>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <select class="form-control form-control-line items" name="uom" >
                <option disabled="">-- Select One --</option>
                @foreach($uom as $uom)
                <option value="{{ $uom->id }}">{{$uom->	primary_uom}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-star"></li> Product Features</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Product Form*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select  id="product" name="product" class="form-control" >
                <option disabled selected>-- Select one --</option>
                <option value="powder">Powder</option>
                <option value="solid">Solid</option>
                <option value="paste">Paste</option>
                <option value="liquid">Liquid</option>
              </select>
            </div>
          </div>
          @if(auth()->user()->role->namaRule == 'pv_lokal')
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">AKG^</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select name="akg"  id="akg" class="form-control">
                @foreach($tarkon as $tr)
                <option value="{{ $tr->id_tarkon}}">{{$tr->tarkon}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">No category BPOM^</label>
            <div class="col-md-2 col-sm-9 col-xs-12">
              <select class="form-control"  id="bpom" name="bpom">
                @foreach($pangan as $dp)
                <option value="{{ $dp->id_pangan }}">{{ $dp->no_kategori }}</option>
                @endforeach
              </select>
            </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12">category</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
              <select name="katbpom"  id="katbpom" class="form-control">
                @foreach($pangan as $kat)
                <option value="{{$kat->id_pangan}}">{{$kat->kategori}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3 col-sm-9 col-xs-12">
              <select name="olahan"  id="olahan" class="form-control">
              </select>
            </div>
          </div>
          <div class="form-group">
            <input type="hidden" value="{{$eksis+1}}" name="kemas" id="kemas">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Configuration^</label>&nbsp &nbsp
            <input type="radio" name="data" oninput="baru()" id="radio_baru"> New Configuration  &nbsp &nbsp
       			<input type="radio" name="data" oninput="eksis()" id="radio_eksis"> Configuration exists &nbsp &nbsp
       			<input type="radio" name="data" oninput="pilih()" id="radio_project"> Previous Project Configuration  &nbsp &nbsp
					</div>
          @endif
          <div id="lihat"></div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">prefered *</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea  id="prefered" class="form-control col-md-12 col-xs-12" type="text" name="prefered"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label  class="control-label col-md-2 col-sm-3 col-xs-12">Mandatory Ingredient*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea id="ingredient"  class="form-control col-md-12 col-xs-12" placeholder="" type="text" name="ingredient"></textarea>
            </div>
          </div>		
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Product Benefits*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea  id="benefits" class="form-control col-md-12 col-xs-12" type="text" name="benefits"></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-2 col-sm-9 col-xs-12 text-center">
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12" style="overflow-x: scroll;">
              <table class="table table-bordered table-hover" id="tab_logic">
        				<thead>
                  <tr>
        			      <th class="text-center">Komponen</th>
        					  <th class="text-center" width="15%">Klaim</th>
                    <th class="text-center" width="15%">Detail</th>
                    <th class="text-center">Note</th>
        			      <th class="text-center">Actiom</th>
    					    </tr>
        				</thead>
        				<tbody>
        				  <tr id='addr0'>
                    <input type="hidden" value="{{$Ddetail}}" name="iddetail" id="iddetail">
                    <td>
                      <select class="form-control items komponen" id="komponen" name="komponen[]">
                        @foreach($komponen as $kp)
                        <option value="{{ $kp->id }}">{{ $kp->komponen }}</option>
                        @endforeach
                      </select>
                    </td>
                    <td>
                      <select name="klaim[]" class="form-control items" id="klaimm">
                      </select>
                    </td>
                    <td>
                      <select name="detail[]"  id="detaill" multiple="multiple" class="form-control items">          
                      </select>
                    </td>
                    <td><textarea type="text" class="form-control" name="ket[]" id="ket"></textarea></td>
        					  <td><button class="tr_clone_add btn btn-info btn-sm" id="add_row" type="button"><li class="fa fa-plus"></li></button></td>
        					</tr>
        					<tr id='addr1'></tr>
        				</tbody>
      				</table>
            </div>
          </div>
          <div class="col-md-6 col-md-offset-5">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="submit" class="btn btn-primary">Submit And Next</button>
            {{ csrf_field() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

@endsection
@section('s')
<script>
  $(document).ready(function() {

    var idkomponen = []
  <?php foreach($komponen as $key => $value) { ?>
    if(!idkomponen){
      idkomponen += [ { '<?php echo $key; ?>' : '<?php echo $value->id; ?>', } ];
    } else { idkomponen.push({ '<?php echo $key; ?>' : '<?php echo $value->id; ?>', }) }
  <?php } ?>

  var komponen = []
  <?php foreach($komponen as $key => $value) { ?>
    if(!komponen){
      komponen += [ { '<?php echo $key; ?>' : '<?php echo $value->komponen; ?>', } ];
    } else { komponen.push({ '<?php echo $key; ?>' : '<?php echo $value->komponen; ?>', }) }
  <?php } ?>

  var komponen1 = '';
    for(var i = 0; i < Object.keys(komponen).length; i++){
    komponen1 += '<option value="'+idkomponen[i][i]+'">'+komponen[i][i]+'</option>';
  }

  var i = 1;
  var a = {!! json_encode($Ddetail) !!};
  $("#add_row").click(function() {
    $('#addr' + i).html("<input type='hidden' value='"+(a+i)+"' name='iddetail' id='iddetail'><td><select class='form-control items' name='komponen[]' id='komponen"+(a+i)+"' >"+komponen1+
      "</select></td><td><select name='klaim[]' class='form-control items' id='klaimm"+(a+i)+"'>"+
      "</select></td><td><select name='detail[]' multiple='multiple' class='form-control items' id='detaill"+(a+i)+"'>"+
      "</select></td><td><textarea type='text' class='form-control' name='ket[]' id='ket'></textarea></td><td></td>");

      var b = a+i;
      console.log(b);
      $('#komponen' + b).on('change', function(){
        var myId = $(this).val();
          if(myId){
            $.ajax({
              url: '{{URL::to('getdetail')}}/'+myId,
              type: "GET",
              dataType: "json",
              beforeSend: function(){
              $('#loader').css("visibility", "visible");
          },

          success:function(data){
            console.log(data)
              $('#detaill' + b).empty();
              $.each(data, function(key, value){
                $('#detaill' + b).append('<option value="'+ key +'">' + value + '</option>');
              });
            console.log(data)
            },
            complete: function(){
              $('#loader').css("visibility","hidden");
          }
        });

        }
        else{
          $('#detaill' + b).empty();
        }
      });

      $('#komponen'+b).on('change', function(){
    var myId = $(this).val();
      if(myId){
        $.ajax({
        url: '{{URL::to('getkomponen')}}/'+myId,
        type: "GET",
        dataType: "json",
        beforeSend: function(){
            $('#loader').css("visibility", "visible");
        },

        success:function(data){
          console.log(data)
            $('#klaimm'+b).empty();
            $.each(data, function(key, value){
                $('#klaimm'+b).append('<option value="'+ key +'">' + value + '</option>');
            });
        console.log(data)
        },
        complete: function(){
              $('#loader').css("visibility","hidden");
          }
      });

      }
      else{
          $('#klaimm'+b).empty();
      }
  });
    $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
    i++;
  });

  $('#komponen').on('change', function(){
    var myId = $(this).val();
      if(myId){
        $.ajax({
        url: '{{URL::to('getkomponen')}}/'+myId,
        type: "GET",
        dataType: "json",
        beforeSend: function(){
            $('#loader').css("visibility", "visible");
        },

        success:function(data){
          console.log(data)
            $('#klaimm').empty();
            $.each(data, function(key, value){
                $('#klaimm').append('<option value="'+ key +'">' + value + '</option>');
            });
        console.log(data)
        },
        complete: function(){
              $('#loader').css("visibility","hidden");
          }
      });

      }
      else{
          $('#klaimm').empty();
      }
  });

  $('#komponen').on('change', function(){
    var myId = $(this).val();
      if(myId){
        $.ajax({
        url: '{{URL::to('getdetail')}}/'+myId,
        type: "GET",
        dataType: "json",
        beforeSend: function(){
            $('#loader').css("visibility", "visible");
        },

        success:function(data){
          console.log(data)
            $('#detaill').empty();
            $.each(data, function(key, value){
                $('#detaill').append('<option value="'+ key +'">' + value + '</option>');
            });
        console.log(data)
        },
        complete: function(){
              $('#loader').css("visibility","hidden");
          }
      });

      }
      else{
          $('#katbpom').empty();
      }
  });

  });

</script>

<script>
  function baru(){
    var baru = document.getElementById('radio_baru')

    if(baru.checked != true){
      document.getElementById('lihat').innerHTML = "";
    }else{
      document.getElementById('lihat').innerHTML =
      "<hr>"+
        "<div class='form-group'>"+
          "<label class='control-label col-md-2 col-sm-2 col-xs-12'>Configuration</label>&nbsp  &nbsp"+
       		"<input type='radio' name='gramasi' oninput='dua()' id='radio_dua'> 2 Dimensi &nbsp"+
       		"<input type='radio' name='gramasi' oninput='tiga()' id='radio_tiga'> 3 Dimensi &nbsp"+
      		"<input type='radio' name='gramasi' oninput='empat()' id='radio_empat'> 4 Dimensi &nbsp"+
					"<div id='tampil'></div>"+
				"</div>"+
        "<hr>"+
        "<h4><b><lable class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>*Information</lable></b></h4>"+
        "<br><br>"+
        "<div class='form-group'>"+
          "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Primary</label>"+
          "<div class='col-md-10 col-sm-10 col-xs-12'>"+
            "<textarea name='primary' id='primary' class='col-md-12 col-sm-12 col-xs-12'></textarea>"+
          "</div>"+
        "</div>"+
        "<div class='form-group'>"+
          "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='last-name'>Secondary</label>"+
          "<div class='col-md-10 col-sm-10 col-xs-12'>"+
            "<textarea name='secondary' id='secondary' class='col-md-12 col-sm-12 col-xs-12'></textarea>"+
          "</div>"+
        "</div>"+
        "<div class='form-group'>"+
          "<label for='middle-name' class='control-label col-md-2 col-sm-3 col-xs-12'>Tertiary </label>"+
          "<div class='col-md-10 col-sm-10 col-xs-12'>"+
            "<textarea name='tertiary' id='tertiary' class='col-md-12 col-sm-12 col-xs-12'></textarea>"+
          "</div>"+
        "</div>"+
        "<div class='ln_solid'></div>"
    }
  }

  function dua(){
    var dua = document.getElementById('radio_dua');

    if(dua.checked != true){
      document.getElementById('tampil').innerHTML = "";
    }else{
      document.getElementById('tampil').innerHTML = "<br><div class='panel panel-default'>"+
	      "<div class='panel-heading'><h5>Configuration</h5></div>"+
	        "<div class='panel-body'>"+
            "<div class='form-group'>"+
              "<div>"+
                "<input type='hidden' name='finance' maxlength='45' value='' class='form-control col-md-12 col-xs-12'>"+
              "</div>"+
              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='tersier' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='s_tersier'>"+
                  "<option disabled='' selected=''>Tersier</option>"+
                  "<option value='D'>D</option>"+
                  "<option value='S'>S</option>"+
                  "<option value='G'>G</option>"+
                  "<option value='SB'>SB</option>"+
                  "<option value='O'>O</option>"+
							    "<option value='R'>R</option>"+
                  "<option value='P'>P</option>"+
                  "<option value='GST'>GST</option>"+
                  "<option value='BTL'>BTL</option>"+
                "</select>"+
              "</div>"+
              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='primer' id=primer' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='s_primer'>"+
                  "<option disabled='' selected=''>Primer</option>"+
                  "<option value='G'>G</option>"+
                  "<option value='ML'>ML</option>"+
                "</select>"+
              "</div>"+
            "</div>"+
          "</div>"+
        "</div>"
    }
  }

  function tiga(){
    var tiga = document.getElementById('radio_tiga');

    if(tiga.checked != true){
      document.getElementById('tampil').innerHTML = "";
    }else{
      document.getElementById('tampil').innerHTML = "<br><div class='panel panel-default'>"+
	      "<div class='panel-heading'><h5>Configuration</h5></div>"+
	        "<div class='panel-body'>"+
            "<div class='form-group'>"+
              "<div>"+
                "<input type='hidden' name='finance' maxlength='45' value='' class='form-control col-md-12 col-xs-12'>"+
              "</div>"+
              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='tersier' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='s_tersier'>"+
                  "<option disabled='' selected=''>Tersier</option>"+
                  "<option value='D'>D</option>"+
                  "<option value='S'>S</option>"+
                  "<option value='G'>G</option>"+
                  "<option value='SB'>SB</option>"+
                  "<option value='O'>O</option>"+
							    "<option value='R'>R</option>"+
                  "<option value='P'>P</option>"+
                  "<option value='GST'>GST</option>"+
                  "<option value='BTL'>BTL</option>"+
                "</select>"+
              "</div>"+
              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='sekunder1' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='s_sekunder1'>"+
                  "<option disabled='' selected=''>Sekunder 1</option>"+
                  "<option value='D'>D</option>"+
                  "<option value='S'>S</option>"+
                  "<option value='G'>G</option>"+
                  "<option value='SB'>SB</option>"+
                  "<option value='O'>O</option>"+
							    "<option value='R'>R</option>"+
                  "<option value='P'>P</option>"+
                  "<option value='GST'>GST</option>"+
                  "<option value='BTL'>BTL</option>"+
                "</select>"+
              "</div>"+
              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='primer' id='primer1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='s_primer'>"+
                  "<option disabled='' selected=''>Primer</option>"+
                  "<option value='G'>G</option>"+
                  "<option value='ML'>ML</option>"+
                "</select>"+
              "</div>"+
            "</div>"+
          "</div>"+
        "</div>"
    }
  }

  function empat(){
    var empat = document.getElementById('radio_empat');

    if(empat.checked != true){
      document.getElementById('tampil').innerHTML = "";
    }else{
      document.getElementById('tampil').innerHTML =
      "<br><div class='panel panel-default'>"+
	    "<div class='panel-heading'><h5>Configuration</h5></div>"+
	      "<div class='panel-body'>"+
          "<div class='form-group'>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='tersier' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_tersier'>"+
                "<option disabled='' selected=''>Tersier</option>"+
                "<option value='D'>D</option>"+
                "<option value='S'>S</option>"+
                "<option value='G'>G</option>"+
                "<option value='SB'>SB</option>"+
                "<option value='O'>O</option>"+
							  "<option value='R'>R</option>"+
                "<option value='P'>P</option>"+
                "<option value='GST'>GST</option>"+
                "<option value='BTL'>BTL</option>"+
              "</select>"+
            "</div>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='sekunder1' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_sekunder1'>"+
                "<option disabled='' selected=''>Sekunder 1</option>"+
                "<option value='D'>D</option>"+
                "<option value='S'>S</option>"+
                "<option value='G'>G</option>"+
                "<option value='SB'>SB</option>"+
                "<option value='O'>O</option>"+
							  "<option value='R'>R</option>"+
                "<option value='P'>P</option>"+
                "<option value='GST'>GST</option>"+
                "<option value='BTL'>BTL</option>"+
              "</select>"+
            "</div>"+ "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='sekunder2' id='sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_sekunder2'>"+
                "<option disabled='' selected=''>Sekunder 2</option>"+
                "<option value='D'>D</option>"+
                "<option value='S'>S</option>"+
                "<option value='G'>G</option>"+
                "<option value='SB'>SB</option>"+
                "<option value='O'>O</option>"+
							  "<option value='R'>R</option>"+
                "<option value='P'>P</option>"+
                "<option value='GST'>GST</option>"+
                "<option value='BTL'>BTL</option>"+
              "</select>"+
            "</div>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='primer' id='primer' class='date-picker form-control maxlength='4' col-md-12 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_primer'>"+
                "<option disabled='' selected=''>Primer</option>"+
                "<option value='G'>G</option>"+
                "<option value='ML'>ML</option>"+
              "</select>"+
            "</div>"+
          "</div>"+
        "</div>"+
      "</div>"  ;
    }
  }

  var project = []
  <?php foreach($project as $key => $value) { ?>
  if(!project){
    project += [ { '<?php echo $key; ?>' : '<?php echo $value->kemas_eksis; ?>', } ];
  } else { project.push({ '<?php echo $key; ?>' : '<?php echo $value->kemas_eksis; ?>', }) }
  <?php } ?>

  var project1 = []
  <?php foreach($project as $key => $value) { ?>
  if(!project1){
    project1 += [ { '<?php echo $key; ?>' : '<?php echo $value->project_name; ?>', } ];
  } else { project1.push({ '<?php echo $key; ?>' : '<?php echo $value->project_name; ?>', }) }
  <?php } ?>

  var idkemas = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!idkemas){
    idkemas += [ { '<?php echo $key; ?>' : '<?php echo $value->id_kemas; ?>', } ];
  } else { idkemas.push({ '<?php echo $key; ?>' : '<?php echo $value->id_kemas; ?>', }) }
  <?php } ?>
  var kemas = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas){
    kemas += [ { '<?php echo $key; ?>' : '<?php echo $value->primer; ?>', } ];
  } else { kemas.push({ '<?php echo $key; ?>' : '<?php echo $value->primer; ?>', }) }
  <?php } ?>
  var kemas1 = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas1){
    kemas1 += [ { '<?php echo $key; ?>' : '<?php echo $value->s_primer; ?>', } ];
  } else { kemas1.push({ '<?php echo $key; ?>' : '<?php echo $value->s_primer; ?>', }) }
  <?php } ?>
  var kemas2 = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas2){
    kemas2 += [ { '<?php echo $key; ?>' : '<?php echo $value->sekunder1; ?>', } ];
  } else { kemas2.push({ '<?php echo $key; ?>' : '<?php echo $value->sekunder1; ?>', }) }
  <?php } ?>
  var kemas3 = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas3){
    kemas3 += [ { '<?php echo $key; ?>' : '<?php echo $value->s_sekunder1; ?>', } ];
  } else { kemas3.push({ '<?php echo $key; ?>' : '<?php echo $value->s_sekunder1; ?>', }) }
  <?php } ?>
  var kemas4 = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas4){
    kemas4 += [ { '<?php echo $key; ?>' : '<?php echo $value->sekunder2; ?>', } ];
  } else { kemas4.push({ '<?php echo $key; ?>' : '<?php echo $value->sekunder2; ?>', }) }
  <?php } ?>
  var kemas5 = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas5){
    kemas5 += [ { '<?php echo $key; ?>' : '<?php echo $value->s_sekunder2; ?>', } ];
  } else { kemas5.push({ '<?php echo $key; ?>' : '<?php echo $value->s_sekunder2; ?>', }) }
  <?php } ?>
  var kemas6 = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas6){
    kemas6 += [ { '<?php echo $key; ?>' : '<?php echo $value->tersier; ?>', } ];
  } else { kemas6.push({ '<?php echo $key; ?>' : '<?php echo $value->tersier; ?>', }) }
  <?php } ?>
  var kemas7 = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas7){
    kemas7 += [ { '<?php echo $key; ?>' : '<?php echo $value->s_tersier; ?>', } ];
  } else { kemas7.push({ '<?php echo $key; ?>' : '<?php echo $value->s_tersier; ?>', }) }
  <?php } ?>

  var pilihan = '';
  for(var i = 0; i < Object.keys(project).length; i++){
  pilihan += '<option value="'+project[i][i]+'">'+project1[i][i]+'</option>';
  }

  var kemaseksis = '';
  for(var i = 0; i < Object.keys(kemas).length; i++){
  kemaseksis += '<option value="'+idkemas[i][i]+'">'+kemas[i][i]+''+kemas1[i][i]+' '+kemas2[i][i]+''+kemas3[i][i]+' '+kemas4[i][i]+''+kemas5[i][i]+' '+kemas6[i][i]+''+kemas7[i][i]+'</option>';
  }

  function pilih(){
    var eksis = document.getElementById('radio_project')

    if(eksis.checked != true){
      document.getElementById('lihat').innerHTML = "";
    }else{
      document.getElementById('lihat').innerHTML =
      "<hr>"+
      "<div class='form-group'>"+
        "<div class='form-group'>"+
          "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Configuration</label>"+
          "<div class='col-md-9 col-sm-10 col-xs-12'>"+
            '<select name="data_eksis" class="form-control" id="txtOccupation" >'+
            '<option value="" readonly selected>-->Select One<--</option>'+pilihan+'</select>'+
          "</div>"+
        "</div>"+"<div class='form-group'>"+
        "<hr>"+
      "</di>"
    }
  }

  function eksis(){
    var eksis = document.getElementById('radio_eksis')

    if(eksis.checked != true){
      document.getElementById('lihat').innerHTML = "";
    }else{
      document.getElementById('lihat').innerHTML =
      "<hr>"+
      "<div class='form-group'>"+
        "<div class='form-group'>"+
          "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Configuration</label>"+
          "<div class='col-md-9 col-sm-10 col-xs-12'>"+
            '<select name="data_eksis" class="form-control" id="eksis" >'+
              '<option value="" readonly selected>-->Select One<--</option>'+
              kemaseksis+
            '</select>'+
          "</div>"+
        "</div>"+"<div class='form-group'>"+
        "<hr>"+
      "</div>"
    }
  }
</script>

<script type="text/javascript">
  $('.items').select2({
    placeholder: '-->Select One<--',
    allowClear: true
  });

  $(document).ready(function(){

      // Get Pangan
      $('#bpom').on('change', function(){
          var myId = $(this).val();
            if(myId){
              $.ajax({
              url: '{{URL::to('getpangan')}}/'+myId,
              type: "GET",
              dataType: "json",
              beforeSend: function(){
                  $('#loader').css("visibility", "visible");
              },

              success:function(data){
                console.log(data)
                  $('#katbpom').empty();
                  $.each(data, function(key, value){
                      $('#katbpom').append('<option value="'+ key +'">' + value + '</option>');
                  });
              console.log(data)
              },
              complete: function(){
                  $('#loader').css("visibility","hidden");
              }
          });

          }
          else{
              $('#katbpom').empty();
          }
      });

      $('#katbpom').on('change', function(){
          var myId = $(this).val();
            if(myId){
              $.ajax({
              url: '{{URL::to('getkatpangan')}}/'+myId,
              type: "GET",
              dataType: "json",
              beforeSend: function(){
                  $('#loader').css("visibility", "visible");
              },

              success:function(data){
                console.log(data)
                  $('#bpom').empty();
                  $.each(data, function(key, value){
                      $('#bpom').append('<option value="'+ key +'">' + value + '</option>');
                  });
              console.log(data)
              },
              complete: function(){
                  $('#loader').css("visibility","hidden");
              }
          });

          }
          else{
              $('#bpom').empty();
          }
      });

      // get Olahan
      $('#bpom').on('change', function(){
          var myId = $(this).val();
            if(myId){
              $.ajax({
              url: '{{URL::to('getolahan')}}/'+myId,
              type: "GET",
              dataType: "json",
              beforeSend: function(){
                  $('#loader').css("visibility", "visible");
              },

              success:function(data){
                console.log(data)
                  $('#olahan').empty();
                  $.each(data, function(key, value){
                      $('#olahan').append('<option value="'+ key +'">' + value + '</option>');
                  });
              console.log(data)
              },
              complete: function(){
                  $('#loader').css("visibility","hidden");
              }
          });

          }
          else{
              $('#katbpom').empty();
          }
      });
  });


  function template(){
    var template = document.getElementById('radio_temp')

    if(template.checked != true){
      document.getElementById('tampilkan').innerHTML = "";
    }else{

      document.getElementById('tampilkan').innerHTML =
      "<hr>"+
            "<div class='form-group row'>"+
            "  <label class='control-label col-md-2 col-sm-3 col-xs-12'>Launch</label>"+
            "  <div class='col-md-4 col-sm-9 col-xs-12'>"+
            "    <select class='form-control form-control-line' name='launch'>"+
            "      <option disabled='' selected=''>-- Launch Deadline --</option>"+
            "      <option>Q1</option>"+
            "      <option>Q2</option>"+
            "      <option>Q3</option>"+
            "      <option>Q4</option>"+
            "      <option>S1</option>"+
            "      <option>S2</option>"+
            "    </select>"+
            "  </div>"+
            "  <div class='col-md-4 col-sm-9 col-xs-12'>"+
            "    <input type='number' placeholder='Years' name='tahun' id='tahun' class='form-control col-md-12 col-xs-12'>"+
            "  </div>"+
            "</div>"+
          "<div class='ln_solid'></div>"
    }
  }

  function kalender(){
    var baru = document.getElementById('radio_cal')

    if(baru.checked != true){
      document.getElementById('tampilkan').innerHTML = "";
    }else{

      document.getElementById('tampilkan').innerHTML =
      "<hr>"+
            "<div class='form-group row'>"+
            "  <label class='control-label col-md-2 col-sm-3 col-xs-12'>Launch</label>"+
            "  <div class='col-md-9 col-sm-12 col-xs-12'>"+
            "    <input type='date' name='tanggal' id='tanggal' class='form-control col-md-12 col-xs-12'>"+
            "  </div>"+
            "</div>"+
          "<div class='ln_solid'></div>"
    }
  }
</script>

<script>
  $(document).ready(function() {
    // delete baris proses
    $('#tabledata').on('click', 'tr a', function(e) {
  e.preventDefault();
      $(this).parents('tr').remove();
  });

  var i = 1;
  $("#add_data").click(function() {
    $('#addrow' + i).html( "<td><input type='number' name='forecast[]' class='form-control items'></td><td><select name='satuan[]'  class='form-control items'>"+
    "<option disabled selected>--> Select One <--</option>"+
    "<option value='1 Bulan Pertama'>1 Bulan Pertama</option>"+
    "<option value='2 Bulan Pertama'>2 Bulan Pertama</option>"+
    "<option value='3 Bulan Pertama'>3 Bulan Pertama</option>"+
    "</select></td><td><a hreaf='' class='btn btn-danger'><li class='fa fa-trash'></li> Delete</a></td>");

    $('#tabledata').append('<tr id="addrow' + (i + 1) + '"></tr>');
    i++;
  });
  });
</script>

<script src="{{ asset('js/asrul.js') }}"></script>
@endsection