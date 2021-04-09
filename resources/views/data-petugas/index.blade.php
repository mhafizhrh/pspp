@extends('layout')

@section('subtitle', 'Data Petugas')
@section('content')

<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="lnr lnr-users"></i> Data Petugas</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4" style="margin-bottom: 10px">
				<form method="post" action="{{ route('data-petugas-redirect-keyword') }}">
					@csrf
					<div class="input-group">
						<input type="text" name="keyword" class="form-control" placeholder="Cari petugas" value="@if($keyword){{ $keyword }}@endif">
						<span class="input-group-btn">
							<button class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
						</span>
					</div>
				</form>
			</div>
			<div class="col-md-3">
				<a href="{{ route('create-data-petugas') }}" class="btn btn-success" style="margin-bottom: 10px"><i class="fa fa-plus-square"></i> Data Petugas Baru</a>
			</div>
		</div>
		<div class="row" style="margin-bottom: 10px">
			<div class="col-md-12 table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr >
							<th><i class="fa fa-card"></i> Nama</th>
							<th><i class="fa fa-email"></i> Email</th>
							<th colspan="2"><i class="fa fa-cogs"></i> Opsi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($petugas as $p)
						<tr>
							<td>{{ $p->name }}</td>
							<td>{{ $p->email }}</td>
							<td><a href="{{ url('data-petugas/' . $p->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
							<td>
								<form method="post">
									@method('DELETE')
									@csrf
									<input type="text" name="id" value="{{ $p->id }}" hidden="">
									<button class="btn btn-danger btn-sm konfirmasi"><i class="fa fa-trash"></i> Hapus</button>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-md-12">
				{{ $petugas->links() }}
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