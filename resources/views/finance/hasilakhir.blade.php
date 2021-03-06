@extends('finance.tempfinance')

@section('title', 'feasibility|Finance')

@section('judulnya', 'List Feasibility')

@section('content')

<div class="col-md-12">
  <div class="showback">
    <div class="row">
      <div class="col-md-10"><h4><i class="fa fa-folder-open"></i> SUMMARY</h4> </div>
      <div class="col-md-2"><h4><i class="fa fa-user"></i> {{ Auth::user()->role->namaRule }}</h4> </div>
    </div>
  </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content6" id="profile-tab" role="tab" data-toggle="tab" aria-expanded="true">Mesin dan SDM</a></li>
            <li role="presentation" class=""><a href="#tab_content7" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Data Lab</a></li>
            <li role="presentation" class=""><a href="#tab_content8" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Kemasan</a></li>
            <li role="presentation" class=""><a href="#tab_content9" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Harga Bahan Baku</a></li>
            </ul>
          <div id="myTabContent" class="tab-content">

            <!-- Mesin dan SDM -->
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content6" aria-labelledby="profile-tab">
            <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><i class="fa fa-cogs"></i> Data Mesin</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">GRANULASI</a></li>
            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">MIXING</a></li>
            <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">FILLING</a></li>
            <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">PACKING</a></li>
            <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">ACTIVITY</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">

          <!-- GRANULASI -->
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
            <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">mesin</th>
                    <th class="text-center">standar sdm</th>
                    <th class="text-center">SDM</th>
                    <th class="text-center">Runtime</th>
                    <th class="text-center">aksi</th>
                  </tr>
                </thead>
                <tbody>
          <?php $no = 0;?>
          @foreach($Mdata as $dM)
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('updateM', ['id_mesin' => $dM->id_mesin, 'id_datamesin' => $dM->id_data_mesin]) }}" method="post">
          {!!csrf_field()!!}
          <?php ++$no ;?>
            <tr>
              <div class="col-md-1 col-sm-1 col-xs-12">
                <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
              </div>
              @if( $dM->meesin->kategori=='granulasi' )
              <td  class="text-center">{{$no}}</td>
              <td>{{ $dM->meesin->nama_mesin }}</td>
              <td class="text-center">{{ $dM->standar_sdm }} orang</td>
              <td class="text-center">{{ $dM->SDM }} orang</td>
              <td class="text-center">{{ $dM->runtime }} Menit</td>
              <td class="text-center">

              <!-- Lihat data -->
              <button type="button" class="btn btn-warning fa fa-eye" data-toggle="modal" data-target="#exampleModal1{{ $dM->id_mesin }}" data-toggle="tooltip" data-placement="top" title="Lihat"></button>
              <div class="modal fade" id="exampleModal1{{ $dM->id_mesin  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content text-left ">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLabel">Lihat Data
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button><h3>
                    </div>
                    <div class="modal-body">
                    <table>
							<tr><th width="10%">Nama Mesin </th><th width="45%">: {{ $dM->meesin->nama_mesin }}</th>
							<tr><th width="10%">Workcenter</th><th width="45%">: {{ $dM->meesin->workcenter }}</th>
              <tr><th width="10%">IO</th><th width="45%">: {{ $dM->meesin->IO }}</th>
							<tr><th width="10%">Kategori Mesin</th><th width="45%">: {{ $dM->meesin->kategori }}</th>
              <tr><th width="10%">Standar SDM</th><th width="45%">: {{ $dM->standar_sdm }} Orang</th>
              <tr><th width="10%">SDM</th><th width="45%">: {{ $dM->SDM }} Orang</th>
              <tr><th width="10%">Runtime</th><th width="45%">: {{ $dM->runtime}} Menit = {{ $dM->runtime/60}} Jam</th>
              <tr><th width="10%">Rate Mesin</th><th width="45%">: {{ $dM->rate_mesin }} Ribu</th>
              <tr><th width="10%">Total Hasil</th><th width="45%">: {{ $dM->hasil }} Ribu</th>
							</tr>
						</table>
            </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- lihat data selesai -->

              </td>
              @endif
            </tr>
          </form>
          @endforeach
        </tbody>
              </table>
            </div>

                        <!-- MIXING -->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                        <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">mesin</th>
                    <th class="text-center">standar sdm</th>
                    <th class="text-center">SDM</th>
                    <th class="text-center">Runtime</th>
                    <th class="text-center">aksi</th>
                  </tr>
                </thead>
                <tbody>
          <?php $no = 0;?>
          @foreach($Mdata as $dM)
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('updateM', ['id_mesin' => $dM->id_mesin, 'id_datamesin' => $dM->id_data_mesin]) }}" method="post">
          {!!csrf_field()!!}
          <?php ++$no ;?>
            <tr>
              <div class="col-md-1 col-sm-1 col-xs-12">
                <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
              </div>
              @if( $dM->meesin->kategori=='mixing' )
              <td  class="text-center">{{$no}}</td>
              <td>{{ $dM->meesin->nama_mesin }}</td>
              <td class="text-center">{{ $dM->standar_sdm }} orang</td>
              <td class="text-center">{{ $dM->SDM }} orang</td>
              <td class="text-center">{{ $dM->runtime }} Menit</td>
              <td class="text-center">

              <!-- Lihat data -->
              <button type="button" class="btn btn-warning fa fa-eye" data-toggle="modal" data-target="#exampleModal1{{ $dM->id_mesin }}" data-toggle="tooltip" data-placement="top" title="Lihat"></button>
              <div class="modal fade" id="exampleModal1{{ $dM->id_mesin  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content text-left ">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLabel">Lihat Data
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button><h3>
                    </div>
                    <div class="modal-body">
                    <table>
							<tr><th width="10%">Nama Mesin </th><th width="45%">: {{ $dM->meesin->nama_mesin }}</th>
							<tr><th width="10%">Workcenter</th><th width="45%">: {{ $dM->meesin->workcenter }}</th>
              <tr><th width="10%">IO</th><th width="45%">: {{ $dM->meesin->IO }}</th>
							<tr><th width="10%">Kategori Mesin</th><th width="45%">: {{ $dM->meesin->kategori }}</th>
              <tr><th width="10%">Standar SDM</th><th width="45%">: {{ $dM->standar_sdm }} Orang</th>
              <tr><th width="10%">SDM</th><th width="45%">: {{ $dM->SDM }} Orang</th>
              <tr><th width="10%">Runtime</th><th width="45%">: {{ $dM->runtime}} Menit = {{ $dM->runtime/60}} Jam</th>
              <tr><th width="10%">Rate Mesin</th><th width="45%">: {{ $dM->rate_mesin }} Ribu</th>
              <tr><th width="10%">Total Hasil</th><th width="45%">: {{ $dM->hasil }} Ribu</th>
							</tr>
						</table>
            </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- lihat data selesai -->
              </td>
              @endif
            </tr>
          </form>
          @endforeach
        </tbody>
              </table>
                        </div>

                        <!-- FILLING -->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">mesin</th>
                    <th class="text-center">standar sdm</th>
                    <th class="text-center">SDM</th>
                    <th class="text-center">Runtime</th>
                    <th class="text-center">aksi</th>
                  </tr>
                </thead>
                <tbody>
          <?php $no = 0;?>
          @foreach($Mdata as $dM)
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('updateM', ['id_mesin' => $dM->id_mesin, 'id_datamesin' => $dM->id_data_mesin]) }}" method="post">
          {!!csrf_field()!!}
          <?php ++$no ;?>
            <tr>
              <div class="col-md-1 col-sm-1 col-xs-12">
                <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
              </div>
              @if( $dM->meesin->kategori=='filling' )
              <td  class="text-center">{{$no}}</td>
              <td>{{ $dM->meesin->nama_mesin }}</td>
              <td class="text-center">{{ $dM->standar_sdm }} orang</td>
              <td class="text-center">{{ $dM->SDM }} orang</td>
              <td class="text-center">{{ $dM->runtime }} Menit</td>
              <td class="text-center">

              <!-- Lihat data -->
              <button type="button" class="btn btn-warning fa fa-eye" data-toggle="modal" data-target="#exampleModal1{{ $dM->id_mesin }}" data-toggle="tooltip" data-placement="top" title="Lihat"></button>
              <div class="modal fade" id="exampleModal1{{ $dM->id_mesin  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content text-left ">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLabel">Lihat Data
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button><h3>
                    </div>
                    <div class="modal-body">
                    <table>
							<tr><th width="10%">Nama Mesin </th><th width="45%">: {{ $dM->meesin->nama_mesin }}</th>
							<tr><th width="10%">Workcenter</th><th width="45%">: {{ $dM->meesin->workcenter }}</th>
              <tr><th width="10%">IO</th><th width="45%">: {{ $dM->meesin->IO }}</th>
							<tr><th width="10%">Kategori Mesin</th><th width="45%">: {{ $dM->meesin->kategori }}</th>
              <tr><th width="10%">Standar SDM</th><th width="45%">: {{ $dM->standar_sdm }} Orang</th>
              <tr><th width="10%">SDM</th><th width="45%">: {{ $dM->SDM }} Orang</th>
              <tr><th width="10%">Runtime</th><th width="45%">: {{ $dM->runtime}} Menit = {{ $dM->runtime/60}} Jam</th>
              <tr><th width="10%">Rate Mesin</th><th width="45%">: {{ $dM->rate_mesin }} Ribu</th>
              <tr><th width="10%">Total Hasil</th><th width="45%">: {{ $dM->hasil }} Ribu</th>
							</tr>
						</table>
            </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- lihat data selesai -->
              </td>
              @endif
            </tr>
          </form>
          @endforeach
        </tbody>
              </table>
                        </div>

                         <!-- packing -->
                         <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                         <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">mesin</th>
                    <th class="text-center">standar sdm</th>
                    <th class="text-center">SDM</th>
                    <th class="text-center">Runtime</th>
                    <th class="text-center">aksi</th>
                  </tr>
                </thead>
                <tbody>
          <?php $no = 0;?>
          @foreach($Mdata as $dM)
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('updateM', ['id_mesin' => $dM->id_mesin, 'id_datamesin' => $dM->id_data_mesin]) }}" method="post">
          {!!csrf_field()!!}
          <?php ++$no ;?>
            <tr>
              <div class="col-md-1 col-sm-1 col-xs-12">
                <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
              </div>
              @if( $dM->meesin->kategori=='packing' )
              <td  class="text-center">{{$no}}</td>
              <td>{{ $dM->meesin->nama_mesin }}</td>
              <td class="text-center">{{ $dM->standar_sdm }} orang</td>
              <td class="text-center">{{ $dM->SDM }} orang</td>
              <td class="text-center">{{ $dM->runtime }} Menit</td>
              <td class="text-center">

              <!-- Lihat data -->
              <button type="button" class="btn btn-warning fa fa-eye" data-toggle="modal" data-target="#exampleModal1{{ $dM->id_mesin }}" data-toggle="tooltip" data-placement="top" title="Lihat"></button>
              <div class="modal fade" id="exampleModal1{{ $dM->id_mesin  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content text-left ">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLabel">Lihat Data
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button><h3>
                    </div>
                    <div class="modal-body">
                    <table>
							<tr><th width="10%">Nama Mesin </th><th width="45%">: {{ $dM->meesin->nama_mesin }}</th>
							<tr><th width="10%">Workcenter</th><th width="45%">: {{ $dM->meesin->workcenter }}</th>
							<tr><th width="10%">Kategori Mesin</th><th width="45%">: {{ $dM->meesin->kategori }}</th>
              <tr><th width="10%">Standar SDM</th><th width="45%">: {{ $dM->standar_sdm }} Orang</th>
              <tr><th width="10%">SDM</th><th width="45%">: {{ $dM->SDM }} Orang</th>
              <tr><th width="10%">Runtime</th><th width="45%">: {{ $dM->runtime}} Menit = {{ $dM->runtime/60}} Jam</th>
              <tr><th width="10%">Rate Mesin</th><th width="45%">: {{ $dM->rate_mesin }} Ribu</th>
              <tr><th width="10%">Total Hasil</th><th width="45%">: {{ $dM->hasil }} Ribu</th>
							</tr>
						</table>
            </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- lihat data selesai -->

              </td>
              @endif
            </tr>
          </form>
          @endforeach
        </tbody>
              </table>
                        </div>

                        <!-- aktifitas -->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                        <table class="table table-hover  table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Aktifitas</th>
                      <th class="text-center">runtime</th>
                      <th class="text-center">Standar SDM</th>
                      <th class="text-center">SDM</th>
                      <th class="text-center">hasil</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    @php
                    $nol = 0;
                  @endphp
                    @foreach($dataO as $dO)
                    @php
                      ++$nol;
                    @endphp
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{url('/updateoh')}}/{{$dO->id_oh}}" method="post">
                    {!!csrf_field()!!}
                      <td>{{ $dO->dataoh->direct_activity }}</td>
                      <td class="text-center">{{ $dO->runtime }} Menit</td>
                      <td class="text-center">{{ $dO->standar_sdm }} Orang </td>
                      <td class="text-center">{{ $dO->SDM }} Orang</td>
                      <td width="15%"><input type="number" id='hasil{{$no}}' class="form-control1 text-center col-md-7 col-xs-12" value="{{ $dO->hasil }}" disabled> </td>
                      </tr>
                            </form>
                          @endforeach
                        </tbody>
                        </table>
                        </div>
                        <!-- aktifitas selesai -->
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <!-- mesin dan sdm selesai -->

            <!-- LAB -->
            <div role="tabpanel" class="tab-pane fade" id="tab_content7" aria-labelledby="profile-tab">
            <table id="myTable" class="table table-hover table-bordered">
          <th class="text-center">Jenis Mikroba</th>
          <th class="text-center" width="10%">Tahunan</th>
          <th class="text-center" width="10%">Harian</th>
          <th class="text-center">Input kode</th>
          <th class="text-center">rate</th>
          
        @foreach($dataL as $dL)
        <tr>
        <div class="col-md-1 col-sm-1 col-xs-12">
          <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
        </div>
            <td><input class="form-control1" type="text" id="txtName" value="{{ $dL->jenis_mikroba }}" readonly /></td>
            <td><input type="text" id="txtGender" checked class="form-control1 text-center" value="{{ $dL->tahunan }}" readonly /></td>
            <td><input type="text" id="txt" checked class="form-control1 text-center" value="{{ $dL->harian }}" readonly /></td>
            <td><input id="kode" class="form-control" type="text" id="txtAge" value="{{ $dL->kode_analisa }}" readonly  /></td>
            <td><input class="form-control" type="number" id="txtOccupation" value="{{ $dL->rate }}" readonly /></td>
        </tr>
        @endforeach
