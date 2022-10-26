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
						<h3 class="m-t-0 header-title" style="font-size: 26px" >درخواست گزار کی تفصیل</h3>
						<table id="datatable" class="table table-striped">
							<thead>
							<tr>
								<th>نمبر شمار</th>
								<th>جماعت</th>
								<th> آمدہ نتائج</th>
								<th>متوقع نتائج</th>
								<th> کل تعداد</th>
							</tr>
							</thead>
							<tbody>
								<?php
									$count = 1;
								foreach($applicant as $rec):
									$avail = $this->applicant_model->get_availableresult($rec->class_id);
									?>

									<tr>

									<td><?= $count++ ?></td>
									<td><strong><?= $rec->class ?></strong><a href="<?= site_url("applicant/student_list/$rec->class_id") ?>" class="btn btn-success btn-md ml-1">کامیاب طلباہ</a><a href="<?= site_url("applicant/fail_student_list/$rec->class_id") ?>" class="btn btn-danger btn-md ml-1">ناکام طلباہ</a></td>
									<td><?= $avail ?></td>
									<td> <?= $rec->total - $avail; ?> </td>
									<td><?= $rec->total ?></td>
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



