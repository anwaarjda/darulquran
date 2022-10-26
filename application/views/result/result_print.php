<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>نتیجہ پرنٹ فارم</title>
	<!-- App CSS -->
	<link href="<?= base_url()?>assets/css/style.css?v=1.1" rel="stylesheet" type="text/css" />
	<link href="<?= base_url()?>assets/css/app-rtl.min.css" rel="stylesheet" type="text/css" />

	<style>
		body {
			font-family: 'jameel noori nastaleeq';
			font-size: 20px;
			padding: 10px;
			text-align: center;
		}

		table {
			width: 100%;
			margin: 0 auto;
			border: 1px solid black;
			border-collapse: collapse;
		}

		th, td {
			border: 1px solid black;
			text-align: center;
			font-size: 16px;
			padding: 1px;
		}

		.d-inline-block {
			display: inline-block;
		}

		.d-flex {
			display: flex;
		}
		.col-4 {
			width: 33%;
		}
		.col-3 {
			width: 25%;
		}
		.col-2{
			width: 16.5%;
		}

		#print-button {
			position: fixed;
			left: 5px;
			top: 5px;
		}

		.btn {
			display: inline-block;
			font-weight: 400;
			text-align: center;
			white-space: nowrap;
			vertical-align: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			border: 1px solid transparent;
			padding: 0.375rem 0.75rem;
			font-size: 1rem;
			line-height: 1.5;
			border-radius: 0.25rem;
			transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		}

		.btn:not(:disabled):not(.disabled) {
			cursor: pointer;
		}

		@media print {
			.summary-table {
				page-break-inside: avoid !important;
			}
		}

	</style>
