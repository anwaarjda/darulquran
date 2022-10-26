<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<button type="button" class="btn btn-success m-b-10 add_class" data-toggle="modal">
				<span class="btn-label"><i class="fa fa-plus-circle"></i></span>
				کلاس بنائیں&nbsp;
			</button>
			<div class="row">
				<div class="col-12">
					<div class="card-box table-responsive">
						<h2 class="text-center">کلاس کا ریکارڈ</h2>
						<div class="col-12">
							<table id="datatable" class="table table-striped">
								<thead>
									<tr>
										<th class="text-center">نمبر شمار</th>
										<th class="text-center">کلاس نمبر</th>
										<th class="text-center"> کلاس کا نام</th>
										<th class="text-center">درجہ</th>
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
										<td class="text-center"><?= $c->darja ?></td>
										<td class="text-center"><?= $active ?></td>
										<td class="text-center">
											<button type="button" class="btn btn-sm bg-custom text-white edit_class" data-id="<?= $c->id ?>" data-classno="<?= $c->class_no ?>" data-class="<?= $c->class_name ?>" data-darja="<?= $c->darja ?>" data-active="<?= $c->active?>">
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
</div>
											<!-- Update And Save Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="ModalLabel">ریکارڈ اپ ڈیٹ کریں</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form" method="post" action="<?= site_url('Classes/update_class') ?>">
				<div class="modal-body">
					<label for="class_no">کلاس کا نمبر</label>
					<input type="number" id="class_no" name="class_no" class="form-control class_no" placeholder="کلاس کا نمبر" min="1" tabindex="1">
					<p id="error_class_no" class="text-danger"></p>

					<label for='class_name'>کلاس کا نام</label>
					<input type="text" id="class_name" name="class_name" class="form-control class_name" placeholder="کلاس کا نام" tabindex="2">
					<p id="error_class_name" class="text-danger"></p>

					<label for='darja'>درجہ</label>
					<input type="text" id="darja" name="darja" class="form-control darja" placeholder="درجہ" tabindex="3" required>
					<p id="error_darja" class="text-danger"></p>

					<div id="active">
						<label for='active'>فعال / غیر فعال</label>
						<select id='active' name='active' class="form-control">
							<option value='1'>فعال</option>
							<option value='0'>غیر فعال</option>
						</select>
					</div>
				</div>
				<div class="modal-footer pull-right">
					<button id="save" type="submit" class="btn btn-success">
						<i class="fa fa-save">&nbsp;</i>
						محفوظ کریں
					</button>
					<button id="update" type="submit" class="btn btn-warning">
						<i class="fa fa-edit">&nbsp;</i>
						تبدیل کریں
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">بند کریں</button>
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
				<h4 class="modal-title" id="exampleModalLongTitle">کلاس حزف کریں؟</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5>کیا آپ اس کلاس کو واقعی حزف کرنا چاہتے ہیں؟</h5>
			</div>
			<div class="modal-footer pull-right">
				<a id="delete_class" class="btn btn-danger" href="" >
					<i class="fa fa-trash-o">&nbsp;</i>
					ہاں
				</a>
				<button class="btn btn-secondary" data-dismiss="modal">
					<i class="fa"></i>
					نہیں
				</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {

		// Prevent submit form on ENTER and focus on next input

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

		$('.add_class').click(function () {

			$('#ModalLabel').html('نئی کلاس بنائیں');
			$('#save').show();
			$('#update').hide();
			$('#active').hide();

			$('#class_name').val('');
			$('#class_no').val('');
			$('#darja').val('');

			$('#active').val('').trigger('change');

			var url = '<?= site_url('Classes/add_class/') ?>';
			$('#form').attr('action',url);

			$('#modal').modal('show');
		});

		$('.edit_class').click(function () {

			$('#ModalLabel').html('کلاس میں ترمیم کریں');
			$('#save').hide();
			$('#update').show();
			$('#active').show();

			var class_name = $(this).data('class');
			$('#class_name').val(class_name);

			var class_no = $(this).data('classno');
			$('#class_no').val(class_no);

			var darja = $(this).data('darja');
			$('#darja').val(darja);

			var class_active = $(this).data('active');
			$('#active').val(class_active).trigger('change');

			var class_id = $(this).data('id');
			var url = '<?=site_url('Classes/update_class/')?>'+class_id;
			$('#form').attr('action',url);

			$('#modal').modal('show');
		});

		$('.delete_class').click(function () {
			var id = $(this).data('id');
			var url = '<?= site_url('Classes/delete_class/') ?>'+id;
			$('#delete_class').attr('href',url);
			$('#delete_modal').modal('show');
		});

		$('#save,#update').click(function(e){
			e.preventDefault();
			var error=0;

			if($('.class_no').val()==="")
			{
				error=1;
				$('#error_class_no').html(' نمبر درج کریں');
			}

			if($('.class_name').val()==="")
			{
				error=1;
				$('#error_class_name').html(' نام درج کریں');
			}

			if($('#darja').val()==="")
			{
				error=1;
				$('#error_darja').html(' درجہ کا اندراج کریں');
			}

			if (error==0){
				$('#form').submit();
			}
		});

		$('.class_name').keyup(function(e){
			if($('.class_name').val()!=="")
			{
				$('#error_class_name').hide();
			}
			else
			{
				$('#error_class_name').show();
			}
		});

		$('.class_no').keyup(function(e){
			if($('.class_no').val()!=="")
			{
				$('#error_class_no').hide();
			}
			else
			{
				$('#error_class_no').show();
			}
		});

		// $('#classes_active>a').addClass('active');
	});
</script>
