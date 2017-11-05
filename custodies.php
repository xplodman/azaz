<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
include_once "php/functions.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'العهدة';
include_once "layout/header.php";
?>

<body class="animated fadeIn">
<div id="wrapper">
    <?php
    include_once "layout/menu.php";
    ?>
    <div id="page-wrapper" class="gray-bg">
        <?php
        include_once "layout/topbar.php";
        ?>
        <div class="row wrapper border-bottom white-bg page-heading animated fadeInLeftBig">
            <div class="col-sm-4">
                <h2><p>العهدة</p></h2>
            </div>
            <div class="col-sm-8">
                <font face="myFirstFont">
                    <div class="title-action">
                        <button class="btn btn-warning " type="button" data-toggle="modal" data-target="#sub_custody"><i class="fa fa-plus"></i> تخصيم عهدة</button>
                        <button class="btn btn-success " type="button" data-toggle="modal" data-target="#add_custoder"><i class="fa fa-plus"></i> إضافة متعهد</button>
                    </div>
                </font>
            </div>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading animated fadeInRightBig">
            <?php
            $custodies_from_date = date('Y-m-d',strtotime("-$application_setting[payment_from_date] days"));
            $custodies_to_date = date('Y-m-d',strtotime("$application_setting[payment_to_date] days"));
            if (isset($_POST['submit']))
            {
                $from_date=$_POST['from_date'];
                $to_date=$_POST['to_date'];
                $query="
                        Select transaction.id,
                          transaction.date_1,
                          transaction.value,
                          transaction.removed,
                          flag.name As flag_name,
                          site.name As site_name,
                          custoder.id As custoder_id,
                          custoder.name As custoder_name,
                          reason.name As reason_name
                        From transaction
                          Inner Join flag On flag.id = transaction.flag_id
                          Inner Join site On site.id = transaction.site_id
                          Inner Join custoder On custoder.id = transaction.custoder_id
                          Inner Join reason On reason.id = transaction.reason_id
                        Where transaction.date_1 BETWEEN '$from_date' and '$to_date 23:59:59' And transaction.flag_id = 5";
            }else{
                $query="
                        Select transaction.id,
                          transaction.date_1,
                          transaction.value,
                          transaction.removed,
                          flag.name As flag_name,
                          site.name As site_name,
                          custoder.id As custoder_id,
                          custoder.name As custoder_name,
                          reason.name As reason_name
                        From transaction
                          Inner Join flag On flag.id = transaction.flag_id
                          Inner Join site On site.id = transaction.site_id
                          Inner Join custoder On custoder.id = transaction.custoder_id
                          Inner Join reason On reason.id = transaction.reason_id
                        Where transaction.date_1 BETWEEN '$custodies_from_date' and '$custodies_to_date 23:59:59' And transaction.flag_id = 5";
            }
            if(isset($_POST['show_deleted']) && $_POST['show_deleted']==='show_deleted'){

            }else{
                $query .= " and transaction.removed = 0";
            };
            ?>
            <div class="col-sm-12">
                <h2><p>محددات البحث</p></h2>
            </div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group" id="data_1">
                    <font face="myFirstFont">
                        <label class="col-md-1 col-md-offset-1 control-label">من تاريخ</label>
                        <div class="col-sm-3">
                            <div class="input-group date">
                                <input type="text" class="form-control" name="from_date" value="<?php
                                if (isset($from_date)){
                                    echo $from_date;
                                }else{
                                    echo $custodies_from_date;
                                }?>">
                                <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            </div>
                        </div>
                    </font>
                </div>
                <br><br><br><br><br>
                <div class="form-group" id="data_1">
                    <font face="myFirstFont">
                        <label class="col-md-1 col-md-offset-1 control-label">إلى تاريخ</label>
                        <div class="col-sm-3">
                            <div class="input-group date">
                                <input type="text" class="form-control" name="to_date" value="<?php
                                if (isset($to_date)){
                                    echo $to_date;
                                }else{
                                    echo $custodies_to_date;
                                }?>">
                                <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            </div>
                        </div>
                    </font>
                </div>
                <br><br>
                <div class="form-group" id="data_1">
                    <font face="myFirstFont">
                        <label class="col-md-1 col-md-offset-1 control-label">إظهار المحذوف</label>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <div class="i-checks">
                                    <label><input type="checkbox" name="show_deleted" value="show_deleted"></label></div>
                            </div>
                        </div>
                    </font>
                </div>
                <br><br>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-info" type="submit" name="submit">
                            <i class="ace-icon fa fa-search bigger-110"></i>
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="wrapper wrapper-content animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <font face="myFirstFont">
                                <h5>للبحث و مشاهدة حركة العهدة</h5>
                            </font>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="table-responsive">
                                    <table id="example" class=" dataTables-example table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th style="width:4em"></th>
                                            <th>التاريخ</th>
                                            <th>السبب</th>
                                            <th>المبلغ</th>
                                            <th>المتعهد</th>
                                            <th>الموقع</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $result = mysqli_query($con, $query);
                                        while($custodies = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr> <!--info plus-->
                                                <th style="width:1em">
                                                    <a class="btn btn-success btn-circle" type="button" href="custody.php?transaction_id=<?php echo $custodies['id'] ?>"><i class="fa fa-cog"></i></a>
                                                    <?php
                                                    if ($custodies['removed']=="1"){
                                                        ?>
                                                        <button class="btn btn-circle" type="button" data-value="1" onclick="undelete_custody(<?php echo $custodies['id'] ?>)"><i class="fa fa-eye fa-2x"></i></button>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <button class="btn btn-danger btn-circle" type="button" data-value="1" onclick="delete_custody(<?php echo $custodies['id'] ?>)"><i class="fa fa-minus"></i></button>
                                                        <?php
                                                    }
                                                    ?>
                                                </th>

                                                <td class="middle wrap">
                                                    <?php echo $custodies['date_1']; ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php echo $custodies['reason_name']; ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php echo $custodies['value']*-1; ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <a href="custoder.php?custoder_id=<?php echo $custodies['custoder_id']; ?>"><button type='button' class='btn btn-outline btn-info'>
                                                            <?php echo $custodies['custoder_name']; ?>
                                                        </button></a>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php echo $custodies['site_name']; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div>
                <strong>Copyright</strong> We.Code &copy; 2017
            </div>
        </div>
    </div>
</div>
<?php
include_once "layout/modals.php";
?>
<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Select2 -->
<script src="js/plugins/select2/select2.full.min.js"></script>

<!-- Sweet alert -->
<script src="js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>

<!-- Dual Listbox -->
<script src="js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>

<!-- Toastr -->
<script src="js/plugins/toastr/toastr.min.js"></script>

<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>

<script src="js/plugins/dataTables/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            initComplete: function () {
                this.api().columns(':eq(5),:eq(6),:eq(2)').every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            },
            pageLength: 10,
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },

            order: [2, 'desc'],
            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    });
