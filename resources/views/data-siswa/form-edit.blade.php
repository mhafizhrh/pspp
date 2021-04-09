@extends('layout')

@section('subtitle', 'Edit Data Siswa')
@section('content')

<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-users"></i> Data Siswa</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form method="post">
					@method('PUT')
					@csrf
					<div class="form-group row">
						<label class="col-md-4">NIS :</label>
						<div class="col-md-8">
							<input type="text" name="nis" class="form-control" value="{{ $siswa->nis }}" readonly="">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4">Nama Lengkap :</label>
						<div class="col-md-8">
							<input type="text" name="nama_siswa" class="form-control" value="{{ $siswa->nama_siswa }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4">Kelas :</label>
						<div class="col-md-8">
							<select class="form-control" name="id_kelas">
								@foreach($kelas as $k)

								<option @if($siswa->id_kelas == $k->id) selected @endif value="{{ $k->id }}">{{ $k->kelas }}</option>

								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('klorofil') }}/assets/vendor/jquery/jquery.min.js"></script>

@if(session('alert'))
<script>
	swal("{{ session('alert') }}", "", "success");
</script>
@endif

@endsection