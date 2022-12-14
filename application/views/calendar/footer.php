</div>
</div>
</body>
<script src="<?= base_url()."assets/"?>js/jquery-1.12.4.js"></script>
<script src="<?= base_url()."assets/"?>js/bootstrap.min.js"></script>
<script src="<?= base_url()."assets/"?>js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?= base_url()."assets/"?>js/metisMenu/metisMenu.min.js"></script>
<script src="<?= base_url()."assets/"?>js/raphael/raphael.min.js"></script>
<script src="<?= base_url()."assets/"?>js/morris/morris.min.js"></script>
<script src="<?= base_url()."assets/"?>js/sb-admin-2.js"></script>
<script src="<?= base_url()."assets/"?>js/jquery/jquery.dataTables.min.js"></script>
<script src="<?= base_url()."assets/"?>js/bootstrap/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url()."assets/"?>js/jquery.print.js"></script>
<script src="<?= base_url()."assets/"?>pnotify.custom.min.js"></script>
<script src="<?= base_url()."assets/"?>js/select2.min.js"></script>
<script src="<?= base_url()."assets/"?>js/bootstrap-select.min.js"></script>
<script src="<?= base_url()."assets/"?>js/jquery-ui.js"></script>
<script src="<?= base_url()."assets/"?>awesomplete.js"></script>
<script src="<?= base_url()."assets/"?>js/moment.min.js" type="text/javascript" ></script>
<script src="<?= base_url()."assets/"?>js/daterangepicker.js" type="text/javascript" ></script>
<script src="<?= base_url()."assets/"?>js/select2.min.js"></script>
<script src="<?= base_url()."assets/"?>js/modernizr.js" type="text/javascript" ></script>
<script src="<?= base_url()."assets/"?>js/jquery.blockUI.js" type="text/javascript" ></script>
<script>
    $(function(){
        if (!Modernizr.inputtypes.date) {
            $('input[type=date]').datepicker({
                    dateFormat : 'yy-mm-dd'
                }
            );
        }
    });

    $(".js-example-basic-single").select2({
        dir: "rtl"
    });

    $(".js-example-basic-multiple").select2({
        placeholder: "منتخب کریں",
        dir: "rtl"
    });

    $(function() {
        var max_date = function () {
            var tmp = null;
            $.ajax({
                'async': false,
                type:'GET',
                url:'<?= site_url('Accounts/Calendar/getMaxDate')?>',
                success:function(response){
                    var data = $.parseJSON(response);
                    tmp = data.date;
                }
            });
            return tmp;
        }();

        var min_date = function () {
            var temp = null;
            $.ajax({
                'async': false,
                type:'GET',
                url:'<?= site_url('Accounts/Calendar/getMinDate')?>',
                success:function(response){
                    var data = $.parseJSON(response);
                    temp = data.date;
                }
            });
            return temp;
        }();

        $('input[name="daterange"]').daterangepicker({
            "minDate": new Date(min_date),
            "maxDate": new Date(max_date),
            "startDate": moment(),
            "endDate": moment()
        }, function(start, end) {
            $('#to').val(start.format('YYYY-MM-DD'));
            $('#from').val(end.format('YYYY-MM-DD'));
        });
    });
    function getstartdate(){
        var today = new Date();
        var lastWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 9);
        return lastWeek ;
    }

  

    $(document).ready(function() {
        window.parent.document.body.style.zoom = 1;
        $('#dataTables-example').DataTable({
            responsive: true
        });
        $('.typeall').hide();
        $('#datetimepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            todayHighlight:true,
            orientation: "bottom auto",
            rtl:true
        });

        $('#datetimepicker1').datepicker({
            dateFormat: 'yy-mm-dd',
            todayHighlight:true,
            orientation: "bottom auto",
            rtl:true
        });

        $('.input-daterange input').each(function() {
            $(this).datepicker({
                clearDates:false,
                dateFormat: 'yy-mm-dd',
                todayHighlight:true,
                rtl:true
            });
        });

        $(".dataTables_filter input").attr({'lang': 'fa','type': 'hidden', 'id':'data' });
        $(".dataTables_filter label").text('');
        oTable = $('#dataTables-example').DataTable();
        $('#myInputTextField').keyup(function(){
            oTable.search($(this).val()).draw() ;
        });
        $('.dataSave').hide();
        $('#link').hide();
    });

    function recBlur(element) {
        var pay = $(element).val();
        if(!pay){
            $('#payment').removeAttr("disabled");
            $('.dataEdit').attr("disabled",true);
            $('#Editpayment').removeAttr("disabled");
        }else{
            $('#payment').attr("disabled","true");
            $('.dataEdit').removeAttr("disabled");
            $('#Editpayment').attr("disabled","true");
        }
    }

    function payBlur(element) {
        var pay = $(element).val();
        if(!pay){
            $('#recieved').removeAttr("disabled");
            $('.dataEdit').attr("disabled",true);
            $('#Editrecieved').removeAttr("disabled");
        }else{
            $('#recieved').attr("disabled","true");
            $('.dataEdit').removeAttr("disabled");
            $('#Editrecieved').attr("disabled","true");
        }
    }

    var check = '<?= $this->session->userdata('one')?>';
    if(!check){
        $.ajax({
            type:'GET',
            url:'<?= site_url('Accounts/Books/lastCompanyByUser');?>',
            success:function (response) {
                var data = $.parseJSON(response);
                $('.link').text(data.par_name+' - '+data.Name);
                $('#cashComp').html('<a href="#"><i class="fa fa-company fa-fw id"></i>'+data.par_name+' - '+data.Name+'</a>');
                Mycmenu(data);
            }
        });
    }

    var comp_id = '<?= $this->session->userdata('comp');?>';
    $('.comp').on('click',function(e){
        var url = '';
        if('<?= $this->uri->segment(2)?>' != ''){
            url = url + '<?= $this->uri->segment(2).'/';?>';
        }
        if ('<?= $this->uri->segment(3)?>' != ''){
            url = url + '<?= $this->uri->segment(3).'/';?>';
        }
        if ('<?= $this->uri->segment(4)?>' != ''){
            url = url + '<?= $this->uri->segment(4).'/';?>';
        }
        e.preventDefault();
        var compID = $(this).data('id');
        $('#com').val(compID);
        $('.cmenu').empty();
        $('.link').text($(this).text());
        $.ajax({
            type:'GET',
            url:'<?= site_url('Accounts/Books/getCompanyName') ?>'+'/'+compID,
            success:function(response){
                var data = $.parseJSON(response);
                ajaxCall(compID);
                if ('<?= $this->uri->segment(5)?>' != ''){
                    url = url + compID;
                }
//                location.reload();
                window.location = '<?php echo base_url()?>Accounts/'+url;
                Mycmenu(data);
            }
        });
    });

    if(comp_id)
    {
        $.ajax({
            type:'GET',
            url:'<?= site_url('Accounts/Books/getCompanyName') ?>'+'/'+comp_id,
            success:function(response){
                var data = $.parseJSON(response);
                $('.link').text(data.par_name+' - '+data.Name);
            }
        });
    }
    if(comp_id){
        $.ajax({
            type:'GET',
            url:'<?= site_url('Accounts/Books/getCompanyName') ?>'+'/'+comp_id,
            success:function(response){
                var data = $.parseJSON(response);
                ajaxCall(comp_id);
                Mycmenu(data);
            }
        });
    }
    function getBooksByUser(company_id) {
        $.ajax({
            type:'GET',
            url:'<?= site_url('Accounts/Books/getCompanyName') ?>'+'/'+company_id,
            success:function(response){
                ajaxCall(comp_id);
                var data = $.parseJSON(response);
                Mycmenu(data);
            }
        });
    }
    function Mycmenu(data) {
        var Crights = $('#Crigths').val();
        var Brights = $('#Brigths').val();
        var Jrights = $('#Jrigths').val();
        var ICrigths = $('#ICrigths').val();
        if (Crights){
            if (Crights == '1'){
                $('.cmenu')
                    .append($("<li class='active'>").append($("<a>").attr("href","<?= site_url('Accounts/Books/AllBooks/') ?>"+'cr'+"/"+data.id).text(' کیش وصولی ').append($("</a>").append($("</li>")))))
                    .append($("<li class='active'>").append($("<a>").attr("href","<?= site_url('Accounts/Books/AllBooks/') ?>"+'cp'+"/"+data.id).text(' کیش ادائیگی ').append($("</a>").append($("</li>")))));
            }
        }if (Brights){
            if (Brights == '1'){
                $('.cmenu')
                    .append($("<li class='active'>").append($("<a>").attr("href","<?= site_url('Accounts/Books/AllBooks/') ?>"+'br'+"/"+data.id).text(' بینک وصولی ').append($("</a>").append($("</li>")))))
                    .append($("<li class='active'>").append($("<a>").attr("href","<?= site_url('Accounts/Books/AllBooks/') ?>"+'bp'+"/"+data.id).text(' بینک ادائیگی  ').append($("</a>").append($("</li>")))));
            }
        }if (Jrights){
            if (Jrights == '1'){
                $('.cmenu')
                    .append($("<li class='active'>").append($("<a>").attr("href","<?= site_url('Accounts/Books/AllBooks/') ?>"+'jv'+"/"+data.id).text(' جنرل جرنل ').append($("</a>").append($("</li>")))))
            }
        }if (ICrigths){
            if (ICrigths == '1'){
                $('.cmenu')
                    .append($("<li class='active'>").append($("<a>").attr("href","<?= site_url('Accounts/Books/AllBooks/') ?>"+'inc'+"/"+data.id).text(' آمدنی واؤچر ').append($("</a>").append($("</li>")))))
            }
        }
        if (<?= $_SESSION['user'][0]->IsAdmin;?> == 1){
            $('.cmenu')
                .append($("<li class='active'>").append($("<a>").attr("href","<?= site_url('Accounts/Books/AllBooks/') ?>"+'cr'+"/"+data.id).text(' کیش وصولی ').append($("</a>").append($("</li>")))))
                .append($("<li class='active'>").append($("<a>").attr("href","<?= site_url('Accounts/Books/AllBooks/') ?>"+'cp'+"/"+data.id).text(' کیش ادائیگی ').append($("</a>").append($("</li>")))))

                .append($("<li class='active'>").append($("<a>").attr("href","<?= site_url('Accounts/Books/AllBooks/') ?>"+'br'+"/"+data.id).text(' بینک وصولی ').append($("</a>").append($("</li>")))))
                .append($("<li class='active'>").append($("<a>").attr("href","<?= site_url('Accounts/Books/AllBooks/') ?>"+'bp'+"/"+data.id).text(' بینک ادائیگی  ').append($("</a>").append($("</li>")))))

                .append($("<li class='active'>").append($("<a>").attr("href","<?= site_url('Accounts/Books/AllBooks/') ?>"+'jv'+"/"+data.id).text(' جنرل جرنل ').append($("</a>").append($("</li>")))))
                .append($("<li class='active'>").append($("<a>").attr("href","<?= site_url('Accounts/Books/AllBooks/') ?>"+'inc'+"/"+data.id).text(' آمدنی واؤچر ').append($("</a>").append($("</li>")))))
        }
    }

    function ajaxCall(company_id) {
        $.ajax({
            type:'GET',
            url:'<?= site_url('Accounts/Books/getCompanyName') ?>'+'/'+company_id,
            success:function(responseeee){
                var datass = $.parseJSON(responseeee);
                $('#cashComp').html('<a href="#" data-id='+datass.id+' ><i class="fa fa-company fa-fw id"></i>'+datass.par_name+' - '+datass.Name+'</a>');
            }
        });
    }

    //header js
    $('.year').on('click',function(e){
        e.preventDefault();
        var year = $(this).data('id');
        var current_year = '<?= $this->session->userdata('current_year');?>';
        if(current_year != year){
            $.ajax({
                url:'<?= site_url('Accounts/Dashboard/setYear');?>'+'/'+year,
                dataType:'json',
                success:function (response) {
                    if(response == '1'){
                        location.reload();
                    }
                }
            })
        }
    });

    //End header Js

    $.fn.extend({
        treed: function (o) {
            var openedClass = 'glyphicon-minus-sign';
            var closedClass = 'glyphicon-plus-sign';

            if (typeof o != 'undefined'){
                if (typeof o.openedClass != 'undefined'){
                    openedClass = o.openedClass;
                }
                if (typeof o.closedClass != 'undefined'){
                    closedClass = o.closedClass;
                }
            }

            //initialize each of the top levels

            var tree = $(this);
            tree.addClass("tree");
            tree.find('li').has("ul").each(function () {
                var branch = $(this); //li with children ul
                branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                branch.addClass('branch');
                branch.on('click', function (e) {
                    if (this == e.target) {
                        var icon = $(this).children('i:first');
                        icon.toggleClass(openedClass + " " + closedClass);
                        $(this).children().children().toggle();
                    }
                });
                branch.children().children().toggle();
            });
            //fire event from the dynamically added icon
            tree.find('.branch .indicator').each(function(){
                $(this).on('click', function () {
                    $(this).closest('li').click();
                });
            });
            //fire event to open branch if the li contains an anchor instead of text
            tree.find('.branch>a').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                    e.preventDefault();
                });
            });
            //fire event to open branch if the li contains a button instead of text
            tree.find('.branch>button').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                    e.preventDefault();
                });
            });
        }
    });

    //Initialization of treeviews

    $('#tree1').treed();
    $('#tree').treed();

    $('input[type=number]').on('keydown', function(e) {
        if ( e.which == 38 || e.which == 40 || e.which == 69 )
            e.preventDefault();
    });

    var update = $('#userID').data('id');
    if(update == 'y'){
        runOncePerDay();
    }

    /**
     * For Hijri Date Auto Update
     */

    function runOncePerDay(){
        var today = new Date().toLocaleDateString();
        if( localStorage.yourapp_today == today ) return;
        localStorage.yourapp_today = today;
        var UserId = $('#userID').val();
        if(UserId == 1) {
            $(window).load(function () {
                new PNotify({
                    title: 'حجری تاریخ کی تصدیق کیجیے!',
                    text: 'آج کیا تاریخ ہے؟',
                    icon: 'glyphicon glyphicon-question-sign',
                    hide: false,
                    type: "success",
                    confirm: {
                        confirm: true,
                        buttons: [
                            {
                                text: "یکم(01)",
                                addClass: "",
                                promptTrigger: true,
                                click: function (notice, value) {
                                    notice.remove();
                                    notice.get().trigger("pnotify.confirm", [notice, value]);
                                }
                            },
                            {
                                text: "تیس (30)",
                                addClass: "",
                                click: function (notice) {
                                    notice.remove();
                                    notice.get().trigger("pnotify.cancel", notice);
                                }
                            }
                        ]
                    },
                    buttons: {
                        closer: false,
                        sticker: false
                    },
                    history: {
                        history: false
                    },
                    addclass: 'stack-modal',
                    stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
                }).get().on('pnotify.confirm', function () {
                    var NewDate = '1';
                    window.location = '/Accounts/Calendar/update/' + NewDate;
                }).on('pnotify.cancel', function () {
                    var NewDate = '30';
                    window.location = '/Accounts/Calendar/update/' + NewDate;
                });
            });
        }
    }
    $(document).ready(function () {
        var comp = <?= isset($this->session->comp)?$this->session->comp:0;?>;

        setTimeout(function () {
            if(comp == 0){
                $(".link").html('<span><i class="fa fa-link fa-fw"></i>-کمپنی</span>');
                alert('برائے مہربانی کمپنی کا انتخاب کریں');
                // e.preventDefault();
            }
        },1000);

    })
</script>
</html>
