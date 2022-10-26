<?php $age = date('Y') - date('Y', strtotime($search->dob??null));?>

<style>
	.table td, .table th {
		border: 1px solid #517fa4;
		padding: 3px;
		vertical-align: middle;
	}

	input[name="student_picture"] {
		margin-bottom: -10px;
	}

	.table th {
		font-size: 19px;
		background: lightsteelblue;
	}

	.table th.h3 {
		background-color: #517fa4;
		font-size: 24px;
		text-shadow: 1px 1px 2px black;
	}

	.table td p {
		margin-bottom: 0;
	}

	.table td {
		text-align: center;
		background: #ced4da;
	}

	.thead-dark th:nth-child(1)
	{
		width: 6%;
	}
	.thead-dark th:nth-child(3)
	{
		width: 25%;
	}
	.thead-dark th:nth-child(4)
	{
		width: 10%;
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
			padding: 3px;
			vertical-align: middle;
			font-size: 19px;
			text-align: center;
		}

		.table .thead-dark th {
			font-size: 22px;
		}

		.table tr th span,.table tr td p {
			color :black !important;
		}

		input[name="student_picture"] {
			margin-bottom: -10px;
		}

		.table th.h3 {
			font-size: 25px;
		}

		.table td p {
			margin-bottom: 0;
		}

		.thead-dark th:nth-child(1)	{
			width: 7%;
		}

		.thead-dark th:nth-child(3)	{
			width: 25%;
		}

		.thead-dark th:nth-child(4)	{
			width: 10%;
		}
	}
</style>

