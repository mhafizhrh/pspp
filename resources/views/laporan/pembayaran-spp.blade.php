<link rel="stylesheet" type="text/css" href="{{ public_path('klorofil/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<center>
	<h1>Laporan Pembayaran SPP</h1>
</center>
<table class="table table-bordered">
	@if (isset($from_date))
	<tr>
		<th width="150">Tgl. Dibayar</th>
		<td>
		@if($from_date == $to_date)
			{{ date('d/m/Y', strtotime($from_date)) }}
		@else
			{{ date('d/m/Y', strtotime($from_date)) }} s.d. {{ date('d/m/Y', strtotime($to_date)) }}
		@endif
		</td>
	</tr>
	@endif

	@if (isset($tahun))
	<tr>
		<th width="150">Tahun Pelajaran</th>
		<td>{{ $tahun }}</td>
	</tr>
	@endif

	@if (isset($bulan))
	<tr>
		<th width="150">Bulan</th>
		<td>
			@if ($bulan == 1)
				Januari
			@elseif ($bulan == 2)
				Februari
			@elseif ($bulan == 3)
				Maret
			@elseif ($bulan == 4)
				April
			@elseif ($bulan == 5)
				Mei
			@elseif ($bulan == 6)
				Juni
			@elseif ($bulan == 7)
				Juli
			@elseif ($bulan == 8)
				Agustus
			@elseif ($bulan == 9)
				September
			@elseif ($bulan == 10)
				Oktober
			@elseif ($bulan == 11)
				November
			@elseif ($bulan == 12)
				Desember
			@endif
		</td>
	</tr>
	@endif
</table>	
<table class="table table-bordered">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nama</th>
			<th>Kelas</th>
			<th>Petugas</th>
			@if(!isset($bulan))
			<th>Bulan</th>
			@endif
			@if(!isset($tahun))
			<th>Tahun Pelajaran</th>
			@endif
			<th scope="col">Nominal</th>
			<th>Tgl. Dibayar</th>
		</tr>
	</thead>
	<tbody>
		@foreach($spp as $s)

		<tr>
			<td>{{ $s->id_spp }}</td>
			<td>{{ $s->nama_siswa }}</td>
			<td>{{ $s->kelas }}</td>
			<td>{{ $s->name }}</td>
			@if(!isset($bulan))
			<td>
				@if ($s->bulan == 1)
					Januari
				@elseif ($s->bulan == 2)
					Februari
				@elseif ($s->bulan == 3)
					Maret
				@elseif ($s->bulan == 4)
					April
				@elseif ($s->bulan == 5)
					Mei
				@elseif ($s->bulan == 6)
					Juni
				@elseif ($s->bulan == 7)
					Juli
				@elseif ($s->bulan == 8)
					Agustus
				@elseif ($s->bulan == 9)
					September
				@elseif ($s->bulan == 10)
					Oktober
				@elseif ($s->bulan == 11)
					November
				@elseif ($s->bulan == 12)
					Desember
				@endif
			</td>
			@endif
			@if(!isset($tahun))
			<td>{{ $s->tahun_pelajaran }}</td>
			@endif
			<td>Rp. {{ number_format($s->nominal,2,",",".") }}</td>
			<td>{{ date('d/m/Y', strtotime($s->tgl_dibayar)) }}</td>
		</tr>

		@endforeach
		<tr>
			<th colspan="@if(isset($bulan)) 4 @elseif(isset($tahun)) 5 @elseif(isset($from_date)) 6 @else 4 @endif">Total</th>
			<td colspan="2">Rp. {{ number_format($total,2,",",".") }}</td>
		</tr>
	</tbody>
</table>