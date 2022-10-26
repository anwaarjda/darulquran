<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<h3 class="text-center" >
							درخواست براۓ ممتحن
						</h3>
					</div>
					<form id="add_form" method="post" enctype="multipart/form-data" action="<?= site_url('Teacher/save_teacher')?>">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for='name'>ممتحن کا نام</label>
									<input type="text" id="name" name="name" class="form-control name" placeholder=" نام" tabindex="1">
									<p id="name_error" class="text-danger">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for='fathername'>ولدیتِ ممتحن</label>
									<input type="text" id="fathername" name="fathername" class="form-control fathername" placeholder="والد کا نام" tabindex="2">
									<p id="fathername_error" class="text-danger">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for='gender'>جِنس</label>
									<select id='gender' name='gender' class="form-control gender" tabindex="3">
										<option selected value="">جِنس منتخب کریں</option>
										<option value='male'>مرد</option>
										<option value='female'>عورت</option>
									</select>
									<p id="gender_error" class="text-danger">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for='email'>ای-میل</label>
									<input type="email" id="email" name="email" class="form-control email" placeholder="ای-میل" tabindex="4">
									<p id="email_error" class="text-danger">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for='mobile'>موبائل نمبر</label>
									<input type="text" id="mobile" name="mobile" class="form-control mobile" placeholder="موبائل نمبر" tabindex="5" data-inputmask="'mask':'9999-9999999'">
									<p id="mobile_error" class="text-danger">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for='cnic'>شناختی کارڈ نمبر</label>
									<input type="text" id="cnic" name="cnic" class="form-control cnic" placeholder="شناختی کارڈ نمبر" tabindex="6" data-inputmask="'mask':'99999-9999999-9'">
									<p id="cnic_error" class="text-danger">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for='address'>پتہ</label>
									<input type="text" id="address" name="address" class="form-control address" placeholder="پتہ" tabindex="7">
									<p id="address_error" class="text-danger">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for='qoumiat'>قومیت</label>
									<input type="text" id="qoumiat" name="qoumiat" class="form-control qoumiat" placeholder="قومیت" value="پاکستانی" tabindex="8">
									<p id="qoumiat_error" class="text-danger">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for='elaqa'>علاقہ</label>
									<input type="text" id="elaqa" name="elaqa" class="form-control elaqa" placeholder="علاقہ" tabindex="9">
									<p id="elaqa_error" class="text-danger">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for='appointment_date'>تاریخِ تقرری</label>
									<input type="date" id="appointment_date" name="appointment_date" class="form-control appointment_date" tabindex="10">
									<p id="appointment_date_error" class="text-danger">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for='dob'>تاریخِ پیدائش</label>
									<input type="date" id="dob" name="dob" class="form-control dob" tabindex="11">
									<p id="dob_error" class="text-danger">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for='married'>شادی شدہ/ غیر شادی شدہ</label>
									<select id='married' name='married' class="form-control married" tabindex="12">
										<option value=''> منتخب کریں</option>
										<option value='1'>شادی شدہ</option>
										<option value='0'>غیر شادی شدہ</option>
									</select>
									<p id="married_error" class="text-danger">
								</div>
							</div>

							<div class="col-md-3 hide_no_of_child" style="display: none">
								<div class="form-group">
									<label for='no_of_child'>بچے</label>
									<input type="text" id="no_of_child" name="no_of_child" class="form-control no_of_child" tabindex="13">
									<p id="no_of_child_error" class="text-danger">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="teacher_picture">تصویرمنتخب کریں</label>
									<input type="file" class="col-12 btn btn-sm btn-success"  name="teacher_picture" value="تصویر" tabindex="14">
								</div>
							</div>

							<div class="col-md-3 m-t-30">
								<button type="submit" id="save" class=" btn btn-success mt-2" tabindex="15">
								<i class="fa fa-save">&nbsp;</i>
								محفوظ کریں
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function () {

// =============	Prevent submit form on ENTER and focus next box

	$('form date,select,input:not([type="submit"])').keydown(function(e) {
		if (e.keyCode !== 13) {
		} else {
			var inputs = $(this).parents('form').eq(0).find(':input');
			if (inputs[inputs.index(this) + 1] != null) {
				inputs[inputs.index(this) + 1].focus();
			}
			e.preventDefault();
			return false;
		}
	});

	$('#save').click(function (e){

		e.preventDefault();
		var error=0;

		if($('#name').val()=="")
		{
			error=1;
			$('#name_error').html(' نام درج کریں');
		}

		if (error==0){
			$('#add_form').submit();
		}

	});

	$('#married').change(function(){
		var married = $(this).val();
		if (married==0 || married=='') {
			$('.hide_no_of_child').hide();
		}
		else {
			$('.hide_no_of_child').show();
		}
	});

	$('#teacher_active>a').addClass('active');

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
	$('#appointment_date').attr("max", today);
	$('#dob').attr("max", today);
});
</script>
