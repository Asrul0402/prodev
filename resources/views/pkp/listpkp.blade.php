@extends('pv.tempvv')
@section('title', 'List PKP')
@section('judulhalaman','Data PKP')
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
    <h3><li class="fa fa-file"> </li> List PKP</h3>
  </div>
    <div class="card-block">
      <div class="clearfix"></div>
      <div class="x_content" style="overflow-x: scroll;">
      <table class="Table table-striped table-bordered">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>#</th>
            <th>PKP Number</th>
            <th>Brand</th>
            <th>Author</th>
            <th>Status</th>
            <th class="text-center">Destination</th>
            <th>Tanggal terima</th>
            <th>Status terima</th>
            <th width="15%" class="text-center">Action</th>
            <th width="15%">Information</th>
          </tr>
        </thead>
        <tbody>
          @php
            $no = 0;
          @endphp
          @foreach($pkp as $pkp)
          @if($pkp->status_project!='draf')
          <tr>
            <th class="text-center">{{ ++$no}}</th>
            <th>{{$pkp->pkp_number}}{{$pkp->ket_no}}</th>
            <th>{{$pkp->id_brand}}</th>
            <th>{{ $pkp->author }}</th>
            <th class="text-center">
              @if($pkp->status_project=='sent')
              <span class="label label-primary" style="color:white">{{ $pkp->status_project}}</span>
              @elseif($pkp->status_project=='revisi')
              <span class="label label-danger" style="color:white">{{ $pkp->status_project}}</span>
              @elseif($pkp->status_project=='proses')
              <span class="label label-success" style="color:white">{{ $pkp->status_project}}</span>
              @elseif($pkp->status_project=='close')
              <span class="label label-info" style="color:white">{{ $pkp->status_project}}</span>
              @endif
            </th>
            <th class="text-center">
              @if($pkp->tujuankirim2=='0')
              Manager {{$pkp->departement->dept}}
              @elseif($pkp->tujuankirim2=='1')
              Manager {{$pkp->departement->dept}} and Manager {{$pkp->departement2->dept}}
              @endif
            </th>
            <th class="text-center">
            @if($pkp->tujuankirim2=='0' && $pkp->tujuankirim!=NULL)
              @if($pkp->tgl_terima!=NULL)
                @if($pkp->status_terima=='terima')
                {{$pkp->tgl_terima}} ({{$pkp->departement->dept}})
                @endif
              @endif
            @elseif($pkp->tujuankirim2=='1' && $pkp->tujuankirim==NULL)
              @if($pkp->tgl_terima2!=NULL)
                @if($pkp->status_terima2=='terima')
                {{$pkp->tgl_terima2}} ({{$pkp->departement->dept}})
                @endif
              @endif
            @elseif($pkp->tujuankirim2=='1' && $pkp->tujuankirim!=NULL)
              @if($pkp->tgl_terima!=NULL && $pkp->tgl_terima2!=NULL)
              {{$pkp->tgl_terima}} ({{$pkp->departement->dept}}) &  {{$pkp->tgl_terima2}} ({{$pkp->departement->dept}})
              @elseif($pkp->tgl_terima!=NULL && $pkp->tgl_terima2==NULL)
              {{$pkp->tgl_terima}} ({{$pkp->departement->dept}})
              @elseif($pkp->tgl_terima==NULL && $pkp->tgl_terima2!=NULL)
              {{$pkp->tgl_terima2}} ({{$pkp->departement->dept}}
              @endif
            @endif
            </th>
            <th class="text-center">
            @if($pkp->tujuankirim2=='0' && $pkp->tujuankirim!=NULL)
              @if($pkp->status_terima=='terima')
              <span class="lable label-success" style="color:#ffff;">Terima</span>
              @else
              <span class="lable label-warning" style="color:#ffff;">Proses</span>
              @endif
            @elseif($pkp->tujuankirim2=='1' && $pkp->tujuankirim==NULL)
              @if($pkp->status_terima2=='terima')
              <span class="lable label-success" style="color:#ffff;">Terima</span>
              @else
              <span class="lable label-warning" style="color:#ffff;">Proses</span>
              @endif
            @elseif($pkp->tujuankirim2=='1' && $pkp->tujuankirim!=NULL)
              @if($pkp->status_terima=='terima' && $pkp->status_terima2=='terima')
              <span class="lable label-success" style="color:#ffff;">Terima</span>
              @else
              <span class="lable label-warning" style="color:#ffff;">Proses</span>
              @endif
            @endif
            </th>
            @if($pkp->status_project=='sent')
            <th class="text-center">
              <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
              @if($pkp->status_freeze=='inactive')
              <button title="freeze" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#freezedata{{ $pkp->id_project  }}"><li class="fa fa-cubes"></i></a></button>
                <!-- Modal -->
                <div class="modal" id="freezedata{{ $pkp->id_project }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">{{$pkp->project_name}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button></h3>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{route('freeze',$pkp->id_project)}}" novalidate>
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
                @if($pkp->prioritas=='1')
                <a href="{{route('kalenderpkp',$pkp->id_project)}}" class="btn btn-danger btn-sm" title="calendar hight priority"><li class="fa fa-calendar"></li></a>
                @elseif($pkp->prioritas=='2')
                <a href="{{route('kalenderpkp',$pkp->id_project)}}" class="btn btn-warning btn-sm" title="calendar standar priority"><li class="fa fa-calendar"></li></a>
                @elseif($pkp->prioritas=='3')
                <a href="{{route('kalenderpkp',$pkp->id_project)}}" class="btn btn-success btn-sm" title="calendar low priority"><li class="fa fa-calendar"></li></a>
                @endif
              @elseif($pkp->status_freeze=='active')
                @if($pkp->freeze==Auth::user()->id)
                <button title="active" class="btn btn-default btn-sm" data-toggle="modal" data-target="#freeze{{ $pkp->id_project  }}"><i class="fa fa-dropbox"></i></a></button>
                  <!-- Modal -->
                  <div class="modal" id="freeze{{ $pkp->id_project }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">{{$pkp->project_name}}
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></h3>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{ Route('ubahTMpkp',$pkp->id_project)}}" novalidate>
                          <div class="row x_panel"><textarea name="" disabled class="col-md-12 col-sm-10 col-xs-12 text-center" rows="3" style="color:red;">{{$pkp->note_freeze}}</textarea><br><br>
                          <br><br><br>
                           <label style="color:blue;">Timeline : {{$pkp->jangka}} To {{$pkp->waktu}}
                            
                            <?php
                              $awal  = date_create( $pkp->waktu );
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
                              ?> <br></label> 
                              @if($pkp->status_project!='revisi')
                             <h3> Sent request for a change in schedule </h3>
                              @elseif($pkp->status_project=='revisi')
                              <h3>Data In The Revision Process</h3>
                             @endif
                             <input type="hidden" name="lamafreeze" value="Revisi Timeline (Date of data freezeing : {{$pkp->waktu_freeze}})">
                             <input type="hidden" value="{{$pkp->id_project}}" name="pkp" id="pkp">
                          </div>
                          <div class="modal-footer">
                            @if($pkp->status_project!='revisi')
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Sent</button>
                            {{ csrf_field() }}
                            <a href="{{route('activepkp',$pkp->id_project)}}" type="button" class="btn btn-info"><li class="fa fa-check"> Active</li></a>
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
              @if($pkp->status_freeze=='inactive')
              <?php
                $awal  = date_create( $pkp->waktu );
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
              @elseif($pkp->status_freeze=='active')
                Project Is Inactive
              @endif
            </th>
            @elseif($pkp->status_project=='revisi')
            <th class="text-center">
              <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
              </th>
            <th>Data In The Revision Process</th>
            @elseif($pkp->status_project=='proses')
            <th class="text-center">
              <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
              @if($pkp->status_freeze=='inactive')
              <button title="note" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#freezedata{{ $pkp->id_project  }}"><li class="fa fa-cubes"></i></a></button>
                  <!-- Modal -->
                  <div class="modal" id="freezedata{{ $pkp->id_project }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">{{$pkp->project_name}}
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></h3>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{route('freeze',$pkp->id_project)}}" novalidate>
                          <div class="row x_panel">
                            <textarea name="notefreeze" class="col-md-12 col-sm-12 col-xs-12"></textarea>
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
                  <!-- Modal Selesai -->@if($pkp->prioritas=='1')
                <a href="{{route('kalenderpkp',$pkp->id_project)}}" class="btn btn-danger btn-sm" title="calendar hight priority"><li class="fa fa-calendar"></li></a>
                @elseif($pkp->prioritas=='2')
                <a href="{{route('kalenderpkp',$pkp->id_project)}}" class="btn btn-warning btn-sm" title="calendar standar priority"><li class="fa fa-calendar"></li></a>
                @elseif($pkp->prioritas=='3')
                <a href="{{route('kalenderpkp',$pkp->id_project)}}" class="btn btn-success btn-sm" title="calendar low priority"><li class="fa fa-calendar"></li></a>
                @endif
              @elseif($pkp->status_freeze=='active')
                @if($pkp->freeze==Auth::user()->id)
                <button title="note" class="btn btn-default btn-sm" data-toggle="modal" data-target="#freeze{{ $pkp->id_project  }}"><i class="fa fa-dropbox"></i></a></button>
                  <!-- Modal -->
                  <div class="modal" id="freeze{{ $pkp->id_project }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">{{$pkp->project_name}}
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></h3>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{ Route('ubahTMpkp',$pkp->id_project)}}" novalidate>
                          <div class="row x_panel"><textarea name="" disabled class="col-md-12 col-sm-10 col-xs-12 text-center" rows="3" style="color:red;">{{$pkp->note_freeze}}</textarea><br><br>
                          <br><br><br>
                           <label style="color:blue;">Timeline : {{$pkp->jangka}} To {{$pkp->waktu}}
                            
                            <?php
                              $awal  = date_create( $pkp->waktu );
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
                              ?> <br></label>
                              @if($pkp->status_project!='revisi')
                             <h3> Sent request for a change in schedule </h3>
                              @elseif($pkp->status_project=='revisi')
                              <h3>Data In The Revision Process</h3>
                             @endif
                             <input type="hidden" name="lamafreeze" value="Revisi Timeline (Date of data freezeing : {{$pkp->waktu_freeze}})">
                             <input type="hidden" value="{{$pkp->id_project}}" name="pkp" id="pkp">
                          </div>
                          <div class="modal-footer">
                            @if($pkp->status_project!='revisi')
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Sent</button>
                            {{ csrf_field() }}
                            <a href="{{route('activepkp',$pkp->id_project)}}" type="button" class="btn btn-info"><li class="fa fa-check"> Active</li></a>
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
              @if($pkp->status_freeze=='inactive')
              Has been sent to {{$pkp->users->name}}
              @elseif($pkp->status_freeze=='active')
              Project Is Inactive
              @endif
            </th>
            @elseif($pkp->status_project=='close')
            <th class="text-center">
              <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
              <button class="btn btn-success btn-sm" title="note" data-toggle="modal" data-target="#ajukan{{ $pkp->id_project  }}"><i class="fa fa-sticky-note"></i></a></button>
              <!-- Modal -->
              <div class="modal" id="ajukan{{ $pkp->id_project  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLabel">Note Project
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button></h3>
                    </div>
                    <div class="modal-body">
                      <div class="row x_panel">
                        <textarea name="note" disabled class="col-md-12 col-sm-12 col-xs-12">{{$pkp->catatan}}</textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Selesai -->
            </th>
            <th>Has been sent to {{$pkp->users->name}}</th>
            @endif
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<!-- auliya ahmad kurniawan <3 -->

@endsection