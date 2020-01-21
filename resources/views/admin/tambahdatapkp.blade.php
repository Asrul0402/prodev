@extends('admin.tempadmin')

@section('title', 'Approved User')

@section('judulhalaman','User Management')

@section('content')

<div class="">
  <form class="form-horizontal form-label-left" method="POST" action="{{ route('datapdf') }}" novalidate>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4><li class="fa fa-plus"> Tambah Data Form PKP & PDF</h4>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-4 col-sm-4 col-xs-12"> </label>&nbsp 
       			<input type="radio" name="data" oninput="ada()" id="radio_ada"> Buat Data Jenis Baru &nbsp &nbsp &nbsp 
       			<input type="radio" name="data" oninput="baru()" id="radio_baru"> Tambah Data Jenis
					</div>
          <div id="jenis"></div>
            <center><button type="submit" class="btn btn-primary">Submit</button></center>
              {{ csrf_field() }}
          </div>
				</div>
        <select name="" class="form-control" id=""></select>
        <div id="cobainaja"></div>
			</div>
		</div>
	</div>
</div>  
	
@endsection
@section('s')	

<script src="{{asset('/js/jquery.cookie.js')}}" charset="utf-8"></script>
<script>
  var jenis = []
		<?php foreach($jenis as $key => $value) { ?>
			if(!jenis){
				jenis += [
					{
						'<?php echo $key; ?>' : '<?php echo $value->nama; ?>',
					}
				];
			} else {
				jenis.push({
					'<?php echo $key; ?>' : '<?php echo $value->nama; ?>',
				})
			}
		<?php } ?>
  var pilihan = [];
  
	for(var i = 0; i < Object.keys(jenis).length; i++){
		pilihan += '<option value="'+jenis[i][i]+'">'+jenis[i][i]+'</option>';
  }
  console.log(pilihan)
  document.getElementById('coo').innerHTML = "aku adalah programer web dan android :) asrul42";

  function baru(){
    var baru = document.getElementById('radio_baru')

    if(baru.checked != true){
      document.getElementById('jenis').innerHTML = "";
    }else{
      document.getElementById('jenis').innerHTML =
      "<div class='form-group'>"+
        "<div class='col-md-9 col-sm-9 col-xs-12'>"+
          "<select name='' class='form-control' id='cobaduluaja'></select>"+
        "</div>"+
        "<div id='coo'></div>"+
      "</div>"+
      "<div class='form-group'>&nbsp &nbsp"+
   	    "<input type='radio' name='data' oninput='barukat()' id='radio_barukat'> Buat Data Kategori Baru &nbsp &nbsp &nbsp "+
  	    "<input type='radio' name='data' oninput='adakat()' id='radio_adakat'> Data Kategori"+
	    "</div>"+
      "<div id='kategori'></div>"+
      "<div class='ln_solid'></div>"
    }
  }

  function barukat(){
    var barukat = document.getElementById('radio_barukat')

    if(barukat.checked != true){
      document.getElementById('ketegori').innerHTML = "";
    }else{
      document.getElementById('kategori').innerHTML =
      "<div class='form-group'>"+
        "<div class='col-md-9 col-sm-9 col-xs-12'>"+
          "<input required placeholder='Masukan data Kategori' id='prefered' class='form-control col-md-12 col-xs-12' type='text' name='prefered'>"+
        "</div>"+
      "</div>"+
      "<div class='form-group'>&nbsp &nbsp "+
        "<input type='radio' name='data' oninput='barusub()' id='radio_barusub'> Buat Data SubKategori Baru &nbsp &nbsp &nbsp "+
	    "</div>"+
      "<div id='sub'></div>"+
      "<hr>"+
      "<div class='ln_solid'></div>"
    }
  }

  function barusub(){
    var barusub = document.getElementById('radio_barusub')

    if(barusub.checked != true){
      document.getElementById('sub').innerHTML = "";
    }else{
      document.getElementById('sub').innerHTML =
      "<div id='kids'>"+
        "<input type='text' placeholder='Masukan data SubKategori' class='form-control col-md-8 col-sm-12 col-xs-12' name='child_1'> &nbsp"+
        "<button type='button' class='btn-sm btn-info fa fa-plus' id='add_kid()_1' onclick='addkid()' />"+
      "</div>	"+
      "<div class='ln_solid'></div>"
    }
  }

  function ada(){
    var ada = document.getElementById('radio_ada')

    if(ada.checked != true){
      document.getElementById('jenis').innerHTML = "";
    }else{
      document.getElementById('jenis').innerHTML =
      "<div class='form-group'>"+
        "<div class='col-md-9 col-sm-9 col-xs-12'>"+
          "<select name='form' id='form' class='form-control'>"+
            "<option disabled='' selected=''>form</option>"+
            "<option value='pkp'>pkp</option>"+
            "<option value='pdf'>pdf</option>"+
          "</select>"+
        "</div>"+
      "</div>"+
      "<div class='form-group'>"+
        "<div class='col-md-9 col-sm-9 col-xs-12'>"+
          "<input id='ingredient' placeholder='Masukan Data Jenis' required='required' class='form-control col-md-12 col-xs-12' placeholder='' type='text' name='ingredient'>"+
        "</div>"+
      "</div>"+
      "<div class='form-group'>"+
        "<div class='col-md-9 col-sm-9 col-xs-12'>"+
          "<input id='ingredient' placeholder='Masukan Data Kategori' required='required' class='form-control col-md-12 col-xs-12' type='text' name='ingredient'>"+
        "</div>"+
      "</div>"+
      "<div class='form-group'>"+
        "&nbsp &nbsp <input type='radio' name='data' oninput='barusub()' id='radio_barusub'> Buat Data SubKategori Baru "+
      "</div>"+
      "<div id='sub'></div>"+
      "<div class='ln_solid'></div>"
    }
  }

  function adakat(){
    var adakat = document.getElementById('radio_adakat')

    if(adakat.checked != true){
      document.getElementById('ketegori').innerHTML = "";
    }else{
      document.getElementById('kategori').innerHTML =
      "<div class='form-group'>"+
        "<div class='col-md-9 col-sm-9 col-xs-12'>"+
          "<select name='form' id='form' class='form-control'>"+
            "<option disabled='' selected=''>form</option>"+
            "<option value='pkp'>pkp</option>"+
            "<option value='pdf'>pdf</option>"+
          "</select>"+
        "</div>"+
      "</div>"+
      "<div class='form-group'>&nbsp &nbsp "+
        "<input type='radio' name='data' oninput='barusub()' id='radio_barusub'> Buat Data SubKategori Baru &nbsp &nbsp &nbsp "+
	    "</div>"+
	    "<div id='sub'></div>"+
      "<hr>"+
      "<div class='ln_solid'></div>"
    }
  }

  var index = [];
  index.push(0);
  index.push(1)

  function addkid() {
  
    var div = document.createElement('div');
    var id = getID();
    div.setAttribute("id","Div_"+id);
    div.innerHTML = '<br><input placeholder="Masukan data SubKategori" class="form-control col-md-8 col-xs-12" type="text" name="child_' + id + '"/> &nbsp'  + ' <button type="submit" class="btn-sm btn-info fa fa-trash-o" id="rem_kid()_' + id + '" onclick="remkid('+id+')" />';
    document.getElementById('kids').appendChild(div);
  }
   
  function remkid(id) {
    try{
      var element = document.getElementById("Div_"+id)
      element.parentNode.removeChild(element);
      index[id] = -1;
    } 
    catch(err){
      alert("id: Div_"+id)
      alert(err)
    }
  }  

  function getID(){
    var emptyIndex = index.indexOf(-1);
    if (emptyIndex != -1){
      index[emptyIndex] = emptyIndex
      return emptyIndex
    } else {
      emptyIndex = index.length
      index.push(emptyIndex)
      return emptyIndex
    }
  }

</script>

@endsection