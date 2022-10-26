<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="page-title-box py-1">
				<div class="montserrat float-left">
					<?= date("d-m-Y") ?>
					<i class="fa fa-calendar ml-2"></i>
				</div>
				<div>
					تعلیمی سال:
					<span class="montserrat d-inline-block ml-2"><?= $this->ac_year ?></span>
				</div>
				<div class="clearfix"></div>
			</div>

			<!-- end row -->
			<div class="row">
				<div class="col-xs-12 col-md-6 col-lg-3 col-xl-3">
					<div class="card-box tilebox-one h-100">
						<h4 class="m-t-0 m-b-30">
							معلوماتِ طلباء
							<i class="icon-graduation float-right text-muted"></i>
						</h4>

						<div class="row h4">
							<div class="text-success col-md-5">فعال طلباء :</div>
							<div class="text-success col-md-3 montserrat-bold font-18 text-right"><?= $active_students ?></div>
							<div class="col-md-4">
								<a class="text-white status" href="<?= site_url('Classes/classes/' . null . '1') ?>">
									<span class="label label-success pull-left font-weight-normal">
										تفصیل
									</span>
								</a>
							</div>
						</div>

						<div class="row h4">
							<div class="text-danger col-md-5">غیر فعال طلباء :</div>
							<div class="col-md-3 text-danger montserrat-bold font-18 text-right"><?= $inactive_students ?></div>
							<div class="col-md-4">
								<a class="text-white status" href="<?= site_url('Student/index/inactive') ?>">
									<span class="label label-danger pull-left font-weight-normal">
										تفصیل
									</span>
								</a>
							</div>
						</div>

						<div class="row h4">
							<div class="col-md-5">کُل طلباء :</div>
							<div class="col-md-3 montserrat-bold font-18 text-right"><?=$total_students?></div>
							<div class="col-md-4">
								<a class="text-white" href="<?=site_url('Student')?>">
									<span class="label label-success pull-left font-weight-normal">
										تفصیل
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-md-6 col-lg-3 col-xl-3">
					<div class="card-box tilebox-one h-100">
						<h4 class="m-b-30">
							ممتحن کی تعداد
							<i class="fa fa-user float-right text-muted"></i>
						</h4>
						<div class="row h4">
							<div class="col-md-5">کُل تعداد :</div>
							<div class="col-md-3 montserrat-bold font-18 text-center"><?=$total_teachers?></div>
							<div class="col-md-4">
								<a class="text-white" href="<?=site_url('Teacher')?>">
									<span class="label label-success pull-left font-weight-normal">
										تفصیل
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-md-6 col-lg-3 col-xl-3">
					<div class="card-box tilebox-one h-100">
						<i class="fa fa-users float-right text-muted"></i>
						<h4 class="m-b-30">کلاس کی تعداد</h4>

						<div class="row h4">
							<div class="text-success col-md-5">فعال کلاسز :</div>
							<div class="col-md-3 montserrat-bold font-18 text-right text-success"><?= $active_classes ?></div>
							<div class="col-md-4">
								<a class="text-white status" href="<?= site_url('Classes/status_list/1') ?>">
									<span class="label label-success pull-left font-weight-normal">
										تفصیل
									</span>
								</a>
							</div>
						</div>

						<div class="row h4">
							<div class="text-danger col-md-5">غیر فعال کلاسز :</div>
							<div class="col-md-3 text-danger text-right montserrat-bold font-18"><?= $inactive_classes ?></div>
							<div class="col-md-4">
								<a class="text-white status" href="<?= site_url('Classes/status_list/inactive') ?>">
									<span class="label label-danger pull-left font-weight-normal">
										تفصیل
									</span>
								</a>
							</div>
						</div>

						<div class="row h4">
							<div class="col-md-5">کُل کلاسز :</div>
							<div class="col-md-3 montserrat-bold font-18 text-right"><?=$total_classes?></div>
							<div class="col-md-4">
								<a class="text-white" href="<?=site_url('Classes/classes')?>">
									<span class="label label-success pull-left font-weight-normal">
										تفصیل
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#dashboard_active>a').addClass('active');
	})
</script>