</head>
<body>
<div class="row">
	<button class="btn btn-dark hidden-print" id="print-button" onclick="window.print();return false;">
		<i class="fa fa-print"></i>
	</button>
	<div class="w-100 d-flex">
		<div class="col-4">
			<div>شعبہ تحفیظ القرآن الکریم</div>
			<img height="25" src="<?=site_url('assets/images/logo.jpg')?>" alt="Logo">
			<div>کراتشی۰۱۷ باکستان</div>
		</div>

		<div class="col-4">
			<div>بسم اللّٰہ ارحمٰن ارحیم</div>
			<div class="text-center font-22">نتیجہ امتحان شعبہ دارالقرآن جامعہ دارالعلوم کراچی</div>
		</div>

		<div class="col-4">
			<img width="80" src="<?=site_url('assets/images/logo.jpeg')?>" alt="Logo">
		</div>
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
		<div class="d-flex w-100 text-left">
			<div class="col-2">
				<strong>امتحان:</strong>
				<span class="ml-2"><?=$exam_name?></span>
			</div>

			<div class="col-2">
				<strong>درجہ:</strong>
				<span class="ml-2"><?=$exam->darja?></span>
			</div>

			<div class="col-4">
				<strong>تاریخ و ماہ :</strong>
				<span class="montserrat ml-2"><?=$exam->date_hijri?></span>
			</div>

			<div class="col-4">
				<strong>بمطابق :</strong>
				<div class="d-inline-block montserrat ml-2"><?=date('d-m-Y',strtotime($exam->date));?></div>
			</div>
		</div>

		<div class="d-flex text-left">
			<div class="col-2">
				<strong>ایام تعلیم :</strong>
				<span class="montserrat ml-2"><?= $exam->duration ?></span>
				<span>دن</span>
			</div>

			<div class="col-2">
				<strong>وقت :</strong>
				<span class="ml-2"><?=$exam->time?></span>
			</div>

			<div class="col-4">
				<strong>متعلقہ :</strong>
				<span class="ml-2">محترم <?=$exam->class_name?> </span>
			</div>

			<div class="col-4">
				<strong>ممتحن :</strong>
				<span class="ml-2">محترم <?=$exam->teacher?> مدظلہم</span>
			</div>
		</div>
	<?php endif; ?>

	<?php if(!empty($students)){ ?>
		<div class="w-100">
			<table class="table table-striped table-bordered text-center">
				<thead>
				<tr>
					<th style="width: 15px">نمبر شمار</th>
					<th style="width: 45px">جی آر نمبر</th>
					<th style="width: 175px">نام طالبعلم مع ولدیت</th>
					<th style="width: 15px">حاضری</th>
					<th style="width: 90px">سابقہ مقدار خواندگی</th>
					<th style="width: 90px">موجودہ مقدار خواندگی</th>
					<th style="width: 90px">اضافہ مقدار خواندگی</th>
					<th style="width: 15px">حاصل کردہ نمبرات</th>
					<th style="width: 80px">مقدار خواندگی نماز، کلمے، دعائیں</th>
					<th style="width: 15px">حاصل کردہ نمبرات</th>
					<th>کیفیت</th>
					<th>پوزیشن</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$sn = 1;
				foreach ($students as $key => $student) {?>
					<tr>
						<td class="montserrat font-14"><?= $sn++ ?></td>
						<td class="montserrat font-14"><?= $student->gr_number ?></td>
						<td class="font-15"><?= $student->name . ' ولد ' . $student->father_name ?></td>
						<td><?= $print != 'blank_sheet' ? ($results[$key]->attendance ?? null) : null ?></td>
						<td class="font-15"><?= $print != 'blank_sheet' ? ($results[$key]->sabiqa_miqdar ?? null) : null ?></td>
						<td class="font-15"><?= $print != 'blank_sheet' ? ($results[$key]->mojuda_miqdar ?? null) : null ?></td>
						<td class="font-15"><?= $print != 'blank_sheet' ? ($results[$key]->izafi_miqdar ?? null) : null ?></td>
						<td class="montserrat font-14"><?= $print != 'blank_sheet' ? ($results[$key]->quran ?? null) : null ?></td>
						<td><?= $print != 'blank_sheet' ? ($results[$key]->namaz_miqdar ?? null) : null ?></td>
						<td class="montserrat font-14"><?= $print != 'blank_sheet' ? ($results[$key]->namaz ?? null) : null ?></td>
						<td><?= $print != 'blank_sheet' ? ($results[$key]->kayfiat ?? null) : null ?></td>
						<td><?php
							$marks_value = (($results[$key]->only_namaz ?? null ) == 1) ? ($results[$key]->namaz ?? null) : ($results[$key]->quran ?? null);
							?>
							<?= $print != 'blank_sheet' ? (($student_position[$marks_value ?? null]) ?? null) : null ?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>

			<table class="summary-table">
				<tr>
					<th colspan="4" class="h3">مجموعی تعلیمی کیفیت</th>
				</tr>
				<tr>
					<td colspan="4" style="border: #0b0b0b 1px solid;">
						<?= !empty($exam->overall_educational_quality) ? $exam->overall_educational_quality : '<br><br>' ?>
					</td>
				</tr>
				<tr>
					<th colspan="2">
						اجمالی نتیجہ<br>
						<?=$exam->class_name ?? ''?>
					</th>
					<th class="h3">ممتحن صاحب کی رائے گرامی</th>
					<th class="h3" style="vertical-align: middle">برائے عمیدالدراسات</th>
				</tr>
				<tr>
					<th style="width: 100px">درجات</th>
					<th style="width: 100px">تعداد</th>
					<td rowspan="9" style="text-align: right;vertical-align: top;padding: 5px">
						<?= !empty($exam->remarks) ? $exam->remarks : '<br><br>' ?>
					</td>
					<td rowspan="9" style="text-align: right;vertical-align: top;padding: 5px">
						<?=$exam->principal_remarks??null?>
					</td>
				</tr>
				<tr>
					<th>ممتاز</th>
					<td><?= $print != 'blank_sheet' ? ($this->Result_model->count_grade($exam_id,'ممتاز')->total??'0') : null;?></td>
				</tr>
				<tr>
					<th>جید جداً</th>
					<td><?= $print != 'blank_sheet' ? ($this->Result_model->count_grade($exam_id,'جیدجداً')->total??'0') : null;?></td>
				</tr>
				<tr>
					<th>جید</th>
					<td><?= $print != 'blank_sheet' ? ($this->Result_model->count_grade($exam_id,'جید')->total??'0') : null;?></td>
				</tr>
				<tr>
					<th>مقبول</th>
					<td><?= $print != 'blank_sheet' ? ($this->Result_model->count_grade($exam_id,'مقبول')->total??'0') : null;?></td>
				</tr>
				<tr>
					<th>راسب</th>
					<td><?= $print != 'blank_sheet' ? ($this->Result_model->count_grade($exam_id,'راسب')->total??'0') : null;?></td>
				</tr>
				<tr>
					<th>غیرحاضر</th>
					<td><?= $print != 'blank_sheet' ? ($this->Result_model->count_attendance($exam_id,'غ')->total??'0') : null;?></td>
				</tr>
				<tr>
					<th>رخصت</th>
					<td><?= $print != 'blank_sheet' ? ($this->Result_model->count_attendance($exam_id,'ر')->total??'0') : null;?></td>
				</tr>
				<tr>
					<th>میزان</th>
					<td><?= $print != 'blank_sheet' ? ($this->Result_model->get_students_by_exam($exam_id)->total ?? '0') : null; ?></td>
				</tr>
			</table>
		</div>
	<?php } ?>
</div>
</body>
</html>
