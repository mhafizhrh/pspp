@extends('layout')

@section('subtitle', 'Tahun Pelajaran')
@section('content')

<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="lnr lnr-calendar"></i> Data Tahun Pelajaran</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
			@if(session('alert')) <script>swal("{{ session('alert')}}")</script>  @endif
			<div class="col-md-3 col-md-offset-3">
				<a href="{{ url('transaksi/atur-tahun-pelajaran/tambah') }}" class="btn btn-success" style="margin-bottom: 10px"><i class="fa fa-plus-square"></i> Tahun Pelajaran Baru</a>
			</div>
		</div>
		<div class="row" style="margin-bottom: 10px">
			<div class="col-md-6 table-responsive col-md-offset-3">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th><i class="fa fa-calendar"></i> Tahun Pelajaran</th>
						</tr>
					</thead>
					<tbody>
						@foreach($tahun_pelajaran as $t)
						<tr>
							<td>{{ $t->tahun_pelajaran }}</td>
							<td>
								<form method="post">
									@method('DELETE')
									@csrf
									<input type="text" name="id" value="{{ $t->id }}" hidden="">
									<button class="btn btn-danger btn-sm konfirmasi"><i class="fa fa-trash"></i> Hapus</button>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
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
			title: "Konfirmasi",
			text: "Data yang sudah dihapus tidak dapat dikembalikan!",
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