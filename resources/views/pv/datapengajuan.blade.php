@extends('pv.tempvv')
@section('title', 'Pengajuan Revisi')
@section('judulhalaman','Pengajuan Revisi')
@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-envelope"></li> Revision Request</h3>
        </div>
        <div class="" style="overflow-x: scroll;">
          <div class="container"> 
            <section id="fancyTabWidget" class="tabs t-tabs">
            <ul class="nav nav-tabs fancyTabs" role="tablist">
              <li class="tab fancyTab active col-md-4 col-sm-12 col-xs-12">
                <div style="font-weight: bold;color:white;background-color: #2a3f54;" class="arrow-down"><div class="arrow-down-inner"></div></div>	
                  <a id="tab0" href="#tabBody0" role="tab" aria-controls="tabBody0" style="font-weight: bold;color:white;background-color: #2a3f54;" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> PKP</span></a>
              	<div class="whiteBlock"></div>
              </li>
                  
              <li class="tab fancyTab col-md-4 col-sm-12 col-xs-12">
                <div class="arrow-down" style="font-weight: bold;color:white;background-color: #2a3f54;"><div class="arrow-down-inner"></div></div>
                  <a id="tab1" style="font-weight: bold;color:white;background-color: #2a3f54;" href="#tabBody1" role="tab" aria-controls="tabBody1" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> PDF</span></a>
                <div class="whiteBlock"></div>
              </li>
                  
              <li class="tab fancyTab col-md-4 col-sm-12 col-xs-12">
                <div class="arrow-down" style="font-weight: bold;color:white;background-color: #2a3f54;"><div class="arrow-down-inner"></div></div>
                  <a id="tab2" style="font-weight: bold;color:white;background-color: #2a3f54;" href="#tabBody2" role="tab" aria-controls="tabBody2" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> PKP Promo</span></a>
                <div class="whiteBlock"></div>
              </li>
               
            </ul>
            <div id="myTabContent" class="tab-content fancyTabContent" aria-live="polite">
              <!-- PKP Pengajuan -->
              <div class="tab-pane  fade active in" id="tabBody0" role="tabpanel" aria-labelledby="tab0" aria-hidden="false" tabindex="0">
                <div>
                  <div class="row">
                    <div class="col-md-12">
                      <table class="Table table-bordered">
                        <thead>
                          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                            <td class="text-center" width="5%">No</td>
                            <th class="text-center">From</th>
                            <th class="text-center">Project Name</th>
                            <th class="text-center">Prioritas</th>
                            <th class="text-center">Penerima</th>
                            <th class="text-center">Deadline</th>
                            <th width="5%">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @php
                          $no = 0;
                        @endphp
                        @foreach($pengajuanpkp as $pkp)
                        @php
                          ++$no;
                        @endphp
                          <tr>
                            <td class="text-center">{{$no}}</td>
                            <td>Manager {{$pkp->datapkp->departement->dept}}</td>
                            <td>{{$pkp->datapkp->project_name}}</td>
                            <td class="text-center">
                              @if($pkp->prioritas_pengajuan=='1')
                              <span class="label label-danger" style="color:#ffff">High Priority</span>
                              @elseif($pkp->prioritas_pengajuan=='2')
                              <span class="label label-warning" style="color:#ffff">Standar Priority</span>
                              @elseif($pkp->prioritas_pengajuan=='3')
                              <span class="label label-primary" style="color:#ffff">Low Priority</span>
                              @endif
                            </td>
                            <th class="text-center">
                            @if($pkp->penerima==NULL)
                            @elseif($pkp->penerima!=NULL)
                            {{$pkp->user->namaRule}}
                            @endif
                            </th>
                            <td>{{$pkp->jangka}} {{$pkp->waktu}}</td>
                            <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#pkp{{$pkp->id_pengajuan}}"><i class="fa fa-folder"></i></button>
            	              </td>
                          </tr>
                          <!-- modal -->
                          <div class="modal" id="pkp{{$pkp->id_pengajuan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">                 
                                  <h3 class="modal-title" id="exampleModalLabel">Revision Filing Record
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></h3>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                      <textarea name="" id="" rows="10" class="col-md-12 col-sm-12 col-xs-12 form-control" disabled>{{$pkp->alasan_pengajuan}}</textarea>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                  <a href="{{Route('rekappkp',$pkp->id_pkp)}}" class="btn btn-info" type="button"><li class="fa fa-edit"> Start revision</li></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Modal Selesai -->
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Pengajuan PDF -->
              <div class="tab-pane  fade" id="tabBody1" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-bordered">
                      <thead>
                        <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                          <td class="text-center" width="5%">No</td>
                          <th class="text-center">Pengirim</th>
                          <th class="text-center">Nama Project</th>
                          <th class="text-center">Prioritas</th>
                          <th class="text-center">Penerima</th>
                          <th class="text-center">Deadline</th>
                          <th width="5%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @php
                        $nol = 0;
                      @endphp
                      @foreach($pengajuanpdf as $pdf)
                      @php
                        ++$nol;
                      @endphp
                        <tr>
                          <td class="text-center">{{$nol}}</td>
                          <td>Manager {{$pdf->datapdf->departement->dept}}</td>
                          <td>{{$pdf->datapdf->project_name}}</td>
                          <td class="text-center">
                            @if($pdf->prioritas_pengajuan=='1')
                            <span class="label label-danger" style="color:#ffff">High Priority</span>
                            @elseif($pdf->prioritas_pengajuan=='2')
                            <span class="label label-warning" style="color:#ffff">Standar Priority</span>
                            @elseif($pdf->prioritas_pengajuan=='3')
                            <span class="label label-primary" style="color:#ffff">Low Priority</span>
                            @endif
                          </td>
                          <td class="text-center">
                            @if($pdf->penerima==NULL)
                            @elseif($pdf->penerima!=NULL)
                              {{$pdf->user->namaRule	}}
                            @endif
                          </td>
                          <td>{{$pdf->jangka}} {{$pdf->waktu}}</td>
                          <td><button class="btn btn-info" data-toggle="modal" data-target="#pdf{{$pdf->id_pengajuan}}"><i class="fa fa-folder"></i></button></td>
                        </tr>
                          <!-- modal -->
                          <div class="modal" id="pdf{{$pdf->id_pengajuan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">                 
                                  <h3 class="modal-title" id="exampleModalLabel">Revision Filing Record
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></h3>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                      <textarea name="" id="" rows="10" class="col-md-12 col-sm-12 col-xs-12 form-control" disabled>{{$pdf->alasan_pengajuan}}</textarea>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <a href="{{Route('rekappdf',$pdf->id_pdf)}}" class="btn btn-info" type="button"><li class="fa fa-edit"> Start revision</li></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Modal Selesai -->
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- Pengajuan Promo -->
              <div class="tab-pane  fade" id="tabBody2" role="tabpanel" aria-labelledby="tab2" aria-hidden="true" tabindex="0">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-bordered">
                      <thead>
                        <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                          <td class="text-center" width="5%">No</td>
                          <th class="text-center">Pengirim</th>
                          <th class="text-center">Nama Project</th>
                          <th class="text-center">Prioritas</th>
                          <th class="text-center">Penerima</th>
                          <th class="text-center" class="text-center">Deadline</th>
                          <th width="5%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $satu = 0; @endphp
                        @foreach($pengajuanpromo as $promo)
                        @php ++$satu; @endphp
                        <tr>
                          <td class="text-center">{{$satu}}</td>
                          <td>Manager {{$promo->datapromo->departement->dept}}</td>
                          <td>{{$promo->datapromo->project_name}}</td>
                          <td class="text-center">
                            @if($promo->prioritas_pengajuan=='1')
                            <span class="label label-danger" style="color:#ffff">High Priority</span>
                            @elseif($promo->prioritas_pengajuan=='2')
                            <span class="label label-warning" style="color:#ffff">Standar Priority</span>
                            @elseif($promo->prioritas_pengajuan=='3')
                           <span class="label label-primary" style="color:#ffff">Low Priority</span>
                            @endif
                          </td>
                          <td class="text-center">
                            @if($promo->penerima==NULL)
                            @elseif($promo->penerima!=NULL)
                            {{$promo->user->namaRule}}
                            @endif
                          </td>
                          <td>{{$promo->jangka}} {{$promo->waktu}}</td>
                            <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#promo{{$promo->id_promo}}"><i class="fa fa-folder"></i></button>
                            </td>
                          </tr>
                          <!-- modal -->
                          <div class="modal" id="promo{{$promo->id_promo}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">                 
                                  <h3 class="modal-title" id="exampleModalLabel">Revision Filing Record
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></h3>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <textarea name="" id="" rows="10" class="col-md-12 col-sm-12 col-xs-12 form-control" disabled>{{$promo->alasan_pengajuan}}</textarea>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                  <a href="{{Route('rekappromo',$promo->id_promo)}}" class="btn btn-info" type="button"><li class="fa fa-edit"> Start revision</li></a>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Modal Selesai -->
                        @endforeach
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  
@endsection