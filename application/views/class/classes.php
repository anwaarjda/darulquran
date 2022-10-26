<style>
	.table th:nth-child(1) {
		width: 8%;
	}
	.table th:nth-child(2) {
		width: 9%;
	}

</style>
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<button type="button" class="btn btn-success m-b-10 add_class" data-toggle="modal">
				<span class="btn-label"><i class="fa fa-plus-circle"></i></span>
				کلاس بنائیں&nbsp;
			</button>
			<div class="row">
				<div class="col-12">
					<div class="card-box table-responsive">
						<h2 class="text-center">کلاسز</h2>
						<h4 style="position: absolute;margin-right: 45%;margin-top: 0.7%;">
							<span class="m-b-20">کُل کلاسز :</span>
							<span class="h4 m-b-20" style="margin-right: 42px;"><?= count($class_lists) ?></span>
						</h4>
						<table id="datatable" class="table table-striped">
							<thead>
								<tr>
									<th class="text-center">نمبر شمار</th>
									<th class="text-center">کلاس نمبر</th>
									<th class="text-center">متعلقہ استاذ</th>
									<th class="text-center">تعدادِ طلباء</th>
									<th class="text-center">درجہ</th>
									<th class="text-center">کیفیتِ کلاس</th>
									<th class="text-center">فہرست</th>
									<th class="text-center">عمل</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$total_students = 0;
							$sn = 1;
							foreach ($class_lists as $class_list):
							$active = '';
							if ($class_list->active==1)
							{
								$status = "<p class='text-success'>فعال</p>";
							}
							elseif($active==0)
							{
								$status = "<p class='text-danger'>غیر فعال</p>";
							}
							?>
							<tr>
								<td class="text-center"><?=numtourdu($sn++) ?></td>
								<td class="text-center"><?=numtourdu($class_list->class_no)?></td>
								<td class="text-center"><?=$class_list->class_name?></td>
								<td class="text-center"><?=$this->Class_model->count_students_by_class($class_list->id)->students;?></td>
								<td class="text-center"><?=$class_list->darja?></td>
								<td class="text-center"><?=$status?></td>
								<td class="text-center">
									<a type="button" class="col-8 btn btn-linkedin classes_list" href='<?=base_url("Classes/get_students_by_class/$class_list->id")?>'>
										فہرست
									</a>
								</td>
								<td class="text-center">
									<button type="button" class="btn bg-custom text-white edit_class" data-id="<?=$class_list->id?>" data-classno="<?=$class_list->class_no ?>" data-class="<?=$class_list->class_name?>" data-darja="<?=$class_list->darja?>" data-active="<?=$class_list->active?>">
										<i class="fa fa-edit"></i>
									</button>
									<?php if($this->group=='admin') {?>
									<button data-id="<?=$class_list->id?>" class="btn btn-danger delete_class">
										<i class="fa fa-remove"></i>
									</button>
									<?php } ?>
								</td>
							</tr>
							<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
												<!-- Update And Save Modal -->

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-white">
				<h4 class="modal-title" id="ModalLabel">ریکارڈ اپ ڈیٹ کریں</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form" method="post" action="<?= site_url('Classes/update_class') ?>">
				<div class="modal-body">
					<label for="class_no">کلاس کا نمبر</label>
					<input type="number" id="class_no" name="class_no" class="form-control" value="" placeholder="کلاس کا نمبر" min="1" tabindex="1">
					<p id="error_class_no" class="text-danger"></p>

					<label for='class_name'>متعلقہ استاذ</label>
					<input type="text" id="class_name" name="class_name" class="form-control" placeholder="متعلقہ استاد" tabindex="2">
					<p id="error_class_name" class="text-danger"></p>

					<label for='darja'>درجہ/کلاس</label>
					<input type="text" id="darja" name="darja" class="form-control" placeholder="درجہ" required tabindex="3">
					<p id="error_darja" class="text-danger"></p>

					<div class="hide">
						<label for='active'>فعال / غیر فعال</label>
						<select id='active' name='active' class="form-control">
							<option value='1'>فعال</option>
							<option value='0'>غیر فعال</option>
						</select>
					</div>
				</div>
				<div class="modal-footer pull-right">
					<button id="save" type="submit" class="btn btn-success">
						<i class="fa fa-save">&nbsp;</i>
						محفوظ کریں
					</button>
					<button id="update" type="submit" class="btn btn-custombg text-white">
						<i class="fa fa-edit">&nbsp;</i>
						ترمیم کریں
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">بند کریں</button>
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
				<h4 class="modal-title font-weight-bold" id="exampleModalLongTitle">کلاس کو حذف کریں؟</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-danger">
				<h5>کیا آپ اس کلاس کو واقعی حذف کرنا چاہتے ہیں؟</h5>
			</div>
			<div class="modal-footer pull-right">
				<a id="delete_class" class="btn btn-danger" href="" >
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
	$(document).ready(function() {

		$('#datatable').DataTable( {
			"retrieve": true,
			"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api(), data;

				// Remove the formatting to get integer data for summation
				var intVal = function ( i ) {
					return typeof i === 'string' ?
							i.replace(/[\$,]/g, '')*1 :
							typeof i === 'number' ?
									i : 0;
				};

				// Total over all pages
				var total = api
						.column(3)
						.data()
						.reduce(function (a, b) {
							return intVal(a) + intVal(b);
						}, 0);

				// Total over this page
				var pageTotal = api
						.column(3, {page: 'current'})
						.data()
						.reduce(function (a, b) {
							return intVal(a) + intVal(b);
						}, 0);

				// Update footer
				$(api.column(3).footer()).html(
						pageTotal +'('+ total +' total)'
				);
			}
		});

		// $('#datatable').DataTable( {
		// 	"retrieve": true,
		// 	"footerCallback": function ( row, data, start, end, display ) {
		// 		var api = this.api(), data;
		//
		// 		// Remove the formatting to get integer data for summation
		// 		var intVal = function ( i ) {
		// 			return typeof i === 'string' ?
		// 				i.replace(/[\$,]/g, '')*1 :
		// 				typeof i === 'number' ?
		// 					i : 0;
		// 		};
		//
		// 		// Total over all pages
		// 		var total = api
		// 				.column(3)
		// 				.data()
		// 				.reduce(function (a, b) {
		// 					return intVal(a) + intVal(b);
		// 				}, 0);
		//
		// 		// Total over this page
		// 		var pageTotal = api
		// 				.column(3, {page: 'current'})
		// 				.data()
		// 				.reduce(function (a, b) {
		// 					return intVal(a) + intVal(b);
		// 				}, 0);
		//
		// 		// Update footer
		// 		$(api.column(3).footer()).html(' <b>تعدادِ طلبہءِ:</b>  موجودہ صفحہ : '+'('+ pageTotal +')  کُل طلباء:('+ total+')');
		// 	}
		// });

		$('.add_class').click(function () {

			$('#ModalLabel').html('نئی کلاس بنائیں');
			$('.modal-header').addClass('bg-success');
			$('.modal-header').removeClass('bg-custom');

			$('#save').show();
			$('#update').hide();
			$('.hide').hide();

			$('#class_name').val('');
			$('#class_no').val('');
			$('#darja').val('');

			$('#active').val('').trigger('change');

			var url = '<?= site_url('Classes/add_class/') ?>';
			$('#form').attr('action',url);

			$('#modal').modal('show');
		});

		$(document).on('click','.edit_class',function () {

			$('#ModalLabel').html('کلاس میں ترمیم کریں');
			$('.modal-header').addClass('bg-custom');
			$('.modal-header').removeClass('bg-success');

			$('#save').hide();
			$('#update').show();
			$('.hide').show();

			var class_name = $(this).data('class');
			$('#class_name').val(class_name);

			var class_no = $(this).data('classno');
			$('#class_no').val(class_no);

			var darja = $(this).data('darja');
			$('#darja').val(darja);

			var active = $(this).data('active');
			$('#active').val(active).trigger('change');

			var class_id = $(this).data('id');
			var url = '<?=site_url('Classes/update_class/')?>'+class_id;
			$('#form').attr('action',url);

			$('#modal').modal('show');
		});

		$(document).on('click','.delete_class',function () {
			var id = $(this).data('id');
			var url = '<?= site_url('Classes/delete_class/') ?>'+id;
			$('#delete_class').attr('href',url);
			$('#delete_modal').modal('show');
		});

		// Prevent submit form on ENTER and focus on next input

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

			if($('#class_no').val()==="")
			{
				error=1;
				$('#error_class_no').html(' نمبر درج کریں');
			}
			if($('#class_name').val()==="")
			{
				error=1;
				$('#error_class_name').html(' نام درج کریں');
			}
			if($('#darja').val()==="")
			{
				error=1;
				$('#error_darja').html(' درجہ کا اندراج کریں');
			}
			if (error==0){
				$('#form').submit();
			}
		});

		$('#class_name').keyup(function(e){
			if($(this).val()!=="")
			{
				$('#error_class_name').hide();
			}
			else
			{
				$('#error_class_name').show();
			}
		});

		$('#class_no').keyup(function(){
			if($(this).val()!=="")
			{
				$('#error_class_no').hide();
			}
			else
			{
				$('#error_class_no').show();
			}
		});

		$('#darja').keyup(function(){
			if($(this).val()!=="")
			{
				$('#error_darja').hide();
			}
			else
			{
				$('#error_darja').show();
			}
		});

		// $('#classes_active>a').addClass('active');
	})
</script>
