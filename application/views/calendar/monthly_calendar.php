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
							<th>شمسی تاریخ</th>
						</tr>
						</thead>
						<tbody id="listRecords">
						<?php
						$sn = 1;
						foreach ($last_monthly_dates as $date):

							$month = substr($date->Qm_date, 5, 2);
							$year = substr($date->Qm_date, 0, 5);
							$monthly_date = $year.$month ;
							?>
							<tr>
								<td><?=$sn++?></td>
								<td><?=$date->Qm_date?></td>
								<td><?=$date->Sh_date?></td>
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
