<?php $age = date('Y') - date('Y',strtotime($student_details[0]->dob??null)); ?>
<style>
	.table td,.table th
	{
		border:1px solid #0b0b0b;
		padding: 3px;
	}
	.table td p
	{
		margin-bottom: 0px;
	}
	.table td
	{
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

		.content {
			/*margin-right: -10%;*/
			/*padding-left: -3%;*/
		}

		.table-responsive {
			border: 0;
			overflow-x: hidden;
		}

		.panel
		{
			border: 0;
		}

		.lbl {
			width: 100%;
			margin: 0 90% 0 0;
		}

		.heading {
			margin-left: 40px;
		}
	}
</style>
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="col-12">
				<div class="card-box table-responsive mt-2">
					<div class="row">
						<img src="<?=base_url('assets/images/logo.jpg')?>" alt="LOGO HERE" height="70" width="250" class="ml-auto">
					</div>

					<?php if(!empty($student_details[0]->ac_year) && $student_details[0]->ac_year==$_SESSION['ac_year']) {?>

						<table class="table table-bordered col-md-12">
						<tr>
							<td colspan="1">
								<?php
								$img = APPPATH.'..\assets\images\student_pictures\\'.$student_details[0]->ac_year.'-'.$student_details[0]->admission_number.'.jpg';

								if(file_exists($img))
								{
									echo "<img src='".base_url('assets/images/student_pictures/').$student_details[0]->ac_year.'-'.$student_details[0]->admission_number.'.jpg'."' width=100px;/>";
								}
								else
								{
									echo '<img src="'.base_url('assets/images/noimage.jpg').'" width=100px;/>';
								}
								?>
							</td>
						</tr>
						<tr class="text-center">
							<th class="text-center " colspan="5">
								داخلہ نمبر
								: (<?=$student_details[0]->admission_number?>)
							</th>
							<th class="text-center" colspan="7">
								سال
								: (<?=$student_details[0]->ac_year?>)
							</th>
						</tr>

						<tr>
							<th colspan="12" style="text-align: center" class="h3 bg-info" >طالب علم کی تفصیل</th>
						</tr>

						<tr>
							<th> نام :</th>
							<td><?=$student_details[0]->name?></td>
							<th> ولدیت :</th>
							<td><?=$student_details[0]->father_name?></td>
							<th> تاریخِ پیدائش :</th>
							<td><?=date('d-m-Y',strtotime($student_details[0]->dob));?><?=" (عمر $age سال) "?></td>
							<th> مقامِ پیدائش :</th>
							<td><?=$student_details[0]->birthplace?></td>
						</tr>
						<tr>
							<th> ضلع :</th>
							<td><?=$student_details[0]->district?></td>
							<th> صوبہ :</th>
							<td><?=$student_details[0]->province?></td>
							<th> مُلک :</th>
							<td><?=$student_details[0]->country?></td>
							<th>طالب علم کا شناختی کارڈ نمبر/ب فارم :</th>
							<td><?=$student_details[0]->cnic?></td>
						</tr>
						<tr>
							<th> مکمل پتہ :</th>
							<td colspan="5"><?=$student_details[0]->address?></td>
							<th> فون :</th>
							<td><?=$student_details[0]->phone?></td>
						</tr>
						<tr>
							<th> طالب علم کا پاسپورٹ نمبر :</th>
							<td colspan="5"><?=$student_details[0]->passport?></td>
							<th> والد کا شناختی کارڈ نمبر :</th>
							<td><?=$student_details[0]->father_cnic?></td>
						</tr>
						<tr>
							<th> کلاس نمبر :</th>
							<td><?=$student_details[0]->class_no?></td>
							<th> کلاس کا نام :</th>
							<td><?=$student_details[0]->class_name?></td>
							<th> سیکشن :</th>
							<td><?=$student_details[0]->ac_year?></td>
							<th> کیفیت :</th>
							<td><?= ($student_details[0]->active == 1)?'<p class="text-success">فعال</p>':'<p class="text-danger">غیرفعال</p>';?>
							</td>
						</tr>
					</table>

					<table class="table table-bordered col-md-12">

						<tr>
							<th colspan="12" style="text-align: center" class="h3 bg-info" >سرپرست کی تفصیل</th>
						</tr>

						<tr>
							<th> نامِ سرپرست :</th>
							<td><?=$student_details[0]->guardian?></td>
							<th> ولدیت سرپرست :</th>
							<td><?=$student_details[0]->guardian_father_name?></td>
							<th> رشتہ :</th>
							<td><?=$student_details[0]->guardian_relation?></td>
							<th> پیشہ سرپرست :</th>
							<td><?=$student_details[0]->guardian_profession?></td>
						</tr>
						<tr>
							<th> مکمل پتہ :</th>
							<td colspan="3"><?=$student_details[0]->guardian_address?></td>
							<th> فون نمبر :</th>
							<td><?=$student_details[0]->guardian_phone?></td>
							<th> سرپرست کا شناختی کارڈ نمبر :</th>
							<td><?=$student_details[0]->guardian_cnic?></td>
						</tr>
					</table>

					<table class="table table-bordered col-md-12">
						<tr>
							<th colspan="12" style="text-align: center" class="h3 bg-info" >واقف کار کی تفصیل</th>
						</tr>
						<tr>
							<th> کراچی میں کسی قریب ترین واقف کار کانام :</th>
							<td><?=$student_details[0]->knownperson?></td>
							<th> مکمل پتہ :</th>
							<td><?=$student_details[0]->guardian_profession?></td>
							<th> فون نمبر :</th>
							<td><?=$student_details[0]->knownperson_phone?></td>
						</tr>
						<tr>
							<th>آخری درسگاہ کانام مع مختصر پتہ جہاں تعلیم پائی :</th>
							<td colspan="2"><?=$student_details[0]->last_darsgah?></td>
							<th>آخری درسگاہ چھوڑنے کا سبب واضح الفاظ میں :</th>
							<td colspan='2'><?=$student_details[0]->leave_reason?></td>
						</tr>
						<tr>
							<th>دیگر درسگاہوں کے نام مع مختصر پتےجہاں تعلیم پائی :</th>
							<td colspan='2'><?=$student_details[0]->prev_darsgah?></td>
							<th>سابقہ حاصل شدہ تعلیم :</th>
							<td colspan='2'><?=$student_details[0]->prev_education?></td>
						</tr>
					</table>

					<center>
						<button id="hide" class="col-1 btn btn-light" onclick="myFunction()">
							Print
							<i class="fa fa-print"></i>
						</button>
					</center>
					<?php }else{ ?>
					<table class="table table-bordered col-md-12">
						<tr class="text-center">
							<th class="text-center m-b-30" colspan="12">
								طالب علم موجودہ سال میں نہیں ہے
							</th>
						</tr>
					</table>
						<script>
							$(document).ready( function () {
								$('.footer').hide();
							});
						</script>
					<?php  } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function myFunction() {
		window.print();
	}
</script>
