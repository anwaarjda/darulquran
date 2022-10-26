<style>
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
			<form method="post" id="add_form" enctype="multipart/form-data"
				  action="<?= site_url('Student/save_student') ?>">
				<!-- student information -->
				<div class="row">
					<div class="col-12">
						<div class="card-box text-center">
							<h2>
								درخواست براۓ داخلہ طالبعلم جدید/قدیم
							</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 m-auto">
						<div class="form-group">
							<center>
								<label for="required_class" style="justify-content: center;font-size: 28px">مطلوبہ شعبہ
									اوردرجہ برائے تعلیم</label>
							</center>
							<select id='required_class' name='required_class'
									class="form-control selected_class select2" required tabindex="1">
								<option selected>کلاس منتخب کریں</option>
								<?php foreach ($classes as $class) : ?>
									<option value="<?= $class->id ?>" <?= ($class->id == $this->session->class_id) ? 'selected' : null; ?>><?= $class->class_name ?></option>
								<?php endforeach ?>
							</select>
							<span class="text-danger" style="float: right;display: inline">
								<p id="required_class_error"></p>
							</span>
						</div>
					</div>
				</div>
				<div id="admission_form" style="display: <?= !empty($this->session->class_id) ? 'block' : 'none' ?>">
					<div class="row">
						<div class="col-12">
							<div class="card-box p-1 bg-custom text-white text-center">
								<h3>طالب علم کی معلومات</h3>
							</div>
						</div>
					</div>

					<div class="d-flex">
						<div class="form-group p-1" style="width: 125px">
							<label for="gr_number">متوقع جی آر نمبر</label>
							<input type="text" id="gr_number" name="gr_number" class="form-control" value="<?= $gr_number ?>" readonly>
						</div>

						<div class="form-group p-1" style="width: 125px">
							<label for="admission_number"> داخلہ نمبر</label>
							<input type="text" id="admission_number" name="admission_number"
								   placeholder="داخلہ نمبر" class="form-control" maxlength="4" autofocus
								   tabindex="2" autocomplete="off">
							<span class="text-danger pull-right" style="width: 132px">
								<p id="admission_number_error"></p>
							</span>
						</div>

						<div class="form-group p-1" style="width: 125px">
							<label for="old_admission_number"> قدیم داخلہ نمبر</label>
							<input type="text" id="old_admission_number" name="old_admission_number"
								   placeholder="قدیم داخلہ نمبر" class="form-control" maxlength="4" autofocus
								   tabindex="3" autocomplete="off">
						</div>

						<div class="form-group p-1">
							<label for="admission_type">قدیم/جدید</label>
							<select type="text" id="admission_type" name="admission_type"
									class="form-control" tabindex="4">
								<option value="new">جدید</option>
								<option value="old" selected>قدیم</option>
							</select>
						</div>

						<div class="form-group p-1">
							<label for="fees_type">فیس کی قسم</label>
							<select type="text" id="fees_type" name="fees_type" class="form-control"
									tabindex="5">
								<option value="">قسم منتخب کریں</option>
								<option selected value="1">مکمل</option>
								<option value="0">نصف</option>
							</select>
							<span class="text-danger pull-right"><p id="fees_type_error"></p></span>
						</div>

						<div class="form-group p-1 form-admission_numberoup">
							<label class="control-label" for="inputSuccess">کیفیت </label>
							<input type="text" id="remarks" name="remarks" placeholder="کیفیت" class="form-control" tabindex="6" readonly>
						</div>

						<div class="form-group p-1">
							<label style="width: 100%" for="resident">رہائش</label>
							<select type="text" id="resident" name="resident" class="form-control"
									tabindex="7">
								<option>اقامتی</option>
								<option selected>غیر اقامتی</option>
							</select>
							<span class="text-danger pull-right"><p id="resident_error"></p></span>
						</div>

						<div class="form-group p-1">
							<label for="date">بابت ماہ</label>
							<input type="date" id="date" name="date" placeholder="date" class="form-control" tabindex="8">
							<input type="hidden" id="date_hijri" name="date_hijri" class="form-control" value="" required>
							<span class="text-success date_hijri"></span>
						</div>
					</div>

					<div class="row">

						<div class="col-md-3">
							<div class="form-group">
								<label for="name">نام طالب علم</label>
								<input type="text" id="name" name="name" placeholder="نام" class="form-control"
									   autofocus tabindex="9" autocomplete="off">
								<span class="text-danger" style="float: right"><p id="name_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="cnic">شناختی کارڈ نمبر/ب فارم</label>
								<input type="text" id="cnic" name="cnic" placeholder="شناختی کارڈ نمبر"
									   class="form-control" data-inputmask="'mask':'99999-9999999-9'" tabindex="10">
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="father_name">ولدیت</label>
								<input type="text" id="father_name" name="father_name" placeholder="ولدیت"
									   class="form-control" tabindex="11" autocomplete="off">
								<span class="text-danger" style="float: right"><p id="father_name_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="father_cnic">والد کا شناختی کارڈ نمبر</label>
								<input type="text" id="father_cnic" name="father_cnic"
									   placeholder="والد کا شناختی کارڈ نمبر" class="form-control"
									   data-inputmask="'mask':'99999-9999999-9'" tabindex="12">
								<span class="text-danger" style="float: right"><p id="father_cnic_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="dob">تاریخِ پیدائش</label>
								<input type="date" id="dob" name="dob" class="form-control" placeholder="عمر طالب علم"
									   required tabindex="13" autocomplete="off">
								<span class="text-danger" style="float: right"><p id="dob_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="birthplace">مقام پیدائش</label>
								<input type="text" id="birthplace" name="birthplace" value="کراچی"
									   placeholder="مقام پیدائش" class="form-control" tabindex="14" autocomplete="off">
								<span class="text-danger" style="float: right"><p id="birthplace_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="district">ضلع</label>
								<input type="text" id="district" name="district" placeholder="ضلع" class="form-control"
									   tabindex="15" autocomplete="off">
								<span class="text-danger" style="float: right"><p id="district_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="area">علاقہ</label>
								<select id="area" name="area" class="form-control select2" tabindex="16"
										style="width:250px">
									<option selected="selected">علاقہ منتخب کریں</option>
									<?php foreach ($areas as $area) : ?>
										<option value="<?= $area->id ?>"><?= $area->area ?></option>
									<?php endforeach ?>
								</select>
								<span class="text-danger pull-right"><p id="area_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="province">صوبہ</label>
								<select id="province" name="province" class="form-control select2" tabindex="17"
										style="width:250px">
									<option selected="selected">سندھ</option>
									<option>پنجاب</option>
									<option>بلوچستان</option>
									<option>خیبر پختونخواں</option>
									<option>گِلگت بلتستان</option>
									<option>فاٹا</option>
									<option>غیر ملکی</option>
								</select>
								<span class="text-danger" style="float: right"><p id="province_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="country">ملک</label>
								<input type="text" id="country" name="country" placeholder="ملک" class="form-control"
									   value="پاکستان" tabindex="18" autocomplete="off">
								<span class="text-danger" style="float: right"><p id="country_error"></p></span>
							</div>
						</div>


						<div class="col-md-6">
							<div class="form-group">
								<label for="address">مکمل پتہ</label>
								<input type="text" id="address" name="address" placeholder="مکمل پتہ"
									   class="form-control" tabindex="18"/>
								<span class="text-danger" style="float: right"><p id="address_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="phone">فون نمبر</label>
								<input type="text" id="phone" name="phone" placeholder="فون نمبر" class="form-control"
									   data-inputmask="'mask': '9999-9999999'" tabindex="19"/>
								<span class="text-danger" style="float: right"><p id="phone_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="passport">طالب علم کاپاسپورٹ نمبر</label>
								<input type="text" id="passport" name="passport" placeholder="پاسپورٹ نمبر"
									   class="form-control" data-inputmask="'mask': ''" min="44" max="44" tabindex="20">
								<span class="text-danger" style="float: right"><p id="passport_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="student_picture">تصویرمنتخب کریں</label>
								<input type="file" class="col-12 btn btn-sm btn-success" name="student_picture"
									   value="تصویر">
							</div>
						</div>
					</div>
					<!-- guardian information -->
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
									   tabindex="22" dir="ltr">
								<datalist id="guardian_relation">
									<option dir="rtl">والد</option>
									<option dir="rtl"> والدہ</option>
									<option dir="rtl">دادہ</option>
									<option dir="rtl">نانا</option>
									<option dir="rtl"> بھائی</option>
									<option dir="rtl">چچا</option>
									<option dir="rtl">ماموں</option>
								</datalist>
								<span class="text-danger" style="float: right"><p
											id="guardian_relation_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="guardian">نام سرپرست </label>
								<input type="text" id="guardian" name="guardian" placeholder="سرپرست کا نام"
									   class="form-control" tabindex="23">
								<span class="text-danger" style="float: right"><p id="guardian_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="guardian_father_name">ولدیت سرپرست </label>
								<input type="text" id="guardian_father_name" name="guardian_father_name"
									   placeholder="ولدیت سرپرست " class="form-control" tabindex="24">
								<span class="text-danger" style="float: right"><p
											id="guardian_father_name_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="guardian_profession">پیشہ سرپرست</label>
								<input type="text" id="guardian_profession" name="guardian_profession"
									   placeholder="پیشہ سرپرست " class="form-control" tabindex="26">
								<span class="text-danger" style="float: right"><p
											id="guardian_profession_error"></p></span>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="guardian_address">مکمل پتہ</label>
								<input type="text" id="guardian_address" name="guardian_address" placeholder="مکمل پتہ"
									   class="form-control" tabindex="27">
								<span class="text-danger" style="float: right"><p
											id="guardian_address_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="guardian_phone">فون نمبر</label>
								<input type="text" id="guardian_phone" name="guardian_phone" placeholder="فون نمبر"
									   class="form-control mobile" data-inputmask="'mask': '9999-9999999'"
									   tabindex="28">
								<span class="text-danger" style="float: right"><p id="guardian_phone_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="guardian_phone_2">فون نمبر 2 </label>
								<input type="text" id="guardian_phone_2" name="guardian_phone_2" placeholder="فون نمبر"
									   class="form-control mobile" data-inputmask="'mask': '9999-9999999'"
									   tabindex="28">
								<span class="text-danger" style="float: right"><p
											id="guardian_phone_error_2"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="guardian_cnic">سرپرست کا شناختی کارڈ نمبر</label>
								<input type="text" id="guardian_cnic" name="guardian_cnic" class="form-control"
									   placeholder="شناختی کارڈ نمبر" data-inputmask="'mask': '99999-9999999-9'"
									   tabindex="29">
								<span class="text-danger" style="float: right"><p id="guardian_cnic_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="guardian_is_guarantor">سرپرست ہی ضامن ہے؟ </label>
								<input type="checkbox" id="guardian_is_guarantor" class="form-control"
									   style="width: 25px;height: 25px" tabindex="29">
							</div>
						</div>
					</div>
					<!-- knownperson information -->
					<div class="row">
						<div class="col-md-12">

							<div class="row">

								<div class="card-box col-md-12 p-1 bg-custom text-white text-center">
									<h3>واقفیّت</h3>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="knownperson">کراچی میں کسی قریب ترین واقف کار کا نام</label>
										<input type="text" id="knownperson" name="knownperson"
											   placeholder="واقف کار کا نام" class="form-control" tabindex="30">
										<span class="text-danger" style="float: right"><p
													id="knownperson_error"></p></span>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="knownperson_address">مکمل پتہ</label>
										<input type="text" id="knownperson_address" name="knownperson_address"
											   class="form-control" placeholder="مکمل پتہ" tabindex="31">
										<span class="text-danger" style="float: right"><p
													id="knownperson_address_error"></p></span>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label for="knownperson_phone">فون نمبر</label>
										<input type="text" id="knownperson_phone" name="knownperson_phone"
											   class="form-control" placeholder="فون نمبر"
											   data-inputmask="'mask':'9999-9999999'" tabindex="32">
										<span class="text-danger" style="float: right"><p
													id="knownperson_phone_error"></p></span>
									</div>
								</div>

								<div class="card-box col-md-12 p-1 bg-custom text-white text-center">
									<h3>سابقہ تعلیم</h3>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label for="last_darsgah">آخری درسگاہ کانام مع مختصر پتہ جہاں تعلیم پائی</label>
										<input type="text" id="last_darsgah" name="last_darsgah" class="form-control"
											   placeholder=" درسگاہ " tabindex="33">
										<span class="text-danger" style="float: right"><p
													id="last_darsgah_error"></p></span>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label for="leave_reason">آخری درسگاہ چھوڑنے کا سبب واضح الفاظ میں</label>
										<input type="text" id="leave_reason" name="leave_reason" class="form-control"
											   placeholder=" سبب " tabindex="34">
										<span class="text-danger" style="float: right"><p
													id="leave_reason_error"></p></span>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label for="prev_darsgah">دیگر درسگاہوں کے نام مع مختصر پتے جہاں تعلیم
											پائی</label>
										<input type="text" id="prev_darsgah" name="prev_darsgah" class="form-control"
											   placeholder="دیگر درسگاہ" tabindex="35">
										<span class="text-danger" style="float: right"><p
													id="prev_darsgah_error"></p></span>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label for="prev_education">سابقہ حاصل شدہ تعلیم</label>
										<input type="text" id="prev_education" name="prev_education"
											   class="form-control" placeholder=" تعلیم" tabindex="36">
										<span class="text-danger" style="float: right"><p id="prev_education_error"></p></span>
									</div>
								</div>
							</div>
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
										<input type="text" id="guarantor" name="guarantor" placeholder="ضامن کا نام"
											   class="form-control" tabindex="37">
										<span class="text-danger" style="float: right"><p
													id="guarantor_error"></p></span>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="guarantor_father_name">ولد</label>
										<input type="text" id="guarantor_father_name" name="guarantor_father_name"
											   class="form-control" placeholder="ولد" tabindex="38">
										<span class="text-danger" style="float: right"><p
													id="guarantor_father_name_error"></p></span>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="guarantor_country">وطن اصلی</label>
										<input type="text" id="guarantor_country" name="guarantor_country"
											   class="form-control" placeholder="وطن" tabindex="39" value="پاکستان">
										<span class="text-danger" style="float: right"><p
													id="guarantor_country_error"></p></span>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="guarantor_address">ساکن حال</label>
										<input type="text" id="guarantor_address" name="guarantor_address"
											   class="form-control" placeholder="پتہ" tabindex="40">
										<span class="text-danger" style="float: right"><p
													id="guarantor_address_error"></p></span>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="guarantor_cnic">قومی شناختی کارڈ نمبر</label>
										<input type="text" id="guarantor_cnic" name="guarantor_cnic"
											   class="form-control" placeholder="شناختی کارڈ نمبر"
											   data-inputmask="'mask': '99999-9999999-9'" tabindex="41">
										<span class="text-danger" style="float: right"><p id="guarantor_cnic_error"></p></span>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="known_from">عرصۂ واقفیّت</label>
										<input type="text" id="known_from" name="known_from" class="form-control"
											   placeholder="عرصہ" tabindex="42">
										<span class="text-danger" style="float: right"><p
													id="known_from_error"></p></span>
									</div>
								</div>
							</div>
							<button type="submit" id="btnsub" name="btnsub" class="btn btn-success" tabindex="42">
								<i class="fa fa-save">&nbsp;</i>
								محفوظ کریں
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>

	$(document).ready(function () {

		$('#date').change(function () {
			$.ajax({
				url: '<?= site_url("Date/get_hijri_date/") ?>' + $(this).val(),
				success: function (response) {
					let result = JSON.parse(response);
					$('#date_hijri').val(result.hijri_date);
					$('.date_hijri').text('بمطابق '+result.hijri_date);
				}
			})
		})

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
		// =============	Prevent submit form on ENTER and focus next box

		$('form date,select,input:not([type="submit"])').keydown(function (e) {
			if (e.keyCode == 13) {
				var inputs = $(this).parents('form').eq(0).find(':input');
				if (inputs[inputs.index(this) + 1] != null) {
					inputs[inputs.index(this) + 1].focus();
				}
				e.preventDefault();
			}
		});

		$('#admission_number').on('change keyup', function (e) {
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
							$('form date,select,input').prop('disabled', true);
							$('#admission_number').prop('disabled', false).focus();
							$('#add_form').submit(function (e) {
								e.preventDefault();
							});
						} else {
							$('#admission_number_error').hide();
							$('#admission_number_error').html('');
							$('form date,select,input').prop('disabled', false);
							$('#add_form').unbind(e.preventDefault());
						}
					}
				});
			}
		});

		$('#btnsub').click(function (e) {
			e.preventDefault();
			var error = 0;
			if ($('#required_class').val() == 'کلاس منتخب کریں') {
				error = 1;
				toastr['error']('کلاس منتخب کریں');
				$('#required_class_error').html('کلاس منتخب کریں');
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
				$('#add_form').submit();
			}
		});

		$('#required_class').change(function () {
			$('#admission_form').show();
		})

		$('#guardian_is_guarantor').click(function () {
			if ($(this).is(':checked') == true) {
				$('#guarantor').val($('#guardian').val());
				$('#guarantor_father_name').val($('#guardian_father_name').val());
				$('#guarantor_address').val($('#guardian_address').val());
				$('#guarantor_cnic').val($('#guardian_cnic').val());
			} else {
				$('#guarantor').val('');
				$('#guarantor_father_name').val('');
				$('#guarantor_address').val('');
				$('#guarantor_cnic').val('');
			}


		})

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

		$('#btnsub').click(function () {
			$(this).hide();
			setTimeout(function () {
				$('#btnsub').show();
			}, 3000)
		});
	});

</script>
