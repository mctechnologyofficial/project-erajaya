<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		<meta name="description" content="Dashlead -  Admin Panel HTML Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="admin,dashboard,panel,bootstrap admin template,bootstrap dashboard,dashboard,themeforest admin dashboard,themeforest admin,themeforest dashboard,themeforest admin panel,themeforest admin template,themeforest admin dashboard,cool admin,it dashboard,admin design,dash templates,saas dashboard,dmin ui design">

		<!-- Favicon -->
		<link rel="icon" href="../../assets/img/brand/favicon.ico" type="image/x-icon"/>

		<!-- Title -->
		<title>Spruha - Bootstrap Premium HTML Dashboard Template</title>

		<!-- Bootstrap css-->
		@include('Components.css')
	</head>

	<body class="horizontalmenu dark-theme">

		<!-- Loader -->
		<div id="global-loader">
			<img src="../../assets/img/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- End Loader -->

		<!-- Page -->
		<div class="page">

			<!-- Main Header-->
			@include('Components.header')
			<!-- Mobile-header closed -->

			<!-- Horizonatal menu-->
			@include('Components.sidebar')
			<!--End  Horizonatal menu-->

			<!-- Main Content-->
			<div class="main-content pt-0">
				<div class="container">

					@yield('content')

				</div>
			</div>
			<!-- End Main Content-->

			<!-- Sidebar -->
			@include('Components.setting')
			<!-- End Sidebar -->

			<!-- Main Footer-->
			@include('Components.footer')
			<!--End Footer-->

		</div>
		<!-- End Page -->

		<!-- Back-to-top -->
		<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

		<!-- Jquery js-->
		@include('Components.js')

	</body>
</html>
