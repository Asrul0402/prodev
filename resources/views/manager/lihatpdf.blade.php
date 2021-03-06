@extends('manager.tempmanager')

@section('title', 'data PDF')

@section('judul', 'Data PDF')

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
            @foreach($pdf as $pdf)
            @if($pdf->status_project=='sent' || $pdf->status_project=='proses')
              @if(Auth::user()->departement->dept!='RKA')
                @if($pdf->status_terima=='terima')
                <button class="btn btn-primary" data-toggle="modal" data-target="#kirim{{ $pdf->id_project_pdf  }}"><i class="fa fa-paper-plane"></i> Sent</a></button>
                  <!-- Modal -->
                  <div class="modal" id="kirim{{ $pdf->id_project_pdf  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">                 
                          <h3 class="modal-title text-left" id="exampleModalLabel">Sent Data
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></h3>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{ Route('eedituser',$pdf->id_project_pdf)}}" novalidate>
                          <div class="form-group row">
                            <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center"> User</label>
                            @if(Auth::user()->departement->dept!="RKA")
                            @if($pdf->userpenerima2!='NULL')
                            <input type="hidden" value="{{$pdf->userpenerima2}}" name="user2">
                            @endif
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select name="user" class="form-control form-control-line" id="user">
                                <option disabled selected>--> select One <--</option>
                                @foreach($user as $user)
                                @if($user->id!=Auth::user()->id)
                                <option value="{{$user->id}}">{{ $user->name }}</option>
                                @endif
                                @endforeach
                              </select>
                            </div>
                            @elseif(Auth::user()->departement->dept=="RKA")
                              @if($pdf->userpenerima!='NULL')
                              <input type="hidden" value="{{$pdf->userpenerima}}" name="user">
                              @endif
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="user2" class="form-control form-control-line" id="user2">
                                  <option disabled selected>--> select One <--</option>
                                  @foreach($user as $user)
                                  <option value="{{$user->id}}">{{ $user->name }}</option>
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
                  @if($hitung==0)
						      <button class="btn btn-success" data-toggle="modal" data-target="#ajukan{{ $pdf->id_project_pdf  }}"><i class="fa fa-comments-o"></i> Sent Revision request</a></button>
                    <!-- Modal -->
                    <div class="modal" id="ajukan{{ $pdf->id_project_pdf  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">                 
                            <h3 class="modal-title text-left" id="exampleModalLabel">Sent Revision request
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button></h3>
                          </div>
                          <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{ Route('pengajuanpdf')}}" novalidate>
                            <div class="form-group row">
                              <input type="hidden" value="{{$pdf->id_project_pdf}}" name="pdf">
                              <input type="hidden" value="{{$pdf->turunan}}" name="turunan">
                              <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Destination</label>
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="penerima" class="form-control form-control-line" id="penerima">
                                  <option disabled selected>--> Select One <--</option>
                                  <option value="5">PV</option>
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
                              <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">request Priority</label>
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
                  @endif
                @endif
              @elseif(Auth::user()->departement->dept=='RKA')
                @if($pdf->status_terima2=='terima') 
                <button class="btn btn-primary" data-toggle="modal" data-target="#kirim{{ $pdf->id_project_pdf  }}"><i class="fa fa-paper-plane"></i> Sent</a></button>
                  @if($hitung==0)
						      <button class="btn btn-success" data-toggle="modal" data-target="#ajukan{{ $pdf->id_project_pdf  }}"><i class="fa fa-comments-o"></i> Sent Revision request</a></button>
                  @endif
                @endif
              @endif
            @endif
            <a class="btn btn-warning" onclick="return confirm('Print Data PDF ini ?')" href="{{ Route('downloadpdf',['id_project_pdf' => $pdf->id_project_pdf, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan]) }}"><li class="fa fa-print"> Download/print PDF</li></a>
            <a class="btn btn-danger" href="{{ route('daftarpdf',$pdf->id_project_pdf)}}"><i class="fa fa-share"></i>Back</a>
          </div> 
          <div class="tab-content panel ">
            <div class="tab-pane active" id="1">
              @php $no = 0; @endphp 
              <div class="panel-default">	
								<div class="panel-body badan">
                  <table class="table table-bordered" style="font-size:12px">
                    <thead style="background-color:#e22b3c;font-weight: bold;color:white;font-size: 20px;">
                      <tr><th style="width:5%" class="text-center">PRODUCT DEVELOPMENT FORM</th></tr>
                      <tr><th style="width:5%" class="text-center">( PDF )</th></tr>
                    </thead>
									</table>
									<center> <h2 style="font-weight: bold;">[ {{ $pdf->id_brand }} ] &reg;</h2> </center>
      						<hr style="color:black;">
                  <div class="row">
                    <div class="col-sm-6">
                      <table ALIGN="left">
    								    <tr><th class="text-right">Revisi No</th> <th>: {{$pdf->revisi}}.{{$pdf->turunan}}</th></tr>
                      </table>
                    </div>
                    <div class="col-sm-6">
									    <table ALIGN="right">
    								    <tr><th class="text-right">Author </th><th>: {{$pdf->author}}</th></tr>
										    <tr><th class="text-right">Created date</th> <th>: {{$pdf->created_date}}</th></tr>
										    <tr><th class="text-right">Last Upadate On</th> <th>: {{$pdf->last_updated}}</th></tr>
                        <tr><th class="text-right">Revised By</th><th> : {{$pdf->perevisi}}</th></tr>
                        <tr><th class="text-right">Project Name</th><th>: {{ $pdf->project_name }}</th></tr>
                        <tr><th class="text-right">Country</th><th>: {{ $pdf->country }}</th></tr>
                        <tr><th class="text-right">Reference Regulation</th><th>: {{ $pdf->reference }}</th></tr>
  								    </table>
                    </div><br>
                    <div  class="col-sm-12">
                      <table width="100%" class="table table-bordered">
                        <thead>
                          <tr>
                            <td>Target market</td>
                            <td colspan="2">
													    <table>
                                <?php $dariusia = []; foreach ($pdf1 as $key => $data) If (!$dariusia || !in_array($data->dariusia, $dariusia)) { $dariusia += array( $key => $data->dariusia );} ?>
													    	<tr><th style="border:none;">Age </th><th style="border:none;">@foreach($dariusia as $dariusia): {{$dariusia}}   Tahun - {{$pdf->sampaiusia}} Tahun<br>@endforeach</th></tr>
													    	<?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses );} ?>
                                <tr><th style="border:none;">SES </th><th style="border:none;"> @foreach($ses as $ses): {{$ses}} /@endforeach</th></tr>
													    	<?php $gender = []; foreach ($pdf1 as $key => $data) If (!$gender || !in_array($data->gender, $gender)) { $gender += array( $key => $data->gender );} ?>
                                <tr><th style="border:none;">Gender </th><th style="border:none;"> @foreach($gender as $gender): {{$gender}}<br>@endforeach</th></tr>
													    </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Background / Insight</td>
                            <?php $background = []; foreach ($pdf1 as $key => $data) If (!$background || !in_array($data->background, $background)) { $background += array( $key => $data->background );} ?>
                            <td colspan="2">@foreach($background as $background){{$background}}<br>@endforeach</td>
                          </tr>
                          <tr>
                            <td>Attracttiveness</td>
                            <?php $attractiveness = []; foreach ($pdf1 as $key => $data) If (!$attractiveness || !in_array($data->attractiveness, $attractiveness)) { $attractiveness += array( $key => $data->attractiveness );} ?>
                            <td colspan="2">@foreach($attractiveness as $attractiveness){{$pdf->attractiveness}}<br>@endforeach</td>
                          </tr>
                          <tr>
                            <td>Target RTO</td>
                            <?php $rto = []; foreach ($pdf1 as $key => $data) If (!$rto || !in_array($data->rto, $rto)) { $rto += array( $key => $data->rto );} ?>
                            <td colspan="2">@foreach($rto as $rto){{$rto}}<br>@endforeach</td>
                          </tr>
                          <tr>
                          <?php $seles = []; foreach ($for as $key => $data) If (!$seles || !in_array($data->forecast, $seles)) { $seles += array( $key => $data->forecast ); } ?>
                        <?php $satuan = []; foreach ($for as $key => $data) If (!$satuan || !in_array($data->satuan, $satuan)) { $satuan += array( $key => $data->satuan ); } ?>
                        <td>Sales Forecast</td>
                        <td colspan="2">
                        <table class="table table-bordered">
                          <tr>
                          @foreach($seles as $seles)<td>{{ $seles }}</td>@endforeach
                          </tr><tr>
                          @foreach($satuan as $satuan)<td>({{ $satuan }})</td>@endforeach
                          </tr>
                        </table>
                          </tr>
                          <tr>
                            <td>Competitor</td>
                            <td colspan="2">
                              <table>
                                <?php $name = []; foreach ($pdf1 as $key => $data) If (!$name || !in_array($data->name, $name)) { $name += array( $key => $data->name );} ?>
									      				<tr><th style="border:none;">Nama </th><th style="border:none;"> @foreach($name as $name) : {{$name}}<br>@endforeach</th></tr>
										  	    		<?php $retailer_price = []; foreach ($pdf1 as $key => $data) If (!$retailer_price || !in_array($data->retailer_price, $retailer_price)) { $retailer_price += array( $key => $data->retailer_price );} ?>
                                <tr><th style="border:none;">Retailer Price </th><th style="border:none;"> @foreach($retailer_price as $retailer_price): {{$retailer_price}}<br>@endforeach</th></tr>
										      			<?php $special = []; foreach ($pdf1 as $key => $data) If (!$special || !in_array($data->special, $special)) { $special += array( $key => $data->special );} ?>
                                <tr><th style="border:none;">What's Special </th><th style="border:none;"> @foreach($special as $special): {{$special}}<br>@endforeach</th></tr>
										      			<tr><th style="border:none;">File </th><th style="border:none;"> 
                                @foreach($picture as $pic): {{$pic->filename}} <a href="{{ Storage::url($pic->lokasi)}}" download="{{$pic->filename}}"><button class="btn btn-primary btn-sm"><li class="fa fa-download"></li></button></a><br>
                                @endforeach</th></tr>
												      </table>
							      				</td>
                          </tr>
                          <tr>
                            <td>Product Concept</td>
                            <td colspan="2">
												    	<table>
                                <?php $wight = []; foreach ($pdf1 as $key => $data) If (!$wight || !in_array($data->wight, $wight)) { $wight += array( $key => $data->wight );} ?>
											      		<tr><th style="border:none;">Weight/Serving </th><th style="border:none;"> @foreach($wight as $wight): {{$wight}} / {{$pdf->serving}}<br>@endforeach</th></tr>
											      		<?php $target_price = [];foreach ($pdf1 as $key => $data)If (!$target_price || !in_array($data->target_price, $target_price)) { $target_price += array($key => $data->target_price);}?>
                                <tr><th style="border:none;">Target NFI price / ctn </th><th style="border:none;"> @foreach($target_price as $target_price): {{$target_price}}<br>@endforeach</th></tr>
											      		<?php $claim = []; foreach ($pdf1 as $key => $data) If (!$claim || !in_array($data->claim, $claim)) { $claim += array( $key => $data->claim );} ?>
                                <tr><th style="border:none;">Claim / function </th><th style="border:none;"> @foreach($claim as $claim): {{$claim}}<br>@endforeach</th></tr>
											      		<?php $ingredient = []; foreach ($pdf1 as $key => $data) If (!$ingredient || !in_array($data->ingredient, $ingredient)) { $ingredient += array( $key => $data->ingredient );} ?>
                                <tr><th style="border:none;">Special Ingredient </th><th style="border:none;"> @foreach($ingredient as $ingredient): {{$ingredient}}<br>@endforeach</th></tr>
											      	</table>
											      </td>
                          </tr>
                          <tr>
                            <td>Product Concept</td>
                            <?php $eksis = []; foreach ($pdf1 as $key => $data) If (!$eksis || !in_array($data->kemas->nama, $eksis)) { $eksis += array( $key => $data->kemas->nama );} ?>
                            <td colspan="2">
													    <table>
                              @foreach($eksis as $eksis)
                          
                                {{$eksis}}
                                (
                                @if($pdf->kemas->primer!=NULL)	
													    	{{ $pdf->kemas->primer }}{{ $pdf->kemas->s_primer }} </tr>
													    	@elseif($pdf->kemas->primer==NULL)
													      @endif

														    @if($pdf->kemas->sekunder1!=NULL)	
														    X {{ $pdf->kemas->sekunder1 }}{{ $pdf->kemas->s_sekunder1}} </tr>
														    @elseif($pdf->kemas->sekunder1==NULL)
														    @endif

														    @if($pdf->kemas->sekunder2!=NULL)	
														    X {{ $pdf->kemas->sekunder2 }}{{ $pdf->kemas->s_sekunder2 }} </tr>
														    @elseif($pdf->sekunder2==NULL)
														    @endif

														    @if($pdf->kemas->tersier!=NULL)	
														    X {{ $pdf->kemas->tersier }}{{ $pdf->kemas->s_tersier }} </tr>
														    @elseif($pdf->tersier==NULL)
														    @endif
                                )

                              @endforeach <br><br> 
                                <?php $primery = []; foreach ($pdf1 as $key => $data) If (!$primery || !in_array($data->primery, $primery)) { $primery += array( $key => $data->primery );} ?>
														    <tr><th style="border:none;">Primary Information</th><th style="border:none;"> @foreach($primery as $primery): {{$primery}}<br> @endforeach</th></tr>
														    <?php $secondery = []; foreach ($pdf1 as $key => $data) If (!$secondery || !in_array($data->secondery, $secondery)) { $secondery += array( $key => $data->secondery );} ?>
                                <tr><th style="border:none;">Secondary Information</th><th style="border:none;"> @foreach($secondery as $secondery): {{$secondery}}<br> @endforeach</th></tr>
														    <?php $Tertiary = [];foreach ($pdf1 as $key => $data) If (!$Tertiary || !in_array($data->Tertiary, $Tertiary)) { $Tertiary += array( $key => $data->Tertiary );} ?>
                                <tr><th style="border:none;">Tertiary Information</th><th style="border:none;"> @foreach($Tertiary as $Tertiary): {{$Tertiary}}<br> @endforeach</th></tr>
												      </table>
											      </td>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                  @endforeach
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

@endsection