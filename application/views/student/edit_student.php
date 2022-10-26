<style>
	.bg-custom {
		font-size: larger;
	}

	.form-control {
		border: 1px solid #aaaaaa;
	}

	.form-group > span > p {
		font-size: 25px;
	}
</style>
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<form method="post" id="edit_form" enctype="multipart/form-data"
				  action="<?= site_url('Student/update_student') ?>">

				<div class="row">
					<div class="col-12">
						<div class="card-box">
							<h2 class="text-center">
								<b>تصحیح</b> براۓ داخلہ طالبعلم جدید/قدیم
							</h2>
						</div>
					</div>
				</div>

				<?php if (!empty($st[0]->ac_year) && $st[0]->ac_year == $this->session->ac_year) { ?>

				<div class="row">
					<div class="col-md-3 m-auto">
						<div class="form-group">
							<label for="required_class">مطلوبہ شعبہ اوردرجہ برائے تعلیم</label>
							<select id="required_class" name="required_class"
									class="form-control selected_class select2" required tabindex="27">
								<option>کلاس منتخب کریں</option>
								<?php foreach ($classes as $class): ?>
									<option <?= ($class->id == $st[0]->class_id) ? 'selected' : null ?>
											value="<?= $class->id ?>"><?= $class->class_name; ?></option>
								<?php endforeach ?>
							</select>
							<span class="text-danger" style="float: right;display: inline"><p
										id="required_class_error"></p></span>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<div class="card-box p-1 bg-custom text-white text-center">
							<h3>طالب علم کی معلومات</h3>
						</div>
					</div>
				</div>
				<!--student information-->

				<div class="row">
					<span class="mb-2" style="margin-right: 10%">
					<?php
					$img = APPPATH.'..\assets\images\student_pictures\\'.$st[0]->ac_year.'-'.$st[0]->admission_number.'.jpg';

					if(file_exists($img)) {
						echo "<img class='border border-dark' src='".base_url('assets/images/student_pictures/').$st[0]->ac_year.'-'.$st[0]->admission_number.'.jpg'."' width=120px; height=120px;/>";
					} else {
						echo '<img class="border border-dark" src="'.base_url("/assets/images/noimage.jpg").'" height=120px; width=120px;/>';
					}
					?>
				</span>
				</div>
				<div class="row">
					<div class="mt-4" style="width: 7%;padding-right: 10px">
						<label for="admission_number">جی آر نمبر:</label>
						<span><?= $st[0]->gr_number ?></span>
					</div>
					<div class="mt-4" style="width: 7%;padding-right: 10px">
						<div class="form-group">
							<label for="admission_number"> داخلہ نمبر</label>
							<input type="text" class="form-control" id="admission_number" name="admission_number"
								   value="<?= substr("0000{$st[0]->admission_number}", -4); ?>" placeholder="داخلہ نمبر"
								   maxlength="4" tabindex="1" autofocus>
							<p id="admission_number_error" class="text-danger" style="float: right;width: 132px"></p>
						</div>
					</div>

					<div class="mt-4" style="width: 9%;padding-right: 10px;padding-left: 10px;">
						<div class="form-group">
							<label for="old_admission_number">قدیم داخلہ نمبر</label>
							<input type="text" class="form-control" id="old_admission_number"
								   name="old_admission_number"
								   value="<?= substr("0000{$st[0]->old_admission_number}", -4); ?>" maxlength="4"
								   placeholder="قدیم داخلہ نمبر" tabindex="2">
						</div>
					</div>

					<div class="mt-4 col-md-1">
						<div class="form-group">
							<label for="admission_type">قدیم/جدید</label>
							<select type="text" id="admission_type" name="admission_type" class="form-control"
									tabindex="3">
								<option value="new" <?= ($st[0]->admission_type == 'new' ? 'selected' : null) ?>>جدید
								</option>
								<option value="old" <?= ($st[0]->admission_type == 'old' ? 'selected' : null) ?>>قدیم
								</option>
							</select>
						</div>
					</div>

					<div class="mt-4 col-md-1">
						<div class="form-group">
							<label for="fees_type">فیس کی قسم</label>
							<select id="fees_type" name="fees_type" class="form-control" tabindex="4">
								<option value='1' <?= ($st[0]->fees_type == 1 ? 'selected' : null) ?>>مکمل</option>
								<option value='0' <?= ($st[0]->fees_type == 0 ? 'selected' : null) ?>>نصف</option>
							</select>
							<span class="text-danger pull-right"><p id="fees_type_error"></p></span>
						</div>
					</div>

					<div class="mt-4 col-md-4">
						<label class="control-label" for="inputSuccess">کیفیت </label>
						<input type="text" id="remarks" name="remarks" placeholder="کیفیت" class="form-control" 
							   tabindex="5" value="<?= $st[0]->remarks ?>" <?= $st[0]->fees_type == 1 ? 'readonly' : null ?>>
					</div>

					<div class="mt-4" style="padding-right: 10px;padding-left: 10px;">
						<div class="form-group">
							<label style="width: 100%" for="resident">رہائش</label>
							<select style="width: 100%" type="text" id="resident" name="resident" class="form-control"
									tabindex="6">
								<option <?= ($st[0]->resident == 'اقامتی' ? 'selected' : null) ?>>اقامتی</option>
								<option <?= ($st[0]->resident == 'غیر اقامتی' ? 'selected' : null) ?>>غیر اقامتی
								</option>
							</select>
							<span class="text-danger pull-right"><p id="resident_error"></p></span>
						</div>
					</div>

					<div class="mt-4" style="padding-right: 10px;padding-left: 10px;">
						<div class="form-group">
							<label for="date">بابت ماہ</label>
							<input type="date" id="date" name="date" class="form-control" value="<?= $st[0]->date ?>"
								   tabindex="7" autofocus>
							<input type="hidden" id="date_hijri" name="date_hijri" class="form-control"
								   value="<?= $st[0]->date_hijri ?>">
							<span class="text-success date_hijri">بمطابق <?= $st[0]->date_hijri ?></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="name">نامِ طالب علم</label>
							<input type="text" id="name" name="name" value="<?= $st[0]->name ?>" placeholder="نام"
								   class="form-control" tabindex="7">
							<span class="text-danger" style="float: right"><p id="name_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="cnic">شناختی کارڈ نمبر/ب فارم</label>
							<input type="text" id="cnic" name="cnic" value="<?= $st[0]->cnic ?>"
								   placeholder="شناختی کارڈ نمبر" class="form-control" tabindex="8"
								   data-inputmask="'mask':'99999-9999999-9'">
							<span class="text-danger" style="float: right"><p id="cnic_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="father_name">ولدیت</label>
							<input type="text" id="father_name" name="father_name" value="<?= $st[0]->father_name ?>"
								   placeholder="ولدیت" class="form-control" tabindex="9">
							<span class="text-danger" style="float: right"><p id="father_name_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="father_cnic">والد کا شناختی کارڈ نمبر</label>
							<input type="text" id="father_cnic" name="father_cnic" value="<?= $st[0]->father_cnic ?>"
								   placeholder="والد کا شناختی کارڈ نمبر" class="form-control" tabindex="10"
								   data-inputmask="'mask':'99999-9999999-9'">
							<span class="text-danger" style="float: right"><p id="father_cnic_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="dob">تاریخِ پیدائش</label>
							<input type="date" id="dob" name="dob" value="<?= $st[0]->dob ?>" placeholder="عمر طالب علم"
								   class="form-control" tabindex="11">
							<span class="text-danger" style="float: right"><p id="dob_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="birthplace">مقام پیدائش</label>
							<input type="text" id="birthplace" name="birthplace" value="<?= $st[0]->birthplace ?>"
								   placeholder="مقام پیدائش" class="form-control" tabindex="12">
							<span class="text-danger" style="float: right"><p id="birthplace_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="district">ضلع</label>
							<input type="text" id="district" name="district" value="<?= $st[0]->district ?>"
								   placeholder="ضلع" class="form-control" tabindex="13">
							<span class="text-danger" style="float: right"><p id="district_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="area">علاقہ</label>
							<select id="area" name="area" class="form-control select2" tabindex="13">
								<?php foreach ($areas as $area): ?>
									<option <?= ($area->id == $st[0]->area_id) ? 'selected' : null ?>
											value="<?= $area->id ?>"><?= $area->area; ?></option>
								<?php endforeach ?>
							</select>
							<span class="text-danger pull-right"><p id="area_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="province">صوبہ</label>
							<select id="province" name="province" class="form-control select2" tabindex="14">
								<option <?= ($st[0]->province == 'سندھ' ? 'selected' : null) ?>>سندھ</option>
								<option <?= ($st[0]->province == 'پنجاب' ? 'selected' : null) ?>>پنجاب</option>
								<option <?= ($st[0]->province == 'بلوچستان' ? 'selected' : null) ?>>بلوچستان</option>
								<option <?= ($st[0]->province == 'خیبر پختونخواں' ? 'selected' : null) ?>>خیبر
									پختونخواں
								</option>
								<option <?= ($st[0]->province == 'گِلگت بلتستان' ? 'selected' : null) ?>>گِلگت بلتستان
								</option>
								<option <?= ($st[0]->province == 'فاٹا' ? 'selected' : null) ?>>فاٹا</option>
								<option <?= ($st[0]->province == 'غیر ملکی' ? 'selected' : null) ?>>غیر ملکی</option>
							</select>
							<span class="text-danger" style="float: right"><p id="province_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="country">ملک</label>
							<input type="text" id="country" name="country" value="<?= $st[0]->country ?>"
								   placeholder="ملک" class="form-control" tabindex="15">
							<span class="text-danger" style="float: right"><p id="country_error"></p></span>
						</div>
					</div>



					<div class="col-md-6">
						<div class="form-group">
							<label for="address">مکمل پتہ</label>
							<input type="text" id="address" name="address"
								   value="<?= trim($st[0]->address, " \x09\t") ?>" placeholder="مکمل پتہ"
								   class="form-control" tabindex="16">
							<span class="text-danger" style="float: right"><p id="address_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="phone">فون نمبر</label>
							<input type="text" id="phone" name="phone" value="<?= $st[0]->phone ?>"
								   placeholder="فون نمبر" class="form-control" tabindex="17"
								   data-inputmask="'mask': '9999-9999999'">
							<span class="text-danger" style="float: right"><p id="phone_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="passport">طالب علم کاپاسپورٹ نمبر</label>
							<input type="text" id="passport" name="passport" value="<?= $st[0]->passport ?>"
								   placeholder="پاسپورٹ نمبر" class="form-control" tabindex="18">
							<span class="text-danger" style="float: right"><p id="passport_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for='active'>کیفیت</label>
							<select id='active' name='active' class="form-control active" tabindex="20">
								<option <?= ($st[0]->active == 1 ? 'selected' : null) ?> value='1'>فعال</option>
								<option <?= ($st[0]->active == 0 ? 'selected' : null) ?> value='0'>غیر فعال</option>
							</select>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="student_picture">تصویرمنتخب کریں</label>
							<input type="file" name="student_picture" class="col-12 btn btn-sm btn-success" value=""
								   tabindex="21">
						</div>
					</div>
				</div>
				<!--guardian information-->
				<div class="row">
					<div class="col-12">
						<div class="card-box p-1 bg-custom text-white text-center">
							<h3>سرپرست کی معلومات</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="guardian_relation">رشتہ</label>
							<input name="guardian_relation" list="guardian_relation" class="form-control"
								   value="<?= $st[0]->guardian_relation ?>" tabindex="24">
							<datalist id="guardian_relation">
								<option>والد</option>
								<option>والدہ</option>
								<option>نانا</option>
								<option>بھائی</option>
								<option>چچا</option>
								<option>ماموں</option>
								<option>دادہ</option>
							</datalist>
							<span class="text-danger" style="float: right"><p id="guardian_relation_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="guardian">نام سرپرست </label>
							<input type="text" id="guardian" name="guardian" value="<?= $st[0]->guardian ?>"
								   placeholder="سرپرست کا نام" class="form-control" tabindex="22">
							<span class="text-danger" style="float: right"><p id="guardian_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="guardian_father_name">ولدیت سرپرست </label>
							<input type="text" id="guardian_father_name" name="guardian_father_name"
								   value="<?= $st[0]->guardian_father_name ?>" placeholder="ولدیت سرپرست "
								   class="form-control" tabindex="23">
							<span class="text-danger" style="float: right"><p
										id="guardian_father_name_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="guardian_profession">پیشہ سرپرست</label>
							<input type="text" id="guardian_profession" name="guardian_profession"
								   value="<?= $st[0]->guardian_profession ?>" placeholder="پیشہ سرپرست"
								   class="form-control" tabindex="25">
							<span class="text-danger" style="float: right"><p id="guardian_profession_error"></p></span>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="guardian_address">مکمل پتہ</label>
							<input type="text" id="guardian_address" name="guardian_address" class="form-control"
								   value="<?= trim($st[0]->guardian_address) ?>" placeholder="مکمل پتہ" tabindex="26">
							<span class="text-danger" style="float: right"><p id="guardian_address_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="guardian_phone">فون نمبر</label>
							<input type="text" id="guardian_phone" name="guardian_phone"
								   value="<?= $st[0]->guardian_phone ?>" placeholder="فون نمبر"
								   class="form-control mobile" tabindex="27" data-inputmask="'mask': '9999-9999999'">
							<span class="text-danger" style="float: right"><p id="guardian_phone_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="guardian_phone_2">فون نمبر 2 </label>
							<input type="text" id="guardian_phone_2" name="guardian_phone_2"
								   value="<?= $st[0]->guardian_phone_2 ?>" placeholder="فون نمبر"
								   class="form-control mobile" data-inputmask="'mask': '9999-9999999'" tabindex="28">
							<span class="text-danger" style="float: right"><p id="guardian_phone_error_2"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="guardian_cnic">سرپرست کا شناختی کارڈ نمبر</label>
							<input type="text" id="guardian_cnic" name="guardian_cnic"
								   value="<?= $st[0]->guardian_cnic ?>" class="form-control"
								   placeholder="قومی شناختی کارڈ نمبر" tabindex="28"
								   data-inputmask="'mask': '99999-9999999-9'">
							<span class="text-danger" style="float: right"><p id="guardian_cnic_error"></p></span>
						</div>
					</div>
				</div>
				<!--knownperson information-->
				<div class="row">
					<div class="col-12">
						<div class="card-box p-1 bg-custom text-white text-center">
							<h3>واقفیّت</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="knownperson">کراچی میں کسی قریب ترین واقف کار کا نام</label>
							<input type="text" id="knownperson" name="knownperson" value="<?= $st[0]->knownperson ?>"
								   placeholder="واقف کار کا نام" class="form-control" tabindex="29">
							<span class="text-danger" style="float: right"><p id="knownperson_error"></p></span>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="knownperson_address">مکمل پتہ</label>
							<input id="knownperson_address" name="knownperson_address"
								   value="<?= trim($st[0]->guardian_address) ?>" class="form-control"
								   placeholder="مکمل پتہ" tabindex="30">
							<span class="text-danger" style="float: right"><p id="knownperson_address_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="knownperson_phone">فون نمبر</label>
							<input type="text" id="knownperson_phone" name="knownperson_phone"
								   value="<?= $st[0]->knownperson_phone ?>" class="form-control" placeholder="فون نمبر"
								   tabindex="31" data-inputmask="'mask':'9999-9999999'">
							<span class="text-danger" style="float: right"><p id="knownperson_phone_error"></p></span>
						</div>
					</div>

					<div class="card-box col-md-12 p-1 bg-custom text-white text-center">
						<h3>سابقہ تعلیم</h3>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="last_darsgah">آخری درسگاہ کانام مع مختصر پتہ جہاں تعلیم پائی</label>
							<input type="text" id="last_darsgah" name="last_darsgah" value="<?= $st[0]->last_darsgah ?>"
								   class="form-control" placeholder=" درسگاہ" tabindex="32">
							<span class="text-danger" style="float: right"><p id="last_darsgah_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="leave_reason">آخری درسگاہ چھوڑنے کا سبب واضح الفاظ میں</label>
							<input type="text" id="leave_reason" name="leave_reason" value="<?= $st[0]->leave_reason ?>"
								   class="form-control" placeholder=" سبب " tabindex="33">
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="prev_darsgah">دیگر درسگاہوں کے نام مع مختصر پتے جہاں تعلیم پائی</label>
							<input type="text" id="prev_darsgah" name="prev_darsgah" value="<?= $st[0]->prev_darsgah ?>"
								   class="form-control" placeholder="دیگر درسگاہ" tabindex="34">
							<span class="text-danger" style="float: right"><p id="prev_darsgah_error"></p></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="prev_education">سابقہ حاصل شدہ تعلیم</label>
							<input type="text" id="prev_education" name="prev_education"
								   value="<?= $st[0]->prev_education ?>" class="form-control" placeholder=" تعلیم"
								   tabindex="35">
							<span class="text-danger" style="float: right"><p id="prev_education_error"></p></span>
						</div>
					</div>
				</div>

				<!-----------	guarantors	------------->
				<div class="row">
					<div class="col-12">
						<div class="card-box p-1 bg-custom text-white text-center">
							<h3>ضامن</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="guarantor">میں مسمی</label>
							<input type="text" id="guarantor" name="guarantor" value="<?= $st[0]->guarantor ?>"
								   class="form-control" tabindex="36">
							<span class="text-danger" style="float: right"><p id="guarantor_error"></p></span>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="guarantor_fathername">ولد</label>
							<input type="text" id="guarantor_father_name" name="guarantor_father_name"
								   class="form-control" value="<?= $st[0]->guarantor_father_name ?>" tabindex="37">
							<span class="text-danger" style="float: right"><p
										id="guarantor_father_name_error"></p></span>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="guarantor_country">وطن اصلی</label>
							<input type="text" id="guarantor_country" name="guarantor_country" class="form-control"
								   value="<?= $st[0]->guarantor_country ?>" tabindex="38">
							<span class="text-danger" style="float: right"><p id="guarantor_country_error"></p></span>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="guarantor_address">ساکن حال</label>
							<input type="text" id="guarantor_address" name="guarantor_address" class="form-control"
								   value="<?= $st[0]->guarantor_address ?>" tabindex="39">
							<span class="text-danger" style="float: right"><p id="guarantor_address_error"></p></span>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="guarantor_cnic">قومی شناختی کارڈ نمبر</label>
							<input type="text" id="guarantor_cnic" name="guarantor_cnic" class="form-control"
								   value="<?= $st[0]->guarantor_cnic ?>" tabindex="40"
								   data-inputmask="'mask': '99999-9999999-9'">
							<span class="text-danger" style="float: right"><p id="guarantor_cnic_error"></p></span>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="known_from">عرصۂ واقفیت</label>
							<input type="text" id="known_from" name="known_from" class="form-control"
								   value="<?= $st[0]->known_from ?>" tabindex="41">
							<span class="text-danger" style="float: right"><p id="known_from_error"></p></span>
						</div>
					</div>
				</div>
				<button type="submit" id="update" name="update" class="btn btn-custombg text-white"
						data-student_id="<?= $st[0]->id ?>" tabindex="42">
					<span class="fa fa-edit">&nbsp;&nbsp;</span>
					ترمیم کریں
				</button>
			</form>

			<?php } else { ?>

				<table class="table table-bordered col-md-12">
					<tr class="text-center">
						<th class="text-center m-b-30" colspan="12">
							طالب علم موجودہ سال میں نہیں ہے
						</th>
					</tr>
				</table>
				<script>
					$(document).ready(function () {
						$('.footer').hide();
					});
				</script>
			<?php } ?>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {

		$('#fees_type').change(function () {
			if ($(this).val() == 1) {
				$('#remarks').attr('readonly', true)
				$('#remarks').val('')
			} else {
				$('#remarks').removeAttr('readonly')
			}
		})

		$('input[name="guardian_relation"]').on('change keyup', function () {
			var guardian_relation = $(this).val();
			if (guardian_relation == 'والد') {
				var father_name = $('#father_name').val();
				var father_cnic = $('#father_cnic').val();
				var address = $('#address').val();

				$('#guardian').val(father_name);
				$('#guardian_cnic').val(father_cnic);
				$('#guardian_address').val(address);
			}
		})
		// =============	Prevent submit form on ENTER and focus next box ============//

		$('form date,select,input:not([type="submit"])').keydown(function (e) {
			if (e.keyCode == 13) {
				var inputs = $(this).parents('form').eq(0).find(':input');
				if (inputs[inputs.index(this) + 1] != null) {
					inputs[inputs.index(this) + 1].focus();
				}
				e.preventDefault();
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

		$('#update').click(function () {
			var student_id = $(this).data('student_id');
			var url = '<?= base_url('Student/update_student/')?>' + student_id;
			$('#edit_form').attr('action', url);
		});

		$('#update').click(function (e) {
			e.preventDefault();
			var error = 0;

			if ($('#required_class').val() == 'کلاس منتخب کریں') {
				error = 1;
				toastr['error']('کلاس منتخب کریں');
				$('#required_class_error').html('کلاس منتخب کریں');
			}
			if ($('#admission_number').val() == "") {
				error = 1;
				toastr['error']('داخلہ نمبر درج کریں');
				$('#admission_number_error').html('داخلہ نمبر درج کریں');
			}
			if ($('#fees_type').val() == "") {
				error = 1;
				toastr['error']('فیس کی قسم منتخب کریں');
				$('#fees_type_error').html('فیس کی قسم منتخب کریں');
			}
			if ($('#resident').val() == "") {
				error = 1;
				toastr['error']('رہائش منتخب کریں');
				$('#resident_error').html('رہائش منتخب کریں');
			}
			if ($('#name').val() == "") {
				error = 1;
				toastr['error']('نام درج کریں');
				$('#name_error').html('نام درج کریں');
			}
			if ($('#father_name').val() == "") {
				error = 1;
				toastr['error']('ولدیت درج کریں');
				$('#father_name_error').html('ولدیت درج کریں');
			}
			if ($('#dob').val() == "") {
				error = 1;
				toastr['error']('تاریخ پیدائش درج کریں');
				$('#dob_error').html('تاریخ پیدائش درج کریں');
			}
			if ($('#birthplace').val() == "") {
				error = 1;
				toastr['error']('مقام درج کریں');
				$('#birthplace_error').html('مقام درج کریں');
			}
			if ($('#area').val() == 'علاقہ منتخب کریں') {
				error = 1;
				toastr['error']('علاقہ منتخب کریں');
				$('#area_error').html('علاقہ منتخب کریں');
			}
			if ($('#country').val() == "") {
				error = 1;
				toastr['error']('ملک درج کریں');
				$('#country_error').html('ملک درج کریں');
			}
			if ($('#address').val() == "") {
				error = 1;
				toastr['error']('پتہ درج کریں');
				$('#address_error').html('پتہ درج کریں');
			}
			if ($('#father_cnic').val() == "") {
				error = 1;
				toastr['error']('شناختی کارڈ نمبر درج کریں');
				$('#father_cnic_error').html('شناختی کارڈ نمبر درج کریں');
			}

			/*ٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓ=========		guardian validation		===========*/

			if ($('#guardian').val() == "") {
				error = 1;
				toastr['error']('سرپرست درج کریں');
				$('#guardian_error').html('سرپرست درج کریں');
			}
			if ($('#guardian_father_name').val() == "") {
				error = 1;
				toastr['error']('ولدیت درج کریں');
				$('#guardian_father_name_error').html('ولدیت درج کریں');
			}
			if ($('input[name="guardian_relation"]').val() == '') {
				error = 1;
				toastr['error']('رشتہ درج کریں');
				$('#guardian_relation_error').html('رشتہ درج کریں');
			}
			if ($('#guardian_profession').val() == "") {
				error = 1;
				toastr['error']('پیشہ درج کریں');
				$('#guardian_profession_error').html('پیشہ درج کریں');
			}
			if ($('#guardian_address').val() == "") {
				error = 1;
				toastr['error']('پتہ درج کریں');
				$('#guardian_address_error').html('پتہ درج کریں');
			}
			if ($('#guardian_phone').val() == "") {
				error = 1;
				toastr['error']('نمبر درج کریں');
				$('#guardian_phone_error').html('نمبر درج کریں');
			}
			if ($('#guardian_cnic').val() == "") {
				error = 1;
				toastr['error']('شناختی کارڈ نمبر درج کریں');
				$('#guardian_cnic_error').html('شناختی کارڈ نمبر درج کریں');
			}

			/* ==================	 knownperson	 =====================*/

			if ($('#knownperson').val() == "") {
				error = 1;
				toastr['error']('نام درج کریں');
				$('#knownperson_error').html('نام درج کریں');
			}
			if ($('#knownperson_address').val() == "") {
				error = 1;
				toastr['error']('پتہ درج کریں');
				$('#knownperson_address_error').html('پتہ درج کریں');
			}
			if ($('#knownperson_phone').val() == "") {
				error = 1;
				toastr['error']('نمبر درج کریں');
				$('#knownperson_phone_error').html('نمبر درج کریں');
			}
			if ($('#last_darsgah').val() == "") {
				error = 1;
				toastr['error']('درسگاہ درج کریں');
				$('#last_darsgah_error').html('درسگاہ درج کریں');
			}
			if ($('#prev_darsgah').val() == "") {
				error = 1;
				toastr['error']('نام  پتہ درج کریں');
				$('#prev_darsgah_error').html('نام  پتہ درج کریں');
			}
			if ($('#prev_education').val() == "") {
				error = 1;
				toastr['error']('تعلیم درج کریں');
				$('#prev_education_error').html('تعلیم درج کریں');
			}

			if (error == 0) {
				$('#edit_form').submit();
			}
		});

		var current_admission_number = $('#admission_number').val();

		$('#admission_number').change(function (e) {
			var admission_number = $(this).val();
			if (admission_number) {
				$.ajax({
					url: '<?=site_url('Student/check_admission_number/')?>' + admission_number,
					type: 'POST',
					success: function (data) {
						var dt = $.parseJSON(data);
						var adm_num = Number(dt);
						if (adm_num == admission_number) {
							$('#admission_number_error').html('داخلہ نمبر پہلے سے موجود ہے');
							$('#admission_number_error').show();
							$('#edit_form').submit(function (e) {
								e.preventDefault();
							});
						} else {
							$('#admission_number_error').hide();
							$('#admission_number_error').html('');
							$('#edit_form').unbind(e.preventDefault());
						}
						if (current_admission_number == admission_number) {
							$('#admission_number_error').hide();
							$('#admission_number_error').html('');
							$('#edit_form').unbind(e.preventDefault());
						}
					}
				});
			}
		});

		$('#student_active>a').addClass('active');

		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth() + 1; //January is 0!
		var yyyy = today.getFullYear();
		if (dd < 10) {
			dd = '0' + dd
		}
		if (mm < 10) {
			mm = '0' + mm
		}

		today = yyyy + '-' + mm + '-' + dd;
		$('#date').attr("max", today);
		$('#dob').attr("max", today);
	});
</script>
