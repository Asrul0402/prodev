@extends('admin.tempadmin')
@section('title', 'detailuser')
@section('judulhalaman','User Management')
@section('content')

@if (session('status'))
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('status') }}
    </div>
  </div>
</div>
@endif

<div class="card">
  <div class="card-header">
    <h5>Edit Data</h5>
  </div>
  <div class="card-block">
    <div id="overview" class="tab-pane active">
      <div class="row">
        <div class="col-md-5 profile-text mt mb centered">
          <div class="right-divider hidden-sm hidden-xs">
            <div class="profile-pic">
              <p  class="text-center"><img src="{{ asset('img/prodev.png') }}" class="img-circle"></p>
            </div>
          </div>
          <h3 class="text-center">{{ $users->name}}</h3>
          <p  class="text-center">Last update : {{ $users->updated_at}}</p>
          <p  class="text-center"><button class="btn btn-info"><i class="fa fa-check"></i> {{ $users->status}}</button></p>
        </div>
        <div class="col-md-7 centered">
          <div class="row">
            <div class="col-lg-8 col-lg-offset-2 detailed">
              <h4 class="mb">Edit User Profile</h4>
              <div class="form">
                <form class="cmxform form-horizontal style-form" method="POST" action="{{ route('userupdate',$users->id) }}">
                  <br>
                  <input class="form-control" id="name" name="name" placeholder="nama" value="{{ $users->name }}" type="text" minlength="2" autofocus required/>
                  <br>
                  <input class="form-control" id="username" name="username" placeholder="username" value="{{ $users->username }}" type="text" minlength="6" maxlength="12" required/>
                  <br>
                  <input class="form-control" id="email" name="email" placeholder="E-mail" value="{{ $users->email }}" type="email" required/>
                  <br>
                  <select id="departement" name="departement" class="form-control" >
                    @foreach($depts as $dept)
                    <option value="{{  $dept->id }}"{{ ( $dept->id == $users->departement_id ) ? ' selected' : '' }} >{{ $dept->dept }}</option>
                    @endforeach
                  </select>
                  <br>
                  <select class="form-control" id="role" name="role">
                    @foreach($roles as $role)
                    <option value="{{  $role->id }}"{{ ( $role->id == $users->role_id ) ? ' selected' : '' }}>{{ $role->namaRule }}</option>
                    @endforeach
                  </select>
                  <br>
                  <button class="btn btn-info btn-block" type="submit"><i class="fa fa-edit"></i> Simpan Perubahan</button>
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  @include('formerrors')
                </form>
              </div>   
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection