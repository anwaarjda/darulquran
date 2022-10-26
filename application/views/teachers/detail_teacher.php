<style>
	.table td, .table th {
		border: 1px solid #0b0b0b;
		padding: 3px;
		vertical-align: middle;
	}

	.table th {
		font-size: 19px;
	}

	.table th.h3 {
		font-size: 25px;
	}

	.table td {
		text-align: center;
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
		.table-bordered.dark-border, .table-bordered.dark-border th,
		.table-bordered.dark-border td {
			border: 1px solid black !important;
			color: black;
			padding: 3px;
			vertical-align: middle;
			font-size: 19px;
			text-align: center;
		}

		.table tr th span {
			color :black;
		}

		.table th.h3 {
			font-size: 25px;
		}

		.table td p {
			margin-bottom: 0;
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
							<th colspan="12" class="h3 bg-custom text-white text-center p-2">
								<span class="align-middle">ممتحن کی تفصیل
									<a  id="hide" class="btn bg-light pull-left" target="_blank"
										href="<?php if (!empty($teacher_details->id))
										{ echo base_url('Teacher/edit_teacher/').$teacher_details->id;} ?>">
										<i class="fa fa-edit">&nbsp;</i>
									</a>
								</span>
							</th>
						</tr>
						<tr>
							<td colspan="2" rowspan="3">
								<?php
								if ($teacher_details->picture!=''){
									echo "<img style='width:125px; height:125px' class='border border-dark img-fluid' alt='user-image' src='".site_url('assets/images/teacher_pictures/').$teacher_details->picture."'>";
								} else {
									echo "<img style='width:125px; height:125px' class='border border-dark img-fluid' src='".site_url('assets/images/noimage.jpg')."'/>";
								}
								?>
							</td>
							<th>نام :</th>
							<td><?= $teacher_details->name ?></td>
							<th>ولدیت :</th>
							<td><?= $teacher_details->fathername ?></td>
							<th>جِنس :</th>
							<td><?=($teacher_details->gender=='female'?'عورت':'مرد')?></td>
							<th>کیفیت :</th>
							<td><?= ($teacher_details->active==1) ? '<p class="text-success">فعال</p>' :
									'<p class="text-danger">غیرفعال</p>'; ?>
							</td>
						</tr>
						<tr>
							<th>ای میل ایڈریس :</th>
							<td><?=$teacher_details->email?></td>
							<th> شناختی کارڈ نمبر :</th>
							<td><?=$teacher_details->cnic?></td>
							<th>قومیت :</th>
							<td colspan="3"><?=$teacher_details->qoumiat?></td>
						</tr>
						<tr>
							<th colspan="2">مکمل پتہ :</th>
							<td colspan="4"><?=$teacher_details->address?></td>
							<th>موبائل نمبر :</th>
							<td><?=$teacher_details->mobile?></td>
						</tr>
						<tr>
							<th>علاقہ :</th>
							<td><?=$teacher_details->elaqa?></td>
							<th>تاریخِ تقرری :</th>
							<td><?=$teacher_details->appointment_date?></td>
							<th>تاریخِ پیدائش :</th>
							<td><?=$teacher_details->dob?></td>
							<th>شادی شدہ/غیر شادی شدہ :</th>
							<td><?=($teacher_details->married==1?'شادی شدہ':'غیر شادی شدہ')?></td>
							<th>بچے :</th>
							<td><?= $teacher_details->no_of_child ?></td>
						</tr>
					</table>
					<form method="post" enctype="multipart/form-data" action="<?= base_url("Teacher/update_profile/$teacher_details->id")?>">
						<table class="table table-bordered dark-border col-md-12">
							<tr id="hide">
								<th colspan="12" class="h3 bg-custom text-white text-center p-2">ترتیبات</th>
							</tr>
							<tr id="hide">
								<th> کیفیتِ ممتحن :</th>
								<td>
									<select name="active" class="form-control" >
										<option value="1" <?= ($teacher_details->active==1)?'selected':null?>>فعال</option>
										<option value="0" <?= ($teacher_details->active==0)?'selected':null?>>غیر فعال</option>
									</select>
								</td>
								<th> تصویر منتخب کریں :</th>
								<td>
									<div>
										<input class="col-9 btn btn-sm btn-success" type="file" name="teacher_picture">
									</div>
								</td>
								<td colspan="2">
									<button type="submit" name="update_status" class="btn btn-success">
										تبدیل کریں
									</button>
								</td>
							</tr>
						</table>
					</form>
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

<script type="text/javascript">
	function myFunction() {
		window.print();
	}

	$('#teacher_active>a').addClass('active');
</script>
