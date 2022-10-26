<style>
	.table thead th {
		vertical-align: middle;
	}
@media print {
	#hide {
	display: none !important;
	}
	.invoice-box table tr.info {
	border: none;
	}

	.invoice-box table tr.info .td1 .td2 {
	border: none;
	display: inline-block;
	}

	.content {
	/*margin-right: -10%;*/
	/*padding-left: -3%;*/
	}

	.table-responsive {
	border: 0;
	overflow-x: hidden;
	}

	.panel {
	border: 0;
	}

	.lbl {
	width: 100%;
	margin: 0 90% 0 0;
	}

	.heading {
	margin-left: 40px;
	}

	.table-bordered.dark-border, .table-bordered.dark-border th,
	.table-bordered.dark-border td {
	border: 1px solid black !important;
	color: black;
	}

	.table tr th span{
	color :black;
	}
}
</style>
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card-box table-responsive">
						<h2 class="text-center">فہرستِ طلباء</h2>
						<h4 class="text-center">
							برائے"<?=(!empty($students_by_class[0]->class_name)&&$students_by_class[0]->ac_year==$this->ac_year?$students_by_class[0]->class_name.'('.$students_by_class[0]->darja.')':$this->ac_year)?>"
							<br>
						</h4>
						<h4 class="text-center">
							سال : <?=numtourdu($this->hijri_year)?>
							۔۔۔
							(<?= $this->session->ac_year  ?>)
						</h4>
						<h5 class="text-center"> کُل طلباء : <?=numtourdu($count_students_by_class->students)?></h5>
						<table class="table table-striped table-bordered dark-border">
							<thead>
								<tr>
									<th class="text-center">نمبر شمار</th>
									<th class="text-center">جی آر نمبر</th>
									<th class="text-center">داخلہ نمبر</th>
									<th class="text-center">نام</th>
									<th class="text-center">ولدیت</th>
									<th class="text-center">پتہ</th>
									<th class="text-center" style="width: 125px"> سرپرست کا موبائل نمبر</th>
									<th class="text-center" style="width: 100px">تاریخ ِداخلہ</th>
									<th class="text-center">قدیم/جدید</th>
									<th class="text-center hidden-print">تفصیل</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if (!empty($students_by_class)){
							$sn = 1;
							foreach ($students_by_class as $list):
							?>
							<tr>
								<td class="text-center align-middle montserrat font-15"><?= $sn++ ?></td>
								<td class="text-center align-middle montserrat font-15"><?= $list->gr_number ?></td>
								<td class="text-center align-middle montserrat font-15"><?= $list->admission_number ?></td>
								<td class="text-center align-middle"><?= $list->name?></td>
								<td class="text-center align-middle"><?= $list->father_name?></td>
								<td class="text-center align-middle"><?= $list->address?></td>
								<td class="text-center align-middle montserrat font-15"><?=$list->guardian_phone?></td>
								<td class="text-center align-middle montserrat font-15 rtl"><?= date('d-m-Y',strtotime($list->date))?></td>
								<td class="text-center align-middle"><?=($list->admission_type=='new'?'جدید':'قدیم')?></td>
								<td class="text-center align-middle hidden-print">
									<a type="button" class="btn btn-md btn-primary list_class"
									   href="<?=base_url("Student/detail_student/$list->student_id");?>" target="_blank">
										تفصیل
									</a>
								</td>
							</tr>
							<?php endforeach;
							} else {
								echo '<p class="h3 text-center">اس کلاس میں طالب علم نہیں ہیں</p>';
							} ?>
							</tbody>
						</table>
						<center>
							<button id="hide" class="btn btn-github" onclick="myFunction()">
								<i class="fa fa-print"></i>
							</button>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function myFunction() {
		window.print();
	}

	$(document).ready(function(){
		// $('.has_sub>#classes_active').addClass('active');
		// $('.has_sub>a').addClass('subdrop');
		$('#classes_active').addClass('active');
		$('#classes_active>a').addClass('active');
	})
</script>
