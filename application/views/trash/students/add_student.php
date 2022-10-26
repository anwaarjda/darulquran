<style>
	.card-box {
		height: 60px;
	}
</style>

<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card-box" style="height: 60px;">
						<h2 class="header-title text-center" style="font-size: 26px;">
							درخواست براۓ داخلہ طالبعلم جدید/قدیمِ
						</h2>
					</div>
					<div class="card-box">
						<h3 class="text-center" >
							طالب علم کی معلومات
						</h3>
					</div>

					<form method="post" id="add_form" enctype="multipart/form-data" action="<?= base_url('Student/save_student') ?>">
						
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="admission_number">داخلہ نمبر</label>
								<input type="text" id="admission_number" name="admission_number" placeholder="داخلہ نمبر" class="form-control" tabindex="1" autofocus>
								<span class="text-danger" style="float: right"><p id="admission_number_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="name">نام طالب علم</label>
								<input type="text" id="name" name="name" placeholder="نام" class="form-control" tabindex="1" autofocus>
								<span class="text-danger" style="float: right"><p id="name_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="father_name">ولدیت</label>
								<input type="text" id="father_name" name="father_name" placeholder="ولدیت" class="form-control" tabindex="2">
								<span class="text-danger" style="float: right"><p id="father_name_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="dob">تاریخِ پیدائش</label>
								<input type="date" id="dob" name="dob" class="form-control" placeholder="عمر طالب علم" required tabindex="3">
								<span class="text-danger" style="float: right"><p id="dob_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="birthplace">مقام پیدائش</label>
								<input type="text" id="birthplace" name="birthplace" value="کراچی" placeholder="مقام پیدائش" class="form-control" tabindex="4" >
								<span class="text-danger" style="float: right"><p id="birthplace_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="district">ضلع</label>
								<input type="text" id="district" name="district" placeholder="ضلع" class="form-control" tabindex="5">
								<span class="text-danger" style="float: right"><p id="district_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="area">علاقہ</label>
								<select id="area" name="area" class="form-control select2" tabindex="6">
									<option selected="selected">علاقہ منتخب کریں</option>
									<option>کورنگی</option>
									<option>ملیر</option>
									<option>ائیرپورٹ</option>
									<option>لانڈھی</option>
								</select>
								<span class="text-danger pull-right"><p id="area_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="province">صوبہ</label>
								<select id="province" name="province" class="form-control select2" tabindex="6">
									<option selected="selected">سندھ</option>
									<option>پنجاب</option>
									<option>بلوچستان</option>
									<option>خیبر پختونخواں</option>
									<option>گِلگت بلتستان</option>
								</select>
								<span class="text-danger" style="float: right"><p id="province_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="country">ملک</label>
								<input type="text" id="country" name="country" placeholder="ملک" class="form-control" tabindex="7" value="پاکستان">
								<span class="text-danger" style="float: right"><p id="country_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="cnic">طالب علم کا شناختی کارڈ نمبر/ب فارم</label>
								<input type="text" id="cnic" name="cnic" placeholder="شناختی کارڈ نمبر" class="form-control" tabindex="8" data-inputmask="'mask':'99999-9999999-9'">
								<span class="text-danger" style="float: right"><p id="cnic_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="address">مکمل پتہ</label>
								<textarea type="text" id="address" name="address" placeholder="مکمل پتہ" class="form-control" tabindex="9" rows="1"></textarea>
								<span class="text-danger" style="float: right"><p id="address_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="phone">فون نمبر</label>
								<input type="text" id="phone" name="phone" placeholder="فون نمبر" class="form-control" tabindex="10" data-inputmask="'mask': '9999-9999999'">
								<span class="text-danger" style="float: right"><p id="phone_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="passport">طالب علم کاپاسپورٹ نمبر</label>
								<input type="text" id="passport" name="passport" placeholder="پاسپورٹ نمبر" class="form-control" tabindex="11">
								<span class="text-danger" style="float: right"><p id="passport_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="father_cnic">والد کا شناختی کارڈ نمبر</label>
								<input type="text" id="father_cnic" name="father_cnic" placeholder="والد کا شناختی کارڈ نمبر" class="form-control" tabindex="12" data-inputmask="'mask':'99999-9999999-9'">
								<span class="text-danger" style="float: right"><p id="father_cnic_error"></p></span>
							</div>
						</div>

						<div class="col-md-3 m-t-30">
							<div class="form-group m-t-10">
								<input class="col-9 btn btn-sm btn-success" type="file" name="student_picture" value="تصویر" tabindex="12">
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--guardian information-->

			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<h3 class="text-center">سرپرست کی معلومات</h3>
					</div>

					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="guardian">نام سرپرست </label>
								<input type="text" id="guardian" name="guardian" placeholder="سرپرست کا نام" class="form-control" tabindex="13">
								<span class="text-danger" style="float: right"><p id="guardian_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="guardian_father_name">ولدیت سرپرست </label>
								<input type="text" id="guardian_father_name" name="guardian_father_name" placeholder="ولدیت سرپرست " class="form-control" tabindex="14">
								<span class="text-danger" style="float: right"><p id="guardian_father_name_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="guardian_relation">رشتہ</label>
								<select id="guardian_relation" name="guardian_relation" class="form-control select2" tabindex="15">
									<option selected>رشتہ منتخب کریں</option>
									<option value="والد">والد</option>
									<option value="والدہ"> والدہ</option>
									<option value="دادہ">دادہ</option>
									<option value="نانا">نانا</option>
									<option value="بھائی"> بھائی</option>
									<option value="چچا">چچا</option>
									<option value="ماموں">ماموں</option>
								</select>
								<span class="text-danger" style="float: right"><p id="guardian_relation_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="guardian_profession">پیشہ سرپرست</label>
								<input type="text" id="guardian_profession" name="guardian_profession" placeholder="پیشہ سرپرست " class="form-control" tabindex="16">
								<span class="text-danger" style="float: right"><p id="guardian_profession_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="guardian_address">مکمل پتہ</label>
								<textarea type="text" id="guardian_address" name="guardian_address" placeholder="مکمل پتہ" class="form-control" tabindex="17" rows="1"></textarea>
								<span class="text-danger" style="float: right"><p id="guardian_address_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="guardian_phone">فون نمبر</label>
								<input type="text" id="guardian_phone" name="guardian_phone" placeholder="فون نمبر" class="form-control mobile" tabindex="18" data-inputmask="'mask': '9999-9999999'">
								<span class="text-danger" style="float: right"><p id="guardian_phone_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="guardian_cnic">سرپرست کا شناختی کارڈ نمبر</label>
								<input type="text" id="guardian_cnic" name="guardian_cnic" class="form-control" placeholder="شناختی کارڈ نمبر" tabindex="19" data-inputmask="'mask': '99999-9999999-9'">
								<span class="text-danger" style="float: right"><p id="guardian_cnic_error"></p></span>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<h3 class="text-center">واقفیّت</h3>
					</div>

					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="knownperson">کراچی میں کسی قریب ترین واقف کار کا نام</label>
								<input type="text" id="knownperson" name="knownperson" placeholder="واقف کار کا نام" class="form-control" tabindex="20">
								<span class="text-danger" style="float: right"><p id="knownperson_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="knownperson_address">مکمل پتہ</label>
								<textarea type="text" id="knownperson_address" name="knownperson_address" class="form-control" placeholder="مکمل پتہ" tabindex="21" rows="1"></textarea>
								<span class="text-danger" style="float: right"><p id="knownperson_address_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="knownperson_phone">فون نمبر</label>
								<input type="text" id="knownperson_phone" name="knownperson_phone" class="form-control" placeholder="فون نمبر" tabindex="22" data-inputmask="'mask':'9999-9999999'">
								<span class="text-danger" style="float: right"><p id="knownperson_phone_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="last_darsgah">آخری درسگاہ کانام مع مختصر پتہ جہاں تعلیم پائی</label>
								<input type="text" id="last_darsgah" name="last_darsgah" class="form-control" placeholder=" درسگاہ " tabindex="23">
								<span class="text-danger" style="float: right"><p id="last_darsgah_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="leave_reason">آخری درسگاہ چھوڑنے کا سبب واضح الفاظ میں</label>
								<input type="text" id="leave_reason" name="leave_reason" class="form-control" placeholder=" سبب " tabindex="24">
								<span class="text-danger" style="float: right"><p id="leave_reason_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="prev_darsgah">دیگر درسگاہوں کے نام مع مختصر پتے جہاں تعلیم پائی</label>
								<input type="text" id="prev_darsgah" name="prev_darsgah" class="form-control" placeholder="دیگر درسگاہ" tabindex="25">
								<span class="text-danger" style="float: right"><p id="prev_darsgah_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="prev_education">سابقہ حاصل شدہ تعلیم</label>
								<input type="text" id="prev_education" name="prev_education" class="form-control" placeholder=" تعلیم" tabindex="26">
								<span class="text-danger" style="float: right"><p id="prev_education_error"></p></span>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="required_class">مطلوبہ شعبہ اوردرجہ برائے تعلیم</label>
								<select id='required_class' name='required_class' class="form-control selected_class" required tabindex="27" >
									<option selected>کلاس منتخب کریں</option>
									<?php foreach ($classes as $c) :?>
										<option value="<?= $c->id ?>"><?= $c->class_name?></option>
									<?php endforeach ?>
								</select>
								<span class="text-danger" style="float: right"><p id="required_class_error"></p></span>
							</div>
						</div>
					</div>
					<button type="submit" id="btnsub" name="btnsub" class="btn btn-success" tabindex="28">
						<i class="fa fa-save">&nbsp;</i>
						ریکارڈ محفوظ کریں
					</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

