<style>
	.table td, .table th {
		text-align: center;
		border: 1px solid #0b0b0b00;
		vertical-align: middle;
	}
	.table td p {
		margin-bottom: 0;
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

		.table td,.table th{
			border: 1px solid black !important;
			color: black;
		}
	}
</style>

<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<form id="form" method="post" action="<?=site_url('Fees/get_fees_list') ?>">
				<div id="hide" class="row">
					<div class="col-md-2">
						<div class="form-admission_numberoup">
							<label for="class">کلاس </label>
							<select id="class" name="class" class="form-control select2" tabindex="1">
								<option value="all" selected>تمام</option>
								<?php foreach ($classes as $class): ?>
									<option <?=(!empty($class_id)&&$class_id==$class->id?'selected':null)?> value="<?= $class->id?>"><?=$class->class_name?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="piad">پیڈ / اَن پیڈ</label>
							<select id="paid" name="paid" class="form-control select2" tabindex="2">
								<option value='paid_unpaid' <?=(!empty($paid_unpaid)&&$paid_unpaid=='paid_unpaid'?'selected':null)?>>پیڈ / اَن پیڈ</option>
								<option value='0' <?=(!empty($paid_unpaid)&&$paid_unpaid=='0'?'selected':null)?>>اَن پیڈ</option>
								<option value='1' <?=(!empty($paid_unpaid)&&$paid_unpaid=='1'?'selected':null)?>>پیڈ</option>
							</select>
							<span class="text-danger pull-right"><p id="paid_unpaid_error"></p></span>
						</div>
					</div>

					<div class="col-md-3 mt-4 pt-3">
						<button id="btn_list" type="submit" class="btn btn-linkedin">
							فہرست
						</button>

						<button class="btn btn-dark" onclick="window.print();return false">
							<i class="fa fa-print"></i>
						</button>
					</div>
				</div>
			</form>

			<div class="row">
				<?php if (!empty($fees_lists)) { ?>
				<div class="col-12">
					<div class="card-box table-responsive">
						<h3 class="text-center">
							تفصیل فیس برائے :
							<?= $class_id == 'all' ? 'تمام اساتذہ کرام' : $this->Class_model->get_class_by_id($class_id)->class_name ?>
						</h3>
						<table class="table table-striped text-center">
							<thead class="thead-dark">
							<tr>
								<th>نمبر شمار</th>
								<th>جی آر نمبر</th>
								<th>نام</th>
								<th>ولدیت</th>
								<th>سرپرست موبائل نمبر</th>
								<th>قابلِ وصول فیس</th>
								<th>وصول فیس</th>
								<th>رسید نمبر</th>
								<th>تاریخ</th>
								<th>کیفیت</th>
								<th class="hidden-print">پرنٹ</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$total_receive = 0;
							$total_amount = 0;
							$sn = 1;
							foreach ($fees_lists as $fees_list): ?>
								<tr>
									<td class="montserrat font-15"><?= $sn++ ?></td>
									<td class="montserrat font-15"><?= $fees_list->gr_number ?></td>
									<td><?= $fees_list->name ?></td>
									<td><?= $fees_list->father_name ?></td>
									<td class="montserrat font-15"><?= $fees_list->guardian_phone ?></td>
									<td class="montserrat font-15">
										<?= number_format($annual_fees) ?>
										<?php $total_amount += $annual_fees ?>
									</td>
									<td class="montserrat font-15">
										<?= number_format($fees_list->received) ?>
										<?php $total_receive += $fees_list->received ?>
									</td>
									<td class="montserrat font-15"><?= $fees_list->voucher_no ?></td>
									<td class="montserrat font-15"><?= !empty($fees_list->date) ? date('d-m-Y', strtotime($fees_list->date)) : null ?></td>
									<td class="font-14"><?= $fees_list->remarks ?></td>
									<td class="hidden-print">
										<?php if (!empty($fees_list->id)):?>
											<a target="_blank" class="btn btn-dark" href="<?= site_url('Fees/print_fees_voucher/'.$fees_list->id) ?>">
												<i class="fa fa-print"></i>
											</a>
										<?php endif;?>

									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th>میزان</th>
								<th class="montserrat-bold"><?= number_format($total_amount) ?></th>
								<th class="montserrat-bold"><?= number_format($total_receive) ?></th>
								<th></th>
								<th></th>
								<th></th>
								<th class="hidden-print"></th>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<script>

$(document).ready(function () {

	$('#btn_list').click(function(){
		var paid = $('#paid').val();
		var class_id = $('#class').val();
		var url = '<?=site_url('Fees/get_fees_list/')?>'+paid+'/'+class_id;
		$('#form').attr('action',url);
	})

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

	$('#fees_list_active>a').addClass('active');

});

</script>