</table>   
            </div>
            <!-- LAB selesai -->

            <!-- Kemas -->
            <div role="tabpanel" class="tab-pane fade" id="tab_content8" aria-labelledby="profile-tab2">
            <div class="col-md-12 col-sm-12 col-xs-8 ">
  <div class="panel panel-default">
    <div class="panel-heading">
    	<h2>Data Kemas</h2>
	  </div>
	  <div class="panel-body">
    <table class="table table-responsive table-bordered">
							<thead>
								<tr>
									<th rowspan="2" class="text-center">Min Order</th>
									<th rowspan="2" class="text-center">harga/UoM</th>
									<th rowspan="2" class="text-center">Cost Kemas</th>
								</tr>
							</thead>
							<tbody>
								@foreach($kemas as $kem)
									<td class="text-center">{{ $kem->min_order }}</td>
									<td class="text-center">{{ $kem->harga_uom }}</td>
									<td class="text-center">{{ $kem->cost }}</td>
								</tr>
								@endforeach
								
							@foreach($kemas as $kem)
							
								@if($kem->cost_box != '')<th colspan="2" class="text-right">Cost Kemas/Box <th>: {{ $kem->cost_box }}</th></tr>
								@endif
								@if($kem->cost_dus != '')<th colspan="2" class="text-right">Cost Kemas/Dus <th>: {{ $kem->cost_dus }}</th></tr>
								@endif
								@if($kem->cost_sachet != '')<th colspan="2" class="text-right">Cost Kemas/Sachet <th>: {{ $kem->cost_sachet }}</th></tr>
								@endif
							@endforeach
							</tbody>
						</table>@foreach($dataF as $dF) 
            <a href="{{ route('kemas',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-info fa fa-eye" type="submit">  Lihat Data</a>
    @endforeach
    </div>
  </div>
<div>
</div>
</div>
            </div>
            <!-- kemas selesai -->

            <!-- BB -->
            <div role="tabpanel" class="tab-pane fade" id="tab_content9" aria-labelledby="profile-tab">
                      
            </div>
            <!-- BB selesai -->
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">                        
                      <a href="{{ route('myFeasibility',$id) }}" class="btn btn-danger" type="button">Kembali</a>
                      </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

@endsection