<style>
	.table td, .table th {
		border: 1px solid #0b0b0b;
		padding: 3px;
		vertical-align: middle;
	}
	.table th
	{
		font-size: unset;
	}
</style>
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<form method="post" action="<?=site_url('Fees/index') ?>">
				<div class="row">
					<div class="col-12">
						<div class="card-box">
							<h2 class="text-center">
								فیس وصولی
							</h2>
						</div>
					</div>
				</div>
				<?php if(!empty($annual_fees)){ ?>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-2">
							<label id="gr_number">جی آر نمبر</label>
							<input type="text" id="gr_number" name="gr_number" class="form-control montserrat" placeholder="GR Number" autofocus required>
							<span class="text-danger pull-right" style="width: 132px">
								<p id="gr_number_error"></p>
							</span>
						</div>
						<div class="col-md-1 mt-4">
							<button id="voucher" type="submit" class="btn btn-primary mt-3" style="font-size: 20px">
								<i class="fa fa-file">&nbsp;&nbsp;</i> واؤچر
							</button>
						</div>
					</div>
				</div>
			</form>
			<?php if(!empty($student)) {?>
				<div class="col-md-7" style="margin: auto">
					<div class="row pt-1" style="justify-content: space-between">

						<div class="h4">
							<span class="text-center">
								 تاریخ :
							</span>
							<span>
							<?php if(!empty($student->date)){
								echo substr($student->date,'0','11');
							}
							else
							{
								echo '<span id="date"></span>';
							}?>
							</span>
						</div>

						<div class="h4">
							<span>نام: <?=$student->name.' بن '.$student->father_name?></span>
						</div>

						<div class="h4">
							<span> جی آر نمبر :<?=$student->gr_number?></span>
						</div>

						<?php if(!empty($student->voucher_no)){
							echo '<div class="h4" style="margin-right: 5%">
									<span class="text-center">واؤچر نمبر :</span>
									<span>'.$student->voucher_no.'</span>
								</div>';
						} ?>

					</div>
				</div>
				
				<form id="form" method="post" action="<?=base_url('Fees/receive')?>">
					<table class="table table-bordered dark-border col-md-12" style="width: 700px" align="center">
						<tr>
							<th width="50%">قابلِ وصول فیس :</th>
							<td>
								<b style="line-height: 45px;padding-right: 5px"><?= $annual_fees ?></b>
								<input type="hidden" name="amount" value="<?= $annual_fees ?>">
							</td>
						</tr>
						<tr>
							<th>وصول فیس :</th>
							<td>
								<input type="number" id="received" name="received" class="form-control col-6" value="<?=($student->fees_type==0?$annual_fees/2:$annual_fees)?>" readonly>
								<span style="position: absolute;margin-top: -40px;margin-right: 200px"><?=($student->fees_type==0?'نصف فیس':'مکمل فیس')?></span>
							</td>
						</tr>
						<tr>
							<th>صفحہ نمبر :</th>
							<td>
								<input type="number" id="page_number" name="page_number" class="form-control col-6" value="<?=$student->page_number?>" <?=(!empty($student->paid==1)?'readonly':null)?> min="1" autofocus tabindex="1">
							</td>
						</tr><tr>
							<th>کیفیت :</th>
							<td><?= $student->remarks ?></td>
						</tr>

					</table>
					<h3>نوٹ: فیس کی شرح تبدیل کرنے کے لئے طالب علم کے فارم میں جائیں۔</h3>
					<?php if ($student->paid==1):?>
						<div class='text-center'>
							<div class="text-success text-center h1">وصول شدہ</div>
							<a target="_blank" class="btn btn-dark" href="<?= site_url('Fees/print_fees_voucher/'.$student->fees_id) ?>">
								<i class="fa fa-print"></i>
							</a>
						</div>
					<?php elseif ($student->paid == ''): ?>
						<div id='hide' class='m-t-30 text-center'>
							<button id='submit' type='submit' class='btn btn-success mt-2' tabindex='3'>
								<i class='fa fa-money'>&nbsp;</i>
								فیس وصول کریں
							</button>
						</div>
					<?php endif; ?>

					<input type="hidden" name="student_id" value="<?=$student->student_id?>">
					<input type="hidden" name="gr_number" value="<?=$student->gr_number?>">
				</form>
			<?php }
			} else {
				echo '<h4 style="text-align: center;margin-top: 100px">اس سال میں ابھی تک فیس ترتیب نہیں دی گئی</h4>';
			} ?>
		</div>
	</div>
</div>
<script>

$(document).ready(function () {

	// =============	Prevent submit form on ENTER and focus next box ============//

	$('#page_number').keydown(function(e) {
		if (e.keyCode == 13) {
			var inputs = $(this).parents('#form').eq(0).find(':input');
			if (inputs[inputs.index(this) + 1] != null) {
				inputs[inputs.index(this) + 1].focus();
			}
			e.preventDefault();
		}
	});

	$('#page_number').focus();

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
	$('#date').html(today);

	$('#save').click(function (e){

		e.preventDefault();
		var error=0;
		if($('#page_number').val()=="")
		{
			error=1;
			$('#page_number_error').html('صفحہ نمبر درج کریں');
		}
		if($('#received').val()=="")
		{
			error=1;
			$('#received_error').html('فیس کی رقم درج کریں');
		}
		if (error==0){
			$('#form').submit();
		}
	});

	$('#receive_fees_active>a').addClass('active');
});

</script>
