@extends('formula.tempformula')

@section('title', 'Workbook')

@section('judulnya', 'WORKBOOK LIST')

@section('content')      

<div class="row">
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
</div>

<div class="row card">
  <div class="card-block"> 
    <div class="row">
      <div class="col-md-5">
        <h4 style="color:#0c8ce0"><i class="fa fa-caret-right"></i> {{$workbooks->nama_project}}</h4>      
      </div>
      <div class="col-md-7" align="right">
        <a class="btn btn-success" data-toggle="modal" data-target="#editwb"><i class="fa fa-edit"></i> Edit Workbooks</a>
        <a class="btn btn-warning" data-toggle="modal" data-target="#alihkan_wb" ><i class="fa fa-user"></i> Alihkan Project</a>
        @if($cf == 0)
                <a class="btn btn-primary" data-toggle="modal" data-target="#FB"><i class="fa fa-plus"></i> Formula Baru</a>
        @elseif($cf>0)
                <a class="btn btn-info" onclick="return confirm('Naik Versi Formula ?')" href="{{ route('upversion',['cf'=>$cf,'id'=>$workbooks->id]) }}"><i class="fa fa-plus"></i> Naik Versi</a>
        @endif
        @if($workbooks->status == '')
        <a class="btn btn-warning" href="{{ route('workbook.selesai',$workbooks->id) }}" onclick="return confirm('Selesaikan Project ?')"><i class="fa fa-check"></i> SELESAI</a>
        <a class="btn btn-primary" href="{{ route('workbook.batal',$workbooks->id) }}" onclick="return confirm('Batalkan Project ?')"><i class="fa fa-times"></i> BATAL</a>
        @endif
        <a class="btn btn-danger" href="{{ route('myworkbooks') }}"><i class="fa fa-share"></i>Kembali</a>
      </div>
    </div>
    <hr style="border-color: #ddd">     
    <div class="row">
      <div class="col-md-4">        
        <table style="font-size: 14px">
          <tr>
            <td>No.PKP</td><td>&nbsp; : {{ $workbooks->NO_PKP }}</td>              
          </tr>
          <tr>
            <td>Jenis Formula</td><td>&nbsp; : 
              @if ($workbooks->jenis == 'baru')
              <span class="label label-info">Baru</span> 
              @else
              <span class="label label-warning">Revisi</span> 
              @endif
            </td>
          </tr>
          <tr>
            <td>Revisi</td><td>&nbsp; : {{ $workbooks->revisi }}</td>
          </tr>
          <tr>
            <td>Brand</td><td>&nbsp; : {{ $workbooks->subbrand->subbrand }}</td>
          </tr>
          <tr>
            <td>Jenis Makanan</td><td>&nbsp; : {{ $workbooks->jenismakanan->jenis_makanan }}</td>
          </tr>
          <tr>
            <td>Target Konsumen</td><td>&nbsp; : {{ $workbooks->tarkon }}</td>
          </tr>            
        </table>
      </div>
      <div class="col-md-6">
        <table style="font-size:14px">
          <tr>
            <td style="width:100px">Target Serving</td><td>:</td><td>{{ $workbooks->target_serving }} Gr</td>
          </tr>
          <tr>
            <td>Requirement</td><td>:</td><td>{{ $workbooks->mnrq }}</td>
          </tr>
          <tr>
            <td>Deskripsi</td><td>:</td><td>{{ $workbooks->deskripsi }}</td>
          </tr>
        </table>
      </div>
      <div class="col-md-2">
        <div class="row" style="margin-right:20px">
          @if ($workbooks->status == '' )
          <div class="col-md-12" style="background-color:aquamarine">
            Status : Tidak Ada Proses
          </div>
          @endif
          @if ($workbooks->status == 'proses' )
          <div class="col-md-12" style="background-color:#f0ad4e;color:white">
            Status : Proses
          </div>
          @endif 
          @if ($workbooks->status == 'selesai' )
          <div class="col-md-12" style="background-color:chartreuse">
            Status : Selesai
          </div>
          @endif 
          @if ($workbooks->status == 'batal' )
          <div class="col-md-12" style="background-color:red;color:white">
            Status : Batal
          </div>
          @endif             
        </div>
      </div>
    </div>
    <hr style="border-color: #ddd">  
  </div>

  {{-- LIST FORMULA --}}
  <div id="exTab2" class="container">	
  <ul class="nav nav-tabs  tabs" role="tablist">
    <li class="nav-item">
      <a  href="#1" class="nav-link active" data-toggle="tab"><i class="fa fa-list"></i> List Formula</a>
    </li>
    <li class="nav-item">
      <a href="#2" class="nav-link" data-toggle="tab"><i class="fa fa-star-half-o"></i> Pengajuan PV</a>
    </li>
  </ul><br>
  <div class="tab-content ">
    {{-- List Formula --}}
    <div class="tab-pane active" id="1">
      <table class="table" style="font-size:14px" id="Table">
        <thead>
          <tr style="font-size: 12px;font-weight: bold; color:black;background-color: rgb(78, 205, 196, 0.5);">                                         
            <th class="text-center">Versi</th>
            <th>Status</th>
            <th>PV</th>
            <th>Feasibility</th>
            <th>Nutfact</th>
            <th>Keterangan</th>
            <th class="text-center">Action</th>
            <th class="text-center">Pengajuan</th>
          </tr>
        </thead>                      
        <tbody>
          @foreach ($myformula->groupBy('versi') as $group)
          @foreach ($group->sortBy('turunan') as $formula)                                                                            
          <tr>                         
            <td class="text-center  ">{{ $formula['versi']}}.{{ $formula['turunan']}}</td>
            <td>
              @if ($formula['status'] == 'proses')
              <span class="label label-warning">Proses</span>                        
              @endif
              @if ($formula['status'] == 'selesai')
              <span class="label label-success">Approved</span>                        
              @endif 
              @if ($formula['status'] == 'draft')
              <span class="label label-primary">Belum Diajukan</span>                        
              @endif 
            </td>
            <td>
              @if ($formula['vv'] == 'proses')
              <span class="label label-warning">Proses</span>                        
              @endif
              @if ($formula['vv'] == 'tidak')
              <span class="label label-danger">Rejected</span>                        
              @endif 
              @if ($formula['vv'] == 'ok')
              <span class="label label-success">Approved</span>                        
              @endif 
              @if ($formula['vv'] == '')
              <span class="label label-primary">Belum Diajukan</span>                        
              @endif   
            </td>
            <td>
              @if ($formula['finance'] == 'proses')
              <span class="label label-warning">Proses</span>                        
              @endif
              @if ($formula['finance'] == 'not_approved')
              <span class="label label-danger">Rejected</span>                        
              @endif 
              @if ($formula['finance'] == 'approved')
              <span class="label label-success">Approved</span>                        
              @endif 
              @if ($formula['finance'] == '')
              <span class="label label-primary">Belum Diajukan</span>                        
              @endif  
            </td>
            <td>
              @if ($formula['nutfact'] == 'proses')
              <span class="label label-warning">Proses</span>                        
              @endif
              @if ($formula['nutfact'] == 'not_approved')
              <span class="label label-danger">Rejected</span>                        
              @endif 
              @if ($formula['nutfact'] == 'approved')
              <span class="label label-success">Approved</span>                        
              @endif 
              @if ($formula['nutfact'] == '')
              <span class="label label-primary">Belum Diajukan</span>                        
              @endif  
            </td>
            <td>
              @if ($formula['keterangan'] == '')
              <span class="label label-primary">Tidak Ada Keterangan</span>                        
              @else
              {{ $formula['keterangan'] }}
              @endif
            </td>
            <td class="text-center">
              {{csrf_field()}}
              <a class="btn btn-primary btn-sm" href="{{ route('formula.detail',$formula['id']) }}" data-toggle="tooltip" title="Show"><i style="font-size:12px;" class="fa fa-eye"></i></a>
              <a class="btn btn-success btn-sm" href="{{ route('upversion2',$formula['id']) }}" onclick="return confirm('Naik Versi ?')" data-toggle="tooltip" title="Naik Versi"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i></a>
              @if($formula['status']!='proses')
              <a class="btn btn-info btn-sm" href="{{ route('step1',$formula['id']) }}"><i style="font-size:12px;" class="fa fa-edit" data-toggle="tooltip" title="Eidt"></i></a>
              <a class="btn btn-danger btn-sm" href="{{ route('deleteFormula',$formula['id']) }}"><i style="font-size:12px;" class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a>
              @endif
            </td>
            <td class="text-center">
              @if ($formula['status'] != 'proses')
              <a class="btn btn-theme02 btn-sm" href="{{ route('ajukanvp',$formula['id']) }}" onclick="return confirm('Ajukan Formula Kepada PV?')" data-toggle="tooltip" title="Ajukan PV">PV</a>
              @endif
              @if ($formula['vv'] == 'ok')
              <label>data sudah di ajukan</label>
              @endif
            </td>
          </tr>
          @endforeach
          @endforeach
        </tbody> 
      </table>     
    </div>
    {{-- Pengajuan Pv --}}
    <div class="tab-pane" id="2">
      <table class="table table-bordered" style="font-size:12px">
        <thead style="background-color:rgb(78, 205, 196, 0.5);font-weight: bold;color:black;">
          <tr>                                                                                                          
            <th>Status</th>
            <th>Versi</th>  
            <th>PV</th>
            <th>Feasibility</th>
            <th>Nutfact</th>
            <th>Keterangan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($vpf as $formula)
          <tr>
            <td>{{ $formula['status']}}</td>
            <td>{{ $formula['versi']}}.{{ $formula['turunan']}}</td>
            <td>
              @if ($formula['vv'] == 'proses')
              <span class="label label-warning">Proses</span>                        
              @endif
              @if ($formula['vv'] == 'tidak')
              <span class="label label-danger">Rejected</span>                        
              @endif 
              @if ($formula['vv'] == 'ok')
              <span class="label label-success">Approved</span>                        
              @endif 
              @if ($formula['vv'] == '')
              <span class="label label-primary">Belum Diajukan</span>                        
              @endif   
            </td>
            <td>
              @if ($formula['finance'] == 'proses')
              <span class="label label-warning">Proses</span>                        
              @endif
              @if ($formula['finance'] == 'not_approved')
              <span class="label label-danger">Rejected</span>                        
              @endif 
              @if ($formula['finance'] == 'approved')
              <span class="label label-success">Approved</span>                        
              @endif 
              @if ($formula['finance'] == '')
              <span class="label label-primary">Belum Diajukan</span>                        
              @endif  
            </td>
            <td>
              @if ($formula['nutfact'] == 'proses')
              <span class="label label-warning">Proses</span>                        
              @endif
              @if ($formula['nutfact'] == 'not_approved')
              <span class="label label-danger">Rejected</span>                        
              @endif 
              @if ($formula['nutfact'] == 'approved')
              <span class="label label-success">Approved</span>                        
              @endif 
              @if ($formula['nutfact'] == '')
              <span class="label label-primary">Belum Diajukan</span>                        
              @endif  
            </td>
            <td>
              @if ($formula['keterangan'] == '')
              <span class="label label-primary">Tidak Ada Keterangan</span>                        
                                          @else
              {{ $formula['keterangan'] }}
                                          @endif
            </td>
            <td>
              {{csrf_field()}}
              <a class="btn btn-info btn-sm" href="{{ route('formula.detail',$formula['id']) }}"><i style="font-size:14px;" class="fa fa-eye"></i></a>                                            
              @if($formula['status']!='proses')                                                
              <a class="btn btn-danger btn-sm" href="{{ route('deleteFormula',$formula['id']) }}"><i style="font-size:14px;" class="fa fa-trash"></i></a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody> 
      </table>
    </div>
  </div>
  </div>                      
