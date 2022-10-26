<style>
	.card-box {
		height: auto;
		padding: 10px;
		-webkit-border-radius: 5px;
		border-radius: 5px;
		-moz-border-radius: 5px;
		background-clip: padding-box;
		margin-bottom: 10px;
		background-color: #ffffff;
		box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.06), 0 1px 0 0 rgba(0, 0, 0, 0.02);
	}
	label {
		display: inline-block;
		margin-bottom: 0;
	}
	.mb-4 {
		margin-bottom: .5rem !important;
	}
	table th:nth-child(1) {
		width:8%;
	}
	.title-teacher {
		font-size: 1.5em;
		color: #ff3f34;
		font-weight: 700;
		letter-spacing: 2px;
		display: block;
	}
	.teacher-info div span{
		font-size: 1.4rem;
	}
	.team-gd {
		margin: 5px 0;
		padding: 5px;
		background: #f8f9fa;
		transition: 2s all;
		-webkit-transition: 2s all;
		-moz-transition: 2s all;
		-ms-transition: 2s all;
		-o-transition: 2s all;
		box-shadow: 3px 3px 3px 0 rgb(76 110 245 / 16%);
	}
	ul {
		margin-bottom: 0;
	}
</style>
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<a href="<?=site_url()?>Teacher/add_teacher" class="btn btn-success m-b-10 add">
				<span class="btn-label"><i class="fa fa-plus-circle"></i></span>
				 نیا نام درج کریں
			</a>
			<div class="card-box table-responsive">
				<h2 class="text-center">ممتحن</h2>
				<div class="row px-3">
					<?php
					$sn = 1;
					foreach ($teachers as $teacher):?>
						<div class="col-md-3 team-gd text-center">
							<div class="team-img mb-4">
								<a href="<?=site_url("Teacher/detail_teacher/$teacher->id")?>">
									<?php
									if ($teacher->picture!=''){
										echo "<img style='width:125px; height:125px' class='border border-dark img-fluid rounded-circle' alt='user-image' src='".base_url('assets/images/teacher_pictures/').$teacher->picture."'>";
									} else {
										echo "<img style='width:125px; height:125px' class='border border-dark img-fluid rounded-circle' src='".base_url('assets/images/noimage.jpg')."'/>";
									}
									?>
								</a>
							</div>
							<div class="teacher-info">
								<div class="title-teacher">
									<?=($teacher->active)?'<label class="label label-success h3">فعال</label>':'<label class="label label-danger h3">غیر فعال</label>'?>
								</div>
								<div>
									<label>نام :<?=$teacher->name?><br>ولد:<?=$teacher->fathername?></label>
								</div>
								<div>
									<label>موبائل نمبر:</label><span><?=$teacher->mobile?></span>
								</div>
								<div class="mt-2">
									<ul class="social_section_1info">
										<li style="list-style: none">
											<a class="btn bg-custom text-white" href="<?=site_url("Teacher/edit_teacher/$teacher->id")?>">
												<i class="fa fa-edit"></i>
											</a>
											<?php if($this->group=='admin') { ?>
												<button data-id="<?=$teacher->id?>" class="btn btn-danger delete">
													<i class="fa fa-remove"></i>
												</button>
											<?php } ?>
										</li>
									</ul>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<?php
				if(!empty($links)) { ?>
					<nav style="cursor:default" aria-label="Page navigation example" class="m-2">
						<?=$links?>
					</nav>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
									<!-- Delete Modal-->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h4 class="modal-title" id="exampleModalLongTitle">استاد کی معلومات حزف کریں؟</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-danger">
				<h5>کیا آپ واقعی استاد کی معلومات حزف کرنا چاہتے ہیں؟ </h5>
			</div>
			<div class="modal-footer pull-right">
				<a id="delete" class="btn btn-danger" href="" >
					<i class="fa fa-trash-o">&nbsp;</i>
					ہاں
				</a>
				<button class="btn btn-secondary" data-dismiss="modal">
					<i class="fa"></i>
					نہیں
				</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {

		$('.delete').click(function () {
			var id = $(this).data('id');
			var url = '<?=site_url('Teacher/delete_teacher/')?>'+id;
			$('#delete').attr('href',url);
			$('#delete_modal').modal('show');
		});

// =============	Prevent submit form on ENTER and focus next box

		$('form date,select,input:not([type="submit"])').keydown(function(e) {
			if (e.keyCode !== 13) {
			} else {
				var inputs = $(this).parents('form').eq(0).find(':input');
				if (inputs[inputs.index(this) + 1] != null) {
					inputs[inputs.index(this) + 1].focus();
				}
				e.preventDefault();
				return false;
			}
		});

		$('#save,#update').click(function(e){
			e.preventDefault();
			var error=0;

			if($('.name').val()==="")
			{
				error=1;
				$('#error_name').html(' نام درج کریں');
			}

			if (error==0){
				$('#form').submit();
			}
		});

		$('.name').keyup(function(e){
			if($('.name').val()!=="")
			{
				$('#error_name').hide();
			}
			else
			{
				$('#error_name').show();
			}
		});

		$('#examiner_active>a').addClass('active');

	});
</script>
