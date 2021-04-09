@extends('layout')

@section('subtitle', 'Data Siswa')
@section('content')

<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="lnr lnr-users"></i> Data Siswa</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4" style="margin-bottom: 10px">
				<form method="post" action="{{ route('data-siswa-redirect-keyword') }}">
					@csrf
					<div class="input-group">
						<input type="text" name="keyword" class="form-control" placeholder="Cari siswa" value="@if($keyword){{ $keyword }}@endif">
						<span class="input-group-btn">
							<button class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
						</span>
					</div>
				</form>
			</div>
			<div class="col-md-3">
				<a href="{{ url('data-siswa/tambah') }}" class="btn btn-success" style="margin-bottom: 10px"><i class="fa fa-plus-square"></i> Data Siswa Baru</a>
			</div>
		</div>
		<div class="row" style="margin-bottom: 10px">
			<div class="col-md-12 table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr >
							<th><i class="fa fa-card"></i> NIS</th>
							<th><i class="fa fa-user"></i> Nama Siswa</th>
							<th><i class="fa fa-home"></i> Kelas</th>
							<th colspan="2"><i class="fa fa-cogs"></i> Opsi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($siswa as $s)
						<tr>
							<td>{{ $s->nis }}</td>
							<td>{{ $s->nama_siswa }}</td>
							<td>{{ $s->kelas }}</td>
							<td><a href="{{ url('data-siswa/' . $s->nis) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
							<td>
								<form method="post">
									@method('DELETE')
									@csrf
									<input type="text" name="nis" value="{{ $s->nis }}" hidden="">
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