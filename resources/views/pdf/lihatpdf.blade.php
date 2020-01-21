@extends('pv.tempvv')
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
            @if($pdf->status_data=="draf")
              @if(auth()->user()->role->namaRule === 'pv_global')
              <button class="btn btn-primary" data-toggle="modal" data-target="#NW{{ $pdf->id_project_pdf  }}"><i class="fa fa-paper-plane"></i> Sent</a></button>
				      <!-- Modal -->
              <div class="modal" id="NW{{ $pdf->id_project_pdf  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title text-left" id="exampleModalLabel">Sent Data
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button></h3>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal form-label-left" method="POST" action="{{ Route('eedit',['pdf_id' => $pdf->id_project_pdf, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan])}}" novalidate>
                      <div class="form-group row">
                        <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Dept 1</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <select name="kirim" class="form-control form-control-line" id="kirim">
                            <option disabled selected>Departement</option>
                            @foreach($dept as $dept)
                            <option value="{{$dept->id}}">{{ $dept->dept }} ({{ $dept->nama_dept }})</option>
                            @endforeach
                          </select>
                        </div>
                        <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Dept 2</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <select name="rka" class="form-control form-control-line" id="rka">
                            <option value="1">RKA</option>
                            <option value="0">Tidak Ada</option>
                          </select>
                        </div>
                      </div>
                      <input type="hidden" value="{{$nopdf}}" name="nopdf" id="nopdf">
                      <?php $tanggal = Date("Y"); ?>
                      <input type="hidden" value="_{{$tanggal}}/{{$pdf->product_type}}_{{ $pdf->project_name }}_{{ $pdf->revisi }}.{{ $pdf->turunan }}" name="ket_no" id="ket_no">
                      <div class="form-group row">
                        <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Project priority</label>
                        <div class="col-md-2 col-sm-9 col-xs-12">
                          <select name="prioritas" class="form-control form-control-line" id="prioritas">
                            <option disabled selected>Prioritas</option>
                            <option value="1">prioritas 1</option>
                            <option value="2">prioritas 2</option>
                            <option value="3">prioritas 3</option>
                          </select>
                        </div>
                        <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Deadline for sending Sample</label>
                        <div class="col-md-2 col-sm-9 col-xs-12">
                          <input type="date" class="form-control" name="jangka" id="jangka" placeholder="start date">
                        </div>
                        <div class="col-md-2 col-sm-9 col-xs-12">
                          <input type="date" class="form-control" name="waktu" id="waktu" placeholder="end date">
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
              <button class="btn btn-info" data-toggle="modal" data-target="#approve{{$pdf->id_pdf}}{{$pdf->turunan}}"><i class="fa fa-paper-plane"></i> Ajukan PDF</a></button>
            	<!-- modal -->
              <div class="modal" id="approve{{$pdf->id_pdf}}{{$pdf->turunan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title text-left" id="exampleModalLabel">Ajukan Project
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></h3>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal form-label-left" method="POST" action="{{ url('emailpdf',['pdf_id' => $pdf->id_project_pdf, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan]) }}" novalidate>
                      <div class="form-group row">
                        <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Email</label>
                        <div class="col-md-9 col-sm-10 col-xs-12">
                          <input id="email" class="form-control " type="email" name="email" required>
                          <input type="hidden" value="Pengajuan pdf" name="judul" id="judul">
                          <input type="hidden" value="{{auth()->user()->email}}" name="pengirim" id="pengirim">
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
            @elseif($pdf->status_data=="revisi")
              @if(auth()->user()->role->namaRule === 'pv_global')
              <button class="btn btn-primary" data-toggle="modal" data-target="#revisi{{ $pdf->id_project_pdf  }}"><i class="fa fa-paper-plane"></i> Sent</a></button>
              <!-- Modal -->
              <div class="modal" id="revisi{{ $pdf->id_project_pdf  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title text-left" id="exampleModalLabel">Sent PDF
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button></h3>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal form-label-left" method="POST" action="{{ Route('sentpdf',['pdf_id' => $pdf->id_project_pdf, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan])}}" novalidate>
                      <div class="form-group row">
                        <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Pilih Departement</label>
                        <div class="col-md-5 col-sm-9 col-xs-12">
                          <select name="kirim" class="form-control form-control-line" id="kirim">
                            <option value="{{$pdf->tujuankirim}}">{{$pdf->departement->dept}}</option>
                            @foreach($dept1 as $dept)
                            <option value="{{$dept->id}}">{{ $dept->dept }} ({{ $dept->nama_dept }})</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <select name="rka" class="form-control form-control-line" id="rka">
                            <option value="1">RKA</option>
                            <option value="0">Tidak Ada</option>
                          </select>
                        </div>
                      </div>
                      <input type="hidden" value="{{$pdf->pdf_number}}" name="nopdf" id="nopdf">
                      <?php $tanggal = Date("Y"); ?>
                      <input type="hidden" value="_{{$tanggal}}/PDF_{{ $pdf->project_name }}_{{ $pdf->revisi }}.{{ $pdf->turunan }}" name="ket_no" id="ket_no">
                      <div class="form-group row">
                        <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Project priority</label>
                        <div class="col-md-2 col-sm-9 col-xs-12">
                          <select name="prioritas" class="form-control form-control-line" id="prioritas">
                            <option value="{{$pdf->prioritas}}" readonly>
                              @if($pdf->prioritas==1) prioritas 1
                              @elseif($pdf->prioritas==2) prioritas 2
                              @elseif($pdf->prioritas==3) prioritas 3 @endif
                            </option>
                            <option value="1">prioritas 1</option>
                            <option value="2">prioritas 2</option>
                            <option value="3">prioritas 3</option>
                          </select>
                        </div>
                        <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Deadline for sending Sample</label>
                        <div class="col-md-2 col-sm-9 col-xs-12">
                          <input type="date" class="form-control" value="{{$pdf->jangka}}" name="jangka" id="jangka" placeholder="start date">
                        </div>
                        <div class="col-md-2 col-sm-9 col-xs-12">
                          <input type="date" class="form-control" value="{{$pdf->waktu}}" name="waktu" id="waktu" placeholder="end date">
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
            @elseif($pdf->status_project=='revisi')
              @if(auth()->user()->role->namaRule === 'marketing' || auth()->user()->role->namaRule === 'pv_global')
                @if($pengajuanpdf!=0)
                <a class="btn btn-info" onclick="return confirm('Naik Versi PDF ?')" href="{{Route('naikversipdf',['id_project_pdf' => $pdf->id_project_pdf, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan])}}"><i class="fa fa-arrow-up"></i> Up Version</a>
                @endif
              @endif
            @endif
            <a class="btn btn-warning" onclick="return confirm('Print Data PDF ini ?')" href="{{ Route('downloadpdf',['id_project_pdf' => $pdf->id_project_pdf, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan]) }}"><li class="fa fa-print"></li> Download/print PDF</a>
            <a class="btn btn-danger" href="{{ route('rekappdf',$pdf->id_project_pdf)}}"><i class="fa fa-share"></i>Kembali</a>
          </div>
          <div class="tab-content panel ">
            <div class="tab-pane active" id="1">
              @php $no = 0; @endphp
              <div class="panel-default badan">
								<div class="panel-body badan"  style="background-image:url(img/aul.jpg);">
                  <table class="table table-bordered" style="font-size:12px">
                    <thead style="background-color:#e22b3c;font-weight: bold;color:white;font-size: 20px;">
                      <tr><th style="width:5%" class="text-center">PRODUCT DEVELOPMENT FORM</th></tr>
                      <tr><th style="width:5%" class="text-center">( PDF )</th></tr>
                    </thead>
									</table>
									<center> <h2 style="font-weight: bold;">[ {{ $pdf->id_brand }} ] &reg;</h2> </center><hr style="color:black;">
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
                    <div class="col-sm-12">
                      @if($pdf->status_project=='draf')
                      <table width="100%" class="table table-bordered">
                        <thead>
                          <tr>
                            <td>Target market</td>
                            <td colspan="2">
													    <table>
                                <tr><?php $dariusia = []; foreach ($pdf1 as $key => $data) If (!$dariusia || !in_array($data->dariusia, $dariusia)) { $dariusia += array( $key => $data->dariusia );
                                if($data->turunan!=$pdf->turunan){ echo"Age : <s><font color='#6594c5'>$data->dariusia To $data->sampaiusia </font><br></s>"; } if($data->turunan==$pdf->turunan){ echo"Age : $data->dariusia To $data->sampaiusia <br>"; } }?></tr>
													      <tr><?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses );if($data->turunan!=$pdf->turunan){
                                echo"SES : <s><font color='#6594c5'>$data->ses </font><br></s>"; } if($data->turunan==$pdf->turunan){ echo"SES : $data->ses <br>";} } ?></tr>
														    <tr><?php $gender = []; foreach ($pdf1 as $key => $data) If (!$gender || !in_array($data->gender, $gender)) { $gender += array( $key => $data->gender );
                                if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'> Gender : $data->gender </font><br></s>"; }  if($data->turunan==$pdf->turunan){  echo"Gender : $data->gender <br>";} }  ?></tr>
                                <tr><?php $other = []; foreach ($pdf1 as $key => $data) If (!$other || !in_array($data->other, $other)) { $other += array( $key => $data->other );
                                if($data->turunan!=$pdf->turunan){ echo"other : <s><font color='#6594c5'>$data->other </font><br></s>"; } if($data->turunan==$pdf->turunan){ echo"other : $data->other <br>"; } }?></tr>
                              </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Background / Insight</td>
                            <td><?php $background = []; foreach ($pdf1 as $key => $data) If (!$background || !in_array($data->background , $background )) { $background += array( $key => $data->background );
                            if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'>$data->background </font><br></s>"; } if($data->turunan==$pdf->turunan){ echo"$data->background <br>"; } }?></td>
                          </tr>
                          <tr>
                            <td>Attracttiveness</td>
                            <td colspan="2"><?php $attractiveness = []; foreach ($pdf1 as $key => $data) If (!$attractiveness || !in_array($data->attractiveness, $attractiveness)) { $attractiveness += array( $key => $data->attractiveness );
                            if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>$data->attractiveness <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"$data->attractiveness <br>";} }  ?></td>
                          </tr>
                          <tr>
                            <td>Target RTO</td>
                            <td colspan="2"><?php $rto = []; foreach ($pdf1 as $key => $data) If (!$rto || !in_array($data->rto, $rto)) { $rto += array( $key => $data->rto );
                            if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>$data->rto </font><br></s>"; } if($data->turunan==$pdf->turunan){ echo"$data->rto <br>"; } } ?></td>
                          </tr>
                          <tr>
                            <td>Sales Forecast</td>
                            <td colspan="2"><?php $seles = []; foreach ($for as $key => $data) If (!$seles || !in_array($data->forecast, $seles)) { $seles += array( $key => $data->forecast ); 
                            if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'>".$data->satuan ."=". $data->forecast."<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" $data->satuan = $data->forecast <br>";  } } ?></td>
											    </tr>
                          <tr>
                            <td>Competitor</td>
                            <td colspan="2">
                            <table>
                              <tr><th style="border:none;"><?php $name = []; foreach ($pdf1 as $key => $data) If (!$name || !in_array($data->name, $name)) { $name += array( $key => $data->name );
                              if($data->turunan!=$pdf->turunan){ echo"Nama : <s><font color='#6594c5'>$data->name <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"Nama : $data->name <br>"; } } ?></th></tr>
													    <tr><th style="border:none;"><?php $retailer_price = []; foreach ($pdf1 as $key => $data) If (!$retailer_price || !in_array($data->retailer_price, $retailer_price)) { $retailer_price += array( $key => $data->retailer_price );
                              if($data->turunan!=$pdf->turunan){ echo"retailer price : <s><font color='#6594c5'>$data->retailer_price<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"retailer price : $data->retailer_price<br>"; } } ?></th></tr>
													    <tr><th style="border:none;"><?php $special = []; foreach ($pdf1 as $key => $data) If (!$special || !in_array($data->special, $special)) { $special += array( $key => $data->special );
                              if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'>What's Special :$data->special <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" What's Special: $data->special <br>"; } } ?></tr>
													    <tr><th style="border:none;">File </th><th style="border:none;"> 
                              @foreach($picture as $pic): {{$pic->filename}} <a href="{{ Storage::url($pic->lokasi)}}" download="{{$pic->filename}}"><button class="btn btn-primary btn-sm"><li class="fa fa-download"></li></button></a><br>@endforeach</th></tr>
													  </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Product Concept</td>
                            <td colspan="2">
													    <table>
                                <tr><th style="border:none;">Weight/Serving </th><th style="border:none;"><?php $wight = []; foreach ($pdf1 as $key => $data) If (!$wight || !in_array($data->wight, $wight)) { $wight += array( $key => $data->wight );
                                if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>: $data->wight/$data->serving<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo": $data->wight/$data->serving<br>"; } } ?></th></tr>
														    <tr><th style="border:none;"><?php $target_price = [];foreach ($pdf1 as $key => $data)If (!$target_price || !in_array($data->target_price, $target_price)) { $target_price += array($key => $data->target_price);
                                if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'>Target NFI price / ctn : $data->target_price<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"Target NFI price / ctn  : $data->target_price<br>"; } } ?></th></tr>
														    <tr><th style="border:none;"><?php $claim = []; foreach ($pdf1 as $key => $data) If (!$claim || !in_array($data->claim, $claim)) { $claim += array( $key => $data->claim );
                                if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>Claim / function :$data->claim <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"Claim / function : $data->claim <br>"; } } ?></th></tr>
														    <tr><th style="border:none;"><?php $ingredient = []; foreach ($pdf1 as $key => $data) If (!$ingredient || !in_array($data->ingredient, $ingredient)) { $ingredient += array( $key => $data->ingredient );
                                if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>Special Ingredient :$data->ingredient <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"Special Ingredient : $data->ingredient <br>"; } } ?></th></tr>
													    </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Product Concept</td>
                            <td colspan="2">
													    <table>
                              @if($pdf->datappdf->kemas_eksis!=NULL)
                              <?php $eksis = []; foreach ($pdf1 as $key => $data) If (!$eksis || !in_array($data->kemas->nama, $eksis)) { $eksis += array( $key => $data->kemas->nama ); 
                              if($data->turunan!=$pdf->turunan){ echo": <s><font color='#6594c5'>".$data->kemas->nama."<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo $data->kemas->nama."<br>"; } }  ?>
                              (
                                @if($pdf->datappdf->kemas->primer!=NULL)
														    {{ $pdf->datappdf->kemas->primer }}{{ $pdf->datappdf->kemas->s_primer }} </tr>
														    @elseif($pdf->datappdf->kemas->primer==NULL)
														    @endif

														    @if($pdf->datappdf->kemas->sekunder1!=NULL)
														    X {{ $pdf->datappdf->kemas->sekunder1 }}{{ $pdf->datappdf->kemas->s_sekunder1}} </tr>
														    @elseif($pdf->datappdf->kemas->sekunder1==NULL)
														    @endif

														    @if($pdf->datappdf->kemas->sekunder2!=NULL)
														    X {{ $pdf->datappdf->kemas->sekunder2 }}{{ $pdf->datappdf->kemas->s_sekunder2 }} </tr>
														    @elseif($pdf->sekunder2==NULL)
														    @endif

														    @if($pdf->datappdf->kemas->tersier!=NULL)
														    X {{ $pdf->datappdf->kemas->tersier }}{{ $pdf->datappdf->kemas->s_tersier }} </tr>
														    @elseif($pdf->datappdf->tersier==NULL)
														    @endif
                              )
                              @elseif($pdf->datappdf->primer==NULL)
                                @if($pdf->datappdf->kemas_eksis==NULL)
                                @endif
                              @endif <br>
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
                      @elseif($pdf->status_project!='draf')
                      <table width="100%" class="table table-bordered">
                        <thead>
                          <tr>
                            <td>Target market</td>
                            <td colspan="2">
													  <table>
                              <tr><?php $dariusia = []; foreach ($pdf2 as $key => $data) If (!$dariusia || !in_array($data->dariusia, $dariusia)) { $dariusia += array( $key => $data->dariusia );
                              if($data->revisi!=$pdf->revisi){ echo"Age: <s><font color='red'>$data->dariusia To $data->sampaiusia </font><br></s>"; } if($data->revisi==$pdf->revisi){ echo"Age : $data->dariusia To $data->sampaiusia<br>"; } }?></tr>
													    <tr><?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses );if($data->revisi!=$pdf->revisi){
                              echo"SES : <s><font color='red'>$data->ses </font><br></s>"; } if($data->revisi==$pdf->revisi){ echo"SES : $data->ses <br>";} } ?></tr>
														  <tr><?php $gender = []; foreach ($pdf2 as $key => $data) If (!$gender || !in_array($data->gender, $gender)) { $gender += array( $key => $data->gender );
                              if($data->revisi!=$pdf->revisi){ echo"<s><font color='red'> Gender : $data->gender </font><br></s>"; }  if($data->revisi==$pdf->revisi){  echo"Gender : $data->gender <br>";} }  ?></tr>
													    <tr><?php $other = []; foreach ($pdf2 as $key => $data) If (!$other || !in_array($data->other, $other)) { $other += array( $key => $data->other );
                              if($data->revisi!=$pdf->revisi){ echo"other : <s><font color='red'>".$data->other ."</font><br></s>"; } if($data->revisi==$pdf->revisi){ echo"other : $data->other <br>"; } }?></tr>
                            </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Background / Insight</td>
                            <td><?php $background = []; foreach ($pdf2 as $key => $data) If (!$background || !in_array($data->background , $background )) { $background += array( $key => $data->background );
                            if($data->revisi!=$pdf->revisi){ echo" <s><font color='red'>$data->background <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"$data->background <br>"; } }?></td>
                          </tr>
                          <tr>
                            <td>Attracttiveness</td>
                            <td colspan="2"><?php $attractiveness = []; foreach ($pdf2 as $key => $data) If (!$attractiveness || !in_array($data->attractiveness, $attractiveness)) { $attractiveness += array( $key => $data->attractiveness );
                            if($data->revisi!=$pdf->revisi){ echo"<s><font color='red'>$data->attractiveness <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"$data->attractiveness <br>";} }  ?></td>
                          </tr>
                          <tr>
                            <td>Target RTO</td>
                            <td colspan="2"><?php $rto = []; foreach ($pdf2 as $key => $data) If (!$rto || !in_array($data->rto, $rto)) { $rto += array( $key => $data->rto );
                            if($data->revisi!=$pdf->revisi){ echo"<s><font color='red'>$data->rto <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"$data->rto <br>"; } } ?></td>
                          </tr>
                          <tr>
                            <td>Sales Forecast</td>
                            <td colspan="2"><?php $seles = []; foreach ($for as $key => $data) If (!$seles || !in_array($data->forecast, $seles)) { $seles += array( $key => $data->forecast ); 
                            if($data->revisi!=$pdf->revisi){ echo" <s><font color='#ffa2a2'>$data->satuan = $data->forecast<br></font></s>"; } if($data->revisi==$pdf->revisi){ echo" $data->satuan = $data->forecast <br>";  } } ?></td>
											    </tr>
                          <tr>
                            <td>Competitor</td>
                            <td colspan="2">
                              <table>
                                <tr><th style="border:none;"><?php $name = []; foreach ($pdf2 as $key => $data) If (!$name || !in_array($data->name, $name)) { $name += array( $key => $data->name );
                                if($data->revisi!=$pdf->revisi){ echo"Nama : <s><font color='red'>$data->name </font><br></s>"; } if($data->revisi==$pdf->revisi){ echo"Nama : $data->name <br>"; } } ?></th></tr>
													      <tr><th style="border:none;"><?php $retailer_price = []; foreach ($pdf2 as $key => $data) If (!$retailer_price || !in_array($data->retailer_price, $retailer_price)) { $retailer_price += array( $key => $data->retailer_price );
                                if($data->revisi!=$pdf->revisi){ echo"retailer price : <s><font color='red'>$data->retailer_price<br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"retailer price : $data->retailer_price<br>"; } } ?></th></tr>
													      <tr><th style="border:none;"><?php $special = []; foreach ($pdf2 as $key => $data) If (!$special || !in_array($data->special, $special)) { $special += array( $key => $data->special );
                                if($data->revisi!=$pdf->revisi){ echo" <s><font color='red'>What's Special :$data->special <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo" What's Special: $data->special <br>"; } } ?></tr>
													      <tr><th style="border:none;">File </th><th style="border:none;"> 
                                @foreach($picture as $pic): {{$pic->filename}} <a href="{{ Storage::url($pic->lokasi)}}" download="{{$pic->filename}}"><button class="btn btn-primary btn-sm"><li class="fa fa-download"></li></button></a><br>@endforeach</th></tr>
													    </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Product Concept</td>
                            <td colspan="2">
													    <table>
                                <tr><th style="border:none;">Weight/Serving </th><th style="border:none;"><?php $wight = []; foreach ($pdf1 as $key => $data) If (!$wight || !in_array($data->wight, $wight)) { $wight += array( $key => $data->wight );
                                if($data->turunan!=$pdf->turunan){ echo"Nama : <s><font color='#6594c5'>$data->wight/$data->serving<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"Nama : $data->wight/$data->serving<br>"; } } ?></th></tr>
														    <tr><th style="border:none;"><?php $target_price = [];foreach ($pdf2 as $key => $data)If (!$target_price || !in_array($data->target_price, $target_price)) { $target_price += array($key => $data->target_price);
                                if($data->revisi!=$pdf->revisi){ echo" <s><font color='red'>Target NFI price / ctn : $data->target_price<br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"Target NFI price / ctn  : $data->target_price<br>"; } } ?></th></tr>
														    <tr><th style="border:none;"><?php $claim = []; foreach ($pdf2 as $key => $data) If (!$claim || !in_array($data->claim, $claim)) { $claim += array( $key => $data->claim );
                                if($data->revisi!=$pdf->revisi){ echo"<s><font color='red'>Claim / function :$data->claim <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"Claim / function : $data->claim <br>"; } } ?></th></tr>
														    <tr><th style="border:none;"><?php $ingredient = []; foreach ($pdf2 as $key => $data) If (!$ingredient || !in_array($data->ingredient, $ingredient)) { $ingredient += array( $key => $data->ingredient );
                                if($data->revisi!=$pdf->revisi){ echo"<s><font color='red'>Special Ingredient :$data->ingredient <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"Special Ingredient : $data->ingredient <br>"; } } ?></th></tr>
													    </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Product Concept</td>
                            <td colspan="2">
													    <table>

                              @if($pdf->datappdf->kemas_eksis!=NULL)
                              <?php $eksis = []; foreach ($pdf1 as $key => $data) If (!$eksis || !in_array($data->kemas->nama, $eksis)) { $eksis += array( $key => $data->kemas->nama ); 
                              if($data->turunan!=$pdf->turunan){ echo": <s><font color='#6594c5'>".$data->kemas->nama."<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo $data->kemas->nama."<br>"; } }  ?>
                                (
                                @if($pdf->datappdf->kemas->primer!=NULL)
														    {{ $pdf->datappdf->kemas->primer }}{{ $pdf->datappdf->kemas->s_primer }} </tr>
														    @elseif($pdf->datappdf->kemas->primer==NULL)
														    @endif

														    @if($pdf->datappdf->kemas->sekunder1!=NULL)
														    X {{ $pdf->datappdf->kemas->sekunder1 }}{{ $pdf->datappdf->kemas->s_sekunder1}} </tr>
														    @elseif($pdf->datappdf->kemas->sekunder1==NULL)
														    @endif

														    @if($pdf->datappdf->kemas->sekunder2!=NULL)
														    X {{ $pdf->datappdf->kemas->sekunder2 }}{{ $pdf->datappdf->kemas->s_sekunder2 }} </tr>
														    @elseif($pdf->sekunder2==NULL)
														    @endif

														    @if($pdf->datappdf->kemas->tersier!=NULL)
														    X {{ $pdf->datappdf->kemas->tersier }}{{ $pdf->datappdf->kemas->s_tersier }} </tr>
														    @elseif($pdf->datappdf->tersier==NULL)
														    @endif
                                )
                              @elseif($pdf->datappdf->primer==NULL)
                                @if($pdf->datappdf->kemas_eksis==NULL)
                                @endif
                              @endif <br>
                              <?php $primery = []; foreach ($pdf2 as $key => $data) If (!$primery || !in_array($data->primery, $primery)) { $primery += array( $key => $data->primery );} ?>
														  <tr><th style="border:none;">Primary Information</th><th style="border:none;"> @foreach($primery as $primery): {{$primery}}<br> @endforeach</th></tr>
														  <?php $secondery = []; foreach ($pdf2 as $key => $data) If (!$secondery || !in_array($data->secondery, $secondery)) { $secondery += array( $key => $data->secondery );} ?>
                              <tr><th style="border:none;">Secondary Information</th><th style="border:none;"> @foreach($secondery as $secondery): {{$secondery}}<br> @endforeach</th></tr>
														  <?php $Tertiary = [];foreach ($pdf2 as $key => $data) If (!$Tertiary || !in_array($data->Tertiary, $Tertiary)) { $Tertiary += array( $key => $data->Tertiary );} ?>
                              <tr><th style="border:none;">Tertiary Information</th><th style="border:none;"> @foreach($Tertiary as $Tertiary): {{$Tertiary}}<br> @endforeach</th></tr>
													    </table>
												    </td>
                          </tr>
                        </thead>
                      </table>
                      @endif
                      @endforeach
                    </div>
                  </div>
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