</script>
<script>
    $(document).ready(function() {
        <?php
        if (isset($_GET['backresult'])){
        $backresult=$_GET['backresult'];
        ?>
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.
            <?php
            if ($backresult ==  "1"){
                echo"success('تمت العملية بنجاح')";
            }else{
                echo "error('برجاء إعادة المحاولة', 'لم تتم العملية بنجاح')";
            }
            };?>;

        }, 1300);

    });
</script>

<script>

    $(document).ready(function() {
        $('.dual_select').bootstrapDualListbox({
            selectorMinimalHeight: 160
        });
        $('.chosen-select').chosen({width: "100%"});
        $('.chosen-select2').chosen({width: "200px"});
        $(".category").select2({
            placeholder: "Select a category",
            allowClear: true
        });
        $(".storepros").select2({
            placeholder: "Select a prosecution",
            allowClear: true
        });
        // Setup - add a text input to each footer cell
        $('#example tfoot th').not(':eq(0),:eq(5),:eq(6),:eq(7),:eq(2)').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" />');
        });
        // DataTable
        var table = $('#example').DataTable();
        // Apply the search
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
    });

</script>
<script>
    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'yyyy-m-d'
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 15; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div>' +
            '<input style="width: 50px" type="text" class="form-control" name="quantity[]"/>' +
            '<select class="chosen-select2 form-control" name="category[]">' +
            '<option></option>' +
            <?php
            $query6 = "SELECT * FROM `owncategory`";
            $results6=mysqli_query($con, $query6);
            //loop
            foreach ($results6 as $owncategory){
            ?>
            '<option value="<?php echo $owncategory["owncategoryid"];?>"><?php echo $owncategory["owncategoryname"];?></option>' +
            <?php
            }
            ?>
            '</select>' +
            '<input type="text" style="width: 250px" placeholder="item name" class="form-control" name="itemname[]">' +
            '<button class="btn btn-danger remove_button" type="button">' +
            '<i class="fa fa-minus"></i>' +
            '</button>' +
            '</div>'; //New input field html
        var x = 1; //Initial field counter is 1
        $(addButton).click(function(){ //Once add button is clicked
            if(x < maxField){ //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
                $('.chosen-select2').chosen({width: "200px"});

            }
        });
        $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
<script>
    function delete_custody(id){
        swal({
                title: "هل أنت متأكد؟",
                text: "هذا السجل سيتم حذفه نهائياً!!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "تم حذف السجل بنجاح.", "success");
                    function explode(){
                        window.location.href = "php/delete_custody.php?custody_id="+id;
                    }
                    setTimeout(explode, 1200);
                } else {
                    swal("Cancelled", "تم إيقاف عملية الحذف", "error");
                }
            });
    };
    function undelete_custody(id){
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم إستعادة الملف من سلة المحذوفات!!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, show it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "تم إسترجاع السجل بنجاح.", "success");
                    function explode(){
                        window.location.href = "php/undelete_custody.php?custody_id="+id;
                    }
                    setTimeout(explode, 1200);
                } else {
                    swal("Cancelled", "تم إيقاف عملية الإسترجاع", "error");
                }
            });
    };
</script>

</body>
</html>