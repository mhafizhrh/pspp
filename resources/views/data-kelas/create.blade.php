@extends('layout')
@section('subtitle', 'Data Kelas Baru')
@section('content')

<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-users"></i> Data Kelas</h3>
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
			@if (session('alert'))
				<div class="alert alert-success">
					<i class="fa fa-check"></i> {{ session('alert') }}
				</div>
			@endif
				<form method="post">
					@csrf
					<div class="form-group">
						<font color="red">* wajib di isi</font>
					</div>
					<div class="form-group row">
						<label class="col-md-4">Kelas<font color="red">*</font></label>
						<div class="col-md-8">
							<input type="text" name="kelas" class="form-control">
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

@endsection