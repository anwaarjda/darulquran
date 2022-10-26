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

							<?php
							if (!empty($section))
							{
							foreach ($section as $sec):
								$status = "";
								if($sec->status=="0")
								{
									$status="<p class='text-success'>فعال</p>";
								}
								else
								{
									$status ="<p class='text-danger'>غیر فعال</p>";
								}
								?>
								<tr>
									<td class="text-center"><?= $sec->id ?></td>
									<td class="text-center"><?= $sec->section ?></td>
									<td class="text-center"><?= $status ?></td>
									<td class="text-center"><button type="button" class="btn btn-primary edit_class" data-class="<?= $sec->section ?>" data-id="<?= $sec->id ?>"><i class="fa fa-edit"></i></button>
									<a href="<?= site_url("section/delete/$sec->id") ?>" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
									</td>

								</tr>
							<?php endforeach;
							}
							else
							{
								echo "<tr>
											<td colspan='4' class='text-center'>ریکارڈ موجود نہیں</td>
									  </tr>";
							}


							?>

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
<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">ریکارڈ اپ ڈیٹ کریں</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?= site_url("section/update_section") ?>">
					<label>کلاس کا نام</label>
					<input type="hidden" id="class_id" name="txtId" placeholder="کلاس کا نام" class="form-control">
					<input type="text" id="class_name" name="txtsection" placeholder="سیکشن کا نام" class="form-control">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">بند کریں</button>
				<button type="submit" class="btn btn-primary">تبدیل کریں</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!--Update Record Modal-->
<script>
    $(document).ready(function(){
        $(".edit_class").click(function ()
        {

            var class_name = $(this).data('class');
            var class_id = $(this).data('id');

            $("#class_name").val(class_name);
            $("#class_id").val(class_id);

            $("#update_modal").modal("show");

        })
    })
</script>
<!--Update Record Modal End-->



