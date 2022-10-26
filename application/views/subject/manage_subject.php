<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<button type="button" class="btn btn-success m-b-10 manage_subject" data-toggle="managing_modal">
				<span class="btn-label"><i class="fa fa-plus-circle"></i></span>
				مضمون ترتیب دیں
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
										<th class="text-center">کلاس نمبر</th>
										<th class="text-center">کلاس</th>
										<th class="text-center">مضامین</th>
										<th class="text-center">عمل</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$sn = 1;
								foreach ($manage_subjects as $subject):?>
									<tr>
										<td class="text-center"><?=numtourdu($sn++)?></td>
										<td class="text-center"><?=$subject->class_no?></td>
										<td class="text-center"><?=$subject->class_name?></td>
										<td class="text-center"><?=$subject->name?></td>
										<td class="text-center">
											<button type="button" class="btn btn-sm bg-custom text-white edit_manage_subject"
													data-id="<?=$subject->id?>" data-name="<?=$subject->name?>"
													data-active="<?=$subject->active?>" data-subject_id="<?=$subject->subject_id?>"
													data-class_id="<?=$subject->class_id?>">
												<i class="fa fa-edit"></i>
											</button>
											<?php if($this->group=='admin') {?>
											<button data-id="<?=$subject->id?>" class="btn btn-sm btn-danger delete_subject">
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
										<!-- MANAGING Modal -->
<div class="modal fade" id="managing_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-white">
				<h4 class="modal-title" id="ModalLabel">مضمون ترتیب دیں</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="managing_form" method="post" action="<?= site_url('Subject/manage_subject') ?>">
				<div class="modal-body">
					<div class="col-12">
						<label for="class_name">کلاس</label>
						<select id="class_name" name="class_name" class="form-control select2" style="width:100%" tabindex="1">
							<?php foreach($classes as $class): ?>
								<option value="<?=$class->id?>"><?=$class->class_name?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="col-12">
						<label for="subject">مضمون</label>
						<select id="subject" name="subject" class="form-control subject select2" style="width:100%" tabindex="2">
							<?php foreach($subjects as $subject): ?>
								<option value="<?=$subject->id?>"><?=$subject->name?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="modal-footer pull-right">
					<button id="managing_save" type="submit" class="btn btn-success">
						<i class="fa fa-save">&nbsp;</i>
						محفوظ کریں
					</button>
					<button id="managing_update" type="submit" class="btn btn-custombg text-white">
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
				<h4 class="modal-title" id="exampleModalLongTitle">ترتیب کو حزف کریں؟</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-danger">
				<h5>کیا آپ اس ترتیب کو واقعی حذف کرنا چاہتے ہیں؟</h5>
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
		$('.manage_subject').click(function () {
			$('#ModalLabel').html('مضمون ترتیب دیں');

			$('.modal-header').addClass('bg-success');
			$('.modal-header').removeClass('bg-custom');

			$('#managing_save').show();
			$('#managing_update').hide();
			$('#status').hide();

			$('#managing_modal').modal('show');
		});

		$('.edit_manage_subject').click(function () {
			$('#ModalLabel').html('ترتیب میں ترمیم کریں');

			$('.modal-header').addClass('bg-custom');
			$('.modal-header').removeClass('bg-success');

			$('#managing_save').hide();
			$('#hide').show();
			$('#managing_update').show();
			$('#status').show();

			var class_id = $(this).data('class_id');
			$('#class_name').val(class_id).trigger('change');

			var subject = $(this).data('subject_id');
			$('#subject').val(subject).trigger('change');

			var id = $(this).data('id');
			var url = '<?=site_url('Subject/update_manage_subject/')?>'+id;
			$('#managing_form').attr('action',url);

			$('#managing_modal').modal('show');
		});

		$('.delete_subject').click(function () {
			var id = $(this).data('id');
			var url = '<?= site_url('Subject/delete_manage_subject/') ?>'+id;
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
	});
</script>
