@extends('layout')
@section('subtitle', 'Data Siswa Baru')
@section('content')

<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-users"></i> Data Siswa</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			@if (session('alert')) <div class="alert alert-success"><i class="fa fa-check"></i> {{ session('alert') }}</div> @endif
				<form method="post">
					@csrf
					<div class="form-group">
						<font color="red">* wajib di isi</font>
					</div>
					<div class="form-group row">
						<label class="col-md-4">NIS<font color="red">*</font></label>
						<div class="col-md-8">
							<input type="text" name="nis" class="form-control nis" value="{{ old('nis') }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4">Nama Lengkap<font color="red">*</font></label>
						<div class="col-md-8">
							<input type="text" name="nama_siswa" class="form-control" value="{{ old('nama_siswa') }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4">Kelas<font color="red">*</font></label>
						<div class="col-md-8">
							<select class="form-control" name="kelas">
								<option selected="" value="">Pilih Kelas</option>
								@foreach($kelas as $k)

								<option @if(old('kelas') == $k->id) selected @endif value="{{ $k->id }}">{{ $k->kelas }}</option>

								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4">Alamat<font color="red">*</font></label>
						<div class="col-md-8">
							<textarea type="text" name="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4">No. Telepon</label>
						<div class="col-md-8">
							<input type="text" name="no_telp" class="form-control" value="{{ old('no_telp') }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-4">Username (sesuai NIS)<font color="red">*</font></label>
						<div class="col-md-8">
							<input type="text" name="username" class="form-control username" readonly="" value="{{ old('username') }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4">Password<font color="red">*</font></label>
						<div class="col-md-8">
							<input type="text" name="password" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<button class="btn btn-primary pull-right"><i class="fa fa-plus-square"></i> Tambah</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('klorofil') }}/assets/vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('.nis').on('keyup', function(){

		var nis = $('.nis').val();
		$('.username').val(nis);
	});
});
</script>

@endsection