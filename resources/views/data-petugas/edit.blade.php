@extends('layout')

@section('subtitle', 'Edit Data Petugas')
@section('content')

<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-users"></i> Data Petugas</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form method="post">
					@method('PUT')
					@csrf
					<div class="form-group row">
						<label class="col-md-4">ID :</label>
						<div class="col-md-8">
							<input type="text" name="id" class="form-control" value="{{ $petugas->id }}" readonly="">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4">Nama :</label>
						<div class="col-md-8">
							<input type="text" name="name" class="form-control" value="{{ $petugas->name }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4">Email :</label>
						<div class="col-md-8">
							<input type="text" name="email" class="form-control" value="{{ $petugas->email }}">
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