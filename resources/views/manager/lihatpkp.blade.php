@extends('manager.tempmanager')
@section('title', 'data PKP')
@section('judul', 'Data PKP')
@section('content')

@if (session('status'))
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-success" style="margin:20px">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('status') }}
    </div>
  </div>
</div>  
@endif

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="row" style="margin:20px">
        <div id="exTab2" class="container">	
					<div class="col-md-11" align="right">
            @foreach($pkpp as $pkp)
            @if($pkp->status_project=='sent' || $pkp->status_project=='proses')
              @if(Auth::user()->departement->dept!='RKA')
                @if($pkp->status_terima=='terima')
                <button class="btn btn-primary" data-toggle="modal" data-target="#kirim{{ $pkp->id_project  }}"><i class="fa fa-paper-plane"></i> Sent</a></button>
                  @if($pengajuan==0)
                    <button class="btn btn-success" data-toggle="modal" data-target="#ajukan{{ $pkp->id_project  }}"><i class="fa fa-comments-o"></i> Sent Revision request</a></button>
                  @endif
                @endif
              @elseif(Auth::user()->departement->dept=='RKA')
                @if($pkp->status_terima2=='terima')
                <button class="btn btn-primary" data-toggle="modal" data-target="#kirim{{ $pkp->id_project  }}"><i class="fa fa-paper-plane"></i> Sent</a></button>
                  @if($pengajuan==0)
                    <button class="btn btn-success" data-toggle="modal" data-target="#ajukan{{ $pkp->id_project  }}"><i class="fa fa-comments-o"></i> Sent Revision request</a></button>
                  @endif
                @endif
              @endif
            @endif
            <a class="btn btn-warning" onclick="return confirm('Print Data PKP ini ?')" href="{{ Route('download',['id_project' => $pkp->id_project, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}"><li class="fa fa-print"> Download/print PKP</li></a>
            <a class="btn btn-danger" href="{{ route('daftarpkp',$pkp->id_project)}}"><i class="fa fa-share"></i>Back</a>
					</div> 
          <div class="tab-content panel ">
            <div class="tab-pane active" id="1">
              @php $no = 0; @endphp 
              <div class="panel-default">	
						  	<div class="panel-body badan">
							  	<label>PT. NUTRIFOOD INDONESIA</label>
									<table ALIGN="right">
    								<tr>
    								  <th class="text-right">KODE FORM : F.Q.201</th>
    								</tr>
  								</table>
									<center> <h2 style="font-size: 22px;font-weight: bold;">PENGEMBANGAN KONSEP AWAL PRODUK BARU</h2> </center>
  								<center> <h2 style="font-size: 20px;font-weight: bold;">( PKP )</h2> </center><br>	
									<center> <h2 style="font-weight: bold;">[ {{ $pkp->id_brand }} ] &reg;</h2> </center>
      						<table class="table table-bordered" style="font-size:12px">
                    <thead style="background-color:#13699a;font-weight: bold;color:white;font-size: 20px;">
                      <tr>
                        <th style="width:5%" class="text-center">{{ $pkp->project_name }}</th>
                      </tr>
                    </thead>
									</table>
									<table ALIGN="right">
    								<tr><th class="text-right">Author </th><th>: {{$pkp->author}}</th></tr>
										<tr><th class="text-right">Created date</th> <th>: {{$pkp->created_date}}</th></tr>
										<tr><th class="text-right">Last Upadate On</th> <th>: {{$pkp->last_update}}</th></tr>
                    <tr><th class="text-right">Revised By</th><th>: {{$pkp->perevisi}}</th></tr>
  								</table><br><br>
                  @endforeach
									<table class=" table table-bordered">                    
                    <tr>
                      <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Background</span></th>
                    </tr>
                    <tr>
                      <td>Idea</td>
                      <?php $ideas = []; foreach ($pkp1 as $key => $data) If (!$ideas || !in_array($data->idea, $ideas)) {$ideas += array($key => $data->idea);}?>
                      <td colspan="2"> @foreach ($ideas as $idea){{$idea}} <br>@endforeach</td>
                    </tr>
                    <tr>
                      <td>Target market</td>
                      <td colspan="2">
												<table>
                        <?php $gender = []; foreach ($pkp1 as $key => $data) If (!$gender || !in_array($data->gender, $gender)) { $gender += array( $key => $data->gender ); } ?> 
                        <?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses ); } ?>
                        <?php $dariumur = []; foreach ($pkp1 as $key => $data) If (!$dariumur || !in_array($data->dariumur, $dariumur)) { $dariumur += array( $key => $data->dariumur ); } ?>
													<tr><th style="border:none;">Gender </th><th style="border:none;">@foreach ($gender as $gender) : {{$gender}}<br>@endforeach</th></tr>
													<tr><th style="border:none;">Age </th><th style="border:none;">@foreach($dariumur as $dariumur) : {{$dariumur}} Tahun - {{$pkp->sampaiumur}} Tahun <br>@endforeach</th></tr>
													<tr><th style="border:none;">SES </th><th style="border:none;">@foreach ($ses as $ses) : {{$ses}}/@endforeach</th></tr>
												</table>
											</td>
                    </tr>
                    <tr> <?php $Uniqueness = []; foreach ($pkp1 as $key => $data) If (!$Uniqueness || !in_array($data->Uniqueness, $Uniqueness)) { $Uniqueness += array( $key => $data->Uniqueness ); } ?>
                      <td>Uniqueness of idea</td>
                      <td colspan="2">@foreach ($Uniqueness as $Uniqueness) {{$Uniqueness}} <br>@endforeach</td>
                    </tr>
                    <tr>
                      <?php $Estimated = []; foreach ($pkp1 as $key => $data) If (!$Estimated || !in_array($data->Estimated, $Estimated)) { $Estimated += array( $key => $data->Estimated ); } ?>
                      <td>Estimated potential market</td>
                      <td colspan="2">@foreach ($Estimated as $Estimated){{ $Estimated }} <br>@endforeach</td>
                    </tr>
                    <tr class="table-highlight">
                      <?php $reason = []; foreach ($pkp1 as $key => $data) If (!$reason || !in_array($data->reason, $reason)) { $reason += array( $key => $data->reason ); } ?>
                      <td>Reason(s)</td>
                      <td colspan="2">@foreach($reason as $reason){{ $reason }} <br>@endforeach</td>
                    </tr>
                    <tr>
                      <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Market Analysis</span></th>
                    </tr>
                    <tr>
                      <td>Launch Deadline</td>
                      <td colspan="2">
												<table>
                        <?php $launch = []; foreach ($pkp1 as $key => $data) If (!$launch || !in_array($data->launch, $launch)) { $launch += array( $key => $data->launch ); } ?>
                        <?php $tgl_launch = []; foreach ($pkp1 as $key => $data) If (!$tgl_launch || !in_array($data->tgl_launch, $tgl_launch)) { $tgl_launch += array( $key => $data->tgl_launch ); } ?>
													<tr>
                          @foreach($launch as $launch){{$launch}} {{$pkp->years}}@endforeach
                          @foreach($tgl_launch as $tgl_launch){{$tgl_launch}} <br>@endforeach
                          </tr>
												</table>
											</td>
                    </tr>
                    <tr>
                      <?php $aisle = []; foreach ($pkp1 as $key => $data) If (!$aisle || !in_array($data->aisle, $aisle)) { $aisle += array( $key => $data->aisle ); } ?>
                      <td>Aisle Placement</td>
                      <td colspan="2">@foreach($aisle as $aisle){{ $aisle }} <br>@endforeach</td>
                    </tr>
                    <tr>
                      <?php $seles = []; foreach ($for as $key => $data) If (!$seles || !in_array($data->forecast, $seles)) { $seles += array( $key => $data->forecast ); } ?>
                        <td>Sales Forecast</td>
                        <td colspan="2">@foreach($seles as $seles){{ $seles }} ({{$pkp->for1->satuan}}) <br>@endforeach</td>
											</tr>
										<tr>
                      <?php $selling_price = [];
                      foreach ($pkp1 as $key => $data) If (!$selling_price || !in_array($data->selling_price, $selling_price)) { $selling_price += array( $key => $data->selling_price ); } ?>
                      <td>NS Selling Price (Before ppn)</td>
                      <td colspan="2">@foreach($selling_price as $selling_price){{ $selling_price }} <br>@endforeach</td>
										</tr>
										<tr>
                      <?php $price = []; foreach ($pkp1 as $key => $data) If (!$price || !in_array($data->price, $price)) { $price += array( $key => $data->price ); } ?>
                      <td>Consumer Price Target</td>
                      <td colspan="2">@foreach($price as $price){{ $price }} <br>@endforeach</td>
                    </tr>
                    <tr class="table-highlight">
                      <?php $uom = []; foreach ($pkp1 as $key => $data) If (!$uom || !in_array($data->Duom->primary_uom, $uom)) { $uom += array( $key => $data->Duom->primary_uom ); } ?>
                      <td>UOM</td>
                      <td colspan="2">@foreach($uom as $uom){{ $uom }}/ @endforeach</td>
                    </tr>
                    <tr class="table-highlight">
                      <?php $competitor = []; foreach ($pkp1 as $key => $data) If (!$competitor || !in_array($data->competitor, $competitor)) {$competitor += array( $key => $data->competitor ); } ?>
                      <td>Main Competitor</td>
                      <td colspan="2">@foreach($competitor as $competitor){{ $competitor }} <br>@endforeach</td>
                    </tr>
                    <tr class="table-highlight">
                      <?php $competitive = []; foreach ($pkp1 as $key => $data) If (!$competitive || !in_array($data->competitive, $competitive)) { $competitive += array( $key => $data->competitive ); } ?>
                      <td>Competitive Analysis</td>
                      <td colspan="2">@foreach($competitive as $competitive){{ $competitive }} <br>@endforeach</td>
                    </tr>
                    <tr>
                      <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Product features</span></th>
                    </tr>
                    <tr>
                      <?php $product_form = []; foreach ($pkp1 as $key => $data) If (!$product_form || !in_array($data->product_form, $product_form)) { $product_form += array( $key => $data->product_form  ); } ?>
                      <td>Product Form</td>
                      <td colspan="2">@foreach($product_form as $product_form){{ $product_form }} <br>@endforeach</td>
                    </tr>
                    <tr>
                      <?php $eksis = []; foreach ($pkp1 as $key => $data) If (!$eksis || !in_array($data->kemas->nama, $eksis)) { $eksis += array( $key => $data->kemas->nama ); } ?>
                      <td>Product Packaging</td>
                      <td colspan="2">
												<table>
													<tr>
                          @foreach($eksis as $eksis)

                          @if($pkp->kemas_eksis!=NULL)
                          {{$eksis}}
                          (
                          @if($pkp->kemas->primer!=NULL)	
													{{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }}
													@elseif($pkp->kemas->primer==NULL)
													@endif

													@if($pkp->kemas->sekunder1!=NULL)	
													X {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}}
													@elseif($pkp->kemas->sekunder1==NULL)
													@endif

													@if($pkp->kemas->sekunder2!=NULL)	
													X {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }}
													@elseif($pkp->sekunder2==NULL)
													@endif

													@if($pkp->kemas->tersier!=NULL)	
													X {{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }}
													@elseif($pkp->tersier==NULL)
													@endif
                          )
                          @elseif($pkp->primer==NULL)
                            @if($pkp->kemas_eksis==NULL)
                            @endif
                          @endif
                          <br>
                          @endforeach
													<br><br>
													<tr><th style="border:none;"> Optional</th></tr>
                            <?php $primery = []; foreach ($pkp1 as $key => $data) If (!$primery || !in_array($data->primery, $primery)) { $primery += array( $key => $data->primery ); } ?>
                            <?php $secondary = []; foreach ($pkp1 as $key => $data) If (!$secondary || !in_array($data->secondary, $secondary)) { $secondary += array( $key => $data->secondary ); } ?>
                            <?php $tertiary = []; foreach ($pkp1 as $key => $data) If (!$tertiary || !in_array($data->tertiary, $tertiary)) { $tertiary += array( $key => $data->tertiary ); } ?>
														<tr><th style="border:none;">Primary information</th><th style="border:none;">@foreach($primery as $primery) : {{ $primery }} <br>@endforeach</th></tr>
														<tr><th style="border:none;">Secondary information</th><th style="border:none;">@foreach($secondary as $secondary) : {{ $secondary }} <br>@endforeach</th></tr>
														<tr><th style="border:none;">Teriery information</th><th style="border:none;">@foreach($tertiary as $tertiary) : {{ $pkp->tertiary }} <br>@endforeach</th></tr>
												  </tr>
                        </table>
											</td>
                    </tr>
                    <tr>
                      <?php $pangan = []; foreach ($pkp1 as $key => $data) If (!$pangan || !in_array($data->katpangan->kategori, $pangan)) { $pangan += array( $key => $data->katpangan->kategori ); } ?>
                      <?php $tarkon = []; foreach ($pkp1 as $key => $data) If (!$tarkon || !in_array($data->tarkon->tarkon, $tarkon)) { $tarkon += array( $key => $data->tarkon->tarkon ); } ?>
                      <td>Food Category (BPOM)</td>
                      <td colspan="2">@foreach($pangan as $pangan){{$pangan}} <br>@endforeach
                      <br>AKG @foreach($tarkon as $tarkon) : {{$tarkon}}, <br>@endforeach</td>
                    </tr>
                    <tr class="table-highlight">
                      <?php $prefered_flavour = []; foreach ($pkp1 as $key => $data) If (!$prefered_flavour || !in_array($data->prefered_flavour, $prefered_flavour)) { $prefered_flavour += array( $key => $data->prefered_flavour ); } ?>
                      <td>Prefered Flavour</td>
                      <td colspan="2">@foreach($prefered_flavour as $prefered_flavour){{ $prefered_flavour }} <br>@endforeach</td>
                    </tr>
                    <tr>
                      <td>Product Benefits</td>
                      <td colspan="2">
												<table>
                          <?php $product_benefits = []; foreach ($pkp1 as $key => $data) If (!$product_benefits || !in_array($data->product_benefits, $product_benefits)) { $product_benefits += array( $key => $data->product_benefits ); } ?>
													<tr>@foreach($product_benefits as $product_benefits){{ $product_benefits }} <br>@endforeach</tr>
												</table>
                        <table class="table table-bordered table-hover" id="table">
        					          <tbody>
                              <tr><td>Komponen</td><td><?php $komponen = []; foreach ($dataklaim as $key => $data) If (!$komponen || !in_array($data->datakp->komponen, $komponen)) { $komponen += array( $key => $data->datakp->komponen ); 
                              if($data->revisi!=$pkp->revisi){ echo": <s><font color='#ffa2a2'>".$data->datakp->komponen."<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo":". $data->datakp->komponen."<br>"; } }  ?></td><tr>
                              <td>Klaim</td><td><?php $detail = []; foreach ($datadetail as $key => $data) If (!$detail || !in_array($data->datadl->detail, $detail)) { $detail += array( $key => $data->datadl->detail );
                              if($data->revisi!=$pkp->revisi){ echo": <s><font color='#ffa2a2'>".$data->datadl->detail."<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo":". $data->datadl->detail."<br>"; } }  ?></td></tr>
                              <tr><td>Detail</td><td><?php $klaim = []; foreach ($dataklaim as $key => $data) If (!$klaim || !in_array($data->klaim, $klaim)) { $klaim += array( $key => $data->klaim );
                              if($data->revisi!=$pkp->revisi){ echo": <s><font color='#ffa2a2'>".$data->klaim."<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo":". $data->klaim."<br>"; } }  ?></td></tr>
        					          </tbody>
      					          </table>
											</td>
                    </tr>
                    <tr>
                      <?php $mandatory_ingredient = []; foreach ($pkp1 as $key => $data) If (!$mandatory_ingredient || !in_array($data->mandatory_ingredient, $mandatory_ingredient)) { $mandatory_ingredient += array( $key => $data->mandatory_ingredient ); } ?>
                      <td>Mandatory Ingredients</td>
                      <td colspan="2">@foreach($mandatory_ingredient as $mandatory_ingredient){{ $mandatory_ingredient }} <br>@endforeach</td>
                    </tr>
                    <tr>
                      <td>Related Picture</td>
                      <td colspan="2">@foreach($picture as $pic){{$pic->filename}} <a href="{{ Storage::url($pic->lokasi)}}" download="{{$pic->filename}}"><button class="btn btn-primary btn-sm"><li class="fa fa-download"></li></button></a><br> @endforeach</td>
                    </tr>    
                  </table>
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr style="background-color:#bfc2c5;"><td class="text-center" colspan="5">ATTENTION</td></tr>
                      <tr><td style="background-color:#ffffff;" width="30%"></td><td style="border:none;background-color:#bfc2c5;"> compulsory; filled by QBX (brand function) Managers</td></tr>
                      <tr><td style="background-color:#13699a;" width="30%"></td><td style="border:none;background-color:#bfc2c5;">should only be filled with great certainty</td></tr>
                      <tr><td style="background-color:#e41356;" width="30%"></td><td style="border:none;background-color:#bfc2c5;"> should only be filled after discussion with QPA</td></tr>
                      <tr>
                        <td style="background-color:#bfc2c5;">Service Level Agreements</td>
                        <td style="background-color:#bfc2c5;">
                          <table>
                            <thead>
                              <tr><td style="border:none;">Lead Time QBX (brand function)</td><td style="border:none;">5 workdays</td></tr>
                              <tr><td style="border:none;">Lead Time QPA (product development function)</td><td style="border:none;">[1 (benefits) + 2 (COGS)] = 2 workdays</td></tr>
                              <tr><td style="border:none;">Lead Time Revision </td><td style="border:none;">2 workdays</td></tr>
                            </thead>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td style="background-color:#bfc2c5;">Process</td>
                        <td style="background-color:#bfc2c5;">
                          <table>
                            <thead>
                              <tr><td style="border:none;">After being filled. HOD approval request. Then, forward to RD as low priority project. Will be further</td></tr>
                              <tr><td style="border:none;">prioritized in PV Cross Funct Mtg. </td></tr>
                              <tr><td style="border:none;">Meanwhile, RD can prepare SLA projection to propose into PV's SLA for the project based on</td></tr>
                              <tr><td style="border:none;">capacity and feasibility.</td></tr>
                            </thead>
                          </table>
                        </td>
                      </tr>
                    </thead>
                  </table>
        					<table ALIGN="right">
        						<tr><td>Revisi/Berlaku :  </td></tr>
        						<tr><td>Masa Berlaku : Selamanya</td></tr>
        					</table>
								</div>
							</div>
            </div>
        	</div>
				</div>
    	</div>
    </div>    
	</div>
</div>

<!-- modal -->
<div class="modal" id="kirim{{ $pkp->id_project  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">                 
        <h3 class="modal-title" id="exampleModalLabel">Sent PKP
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" method="POST" action="{{ Route('edittuser',$pkp->id_project)}}" novalidate>
        <div class="form-group row">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center"> User</label>
          @if(Auth::user()->departement->dept!="RKA")
          @if($pkp->userpenerima2!='NULL')
          <input type="hidden" value="{{$pkp->userpenerima2}}" name="user2">
          @endif
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select required name="user" class="form-control form-control-line" id="user">
            <option disabled selected>Select User</option>
            @foreach($user as $user)
              @if($user->id!=Auth::user()->id)
              <option required value="{{$user->id}}">{{ $user->name }}</option>
              @endif
              @endforeach
            </select>
          </div>
          @elseif(Auth::user()->departement->dept=="RKA")
          @if($pkp->userpenerima!='NULL')
          <input type="hidden" value="{{$pkp->userpenerima}}" name="user">
          @endif
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select required name="user2" class="form-control form-control-line" id="user2">
            <option disabled selected>Select User</option>
            @foreach($user as $user)
              <option required value="{{$user->id}}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
          @endif
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Sent</button>
          {{ csrf_field() }}
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Selesai -->

<!-- Modal -->
<div class="modal" id="ajukan{{ $pkp->id_project  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">                 
        <h3 class="modal-title" id="exampleModalLabel">Sent Revision request
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" method="POST" action="{{ Route('pengajuan')}}" novalidate>
        <div class="form-group row">
        <input type="hidden" value="{{$pkp->id_project}}" name="pkp">
        <input type="hidden" value="{{$pkp->turunan}}" name="turunan">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Destination</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select name="penerima" class="form-control form-control-line" id="penerima">
            <option disabled selected>--> Select One <--</option>
            <option value="14">PV</option>
            <option value="1">Marketing</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Note</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <textarea name="catatan" id="catatan" class="col-md-12 col-sm-12 col-xs-12"></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">request priority</label>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <select name="prioritas" id="prioritas" class="form-control form-control-line">
              <option value="1">High Priority</option>
              <option value="2">Standar Priority</option>
              <option value="3">Low Priority</option>
            </select>
          </div>
          <div class="col-md-6 col-sm-3 col-xs-12">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">time</label>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="number" class="form-control form-control-line col-md-12 col-sm-12 col-xs-12" name="jangka" id="jangka">
          </div>
          <div class="col-md-6 col-sm-3 col-xs-12">
            <select name="waktu" id="waktu" class="form-control form-control-line col-md-12 col-sm-12 col-xs-12">
              <option value="Bulan">Bulan</option>
              <option value="Minggu">Minggu</option>
            </select>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Sent</button>
          {{ csrf_field() }}
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Selesai -->
@endsection