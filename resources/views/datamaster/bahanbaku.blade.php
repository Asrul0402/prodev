@extends('admin.tempadmin')

@section('title', 'Data BahanBaku')

@section('judulnya','Data BahanBaku')

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

<div class="col-md-12">
  <a type="button" class="btn btn-info" data-toggle="modal" data-target="#add_bahan"><i class="fa fa-plus"></i> Tambah Bahan Baku</a>
	<div class="showback">
	<table class="table" style="font-size:12px" id="Table">
		<thead>
			<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
    		<th>ID</th>
    		<th>Nama_Sederhana</th>
    		<th>Nama_Bahan </th>
    		<th>Kode_Oracle</th>
    		<th>Kode_Komputer</th>
    		<th>Supplier</th>
    		<th>Principle</th>
    		<th>no_HEIPBR</th>
    		<th>PIC</th>
    		<th>Cek Halal</th>
    		<th>Berat</th>
    		<th>Satuan</th>
    		<th>Kategori</th>
    		<th>Harga Satuan</th>
    		<th>Currency</th>
    		<th>User</th>
    		<th>Kelompok</th>
    		<th>Status</th>
    		<th>Created</th>
    		<th>Updated</th>
    		<th>Action</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($bahans as $bahan)
			<tr>
				<td>{{ $bahan->id }}</td>
				<td>{{ $bahan->nama_sederhana }}</td>
				<td>{{ $bahan->nama_bahan }}</td>
				<td>{{ $bahan->kode_oracle }}</td>
				<td>{{ $bahan->kode_komputer }}</td>
				<td>{{ $bahan->supplier }}</td>
				<td>{{ $bahan->principle }}</td>
				<td>{{ $bahan->no_HEIPBR }}</td>
				<td>{{ $bahan->PIC }}</td>
				<td>{{ $bahan->cek_halal }}</td>
				<td>{{ $bahan->berat }}</td>
				<td>{{ $bahan->satuan->satuan }}</td>
				<td>{{ $bahan->subkategori_id }}</td>
				<td>{{ $bahan->harga_satuan }}</td>
				<td>{{ $bahan->curren->currency }}</td>
				<td>{{ $bahan->user->name }}</td>
				<td>{{ $bahan->kelompok->nama }}</td>
				<td>{{ $bahan->status }}</td>
				<td>{{ $bahan->created_at }}</td>
				<td>{{ $bahan->updated_at }}</td>
				<td>
				  <a class="btn btn-primary" href="{{ route('updatebahan',$bahan->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
				  {{-- <a class="btn btn-danger" onclick="return confirm('Hapus Bahan Baku ?')" href="{{ route('delbahan',$bahan->id) }}"><i class="fa fa-trash-o"></i></a> --}}
    			@if($bahan->status == 'active')
    			<a class="btn btn-warning" onclick="return confirm('NonAktif BahanBaku ?')" href="{{ route('nonactivebahan',$bahan->id) }}" data-toggle="tooltip" data-placement="top" title="NonActive"><i class="fa fa-minus"></i></a>
    			@elseif($bahan->status == 'nonactive')
    			<a class="btn btn-info" onclick="return confirm('Aktifkan BahanBaku ?')" href="{{ route('activebahan',$bahan->id) }}" data-toggle="tooltip" data-placement="top" title="Aktifkan"><i class="fa fa-check"></i></a>
    			@endif
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>      
  </div>
</div>

@endsection