</div>

@endsection

<!-- Formula Baru -->
<div class="modal fade" id="FB" role="dialog" aria-labelledby="hm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="hm"> Formula Baru</h4>
      </div>
      <div class="modal-body">
        <form class="cmxform form-horizontal style-form" method="POST" action="{{ route('addformula') }}">
        <h4><i class="fa fa-list"></i> {{ $workbooks->nama_project }}</h4>
        <input class="form-control " id="workbook_id" name="workbook_id" type="hidden" value="{{ $workbooks->id}}"/>                                       
        <div class="form-group">
          <label class="col-lg-4 control-label">Kode Formula</label>
          <div class="col-lg-8">
          <input class="form-control " id="kode_formula" name="kode_formula" type="text" required/>
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-4 control-label">Target Serving</label>
        <div class="col-lg-8">
          <div class="row">
            <div class="col-md-6"><input class="form-control " id="target_serving" name="target_serving" type="text" required/></div>
            <div class="col-md-6">Gr</div>
          </div>
        </div>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-plus-plus"></i> Add</button>
    </div>
    </form>
  </div>
</div>
</div>

<!-- Edit Workbook -->
<div class="modal fade" id="editwb" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel">Edit Workbook</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form class="cmxform form-horizontal style-form"  method="POST" action="{{ route('updateworkbooks',$workbooks->id) }}">
        {{-- start --}}
        <label class="control-label">Nama Project</label>
        <input class="form-control " id="nama" name="nama" type="text" value="{{ $workbooks->nama_project }}" required/>
        <label class="control-label">Mandatory Requirement</label>
        <input class="form-control " id="mnrq" name="mnrq" type="text" value="{{ $workbooks->mnrq }}" required/>
        <label class="control-label">No.PKP</label>
        <input class="form-control " id="pkp" name="pkp" type="text" value="{{ $workbooks->NO_PKP }}" required/>
        <div class="row">
        <div class="col-md-4">
          <label for="revisi" class="control-label">Jenis Formula</label><br>
          <select class="form-control edit" id="jenis" name="jenis">
            <option value="baru"{{ ( "baru" == $workbooks->jenis ) ? ' selected' : '' }} >Baru</option>
            <option value="revisi"{{ ( "revisi" == $workbooks->jenis ) ? ' selected' : '' }} >Revisi</option>
          </select>
        </div>
        <div class="col-md-4">
          <label for="revisi" class="control-label">Revisi</label>
          <input class="form-control edit" id="revisi" name="revisi" type="text" value="{{ $workbooks->revisi }}"/>
        </div>                    
      </div>
      <div class="row">
        <div class="col-md-4">
          <label class="control-label">Jenis Makanan</label><br>
          <select class="form-control" id="jm" name="jm" style="width:240px">
            <option disabled selected>Pilih Jenis Makanan</option>
            @foreach($jms as $jm)
            <option value="{{ $jm->id }}" {{ ($jm->id == $workbooks->jenismakanan_id) ? ' selected' : '' }}>{{ $jm->jenis_makanan }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <label class="control-label">Brand</label><br>
          <select class="form-control" id="brand" name="brand" style="width:240px">
            <option value="">Pilih Brand</option>
            @foreach($brands as $brand)
            <option value="{{ $brand->id }}" {{ ($brand->id == $workbooks->subbrand->brand->id) ? ' selected' : '' }} >{{ $brand->brand }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4">
          <label class="control-label">SubBrand</label><br>
          <select class="form-control" id="subbrand" name="subbrand" style="width:240px">
            <option value="">Pilih SubBrand</option>
            @foreach ($subbrands as $subbrand)
            <option value="{{ $subbrand->id }}" {{ ($subbrand->id == $workbooks->subbrand_id) ? ' selected' : '' }} >{{ $brand->brand }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <label class="control-label">Target Konsumen</label><br>
          <input class="form-control " id="tarkon" name="tarkon" type="text" required/>
          <i><h6>*) Diisi Sesuai PKP</h6></i>
        </div>
        <div class="col-md-4">
          <label class="control-label">Target Serving</label><br>
          <input class="form-control" type="number" step="any" value="{{ $workbooks->target_serving }}" name="target_serving" required>
        </div>
      </div>
      <label class="control-label">Deskripsi</label>
      <textarea class="form-control " rows="4" id="deskripsi" name="deskripsi" type="text">{{ $workbooks->deskripsi }}</textarea>  
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      {{ method_field('PATCH') }}
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Simpan Perubahan</button>
    </div>
    </form>
  </div>
</div>
</div>

{{-- Modal Chat --}}
<div class="modal fade" id="myModalChat" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope-o"></i> Pesan Baru</h4>
      </div>
      <div class="modal-body">
      <form action="{{ route('send.email') }}" method="POST">
      {{-- Hidden Input --}}
      <input type="hidden" name="workbook_id" value="{{ $workbooks->id }}">
      <input type="hidden" name="jenis" value="dev">
      <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
      {{-- Start--}}
        <div class="row">
          <div class="col-md-6">
            <label class="label label-primary">Kirim Ke :</label><br>                      
            <select name="jenis2" class="form-control">
              <option value="pv">PV(Manager)</option>
              <option value="finance">Tim Finance</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="label label-info">Formula :</label><br>                      
            <select name=formula_id class="form-control">
              <option value="no">Pilih Formula</option>
              @foreach ($vpf->groupBy('versi') as $group)
              @foreach ($group->sortBy('turunan') as $formula)
              <option value="{{ $formula['id'] }}">Versi {{ $formula['versi'] }}.{{ $formula['turunan'] }}</option>
              @endforeach    
              @endforeach
            </select>
          </div>
        </div>
        <div style="margin-top: 15px;height:300px">
        <textarea class="form-control edit" style="min-width: 100%;min-height: 100%" name="pesan"></textarea>                
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Kirim</button>
      </form>
    </div>
  </div>
</div>
</div>
{{-- end Modal Chat --}}

<!-- Alihkan Workbook -->
<div class="modal fade" id="alihkan_wb" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="EWBModalLabel">Pengalihan Project</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('alihkan',$workbooks->id) }}">      
          <table class="table" style="font-size:13px">
          <tbody>
            <tr>
              <td>Nama Project</td>
              <td>{{ $workbooks->nama_project}}</td>
            </tr>
            <tr>
              <td>Mandatory Requirement</td>
              <td>{{ $workbooks->mnrq}}</td>
            </tr>
            <tr>
              <td>Target Konsumen</td>
              <td>{{ $workbooks->tarkon}}</td>
            </tr>
            <tr>
              <td>Status Project</td>
              <td>{{ $workbooks->keterangan }}</td>
            </tr>
            <tr>
              <td>Total Versi Formula</td>
              <td>{{ $cf }}</td>
            </tr>
            <tr>
              <td>PILIH PENERIMA PROJECT</td>
              <td>
                <select class="cari form-control" style="width:300px;" id="user" name="user">
                  @foreach($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                </select>
              </td>
            </tr>
          </tbody>
        </table>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{ method_field('PATCH') }}
      </div>
      <div class="modal-footer">
      <button type="submit" onclick="return confirm('Alihkan Project ?')" class="btn btn-theme03"><i class="fa fa-send"></i> Alihkan</button>
      </form>
      <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
      </div>
    </div>
  </div>
</div>

@section('s')
<script type="text/javascript">
  $('.cari').select2();
  $('#brand').select2();
  $('#subbrand').select2();
  $('#jm').select2();

$(document).ready(function(){  
    $("#tfl").click(function(e) {
    e.preventDefault();
    $('html, body').animate({
      scrollTop: $($.attr(this, 'href')).offset().top
    }, 1000);
    });

    // Get Subbrand
    $('#brand').on('change', function(){
                var myId = $(this).val();
                if(myId){
                        $.ajax({
                            url: '{{URL::to('getSubbrand')}}/'+myId,
                            type: "GET",
                            dataType: "json",
                            beforeSend: function(){
                                $('#loader').css("visibility", "visible");
                            },

                            success:function(data){
                                $('#subbrand').empty();
                                $.each(data, function(key, value){
                                    $('#subbrand').append('<option value="'+ key +'">' + value + '</option>');
                                });                                
                            },
                            complete: function(){
                                $('#loader').css("visibility","hidden");
                            }
                        });
                }
                else{
                    $('#subbrand').empty();
                }           
        });

});
</script>
@endsection