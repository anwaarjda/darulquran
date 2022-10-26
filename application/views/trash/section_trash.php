<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<!-- end row -->
			<!-- Modal -->
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">سیکشن بنایئں</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">

							<form method="post" action="<?= site_url("section/save_section") ?>">
								<label>کلاس کا نام</label>
								<input type="text" name="Txtname" autofocus placeholder="سیکشن کا نام" class="form-control">

						</div>
						<div class="modal-footer">

							<button type="submit" class="btn btn-primary">محفوظ کریے</button>
						</div>
						</form>
					</div>
				</div>
			</div>
			<!-- end row -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
				کلاس بنایئں
			</button>
			<div class="row">


				<div class="col-12">
					<div class="card-box table-responsive">
						<h3 class="m-t-0 header-title">سیکشن کا ریکارڈ</h3>
						<table id="datatable" class="table table-striped">
							<thead>
							<tr>
								<th class="text-center">نمبر شمار</th>
								<th class="text-center">سیکشن</th>
								<th class="text-center">رتبہ </th>
								<th class="text-center">عمل</th>
							</tr>
							</thead>
							<tbody>
								<?php foreach($sec as $val):
								$record = "";
									if ($val->is_delete=="1" )
									{
										$record = "<p class='text-danger'>حزد شدہ رکارڈ</p>";
									}
									?>
								<tr>
									<td class="text-center"><?= $val->id ?></td>
									<td class="text-center"><?= $val->section ?></td>
									<td class="text-center"><?= $record ?></td>
									<td class="text-center">ِ<i class="fa fa-window-restore"></i> </td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- end row -->
		</div>
		<!-- container -->
	</div>
	<!-- content -->
</div>