<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="col-12">
				<div class="card-box table-responsive mt-2">
					<table class="table table-bordered dark-border col-md-12">
						<tr>
							<th colspan="12" class="text-white h3 text-center p-2">
								<span class="align-middle ">طالب علم کی تفصیل</span>
									<a  id="hide" class="btn btn-light btn-sm pull-left" target="_blank" style="text-shadow: none"
										href="<?= base_url('Student/edit_student/').$student_details->id;?>">
										<i class="fa fa-edit">&nbsp;</i>
									</a>
							</th>
						</tr>
						<tr>
							<td colspan="2" rowspan="3">
								<?php
								$img = APPPATH.'..\assets\images\student_pictures\\'.$student_details->ac_year.'-'.$student_details->admission_number.'.jpg';

								if(file_exists($img))
								{
									echo "<img class='border border-dark' src='".base_url('assets/images/student_pictures/').$student_details->ac_year.'-'.$student_details->admission_number.'.jpg'."' width=100px; height=100px;/>";
								}
								else
								{
									echo '<img class="border border-dark" src="http://localhost/dar_ul_quran/assets/images/noimage.jpg"  width=100px; height=100px;/>';
								}
								?>
								<input type="file" id="student_image" style="display: none;" />
							</td>
							<th>نام :</th>
							<td><?= $student_details->name ?></td>
							<th>ولدیت :</th>
							<td><?= $student_details->father_name ?></td>
							<th>جی آر نمبر:</th>
							<td><?= $student_details->gr_number ?></td>
							<th> داخلہ نمبر :</th>
							<td>
								<?php
								$str_length = 4;

								// Left padding if number < $str_length
								$admission_number = substr("0000{$student_details->admission_number}", -$str_length);
								echo numtourdu($admission_number);
								?>
							</td>
						</tr>
						<tr>
							<th>متعلقہ استاد :</th>
							<td><?= $student_details->class_name ?></td>
							<th>کلاس نمبر :</th>
							<td><?= $student_details->class_no ?></td>
							<th>تعلیمی سال :</th>
							<td><?= $student_details->ac_year ?></td>
							<th>مقامِ پیدائش :</th>
							<td><?= $student_details->birthplace ?></td>
						</tr>
						<tr>
							<th>قدیم/جدید :</th>
							<td><?= ($student_details->admission_type=='new'?'جدید':'قدیم') ?></td>
							<th> سابقہ داخلہ نمبر :</th>
							<td>
								<?=substr("0000{$student_details->old_admission_number}", -4);?>
							</td>
							<th>مکمل پتہ :</th>
							<td colspan="3"><?= $student_details->address ?></td>
						</tr>
						<tr>
							<th>مُلک :</th>
							<td><?= $student_details->country ?></td>
							<th>صوبہ :</th>
							<td><?= $student_details->province ?></td>
							<th>ضلع :</th>
							<td><?= $student_details->district ?></td>
							<th>علاقہ :</th>
							<td><?= $student_details->area ?></td>
							<th>رہائش :</th>
							<td><?= $student_details->resident ?></td>
						</tr>
						<tr>
							<th>کیفیتِ طالب علم :</th>
							<td><?= ($student_details->active==1)?'<p class="text-success">فعال</p>':
										'<p class="text-danger">غیرفعال</p>'; ?>
							</td>
							<th>فون :</th>
							<td><?= $student_details->phone ?></td>
							<th>تاریخ پیدائِش</th>
							<td><?= date('d-m-Y', strtotime($student_details->dob)) ?></td>
							<th>شناختی کارڈ/ب فارم :</th>
							<td><?= $student_details->cnic ?></td>
							<th>والد کا شناختی کارڈ نمبر :</th>
							<td><?= $student_details->father_cnic ?></td>
						</tr>
					</table>
					<table class="table table-bordered dark-border col-md-12">
						<tr>
							<th colspan="12" class="h3 text-white text-center p-2">
								<span>سرپرست کی تفصیل</span>
							</th>
						</tr>
						<tr>
							<th>نامِ سرپرست :</th>
							<td><?= $student_details->guardian ?></td>
							<th>ولدیت سرپرست :</th>
							<td><?= $student_details->guardian_father_name ?></td>
							<th>رشتہ :</th>
							<td><?= $student_details->guardian_relation ?></td>
							<th>پیشہ سرپرست :</th>
							<td><?= $student_details->guardian_profession ?></td>
						</tr>
						<tr>
							<th>مکمل پتہ :</th>
							<td colspan="3"><?= $student_details->guardian_address ?></td>
							<th>فون نمبر :</th>
							<td><?= $student_details->guardian_phone ?></td>
							<th>سرپرست کا شناختی کارڈ نمبر :</th>
							<td><?= $student_details->guardian_cnic ?></td>
						</tr>
					</table>
					<table class="table table-bordered dark-border col-md-12">
						<tr>
							<th colspan="12" class="h3 text-white text-center p-2">
								<span>واقف کار کی تفصیل</span>
							</th>
						</tr>
						<tr>
							<th>کراچی میں کسی قریب ترین واقف کار کانام :</th>
							<td><?= $student_details->knownperson ?></td>
							<th>مکمل پتہ :</th>
							<td><?= $student_details->knownperson_address ?></td>
							<th>فون نمبر :</th>
							<td><?= $student_details->knownperson_phone ?></td>
						</tr>
					</table>
					<table class="table table-bordered dark-border col-md-12">
						<tr>
							<th colspan="12" class="h3 text-white text-center p-2">
								<span>سابقہ تعلیم</span>
							</th>
						</tr>
						<tr>
							<th>آخری درسگاہ کانام مع مختصر پتہ جہاں تعلیم پائی :</th>
							<td colspan="2"><?= $student_details->last_darsgah ?></td>
							<th>آخری درسگاہ چھوڑنے کا سبب واضح الفاظ میں :</th>
							<td colspan='2'><?= $student_details->leave_reason ?></td>
						</tr>
						<tr>
							<th>دیگر درسگاہوں کے نام مع مختصر پتےجہاں تعلیم پائی :</th>
							<td colspan='2'><?= $student_details->prev_darsgah ?></td>
							<th>سابقہ حاصل شدہ تعلیم :</th>
							<td colspan='2'><?= $student_details->prev_education ?></td>
						</tr>
					</table>
					<table class="table table-bordered dark-border col-md-12">
						<tr>
							<th colspan="12" class="h3 text-white text-center p-2">
								<span>ضامن کی تفصیل</span>
							</th>
						</tr>
						<tr>
							<th>ضامن کا نام :</th>
							<td><?= $student_details->guarantor ?></td>
							<th>ولدیتِ ضامن :</th>
							<td><?= $student_details->guarantor_father_name ?></td>
							<th>وطن اصلی :</th>
							<td colspan="2"><?= $student_details->guarantor_country ?></td>
						</tr>
						<tr>
							<th>ساکن حال :</th>
							<td colspan="2"><?= $student_details->guarantor_address ?></td>
							<th>قومی شناختی کارڈ نمبر :</th>
							<td><?= $student_details->guarantor_cnic ?></td>
							<th>عرصۂ واقفیت:</th>
							<td><?= $student_details->known_from ?></td>
						</tr>
					</table>
					<form id="update_profile_form" method="post" enctype="multipart/form-data" action="<?= base_url('Student/update_profile')?>">
						<table class="table table-bordered dark-border col-md-12">
							<tr id="hide">
								<th colspan="12" class="h3 text-white text-center p-2">ترتیبات</th>
							</tr>
							<tr id="hide">
								<th> کیفیتِ طالب علم :</th>
								<td>
									<select id="update_student_status" name="update_student_status" class="form-control" >
										<option value="1" <?= ($student_details->active==1)?'selected':null?>>فعال</option>
										<option value="0" <?= ($student_details->active==0)?'selected':null?>>غیر فعال</option>
									</select>
								</td>
								<th> کلاس کی تبدیلی :</th>
								<td>
									<select id="update_student_class" name="update_student_class" class="form-control">
										<?php foreach ($classes as $class):?>
											<option	<?= ($class->id==$student_details->class_id)?'selected':null ?> value="<?= $class->id?>"> <?=$class->class_name;?></option>
										<?php endforeach ?>
									</select>
								</td>
								<th> تصویر منتخب کریں :</th>
								<td>
									<div class="form-group">
										<input type="hidden" name="admission_number" value="<?= $student_details->admission_number ?>">
										<input class="col-9 btn btn-sm btn-success" type="file" name="student_picture">
									</div>
								</td>
								<td colspan="2">
									<button type="submit" id="update_status" name="update_status" class="btn btn-success"
											data-student_id="<?= $student_details->id?>">
										تبدیل کریں
									</button>
								</td>
								<td colspan="2">
									<button type="button" id="add_complaint" class="btn btn-danger add_complaint">
										<i class="fa fa-warning">&nbsp;</i>
										شکایت درج کرائیں
									</button>
								</td>
							</tr>
						</table>
					</form>
					<div class="col-12">
						<h2 class="text-center">شکایات</h2>
						<div class="card-box table-responsive">
							<table class="table table-striped table-bordered dark-border text-center">
								<?php if(!empty($complaints)){ ?>
								<thead class="thead-dark">
								<tr>
									<th>نمبر شمار</th>
									<th>شکایت</th>
									<th>شکایت کنندہ</th>
									<th id="hide"> عمل</th>
								</tr>
								</thead>
								<tbody id="listRecords">
								<?php
								$sn = 1;
								foreach ($complaints as $complaint): ?>
									<tr>
										<td><?= $sn++ ?></td>
										<td><?= $complaint->complaint ?></td>
										<td><?= $complaint->complaint_by ?></td>
										<td id="hide">
											<button type="button" class="btn bg-custom text-white edit_complaint"
													data-complaint_id="<?=$complaint->id?>"
													data-complaint="<?=$complaint->complaint?>"
													data-complaint_by="<?=$complaint->complaint_by?>"
													data-student_id="<?=$student_details->id?>">
												<i class="fa fa-edit"></i>
											</button>
											<?php if($this->group=='admin') {?>
											<button type="button" class="btn btn-danger delete_complaint"
													data-complaint_id="<?= $complaint->id?>"
													data-student_id="<?=$student_details->id?>"
													data-enroll_id="<?=$student_details->enroll_id?>"	>
												<i class="fa fa-remove"></i>
											</button>
											<?php } ?>
										</td>
									</tr>
								<?php endforeach; } else {
									echo '<p class="h3 text-center">کوئی شکایت نہیں ہے</p>';
								}?>
								</tbody>
							</table>
						</div>
					</div>
					<center>
						<button id="hide" class="col-1 btn btn-github" onclick="myFunction()">
							PRINT
							<i class="fa fa-print"></i>
						</button>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>
							<!--=========Complaint Modal==========-->

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-custom text-white">
				<h4 class="modal-title" id="ModalLabel">شکایت</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form" method="post" action="<?=site_url('Student/save_student_complaint')?>">
				<div class="modal-body">
					<label for="complaint">شکایت</label>
					<input type="text" id="complaint" name="complaint" class="form-control complaint" placeholder="شکایت درج کریں" tabindex="1">
					<p id="error_complaint" class="text-danger"></p>

					<label for='complaint_by'>شکایت کنندہ</label>
					<input type="text" id="complaint_by" name="complaint_by" class="form-control complaint_by" placeholder="شکایت کنندہ" tabindex="2">
					<p id="error_complaint_by" class="text-danger">
				</div>
				<div class="modal-footer pull-right">
					<button id="save" type="submit" class="btn btn-success">
						<i class="fa fa-save">&nbsp;</i>
						محفوظ کریں
					</button>
					<button id="update" type="submit" class="btn bg-custom text-white">
						<i class="fa fa-edit">&nbsp;</i>
						ترمیم کریں
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">بند کریں</button>
				</div>
				<input type="hidden" name="student_id" value="<?=$student_details->id?>">
			</form>
		</div>
	</div>
