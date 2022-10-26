<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<button type="button" class="btn btn-success m-b-10 add_subject" data-toggle="modal">
				<span class="btn-label"><i class="fa fa-plus-circle"></i></span>
				 نیامضمون بنائیں&nbsp;
			</button>
			<div class="row">
				<div class="col-12">
					<div class="card-box table-responsive">
						<h2 class="text-center">مضامین</h2>
						<div class="col-12">
							<table id="datatable" class="table table-striped">
								<thead>
									<tr>
										<th class="text-center">نمبر شمار</th>
										<th class="text-center">مضامین</th>
										<th class="text-center">کُل نمبر</th>
										<th class="text-center">کیفیت</th>
										<th class="text-center">عمل</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$sn = 1;
								foreach ($subjects as $subject):?>
									<tr>
										<td class="text-center"><?=numtourdu($sn++)?></td>
										<td class="text-center"><?=$subject->name?></td>
										<td class="text-center"><?=$subject->total_number?></td>
										<td class="text-center"><?=($subject->active)?'<p class="text-success">فعال</p>':'<p class="text-danger">غیر فعال</p>'?></td>
										<td class="text-center">
											<button type="button" class="btn bg-custom text-white edit_subject" data-id="<?=$subject->id?>" data-name="<?=$subject->name?>" data-active="<?=$subject->active?>" data-total_number="<?=$subject->total_number?>">
												<i class="fa fa-edit"></i>
											</button>
											<?php if($this->group=='admin'){?>
											<button data-id="<?=$subject->id?>" class="btn btn-danger delete_subject">
												<i class="fa fa-remove"></i>
											</button>
											<?php } ?>
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
											<!-- Save And Update Modal -->

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-white">
				<h4 class="modal-title" id="ModalLabel">مضامین کا خانہ</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form" method="post" action="<?= site_url('Subject/add_subject') ?>">
				<div class="modal-body">
					<label for="name">مضمون کا نام</label>
					<input type="text" id="name" name="name" class="form-control name" placeholder="مضمون کا نام" tabindex="1">
					<p id="error_name" class="text-danger"></p>

					<label for="total_number">کُل نمبر</label>
					<input type="number" id="total_number" name="total_number" class="form-control total_number" placeholder="کُل نمبر" tabindex="2">
					<p id="error_total_number" class="text-danger"></p>

					<div id="status">
						<label for="active">فعال / غیر فعال</label>
						<select id="active" name="active" class="form-control" tabindex="3">
							<option value="1">فعال</option>
							<option value="0">غیر فعال</option>
						</select>
					</div>
				</div>
				<div class="modal-footer pull-right">
					<button id="save" type="submit" class="btn btn-success">
						<i class="fa fa-save">&nbsp;</i>
						محفوظ کریں
					</button>
					<button id="update" type="submit" class="btn btn-custombg text-white">
						<i class="fa fa-edit">&nbsp;</i>
						ترمیم کریں
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
			<div class="modal-header bg-danger text-white">
				<h4 class="modal-title" id="exampleModalLongTitle">مضمون کو حذف کریں؟</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-danger">
				<h5>کیا آپ اس مضمون کو واقعی حذف کرنا چاہتے ہیں؟</h5>
			</div>
			<div class="modal-footer pull-right">
				<a id="delete_subject" class="btn btn-danger" href="" >
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
		$('.add_subject').click(function () {
			$('#ModalLabel').html('نیا مضمون بنائیں');

			$('.modal-header').addClass('bg-success');
			$('.modal-header').removeClass('bg-custom');

			$('#save').show();
			$('#hide').hide();
			$('#update').hide();
			$('#status').hide();

			$('#name').val('');
			$('#subject').val('');
			$('#active').val('').trigger('change');

			var url = '<?= site_url('Subject/add_subject') ?>';
			$('#form').attr('action',url);

			$('#modal').modal('show');
		});

		$('.edit_subject').click(function () {
			$('#ModalLabel').html('مضمون میں ترمیم کریں');

			$('.modal-header').addClass('bg-custom');
			$('.modal-header').removeClass('bg-success');

			$('#save').hide();
			$('#hide').show();
			$('#update').show();
			$('#status').show();

			var subject_name = $(this).data('name');
			$('#name').val(subject_name);

			var total_number = $(this).data('total_number');
			$('#total_number').val(total_number);

			var subject_active = $(this).data('active');
			$('#active').val(subject_active).trigger('change');

			var subject_id = $(this).data('id');
			var url = '<?=site_url('Subject/update_subject/')?>'+subject_id;
			$('#form').attr('action',url);

			$('#modal').modal('show');
		});

		$('.delete_subject').click(function () {
			var id = $(this).data('id');
			var url = '<?= site_url('Subject/delete_subject/') ?>'+id;
			$('#delete_subject').attr('href',url);
			$('#delete_modal').modal('show');
		});

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

		$('#save,#update').click(function(e){
			e.preventDefault();
			var error=0;

			if($('.name').val()==="")
			{
				error=1;
				$('#error_name').html(' مضمون درج کریں');
			}

			if($('.total_number').val()==="")
			{
				error=1;
				$('#error_total_number').html('نمبر درج کریں');
			}

			if (error==0)
			{
				$('#form').submit();
			}
		});

		$('.name').keyup(function(e){
			if($('.name').val()!=="")
			{
				$('#error_name').hide();
			}
			else
			{
				$('#error_name').show();
			}
		});

		$('.total_number').keyup(function(e){
			if($('.total_number').val()!=="")
			{
				$('#error_total_number').hide();
			}
			else
			{
				$('#error_total_number').show();
			}
		});

	});
</script>
