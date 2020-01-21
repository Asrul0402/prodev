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

@foreach($pkpdata as $pkp)
@if($pkp->datapkpp->status_project=='draf')
<form class="form-horizontal form-label-left" method="POST" action="{{ route('updatetipp',['id_project' => $pkp->id_pkp, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" novalidate>
@else
<form class="form-horizontal form-label-left" method="POST" action="{{ route('updatetipp2',['id_project' => $pkp->id_pkp, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" novalidate>
@endif
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
            <input type="hidden" value="{{ $pkp->revisi }}" name="revisi">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Idea</label>
            <div class="col-md-9 col-sm-10 col-xs-12">
              <input type="text" value="{{ $pkp->idea }}"  name="idea" id="idea" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Target Market</label>
            <label class="control-label col-md-1 col-sm-3 col-xs-12" for="last-name">Gender:</label>
            <div class="col-md-8 col-sm-3 col-xs-12">
              <select id="gender"  name="gender" class="form-control" >
                <option readonly view="{{ $pkp->gender }}">{{ $pkp->gender }}</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="male and female">Male & Female</option>
              </select>
            </div><br><br><br>
            <div class="form-group row">
              <label for="middle-name" class="control-label col-md-1 col-sm-3 col-xs-12"></label>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
              <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> &nbsp  &nbsp Age Range form : </label>
              <div class="col-md-2 col-sm-3 col-xs-12">
                <input type="number"  value="{{ $pkp->dariumur }}" name="dariumur" id="dariumur" class="form-control col-md-12 col-xs-12">
              </div>
              <div class="col-md-1 col-sm-3 col-xs-12 text-center"> To </div>
              <div class="col-md-2 col-sm-3 col-xs-12">
                <input type="number" name="sampaiumur" value="{{ $pkp->sampaiumur }}" id="sampaiumur" class="form-control col-md-12 col-xs-12">
              </div>
              <label for="middle-name" class="control-label col-md-1 col-sm-2 col-xs-12">SES : </label>
              <div class="col-md-2 col-sm-6 col-xs-12">
                <select class="form-control form-control-line filter" name="ses[]"   multiple="multiple">
                  @foreach($datases as $ses1)
                  <option value="{{$ses1->ses}}" selected>{{$ses1->ses}}</option>
                  @endforeach
                  @foreach($ses as $s)
                  <option value="{{$s->ses}}">{{$s->ses}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-3 col-xs-12">Uniqueness of Idea </label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <select class="form-control form-control-line" name="uniq_idea" >
                <option readonly view="{{ $pkp->Uniqueness }}">{{ $pkp->Uniqueness }}</option>
                @foreach($ide as $ide)
                <option value="{{ $ide->uniqueness_of_idea }}">{{ $ide->uniqueness_of_idea }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Estimated</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <select class="form-control form-control-line" name="estimated" >
                <option readonly view="{{ $pkp->Estimated }}">{{ $pkp->Estimated }}</option>
                @foreach($mar as $mar)
                <option value="{{ $mar->estimasi_market }}">{{ $mar->estimasi_market }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">reason</label>
            <div class="col-md-9 col-sm-10 col-xs-12">
              <input id="reason" class="form-control " value="{{ $pkp->reason }}" type="text" name="reason" >
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
            @if($pkp->launch!=NULL)
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Launch Deadline</label>
            <div class="col-md-2 col-sm-9 col-xs-12">
              <select class="form-control form-control-line" name="launch">
                <option readonly view="{{ $pkp->launch }}">{{ $pkp->launch }}</option>
                <option>Q1</option>
                <option>Q2</option>
                <option>Q3</option>
                <option>Q4</option>
                <option>S1</option>
                <option>S2</option>
              </select>
            </div>
            <div class="col-md-3 col-sm-9 col-xs-12">
              <input type="number" title="years" placeholder="Years" value="{{ $pkp->years }}" name="tahun" id="tahun" class="form-control col-md-12 col-xs-12">
            </div>
            <div class="col-md-3 col-sm-9 col-xs-12">
              <a href="{{route('hapuslaunch',['id_pkp' => $pkp->id_pkp, 'turunan' => $pkp->turunan])}}" class="btn btn-danger"><li class="fa fa-trash"></li></a>  
            </div>
            @elseif($pkp->tgl_launch!=NULL)
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Launch Deadline</label>
            <div class="col-md-9 col-sm-12 col-xs-12">
              <input type="date"  name="tanggal" value="{{ $pkp->tgl_launch }}" id="tanggal" class="form-control col-md-12 col-xs-12">
            </div>
            @elseif($pkp->launch==NULL && $pkp->tgl_launch==NULL)
            <div class="form-group row">
              <label class="control-label col-md-2 col-sm-3 col-xs-12">Launch </label> &nbsp
      		    <input type="radio" name="data" oninput="template()" id="radio_temp"> Launch periode  &nbsp &nbsp
     			    <input type="radio" name="data" oninput="kalender()" id="radio_cal"> Launch date &nbsp &nbsp
            </div>
            <div id="tampilkan"></div>
            @endif
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Aisle Placement</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" value="{{ $pkp->aisle }}" placeholder="Aisle Placement"  name="aisle" id="aisle" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Comperitor</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <input type="text" value="{{ $pkp->competitor }}" placeholder="Comperitor"  name="competitor" id="" class="form-control col-md-12 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12">Competitive</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <input type="text" value="{{ $pkp->competitive }}"  name="competitive" placeholder="Competitive Advantage" id="analysis" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-2 col-sm-9 col-xs-12" >
              <label class="control-label col-md-12 col-sm-3 col-xs-12">Sales Forecast</label> 
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <table class="table table-bordered table-hover" id="tabledata">
        				<tbody>
                  @foreach($for as $for)
        				  <tr id='addrow0'>
                    <td><input type="number"  value="{{$for->forecast}}" name="forecast[]" class="form-control"></td>
                    <td>
                      <select name="satuan[]"  id="detail1" class="form-control">
                        <option readonly value="{{$for->satuan}}">{{$for->satuan}}</option>
                        <option value="1 Bulan Pertama">1 Bulan Pertama</option>
                        <option value="2 Bulan Pertama">2 Bulan Pertama</option>
                        <option value="3 Bulan Pertama">3 Bulan Pertama</option>
                      </select>
                    </td>
                    <td>
                      <a href="" type="button" class="btn btn-danger btn-sm"><li class="fa fa-trash"></li> Delete</a>
                      <button class="btn btn-info btn-sm pull-left add_data" type="button"><li class="fa fa-plus"></li> Add Forecast</button>
                    </td>
                  </tr>
                  @endforeach
                  @if($for2=='0')
                  <tr>
                    <td><input type="number" name="forecast[]" width="500px" class="form-control"></td>
                    <td>
                      <select name="satuan[]" class="form-control items">
                        <option value="1 Bulan Pertama">1 Bulan Pertama</option>
                        <option value="2 Bulan Pertama">2 Bulan Pertama</option>
                        <option value="3 Bulan Pertama">3 Bulan Pertama</option>
                      </select>
                    </td>
                    <td>
                      <button class="btn btn-info btn-sm pull-left add_data" type="button"><li class="fa fa-plus"></li> Add Forecast</button>
                      <a href="" type="button" class="btn btn-danger btn-sm"><li class="fa fa-trash"></li> Delete</a>
                    </td>
                  </tr>
        					<tr id='addrow1'></tr>
                  @endif
        				</tbody>
      				</table>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Selling Price (Before PPN)</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <input type="number" value="{{ $pkp->selling_price }}"  name="Selling_price" id="Selling_price" class="form-control col-md-12 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12 ">uom</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <select class="form-control form-control-line filter" name="uom" >
                <option value="{{$pkp->UOM}}">{{$pkp->Duom->primary_uom}}</option>
                @foreach ($uom as $uomm)
                <option value="{{ $uomm->id }}">{{$uomm->primary_uom}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Consumer Price</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <input type="text" value="{{ $pkp->price }}"  name="analysis" placeholder="Consumer Price" id="analysis" class="form-control col-md-12 col-xs-12">
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
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Product Form</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <select  id="product" name="product" class="form-control" >
                <option readonly value="{{ $pkp->product_form }}">{{ $pkp->product_form }}</option>
                <option value="powder">Powder</option>
                <option value="solid">Solid</option>
                <option value="paste">Paste</option>
                <option value="liquid">Liquid</option>
              </select>
            </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12">AKG</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <select name="akg"  id="akg" class="form-control">
                @if($pkp->akg!=NULL)
                <option value="{{$pkp->tarkon->id_tarkon}}" readonly>{{$pkp->tarkon->tarkon}}</option>
                @endif
                @foreach($tarkon as $tr)
                <option value="{{ $tr->id_tarkon}}">{{$tr->tarkon}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">No category BPOM</label>
            <div class="col-md-2 col-sm-9 col-xs-12">
              <select class="form-control"  id="bpom" name="bpom">
                @if($pkp->bpom!=NULL)
                <option value="{{$pkp->bpom}}">{{$pkp->katpangan->no_kategori}}</option>
                @endif
                @foreach($pangan as $dp)
                <option value="{{ $dp->id_pangan }}">{{ $dp->no_kategori }}</option>
                @endforeach
              </select>
            </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12">category</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
              <select name="katbpom"  id="katbpom" class="form-control">
                @if($pkp->kategori_bpom!=NULL)
                <option value="{{$pkp->kategori_bpom}}">{{$pkp->kategori->kategori}}</option>
                @endif
                @foreach($pangan as $kat)
                <option value="{{$kat->id_pangan}}">{{$kat->kategori}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3 col-sm-9 col-xs-12">
              <select name="olahan"  id="olahan" class="form-control">
                @if($pkp->olahan!=NULL)
                <option value="{{$pkp->olahan}}">{{$pkp->panganolahan->pangan_olahan	}}</option>
                @elseif($pkp->olahan==NULL)
                <option value=""></option>
                @endif
              </select>
            </div>
          </div>
          <div class="form-group row">
            <input type="hidden" value="{{$eksis+1}}" name="kemas" id="kemas">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Configuration</label>
            @if($pkp->kemas_eksis!=NULL)
            <div class="col-md-7 col-sm-3 col-xs-12">
              <select name="data_eksis" id="data_eksis" class="form-control">
                <option value="{{$pkp->kemas_eksis}}" readonly>
                (
                @if($pkp->kemas->primer!=NULL)
							  {{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }} </tr>
								@elseif($pkp->kemas->primer==NULL)
							  @endif

								@if($pkp->kemas->sekunder1!=NULL)
							  X {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}} </tr>
							  @elseif($pkp->kemas->sekunder1==NULL)
							  @endif

								@if($pkp->kemas->sekunder2!=NULL)
							  X {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }} </tr>
							  @elseif($pkp->sekunder2==NULL)
							  @endif

							  @if($pkp->kemas->tersier!=NULL)
								X {{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }} </tr>
							  @elseif($pkp->tersier==NULL)
							  @endif
                )
                </option>
              </select>
            </div>
       		  <a type="buton" href="{{ Route('konfigurasi',['id_pkp' => $pkp->id_pkp, 'turunan' => $pkp->turunan])}}" class="fa fa-trash btn btn-danger btn-lg" title="Remove the configuration and create a new configuration"></a>
          </div>
          @elseif($pkp->kemas_eksis==NULL)
          <input type="hidden" value="{{$eksis+1}}" name="kemas" id="kemas">&nbsp
          <input type="radio" name="data" oninput="baru()" id="radio_baru"> New Configuration  &nbsp &nbsp
    	    <input type="radio" name="data" oninput="eksis()" id="radio_eksis"> Configuration exists &nbsp &nbsp
   		    <input type="radio" name="data" oninput="pilih()" id="radio_project"> Previous Project Configuration  &nbsp &nbsp
        </div>
        @endif
        @if($pkp->primery!=NULL)
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Primary information :</label>
        <div class="col-md-8 col-sm-3 col-xs-12">
          <input readonly name="primary" class="col-md-8 col-sm-3 col-xs-12 form-control" id="" value="{{$pkp->primery}}"></textarea>
        </div><br><br>
        @elseif($pkp->secondary!=NULL)
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Secondary information:</label>
        <div class="col-md-8 col-sm-3 col-xs-12">
          <input readonly name="secondary" class="col-md-8 col-sm-3 col-xs-12 form-control" id="" value="{{$pkp->secondary}}"></textarea>
        </div><br><br>
        @elseif($pkp->tertiary!=NULL)
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Tertiary information:</label>
        <div class="col-md-8 col-sm-3 col-xs-12">
          <input readonly name="tertiary" class="col-md-8 col-sm-3 col-xs-12 form-control" id="" value="{{$pkp->tertiary}}"></textarea>
        </div><br><br>
        @endif
      </div>
      <div id="lihat"></div>
      <div class="form-group">
        <label class="control-label col-md-2 col-sm-3 col-xs-12">prefered flavour</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input  id="prefered" value="{{ $pkp->prefered_flavour }}" class="form-control col-md-12 col-xs-12" type="text" name="prefered">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-2 col-sm-3 col-xs-12">Product Benefits</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input  id="benefits" value="{{ $pkp->product_benefits }}" class="form-control col-md-12 col-xs-12" type="text" name="benefits">
        </div>
      </div>
      <div class="form-group">
        <label  class="control-label col-md-2 col-sm-3 col-xs-12">Mandatory Ingredient</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input id="ingredient" value="{{ $pkp->mandatory_ingredient }}"  class="form-control col-md-12 col-xs-12" placeholder="" type="text" name="ingredient">
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-2 col-sm-9 col-xs-12 text-center"></div>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <table class="table table-bordered table-hover" id="table">
        		<thead>
        		  <tr>
        				<th class="text-center" width="30%">Komponen</th>
      			    <th class="text-center">Klaim</th>
                <th class="text-center">Detail</th>
                <th class="text-center" width="20%">Note</th>
      			    <th class="text-center">Action</th>
      				</tr>
        		</thead>
        		<tbody>
              <tr class="tr_clone">
              @foreach($dataklaim as $dk)
      	  		  <td>
                  <select class="form-control items komponen"   name="komponen[]">
                    <option value="{{$dk->id_komponen}}">{{$dk->datakp->komponen}}</option>
                    @foreach($komponen as $kp)
                    <option value="{{ $kp->id }}">{{ $kp->komponen }}</option>
                    @endforeach
                  </select>
                </td>
                <td>
                  <select name="klaim[]" class="form-control items">
                    <option value="{{$dk->id_klaim}}">{{$dk->datakl->klaim}}</option>
                    <option readonly>--> Select One <--</option>
                  </select>
                </td>
                <td>
                  <select name="detail[]"  multiple="multiple" class="form-control items">
                    @foreach($datadetail as $dd)
                    <option readonly selected value="{{$dd->id_detail}}">{{$dd->datadl->detail}}</option>
                    @endforeach
                  </select>
                </td>
                <td><textarea type="text" class="form-control" name="ket[]" value="{{$dk->note}}" id="ket">{{$dk->note}}</textarea></td>
        				<td><a href="" class="btn btn-danger btn-sm"><li class="fa fa-trash"></li></a>
                <button class="tr_clone_add btn btn-info btn-sm" type="button"><li class="fa fa-plus"></li></button>
              </tr>
              @endforeach
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
                  <select name="klaim[]" class="form-control items" id="klaimm"> </select>
                </td>
                <td>
                  <select name="detail[]"  id="detaill" multiple="multiple" class="form-control items"> </select>
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
</form>
@endforeach

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
     " <div class='form-group'>"+
          "<div class='form-group'>"+
            "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Configuration</label>"+
            "<div class='col-md-9 col-sm-10 col-xs-12'>"+
            '<select name="data_eksis" class="form-control" id="txtOccupation" >'+
            '<option value="" readonly selected>-->Select One<--</option>'+pilihan+'</select>'+
            "</div>"+
          "</div>"+"<div class='form-group'>"+
            "<hr>"
    }
  }

  function eksis(){
    var eksis = document.getElementById('radio_eksis')

    if(eksis.checked != true){
      document.getElementById('lihat').innerHTML = "";
    }else{

      document.getElementById('lihat').innerHTML =
      "<hr>"+
     " <div class='form-group'>"+
          "<div class='form-group'>"+
            "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Configuration</label>"+
            "<div class='col-md-9 col-sm-10 col-xs-12'>"+
            '<select name="data_eksis" class="form-control" id="eksis" >'+
            '<option value="" readonly selected>-->Select One<--</option>'+
            kemaseksis+
            '</select>'+
            "</div>"+
          "</div>"+"<div class='form-group'>"+
            "<hr>"
    }
  }

  function baru(){
    var baru = document.getElementById('radio_baru')

    if(baru.checked != true){
      document.getElementById('lihat').innerHTML = "";
    }else{

      document.getElementById('lihat').innerHTML =
      "<hr>"+
     " <div class='form-group'>"+
            "<label class='control-label col-md-2 col-sm-2 col-xs-12'>Konfigurasi</label>&nbsp  &nbsp"+
       			"<input type='radio' name='gramasi' oninput='dua()' id='radio_dua'> 2 Dimensi &nbsp"+
       			"<input type='radio' name='gramasi' oninput='tiga()' id='radio_tiga'> 3 Dimensi &nbsp"+
       			"<input type='radio' name='gramasi' oninput='empat()' id='radio_empat'> 4 Dimensi &nbsp"+
						"<div id='tampil'></div>"+
					"</div>"+
          "<hr>"+
            "<h4><b><lable class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Keterangan</lable></b></h4>"+
            "<br><br>"+
          "<div class='form-group'>"+
            "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Primary information</label>"+
            "<div class='col-md-9 col-sm-10 col-xs-12'>"+
              "<textarea name='primary' id='primary' class='col-md-12 col-sm-12 col-xs-12'></textarea>"+
            "</div>"+
          "</div>"+
          "<div class='form-group'>"+
            "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='last-name'>Secondary information</label>"+
            "<div class='col-md-9 col-sm-10 col-xs-12'>"+
              "<textarea name='secondary' id='secondary' class='col-md-12 col-sm-12 col-xs-12'></textarea>"+
            "</div>"+
         " </div>"+
         " <div class='form-group'>"+
            "<label for='middle-name' class='control-label col-md-2 col-sm-3 col-xs-12'>Tertiary information </label>"+
            "<div class='col-md-9 col-sm-10 col-xs-12'>"+
              "<textarea name='tertiary' id='tertiary' class='col-md-12 col-sm-12 col-xs-12'></textarea>"+
            "</div>"+
          "</div>"+
          "<div class='ln_solid'></div>"+
          "<hr>"
    }
  }

  function dua(){
    var dua = document.getElementById('radio_dua');

    if(dua.checked != true){
      document.getElementById('tampil').innerHTML = "";
    }else{

      document.getElementById('tampil').innerHTML = "<br><div class='panel panel-default'>"+
	      "<div class='panel-heading'><h5>Konfigurasi Kemas</h5></div>"+
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
	      "<div class='panel-heading'><h5>Konfigurasi Kemas</h5></div>"+
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
	      "<div class='panel-heading'><h5>Konfigurasi Kemas</h5></div>"+
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
</script>

<script type="text/javascript">
  $('select').select2({
    placeholder: '-->Select One<--',
    allowClear: true
  });

  $(document).ready(function(){
    $('#bpom').select2();
    $('#olahan').select2();
    $('#katbpom').select2();
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

  $(".js-example-tokenizer").select2({
    tags: true,
    tokenSeparators: [',', ' ']
  })

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

  var i = 1;
  $(".add_data").click(function() {
    $('#addrow' + i).html( "<td><input type='number' name='forecast[]' class='form-control'></td><td><select name='satuan[]'  class='form-control'>"+
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