</div>
									<!-- Delete Complaint Modal-->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h4 class="modal-title" id="exampleModalLongTitle">شکایت حزف کریں؟</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-danger">
				<h5>کیا آپ اس شکایت کو واقعی حزف کرنا چاہتے ہیں؟</h5>
			</div>
			<div class="modal-footer pull-right">
				<a id="delete_complaint" class="btn btn-danger" href="" >
					<i class="fa fa-trash-o">&nbsp;</i>
					ہاں
				</a>
				<button class="btn btn-secondary" data-dismiss="modal">
					نہیں
				</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function myFunction() {
		window.print();
	}

	$('.add_complaint').click(function () {

		$('#ModalLabel').html('شکایت درج کریں');
		$('#save').show();
		$('#update').hide();

		$('#complaint').val('');
		$('#complaint_by').val('');

		$('#modal').modal('show');
	});

	$('.edit_complaint').click(function () {

		$('#ModalLabel').html('شکایت میں ترمیم کریں');
		$('#save').hide();
		$('#update').show();

		var student_id = $(this).data('student_id');

		var complaint = $(this).data('complaint');
		$('#complaint').val(complaint);

		var complaint_by = $(this).data('complaint_by');
		$('#complaint_by').val(complaint_by);

		var complaint_id = $(this).data('complaint_id');
		var url = '<?=site_url('Student/update_student_complaint/')?>'+complaint_id+'/'+student_id;
		$('#form').attr('action',url);

		$('#modal').modal('show');
	});

	$('.delete_complaint').click(function () {
		var complaint_id = $(this).data('complaint_id');
		var student_id = $(this).data('student_id');
		var enroll_id = $(this).data('enroll_id');
		var url = '<?=site_url('Student/delete_student_complaint/')?>'+complaint_id+'/'+student_id+'/'+enroll_id;
		$('#delete_complaint').attr('href',url);
		$('#delete_modal').modal('show');
	});

	$('#update_status').click(function () {
		var student_id = $(this).data('student_id');
		var url = '<?= site_url('Student/update_profile/')?>'+student_id;
		$('#update_profile_form').attr('action',url);
	});

	// $('#classes_active>a').addClass('active');
</script>
