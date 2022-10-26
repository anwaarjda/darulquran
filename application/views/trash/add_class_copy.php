<?php //require_once('layout/header.php');?>

<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<button type="button" class="m-b-10 btn btn-md btn-primary edit_item" data-toggle="modal" data-target="#add_class">
				<i class="fa fa-plus-circle">&nbsp;</i>
				کلاس بنائیں&nbsp;
			</button>
			<div class="row">
				<div class="col-12">
					<div class="card-box table-responsive">
						<h2 class="text-center">کلاس کا ریکارڈ</h2>
						<table id="datatable" class="table table-striped">
							<thead>
							<tr>
								<th class="text-center">نمبر شمار</th>
								<th class="text-center">کلاس نمبر</th>
								<th class="text-center">کلاس</th>
								<th class="text-center">کیفیت</th>
								<th class="text-center">عمل</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$sn = 1;
							foreach ($classes as $c):
								$active = '';
								if ($c->active == 1) {
									$active = "<p class='text-success'>فعال</p>";
								} else {
									$active = "<p class='text-danger'>غیر فعال</p>";
								}
								?>
								<tr>
									<td class="text-center"><?= $sn++ ?></td>
									<td class="text-center"><?= $c->class_no ?></td>
									<td class="text-center"><?= $c->class_name ?></td>
									<td class="text-center"><?= $active ?></td>
									<td class="text-center">
										<button type="button" class="btn btn-sm btn-primary edit_class" data-id="<?= $c->id ?>" data-classno="<?= $c->class_no ?>" data-class="<?= $c->class_name ?>" data-active="<?= $c->active?>">
											<i class="fa fa-edit"></i>
										</button>

										<button data-id="<?= $c->id ?>" class="btn btn-sm btn-danger delete_class">
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

											<!-- Update Modal -->

<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">ریکارڈ اپ ڈیٹ کریں</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="update_form" method="post" action="<?= site_url('Classes/update_class') ?>">
				<div class="modal-body">
					<label for="class_no">کلاس کا نمبر</label>
					<input type="number" id="class_no" name="class_no" placeholder="کلاس کا نمبر" class="form-control" min="0" tabindex="1">

					<label for='class_name'>کلاس کا نام</label>
					<input type="text" id="class_name" name="class_name" placeholder="کلاس کا نام" class="form-control" tabindex="2">

					<label for='active'>فعال / غیر فعال</label>
					<select id='active' name='active' class="form-control">
						<option value='1'>فعال</option>
						<option value='0'>غیر فعال</option>
					</select>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">بند کریں</button>
					<button type="submit" class="btn btn-primary">تبدیل کریں</button>
				</div>
			</form>
		</div>
	</div>
</div>

									<!-- Save Modal -->

<div class="modal fade" id="add_class" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">کلاس بنائیں</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?= site_url('Classes/add_class') ?>">
				<div class="modal-body">
					<label for="class_no">کلاس کا نمبر</label>
					<input type="number" name="class_no" placeholder="کلاس کا نمبر" class="form-control" min="0" tabindex="1">

					<label for="class_name">کلاس کا نام</label>
					<input type="text" name="class_name" placeholder="کلاس کا نام" class="form-control" tabindex="2">
				</div>
				<div class="modal-footer">
					<button id="btn_save" type="submit" class="btn btn-primary">
						&nbsp;&nbsp;&nbsp;<i class="fa fa-save">&nbsp;</i>
						محفوظ کریں
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
					بند کریں
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

								<!-- Delete Modal-->

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLongTitle">اَخز</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5>کلاس اخز کریں؟</h5>
			</div>
			<div class="modal-footer">
				<a id="delete_class" class="btn btn-danger" href="" >
					<i class="fa fa-trash-o">&nbsp;</i>
					ہاں
				</a>
				<button class="btn btn-default" data-dismiss="modal">
					<i class="fa"></i>
					نہیں
				</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {

		$('.edit_class').click(function () {

			var class_name = $(this).data('class');
			$('#class_name').val(class_name);

			var class_id = $(this).data('id');
			$('#class_id').val(class_id);

			var class_no = $(this).data('classno');
			$('#class_no').val(class_no);

			var class_active = $(this).data('active');
			$('#active').val(class_active).trigger('change');

			var url = '<?= site_url('Classes/update_class/') ?>'+class_id;
			$('#update_form').attr('action',url);

			$('#update_modal').modal('show');
		});

		$('.delete_class').click(function () {
			var id = $(this).data('id');
			var url = '<?= site_url('Classes/delete_class/') ?>'+id;
			$('#delete_class').attr('href',url);
			$("#delete_modal").modal("show");
		});

		// Prevent submit form on ENTER

		$('form date,select,input:not([type="submit"])').keydown(function(e) {
			if (e.keyCode !== 13) {
			} else {
				var inputs = $(this).parents('form').eq(0).find(':input');
				if (inputs[inputs.index(this) + 1] != null) {
					inputs[inputs.index(this) + 1].focus();
				}
				e.preventDefault();
				return false;
			}
		});
	});


</script>
