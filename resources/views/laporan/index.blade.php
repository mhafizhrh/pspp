@extends('layout')

@section('subtitle', 'Laporan')
@section('content')

<div class="row">
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Laporan Pembayaran SPP</h3>
			</div>
			<div class="panel-body">

				<form method="post" action="{{ route('laporan-pembayaran-spp') }}">
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
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3">Tgl. Dibayar</label>
						<div class="col-md-4">
							<input type="date" name="from_date" value="{{ date('Y-m-d') }}" class="form-control">
						</div>
						<div class="col-md-1">
							s.d
						</div>
						<div class="col-md-4">
							<input type="date" name="to_date" value="{{ date('Y-m-d') }}" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-default pull-left" name="type" value="view"><i class="fa fa-eye"></i> Lihat Laporan</button>
						<button class="btn btn-default pull-right" name="type" value="download"><i class="fa fa-file-pdf-o"></i> Unduh PDF</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Laporan Pembayaran SPP Perbulan</h3>
			</div>
			<div class="panel-body">
				<form method="post" action="{{ route('laporan-pembayaran-spp-perbulan') }}">
					@csrf
					<div class="form-group row">
						<label class="col-md-3">Bulan</label>
						<div class="col-md-9">
							<select class="form-control" name="bulan">
								<option value="1">Januari</option>
								<option value="2">Februari</option>
								<option value="3">Maret</option>
								<option value="4">April</option>
								<option value="5">Mei</option>
								<option value="6">Juni</option>
								<option value="7">Juli</option>
								<option value="8">Agustus</option>
								<option value="9">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3">Tahun Pelajaran</label>
						<div class="col-md-9">
							<select class="form-control" name="tahun">
								@foreach($tahun_pelajaran as $t)

								<option>{{ $t->tahun_pelajaran }}</option>

								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-default pull-left" name="type" value="view"><i class="fa fa-eye"></i> Lihat Laporan</button>
						<button class="btn btn-default pull-right" name="type" value="download"><i class="fa fa-file-pdf-o"></i> Unduh PDF</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Laporan Pembayaran SPP Pertahun</h3>
			</div>
			<div class="panel-body">
				<form method="post" action="{{ route('laporan-pembayaran-spp-pertahun') }}">
					@csrf
					<div class="form-group row">
						<label class="col-md-3">Tahun Pelajaran</label>
						<div class="col-md-9">
							<select class="form-control" name="tahun">
								@foreach($tahun_pelajaran as $t)

								<option>{{ $t->tahun_pelajaran }}</option>

								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-default pull-left" name="type" value="view"><i class="fa fa-eye"></i> Lihat Laporan</button>
						<button class="btn btn-default pull-right" name="type" value="download"><i class="fa fa-file-pdf-o"></i> Unduh PDF</button>
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


<script type="text/javascript">

$(document).ready(function(){
	$('.konfirmasi').on('click', function(e){
		e.preventDefault();
		var form = $(this).parents('form');
		console.log(this.value);
		swal({
			title: "Data yang sudah dihapus tidak dapat dikembalikan!",
			text: "",
			type: "warning",
			showCancelButton: true,
	        cancelButtonText: "Batal",
	        confirmButtonColor: "#cc3f44",
	        confirmButtonText: "Hapus",
		}).then(function(isConfirm){
			if (isConfirm.value) {
				form.submit();
				console.log(isConfirm);
			} else {
				return false;
			}
		});
	});
});

</script>

@endsection