<html>

<head>
	<title>فیس واؤچر</title>

	<!-- App CSS -->
	<link href="<?= base_url()?>assets/css/style.css?v=1.1" rel="stylesheet" type="text/css" />
	<link href="<?= base_url()?>assets/css/app-rtl.min.css" rel="stylesheet" type="text/css" />

	<style>
		body {
			font-family: 'jameel noori nastaleeq';
			font-size: 20px;
			padding: 10px;
			text-align: center;
		}

		.main-div {
			border: 1.5px dashed black;
			width: 500px;
			height: auto;
			margin: 0 auto;
			padding: 5px;
			position: relative;
			text-align: center;
			page-break-after: always;
		}

		table {
			margin: 0 auto;
			border: 1px solid black;
			border-collapse: collapse;
		}

		th, td {
			border: 1px solid black;
			padding: 3px;
			text-align: center;
			font-size: 20px;
		}

		.logo {
			position: absolute;
			right: 15px;
			top: 15px;
		}

		.headings {
			height: auto;
			width: 250px;
			text-align: center;
			margin: auto;
			position: relative;
		}

		.d-inline-block {
			display: inline-block;
		}

		.px-1 {
			padding: 0 5px;
		}

		.phono_number {
			position: absolute;
			left: 5px;
			top: 5px;
			text-align: right;
			font-size: 14px;
		}
	</style>
</head>


<body onload="window.print();setTimeout(function() {window.location.href='<?=site_url('Fees');?>';},1)" dir="rtl">
<?php for ($i=1; $i<=2; $i++): ?>
<div class="main-div">

	<div class="phono_number">
		<div>
			<strong>فون نمبر: </strong>
			<span class="montserrat" dir="ltr">35049774-6</span>
		</div>
		<div>
			<strong>ایکسٹینشن:</strong>
			<span class="montserrat">372</span>
		</div>
	</div>

	<div class="logo">
		<img src="<?= base_url('assets/images/logo.jpeg') ?>" style="width: 100px"/>
	</div>

	<div class="headings">
		<h1 style="margin:auto;font-size: 25px">
			فیس واؤچر
		</h1>
		<h3 style="margin:auto;">
			<?= $i == 1 ? '(برائے دفتری استعمال)' : '(برائے طالب علم)' ?>
		</h3>
		<h1 style="margin:auto;font-size: 25px;padding-top: 5px">
			دارالقرآن
		</h1>
		<h4 style="margin:auto;border-bottom: 2px black dashed;font-size: 21px;padding-bottom: 10px">
		شعبہ جامعہ دارلعلوم کراچی
		</h4>
	</div>

	<div class="row my-2">
		<div style="width: 32%; display: inline-block">
			<strong>تاریخ:</strong>
			<span class="d-inline-block montserrat px-1"><?= date('d-m-Y', strtotime($students->date)) ?></span>
		</div>

		<div style="width: 27%; display: inline-block">
			<strong>وقت:</strong>
			<span class="d-inline-block montserrat px-1"><?= date('h:i', strtotime($students->date)) ?></span>
		</div>

		<div style="width: 37%; display: inline-block">
			<strong class="text-center">واؤچر نمبر :</strong>
			<span class="d-inline-block montserrat px-1"><?= $students->voucher_no ?></span>
		</div>
	</div>

	<table width="100%" style="page-break: avoid !important;">

		<tr>
			<th>نام</th>
			<td>
				<span><?=$students->name?></span>
			</td>

			<th>ولدیت</th>
			<td>
				<span><?=$students->father_name?></span>
			</td>
		</tr>

		<tr>
			<th> متعلقہ استاذ</th>
			<td>
				<span><?= $students->class_name ?></span>
			</td>

			<th> جی آر نمبر</th>
			<td>
				<span class="montserrat"><?= $students->gr_number ?></span>
			</td>
		</tr>

		<tr>
			<th>وصول کردہ رقم کی مد</th>
			<td>فیس داخلہ سالانہ</td>

			<th>نوعیت داخلہ</th>
			<td><?= $students->admission_type == 'old' ? 'قدیم' : 'جدید' ?></td>
		</tr>

		<tr>
			<th>قابل وصول فیس</th>
			<td>
				<span class="montserrat"><?= $students->amount ?></span>
				روپے
			</td>

			<th>وصول فیس</th>
			<td>
				<span class="montserrat"><?= $students->received ?></span>
				روپے
			</td>
		</tr>

		<?php if (!empty($students->remarks)): ?>
			<tr>
				<td>کیفیت</td>
				<td colspan="3">
					<span><?= $students->remarks ?></span>
				</td>
			</tr>
		<?php endif; ?>

		<tr>
			<td colspan="6" class="text-right py-5 mr-2">
				<div style="position: relative">
					<div>دستخط وصول کنندہ________________</div>
					<div style="position: absolute;left: 40px"><?= $students->user_name ?></div>
				</div>
			</td>
		</tr>
	</table>
</div>
<?php endfor;?>
</body>
</html>

<script>
	$(document).ready(function (){

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
		$('#date').html(today);

	})
</script>
