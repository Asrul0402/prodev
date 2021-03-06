@extends('pv.tempvv')
@section('title', 'Data PKP promo')
@section('judulhalaman','Draf PKP pPromo')
@section('content')

<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-file-zip-o"> </li> Draf PROMO</h3>
        </div>
          <div class="x_content">
            <table class="Table table-striped no-border">
              <thead>
                <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                  <th>#</th>
                  <th>No PKP</th>
                  <th>Brand</th>
                  <th>Project Name</th>
                  <th>Author</th>
                  <th>Date</th>
                  <th>Last update</th>
                  <th>Priority</th>
                  <th width="11%" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  @php
                    $no = 0;
                  @endphp
                  @foreach($promo as $pkp)
                  @if($pkp->status_project=="draf")
                  <th>{{ ++$no }}</th>
                  <th></th>
                  <th>{{ $pkp->brand }}</th>
                  <th>{{ $pkp->project_name }}</th>
                  <th>{{ $pkp->Author }}</th>
                  <th>{{ $pkp->created_date }}</th>
                  <th></th>
                  <th></th>
                  <th class="text-center">
                    <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                    <a href="{{route('hapuspromo',$pkp->id_pkp_promo)}}" class="btn btn-danger btn-sm"><li class="fa fa-trash"></li></a>
                    {{csrf_field()}}
                  </th>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
