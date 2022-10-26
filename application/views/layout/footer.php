<style>
	#toast-container > div
	{
		opacity: 1 !important;
	}
	.custom-modal-title
	{
		background-color: darkred;
		font-size: 27px;
	}
</style>

<!-- Modal -->
<div id="password-modal" class="modal-demo bg-warning text-dark">
	<button type="button" class="close" onclick="Custombox.close();">
		<span>&times;</span><span class="sr-only">Close</span>
	</button>
	<h3 class="custom-modal-title">تصدیق</h3>
	<form action="<?= site_url('User/change_password/');?>" method="post">
		<div class="form-group form-inline p-1 m-1">
			<label class="col-md-3" for="old_password">پرانا پاس ورڈ:</label>
			<input type="password" name="old_password" id="old_password" placeholder="پاس ورڈ"  class="col-md-9 form-control mb-1" autocomplete="off" required>
		</div>

		<div class="form-group form-inline p-1 m-1">
			<label class="col-md-3" for="password">نیا پاس ورڈ:</label>
			<input type="password" name="password" id="password" placeholder="نیا پاس ورڈ"  class="col-md-9 form-control mb-1" autocomplete="off" required>
		</div>

		<div class="text-left">
			<button type="submit" class="btn btn-dark mb-1 ml-1" style="font-size: larger">تبدیل کریں</button>
			<button type="button" class="btn btn-success mb-1" onclick="Custombox.close();">
				بند کریں
			</button>
		</div>
	</form>
</div>
<footer class="footer font-14 text-body text-center montserrat-bold" style="right: 0px !important;">
	Developed By I.T Team of Jamia Darululoom Karachi
</footer>

<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->

<script src="<?= base_url()?>assets/js/popper.min.js"></script><!-- Tether for Bootstrap -->
<script src="<?= base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url()?>assets/js/detect.js"></script>
<script src="<?= base_url()?>assets/js/fastclick.js"></script>
<script src="<?= base_url()?>assets/js/jquery.blockUI.js"></script>
<script src="<?= base_url()?>assets/js/waves.js"></script>
<script src="<?= base_url()?>assets/js/jquery.nicescroll.js"></script>
<script src="<?= base_url()?>assets/js/jquery.scrollTo.min.js"></script>
<script src="<?= base_url()?>assets/js/jquery.slimscroll.js"></script>
<script src="<?= base_url()?>assets/plugins/switchery/switchery.min.js"></script>
<script src="<?= base_url()?>assets/plugins/custombox/js/custombox.min.js"></script>
<script src="<?= base_url()?>assets/js/daterangepicker.js"></script>
<!--<script src="--><?//= base_url()?><!--assets/js/jquery-ui-1.12.0.min.js"></script>-->

<!-- Counter Up  -->
<script src="<?= base_url()?>assets/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="<?= base_url()?>assets/plugins/counterup/jquery.counterup.min.js"></script>

<!-- App js -->
<script src="<?= base_url()?>assets/js/jquery.core.js"></script>
<script src="<?= base_url()?>assets/js/jquery.app.js"></script>

<!--Toaster-->
<script src="<?= base_url()?>assets/plugins/toastr/toastr.min.js"></script>
<!--Toaster End-->

<!--Data table-->
<script src="<?= base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!--Data table end-->

<!--advance form-->
<script src="<?= base_url()?>assets/plugins/multiselect/js/jquery.multi-select.js"></script>
<script src="<?= base_url()?>assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?=base_url('assets/js/jquery.inputmask.bundle.js')?>"></script>

<!--Form advance-->
<script src="<?= base_url()?>assets/pages/jquery.formadvanced.init.js"></script>
<script src="<?= base_url()?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<!--Form advance end-->


