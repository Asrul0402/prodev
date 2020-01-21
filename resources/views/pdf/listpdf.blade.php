@extends('pv.tempvv')
@section('title', 'List PDF')
@section('content')

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@elseif(session('error'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('error') }}
  </div>
</div>
@endif

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-file"> </li> List PDF</h3>
  </div>
  <div class="card-block">
    <div class="clearfix"></div>
    <div class="x_content" style="overflow-x: scroll;">
      <table class="Table stylish-table table-striped table-bordered dtables">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>#</th>
            <th>No PDF</th>
            <th>Brand</th>
            <th>Author</th>
            <th width="3%" class="text-center">Status</th>
            <th class="text-center">Destination</th>
            <th>Tanggal terima</th>
            <th>Status terima</th>
            <th width="15%" class="text-center">Action</th>
            <th width="15%">Information</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          @php $no = 0; @endphp
          @foreach($pdf as $pdf)
          @if($pdf->status_project!="draf")
          <th>{{ ++$no }}</th>
          <th>{{ $pdf->pdf_number}}{{$pdf->ket_no}}</th>
          <th>{{ $pdf->id_brand }}</th>
          <th>{{ $pdf->author }}</th>
          <th class="text-center">
            @if($pdf->status_project=='sent')
            <span class="label label-primary" style="color:white">{{ $pdf->status_project}}</span>
            @elseif($pdf->status_project=='revisi')
            <span class="label label-danger" style="color:white">{{ $pdf->status_project}}</span>
            @elseif($pdf->status_project=='proses')
            <span class="label label-success" style="color:white">{{ $pdf->status_project}}</span>
            @endif
          </th>
          <th class="text-center">
          @if($pdf->tujuankirim2=='0')
          Manager {{$pdf->departement->dept}}
          @elseif($pdf->tujuankirim2=='1')
          Manager {{$pdf->departement->dept}} and Manager {{$pdf->departement2->dept}}
          @endif
          </th>
          <th class="text-center">
            @if($pdf->tujuankirim2=='0' && $pdf->tujuankirim!=NULL)
              @if($pdf->tgl_terima!=NULL)
              {{$pdf->tgl_terima}} ({{$pdf->departement->dept}})
              @endif
            @elseif($pdf->tujuankirim2=='1' && $pdf->tujuankirim==NULL)
              @if($pdf->tgl_terima2!=NULL)
              {{$pdf->tgl_terima2}} ({{$pdf->departement->dept}})
              @endif
            @elseif($pdf->tujuankirim2=='1' && $pdf->tujuankirim!=NULL)
              @if($pdf->tgl_terima!=NULL && $pdf->tgl_terima2!=NULL)
              {{$pdf->tgl_terima}} ({{$pdf->departement->dept}}) &  {{$pdf->tgl_terima2}} ({{$pdf->departement->dept}})
              @endif
            @endif
            </th>
            <th class="text-center">
            @if($pdf->tujuankirim2=='0' && $pdf->tujuankirim!=NULL)
              @if($pdf->status_terima=='terima')
              <span class="lable lable-success" style="color:#ffff;">Terima</span>
              @else
              <span class="lable label-warning" style="color:#ffff;">Proses</span>
              @endif
            @elseif($pdf->tujuankirim2=='1' && $pdf->tujuankirim==NULL)
              @if($pdf->status_terima2=='terima')
              <span class="lable lable-success" style="color:#ffff;">Terima</span>
              @else
              <span class="lable label-warning" style="color:#ffff;">Proses</span>
              @endif
            @elseif($pdf->tujuankirim2=='1' && $pdf->tujuankirim!=NULL)
              @if($pdf->status_terima=='terima' && $pdf->status_terima2=='terima')
              <span class="lable lable-success" style="color:#ffff;">Terima</span>
              @else
              <span class="lable label-warning" style="color:#ffff;">Proses</span>
              @endif
            @endif
            </th>
          @if($pdf->status_project=='sent')
          <th class="text-center">
            <a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf )}}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
            @if($pdf->status_freeze=='inactive')
              <button title="note" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#freezedata{{ $pdf->id_project_pdf  }}"><li class="fa fa-cubes"></i></a></button>
                  <!-- Modal -->
                  <div class="modal" id="freezedata{{ $pdf->id_project_pdf }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">{{$pdf->project_name}}
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></h3>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{route('freezepdf',$pdf->id_project_pdf)}}" novalidate>
                          <div class="row x_panel">
                            <label for="" style="color:red;">*required</label><textarea name="notefreeze" required class="col-md-12 col-sm-12 col-xs-12"></textarea>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-dark" onclick="return confirm('Are you sure you deactivated this project ?')"><i class="fa fa-cubes"></i> Freeze</button>
                            {{ csrf_field() }}
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Selesai -->
              @if($pdf->prioritas=='1')
              <a href="{{route('kalenderpdf',$pdf->id_project_pdf)}}" class="btn btn-danger btn-sm" title="calendar hight priority"><li class="fa fa-calendar"></li></a>
              @elseif($pdf->prioritas=='2')
              <a href="{{route('kalenderpdf',$pdf->id_project_pdf)}}" class="btn btn-warning btn-sm" title="calendar standar priority"><li class="fa fa-calendar"></li></a>
              @elseif($pdf->prioritas=='3')
              <a href="{{route('kalenderpdf',$pdf->id_project_pdf)}}" class="btn btn-success btn-sm" title="calendar low priority"><li class="fa fa-calendar"></li></a>
              @endif
            @elseif($pdf->status_freeze=='active')
              @if($pdf->freeze==Auth::user()->id)
              <button title="note" class="btn btn-default btn-sm" data-toggle="modal" data-target="#freeze{{ $pdf->id_project_pdf  }}"><i class="fa fa-dropbox"></i></a></button>
              <!-- Modal -->
                <div class="modal" id="freeze{{ $pdf->id_project_pdf }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">{{$pdf->project_name}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button></h3>
                      </div>
                      <div class="modal-body">
                      <form class="form-horizontal form-label-left" method="POST" action="{{ Route('ubahTMpdf',$pdf->id_project_pdf)}}" novalidate>
                        <div class="row x_panel">
                        <textarea name="" disabled class="col-md-12 col-sm-10 col-xs-12 text-center" rows="3" style="color:red;">{{$pdf->note_freeze}}</textarea><br><br>
                        <br><br><br>
                           <label style="color:blue;">Timeline : {{$pdf->jangka}} To {{$pdf->waktu}} <br>
                          <?php
                            $awal  = date_create( $pdf->waktu );
                            $akhir = date_create(); // waktu sekarang
                            if($akhir<=$awal)
                            {
                              $diff  = date_diff( $akhir, $awal );
                              echo ' You Have ';
                              echo $diff->m . ' Month, ';
                              echo $diff->d . ' Days, ';
                              echo $diff->h . ' Hours, ';
                              echo ' To Complite This Project ';
                            }else{
                              echo ' Your Time Is Up ';
                            }
                          ?> <br></lable>
                          @if($pdf->status_project!='revisi')
                          <h3> Sent request for a change in schedule </h3>
                          @elseif($pdf->status_project=='revisi')
                          <h3>Data In The Revision Process</h3>
                          @endif
                          <input type="hidden" name="lamafreeze" value="Revisi Timeline (Date of data freezeing : {{$pdf->waktu_freeze}})">
                              <input type="hidden" value="{{$pdf->id_project_pdf}}" name="pdf" id="pdf">
                        </div>
                        <div class="modal-footer">
                          @if($pdf->status_project!='revisi')
                          <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button>
                          {{ csrf_field() }}
                          <a href="{{route('activepdf',$pdf->id_project_pdf)}}" type="button" class="btn btn-info"><li class="fa fa-check"> Active</li></a>
                          @endif
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Selesai -->
              @endif
            @endif
          </th>
          <th>  
            @if($pdf->status_freeze=='inactive')
            <?php 
              $awal  = date_create( $pdf->waktu );
              $akhir = date_create(); // waktu sekarang
              if($akhir<=$awal)
              {
                $diff  = date_diff( $akhir, $awal );
                echo ' You Have ';
                echo $diff->m . ' Month, ';
                echo $diff->d . ' Days, ';
                echo $diff->h . ' Hours, ';
                echo ' To Complite This Project ';
              }else{
                echo ' Your Time Is Up ';
              }
            ?>
            @elseif($pdf->status_freeze=='active')
              Project Is Inactive
            @endif
          </th>
          @elseif($pdf->status_project=='revisi')
          <th class="text-center"><a class="btn btn-info" href="{{ Route('rekappdf',$pdf->id_project_pdf )}}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a></th>
          <th>Data In The Revision Process</th>
          @elseif($pdf->status_project=='proses')
          <th class="text-center">
            <a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf )}}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
            @if($pdf->status_freeze=='inactive')
            <button title="note" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#freezedata{{ $pdf->id_project_pdf  }}"><li class="fa fa-cubes"></i></a></button>
                  <!-- Modal -->
                  <div class="modal" id="freezedata{{ $pdf->id_project_pdf }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">{{$pdf->project_name}}
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></h3>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{route('freezepdf',$pdf->id_project_pdf)}}" novalidate>
                          <div class="row x_panel">
                            <label for="" style="color:red;">*required</label><textarea name="notefreeze" required class="col-md-12 col-sm-12 col-xs-12"></textarea>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-dark" onclick="return confirm('Are you sure you deactivated this project ?')"><i class="fa fa-cubes"></i> Freeze</button>
                            {{ csrf_field() }}
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Selesai -->
                  @if($pdf->prioritas=='1')
              <a href="{{route('kalenderpdf',$pdf->id_project_pdf)}}" class="btn btn-danger btn-sm" title="calendar hight priority"><li class="fa fa-calendar"></li></a>
              @elseif($pdf->prioritas=='2')
              <a href="{{route('kalenderpdf',$pdf->id_project_pdf)}}" class="btn btn-warning btn-sm" title="calendar standar priority"><li class="fa fa-calendar"></li></a>
              @elseif($pdf->prioritas=='3')
              <a href="{{route('kalenderpdf',$pdf->id_project_pdf)}}" class="btn btn-success btn-sm" title="calendar low priority"><li class="fa fa-calendar"></li></a>
              @endif
            @elseif($pdf->status_freeze=='active')
              @if($pdf->freeze==Auth::user()->id)
              <button title="note" class="btn btn-default btn-sm" data-toggle="modal" data-target="#freeze{{ $pdf->id_project_pdf  }}"><i class="fa fa-dropbox"></i></a></button>
              <!-- Modal -->
              <div class="modal" id="freeze{{ $pdf->id_project_pdf }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLabel">{{$pdf->project_name}}
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button></h3>
                    </div>
                    <div class="modal-body">
                    <form class="form-horizontal form-label-left" method="POST" action="{{ Route('ubahTMpdf',$pdf->id_project_pdf)}}" novalidate>
                      <div class="row x_panel">
                      <textarea name="" disabled class="col-md-12 col-sm-10 col-xs-12 text-center" rows="3" style="color:red;">{{$pdf->note_freeze}}</textarea><br><br>
                        <br><br><br>
                           <label style="color:blue;">Timeline : {{$pdf->jangka}} To {{$pdf->waktu}} <br>
                          <?php
                          $awal  = date_create( $pdf->waktu );
                          $akhir = date_create(); // waktu sekarang
                          if($akhir<=$awal)
                          {
                            $diff  = date_diff( $akhir, $awal );
                            echo ' You Have ';
                            echo $diff->m . ' Month, ';
                            echo $diff->d . ' Days, ';
                            echo $diff->h . ' Hours, ';
                            echo ' To Complite This Project ';
                          }else{
                            echo ' Your Time Is Up ';
                          }
                        ?> <br></lable>
                        @if($pdf->status_project!='revisi')
                        <h3> Sent request for a change in schedule </h3>
                        @elseif($pdf->status_project=='revisi')
                        <h3>Data In The Revision Process</h3>
                        @endif
                        <input type="hidden" name="lamafreeze" value="Revisi Timeline (Date of data freezeing : {{$pdf->waktu_freeze}})">
                             <input type="hidden" value="{{$pdf->id_project_pdf}}" name="pdf" id="pdf">
                      </div>
                      <div class="modal-footer">
                        @if($pdf->status_project!='revisi')
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button>
                        {{ csrf_field() }}
                        <a href="{{route('activepdf',$pdf->id_project_pdf)}}" type="button" class="btn btn-info"><li class="fa fa-check"> Active</li></a>
                        @endif
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Selesai -->
              @endif
            @endif
          </th>
          <th>
            @if($pdf->status_freeze=='inactive')
              Has been sent to {{$pdf->users->name}}
            @elseif($pdf->status_freeze=='active')
              Project Is Inactive
             @endif
          </th>
          @elseif($pdf->status_project=='close')
          <th class="text-center"><a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf )}}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
          <button class="btn btn-info btn-sm" disabled title="close"><li class="fa fa-smile-o"></li></button>
          </th>
          <th>Project Finish</th>
            @endif
            @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection