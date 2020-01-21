<!DOCTYPE html>
<html lang="en">
  <head>
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') 
    @if(auth()->user()->role->namaRule == 'pv_lokal' || auth()->user()->role->namaRule == 'pv_global' || auth()->user()->role->namaRule == 'marketing')
      @if($pengajuan!=0)
      ({{$pengajuan}} message)
      @endif
    @endif
    </title>
    <link href="{{ asset('img/prod.png') }}" rel="icon">
    <!-- Custom Theme Style -->   <!-- FullCalendar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- CSS Files -->
    <script src="{{ asset('vendors/echarts/dist/echarts.min.js') }}"></script>
    <script src="{{ asset('vendors/echarts/map/js/world.js') }}"></script>
    <link href="{{ asset('vendors/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/fullcalendar/dist/fullcalendar.print.css') }}" rel="stylesheet" media="print">
    <link href="{{ asset('css/asrul.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/asri.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('lib/dropzoneJS/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/sheila.css') }}" rel="stylesheet"> 
  </head>

  <body class="nav-md ">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col" style="position:fixed; min-height:880;">
          <div class="left_col scroll-view" >
            <div class="navbar nav_title" style="border: 2;">
            <a href="{{route('lala')}}" class="site_title"><i class="fa fa-laptop"></i><img src="{{ asset('img/logo.png') }}" width="70%" alt="..."></a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
            <center>
                <a href="{{route('lala')}}"><img style="width:100px" src="{{ asset('img/pro.png') }}" alt="..." class="profile_img"></a><br>
              <span style="font-weight: bold;color:white;">Welcome, {{ Auth::user()->role->namaRule }}</span>
                @if( auth()->check() )
                <h2 style="color:white;">{{ Auth::user()->name }}</h2>
                @endif</center>
              <div class="clearfix"></div>
            </div>

            <br>
            <!-- menu profile quick info end -->
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" >
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-user"></i> User Managementa <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('MyProfile') }}">Profile settings</a></li>
                    </ul>
                  </li>
                  @if(auth()->user()->role->namaRule == 'pv_lokal')
                  <li><a><i class="fa fa-folder-open"></i> PKP / PDF / PROMO <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a><i class="fa fa-edit"></i>Input Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('formpkp')}}">Input PKP</a> </li>
                        <li><a href="{{Route('promo')}}">Input PROMO</a> </li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-archive"></i>Draf Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('drafpkp')}}">Draf PKP</a> </li>
                        <li><a href="{{Route('drafpromo')}}">Draf PROMO</a> </li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-list"></i>List Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('listpkp')}}">List PKP</a> </li>
                        <li><a href="{{Route('listpromo')}}">List PROMO</a> </li>
                      </ul>
                    </li>
                    </ul>
                  </li>
                  @elseif(auth()->user()->role->namaRule == 'pv_global')
                  <li><a><i class="fa fa-folder-open"></i> PKP / PDF / PROMO <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a><i class="fa fa-edit"></i>Input Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('formpdf')}}">Input PDF</a> </li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-archive"></i>Draf Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('drafpdf')}}">Draf PDF</a> </li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-list"></i>List Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('listpdf')}}">List PDF</a> </li>
                      </ul>
                    </li>
                    </ul>
                  </li>
                  @elseif(auth()->user()->role->namaRule == 'maklon')
                  <li><a><i class="fa fa-folder-open"></i> PKP / PDF / PROMO <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    li><a><i class="fa fa-edit"></i>Input Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{ route('listpkpmaklon') }}">List PKP</a> </li>
                        <li><a href="{{ route('listpromomaklon') }}">List PROMO</a> </li>
                      </ul>
                    </li>
                    </ul>
                  </li>
                  @elseif(auth()->user()->role->namaRule == 'marketing' || auth()->user()->role->namaRule == 'NR')
                  <li><a><i class="fa fa-folder-open"></i> PKP / PDF / PROMO <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a><i class="fa fa-edit"></i>Input Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('formpkp')}}">Input PKP</a> </li>
                        <li><a href="{{Route('formpdf')}}">Input PROMO</a> </li>
                        <li><a href="{{Route('promo')}}">Input PDF</a> </li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-archive"></i>Draf Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('drafpkp')}}">Draf PKP</a> </li>
                        <li><a href="{{Route('drafpdf')}}">Draf PDF</a> </li>
                        <li><a href="{{Route('drafpromo')}}">Draf PROMO</a> </li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-list"></i>List Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('listpkp')}}">List PKP</a> </li>
                        <li><a href="{{Route('listpdf')}}">List PROMO</a> </li>
                        <li><a href="{{Route('listpromo')}}">List PDF</a> </li>
                      </ul>
                    </li>
                    </ul>
                  </li>
                  @endif
                  @if(auth()->user()->role->namaRule === 'user_produk')
                  <li><a><i class="fa fa-folder-open"></i> PKP / PDF / PROMO <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('listprojectpkp') }}">List PKP</a> </li>
                      <li><a href="{{ route('listprojectpdf') }}">List PROMO</a> </li>
                      <li><a href="{{ route('listprojectpromo') }}">List PDF</a> </li>
                    </ul>
                  </li>
                  @elseif(auth()->user()->role->namaRule === 'CS')
                  <li><a><i class="fa fa-folder-open"></i> PKP / PDF / PROMO <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a><i class="fa fa-edit"></i>Input Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{ route('promo') }}">Input PROMO</a> </li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-archive"></i>Draf Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{ route('drafpromo') }}">Draf PROMO</a> </li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-list"></i>List Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{ route('listpromo') }}">List PROMO</a> </li>
                      </ul>
                    </li>
                    </ul>
                  </li>
                  @endif
                  <!-- <li><a><i class="fa fa-check"></i> Management Formula <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('approvalformula') }}">Approval</a></li>
                      <li><a href="{{ route('approvedformula') }}">approved</a></li>
                    </ul>
                  </li> -->

                  <li><a><i class="fa fa-file-text"></i> Rekap data <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('datapengajuan') }}">Revision Request</a></li>
                      <li><a href="{{ route('story') }}">Rekap History</a></li>
                      <li><a href="{{ route('datareport') }}">Rekap Data</a></li>
                      @if(auth()->user()->role->namaRule === 'pv_lokal' || auth()->user()->role->namaRule === 'pv_global' || auth()->user()->role->namaRule === 'manager' || auth()->user()->role->namaRule === 'pv_global')
                      <li><a href="{{ route('tabulasi') }}">Rekap Tabular</a></li>
                      @endif
                    </ul>
                  </li>
                  <li><a><i class="fa fa-book"></i> Data Master <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('datapangan') }}">BPOM kriteria mikrobiologi</a></li>
                      <li><a href="{{ route('akg') }}">Data AKG</a></li>
                      <li><a href="{{ route('sku') }}">Data SKU</a></li>
                      <li><a href="{{ route('klaim') }}">Nilai Gizi</a></li>
                    </ul>
                  </li>
                  @if(auth()->user()->role->namaRule === 'pv_lokal' || auth()->user()->role->namaRule === 'pv_global' || auth()->user()->role->namaRule === 'manager' || auth()->user()->role->namaRule === 'pv_global')
                  <li class="mt"><a href="{{ route('menucalender') }}"><i class="fa fa-calendar"></i><span>Project Calendara</span></a></li>
                  @endif
                  </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav" >
          <div class="nav_menu" >
            <nav>
              <div class="nav toggle" >
                <a id="menu_toggle" style="color:#353d48"><i class="fa fa-bars" ></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('img/pro.png') }}" alt="">{{ Auth::user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ route('MyProfile') }}"> Profile</a></li>
                    <li><a href="{{ route('signout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
                @if(auth()->user()->role->namaRule == 'pv_lokal' || auth()->user()->role->namaRule == 'pv_global' || auth()->user()->role->namaRule == 'marketing')
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">{{$hitungnotif}}</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    @if($pengajuan!=0)
                    <li>
                    <a>
                      <a href="{{route('datapengajuan')}}">
                        <span class="image"><img src="{{ asset('img/pro.png') }}" alt="Profile Image" /></span>
                        <span>
                          <span>Pengajuan Revisi</span>
                        </span>
                        <span class="message">
                        <span>Klik Untuk Lihat Rincian Pengajuan</span>
                        </span>
                      </a>
                    </a>
                    </li>
                    @endif
                    @if($notif!=null)
                      @foreach($pesan as $pesan)
                        @if($hitungnotif!=0)
                          @if($pesan->status=='active')
                          <li>
                          <a>
                            <a href="{{route('story')}}">
                              <span class="image"><img src="{{ asset('img/pro.png') }}" alt="Profile Image" /></span>
                              <span>
                                @if($pesan->id_pkp!=NULL)
                                <span>{{$pesan->title}} ({{$pesan->project->project_name}})</span>
                                @elseif($pesan->id_pdf!=NULL)
                                <span>{{$pesan->title}} ({{$pesan->pdf->project_name}})</span>
                                @elseif($pesan->id_promo!=NULL)
                                <span>{{$pesan->title}} ({{$pesan->promo->project_name}})</span>
                                @endif
                              </span>
                              <span class="message">
                                <span>Direvisi oleh {{$pesan->users->name}} ({{$pesan->users->Role->namaRule}})</span>
                              </span>
                            </a>
                          </a>
                          </li>
                          @endif
                        @endif
                      @endforeach
                    @endif
                    @endif
                  </ul>
                </nav>
              </div>
            </div>
         <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                     @yield('content')
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class=" text-right">
            Created By Asrul4238 :)
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('lib/dropzoneJS/dropzone.js')}}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js')}}"></script>
    <script src="{{ asset('js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('build/js/custom.min.js') }}"></script>
    <script>
    $(document).ready(function(){
      //ajax setup
      $.ajaxSetup({
        headers:{
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
      });
    });
    </script>
    <script src="{{ asset('vendors/validator/validator.js') }}"></script>
    @yield('s')

      <script type="text/javascript">$('.Table').DataTable({
      "language": {
        "search": "Cari :",
        "lengthMenu": "Tampilkan _MENU_ data",
        "zeroRecords": "Tidak ada data",
        "emptyTable": "Tidak ada data",
        "info": "Menampilkan data _START_  - _END_  dari _TOTAL_ data",
        "infoEmpty": "Tidak ada data",
        "paginate": {
          "first": "Awal",
          "last": "Akhir",
          "next": ">",
          "previous": "<"
        }
      }
    });</script>
<script>
 function filterGlobal () {
    $('#ex').DataTable().search(
        $('#global_filter').val(),
    
    ).draw();
    }
    
    function filterColumn ( i ) {
        $('#ex').DataTable().column( i ).search(
            $('#col'+i+'_filter').val()
        ).draw();
    }
    
    $(document).ready(function() {
        $('#ex').DataTable();
        
        $('input.global_filter').on( 'keyup click', function () {
            filterGlobal();
        } );
    
        $('input.column_filter').on( 'keyup click', function () {
            filterColumn( $(this).parents('div').attr('data-column') );
        } );
    } );

        $('select.column_filter').on('change', function () {
            filterColumn( $(this).parents('div').attr('data-column') );
        } );
</script>
    <script>
    $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') 
  var modal = $(this)
  modal.find('.modal-body input').val(recipient)
})
</script>
  </body>
</html>
