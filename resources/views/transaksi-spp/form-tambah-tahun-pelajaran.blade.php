@extends('layout')

@section('subtitle', 'Tahun Pelajaran Baru')
@section('content')

<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-users"></i> Data Siswa</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			@if (session('alert')) <script>swal("{{ session('alert')}}")</script> @endif
				<form method="post">
					@csrf
					<div class="form-group">
						<a href="{{ url('transaksi/atur-tahun-pelajaran') }}" class="btn btn-danger"><i class="fa fa-chevron-left"></i> Kembali</a>
					</div>
					<div class="form-group">
						<font color="red">* wajib di isi</font>
					</div>
					<div class="form-group row">
						<label class="col-md-4">Tahun Pelajaran<font color="red">*</font></label>
						<div class="col-md-8 row">
							<div class="col-md-5">
								<input type="text" name="tahun_pelajaran1" class="form-control" placeholder="1999...." id="tahun_pelajaran1">
							</div>
							<div class="col-md-2"><center><b>/</b></center></div>
							<div class="col-md-5">
								<input type="text" name="tahun_pelajaran2" class="form-control" id="tahun_pelajaran2" placeholder="Otomatis" readonly="">
							</div>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('klorofil') }}/assets/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#tahun_pelajaran1").on('keyup', function(){
		const tahun_pelajaran1 = parseInt($("#tahun_pelajaran1").val());
		const tahun_pelajaran2 = tahun_pelajaran1+1;

		$("#tahun_pelajaran2").val(tahun_pelajaran2);
	});
});
</script>

@endsection