<!-- Add New Ingredient -->
<div class="modal fade" id="add_bahan" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah BahanBaku</h4>
      </div>
      <div class="modal-body">          
        <div class="col-md-12">
          <form method="POST" action="{{ route('addbahan') }}">
          <div class="row">
           <div class="col-lg-6 col-md-6 col-sm-6">
              <label for="nama_sederhana" class="control-label">Nama Sederhana</label>
              <input class="form-control" id="nama_sederhana" name="nama_sederhana"  type="text" value="{{ old('nama_sederhana') }}" required />
              <label for="nama_bahan" class="control-label">Nama Bahan</label>
              <input class="form-control" id="nama_bahan" name="nama_bahan"  type="text" value="{{ old('nama_bahan') }}" required />
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <label for="kode_oracle" class="control-label">Kode_Oracle</label>
                  <input class="form-control" id="kode_oracle" name="kode_oracle"  type="text" value="{{ old('kode_oracle') }}"  />
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <label for="kode_komputer" class="control-label">Kode_Komputer</label>
                  <input class="form-control" id="kode_komputer" name="kode_komputer"  type="text" value="{{ old('kode_komputer') }}"  />
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <label for="supplier" class="control-label">Supplier</label>
                  <input class="form-control" id="supplier" name="supplier"  type="text" value="{{ old('supplier') }}" required />
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <label for="principle" class="control-label">Principle</label>
                  <input class="form-control" id="principle" name="principle"  type="text" value="{{ old('principle') }}" required />
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <label for="no_HEIPBR" class="control-label">No HEIPBR</label>
                  <input class="form-control" id="no_HEIPBR" name="no_HEIPBR"  type="text" value="{{ old('no_HEIPBR') }}"  />
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <label for="PIC" class="control-label">PIC</label>
                  <input class="form-control" id="PIC" name="PIC"  type="text" value="{{ old('PIC') }}"  />
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <label for="cek_halal" class="control-label">Cek Halal</label>
                  <input class="form-control" id="cek_halal" name="cek_halal"  type="text" value="{{ old('cek_halal') }}"  />
                </div>
              </div>            
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <label for="" class="control-label">Kategori</label><br>
                  <select id="subkategori" name="subkategori" class="form-control" style="width:200px;">
                    @foreach($subkategoris as $subkategori) 
                    <option value="{{  $subkategori->id }}" {{ old('subkategori') == $subkategori->id ? 'selected' : '' }}>{{ $subkategori->subkategori }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <label for="" class="control-label">kelompok</label><br>
                  <select id="kelompok" name="kelompok" class="form-control" style="width:200px;">
                    @foreach($kelompoks as $kelompok) 
                    <option value="{{  $kelompok->id }}" {{ old('kelompok') == $kelompok->id ? 'selected' : '' }}>{{ $kelompok->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6">
                  <label for="berat" class="control-label">Berat</label>
                  <input type="number" step="any" class="form-control" id="berat" name="berat" value="{{ old('berat') }}" required />
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                	<label for="" class="control-label">Satuan</label><br>
                	<select id="satuan" name="satuan" class="form-control" style="width:200px;">
                  	@foreach($satuans as $satuan) 
                  	<option value="{{  $satuan->id }}" {{ old('satuan') == $satuan->id ? 'selected' : '' }} >{{ $satuan->satuan }}</option>
                  	@endforeach
                	</select>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <label for="harga_satuan" class="control-label">Harga Satuan</label>
                  <input type="number" step="any" class="form-control" id="harga_satuan" name="harga_satuan" value="{{ old('harga_satuan') }}" required />
								</div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <label for="" class="control-label">Currency</label><br>
                  <select id="curren" name="curren" class="form-control" style="width:200px;">
                    @foreach($currens as $curren) 
                    <option value="{{  $curren->id }}" {{ old('curren') == $curren->id ? 'selected' : '' }}>{{ $curren->currency }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="custom_kelompok" class="control-label"></label>
                  <input type="text"  class="form-control" name="custom_kelompok" id="custom_kelompok" placeholder="Kelompok Baru">
                  <input type="checkbox" name="c_kelompok" id="c_kelompok" class="control-label">
                  <label for="c_kelompok">Jadikan Kelompok Bahan ?</label>
                </div>
              </div><br><br>
              {{ csrf_field() }}
            </div>
          </div>
        </div>
			</div>
      <div class="modal-footer">
        <input type="hidden" name="user" value="{{ Auth::id() }}">
        <input type="submit" class="btn btn-primary" value="+ Submit">
        <a type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> BATAL</a>
        </form>
      </div>
    </div>
  </div>
</div>

@section('s')
<script type="text/javascript">
  $('#subkategori').select2();
  $('#kelompok').select2();
  $('#satuan').select2();
  $('#curren').select2();
</script>
@endsection

