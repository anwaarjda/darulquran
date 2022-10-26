<style>
	.card-box
	{
		height:60px;
	}
</style>
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">

				<div class="col-12">
					<div class="card-box" style="height: 60px;">
						<h2 class="m-t-0 header-title text-center" style="font-size: 26px;">رجسٹرڈ و رکگنائزڈ</h2> ِ
					</div>
					<div class="card-box" >
						<h2 class="m-t-0 header-title text-center" style="font-size: 26px">   طالب علم کی مالومات</h2> ِ
					</div>
					<form method="post" action="<?= site_url("register/upload_img ") ?>" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>نام</label>
									<input type="text" name="Txtname" placeholder="نام" value="<?= $student['name'] ?>" class="form-control" tabindex="1" autofocus required>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>ولدیت</label>
									<input type="text" name="txtlastname" placeholder="ولدیت" value="<?= $student['father_name'] ?>" class="form-control" tabindex="2"  required>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>تاریخ پیدائش(ہندسوں میں)</label>
									<input type="text" name="txtbirth_incount" value="<?= $student['dob'] ?>" placeholder="تاریخ پیدائش(ہندسوں میں)" class="form-control" tabindex="3"  required>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>تاریخ پیدائش(لفظوں میں)</label>
									<input type="text" name="txtbirth_inword" placeholder="تاریخ پیدائش(لفظوں میں)" class="form-control" tabindex="4" required>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>مقام پیدائش</label>
									<input type="text" name="txtlastname" placeholder="مقام پیدائش" class="form-control" tabindex="5" required>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>طالب علم کا مکمل پتہ</label>
									ِ<textarea class="form-control" placeholder="طالب علم کا مکمل پتہ" tabindex="6" required></textarea>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>آخری درسگاہ چھورنے کا سبب</label>
									ِ<textarea class="form-control" placeholder="آخری درسگاہ چھورنے کا سبب" tabindex="7" required></textarea>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>آخری درسگاہ</label>
									ِ<input type="text" name="last_institute" class="form-control" placeholder="آخری درسگاہ" tabindex="8" required>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>آخری کلاس جس میں طالب علم کمیاب ہوا</label>
									ِ<input type="text" name="last_class" class="form-control" placeholder="آخری کلاس جس میں طالب علم کمیاب ہوا" tabindex="9" required>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>سندات</label>
									ِ<input type="file" name="txt_file" class="form-control" placeholder="سندات" tabindex="10" required>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>مطلوبہ کلاس</label>
									<select name="required_class" class="form-control" tabindex="11">
											<option>مطلوبہ کلاس منتخب کریں</option>
										<?php foreach ($class as $cl): ?>
										<option value="<?= $cl->id ?>"><?= $cl->class ?></option>
										<?php endforeach; ?>
									</select>

								</div>
							</div>


						</div>
				</div>
			</div>
			<!--guardian information-->
			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<h2 class="m-t-0 header-title text-center" style="font-size: 26px">سرپرست کی معلومات</h2>
					</div>

					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>سرپرست کا نام</label>
								<input type="text" name="g_name" placeholder="سرپرست کا نام" value="<?= $student['Guardian_name'] ?>"class="form-control" tabindex="12" required>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>سرپرست سے رشتہ</label>
								<select class="form-control select2" name="g_relation" tabindex="13">
									<option value="<?= $student['guardian_relation'] ?>" selected ='<?= $student['guardian_relation'] ?>'><?= $student['guardian_relation'] ?></option>
									<option value="والد">والد</option>
									<option value="والدہ"> والدہ</option>
									<option value="بھائی"> بھائی</option>
									<option value="چچا">چچا</option>
									<option value="ماموں">ماموں</option>

								</select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>سرپرست کا پیشہ</label>
								<input type="text" name="gr_profession" placeholder="سرپرست کا پیشہ" class="form-control" tabindex="14" required>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>قومی شناختی کارڈ نمبر</label>
								<input type="text" name="g_cnic" value="<?= $student['gardian_cnic'] ?>" data-inputmask="'mask': '99999-9999999-9'" class="form-control" placeholder="قومی شناختی کارڈ نمبر" tabindex="15" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>ٹیلی فون دقتر</label>
								<input type="text" data-mask="(991) 9999999"   name="g_phone" placeholder="ٹیلی فون دقتر" class="form-control phone" tabindex="16" required>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>ٹیلی فون رہائش گاہ/قریبی</label>
								<input type="text" data-mask="(991) 9999999"  name="g_phone" placeholder="ٹیلی فون رہائش گاہ/قریبی" class="form-control phone" tabindex="17" required>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>مبائل نمبر</label>
								<input type="text"   value="<?= $student['contact_number'] ?>" name="g_mobile" placeholder="مبائل نمبر" class="form-control mobile" tabindex="18" required>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>سرپرست کا پتہ</label>
								<textarea class="form-control" name="gr_address" placeholder="سرپرست کا پتہ" tabindex="19" required></textarea>
							</div>
						</div>



					</div>
					<!--Result Section-->
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<h2 class="m-t-0 header-title text-center" style="font-size: 26px">دفتری کاروئی کے لیے</h2>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<table class="table table-stripped">
									<tr>
										<thead>
											<th>قرآن</th>
											<th>اوردو</th>
											<th>انگریزی</th>
											<th>ریاظی</th>
										</thead>
										<tbody>
										<tr>
											<td><?= $student['quran'] ?></td>
											<td><?= $student['urdu'] ?></td>
											<td><?= $student['english'] ?></td>
											<td><?= $student['maths'] ?></td>
										</tr>
										</tbody>
									</tr>
								</table>
							</div>
						</div>
					</div>
					

					</div>
					<!--Result Section-->
				</div>
			</div>
			<!-- end row -->
		</div>
		<!-- container -->
	</div>
	<!-- content -->