$(document).ready(function () {

	$('.selected_class').change(function (){

		var class_id = $(this).val();
		var url = '<?= base_url('Student/save_student/')?>'+class_id;
		$('#add_form').attr('action',url);

	});

	// =============Prevent submit form on ENTER==============

	$('form date,select,input:not([type="submit"])').keydown(function(e) {
		if (e.keyCode == 13) {
			var inputs = $(this).parents('form').eq(0).find(':input');
			if (inputs[inputs.index(this) + 1] != null) {
				inputs[inputs.index(this) + 1].focus();
			}
			e.preventDefault();
		}
	});

	$('#admission_number').change(function() {
		var admission_number = $(this).val();
		if(admission_number) {
			$.ajax({
				url: '<?=site_url('Student/check_admission_number') ?>',
				type: 'POST',
				data: {admission_number:admission_number},
				success:function(data) {
					$('#admission_number_error').html(data);
					$('#admission_number_error').focus();
				}
			});
		}
	});

	$('#btnsub').click(function (e){

		e.preventDefault();
		var error=0;
		if($('#admission_number').val()=="")
		{
			error=1;
			$('#admission_number_error').html('داخلہ نمبر درج کریں');
		}

		if($('#name').val()=="")
		{
			error=1;
			$('#name_error').html(' نام درج کریں');
		}

		if ($('#father_name').val()=="")
		{
			error=1;
			$('#father_name_error').html('ولدیت درج کریں');
		}

		if ($('#dob').val()=="")
		{
			error=1;
			$('#dob_error').html('تاریخ پیدائش درج کریں');
		}

		if($('#birthplace').val()=="")
		{
			error=1;
			$('#birthplace_error').html('مقام درج کریں');
		}

		if($('#area').val()=='علاقہ منتخب کریں')
		{
			error=1;
			$('#area_error').html('علاقہ منتخب کریں');
		}

		if($('#country').val()=="")
		{
			error=1;
			$('#country_error').html('ملک درج کریں');
		}

		if($('#address').val()=="")
		{
			error=1;
			$('#address_error').html('پتہ درج کریں');
		}

		if($('#father_cnic').val()=="")
		{
			error=1;
			$('#father_cnic_error').html('شناختی کارڈ نمبر درج کریں');
		}

		/*ٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓٓ=========		guardian validation		===========*/

		if ($('#guardian').val()=="")
		{
			error=1;
			$('#guardian_error').html('سرپرست درج کریں');
		}

		if ($('#guardian_father_name').val()=="")
		{
			error=1;
			$('#guardian_father_name_error').html('ولدیت درج کریں');
		}

		if ($('#guardian_relation').val()=='رشتہ منتخب کریں')
		{
			error=1;
			$('#guardian_relation_error').html('رشتہ منتخب کریں');
		}

		if ($('#guardian_profession').val()=="")
		{
			error=1;
			$('#guardian_profession_error').html('پیشہ درج کریں');
		}

		if ($('#guardian_address').val()=="")
		{
			error=1;
			$('#guardian_address_error').html('پتہ درج کریں');
		}

		if ($('#guardian_phone').val()=="")
		{
			error=1;
			$('#guardian_phone_error').html('نمبر درج کریں');
		}

		if ($('#guardian_cnic').val()=="")
		{
			error=1;
			$('#guardian_cnic_error').html('شناختی کارڈ نمبر درج کریں');
		}

		/* =============== knownperson =====================*/

		if ($('#knownperson').val()=="")
		{
			error=1;
			$('#knownperson_error').html(' نام درج کریں');
		}

		if ($('#knownperson_address').val()=="")
		{
			error=1;
			$('#knownperson_address_error').html(' پتہ درج کریں');
		}

		if ($('#knownperson_phone').val()=="")
		{
			error=1;
			$('#knownperson_phone_error').html(' نمبر درج کریں');
		}

		if ($('#last_darsgah').val()=="")
		{
			error=1;
			$('#last_darsgah_error').html(' درسگاہ درج کریں');
		}

		if ($('#leave_reason').val()=="")
		{
			error=1;
			$('#leave_reason_error').html('سبب درج کریں');
		}

		if ($('#prev_darsgah').val()=="")
		{
			error=1;
			$('#prev_darsgah_error').html('نام  پتہ درج کریں');
		}

		if ($('#prev_education').val()=="")
		{
			error=1;
			$('#prev_education_error').html('تعلیم درج کریں');
		}

		if ($('#required_class').val()=='کلاس منتخب کریں')
		{
			error=1;
			$('#required_class_error').html('کلاس منتخب کریں');
		}

		if (error==0){
			$('#add_form').submit();
		}
	});

});

</script>
