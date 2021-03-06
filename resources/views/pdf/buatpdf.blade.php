@extends('pv.tempvv')
@section('title', 'Request PDF')
@section('judulhalaman','Form PDF')
@section('content')

@include('formerrors')
<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-8">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href="" ><span class="nmbr">1</span>Information</a></li>
        <li class="completed"><a href=""><span class="nmbr">2</span>PDF</a></li>
        <li class="active"><a href=""><span class="nmbr">3</span>File & Image</a></li>
      </ul>
    </div>
  </div>
</div><br>

<div class="">
  <form class="form-horizontal form-label-left" method="POST" action="{{ route('pos') }}" novalidate>
	<div class="row">
    <div class="col-sm-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-edit"></li> Packaging concept**</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <input type="hidden" value="{{ $id_pdf->id_project_pdf }}" name="id">
            <input type="hidden" value="{{$eksis+1}}" name="kemas" id="kemas">
            <label class="control-label col-md-3 col-sm-2 col-xs-12"></label>
            <input type="radio" name="data" oninput="baru()" id="radio_baru"> New Configuration  &nbsp &nbsp
       			<input type="radio" name="data" oninput="eksis()" id="radio_eksis"> Configuration exists &nbsp &nbsp
       			<input type="radio" name="data" oninput="pilih()" id="radio_project"> Previous Project Configuration  &nbsp &nbsp
          </div>
        <hr>
        <div id="lihat"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-file"></li> Project</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Age Range**</label>
            <div class="col-md-2 col-sm-3 col-xs-12">
              <input  type="number" required  name="dariumur" id="dariumur" class="form-control col-md-12 col-xs-12">
            </div>
            <div class="col-md-1 col-sm-3 col-xs-12">
              <center>To</center>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12">
              <input  type="number" required name="sampaiumur" id="sampaiumur" class="form-control col-md-12 col-xs-12">
            </div>
            <label for="middle-name" class="control-label col-md-1 col-sm-2 col-xs-12">SES : </label>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <select class="form-control form-control-line" id="select" name="ses[]"   multiple="multiple">
                <option value="U1">U1</option>
                <option value="U2">U2</option>
                <option value="SU">SU</option>
                <option value="M1">M1</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Gender</label>
            <div class="col-md-4 col-sm-10 col-xs-12">
              <select  class="form-control form-control-line" name="gender" >
                <option disabled="" selected="">-- Select One --</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Male & Female">Male & Female</option>
              </select>
            </div>
            <label class="control-label col-md-1 col-sm-2 col-xs-12">Other**</label>
            <div class="col-md-4 col-sm-10 col-xs-12">
              <input  id="other" required class="form-control col-md-12 col-xs-12" type="text" name="other">
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-edit"></li> Product Concept</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Weight**</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
              <input required id="weight" class="form-control col-md-12 col-xs-12" type="number" name="weight">
            </div>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <select required class="form-control form-control-line" name="serving" >
                <option disabled="" selected="">-- Select--</option>
                <option value="gram">Gram</option>
                <option value="ml">ML</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Target price**</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <input required id="target_price" class="form-control col-md-12 col-xs-12" type="text" name="target_price">
            </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12">Claim**</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <input required id="claim" class="form-control col-md-12 col-xs-12" placeholder="Claim/Function" type="text" name="claim">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Ingredient**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="ingredient" class="form-control col-md-12 col-xs-12" placeholder="Special Ingredient" type="text" name="ingredient">
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
  </div> 

  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-folder-open"></li> Data</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Background**</label>
          	<div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="background" placeholder="Backgroung / Insight" class="form-control col-md-12 col-xs-12" type="text" name="background">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Attractiveness**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="attractive" class="form-control col-md-12 col-xs-12" type="text" name="attractive">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Target RTO**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="rto" class="form-control col-md-12 col-xs-12" type="date" name="rto">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-2 col-sm-9 col-xs-12" >
              <label class="control-label col-md-12 col-sm-3 col-xs-12">Sales Forecast</label> 
            </div>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <table class="table table-bordered table-hover" id="tableklaim">
        					<tbody>
        					  <tr id='addr0'>
                      <td><input type="number" name="forecast[]" class="form-control">
                      </td>
                      <td>
                        <select name="satuan[]"  id="detail1" class="form-control">
                          <option disabled selected>--> Select One <--</option>
                          <option value="1 Bulan Pertama">1 Bulan Pertama</option>
                          <option value="2 Bulan Pertama">2 Bulan Pertama</option>
                          <option value="3 Bulan Pertama">3 Bulan Pertama</option>
                        </select>
                      </td>
                      <td>
                        <button id="add_data" type="button" class="btn btn-info btn-sm pull-left"><li class="fa fa-plus"></li> Add Forecast</button>
                      </td>
                    </tr>
        						<tr id='addr1'></tr>
        					</tbody>
      					</table>
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
	</div>

  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-group"></li> Competitors</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Name**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="name_competitors" class="form-control col-md-12 col-xs-12" type="text" name="name_competitors">
            </div>
					</div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Retailer Price**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="retailer_price" class="form-control col-md-12 col-xs-12" type="number" name="retailer_price">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">What's Special**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="special" class="form-control col-md-12 col-xs-12" placeholder="Special Ingredient" type="text" name="special">
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="col-md-6 col-md-offset-5">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            {{ csrf_field() }}
          </div>
        </div>
			</div>
		</div>
	</div>				
  </form>
</div>

<script>
  $(document).ready(function() {
    // delete baris proses
    $('#tableklaim').on('click', 'tr a', function(e) {
      e.preventDefault();
      $(this).parents('tr').remove();
  });

  var i = 1;
    $("#add_data").click(function() {
      $('#addr' + i).html( "<td><input type='number' name='forecast[]' class='form-control'></td><td><select name='satuan[]'  class='form-control'>"+
      "<option disabled selected>--> Select One <--</option>"+
      "<option value='1 Bulan Pertama'>1 Bulan Pertama</option>"+
      "<option value='2 Bulan Pertama'>2 Bulan Pertama</option>"+
      "<option value='3 Bulan Pertama'>3 Bulan Pertama</option>"+
      "</select></td><td><a hreaf='' class='btn btn-danger'><li class='fa fa-trash'></li> Delete</a></td>");

      $('#tableklaim').append('<tr id="addr' + (i + 1) + '"></tr>');
      i++;
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

<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
  $('#select').select2({
    placeholder: '-->Select One<--',
    allowClear: true
  });
</script>
@endsection