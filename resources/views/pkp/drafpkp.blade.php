@extends('pv.tempvv')
@section('title', 'Draf PKP')
@section('judulhalaman','Draf PKP')
@section('content')

<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-file-zip-o"> </li> Draf PKP</h3>
        </div>
        <div class="x_content" style="overflow-x: scroll;">
          <table class="Table table-striped border">
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
              <tr style="">
                @php
                  $no = 0;
                @endphp
                @foreach($pkp as $pkp)
                @if($pkp->status_project=='draf')
                <th class="text-center">{{ ++$no}}</th>
                <th>{{ $pkp->no_pkp }}{{ $pkp->ket_no }}</th>
                <th>{{ $pkp->id_brand }}</th>
                <th>{{ $pkp->project_name }}</th>
                <th>{{ $pkp->author }}</th>
                <th>{{ $pkp->created_date }}</th>
                <th>{{ $pkp->last_update }}</th>
                <th>
                  @if($pkp->prioritas==1)
                  <span class="label label-danger">High Priority</span>
                  @elseif($pkp->prioritas==2)
                  <span class="label label-warning">Standar Priority</span>
                  @elseif($pkp->prioritas==3)
                  <span class="label label-primary">Low Priority</span>
                  @endif
                </th>
                <th class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-edit"></i></a>
                  <a href="{{route('hapuspkp',$pkp->id_project)}}" class="btn btn-danger btn-sm"><li class="fa fa-trash"></li></a>
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

@endsection
