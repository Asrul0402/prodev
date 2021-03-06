@extends('admin.tempadmin')

@section('title', 'Approved User')

@section('judulhalaman','User Management')

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-users"> List User</li></h3>
  </div>
	<div class="card-block">
    <div class="dt-responsive table-responsive">
      <table class="Table table-striped table-bordered nowrap">
        <thead>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th>Nama</th>
						<th>Username</th>
						<th>Email</th>
						<th class="text-center">Departement</th>
						<th>Level</th>
						<th class="text-center">Status</th>
						<th class="text-center">Action</th>
					</tr>
        </thead>
        <tbody>
				@foreach ($users as $user)
				@if($user->status =='active' || $user->status =='nonactive')
				<tr>
					<td>{{ $user->name}}</td>
					<td>{{ $user->username}}</td>
					<td>{{ $user->email}}</td>
					<td class="text-center">{{ $user->departement->dept}}</td>
					<td>{{ $user->role->namaRule}}</td>
					<td class="text-center">
						@if ($user->status == 'sending')
						<span class="label label-warning">Sending</span>                        
						@endif
						@if ($user->status == 'active')
					  <span class="label label-primary">Active</span>                        
						@endif 
						@if ($user->status == 'nonactive')
				    <span class="label label-danger">NonActive</span>                        
						@endif 
					</td>
					<td class="text-center">
    				{{csrf_field()}}
    				<a class="btn-sm btn-success" href="{{ route('showuser',$user->id) }}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
    				<a class="btn-sm btn-info" href="{{ route('showuser',$user->id) }}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
    				@if($user->status == 'active')
    				<a class="btn-sm btn-danger" href="{{ route('userblok',$user->id) }}" data-toggle="tooltip" title="Block"><i class="fa fa-trash-o"></i></a>
    				@elseif($user->status == 'nonactive')
    				<a class="btn-sm btn-primary" href="{{ route('openblok',$user->id) }}">Buka Blokir</a>
    				@endif
					</td>		
				</tr>
				@endif
				@endforeach
      	</tbody>
    	</table>
  	</div>
	</div>
</div>
@endsection