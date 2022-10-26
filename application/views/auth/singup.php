<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
	<meta name="author" content="Coderthemes">

	<!-- App Favicon -->
	<link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico">

	<!-- App title -->
	<title>دارالقرآن</title>

	<!-- Bootstrap CSS -->
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

	<!-- App CSS -->
	<link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css" />

	<!-- Modernizr js -->
	<script src="<?= base_url() ?>assets/js/modernizr.min.js"></script>
	<script src="<?= base_url()?>assets/js/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/js/validation.js"></script>
	<style>
		body{

			font-family: "Jameel Noori Nastaleeq";
			font-size: 20px;
		}
		.font_26{
			font-size: 26px;
		}
		input[type="text"] {
			text-align: right;
		}

		input[type="password"] {
			text-align: right;
		}
		#myVideo {
			position: fixed;
			right: 0;
			bottom: 0;
			min-width: 100%;
			min-height: 100%;

		}
		.content {
			position: fixed;
			right: 0;
			bottom: 0;
			min-width: 100%;
			min-height: 100%;
			background: rgba(0, 0, 0, 0.7);
		}

		.panel-title {
			font-family: 'Noto Nastaliq Urdu', serif;
			padding-bottom: 25px;
			padding-top:15px;
			color: #64b0f2;
			font-size:20px;
		}

	</style>
</head>


<body>
<video autoplay muted loop id="myVideo">
	<source src="<?= base_url() ?>assets/jamia_intro.mp4" type="video/mp4">
</video>
<div class="content"></div>
<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">

	<div class="account-bg">
		<div class="card-box mb-0">
			<div class="text-center m-t-20">
				<span>
					<img src="<?= base_url() ?>assets/images/logo.jpg" height="50px" width="160px;">
				</span>
			</div>
			<div class="">
				<div class="row">
					<div class="col-12 text-center">
						<h3 class="panel-title">دارالقرآن</h3>

						<h6 class="text-muted text-uppercase m-b-0 m-t-0 font_26">اپنی شناخت کروائیں</h6>
					</div>
				</div>
				<form class="m-t-20" name="login_form" id="login_form" method="post" action="<?= site_url('auth/login') ?>">

						<div class="form-group row">
						<div class="col-12">
							<input class="form-control" id="email" type="text"  name="identity" placeholder="رکن کا نام" autofocus tabindex="1">
							<span class="text-danger" style="float: right"><p id="email_error"></p></span>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-12">
							<input class="form-control" id="password" type="password" name="password"  placeholder="خفیہ کوڈ" tabindex="2">
							<span class="text-danger" style="float: right"><p id="password_error"></p></span>
						</div>
					</div>

					<div class="form-group text-center row m-t-10">
						<div class="col-12">
							<button typeof="submit" id="btn_sub" class="btn btn-success btn-block waves-effect waves-light font_26" type="submit">لاگ ان کریں</button>
						</div>
					</div>
				</form>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- end card-box-->
</div>
<!-- end wrapper page -->
<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/popper.min.js"></script><!-- Tether for Bootstrap -->
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/detect.js"></script>
<script src="<?= base_url() ?>assets/js/fastclick.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.blockUI.js"></script>
<script src="<?= base_url() ?>assets/js/waves.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.scrollTo.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.slimscroll.js"></script>
<script src="<?= base_url() ?>assets/plugins/switchery/switchery.min.js"></script>

<!-- App js -->
<script src="<?= base_url() ?>assets/js/jquery.core.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.app.js"></script>

</body>
</html>
