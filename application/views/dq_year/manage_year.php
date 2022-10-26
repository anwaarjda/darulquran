<style>
	.table-bordered.dark-border th,
	.table-bordered.dark-border td {
		border: 1px solid black !important;
		color: black;
	}
	.radio label {
		padding-left: 0;
		padding-right: 0;
	}
</style>

<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<h2 class="text-center">
							سال ترتیب دیں
						</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 m-auto">
					<?php if(!empty($years)) { ?>
						<table class="table table-bordered dark-border" align="center">
							<thead>
								<tr align="center">
									<th>قمری سال</th>
									<th>شمسی سال</th>
									<th>کیفیت</th>
									<th>عمل</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($years as $year) { ?>
								<tr>
									<td style="text-align: center;padding-top: 12px">
										<?=numtourdu($year->hijri_year)?>
									</td>
									<td style="text-align: center;padding-top: 12px">
										<?=$year->ac_year?>
									</td>
									<td style="text-align: center;line-height: 45px;font-weight: bolder">
										<?= ($year->status==1)?'<p class="text-success">فعال</p>':
										'<p class="text-danger">غیرفعال</p>'; ?>
									</td>
									<td>
										<div class="radio radio-success radio-inline">
											<input type="radio" class="form-control" name="status" value="<?=($year->status==1)?0:1?>" data-id="<?=$year->id?>" style="width:auto;position: absolute;float: left;margin-top: 18px;margin-right: 3%;">
											<label for="status" style="float: left;margin-top: 14px;"></label>
										</div>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
						<form id="update_form" method="post" action="">
							<center>
								<button class="col-md-6 form-control btn bg-custom text-white edit">
									<span class="fa fa-edit">&nbsp;</span>
									فعال/غیر فعال کریں
								</button>
							</center>
						</form>
					<?php } else {
						echo '<h4>سال ترتیب دیں</h4>';
					} ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function () {

	$('input[type="radio"]').click(function () {

		var id = $(this).data('id');
		var status = $(this).val();
		var url = '<?=site_url('Dq_years/update_year/')?>'+id+'/'+status;
		$('#update_form').attr('action',url);

	});

	$('#dq_years_active').addClass('active');
});

</script>
