@for ($i = 1; $i < 13; $i++)
<tr>
	<td>
	@if ($i == 1)
		Januari
	@elseif ($i == 2)
		Februari
	@elseif ($i == 3)
		Maret
	@elseif ($i == 4)
		April
	@elseif ($i == 5)
		Mei
	@elseif ($i == 6)
		Juni
	@elseif ($i == 7)
		Juli
	@elseif ($i == 8)
		Agustus
	@elseif ($i == 9)
		September
	@elseif ($i == 10)
		Oktober
	@elseif ($i == 11)
		November
	@elseif ($i == 12)
		Desember
	@endif
	</td>

	@if ($tahun_pelajaran != '' && count($data_spp) <= 0)

			<td></td>
			<td></td>
			<td></td>
			<td>
				@if ($level != 'siswa')
				<center>
				<a class="btn btn-default btnBayar" href="#form-bayar" data-value="{{ $i }}"><i class="fa fa-chevron-right"></i> Pembayaran</a>
				</center>
				@endif
			</td>

	@endif

	@foreach($data_spp as $d)

		@if ($d->bulan == $i)

			<td>{{ $d->name }}</td>
			<td>{{ date('d/m/Y', strtotime($d->tgl_dibayar)) }}</td>
			<td>Rp. {{ number_format($d->nominal,2,",",".") }}</td>
			<td><center><span class="label label-success">Lunas</span></center></td>

			@break

		@endif

		@if ($loop->iteration == $loop->count)
				<td></td>
				<td></td>
				<td></td>
				<td>
					@if ($level != 'siswa')
					<center>
					<a class="btn btn-default btnBayar" href="#form-bayar" data-value="{{ $i }}"><i class="fa fa-chevron-right"></i> Pembayaran</a>
					</center>
					@endif
				</td>
		@endif

	@endforeach
</tr>

@endfor

<script type="text/javascript">
$(document).ready(function(){

	$(".btnBayar").on('click', function(){

		var int_bulan = $(this).data("value");
		var bulan = '';

		if (int_bulan == 1) {

			bulan = 'Januari';
		} else if (int_bulan == 2) {

			bulan = 'Februari';
		} else if (int_bulan == 3) {

			bulan = 'Maret';
		} else if (int_bulan == 4) {

			bulan = 'April';
		} else if (int_bulan == 5) {

			bulan = 'Mei';
		} else if (int_bulan == 6) {

			bulan = 'Juni';
		} else if (int_bulan == 7) {

			bulan = 'Juli';
		} else if (int_bulan == 8) {

			bulan = 'Agustus';
		} else if (int_bulan == 9) {

			bulan = 'September';
		} else if (int_bulan == 10) {

			bulan = 'Oktober';
		} else if (int_bulan == 11) {

			bulan = 'November';
		} else if (int_bulan == 12) {

			bulan = 'Desember';
		}

		const html = `
			<input type="text" name="nis" value="{{ $nis }}" id="nis-`+$(this).data("value")+`" hidden="">
			<input type="text" name="bulan" value="`+$(this).data("value")+`" id="bulan-`+$(this).data("value")+`" hidden="">
			<div class="form-group row">
				<label class="col-md-4">Bulan</label>
				<div class="col-md-8">
					<input type="text" name="nominal" class="form-control" value=`+bulan+` readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-4">Nominal</label>
				<div class="col-md-8">
					<div class="input-group">
						<span class="input-group-addon"> Rp. </span>
						<input type="number" name="nominal" id="nominal" class="form-control nominal-`+$(this).data("value")+`">
					</div>
				</div>
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-primary bayar pull-right" value="`+$(this).data("value")+`"><i class="fa fa-money"></i> Bayar</button>
			</div>
		`;

		$(".form-bayar").html("<tr><td colspan='5'><center><i class='fa fa-spin fa-spinner fa-lg'></i></center></td></tr>");

		$(".form-bayar").html(html);
	});

});
	$(document).unbind().on('click', '.bayar', function(e){

		const nis = $("#nis-" + this.value).val();
		const bulan = $("#bulan-" + this.value).val();
		const nominal = $(".nominal-" + this.value).val();
		const tahun_pelajaran = $("#tahun_pelajaran").val();
		const token = '{{ csrf_token() }}';

		console.log("Nominal : " + nominal);

		swal({
			title: "Apakah data yang dimasukan sudah benar?",
			text: "",
			type: "warning",
			showCancelButton: true,
	        cancelButtonText: "Batal",
	        confirmButtonText: "Bayar",
		}).then(function(isConfirm){
			if (isConfirm.value) {
				
				if (nominal == '' || nominal <= 0 || nominal == null) {

					swal("Nominal tidak boleh kosong.", "","error");
				} else {
		
					$.ajax({

						url: '{{ url("transaksi/bayar-spp-siswa") }}',
						data: {_token: token, nis: nis, nominal: nominal, bulan: bulan, tahun_pelajaran: tahun_pelajaran},
						type: 'POST',
						success: function(data){

							$(".form-bayar").html(null);
							$("#refresh").click();

							console.log(data);

							swal("SPP Telah dibayar.", "", "success");

						},
						error: function(){
							swal("Terjadi masalah saat melakukan Pembayaran.", "", "error");
						}
					});
				}
			}
		});
	});



</script>