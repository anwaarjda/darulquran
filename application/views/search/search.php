<?php $age = date('Y') - date('Y', strtotime($search[0]->dob??null));?>

<style>
	.table td, .table th {
		border: 1px solid #0b0b0b;
		padding: 3px;
		vertical-align: middle;
	}

	.table td p {
		margin-bottom: 0;
	}

	.table td {
		font-size: 21px;
		text-align: center;
	}

	.thead-dark th:nth-child(1),th:nth-child(2)
	{
		width: 7%;
	}

	.thead-dark th:nth-child(3)
	{
		width: 25%;
	}

	.thead-dark th:nth-child(4)
	{
		width: 10%;
	}
	.btn-linkedin{
		font-size: small;
	}

	@media print {
		#hide {
			display: none !important;
		}

		.invoice-box table tr.info {
			border: none;
		}

		.invoice-box table tr.info .td1 .td2 {
			border: none;
			display: inline-block;
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

		.table-bordered.dark-border, .table-bordered.dark-border th,
		.table-bordered.dark-border td {
			border: 1px solid black !important;
			color: black;
		}

		.table tr th span{
			color :black;
		}
	}
</style>

<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<form id="hide" method="post" action="<?=base_url('Student/detail_student')?>">
						<div class="row">
							<div class="col-md-3">
								<div class="form-admission_numberoup">
									<label>تلاش بذریعہ :</label>
									<select id="option" name="option" class="form-control select2" required>
										<option value="gr_number" selected>جی آر نمبر</option>
										<option value="admission_number">داخلہ نمبر</option>
										<option <?=(!empty($option)&&$option=='name'?'selected':null)?> value="name">نام</option>
										<option <?=(!empty($option)&&$option=='father_name'?'selected':null)?> value="father_name">ولدیت</option>
										<option <?=(!empty($option)&&$option=='father_cnic'?'selected':null)?> value="father_cnic">والد کا شناختی کارڈ نمبر</option>
										<option <?=(!empty($option)&&$option=='area'?'selected':null)?> value="area">علاقہ</option>
									</select>
								</div>
							</div>

							<div class="col-md-3 details_div" style="display: <?= ($option=='area')?'none':'block' ?>">
								<div class="form-admission_numberoup">
									<label id="lbl_name">تفصیل</label>
									<input type="search" id="detail" name="detail" class="form-control"
										   placeholder="تفصیل" value="<?=(!empty($detail)?$detail:null)?>" autofocus autocomplete="off">
								</div>
							</div>

							<div class="col-md-3 area_div" style="display: <?= ($option=='area')?'block':'none' ?>">
								<div class="form-group">
									<label for="area">علاقہ</label>
									<select id="area" name="area_id" class="form-control select2" tabindex="14" style="width:250px">
										<option selected="selected">علاقہ منتخب کریں</option>
										<?php foreach ($areas as $area) :?>
											<option value="<?=$area->id?>"><?=$area->area?></option>
										<?php endforeach ?>
									</select>
									<span class="text-danger pull-right"><p id="area_error"></p></span>
								</div>
							</div>

							<div class="col-md-3 class" style="display: none;">
								<div class="form-admission_numberoup">
									<label for="class">کلاس </label>
									<select id="class" name="class" class="form-control select2" style="width: 250px;">
										<option value="" selected>کلاس منتخب کریں</option>
										<?php foreach ($classes as $class): ?>
											<option <?=(!empty($class_id)&&$class_id==$class->id?'selected':null)?> value="<?=$class->id?>"><?=$class->class_name?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="col-md-1">
								<div class="form-admission_numberoup" style="margin-top:45%;">
									<button type="submit" class="btn btn-primary mt-2" style="font-size: 17px">
										<i class="fa fa-search"></i>
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
			<?php
			if (!empty($search)&&$option=='name' OR !empty($search)&&$option=='father_name' OR
			!empty($search)&&$option=='guardian_phone' OR !empty($search)&&$option=='father_cnic'
			OR !empty($search)&&$option=='area') { ?>
				<div class="col-12">
					<div class="card-box table-responsive">
						<table class="table table-striped table-bordered text-center">
							<thead class="thead-dark">
								<tr>
									<th>نمبر شمار</th>
									<th>داخلہ نمبر</th>
									<th>نام</th>
									<th>ولدیت</th>
									<th>علاقہ</th>
									<th>کلاس</th>
									<th>کیفیت</th>
								</tr>
							</thead>
							<tbody id="listRecords">
							<?php
							$sn = 1;
							foreach ($search as $result): ?>
								<tr>
									<td><?=$sn++?></td>
									<td><?=$result->admission_number?></td>
									<td><?=$result->name?>
										<a type="button" class="col-4 btn btn-sm btn-primary pull-left"
										   href="<?=base_url("Student/detail_student/$result->student_id/$result->class_id");?>"
										   target="_blank">
											تفصیل
										</a>
									</td>
									<td><?=$result->father_name?></td>
									<td><?=$result->area?></td>
									<td><?=$result->class_name?>
										<a type="button" class="col-3 btn btn-sm btn-linkedin pull-left" target="_blank"
										   href="<?=base_url("Classes/get_students_by_class/$result->class_id");?>">
											فہرست
										</a>
									</td>
									<td>
										<?=($result->active==1)?'<p class="text-success">فعال</p>':'<p class="text-danger">غیر فعال</p>'; ?>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	function myFunction() {
		window.print();
	}

	$(document).ready(function () {
		$("#option").change(function () {
			var option = $(this).val();

			if (option!='admission_number' && option != 'gr_number'){
				$('.class').show();
			}
			if (option == '') {
				$('#lbl_name').html('تفصیل');
			}
			if (option == 'admission_number') {
				$('#lbl_name').html('داخلہ نمبر');
				$('.class').hide();
			}
			if (option == 'gr_number') {
				$('#lbl_name').html('جی آر نمبر');
				$('.class').hide();
			}
			if (option == 'name') {
				$('#lbl_name').html('نام');
				$('.class').show();
			}
			if (option == 'father_name') {
				$('#lbl_name').html('ولدیت');
				$('.class').show();
			}
			if (option == 'father_cnic') {
				$('#lbl_name').html('والد کا شناختی کارڈ نمبر');
				$('.class').show();
			}
			if (option == 'area') {
				$('#lbl_name').html('علاقہ');
				$('.area_div').show();
				$('.details_div').hide();
				$('.class').show();
			}
			else
			{
				$('.area_div').hide();
				$('.details_div').show();
			}
		});

		var option = $('#option').val();
		if (option == 'name') {
			$('.class').show();
		}
		if (option == 'father_name') {
			$('.class').show();
		}
		if (option == 'father_cnic') {
			$('.class').show();
		}
		if (option == 'area') {
			$('.class').show();
		}
		
		$('#search_active>a').addClass('active');
	});
</script>
