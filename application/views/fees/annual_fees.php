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
			<form method="post" action="<?=site_url('Fees/generate_annual_fees') ?>">
				<div class="row">
					<div class="col-12">
						<div class="card-box">
							<h2 class="text-center">
								  سالانہ فیس کی ترتیب
							</h2>
						</div>
					</div>
				</div>
				<div id="hide" class="row" style="display: none">
					<div class="col-md-2">
						<div class="form-admission_numberoup">
							<label for="amount">فیس کی رقم </label>
							<input type="number" id="amount" name="amount" class="form-control" required>
						</div>
					</div>
					<div class="m-t-30 text-center" >
						<button type="submit" class="btn btn-success mt-2 ">
							<i class="fa fa-save">&nbsp;</i>
							محفوظ کریں
						</button>
					</div>
				</div>
			</form>
			<div class="row">
				<div class="col-md-4 m-auto">
					<?php if(!empty($annual_fees)) { ?>
					<table class="table table-bordered dark-border" align="center">
						<thead>
						<tr align="center">
							<th>سال</th>
							<th>فیس</th>
							<th>عمل</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td style="text-align: center;padding-top: 12px">
									<?=$annual_fees->ac_year?>
								</td>
								<td style="text-align: center;line-height: 45px;font-weight: bolder">
									<?=$annual_fees->amount?>
								</td>
								<td>
									<center>
										<button id="edit" class="btn bg-custom text-white" data-id="<?=$annual_fees->id?>">
											<span class="fa fa-edit"></span>
										</button>
									</center>
								</td>
							</tr>
						</tbody>
					</table>
					<?php } else {
						echo '<h4>اس سال میں ابھی تک فیس ترتیب نہیں دی گئی</h4>
								<script>$("#hide").show();</script>';
					} ?>
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
			<form id="form" method="post" action="">
				<div class="modal-body">
					<label for='annual_fees'>سالانہ فیس</label>
					<input type="number" id="edit_amount" name="edit_amount" class="form-control" placeholder="سالانہ فیس" autofocus>
					<p id="error_amount" class="text-danger"></p>
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

	$('#edit').click(function () {

		$('#ModalLabel').html('فیس میں ترمیم کریں');
		$('.modal-header').addClass('bg-custom');
		$('#modal').modal('show');

		var id = $(this).data('id');

		var url = '<?=site_url('Fees/update_annual_fees/')?>'+id;
		$('#form').attr('action',url);

	});

	$('#update').click(function (e){
		e.preventDefault();
		var error=0;
		if($('#edit_amount').val()=="")
		{
			error=1;
			$('#error_amount').html('فیس درج کریں');
		}
		if (error==0)
		{
			$('#form').submit();
		}
	});

	$("#date").change(function () {
		var date = $('#date').val();
		$.ajax({
			type:"GET",
			url:'<?=site_url('Calendar/get_date/')?>'+date,
			success:function(response){
				var data = $.parseJSON(response);
				$('#date_hijri').val(data.date);
			}
		});
	});

	$('.selected_class').change(function (){
		$('#fees_form').show();
	});

	// =============	Prevent submit form on ENTER and focus next box

	$('form date,select,input:not([type="submit"])').keydown(function(e) {
		if (e.keyCode == 13) {
			var inputs = $(this).parents('form').eq(0).find(':input');
			if (inputs[inputs.index(this) + 1] != null) {
				inputs[inputs.index(this) + 1].focus();
			}
			e.preventDefault();
		}
	});

	$('#annual_fees_active>a').addClass('active');

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
	$('#date').attr("max", today);
});

</script>
