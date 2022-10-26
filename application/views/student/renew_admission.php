<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<h2 class="header-title text-center" style="font-size: 26px;">
							درخواست براۓ داخلہ طالبعلم جدید/قدیم
						</h2>
					</div>
				</div>
			</div>
			<form id="hide" method="post" action="<?=site_url('Renew/get_student_by_admission_number') ?>" style="display: none">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-2">
							<label for="old_admission_number"> قدیم داخلہ نمبر</label>
							<input type="text" name="old_admission_number" class="form-control"
								   placeholder="قدیم داخلہ نمبر" maxlength="4" autofocus required />
						</div>
						<div class="col-md-1 m-t-30">
							<button type="submit" class="btn btn-primary mt-2 ml-4 next" style="font-size: larger">
								 فارم &nbsp;&nbsp;
							</button>
						</div>
					</div>
				</div>
			</form>
			<?php if(!empty($old_student)){ ?>

			<form id="form" method="post" enctype="multipart/form-data" action="<?=site_url("Renew/renew_admission/$old_student->id")?>">

				<div class="col-md-3 m-auto">
					<div class="form-group">
						<label for="required_class">مطلوبہ شعبہ اوردرجہ برائے تعلیم</label>
						<select id='required_class' name='required_class' class="form-control selected_class select2" required tabindex="1">
							<option value="">کلاس منتخب کریں</option>
							<?php foreach ($classes as $class):?>
								<option	<?=($class->id==$old_student->class_id)?'selected':null?> value="<?=$class->id?>"><?=$class->class_name;?></option>
							<?php endforeach ?>
						</select>
						<span class="text-danger" style="float: right"><p id="required_class_error"></p></span>
					</div>
				</div>
				<div class="row">
					<span class="mb-2">
						<?php
						$img = APPPATH.'..\assets\images\student_pictures\\'.$old_student->ac_year.'-'.$old_student->admission_number.'.jpg';

						if(file_exists($img))
						{
							echo "<img class='border border-dark' src='".base_url('assets/images/student_pictures/').$old_student->ac_year.'-'.$old_student->admission_number.'.jpg'."' width=120px; height=120px;/>";
						}
						else
						{
							echo '<img class="border border-dark" src="'.base_url("/assets/images/noimage.jpg").'" height=120px; width=120px;/>';
						}
						?>
					</span>

					<div class="mt-4" style="width: 9%;padding-right: 10px;padding-left: 10px;">
						<div class="form-group">
							<label for="old_admission_number">قدیم داخلہ نمبر</label>
							<input type="text" class="form-control" name="old_admission_number" value="<?=substr("0000{$old_student->admission_number}", -4);?>"  placeholder="قدیم داخلہ نمبر" maxlength="4" readonly />
						</div>
					</div>

					<div class="col-md-1 mt-4">
						<div class="form-group">
							<label for="admission_number">داخلہ نمبر</label>
							<input type="text" class="form-control admission_number" name="admission_number" value="" placeholder="داخلہ نمبر" maxlength="4" tabindex="1" autofocus />
							<span class="text-danger pull-right" style="width: 132px"><p id="admission_number_error"></p></span>
						</div>
					</div>

					<div class="mt-4 col-md-1">
						<div class="form-group">
							<label for="admission_type">قدیم/جدید</label>
							<select type="text" id="admission_type" name="admission_type" class="form-control" tabindex="2" >
								<option value="new" <?=($old_student->admission_type=='new'?'selected':null)?>>جدید</option>
								<option value="old" <?=($old_student->admission_type=='old'?'selected':null)?>>قدیم</option>
							</select>
						</div>
					</div>

					<div class="mt-4 col-md-1">
						<div class="form-group">
							<label for="fees_type">فیس کی قسم</label>
							<select id="fees_type" name="fees_type" class="form-control" tabindex="3">
								<option value='1' <?=($old_student->fees_type==1?'selected':null)?>>مکمل</option>
								<option value='0' <?=($old_student->fees_type==0?'selected':null)?>>نصف</option>
							</select>
							<span class="text-danger pull-right"><p id="fees_type_error"></p></span>
						</div>
					</div>

					<div class="mt-4" style="padding-right: 10px;padding-left: 10px;">
						<div class="form-group">
							<label style="width: 100%" for="resident">رہائش</label>
							<select style="width: 100%" type="text" id="resident" name="resident" class="form-control" tabindex="4">
								<option <?=($old_student->resident=='اقامتی'?'selected':null)?>>اقامتی</option>
								<option <?=($old_student->resident=='غیر اقامتی'?'selected':null)?>>غیر اقامتی</option>
							</select>
							<span class="text-danger pull-right"><p id="resident_error"></p></span>
						</div>
					</div>

					<div class="mt-4" style="padding-right: 10px;padding-left: 10px;">
						<div class="form-group">
							<label for="date">بابت ماہ</label>
							<input type="date" id="date" name="date" class="form-control" value="<?=$old_student->date?>" tabindex="5" />
							<span class="text-danger" style="float: right"><p id="date"></p></span>
						</div>
					</div>

					<div class="col-md-2 mt-4">
						<label class="control-label" for="date_hijri" >بمطابق </label>
						<input type="text" id="date_hijri" name="date_hijri" class="form-control" value="<?=$old_student->date_hijri?>" readonly />
					</div>

						<div class="col-md-2 mt-4">
							<div class="form-group">
								<label for='active'>کیفیت</label>
								<select id='active' name='active' class="form-control active" tabindex="6">
									<option <?=($old_student->active==1?'selected':null)?> value='1'>فعال</option>
									<option <?=($old_student->active==0?'selected':null)?> value='0'>غیر فعال</option>
								</select>
							</div>
						</div>

						<div class="col-md-2 mt-4">
							<div class="form-group">
								<label for="student_picture">تصویرمنتخب کریں</label>
								<input type="file" name="student_picture" class="col-12 btn btn-success" value="" tabindex="7" />
							</div>
						</div>
					</div>
					<button type="submit" id="save" name="save" class="btn btn-success text-white" data-student_id="<?=$old_student->id?>" tabindex="8">
						<span class="fa fa-save"></span>
						محفوظ کریں
					</button>
											<!--student information-->

					<div class="row">
						<div class="col-12" style="padding: 10px;">
							<div class="card-box">
								<h3 class="text-center">طالب علم کی معلومات</h3>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="name">نامِ طالب علم</label>
								<input type="text" id="name" name="name" value="<?= $old_student->name?>" placeholder="نام" class="form-control" readonly>
								<span class="text-danger" style="float: right"><p id="name_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="father_name">ولدیت</label>
								<input type="text" id="father_name" name="father_name" value="<?= $old_student->father_name?>" placeholder="ولدیت" class="form-control" readonly>
								<span class="text-danger" style="float: right"><p id="father_name_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="dob">تاریخِ پیدائش</label>
								<input type="date" id="dob" name="dob" value="<?= $old_student->dob ?>" placeholder="عمر طالب علم" class="form-control" readonly>
								<span class="text-danger" style="float: right"><p id="dob_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="birthplace">مقام پیدائش</label>
								<input type="text" id="birthplace" name="birthplace" value="<?= $old_student->birthplace ?>" placeholder="مقام پیدائش" class="form-control" readonly>
								<span class="text-danger" style="float: right"><p id="birthplace_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="district">ضلع</label>
								<input type="text" id="district" name="district" value="<?= $old_student->district ?>" placeholder="ضلع" class="form-control" readonly>
								<span class="text-danger" style="float: right"><p id="district_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="area">علاقہ</label>
								<select id="area" name="area" class="form-control" readonly>
									<option <?=($old_student->area=='کورنگی'?'selected':null)?>>کورنگی</option>
									<option <?=($old_student->area=='ملیر'?'selected':null)?>>ملیر</option>
									<option <?=($old_student->area=='ائیرپورٹ'?'selected':null)?>>ائیرپورٹ</option>
									<option <?=($old_student->area=='لانڈھی'?'selected':null)?>>لانڈھی</option>
								</select>
								<span class="text-danger pull-right"><p id="area_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="province">صوبہ</label>
								<select id="province" name="province" class="form-control" readonly>
									<option	<?=($old_student->province=='سندھ'?'selected':null)?>>سندھ</option>
									<option	<?=($old_student->province=='پنجاب'?'selected':null)?>>پنجاب</option>
									<option <?=($old_student->province=='بلوچستان'?'selected':null)?>>بلوچستان</option>
									<option <?=($old_student->province=='خیبر پختونخواں'?'selected':null)?>>خیبر پختونخواں</option>
									<option <?=($old_student->province=='گِلگت بلتستان'?'selected':null)?>>گِلگت بلتستان</option>
									<option <?=($old_student->province=='فاٹا'?'selected':null)?>>فاٹا</option>
								</select>
								<span class="text-danger" style="float: right"><p id="province_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="country">ملک</label>
								<input type="text" id="country" name="country" value="<?= $old_student->country ?>" placeholder="ملک" class="form-control" readonly>
								<span class="text-danger" style="float: right"><p id="country_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="cnic">شناختی کارڈ نمبر/ب فارم</label>
								<input type="text" id="cnic" name="cnic" value="<?= $old_student->cnic ?>" placeholder="شناختی کارڈ نمبر" class="form-control" data-inputmask="'mask':'99999-9999999-9'" readonly>
								<span class="text-danger" style="float: right"><p id="cnic_error"></p></span>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="address">مکمل پتہ</label>
								<input type="text" id="address" name="address"  value="<?= trim($old_student->address, " \x09\t") ?>" placeholder="مکمل پتہ" class="form-control" readonly>
								<span class="text-danger" style="float: right"><p id="address_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="phone">فون نمبر</label>
								<input type="text" id="phone" name="phone" value="<?= $old_student->phone ?>" placeholder="فون نمبر" class="form-control" data-inputmask="'mask': '9999-9999999'" readonly>
								<span class="text-danger" style="float: right"><p id="phone_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="passport">طالب علم کاپاسپورٹ نمبر</label>
								<input type="text" id="passport" name="passport" value="<?= $old_student->passport ?>" placeholder="پاسپورٹ نمبر" class="form-control" readonly>
								<span class="text-danger" style="float: right"><p id="passport_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="father_cnic">والد کا شناختی کارڈ نمبر</label>
								<input type="text" id="father_cnic" name="father_cnic" value="<?= $old_student->father_cnic ?>" placeholder="والد کا شناختی کارڈ نمبر" class="form-control" data-inputmask="'mask':'99999-9999999-9'" readonly>
								<span class="text-danger" style="float: right"><p id="father_cnic_error"></p></span>
							</div>
						</div>
					</div>
			</form>
			<?php } else {
					echo '<script>$("#hide").show();</script>';
				}?>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {

		$("#date").change(function () {
			var date = $('#date').val();
			$.ajax({
				type:"GET",
				url:'<?=site_url('Calendar/get_date/')?>'+date,
				success:function(response){
					var data = $.parseJSON(response);
					$('#date_hijri').val(data.date);
				}
			});
		});

	// =============	Prevent submit form on ENTER and focus next box

		$('form date,select,input:not([type="submit"])').keydown(function(e) {
			if (e.keyCode == 13) {
				var inputs = $(this).parents('form').eq(0).find(':input');
				if (inputs[inputs.index(this) + 1] != null) {
					inputs[inputs.index(this) + 1].focus();
				}
				e.preventDefault();
			}
		});

		$('.admission_number').change(function(e) {
			var admission_number = $(this).val();
			if(admission_number) {
				$.ajax({
					url: '<?=site_url('Student/check_admission_number/')?>'+admission_number,
					type: 'POST',
					success:function(data) {
						var dt = $.parseJSON(data);
						var adm_num = Number(dt);
						if(adm_num==admission_number){
							$('#admission_number_error').html('داخلہ نمبر پہلے سے موجود ہے');
							$('#admission_number_error').show();
							$('#form').submit(function(e){
								e.preventDefault();
							});
						}
						else
						{
							$('#admission_number_error').hide();
							$('#admission_number_error').html('');
							$('#form').unbind(e.preventDefault());
						}
					}
				});
			}
		});

		$('#save').click(function (e){

			e.preventDefault();
			var error=0;
			if($('#admission_number').val()=="")
			{
				error=1;
				$('#admission_number_error').html('داخلہ نمبر درج کریں');
			}
			if (error==0){
				$('#form').submit();
			}
		});

		$('#student_active>a').addClass('active');

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
		$('#dob').attr("max", today);
	});

</script>
