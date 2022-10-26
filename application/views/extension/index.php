<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card-box table-responsive">
						<h1 class="m-t-0 text-center text-muted">
                            ایکسٹینشن
                        </h1>
						<table class="table table-bordered table-striped table-sm" id="extension_table">
							<thead class="thead-dark">
							<tr>
								<th class="text-center">نمبر شمار</th>
								<th class="text-center">ایکسٹینشن</th>
								<th class="text-center">نام</th>
								<th class="text-center">شعبہ</th>
								<th class="text-center">آفس/گھر</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$sn = 1;
							foreach ($extension as $row):?>
								<tr>
									<td class="text-center"><?= $sn++ ?></td>
									<td class="text-center "><?= $row->code ?></td>
									<td class="text-center"><?= $row->name ?></td>
									<td class="text-center"><?= $row->department ?></td>
									<td class="text-center"><?= ($row->office_home == 'home') ? 'گھر' : 'آفس' ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
							<tfoot>
							<tr class="bg-dark">
								<th></th>
								<th>ایکسٹینشن</th>
								<th>نام</th>
								<th>شعبہ</th>
								<th>آفس/گھر</th>
							</tr>
							</tfoot>
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

<script>
	$(document).ready(function(){

        // Setup - add a text input to each footer cell
        $('#extension_table tfoot th').each( function () {
            var title = $(this).text();
            if (title == '') return;
            $(this).html( '<input class="form-control" type="text" placeholder="'+title+'" />' );
        } );

        // DataTable
        var table = $('#extension_table').DataTable({
			"language" : {
				"search" : 'تلاش'
			},
			"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            initComplete: function () {
                // Apply the search
                this.api().columns().every( function () {
                    var that = this;

                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );
            }
        });
	})
</script>