<!--advance form end-->
<!--Data table script-->
<!--toastr script-->
<script type="text/javascript">
    $(function () {
        var i = -1;
        var toastCount = 0;
        var $toastlast;

        var getMessage = function () {
            var msgs = ['My name is Inigo Montoya. You killed my father. Prepare to die!',
                'Are you the six fingered man?',
                'Inconceivable!',
                'I do not think that means what you think it means.',
                'Have fun storming the castle!'
            ];
            i++;
            if (i === msgs.length) {
                i = 0;
            }

            return msgs[i];
        };

        var getMessageWithClearButton = function (msg) {
            msg = msg ? msg : 'Clear itself?';
            msg += '<br /><br /><button type="button" class="btn btn-secondary clear">Yes</button>';
            return msg;
        };

        $('#showtoast').click(function () {
            var shortCutFunction = $("#toastTypeGroup input:radio:checked").val();
            var msg = $('#message').val();
            var title = $('#title').val() || '';
            var $showDuration = $('#showDuration');
            var $hideDuration = $('#hideDuration');
            var $timeOut = $('#timeOut');
            var $extendedTimeOut = $('#extendedTimeOut');
            var $showEasing = $('#showEasing');
            var $hideEasing = $('#hideEasing');
            var $showMethod = $('#showMethod');
            var $hideMethod = $('#hideMethod');
            var toastIndex = toastCount++;
            var addClear = $('#addClear').prop('checked');

            toastr.options = {
                closeButton: $('#closeButton').prop('checked'),
                debug: $('#debugInfo').prop('checked'),
                newestOnTop: $('#newestOnTop').prop('checked'),
                progressBar: $('#progressBar').prop('checked'),
                positionClass: $('#positionGroup input:radio:checked').val() || 'toast-top-right',
                preventDuplicates: $('#preventDuplicates').prop('checked'),
                onclick: null
            };

            if ($('#addBehaviorOnToastClick').prop('checked')) {
                toastr.options.onclick = function () {
                    alert('You can perform some custom action after a toast goes away');
                };
            }

            if ($showDuration.val().length) {
                toastr.options.showDuration = $showDuration.val();
            }

            if ($hideDuration.val().length) {
                toastr.options.hideDuration = $hideDuration.val();
            }

            if ($timeOut.val().length) {
                toastr.options.timeOut = addClear ? 0 : $timeOut.val();
            }

            if ($extendedTimeOut.val().length) {
                toastr.options.extendedTimeOut = addClear ? 0 : $extendedTimeOut.val();
            }

            if ($showEasing.val().length) {
                toastr.options.showEasing = $showEasing.val();
            }

            if ($hideEasing.val().length) {
                toastr.options.hideEasing = $hideEasing.val();
            }

            if ($showMethod.val().length) {
                toastr.options.showMethod = $showMethod.val();
            }

            if ($hideMethod.val().length) {
                toastr.options.hideMethod = $hideMethod.val();
            }

            if (addClear) {
                msg = getMessageWithClearButton(msg);
                toastr.options.tapToDismiss = false;
            }
            if (!msg) {
                msg = getMessage();
            }

            $('#toastrOptions').text('Command: toastr["'
                + shortCutFunction
                + '"]("'
                + msg
                + (title ? '", "' + title : '')
                + '")\n\ntoastr.options = '
                + JSON.stringify(toastr.options, null, 2)
            );

            var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
            $toastlast = $toast;

            if (typeof $toast === 'undefined') {
                return;
            }

            if ($toast.find('#okBtn').length) {
                $toast.delegate('#okBtn', 'click', function () {
                    alert('you clicked me. i was toast #' + toastIndex + '. goodbye!');
                    $toast.remove();
                });
            }
            if ($toast.find('#surpriseBtn').length) {
                $toast.delegate('#surpriseBtn', 'click', function () {
                    alert('Surprise! you clicked me. i was toast #' + toastIndex + '. You could perform an action here.');
                });
            }
            if ($toast.find('.clear').length) {
                $toast.delegate('.clear', 'click', function () {
                    toastr.clear($toast, {force: true});
                });
            }
        });

        function getLastToast() {
            return $toastlast;
        }

        $('#clearlasttoast').click(function () {
            toastr.clear(getLastToast());
        });
        $('#cleartoasts').click(function () {
            toastr.clear();
        });
    })
</script>

<!--toastr script end-->

<script type="text/javascript">
    $(document).ready(function() {

		//Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf']
        });

        // Key Tables

        $('#key-table').DataTable({
            keys: true
        });

        // Responsive Datatable
        $('#responsive-datatable').DataTable();

        // Multi Selection Datatable
        $('#selection-datatable').DataTable({
            select: {
                style: 'multi'
            }
        });


		<?php if ($this->session->flashdata('error_msg')):?>
        toastr['error']('<?= $this->session->flashdata('error_msg')?>');
		<?php endif;?>

		<?php if ($this->session->flashdata('success_msg')):?>
        toastr['success']('<?= $this->session->flashdata('success_msg')?>');
		<?php endif;?>

		<?php if ($this->session->flashdata('duplicate_entry')):?>
        toastr['error']('<?= $this->session->flashdata('duplicate_entry')?>');
		<?php endif;?>
    });


    $(":input").inputmask();

    /*phone Number Masking*/
    $(":input").inputmask();
    $(".phone").inputmask({"mask": "999-99999999"});
	/*End*/

	/*Mobile Number Masking*/
	$(":input").inputmask();
	/*Mobile masking end*/

	// on first focus (bubbles up to document), open the menu
	$(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
		$(this).closest(".select2-container").siblings('select:enabled').select2('open');
	});

	// steal focus during close - only capture once and stop propogation
	$('select.select2').on('select2:closing', function (e) {
		$(e.target).data("select2").$selection.one('focus focusin', function (e) {
			e.stopPropagation();
		});
	});

</script>


