@extends('layout')

@section('subtitle', 'Dashboard')
@section('content')

@if (Auth::user()->level == 'admin' || Auth::user()->level == 'petugas')

<!-- OVERVIEW -->
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Dashboard</h3>
		<p class="panel-subtitle">{{ date('d/m/Y') }}</p>
	</div>
	<div class="panel-body">
		<div class="row">
			@if (Auth::user()->level == 'admin')
			<div class="col-md-6">
				<div class="metric">	<span class="icon"><i class="fa fa-money"></i></span>
					<p>	<span class="number">Rp. {{ number_format($pemasukan,2,",",".") }}</span>
						<span class="title">Jumlah Pemasukan Hari Ini</span>
					</p>
				</div>
			</div>
			@endif
			<div class="col-md-6">
				<div class="metric">
					<span class="icon"><i class="fa fa-users"></i></span>
					<p>
						<span class="number">{{ $jumlah_siswa }}</span>
						<span class="title">Jumlah Siswa</span>
					</p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="metric">
					<span class="icon"><i class="fa fa-users"></i></span>
					<p>
						<span class="number">{{ $jumlah_petugas }}</span>
						<span class="title">Jumlah Petugas</span>
					</p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="metric">
					<span class="icon"><i class="fa fa-home"></i></span>
					<p>
						<span class="number">{{ $jumlah_kelas }}</span>
						<span class="title">Jumlah Kelas</span>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

@endif

@if (Auth::user()->level == 'siswa')

<div class="row">
	<div class="col-md-5">
		<div class="panel panel-headline">
			<div class="panel-heading">
				<h3 class="panel-title">Data Siswa</h3>
				<p class="panel-subtitle">Today is {{ date('l, d M Y') }}</p>
			</div>
			<div class="panel-body">
				<div class="row">
				    <div class="col-md-12">
				        <div class="form-group row">
				            <label class="col-md-4">NIS</label>
				            <div class="col-md-8">
				                <div class="input-group">
				                    <input type="text" id="search_nis" class="form-control" placeholder="NIS" value="{{ $siswa->nis }}" readonly="">
				                    <span class="input-group-addon cari-siswa"><i class="fa fa-user"></i></span>
				                </div>
				            </div>
				        </div>
				        <div class="form-group row">
				            <label class="col-md-4">Nama Lengkap</label>
				            <div class="col-md-8">
				                <input type="text" name="" class="form-control" id="nama"  readonly="">
				            </div>
				        </div>
				        <div class="form-group row">
				            <label class="col-md-4">Kelas</label>
				            <div class="col-md-8">
				                <input type="text" name="" class="form-control" id="kelas" readonly="">
				            </div>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="panel panel-headline">
			<div class="panel-heading">
				<h3 class="panel-title">SPP Siswa</h3>
				<p class="panel-subtitle">Today is {{ date('l, d M Y') }}</p>
			</div>
			<div class="panel-body">
				<div class="row">
				    <div class="col-md-12">
						<div class="form-group row">
						    <label class="col-md-4">Tahun Pelajaran</label>
						    <div class="col-md-8">
						        <select class="form-control" id="tahun_pelajaran">
						            <!-- <option value="" selected="">Pilih Tahun Pelajaran</option> -->
						        </select>
						    </div>
						</div>
						<div class="form-group">
						    <button type="button" id="refresh" class="btn btn-default"><i class="fa fa-repeat"></i> Refresh</button>
						</div>
						<div class="table-responsive">
						    <table class="table table-hovered table-bordered">
						        <thead>
						            <tr>
						                <th>Bulan</th>
						                <th>Petugas</th>
						                <th>Tgl. Bayar</th>
						                <th>Nominal</th>
						                <th>Status</th>
						            </tr>
						        </thead>
						        <tbody id="dataSPPSiswa">

						        </tbody>
						    </table>
						</div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('klorofil') }}/assets/vendor/jquery/jquery.min.js"></script>
<script>
	
	$(document).ready(function(){

		const nis = $("#search_nis").val();
		const token = '{{ csrf_token() }}';
		console.log("NIS : " + nis + ", TOKEN : " + token);
		$.ajax({
			url: '{{ url("transaksi/cari-data-siswa") }}',
			data: {nis: nis, _token: token},
			type: 'POST',
			beforeSend: function(){
				$(".cari-siswa").html("<i class='fa fa-spin fa-spinner fa-lg'></i>");
			},
			success: function(data){

				$(".cari-siswa").html("<i class='fa fa-user'></i>");
				console.log(data);

				if (data.error == 404) {

					$("#nama").val(null);
					$("#kelas").val(null);
					// $("#tahun_pelajaran").html('<option value="" selected>Pilih Tahun Pelajaran</option>');
					$("#refresh").click();
					$(".form-bayar").html(null);
					swal(data.message, "", "error");
				} else {

					// $("#tahun_pelajaran").html('<option value="" selected>Pilih Tahun Pelajaran</option>');
					for (var i = 0; i < data.tahun_pelajaran.length; i++) {
						var select = document.getElementById('tahun_pelajaran');
						var option = document.createElement('option');
						option.text = data.tahun_pelajaran[i].tahun_pelajaran;
						select.add(option);
					}

					console.log(data.data_siswa);

					$("#nama").val(data.data_siswa[0].nama_siswa);
					$("#kelas").val(data.data_siswa[0].kelas);

					spp_siswa()
				}
			},
			error: function(error){
				$(".cari-siswa").html("<i class='fa fa-user'></i>");
				swal("Terjadi kesalahan saat mencari Data Siswa.", "", "error");
			}
		});
	});

	$("#tahun_pelajaran").on('change', function(){
		spp_siswa();
	});

	$("#refresh").on('click', function(){
		spp_siswa();
	});

	function spp_siswa() {

		const tahun_pelajaran = $("#tahun_pelajaran").val();
		const nis = $("#search_nis").val();
		const token = '{{ csrf_token() }}';
		$.ajax({
			url: '{{ url("transaksi/data-spp-siswa") }}',
			data: {tahun_pelajaran: tahun_pelajaran, nis: nis, _token: token, level: 'siswa'},
			type: 'POST',
			beforeSend: function(){
				$("#dataSPPSiswa").html("<tr><td colspan='5'><center><i class='fa fa-spin fa-spinner fa-lg'></i></center></td></tr>");
			},
			success: function(data){
				$("#dataSPPSiswa").html(data);
			},
			error: function(){
				swal("Terjadi masalah saat memuat Tahun Pelajaran.", "", "error");
			}
		});
	}
</script>

@endif

@endsection