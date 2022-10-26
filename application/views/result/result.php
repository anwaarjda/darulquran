<style>
	.table .thead-dark th{
		vertical-align: middle;
	}

	@media print {

		#hide,#show {
		display: none !important;
		}
		.content {
		/*margin-right: -10%;*/
		/*padding-left: -3%;*/
		}
		.table-responsive {
		border: 0;
		overflow-x: hidden;
		}
		.panel {
		border: 0;
		}
		.lbl {
		width: 100%;
		margin: 0 90% 0 0;
		}
		.heading {
		margin-left: 40px;
		}
		.table-bordered, .table-bordered th, .table-bordered td {
			border: 1px solid black !important;
			color: #0b0b0b;
		}
		input {
			border: none;
		}
	}
</style>
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div id="hide" class="col-12 text-center">
					<h5>بسم اللّٰہ ارحمٰن ارحیم</h5>
					<h6 class="pull-right"  style="font-family:''; ">
						<b>شعبہ تحفیظ القرآن الکریم</b>
						<br><br>
						<img height="25" src="<?=base_url('assets/images/logo.jpg')?>" alt="LOGO IMAGE">
						<br>
						کراتشی۰۱۷ باکستان
					</h6>
					<img width="80" class="pull-left" src="<?=base_url('assets/images/logo.jpeg')?>" alt="LOGO IMAGE">
					<h1>نتیجہ امتحان شعبہ دارالقرآن جامعہ دارالعلوم کراچی</h1>
				</div>
				<div class="col-12">
					<form id="form" method="post" action="<?=base_url('Result/save_exam')?>">
						<div id="hide" class="row">
							<div class="col-md-2">
								<div class="form-admission_numberoup">
									<label for="exam">امتحان </label>
									<select id="exam" name="exam" class="form-control select2" required>
										<option selected value="">عرصہ منتخب کریں</option>
										<option value="1">سہ ماہی</option>
										<option value="2">شِشماہی</option>
										<option value="3">سالانہ</option>
									</select>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-admission_numberoup">
									<label for="class">کلاس </label>
									<select id="class" name="class" class="form-control select2" required style="width: 180px">
										<option value="" selected>کلاس منتخب کریں</option>
										<?php foreach ($classes as $class): ?>
										<option value="<?= $class->id?>"><?=$class->class_name?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<div id="show" class="row mt-3" style="display: none">
							<div class="form-admission_numberoup ">
								<label class="control-label" for="inputSuccess" >تاریخ منتخب کریں</label>
								<input type="date" id="date" name="date" class="form-control" value="" required>
							</div>

							<div class="col-md-2 form-admission_numberoup ">
								<label class="control-label" for="inputSuccess" >بمطابق</label>
								<input type="text" id="date_hijri" name="date_hijri" class="form-control" value="" required readonly>
							</div>

							<div>
								<div class="form-admission_numberoup">
									<label class="control-label" for="teacher">ممتحن</label>
									<select id="teacher" name="teacher" class="form-control" required>
										<option value="" selected>ممتحن منتخب کریں</option>
										<?php foreach ($teachers as $teacher): ?>
											<option><?=$teacher->name?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="col-md-1">
								<div class="form-admission_numberoup">
									<label for="duration">ایام تعلیم</label>
									<input type="text" id="duration" name="duration" class="form-control" placeholder="ایام تعلیم" min="1" required>
								</div>
							</div>

							<div>
								<div class="form-admission_numberoup">
									<label for="time">وقت</label>
									<select id="time" name="time" class="form-control" required>
										<option value="" selected>وقت منتخب کریں</option>
										<option>صبح</option>
										<option>دوپہر</option>
									</select>
								</div>
							</div>
							<div class="m-t-30">
								<button type="submit" id="next" class="btn btn-primary ml-2 next" style="font-size: 20px;margin-top: 4%;">
									امتحان کا اندراج کریں
								</button>
							</div>
							<div class="m-t-30 ml-1">
								<button id="print" type="submit" name="print" class="btn btn-success" value="print" style="font-size: 20px;margin-top: 9%">
									رِزلٹ
								</button>
							</div>
							<div class="m-t-30 ml-1">
								<button id="blank_sheet" type="submit" name="print" class="btn btn-dark" value="blank_sheet" style="font-size: 20px;margin-top: 9%">
									خالی شیٹ
								</button>
							</div>
							<input type="hidden" name="student_id[]" value="<?=$student->student_id??null?>">
						</div>
					</form>
				</div>
				<?php
				if(!empty($exam)):
					if($exam->exam==1)
					{
						$exam_name='سہ ماہی';
					}
					elseif($exam->exam==2)
					{
						$exam_name='ششماہی';
					}
					elseif($exam->exam==3)
					{
						$exam_name='سالانہ';
					}
				?>
				<div id="info" class="col-12 text-left">
					<label class="col-1"><b>امتحان :</b></label>
					<label class="col-md-1"><?=$exam_name?></label>

					<label class="col-1"><b>درجہ :</b></label>
					<label class="col-md-1"><?=$exam->darja?></label>

					<label class="col-1"><b>تاریخ و ماہ :</b></label>
					<label class="col-md-2 montserrat"><?=date('d-m-Y',strtotime($exam->date_hijri))?></label>

					<label class="col-1"><b>بمطابق :</b></label>
					<label class="col-md-3 montserrat"><?=date('d-m-Y',strtotime($exam->date));?></label>

					<label class="col-1"><b>ایّامِ تعلیم :</b></label>
					<label class="col-md-1"><?=$exam->duration.' &nbsp;&nbsp;   ایّام '?></label>

					<label class="col-1"><b>وقت :</b></label>
					<label class="col-md-1"><?=$exam->time?></label>

					<label class="col-1"><b>متعلقہ :</b></label>
					<label class="col-md-2">محترم <?=$exam->class_name?> </label>

					<label class="col-1"><b>ممتحن :</b></label>
					<label class="col-md-3">محترم  <?=$exam->teacher?> مدظلہم</label>
				</div>
				<?php endif; ?>

				</div>
				<?php if(!empty($students)){ ?>
				<div class="col-md-12">
					<form id="save_result_form" method="post" action="<?=base_url('Result/save_result/')?>">
						<table id="hide" class="table table-striped table-bordered text-center mt-3">
							<thead class="thead-dark">
								<tr>
									<th>نمبر شمار</th>
									<th style="width: 70px">جی آر نمبر</th>
									<th style="width: 100px">نام</th>
									<th style="width: 100px">
										حاضری
										<i class="fa fa-exclamation-circle ml-2"
										   data-toggle="tooltip"
										   data-placement="top"
										   title="ریڈیو بٹن پر سے کلک ہٹانے کے لیے CTRL دبا کر ماؤس سے ریڈیو بٹن پر کلک کریں۔"
										></i>
									</th>
									<th>سابقہ مقدار خواندگی</th>
									<th>موجودہ مقدار خواندگی</th>
									<th>اضافہ مقدار خواندگی</th>
									<th>صرف نماز</th>
									<th style="width: 85px">حاصل کردہ نمبرات</th>
									<th>مقدار خواندگی نماز، کلمے، دعائیں</th>
									<th style="width: 85px">حاصل کردہ نمبرات</th>
									<th>کیفیت</th>
								</tr>
							</thead>
							<tbody id="listRecords">
							<?php
							$sn = 1;
							foreach ($students as $key => $student) {?>
								<tr class="list">
									<td class="montserrat"><?=$sn++?></td>
									<td class="montserrat">
										<?= $student->gr_number ?>
										<input type="hidden" name="enroll_id[]" value="<?=$student->enroll_id?>">
									</td>
									<td class="text-left"><?= $student->name ?></td>
									<td>
										<div class="form-inline" style="padding-top: 5px;">
											<div class="radio radio-success radio-inline" style="padding-right: 5px;">
												<input id="a_<?=$student->student_id?>" type="radio" name="attendance_<?=$student->student_id?>"
													<?=(!empty($results[$key]->attendance)&&$results[$key]->attendance=='غ'?'checked':null)?>
													   class="form-control btn_radio attendence" value="غ" data-waschecked="true">
												<label for="a_<?=$student->student_id?>">
													غ
												</label>
											</div>

											<div class="radio radio-success radio-inline">
												<input id="cl_<?=$student->student_id?>" type="radio" name="attendance_<?=$student->student_id?>"
													<?=(!empty($results[$key]->attendance)&&$results[$key]->attendance=='ر'?'checked':null)?>
													   class="form-control btn_radio attendence" value="ر" data-waschecked="true">
												<label for="cl_<?=$student->student_id?>">
													ر
												</label>
											</div>
										</div>
									</td>
									<td>
										<input type="text" name="sabiqa_miqdar[]" class="form-control sabiqa_miqdar" value="<?=$results[$key]->sabiqa_miqdar??null?>" >
									</td>
									<td>
										<input type="text" name="mojuda_miqdar[]" class="form-control mojuda_miqdar" value="<?=$results[$key]->mojuda_miqdar??null?>" >
									</td>
									<td>
										<input type="text" name="izafi_miqdar[]" class="form-control izafi_miqdar" value="<?=$results[$key]->izafi_miqdar??null?>" >
									</td>
									<td>
										<input type="checkbox" id="only_namaz_<?=$sn?>" class="only_namaz" <?=(($results[$key]->only_namaz ?? 0) == 1) ? 'checked' : '' ;?>/>
										<input type="hidden" class="only_name_hidden" name="only_namaz[]" value="<?=(($results[$key]->only_namaz ?? 0) == 1) ? '1' : '0' ;?>"/>
									</td>
									<td>
										<input type="number" name="quran[]" class="form-control quran montserrat" value="<?=$results[$key]->quran??null?>" min="0" max="100">
									</td>
									<td>
										<input type="text" name="namaz_miqdar[]" class="form-control namaz_miqdar" value="<?=$results[$key]->namaz_miqdar??null?>" >
									</td>
									<td>
										<input type="number" name="namaz[]" class="form-control namaz montserrat" value="<?=$results[$key]->namaz??null?>" min="0" max="100">
									</td>
									<td>
										<input type="text" name="kayfiat[]" class="form-control kayfiat" value="<?=$results[$key]->kayfiat??null?>">
									</td>
								</tr>
								<input type="hidden" name="student_id[]" value="<?=$student->student_id?>">
								<input type="hidden" name="exam_id" value="<?=$exam_id?>">
								<input type="hidden" name="result_id[]" value="<?=$results[$key]->id??null //null-important?>">
								<?php } ?>
								<tr>
									<th colspan="4" class="h3">مجموعی تعلیمی کیفیت</th>
									<th colspan="3" class="h3">ممتحن صاحب کی رائے گرامی</th>
									<th colspan="4" class="h3">برائے عمیدالدراسات </th>
								</tr>
								<tr>
									<td colspan="4">
										<textarea type="text" name="overall_educational_quality" class="form-control" placeholder="مجموعی تعلیمی کیفیت" rows="5"><?=$exam->overall_educational_quality??null?></textarea>
									</td>
									<td colspan="3">
										<textarea type="text" name="remarks" class="form-control" placeholder="ممتحن صاحب کی رائے" rows="5"><?=$exam->remarks??null?></textarea>
									</td>
									<td colspan="4">
										<textarea type="text" name="principal_remarks" class="form-control" placeholder="برائے عمیدالدراسات" rows="5"><?=$exam->principal_remarks??null?></textarea>
									</td>
								</tr>
							</tbody>
						</table>
						<div id="hide" class="text-center" >
							<button id="save" type="submit" class="btn btn-success mt-2">
								<i class="fa fa-save">&nbsp;</i>
								محفوظ کریں
							</button>
						</div>
					</form>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
<script>

$(document).ready( function (){
	$('input[type="radio"]').click(function(e){
		var $radio = $(this);
		if (e.ctrlKey) {
			$radio.prop('checked', false);
		}
	});

	$('#date').change(function () {
		$.ajax({
			url: '<?= site_url("Date/get_hijri_date/") ?>' + $(this).val(),
			success: function (response) {
				let result = JSON.parse(response);
				$('#date_hijri').val(result.hijri_date)
				$('.date_hijri').text('بمطابق '+result.hijri_date);
			}
		})
	})

	$('#next').click(function (){
		var id = $(this).val();
		var url = '<?=base_url('Result/save_exam/')?>'+id;
		$('#form').attr('action',url).attr('target', '_self');
	});

	$('#print, #blank_sheet').click(function (){
		var id = $('#next').val();
		var url = '<?=base_url('Result/save_exam/')?>'+id;
		$('#form').attr('action',url).attr('target','_blank');
	});

	$('#class').change(function() {

		$('#show').show();

		var exam_no = $('#exam').val();
		$('.exam').html(exam_no);

		var class_id = $(this).val();
		var exam = $('#exam').val();

		$.ajax({
			url: '<?=base_url('Result/get_exam/')?>'+class_id+'/'+exam,
			type: "GET",
			success:function(response) {
				var data = JSON.parse(response);
				if(data.error != 1) {
					$('#next').val(data.id);
					$('#date').val(data.date);
					$('#date_hijri').val(data.date_hijri);
					$('#teacher').val(data.teacher).trigger('change');
					$('#duration').val(data.duration);
					$('#time').val(data.time);
				}else{
					$('#next').val('');
					$('#date').val('');
					$('#date_hijri').val('');
					$('#teacher').val('');
					$('#duration').val('');
					$('#time').val('');
				}
			}
		});
	});

	$('#exam').change(function(){
		$('#class').val('');
		$('#next').val('');
		$('#date').val('');
		$('#date_hijri').val('');
		$('#duration').val('');
		$('#time').val('');
		$('#show').hide();
		$('#info').hide();
		$('#save_result_form').hide();
	});

	$('#result_active>a').addClass('active');

	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();

	if(dd<10){
		dd='0'+dd
	}
	if(mm<10){
		mm='0'+mm
	}

	today = yyyy+'-'+mm+'-'+dd;
	$('#date').attr("max", today);

	$('.btn_radio').on('click',function(){
		if($(this).is(':checked')) {
			$(this).parents('tr').find('.sabiqa_miqdar,.mojuda_miqdar,.izafi_miqdar,.quran,.namaz_miqdar,.namaz,.kayfiat').attr('readonly',true);
		}
		else {
			$(this).parents('tr').find('.sabiqa_miqdar,.mojuda_miqdar,.izafi_miqdar,.quran,.namaz_miqdar,.namaz,.kayfiat').attr('readonly',false);
		}
	})

	$(".only_namaz").on('click',function(){
		if($(this).is(':checked')) {
			$(this).closest('tr').find('.quran').attr('readonly',true);	
			$(this).closest('tr').find('input[name="only_namaz[]"]').val(1);
		}else{
			$(this).closest('tr').find('.quran').attr('readonly',false);	
			$(this).closest('tr').find('input[name="only_namaz[]"]').val(0);
		}
	});

	$(".only_namaz").each(function() {
		if($(this).is(':checked')) {
			$(this).closest('tr').find('.quran').attr('readonly',true);	
		}
	})

});

$(document).ready(function(){
	$('.attendence:radio:checked').each(function(){
		$(this).trigger('click');
	});
});


</script>
