<style>
	body {
		font-size: 18px;
	}
</style>
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<a href="<?=site_url('Student/add_student')?>" class="btn btn-success">
						<span class="btn-label"><i class="fa fa-plus-circle"></i></span>
						نیا داخلہ فارم
					</a>
				</div>
				<div class="col-md-4">
					<h2 class="text-center">فہرست داخلہ برائے طلبہ</h2>
				</div>
				<div class="col-md-4 text-right">
					<h3 class="pr-1 text-info">
						<span class="m-b-20">کُل طلباء :</span>
						<span class="m-b-20"><?=$total_students?></span>
					</h3>
				</div>

				<div class="col-md-12">
					<div class="card-box table-responsive">

						<table id="datatable" class="table table-hover table-striped table-condensed text-center">
							<thead>
								<tr>
									<th>نمبر شمار</th>
									<th>جی آر نمبر</th>
									<th>داخلہ نمبر</th>
									<th>نام</th>
									<th>ولدیت</th>
									<th>والد کا شناختی کارڈ نمبر</th>
									<th>متعلقہ استاذ</th>
									<th>نام سرپرست</th>
									<th>فون نمبر سرپرست</th>
									<th>عمل</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sn = 0;
								foreach($students as $student):
								?>
								<tr>
									<td><?=++$sn?></td>
									<td><?= $student->gr_number ?></td>
									<td><?=$student->admission_number?></td>
									<td><?=$student->name?></td>
									<td><?=$student->father_name?></td>
									<td><?=$student->father_cnic?></td>
									<td><?=$student->class_name?></td>
									<td><?=$student->guardian?></td>
									<td><?=$student->guardian_phone?></td>
									<td>
										<a class="btn btn-dark btn-sm" href="<?=site_url("Student/detail_student/$student->id");?>">
											<i class="fa fa-eye"></i>
										</a>
										<a class="btn bg-custom text-white btn-sm" href="<?=site_url("Student/edit_student/$student->id");?>">
											<i class="fa fa-edit"></i>
										</a>
										<?php if($this->group=='admin')
										{
											echo '<button data-id='.$student->id.' class="btn btn-danger delete_student btn-sm">
													<i class="fa fa-remove"></i>
												</button>';
										}
										?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
										<!-- Delete Modal-->

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h4 class="modal-title" id="exampleModalLongTitle">طالب علم کی معلومات حزف کریں؟</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5>کیا آپ واقعی طالب علم کی معلومات حزف کرنا چاہتے ہیں؟</h5>
			</div>
			<div class="modal-footer pull-right">
				<a id="delete_student" class="btn btn-danger"  href="">
					<i class="fa fa-trash-o">&nbsp;</i>
					ہاں
				</a>
				<button class="btn btn-secondary" data-dismiss="modal">
					<i class=""></i>
					نہیں
				</button>
			</div>
		</div>
	</div>
</div>
<script>
	function myFunction() {
		window.print();
	}

	$(document).ready(function () {
		$('.delete_student').click(function () {
			var id = $(this).data('id');
			var url = '<?= base_url('Student/delete_student/') ?>'+id;
			 $('#delete_student').attr('href',url);
			 $("#delete_modal").modal('show');
	 	});
	});
</script>
