
<!doctype html>
<html lang="en">

<head>
	<title>PSPP | @yield('subtitle', 'Blank Page')</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{ asset('klorofil') }}/assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('klorofil') }}/assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('klorofil') }}/assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="{{ asset('klorofil') }}/assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{ asset('klorofil') }}/assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{ asset('klorofil') }}/assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('klorofil') }}/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('klorofil') }}/assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="{{ url('/') }}"><img src="{{ asset('klorofil') }}/assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<div class="navbar-btn navbar-btn-right">
					<a href="javascript:void(0)" class="btn-toggle-fullwidth"><img src="{{ asset('klorofil') }}/assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								{{--<img src="{{ asset('klorofil') }}/assets/img/user.png" class="img-circle" alt="Avatar">--}}
								<span>{{ Auth::user()->name }}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="{{ url('pengaturan') }}"><i class="lnr lnr-cog"></i> <span>Pengaturan</span></a></li>
								<li><a href="{{ url('logout') }}"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="{{ url('dashboard') }}" class="dashboard"><i class="lnr lnr-chart-bars"></i> <span>Dashboard</span></a></li>
						@if (Auth::user()->level == 'admin')
						<li><a href="{{ url('data-siswa') }}" class="data-siswa"><i class="lnr lnr-users"></i> <span>Data Siswa</span></a></li>
						<li><a href="{{ url('data-petugas') }}" class="data-petugas"><i class="lnr lnr-users"></i> <span>Data Petugas</span></a></li>
						<li><a href="{{ url('data-kelas') }}" class="data-kelas"><i class="lnr lnr-home"></i> <span>Data Kelas</span></a></li>
						@endif
						@if (Auth::user()->level == 'admin')
						<li>
							<a href="#subPages" data-toggle="collapse" class="transaksi"><i class="lnr lnr-select"></i> <span>Transaksi SPP</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse">
								<ul class="nav">
									<li><a href="{{ url('transaksi/entri-data-spp') }}" class="entri-data-spp">Entri Data SPP</a></li>
									<li><a href="{{ url('transaksi/atur-tahun-pelajaran') }}" class="atur-tahun-pelajaran">Atur Tahun Pelajaran</a></li>
									<li><a href="{{ route('riwayat-spp') }}" class="riwayat-spp">Riwayat Pembayaran SPP</a></li>
								</ul>
							</div>
						</li>
						@endif
						@if (Auth::user()->level == 'petugas')
						<li>
							<a href="#subPages" data-toggle="collapse" class="transaksi"><i class="lnr lnr-select"></i> <span>Transaksi SPP</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse">
								<ul class="nav">
									<li><a href="{{ url('transaksi/entri-data-spp') }}" class="entri-data-spp">Entri Data SPP</a></li>
									<li><a href="{{ route('riwayat-spp') }}" class="riwayat-spp">Riwayat Pembayaran SPP</a></li>
								</ul>
							</div>
						</li>
						@endif
						@if (Auth::user()->level == 'siswa')
						<li>
							<a href="#subPages" data-toggle="collapse" class="transaksi"><i class="lnr lnr-select"></i> <span>Transaksi SPP</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse">
								<ul class="nav">
									<li><a href="{{ route('riwayat-spp') }}" class="riwayat-spp">Riwayat Pembayaran SPP</a></li>
								</ul>
							</div>
						</li>
						@endif
						@if (Auth::user()->level == 'admin')
						<li><a href="{{ url('laporan') }}" class="laporan"><i class="lnr lnr-printer"></i> <span>Buat Laporan</span></a></li>
						@endif
						<li><a href="{{ url('pengaturan') }}" class=""><i class="lnr lnr-cog"></i> <span>Pengaturan</span></a></li>
						<li><a href="{{ url('logout') }}" class=""><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					@yield('content')
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{ asset('klorofil') }}/assets/vendor/jquery/jquery.min.js"></script>
	<script src="{{ asset('klorofil') }}/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="{{ asset('klorofil') }}/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="{{ asset('klorofil') }}/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="{{ asset('klorofil') }}/assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="{{ asset('klorofil') }}/assets/scripts/klorofil-common.js"></script>
	<script type="text/javascript">
		const page = '{{ Request::segment(1) }}';
		
		@if (Auth::user()->level == 'siswa')
			$(".transaksi").addClass('active');
			$("#subPages").addClass('in')
		@endif

		if (page == 'transaksi') {
			const subPage = '{{ Request::segment(2) }}';
			$("." + page).addClass('active');
			$("#subPages").addClass('in');
			$("." + subPage).addClass('active');
		} else if (page == '') {
			$(".dashboard").addClass('active');
		} else {
			$("." + page).addClass('active');
		}
	</script>
</body>

</html>
