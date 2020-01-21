<!DOCTYPE html>
<html lang="en">

<head>
<title>Download PKP</title>
<link href="{{ asset('img/prod.png') }}" rel="icon">
<link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/asrul.css') }}" rel="stylesheet">
</head>
<body>

<div class="watermarked">
  <img src="{{ asset('img/aul.png') }}" alt="Photo">
</div>

<div id="pcoded" class="pcoded">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="" >
      <div class="row" style="margin:20px">
        <div id="exTab2" class="container">
          <div class="tab-content" style="background-image:url(img/biru.jpg);">
            <div class="tab-pane active" id="1">
              @php
              	$no = 0;
              @endphp
              <div class="panel-default">
								<div class="panel-body badan" style="background-image:url(img/biru.jpg);">
									<label>PT. NUTRIFOOD INDONESIA</label>
										<table ALIGN="right">
    									<tr>
    									  <th class="text-right">KODE FORM : F.Q.201</th>
    									</tr>
  									</table>
                    @foreach($pkpp as $pkp)
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
                            <?php $dariumur = []; foreach ($pkp1 as $key => $data) If (!$dariumur || !in_array($data->dariumur, $dariumur)) { $dariumur += array( $key => $data->dariumur ); } ?>
														<tr><th style="border:none;">Gender </th><th style="border:none;"> : @foreach ($gender as $gender) {{$gender}}<br>@endforeach</th></tr>
														<tr><th style="border:none;">Usia </th><th style="border:none;"> : @foreach($dariumur as $dariumur) {{$dariumur}} Tahun - {{$pkp->sampaiumur}} Tahun <br>@endforeach</th></tr>
														<tr><th style="border:none;">SES </th><th style="border:none;"> 
                            <?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses ); 
                            if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->ses<br></font></s>"; }if($data->turunan==$pkp->turunan){ echo": $data->ses <br>"; } } ?></th></tr>
													
													</table>
												</td>
                      </tr>
                      <tr>
                      <?php $Uniqueness = []; foreach ($pkp1 as $key => $data) If (!$Uniqueness || !in_array($data->Uniqueness, $Uniqueness)) { $Uniqueness += array( $key => $data->Uniqueness ); } ?>
                        <td>Uniqueness of idea</td>
                        <td colspan="2">@foreach ($Uniqueness as $Uniqueness) {{$Uniqueness}} <br>@endforeach</td>
                      </tr>
                      <tr>
                      <?php $Estimated = []; foreach ($pkp1 as $key => $data) If (!$Estimated || !in_array($data->Estimated, $Estimated)) {  $Estimated += array(  $key => $data->Estimated ); } ?>
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
                        <td colspan="2">@foreach($seles as $seles){{ $seles }} {{$pkp->for1->satuan}} <br>@endforeach</td>
											</tr>
											<tr>
                      <?php $selling_price = [];
                        foreach ($pkp1 as $key => $data) If (!$selling_price || !in_array($data->selling_price, $selling_price)) { $selling_price += array( $key => $data->selling_price ); } ?>
                        <td>NF Selling Price (Before ppn)</td>
                        <td colspan="2">@foreach($selling_price as $selling_price){{ $selling_price }} <br>@endforeach</td>
											</tr>
                      <?php $price = [];
                        foreach ($pkp1 as $key => $data) If (!$price || !in_array($data->price, $price)) { $price += array( $key => $data->price ); } ?>
                        <td>Consumer price target</td>
                        <td colspan="2">@foreach($price as $price){{ $price }} <br>@endforeach</td>
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
                      <tr class="table-highlight">
                      <?php $uom = []; foreach ($pkp1 as $key => $data) If (!$uom || !in_array($data->Duom->primary_uom, $uom)) { $uom += array( $key => $data->Duom->primary_uom ); } ?>
                        <td>UOM</td>
                        <td colspan="2">@foreach($uom as $uom){{ $uom }}/ @endforeach</td>
                      </tr>
                      <tr>
                        <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Product features</span></th>
                      </tr>
                      <tr>
                      <?php $product_form = [];
                        foreach ($pkp1 as $key => $data) If (!$product_form || !in_array($data->product_form, $product_form)) { $product_form += array( $key => $data->product_form  ); } ?>
                        <td>Product Form</td>
                        <td colspan="2">@foreach($product_form as $product_form){{ $product_form }} <br>@endforeach</td>
                      </tr>
                      <tr>
                      <?php $eksis = [];
                        foreach ($pkp1 as $key => $data) If (!$eksis || !in_array($data->kemas->nama, $eksis)) { $eksis += array( $key => $data->kemas->nama ); } ?>
                        <td>Product Packaging</td>
                        <td colspan="2">
													<table>
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
														<br>
														<tr><th style="border:none;"> Optional</th></tr>
                            <?php $primery = []; foreach ($pkp1 as $key => $data) If (!$primery || !in_array($data->primery, $primery)) { $primery += array( $key => $data->primery ); } ?>
                            <?php $secondary = []; foreach ($pkp1 as $key => $data) If (!$secondary || !in_array($data->secondary, $secondary)) { $secondary += array( $key => $data->secondary ); } ?>
                            <?php $tertiary = []; foreach ($pkp1 as $key => $data) If (!$tertiary || !in_array($data->tertiary, $tertiary)) { $tertiary += array( $key => $data->tertiary ); } ?>
														<tr><th style="border:none;">Primary information</th><th style="border:none;">@foreach($primery as $primery) : {{ $primery }} <br>@endforeach</th></tr>
														<tr><th style="border:none;">Secondary information</th><th style="border:none;">@foreach($secondary as $secondary) : {{ $secondary }} <br>@endforeach</th></tr>
														<tr><th style="border:none;">Teriery information</th><th style="border:none;">@foreach($tertiary as $tertiary) : {{ $pkp->tertiary }} <br>@endforeach</th></tr>
													</table>
												</td>
                      </tr>
                      <tr>
                      <?php $pangan = []; foreach ($pkp1 as $key => $data) If (!$pangan || !in_array($data->katpangan->kategori, $pangan)) { $pangan += array( $key => $data->katpangan->kategori ); } ?>
                        <?php $tarkon = []; foreach ($pkp1 as $key => $data) If (!$tarkon || !in_array($data->tarkon->tarkon, $tarkon)) { $tarkon += array( $key => $data->tarkon->tarkon ); } ?>
                        <td>Food Category (BPOM)</td>
                        <td colspan="2">@foreach($pangan as $pangan){{$pangan}} <br>@endforeach
                        <br>AKG @foreach($tarkon as $tarkon) : {{$tarkon}} <br>@endforeach</td>
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
                        <td colspan="2">@foreach($picture as $pic){{$pic->filename}} 
                        <a href="{{ Storage::url($pic->lokasi)}}" download="{{$pic->filename}}"><button class="btn btn-primary btn-sm"><li class="fa fa-download"></li></button></a><br> @endforeach</td>
                      </tr>

                    </table>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#bfc2c5;"><td class="text-center" colspan="5">ATTENTION</td></tr>
                        <tr><td style="background-color:#ffffff;" width="30%"></td><td style="border:none;background-color:#bfc2c5;"> compulsory; filled by QBX (brand function) Managers</td></tr>
                        <tr><td style="background-color:#13699a;" width="30%"></td><td style="border:none;background-color:#bfc2c5;">should only be filled with great certainty</td></tr>
                        <tr><td style="background-color:#e41356;" width="30%"></td><td style="border:none;background-color:#bfc2c5;"> should only be filled after discussion with QPA</td></tr>
                        <tr><td style="background-color:#bfc2c5;">Service Level Agreements</td>
                        <td style="background-color:#bfc2c5;">
                          <table>
                            <thead>
                              <tr><td style="border:none;">Lead Time QBX (brand function)</td><td style="border:none;">5 workdays</td></tr>
                              <tr><td style="border:none;">Lead Time QPA (product development function)</td><td style="border:none;">[1 (benefits) + 2 (COGS)] = 2 workdays</td></tr>
                              <tr><td style="border:none;">Lead Time Revision </td><td style="border:none;">2 workdays</td></tr>
                            </thead>
                          </table>
                        </td></tr>
                        <tr><td style="background-color:#bfc2c5;">Process</td>
                        <td style="background-color:#bfc2c5;">
                          <table>
                            <thead>
                              <tr><td style="border:none;">After being filled. HOD approval request. Then, forward to RD as low priority project. Will be further</td></tr>
                              <tr><td style="border:none;">prioritized in PV Cross Funct Mtg. </td></tr>
                              <tr><td style="border:none;">Meanwhile, RD can prepare SLA projection to propose into PV's SLA for the project based on</td></tr>
                              <tr><td style="border:none;">capacity and feasibility.</td></tr>
                            </thead>
                          </table>
                        </td></tr>
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
</body>

</html>
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script>
  $(document).ready(function() {
    window.print()
  });
</script>
