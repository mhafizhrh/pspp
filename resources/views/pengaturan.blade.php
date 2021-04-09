@extends('layout')

@section('subtitle', 'Pengaturan')
@section('content')

<div class="row">
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-user"></i> Profil</h3>
			</div>
			<div class="panel-body">
				@if (Auth::user()->level == 'siswa')
				<div class="form-group row">
					<label class="col-md-4">NIS</label>
					<div class="col-md-8">
						<input type="text" class="form-control" value="{{ $siswa->nis }}" readonly="">
					</div>
				</div>
				@endif
				<div class="form-group row">
					<label class="col-md-4">Nama</label>
					<div class="col-md-8">
						<input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly="">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-4">Status</label>
					<div class="col-md-8">
						<input type="text" class="form-control" value="{{ Str::ucfirst(Auth::user()->level) }}" readonly="">
					</div>
				</div>
				@if (Auth::user()->level == 'siswa')
				<div class="form-group row">
					<label class="col-md-4">Kelas</label>
					<div class="col-md-8">
						<input type="text" class="form-control" value="{{ $siswa->kelas }}" readonly="">
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-key"></i> Ubah Password</h3>
			</div>
			<div class="panel-body">
				<form method="post">
					@method('PUT')
					@csrf
					<div class="form-group row">
						<div class="col-md-12">
						@if ($errors->any())
						    <div class="alert alert-danger">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li>{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif

						@if(session('status'))
							<div class="alert alert-success">{{ session('status') }}</div>
						@endif
						
						@if(session('error'))
							<div class="alert alert-danger">{{ session('error') }}</div>
						@endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4">Password Saat Ini</label>
						<div class="col-md-8">
							<input type="password" name="old_password" class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4">Password Baru</label>
						<div class="col-md-8">
							<input type="password" name="new_password" class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4">Konfirmasi Password Baru</label>
						<div class="col-md-8">
							<input type="password" name="new_password_confirmation" class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<button class="btn btn-default pull-right"><i class="fa fa-save"></i> Ubah</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection