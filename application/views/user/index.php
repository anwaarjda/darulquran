<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
                    <button type="button" id="add_user" class="btn btn-success waves-effect waves-light mb-1">
                       <span class="btn-label">
                           <i class="fa fa-plus"></i>
                       </span>
                        نیا اندراج
                    </button>
					<div class="card-box table-responsive">
						<h1 class="m-t-0 text-center">
                            <i class="fa fa-user"></i>
                            استعمال کنندہ
                        </h1>
						<table class="table table-bordered table-striped">
							<thead class="thead-dark">
								<tr>
									<th class="text-center">نمبر شمار</th>
									<th class="text-center">یوزر</th>
									<th class="text-center">نام</th>
									<th class="text-center">موبائل نمبر</th>
									<th class="text-center">ای میل</th>
									<th class="text-center">قسم</th>
									<th class="text-center">فعال/غیر فعال</th>
									<th class="text-center">عمل</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$sn=1;
							foreach ($users as $user):?>
							<tr>
								<td class="text-center"><?=$sn++?></td>
								<td class="text-center"><?=$user->username?></td>
								<td class="text-center"><?=$user->first_name?></td>
								<td class="text-center"><?=$user->phone?></td>
								<td class="text-center"><?=$user->email?></td>
								<td class="text-center"><?=$user->description?></td>
								<td class="text-center"><?=($user->active==1)?'فعال':'غیر فعال'?></td>
								<td class="text-center">
									<button type="button" class="btn btn-sm bg-custom text-white edit_user" data-id="<?= $user->id ?>">
										<i class="fa fa-edit"></i>
									</button>
								</td>
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
														<!-- Modal -->
<div class="modal fade" id="Model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-success text-white" id="modal-header">
				<h4 class="modal-title" id="">
                    <i class="fa fa-pencil mr-2"></i>
                    <span id="exampleModalLongTitle">
                    اندراج فارم
                    </span>
                </h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form" class="form-inline" action="<?= site_url("user/add_user") ?>">
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-3">یوزر</label>
						<input type="text" name="name" id="name" placeholder="یوزر"  class="col-md-9 form-control mb-1" required>

                        <label class="col-md-3">نام</label>
						<input type="text" name="first_name" id="first_name" placeholder="نام"  class="col-md-9 form-control mb-1" required>

						<label class="col-md-3">موبائل نمبر</label>
						<input type="text" name="mobile" id="mobile" placeholder="موبائل نمبر"  class="col-md-9 form-control mb-1" data-inputmask="'mask': '9999-9999999'" required>

						<label class="col-md-3">ای میل</label>
						<input type="email" name="email" id="email" placeholder="ای میل"  class="col-md-9 form-control mb-1" >

						<label class="col-md-3">پاس ورڈ</label>
						<input type="password" name="password" id="password" placeholder="پاس ورڈ"  class="col-md-9 form-control mb-1">

						<label class="col-md-3">فعال/غیرفعال</label>
						<span class="form-group col-md-9">
							<select name="active" id="active" class="form-control mb-1" required>
								<option value="1">فعال</option>
								<option value="0">غیر فعال</option>
							</select>
						</span>

						<label class="col-md-3">گروپ</label>
						<select name="group_id" id="group_id" class="col-md-9 form-control mb-1" required>
							<option value="">Select Group</option>
							<?php
							foreach($groups as $group)
							{
								echo "<option value='$group->id'>$group->description</option>";
							}
							?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="save" class="btn btn-success">
						<i class="fa fa-save"></i>
						محفوظ
					</button>
					<button type="submit" id="update" class="btn bg-custom text-white" style="display: none">
						<i class="fa fa-edit"></i>
						ترمیم
					</button>
					<input type="hidden" id="user_id" value="">
				</div>
			</form>
		</div>
	</div>
</div>
														<!-- Delete Modal-->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h2 class="modal-title font-weight-bold" id="exampleModalLongTitle">یوزر کو حذف کریں</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form" class="form-inline" action="<?= site_url("user/add_user") ?>">
				<div class="modal-body text-danger">
					<h3>کیا آپ اس یوزر کو واقعی حذف کرنا چاہتے ہیں</h3>
				</div>
				<div class="modal-footer">
					<a href="#" id="delete_user" class="btn btn-danger">
						<i class="fa fa-trash-o"></i>
						ہاں
					</a>
					<button type="submit" id="update" class="btn btn-default" data-dismiss="modal">
						<i class="fa fa-edit"></i>
						نہیں
					</button>
					<input type="hidden" id="user_id" value="">
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#add_user').click(function () {
			$('#exampleModalLongTitle').html('اندراج فارم');
            $("#modal-header").removeClass('bg-purple');
            $("#modal-header").addClass('bg-success');
			$('#save').show();
			$('#update').hide();
			$("#name").val('');
			$('#name').prop('readonly',false);
			$("#first_name").val('');
			$("#email").val('');
			$("#mobile").val('');
			$("#password").val('');
			$("#active").val('1').trigger('change');
			$("#group_id").val('');

			var url = '<?= site_url("user/add_user/") ?>';
			$('#form').attr('action',url);
			$("#Model").modal("show");
		});

	    $(".edit_user").click(function ()
		{
			var id = $(this).data('id');
			$('#exampleModalLongTitle').html('ترمیم فارم');
            $("#modal-header").removeClass('bg-success');
            $("#modal-header").addClass('bg-custom');
			$('#save').hide();
			$('#update').show();
			$('#name').prop('readonly',true);
			$.ajax({
				url:'<?=base_url('user/get_user/');?>'+id,
				success:function(response){
					var result = $.parseJSON(response);

					$("#name").val(result[0].username);
					$("#first_name").val(result[0].first_name);
					$("#email").val(result[0].email);
					$("#mobile").val(result[0].phone);
					$("#group_id").val(result[0].group_id).trigger('change');
                    $("#active").val(result[0].active).trigger('change');
                    $("#user_id").val(id);

					var url = '<?= site_url("user/update_user/") ?>'+id;
					$('#form').attr('action',url);
					$("#Model").modal("show");
				}
			});
        });

	    $(".delete_user").click(function () {
			var id = $(this).data('id');
			var url = '<?= site_url("user/delete_user/") ?>'+id;
			$('#delete_user').attr('href',url);
			$("#delete_modal").modal("show");
		});

		$('#save').click(function (){
			$(this).hide()
			setTimeout(function (){
				$('#save').show();
			},5000)
		})
	})
</script>
