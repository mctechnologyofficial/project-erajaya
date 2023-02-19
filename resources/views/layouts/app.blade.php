<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		<meta name="description" content="Dashlead -  Admin Panel HTML Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="admin,dashboard,panel,bootstrap admin template,bootstrap dashboard,dashboard,themeforest admin dashboard,themeforest admin,themeforest dashboard,themeforest admin panel,themeforest admin template,themeforest admin dashboard,cool admin,it dashboard,admin design,dash templates,saas dashboard,dmin ui design">
        <meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Favicon -->
		<link rel="icon" href="{{ asset('assets/img/brand/ERAA.png') }}" type="image/png" />

		<!-- Title -->
		<title>Erajaya | @yield('title')</title>

		@include('Components.css')
        @yield('css')

	</head>

	<body class="horizontalmenu">

		<!-- Loader -->
		<div id="global-loader">
			<img src="{{ asset('assets/img/loader.svg') }}" class="loader-img" alt="Loader">
		</div>
		<!-- End Loader -->

		<!-- Page -->
		<div class="page">

			@include('Components.header')

			@include('Components.sidebar')

			<!-- Main Content-->
			<div class="main-content pt-0">
				<div class="container">

					<!-- Page Header -->
					<div class="page-header">
						<div>
							<h2 class="main-content-title tx-24 mg-b-5">Erajaya Dashboard</h2>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
							</ol>
						</div>
					</div>
					<!-- End Page Header -->

					<!--Row-->
					@yield('content')
                    <!-- Row end -->

				</div>
			</div>
			<!-- End Main Content-->

			@include('Components.footer')

		</div>
		<!-- End Page -->

		<!-- Back-to-top -->
		<a href="#top" id="back-to-top" style="background-color: #273d95;"><i class="fe fe-arrow-up"></i></a>

		@include('Components.js')
        @yield('js')

	</body>
</html>
