@extends('pv.tempvv')
@section('title', 'Data PDF')
@section('judulhalaman','Draf PDEp & PDF')
@section('content')

<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <div class="x_title">
            <h3><li class="fa fa-file-zip-o"> </li> Draf PDF</h3>
          </div>
          <div class="clearfix"></div>
          <div class="x_content" style="overflow-x: scroll;">
            <table class="table table-striped no-border">
              <thead>
                <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                  <th>#</th>
                  <th>No PDF</th>
                  <th>Brand</th>
                  <th>Project Name</th>
                  <th>Author</th>
                  <th>Created Date</th>
                  <th>Priority</th>
                  <th>Last Update</th>
                  <th width="11%" class="text-center">Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  @php
                    $no = 0;
                  @endphp
                  @foreach($pdf as $pdf)
                  @if($pdf->status_project=="draf")
                  <th>{{ ++$no }}</th>
                  <th>{{ $pdf->pdf_number }}{{ $pdf->ket_no }}</th>
                  <th>{{ $pdf->id_brand }}</th>
                  <th>{{ $pdf->project_name }}</th>
                  <th>{{ $pdf->author }}</th>
                  <th>{{ $pdf->created_date }}</th>
                  <th>
                    @if($pdf->prioritas==1)
                    <span class="label label-danger">High Priority</span>
                    @elseif($pdf->prioritas==2)
                    <span class="label label-warning">Standar Priority</span>
                    @elseif($pdf->prioritas==3)
                    <span class="label label-primary">Low Priority</span>
                    @endif
                  </th>
                  <th>{{ $pdf->last_updated }}</th>
                  <th class="text-center">{{ $pdf->status_project }}</th>
                  <th class="text-center">
                    <a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf)}}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                    <a href="{{route('hapuspdf',$pdf->id_project_pdf)}}" class="btn btn-danger btn-sm"><li class="fa fa-trash"></li></a>
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