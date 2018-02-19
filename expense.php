<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'سجل مصروف';
include_once "layout/header.php";
?>

<?php
if (!isset($_GET['transaction_id'])){
    header("location:javascript://history.go(-1)");
    exit;
}
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
                <h2><p>تفاصيل السجل</p></h2>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <?php
                        $transaction_id=$_GET['transaction_id'];

                        $result=mysqli_query($con, "
                            Select transaction.id,
                          transaction.date_1,
                          transaction.value,
                          transaction.removed,
                          flag.name,
                          site.id As site_id,
                          site.name As site_name,
                          custoder.name As custoder_name,
                          reason.id As reason_id,
                          reason.name As reason_name
                        From transaction
                          Inner Join flag On flag.id = transaction.flag_id
                          LEFT Join site On site.id = transaction.site_id
                          LEFT Join custoder On custoder.id = transaction.custoder_id
                          LEFT Join reason On reason.id = transaction.reason_id
                        Where transaction.id = $transaction_id");
                        $expense_info = mysqli_fetch_assoc($result)
                        ?>
                        <div class="ibox-title">
                            <h5><span class="big"> لمشاهدة التفاصيل و تعديلها</span> </h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <form method="post" action="php/edit_expense.php?transaction_id=<?php echo $expense_info['id']?>" class="form-horizontal">
                                    <div class="form-group" id="data_1">
                                        <span class="arabic">
                                        <label class="col-sm-2 control-label">التاريخ </label>
                                        <div class="col-sm-10">
                                            <div class="input-group date">
                                                <input type="text" id="date" class="form-control" name="expenses_date" value="<?php echo $expense_info['date_1']?>" required>
                                                <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span class="arabic">

                                        <label class="col-sm-2 control-label" for="form-field-2"> السبب </label>
                                        <div class="col-sm-10">
                                            <select class="chosen-select form-control" name="reason_id">
                                                <option></option>
                                                <?php
                                                $query = "SELECT * FROM reason";
                                                $results=mysqli_query($con, $query);
                                                //loop
                                                foreach ($results as $reason){
                                                    ?>
                                                    <option  <?php if ($expense_info['reason_id']==$reason['id']) echo "selected" ?> value="<?php echo $reason["id"];?>"><?php echo $reason["name"];?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span class="arabic">
                                            <label class="col-sm-2 control-label">المبلغ</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="expenses_value"   value="<?php echo $expense_info['value']*-1?>" required/>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span class="arabic">
                                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع </label>
                                            <div class="col-sm-10">
                                                <select class="chosen-select form-control" name="site_id">
                                                    <option></option>
                                                    <?php
                                                    $query = "SELECT * FROM site";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $site){
                                                        ?>
                                                        <option <?php if ($expense_info['site_id']== $site["id"]) echo "selected";?> value="<?php echo $site["id"];?>"><?php echo $site["name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn" type="reset">
                                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                                Reset
                                            </button>
                                            <button class="btn btn-info" type="Submit" name="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                Submit
                                            </button>
                                        </div>
                                        <?php
                                        if ($expense_info['removed']=="1"){
                                            ?>
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <a data-toggle='modal' class=" pull-right btn btn-info" href='' onclick="undelete_expense(<?php echo $expense_info['id'] ?>)">
                                                        <span class="arabic">
                                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                                   إستعادة السجل
                                                        </span>
                                                </a>
                                            </div>
                                            <?php
                                        }else{
                                            ?>
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <a data-toggle='modal' class=" pull-right btn btn-danger" href='' onclick="delete_expense(<?php echo $expense_info['id'] ?>)">
                                                        <span class="arabic">
                                                            <i class="ace-icon fa fa-remove bigger-110"></i>
حذف السجل
                                                        </span>
                                                </a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </form>
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
                this.api().columns(':eq(5),:eq(6),:eq(7),:eq(8)').every( function () {
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
            pageLength: 50,
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
    <?php
    if (isset($_GET['backresult'])){
    $backresult=$_GET['backresult'];
    ?>
    $(document).ready(function() {
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
?>
        }, 1300);

    });
            <?php };?>;

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
        $('#example tfoot th').not(':eq(0),:eq(4),:eq(5),:eq(6),:eq(7)').each(function() {
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
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
<script>

    $(document).ready(function () {

        $('.demo1').click(function(){
            swal({
                title: "Welcome in Alerts",
                text: "Lorem Ipsum is simply dummy text of the printing and typesetting industry."
            });
        });

        $('.demo2').click(function(){
            swal({
                title: "Good job!",
                text: "You clicked the button!",
                type: "success"
            });
        });

        $('.demo3').click(function () {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
        });

        $('.demo4').click(function () {
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
                    } else {
                        swal("Cancelled", "تم إيقاف عملية الحذف", "error");
                    }
                });
        });


    });

</script>
<script>
    function delete_expense(id){
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
                        window.location.href = "php/delete_expense.php?expense_id="+id;
                    }
                    setTimeout(explode, 1200);
                } else {
                    swal("Cancelled", "تم إيقاف عملية الحذف", "error");
                }
            });
    };
    function undelete_expense(id){
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
                        window.location.href = "php/undelete_expense.php?expense_id="+id;
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