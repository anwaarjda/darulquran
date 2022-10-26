<style>
	tr.list>td:nth-child(1),tr.list>td:nth-child(2) {
		width: 6.5%;
	}
	tr.list>td:nth-child(3) {
		width: 25%;
	}
	.duration {
		font-weight: bold;
	}
</style>
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="card-box">
				<div class="col-md-12">
					<h2 class="text-center" >
						حاضری
					</h2>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<form id="get_student_form" method="post" action="<?=site_url('Attendance/get_student')?>">
						<div class="row">
							<div class="col-md-2">
								<div class="form-admission_numberoup">
									<label for="period">عرصہ </label>
									<select id="period" name="period" class="form-control select2 period" required>
										<option value="">عرصہ منتخب کریں</option>
										<option <?=(!empty($period_no)&&$period_no=='1'?'selected':null)?> value="1">سہ ماہی</option>
										<option <?=(!empty($period_no)&&$period_no=='2'?'selected':null)?> value="2">شِشماہی</option>
										<option <?=(!empty($period_no)&&$period_no=='3'?'selected':null)?> value="3">سالانہ</option>
									</select>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-admission_numberoup">
									<label for="class">متعلقہ اُستاذ </label>
									<select id="class" name="class" class="form-control select2" required>
										<option value="" selected>کلاس منتخب کریں</option>
										<?php foreach ($classes as $class): ?>
											<option <?=(!empty($class_id)&&$class_id==$class->id?'selected':null)?> value="<?=$class->id?>" data-class_name="<?=$class->class_name?>"><?=$class->class_name?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="col-md-2 m-t-30">
								<button type="submit" id="next" class="col-12 btn btn-primary next mt-2">
									حاضری کا اندراج
								</button>
							</div>

							<?php
							if(!empty($period_no)):
							if($period_no==1)
							{
								$period='سہ ماہی';
							}
							elseif($period_no==2)
							{
								$period='ششماہی';
							}
							elseif($period_no==3)
							{
								$period='سالانہ';
							}
							endif ?>
							<div class="col-md-2 h4" style="margin-top: 4%">
								<label >عرصہ:</label>
								<label id="lbl_period"><?=(!empty($period_no)?$period:null)?></label>
							</div>

							<div class="col-md-3 h4" style="margin-top: 4%">
								<label>متعلقہ اُستاذ:</label>
								<?php foreach ($classes as $class): ?>
								<label id="lbl_class"><?=(!empty($class_id)&&$class_id==$class->id?$class->class_name:null)?></label>
								<?php endforeach; ?>
							</div>
						</div>
					</form>
				</div>
			</div>

			<form id="attendance_form" method="post" action="<?=site_url('Attendance/mark_attendance')?>">
				<?php if(!empty($students)){ ?>
				<table id="hide" class="table table-striped table-bordered text-center mt-3">
					<thead class="thead-dark">
					<tr>
						<th>نمبر شمار</th>
						<th>جی آر نمبر</th>
						<th>داخلہ نمبر</th>
						<th>نام طالب علم</th>
						<th>
							 کل ایّام تعلیم:
							<input type="text" name="duration" class="form-control col-md-6 text-center font-weight-bolder duration"
							style="display: inline" value="<?=$attendance[0]->duration??0?>" required>
						</th>
						<th>غیر حاضری</th>
						<th>رخصت</th>
						<th>بیماری</th>
					</tr>
					</thead>
					<tbody id="listRecords">
					<?php
					$sn = 1;
					foreach($students as $key => $student):
					?>
					<tr class="list">
						<td class="text-center montserrat"><?= $sn++ ?></td>
						<td class="text-center montserrat"><?= $student->gr_number ?></td>
						<td class="text-center montserrat"><?= $student->admission_number ?></td>
						<td class="text-left" style="min-width: 200px"><?=$student->name .' بِن '. $student->father_name?></td>
						<td class="text-center">
							<span class="duration montserrat"><?=$attendance[0]->duration??0?></span>
						</td>
						<td class="text-center">
							<input type="text" name="absent[]" class="form-control text-center montserrat absent" value="<?=$attendance[$key]->absent??0?>" >
						</td>
						<td class="text-center">
							<input type="text" name="casual_leave[]" class="form-control text-center montserrat casual_leave" value="<?=$attendance[$key]->casual_leave??0?>" >
						</td>
						<td class="text-center">
							<input type="text" name="sick_leave[]" class="form-control text-center montserrat sick_leave" value="<?=$attendance[$key]->sick_leave??0?>" >
						</td>
					</tr>
					<input type="hidden" name="student_id[]" value="<?=$student->student_id?>">
					<input type="hidden" name="attendance_id[]" value="<?=$attendance[$key]->id??null?>">
					<?php endforeach; ?>
					</tbody>
				</table>
				<div class="m-t-30 text-center">
					<button id="save" type="submit" class="btn btn-success">
						<i class="fa fa-save">&nbsp;</i>
						محفوظ کریں
					</button>
				</div>
				<input type="hidden" name="period" value="<?=$period_no?>">
				<input type="hidden" name="class_id" value="<?=$class_id?>">
				<?php } ?>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {

		$('.duration').keyup(function () {
			 $('.duration').text($(this).val());
		});

		$('#save').click(function (e) {

			e.preventDefault();
			var error = 0;

			$('tr.list').each(function() {

				var absent = $(this).find('input.absent').val();
				var casual_leave = $(this).find('input.casual_leave').val();
				var sick_leave = $(this).find('input.sick_leave').val();
				var duration = $('.duration').val();
				var total_leaves = Number(sick_leave)+Number(casual_leave)+Number(absent);

				if (total_leaves > duration) {
					error = 1;

					$(this).addClass('bg-danger');
					toastr['error']('غیر حاضری کُل ایام سے زیادہ ہیں');
				}
				else
				{
					$(this).removeClass('bg-danger');
				}
			});
			if (error == 0) {
				$('#attendance_form').submit();
			}a
		})

		$('#period,#class').change(function (){
			$('#attendance_form').hide();
			$('#lbl_period,#lbl_class').html('');
		})

		$('#attendance_active>a').addClass('active');

		// =============	Prevent submit form on ENTER and focus next box

		$('form date,select,input:not([type="submit"])').keydown(function(e) {
			if (e.keyCode == 13) {
				var inputs = $(this).parents('form').eq(0).find(':input');
				if (inputs[inputs.index(this) + 1] != null) {
					inputs[inputs.index(this) + 1].focus();
				}
				e.preventDefault();
			}
		})
	});
</script>
