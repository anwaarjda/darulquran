<style>
	.table-bordered.dark-border th,
	.table-bordered.dark-border td {
		border: 1px solid black !important;
		color: black;
	}
</style>

<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<form id="add_form" method="post" action="<?=site_url('Area/save') ?>">
				<div class="row">
					<div class="col-12">
						<div class="card-box">
							<h2 class="text-center">
								نیا علاقہ درج کریں
							</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<div class="form-admission_numberoup">
							<label for="area">علاقے کا نام </label>
							<input type="text" id="area" name="area" class="form-control" required>
							<p id="area_error" class="text-danger"></p>
						</div>
					</div>
					<div class="m-t-30 text-center" >
						<button type="submit" id="save" class="btn btn-success mt-2">
							<i class="fa fa-save">&nbsp;</i>
							محفوظ کریں
						</button>
					</div>
				</div>
			</form>
			<div class="row">
				<div class="col-md-4 m-auto">
					<table class="table table-bordered dark-border" align="center">
						<thead>
						<tr align="center">
							<th>نمبر شمار</th>
							<th>علاقے کا نام</th>
							<th>عمل</th>
						</tr>
						</thead>
						<?php $sn=1;
						if(!empty($areas)){
							foreach ($areas as $area) : ?>
							<tbody>
							<tr>
								<td style="text-align: center;padding-top: 12px">
									<?=$sn++?>
								</td>
								<td style="text-align: center;padding-top: 12px">
									<?=$area->area?>
								</td>
								<td>
									<center>
										<button class="btn bg-custom text-white edit" data-id="<?=$area->id?>">
											<span class="fa fa-edit"></span>
										</button>
									</center>
								</td>
							</tr>
							</tbody>
						<?php
							endforeach;
						} ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

											<!-- Update Modal -->

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-white">
				<h4 class="modal-title" id="ModalLabel"> </h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="edit_form" method="post" action="">
				<div class="modal-body">
					<label for='edit_area'>علاقہ</label>
					<input type="text" id="edit_area" name="edit_area" class="form-control" placeholder="علاقے کا نام" autofocus>
					<p id="edit_area_error" class="text-danger"></p>
				</div>
				<div class="modal-footer pull-right">
					<button id="update" type="submit" class="btn btn bg-custom text-white">
						<i class="fa fa-edit">&nbsp;</i>
						ترمیم کریں
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">بند کریں</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#save').click(function (e){

			e.preventDefault();
			var error=0;
			if ($('#area').val()=='')
			{
				error=1;
				toastr['error']('نام درج کریں');
				$('#area_error').html('نام درج کریں');
			}

			if (error==0){
				$('#add_form').submit();
			}
		});

		$('.edit').click(function () {

			$('#ModalLabel').html('ترمیم کریں');
			$('.modal-header').addClass('bg-custom');
			$('#modal').modal('show');


			var id = $(this).data('id');
			var url = '<?=site_url('Area/update/')?>'+id;
			$('#edit_form').attr('action',url);

		});

		$('#update').click(function (e){
			e.preventDefault();
			var error=0;
			if($('#edit_area').val()=="")
			{
				error=1;
				$('#edit_area_error').html('نام درج کریں');
			}
			if (error==0)
			{
				$('#edit_form').submit();
			}
		});
	});

</script>
