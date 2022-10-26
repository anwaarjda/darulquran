<style>
	.table td:nth-child(1)
	{
		width: 8%;
	}
	.table td:nth-child(4)
	{
		padding: 0 10% 0 10%;
		width: 15%;
	}
</style>
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="col-12">
				<div class="card-box table-responsive">
					<table class="table table-striped table-bordered text-center">
						<thead class="thead-dark">
						<tr>
							<th>نمبر شمار</th>
							<th>قمری تاریخ</th>
							<th>آخری تاریخ</th>
							<th>کیلنڈر</th>
						</tr>
						</thead>
						<tbody id="listRecords">
						<?php
						$sn = 1;
						foreach ($monthly_dates as $date):

							$month = substr($date->Qm_date, 5, 2);
							$year = substr($date->Qm_date, 0, 5);
							$monthly_date = $year.$month ;
							?>
							<tr>
								<form action="<?=site_url('Calendar/save')?>" method="POST">
									<td><?=$sn++?></td>
									<td>
										<div class="form-check-inline">
											<div class="radio radio-success radio-inline">
												<input id="29_<?=$date->id?>" type="radio" name="date"
													   class="form-control" value="29" required="true">
												<label for="29_<?=$date->id?>">
													۲۹
												</label>
											</div>

											<div class="radio radio-success radio-inline">
												<input id="30_<?=$date->id?>" type="radio" name="date"
													 class="form-control" value="30" required="true">
												<label for="30_<?=$date->id?>">
													۳۰
												</label>
											</div>
										</div>
										<?=$monthly_date?></td>
									<td><input type="submit" class="btn btn-success button  mt-2" value="تصحیح کریں"></td>
									<input type="hidden" name="Qm_date" value="<?=$monthly_date?>">
								</form>
							<form method="POST" action="" target="_blank">
								<td>
									<a class="btn btn-purple button fa fa-calendar"
									   href="<?=site_url('Calendar/last_monthly_dates')?>">
								</td>
								<input type="hidden" name="Qm_date" value="<?=$monthly_date?>">
							</form>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		var now = new Date();
		var day = ("0" + now.getDate()).slice(-2);
		var month = ("0" + (now.getMonth() + 1)).slice(-2);
		var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
		$('.todate').val(today);
	});
</script>
