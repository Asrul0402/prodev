@extends('formula.tempformula')
@section('title', 'Detail Formula')
@section('judul', 'Detail Formula')
@section('content')

</style>
<div class="card">
  <div class="card-header">
    <h5>FORMULA</h5>
  </div><br>
  <div class="card-block">
		<div class="panel panel-default">
			<div class="panel-body">
        <div id="exTab2" class="container">	
					<ul class="nav nav-tabs  tabs" role="tablist">
						<li class="nav-item"><a class="nav-link  active"  href="#1" data-toggle="tab"><i class="fa fa-list"></i> Formula</a></li>
						<li class="nav-item"><a class="nav-link" href="#2" data-toggle="tab"><i class="fa fa-clipboard"></i> Nutfact</a></li>
						<li class="nav-item"><a class="nav-link" href="#3" data-toggle="tab"><i class="fa fa-usd"></i> HPP Formula</a></li>
        	</ul><br>
          <div class="tab-content ">
            <div class="tab-pane active" id="1">
            @php
                $no = 0;
            @endphp 
            @if ($ada > 0)
              <div class="panel-default">	
								<div class="panel-body badan">
									<label>PT NUTRIFOOD INDONESIA</label>
									<table ALIGN="right">
										<tr>
											<th class="text-right">KODE FORM : F.R.15003</th>
										</tr>
									</table>		
									<center> <h2 style="font-size: 22px;font-weight: bold;">FORMULA PRODUK</h2> </center>
									<center> <h2 style="font-size: 20px;font-weight: bold;">( FOR )</h2> </center>
									<button type="button" class=" btn-primary btn-lg" ALIGN="center">PRODUKSI DI PLANT  A</button>								
									
									<table class="col-md-5 col-sm- col-xs-12">
										<tr>
											<th width="10%">Nama Produk </th>
											<th width="45%">: {{ $formula->nama_produk }}</th>
										<tr>
											<th width="10%">No. Formula</th>
											<th width="45%">: {{ $formula->kode_formula }}</th>
										<tr>
											<th width="10%">Revisi</th>
											<th width="45%">: {{ $formula->revisi }}</th>
										</tr>
										<tr>
											<th width="10%">Gd. Baku | IO</th>
											<th width="45%">:</th>
										</tr>
										<br><br>
									</table>
					
									<table ALIGN="right">
										<tr><th class="text-right">Tanggal : {{ $formula->created_at}} </th></tr>
										<tr><th class="text-right">jumlah/batch : {{ $formula->batch }}  g</th></tr>
									</table><br><br>
					
									<table class="table">
										<thead>
											<tr style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd">  
												<th class="text-center">No Urut</th>
												<th class="text-center">kode komputer bahan</th>
												<th class="text-center">Nama Sederhana</th>
												<th class="text-center">Nama bahan</th>
												<th class="text-center">Per Batch (Gr) </th>
												<th class="text-center">Per Serving (Gr) </th>
												<th class="text-center">%</th>
											</tr>
										</thead>
										<tbody>
											{{-- Non Granulasi --}}
											<?php $no = 0;?>
          						@foreach ($detail_formula->sortByDesc('per_batch') as $fortail)
											<?php $no++ ;?>
          						@if ($fortail['granulasi'] == 'tidak')
          						<tr>
          						  <td>{{ $no }}</td>
          						  <td>{{ $fortail['kode_komputer'] }}</td>
          						  <td>{{ $fortail['nama_sederhana'] }}</td>
          						  <td>{{ $fortail['nama_bahan'] }}</td>
          						  <td>{{ $fortail['per_batch'] }}</td>
          						  <td>{{ $fortail['per_serving'] }}</td>
          						  <td>{{ $fortail['persen'] }} &nbsp;%</td>
          						</tr>                                                        
											@endif
          						@endforeach
          						{{-- Granulasi --}}
											<tr style="background-color:#eaeaea;color:grey">
          						  <td colspan="7">Granulasi &nbsp;  % &nbsp; {{ $gp }}</td>                                            
          						</tr>
											<?php $no = 0;?>
          						@foreach ($detail_formula->sortByDesc('per_batch') as $fortail)
											<?php $no++ ;?>
          						@if ($fortail['granulasi'] == 'ya')
          						<tr>
          						  <td>{{ $no }}</td>
          						  <td>{{ $fortail['kode_komputer'] }}</td>
          						  <td>{{ $fortail['nama_sederhana'] }}</td>
          						  <td>{{ $fortail['nama_bahan'] }}</td>
          						  <td class="text-left">{{ $fortail['per_batch'] }}</td>
          						  <td>{{ $fortail['per_serving'] }}</td>
          						  <td class="text-right">{{ $fortail['persen'] }} &nbsp;</td>
          						</tr>                                                        
          						@endif
          						@endforeach
											<tr style="font-size: 12px;font-weight: bold; color:black;background-color: rgb(78, 205, 196, 0.5);">
												<td colspan="4" class="text-center">Total</td>
												<td class="text-center">{{ $formula->batch }}</td>
          						  <td class="text-center">{{ $formula->serving }}</td>
          						  <td class="text-center"> 100 % </td>
											</tr>
										</tbody>
									</table>
					
									<table ALIGN="right" class="table-bordered">
										<thead>
											<tr>
												<th class="text-center" colspan="2">Dibuat Oleh :</th>
												<th class="text-center">Mengetahui  *): </th>
											</tr>
										</thead>
										<tbody>
											<tr class="text-center">
												<td class="text-center"><br><br><br><br><br></td>
												<td class="text-center"><br><br><br><br><br></td>
											</tr>
											<tr>
												<td class="text-center" width="35%">RD Sourcing</td>
												<td class="text-center" width="45%">RD Sourcing Asso Mgr</td>
												<td class="text-center">RPE Manager</td>
											</tr>
										</tbody>
									</table><br><br><br><br><br><br><br><br>

            			<table ALIGN="right">
            			<tr><td>Revisi/Berlaku : {{ $formula->created_at }} </td></tr>
            			<tr><td>Masa Berlaku : Selamanya</td></tr>
            			</table>

            			<table><tr>*) Ditandatangani jika perubahan formula berasal/ diajukan oleh RD sourcing</tr></table>
								</div>
							</div>
              @endif
            </div>
            <div class="tab-pane" id="2">
							<div class="row">
    						<div class="col-md-12">
        					<div class="panel">
            				<div class="panel-body">    
                    {{--DATA FORMULA YANG DIPILIH--}}
                    @foreach($data as $datas)
                    @endforeach
                			<div class="accordion" id="accordionExample">
                    		{{--LIST INGREDIENT--}}
                    		<div class="panel panel-info">
                          <div class="panel-heading" id="headingOne">
                            <h5 class="mb-0">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseTwo">
                              <b>LIST INGREDIENT</b></button>
                          	</h5>
                          </div>
                        	<div aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="panel-body" style="overflow-x: scroll;">
                            <table class="table table-advanced">
                              <thead>
                                <tr>
                                  <th rowspan="2"  class="text-center" style="width: 5%; background-color:#d8d0d2;">No</th>
                                  <th rowspan="2"  class="text-center" style="background-color:#d8d0d2;">Nama Sederhana</th>
                                  <th colspan="2"  class="text-center" style="background-color:#d8d0d2;">BTP Carry Over</th>
                                  <th rowspan="2"  class="text-center" style="background-color:#d8d0d2;">Dosis</th>
                                  <th rowspan="2"  class="text-center" style="background-color:#d8d0d2;">%</th>
                                  <th colspan="39" class="text-center" style="background-color:#54ff54;">Nutrition Data</th>
                                </tr>
                                <tr>
                                  <th class="text-center" style="background-color:#d8d0d2;">All Carry Over</th>
                                  <th class="text-center" style="background-color:#d8d0d2;">Carry Over dicantumkan dalam penulisan ing list</th>
                                  <th class="text-center" style="background-color:#54ffba;">Lemak</th>
                                  <th class="text-center" style="background-color:#54ffba;">SFA</th>
                                  <th class="text-center" style="background-color:#54ffba;">Karbohidrat</th>
                                  <th class="text-center" style="background-color:#54ffba;">Gula</th>
                                  <th class="text-center" style="background-color:#54ffba;">Laktosa</th>
                                  <th class="text-center" style="background-color:#54ffba;">Sukrosa</th>
                                  <th class="text-center" style="background-color:#54ffba;">Serat</th>
                                  <th class="text-center" style="background-color:#54ffba;">Serat Larut</th>
                                  <th class="text-center" style="background-color:#54ffba;">Protein</th>
                                  <th class="text-center" style="background-color:#54ffba;">Kalori</th>
                                  <th class="text-center" style="background-color:#54ffba;">Na (mg)</th>
                                  <th class="text-center" style="background-color:#54ffba;">K (mg)</th>
                                  <th class="text-center" style="background-color:#54ffba;">Ca (mg)</th>
                                  <th class="text-center" style="background-color:#54ffba;">Mg (mg)</th>
                                  <th class="text-center" style="background-color:#54ffba;">P (mg)</th>
                                  <th class="text-center" style="background-color:#54ffba;">Beta Glucan</th>  
                                  <th class="text-center" style="background-color:#54ffba;">Cr(mcg)</th>
                                  <th class="text-center" style="background-color:#54ffba;">Vit C (mg)</th>
                                  <th class="text-center" style="background-color:#54ffba;">Vit E (mg)</th>
                                  <th class="text-center" style="background-color:#54ffba;">Vit D (mg)</th>
                                  <th class="text-center" style="background-color:#54ffba;">Carnitin (mg)</th>
                                  <th class="text-center" style="background-color:#54ffba;">CLA (mg)</th>
                                  <th class="text-center" style="background-color:#54ffba;">Sterol Ester (mg)</th>
                                  <th class="text-center" style="background-color:#54ffba;">Chondroitin (mg)</th>
                                  <th class="text-center" style="background-color:#54ffba;">Omega 3</th>
                                  <th class="text-center" style="background-color:#54ffba;">DHA</th>
                                  <th class="text-center" style="background-color:#54ffba;">EPA</th>
                                  <th class="text-center" style="background-color:#54ffba;">Creatine</th>
                                  <th class="text-center" style="background-color:#54ffba;">Lysine</th>
                                  <th class="text-center" style="background-color:#54ffba;">Glucosamine (mg)</th>
                                  <th class="text-center" style="background-color:#54ffba;">Kolin </th>
                                  <th class="text-center" style="background-color:#54ffba;">MUFA</th>
                                  <th class="text-center" style="background-color:#54ffba;">Linoleic Acid (Omega 6)</th>
                                  <th class="text-center" style="background-color:#54ffba;">Linolenic Acid</th>
                                  <th class="text-center" style="background-color:#54ffba;">Sorbitol</th>
                                  <th class="text-center" style="background-color:#54ffba;">Maltitol</th>
                                  <th class="text-center" style="background-color:#54ffba;">Kafein</th>
                                  <th class="text-center" style="background-color:#54ffba;">Kolestrol</th>
                                </tr>
                            	</thead>
                            	<tbody>
                                @foreach($ing as $i)
                                <tr>
                                  <td class="text-center">1</td>
                                  <td class="text-center">{{$i->get_bahan->nama_sederhana}}</td>
                                  <td class="text-center">-</td>
                                  <td class="text-center">-</td>
                                  <td class="text-center"></td>
                                  <td class="text-center"></td>
                                  <td class="text-center">{{$i->Lemak}}</td>
                                  <td class="text-center">{{$i->SFA}}</td>
                                  <td class="text-center">{{$i->karbohidrat}}</td>
                                  <td class="text-center">{{$i->gula_total}}</td>
                                  <td class="text-center">{{$i->laktosa}}</td>
                                  <td class="text-center">{{$i->sukrosa}}</td>
                                  <td class="text-center">{{$i->serat}}</td>
                                  <td class="text-center">{{$i->serat_larut}}</td>
                                  <td class="text-center">{{$i->protein}}</td>
                                  <td class="text-center">{{$i->kalori}}</td>
                                  <td class="text-center">{{$i->na}}</td>
                                  <td class="text-center">{{$i->k}}</td>
                                  <td class="text-center">{{$i->ca}}</td>
                                  <td class="text-center">{{$i->mg}}</td>
                                  <td class="text-center">{{$i->p}}</td>
                                  <td class="text-center">{{$i->beta_glucan}}</td>
                                  <td class="text-center">{{$i->cr}}</td>
                                  <td class="text-center">{{$i->vit_c}}</td>
                                  <td class="text-center">{{$i->vit_e}}</td>
                                  <td class="text-center">{{$i->vit_d}}</td>
                                  <td class="text-center">{{$i->carnitin}}</td>
                                  <td class="text-center">{{$i->cla}}</td>
                                  <td class="text-center">{{$i->sterol_ester}}</td>
                                  <td class="text-center">{{$i->chondroitin}}</td>
                                  <td class="text-center">{{$i->omega_3}}</td>
                                  <td class="text-center">{{$i->dha}}</td>
                                  <td class="text-center">{{$i->epa}}</td>
                                  <td class="text-center">{{$i->creatine}}</td>
                                  <td class="text-center">{{$i->lysine}}</td>
                                  <td class="text-center">{{$i->glucosamine}}</td>
                                  <td class="text-center">{{$i->kolin}}</td>
                                  <td class="text-center">{{$i->mufa}}</td>
                                  <td class="text-center">{{$i->linoleic_acido6}}</td>
                    	            <td class="text-center">{{$i->linoleic_acid}}</td>
                    	            <td class="text-center">{{$i->oleic_acid}}</td>
                    	            <td class="text-center">{{$i->sorbitol}}</td>
                    	            <td class="text-center">{{$i->maltitol}}</td>
                    	            <td class="text-center">{{$i->kafein}}</td>
                    	            <td class="text-center">{{$i->kolestrol}}</td>
                    	        	</tr>
                    	        	@endforeach
                    	    		</tbody>
                    	    		<tfoot>
                    	        	<tr style="background-color:#fff651;">
                    	            <td colspan="4" class="text-center"></td>
                    	            <td class="text-center"><h5><b></b></h5></td>
                                    <td class="text-center"><h5><b></b></h5></td>
                                    <td class="text-center"><h5><b>{{$i->sum('Lemak')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('SFA')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('karbohidrat')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('gula_total')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('laktosa')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('sukrosa')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('serat')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('serat_larut')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('protein')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('kalori')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('na')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('k')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('ca')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('mg')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('p')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('beta_glucan')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('cr')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('vit_c')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('vit_e')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('vit_d')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('carnitin')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('cla')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('sterol_ester')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('chondroitin')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('omega_3')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('dha')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('epa')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('creatine')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('lysine')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('glucosamine')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('kolin')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('mufa')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('linoleic_acido6')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('linoleic_acid')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('oleic_acid')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('sorbitol')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('maltitol')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('kafein')}}</h5></b></td>
                                    <td class="text-center"><h5><b>{{$i->sum('kolestrol')}}</h5></b></td>                                        
                                    <!-- <td class="text-center"><a href="url('nutrition')}}" class="btn btn-info btn-lg">Input Nutrition</a></td> -->
                                	</tr>
                                </tfoot>
                            	</table>
                            </div>
                        	</div>
                    		</div> 

                    		{{--CCT FORMAT & NUTFACT BAYANGAN--}}
                    		<div class="panel panel-info">
                        	<div class="panel-heading" id="headingTwo">
                            <h5 class="mb-0">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              <b>CCT FORMAT & NUTFACT</b>
                              </button>
                            </h5>
                        	</div>
                        	<div aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="panel-body">
                            	<div class="col-md-6">
                                <table style="background-color:lightblue;" class="table table-hover table-condensed table-bordered">
                                  <thead>
                                    <tr style="background-color: black;color: white;">
                                      <th class="text-center">Parameter</th>
                                      <th class="text-center">Gramasi</th>
                                      <th class="text-center">unit</th>
                                      <th class="text-center">%AKG</th>
                                      <th class="text-center">AKG</th>
                                      <th class="text-center">unit</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr class="" style=" color: black;">
                                      <td>Energi Total</td>
                                      <td class="text-right">{{number_format($i->sum('kalori'),3)}}</td>
                                      <td class="text-center">kkal</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">kkal</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Energi Dari Lemak</td>
                                      <td class="text-right">{{number_format($i->sum('Lemak')*9,3)}}</td>
                                      <td class="text-center">kkal</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">kkal</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Energi Dari Lemak Jenuh</td>
                                      <td class="text-right">{{number_format($i->sum('SFA')*9,3)}}</td>
                                      <td class="text-center">kkal</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">kkal</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Karbohidrat Total</td>
                                      <td class="text-right">{{number_format($i->sum('karbohidrat'),3)}}</td>
                                      <td class="text-center">g</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">325</td>
                                      <td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Protein</td>
                                      <td class="text-right">{{number_format($i->sum('protein'),3)}}</td>
                                      <td class="text-center">g</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">60</td>
                                      <td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Lemak Total</td>
                                      <td class="text-right">{{number_format($i->sum('Lemak'),3)}}</td>
                                      <td class="text-center">g</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">67</td>
                                      <td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Lemak Trans</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Lemak Jenuh</td>
                                      <td class="text-right">{{number_format($i->sum('SFA'),3)}}</td>
                                      <td class="text-center">g</td>
                                      <td class="text-right">{{number_format($i->sum('SFA')*100/20,3)}}</td>
                                      <td class="text-right">20</td>
                                      <td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Lemak Tidak Jenuh Tunggal</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Lemak Tidak Jenuh Ganda</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Kolestrol</td>
                                      <td class="text-right">{{number_format($i->sum('kolestrol'),3)}}</td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">300</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Gula</td>
                                      <td class="text-right">{{number_format($i->sum('gula_total'),3)}}</td>
                                      <td class="text-center">g</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Serat Pangan</td>
                                      <td class="text-right">{{number_format($i->sum('serat'),3)}}</td>
                                      <td class="text-center">g</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">30</td>
                                      <td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Serat Pangan Larut</td>
                                      <td class="text-right">{{number_format($i->sum('serat_larut'),3)}}</td>
                                      <td class="text-center">g</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Serat Pangan Tidak Larut</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center"></td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                    	<td>Sukrosa</td>
                                    	<td class="text-right">{{number_format($i->sum('sukrosa'),3)}}</td>
                                    	<td class="text-center">g</td>
                                    	<td class="text-right"></td>
                                    	<td class="text-right"></td>
                                    	<td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                    	<td>Laktosa</td>
                                    	<td class="text-right">{{number_format($i->sum('laktosa'),3)}}</td>
                                    	<td class="text-center">g</td>
                                    	<td class="text-right"></td>
                                    	<td class="text-right"></td>
                                    	<td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                    	<td>Gula Alkohol</td>
                                    	<td class="text-right"></td>
                                    	<td class="text-center">g</td>
                                    	<td class="text-right"></td>
                                    	<td class="text-right"></td>
                                    	<td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Natrium</td>
                                      <td class="text-right">{{number_format($i->sum('na'),3)}}</td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right">{{number_format($i->sum('na')*100/1500,3)}}</td>
                                      <td class="text-right">1500</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Kalium</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">4700</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Kalsium</td>
                                      <td class="text-right">{{number_format($i->sum('ca'),3)}}</td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right">{{number_format($i->sum('ca')*100/1100,3)}}</td>
                                      <td class="text-right">1100</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Zat Besi</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">22</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Fosfor</td>
                                      <td class="text-right">{{number_format($i->sum('p'),3)}}</td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right">{{number_format($i->sum('p')*100/700,3)}}</td>
                                      <td class="text-right">700</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Magnesium</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">350</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Seng</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>    
                                      <td class="text-right">13</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Selenium</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mcg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">30</td>
                                      <td class="text-center">mcg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Lodium</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">150</td>
                                      <td class="text-center">mcg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Mangan</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">2000</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Flour</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">2.5</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Tembaga</td>
                                      <td class="text-right"></td>
                                      <td class="text-center"></td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center"></td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Vitamin A</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">IU</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">1980</td>
                                      <td class="text-center">IU</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Vitamin B1</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">1.4</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Vitamin B2</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">1.6</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Vitamin B3</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">15</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Vitamin B5</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">5</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Vitamin B6</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">1.3</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Vitamin B12</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mcg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">2.4</td>
                                      <td class="text-center">mcg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Vitamin C</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">90</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Vitamin D3</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">IU</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">400</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <td class="text-center">IU</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Vitamin E</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">15</td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Asam Folat</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mcg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right">400</td>
                                      <td class="text-center">mcg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Magnesium Aspartat</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Kolin</td>
                                      <td class="text-right">{{number_format($i->sum('kolin'),3)}}</td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Biotin</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mcg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mcg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Inositol</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Molibdenum</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mcg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mcg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Kromium</td>
                                      <td class="text-right">{{number_format($i->sum('cr'),3)}}</td>
                                      <td class="text-center">mcg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mcg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>EPA</td>
                                      <td class="text-right">{{number_format($i->sum('EPA'),3)}}</td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>DHA</td>
                                      <td class="text-right">{{number_format($i->sum('DHA'),3)}}</td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Glukosamin</td>
                                      <td class="text-right">{{number_format($i->sum('glucosamine'),3)}}</td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Kondroitin</td>
                                      <td class="text-right">{{number_format($i->sum('chondroitin'),3)}}</td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Kolagen</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>EGCG</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Kreatina</td>
                                      <td class="text-right">{{number_format($i->sum('creatine'),3)}}</td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>MCT</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>CLA</td>
                                      <td class="text-right">{{number_format($i->sum('CLA'),3)}}</td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Omega 3</td>
                                      <td class="text-right">{{number_format($i->sum('omega_3'),3)}}</td>
                                      <td class="text-center">g</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Omega 6</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Omega 9</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Klorida</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Asam Linoleat</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">g</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Energi dari Asam Linoleat</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">kkal</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">kkal</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Energi dari Protein</td>
                                      <td class="text-right">{{number_format($i->sum('protein')*4,3)}}</td>
                                      <td class="text-center">kkal</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">kkal</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>L-Karnitin</td>
                                      <td class="text-right">{{number_format($i->sum('carnitin'),3)}}</td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>L-Glutamin</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>**Thereonin</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>**Methionin</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>**Phenilalanin</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>**Histidin</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>**Lisin</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>**BCAA</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>**Valin</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>**Isoleusin</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>**Leusin</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Alanin</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Asam Aspartat</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Asam Glutamat</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Sistein</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Serin</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Glisin</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Tyrosin</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Proline</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Arginine</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                    <tr class="" style=" color: black;">
                                      <td>Gluten</td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                      <td class="text-right"></td>
                                      <td class="text-right"></td>
                                      <td class="text-center">mg</td>
                                    </tr>
                                  <tbody>
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
            </div>
            <div class="tab-pane" id="3">
              @php
                  $no = 0;
              @endphp
              @if ($ada > 0)
              <div class="row">
                <div class="col-md-5">
                  <table class="table table-bordered" style="font-size:12px">
                    <thead>
                      <th colspan="4" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;"><center>Bahan Baku</center></th>
                    </thead>
                      thead>
                      <th>No</th>
                      <th>Kode Item</th>
                      <th>Nama Bahan</th>
                      <th>Harga PerGram</th>
                    </thead>
                    <tbody>
                    @foreach ($detail_harga->sortByDesc('harga_per_serving') as $fortail)
                      <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $fortail['kode_komputer'] }}</td>
                        <td>{{ $fortail['nama_sederhana'] }}</td>
                        <td>Rp.{{ $fortail['hpg'] }}</td>
                      </tr>
                    @endforeach
                      <tr style="font-size: 12px;font-weight: bold; color:black;background-color: rgb(78, 205, 196, 0.5);">
                        <td colspan="3">Jumlah</td>
                        <td>Rp.{{ $total_harga['total_harga_per_gram'] }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-2">
                  <table class="table table-bordered" style="font-size:12px">
                    <thead>
                      <th colspan="3" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;"><center>Per Serving</center></th>                                                                                                                
                    </thead>
                    <thead>
                      <th>Berat</th>
                      <th><th>Harga</th>
                    </thead>
                    <tbody>
                    @foreach ($detail_harga->sortByDesc('harga_per_serving') as $fortail)
                      <tr>
                        <td>{{ $fortail['per_serving'] }}</td>
                        <td>{{ $fortail['persen'] }}</td>
                        <td>Rp.{{ $fortail['harga_per_serving'] }}</td>
                      </tr>
                    @endforeach
                      <tr style="font-size: 12px;font-weight: bold; color:black;background-color: rgb(78, 205, 196, 0.5);">
                        <td>{{ $total_harga['total_berat_per_serving'] }}</td>
                        <td>{{ $total_harga['total_persen'] }}</td>
                        <td>Rp.{{ $total_harga['total_harga_per_serving'] }}</td>
                      </tr>                                                        
                    </tbody>
                  </table>
                </div>
                <div class="col-md-3">
                  <table class="table table-bordered" style="font-size:12px">
                    <thead>
                      <th colspan="2" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;"><center>Per Batch</center></th>
                    </thead>
                    <thead>
                      <th>Berat</th>
                      <th>Harga</th>
                    </thead>
                    <tbody>
                    @foreach ($detail_harga->sortByDesc('harga_per_serving') as $fortail)
                      <tr>
                        <td>{{ $fortail['per_batch'] }}</td>
                        <td>Rp.{{ $fortail['harga_per_batch'] }}</td>
                      </tr>
                    @endforeach
                      <tr style="font-size: 12px;font-weight: bold; color:black;background-color: rgb(78, 205, 196, 0.5);">
                        <td>{{ $total_harga['total_berat_per_batch'] }}</td>
                        <td>Rp.{{ $total_harga['total_harga_per_batch'] }}</td>                                                        
                      </tr> 
                    </tbody>
                  </table>
                </div>
                <div class="col-md-2">
                  <table class="table table-bordered" style="font-size:12px">
                    <thead>
                        <th colspan="2" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;"><center>Per Kg</center></th>
                    </thead>
                    <thead>
                        <th>Berat</th>
                        <th>Harga</th>
                    </thead>
                    <tbody>
                      @foreach ($detail_harga->sortByDesc('harga_per_serving') as $fortail)
                      <tr>
                        <td>{{ $fortail['per_kg'] }}</td>
                        <td>Rp.{{ $fortail['harga_per_kg'] }}</td>
                      </tr>
                      @endforeach
                      <tr style="font-size: 12px;font-weight: bold; color:black;background-color: rgb(78, 205, 196, 0.5);">
                        {{-- <td>{{ $total_harga['total_berat_per_kg'] }}</td> --}}
                        <td>1000</td>
                        <td>Rp.{{ $total_harga['total_harga_per_kg'] }}</td>
                      </tr> 
                    </tbody>
                  </table>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>    
</div>

@endsection

@section('s')
<script type="text/javascript">

</script>
@endsection