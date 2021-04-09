@extends('layout')

@section('subtitle', 'Riwayat Pembayaran SPP')
@section('content')

<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-history"></i> Riwayat Pembayaran SPP</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4" style="margin-bottom: 10px">
				<form method="post" action="{{ route('riwayat-spp-redirect-keyword') }}">
				@csrf
				<div class="input-group">
					<input type="text" name="keyword" class="form-control" placeholder="Cari nama, kelas, petugas, tahun pelajaran, dan nominal..." value="@if($keyword){{ $keyword }}@endif">
					<span class="input-group-btn">
						<button class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
					</span>
				</div>
				</form>
			</div>
		</div>
		<div class="row" style="margin-bottom: 10px">
			<div class="col-md-12 table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th><i class="fa fa-user"></i> Nama Siswa</th>
							<th><i class="fa fa-home"></i> Kelas</th>
							<th><i class="fa fa-info-circle"></i> Petugas</th>
							<th><i class="fa fa-calendar"></i> Tahun Pelajaran</th>
							<th><i class="fa fa-calendar"></i> Bulan</th>
							<th><i class="fa fa-money"></i> Nominal</th>
							<th><i class="fa fa-calendar"></i> Tgl. Dibayar</th>
						</tr>
					</thead>
					<tbody>
						@foreach($riwayatSPP as $r)
						<tr>
							<td>{{ $r->id_spp }}</td>
							<td>{{ $r->nama_siswa }}</td>
							<td>{{ $r->kelas }}</td>
							<td>{{ $r->name }}</td>
							<td>{{ $r->tahun_pelajaran }}</td>
							<td>
								@if ($r->bulan == 1)
									Januari
								@elseif ($r->bulan == 2)
									Februari
								@elseif ($r->bulan == 3)
									Maret
								@elseif ($r->bulan == 4)
									April
								@elseif ($r->bulan == 5)
									Mei
								@elseif ($r->bulan == 6)
									Juni
								@elseif ($r->bulan == 7)
									Juli
								@elseif ($r->bulan == 8)
									Agustus
								@elseif ($r->bulan == 9)
									September
								@elseif ($r->bulan == 10)
									Oktober
								@elseif ($r->bulan == 11)
									November
								@elseif ($r->bulan == 12)
									Desember
								@endif
							</td>
							<td>Rp. {{ number_format($r->nominal,2,",",".") }}</td>
							<td>{{ date('d/m/Y', strtotime($r->tgl_dibayar)) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-md-12">
				{{ $riwayatSPP->links() }}
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('klorofil') }}/assets/vendor/jquery/jquery.min.js"></script>
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