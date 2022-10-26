
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<a href="<?= base_url()?>Student/add_student" class="btn btn-success m-b-15">
						<span class="btn-label"><i class="fa fa-plus-circle"></i></span>
						نیا داخلہ فارم
					</a>
						<div class="card-box table-responsive">
						<h3 class="text-center">نئے داخلے</h3>
						<table id="datatable" class="table table-hover table-striped table-condensed text-center">
							<thead>
								<tr>
									<th>نمبر شمار</th>
									<th>داخلہ نمبر</th>
									<th>نام</th>
									<th>ولدیت</th>
									<th>عُمر</th>
									<th>علاقہ</th>
									<th>والد کا شناختی کارڈ نمبر</th>
									<th>نامِ سرپرست</th>
									<th>سرپرست سے رشتہ</th>
									<th>فون نمبرِ سرپرست</th>
									<th>عمل</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sn = 0;
								foreach($student as $st): ?>
								<tr>
									<td><?=++$sn ?></td>
									<td><?=$st->admission_number ?></td>
									<td><?=$st->name ?></td>
									<td><?=$st->father_name ?></td>
									<td><?=$age = date('Y') - date('Y',strtotime($st->dob)); ?></td>
									<td><?=$st->area ?></td>
									<td><?=$st->father_cnic ?></td>
									<td><?=$st->guardian ?></td>
									<td><?=$st->guardian_relation ?></td>
									<td><?=$st->guardian_phone ?></td>
									<td>
										<a class="btn btn-sm bg-custom text-dark" href="<?=site_url("Student/edit_student/$st->id");?>">
											<i class="fa fa-edit"></i>
										</a>
										<button data-id="<?= $st->id?>" class="btn btn-sm btn-danger delete_student" >
											<i class="fa fa-remove"></i>
										</button>
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
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">اَخز کریں</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h3>کیا آپ طالبعلم کی معلومات اخز کرنا چاہتے ہیں؟</h3>
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

	$(document).ready(function () {

		$('.delete_student').click(function () {
			var id = $(this).data('id');
			var url = '<?= base_url('Student/delete_student/') ?>'+id;
			 $('#delete_student').attr('href',url);
			 $("#delete_modal").modal('show');
	 	});

	 });
</script>
