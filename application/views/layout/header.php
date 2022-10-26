<!DOCTYPE html>
<html lang="auto">
<head>
	<!-- App Favicon -->
	<link rel="shortcut icon" href="<?= base_url()?>assets/images/logo.png">

	<!-- App title -->
	<title>دارالقرآن - جامعہ دار العلوم کراچی</title>

	<!-- Switchery css -->
	<link href="<?= base_url()?>assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

	<!-- Custombox -->
	<link href="<?= base_url()?>assets/plugins/custombox/css/custombox.min.css" rel="stylesheet" />

	<!-- Bootstrap CSS -->
	<link href="<?= base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

	<!-- App CSS -->
	<link href="<?= base_url()?>assets/css/style.css?v=1.3" rel="stylesheet" type="text/css" />
	<link href="<?= base_url()?>assets/css/app-rtl.min.css" rel="stylesheet" type="text/css" />

	<!--Data table-->
	<link href="<?= base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

	<!-- Responsive datatable examples -->
	<link href="<?= base_url(); ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

	<!-- Multi Item Selection examples -->
	<link href="<?= base_url(); ?>assets/plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<!--Data table end-->

	<!--Toastr-->
	<link href="<?= base_url() ?>assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
	<!-- Modernizr js -->

	<!--form css-->
	<link href="<?= base_url() ?>assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

	<link href="<?= base_url() ?>assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
	<!--form css end-->

	<script src="<?= base_url() ?>assets/js/modernizr.min.js"></script>
	<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/js/daterangepicker.js"></script>
	<script src="<?= base_url() ?>assets/js/validation.js"></script>
	<script src="<?= base_url() ?>assets/js/student_validation.js"></script>
</head>

<body>
	<div class="topbar">
		<div class="topbar-left">
			<a href="<?= site_url('Dashboard') ?>" class="logo">
				<span>
					<img alt='logo' height='50' src="<?=site_url('assets/images/logo.jpg')?>">
				</span>
			</a>
		</div>

		<nav class="navbar-custom">
			<div class="" style="display: inline-block;width: 250px;">
				<span class="pull-right">
					<button class="button-menu-mobile open-left waves-light waves-effect">
						<i class="zmdi zmdi-menu"></i>
					</button>
				</span>
				<div class="mt-2 h2">
					<a href="<?=base_url('Dashboard') ?>" class="text-white">
						<span>دارالقرآن</span>
					</a>
				</div>
			</div>

			<ul class="list-inline pull-left mb-0">
				<li class="list-inline-item dropdown notification-list">
					<a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown"
					   href="#" role="button" aria-haspopup="false" aria-expanded="false">
						<i class="fa fa-user-circle-o"></i>
						<span class="h3"><?=$this->session->first_name;?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right profile-dropdown" aria-labelledby="Preview">
						<div class="dropdown-item">
							<h5>
								<a href="#password-modal" style="color: black" data-animation="slit" data-plugin="custommodal" data-overlayspeed="100" data-overlaycolor="#36404a">
									<i class="fa fa-gear mt-2"></i>
									<span>پاس ورڈ تبدیل کریں</span>
								</a>
							</h5>
						</div>
						<div class="dropdown-item">
							<h5>
								<a href="<?= site_url('Auth/logout')?>">
									<i class="fa fa-power-off text-danger mt-2"></i>
									<span class="text-danger"> لاگ آؤٹ</span>
								</a>
							</h5>
						</div>
					</div>
				</li>
			</ul>

			<ul class="w-50 float-right py-3 d-flex justify-content-end" style="width: 650px">
				<form method="post" action="<?= site_url("Student/get_student_by_gr_number") ?>" class="form-inline mr-3">
					<input type="number" required name="gr_number" placeholder="جی آر نمبر" class="form-control numeric" style="width:150px;">

					<button type="submit" class="btn btn-default py-2 ml-1" style="position: relative">
						<i class="fa fa-search"></i>
					</button>
				</form>
				<select class="form-control select2 year" name="cmb_section" style="width: 125px">
					<?php $years= $this->Dq_year_model->get_year();	?>
					<?php foreach($years as $year):	?>
						<option value="<?=$year->ac_year?>" <?=($this->session->userdata('ac_year')==$year->ac_year)?'selected':null;?>>
							<?=$year->ac_year?>
						</option>
					<?php endforeach; ?>
				</select>
			</ul>
		</nav>
	</div>

</body>

<script>

	$(document).ready(function(){

		$('#datatable').DataTable({
			"aaSorting": [],
			"language":{
				"search":"تلاش:"
			}
		});
	})

	//header js
	$('.year').on('change',function(e){
		e.preventDefault();
		var ac_year = $(this).val();
		var current_ac_year = '<?= $this->session->userdata('ac_year');?>';
		if(current_ac_year != ac_year){
			$.ajax({
				url:'<?= site_url('Dq_years/change_section');?>'+'/'+ac_year,
				dataType:'json',
				success:function (response) {
					if(response == '1'){
						location.reload();
					}
				}
			})
		}
	});
	//End header Js
</script>
