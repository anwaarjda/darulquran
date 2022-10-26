<style>
	.font {
		font-size: 30px;
	}
</style>
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<!-- end row -->
			<!-- Modal -->
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">کلاس بنایئں</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" action="<?= site_url("classes/add_class") ?>">
								<label>کلاس کا نام</label>
								<input type="text" name="Txtname" placeholder="کلاس کا نام" class="form-control">

						</div>
						<div class="modal-footer">

							<button type="submit" class="btn btn-primary">محفوظ کریے</button>
						</div>
						</form>
					</div>
				</div>
			</div>
			<!-- end row -->

			<div class="row">


				<div class="col-12">
					<div class="card-box table-responsive">
						<h1 class="m-t-0 header-title font text-center"> ناکام طالباہ کی فہرست
						</h1>
						<table id="datatable" class="table table-striped">
							<thead class="table-danger">
							<tr>
								<th class="text-center">نمبر شمار</th>
								<th class="text-center">نام</th>
								<th class="text-center">جماعت</th>
								<th class="text-center">داخلا فارم</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$count=1;
							foreach($fail_student as $st):?>

								<tr>
									<td class="text-center"><?= $count++; ?></td>
									<td class="text-center"><?= $st->name ?></td>
									<td class="text-center"><?= $st->class ?></td>
									<td class="text-center"><a href="#" class="btn btn-danger">مشروط  داخلہ فارم <i class="fa fa-location-arrow"></i></a> </td>

								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- end row -->
		</div>
		<!-- container -->
	</div>
	<!-- content -->
</div>



