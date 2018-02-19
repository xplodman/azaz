<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
include_once "php/functions.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'الإعدادات';
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
                <h2><p>الإعدادات</p></h2>
            </div>
            <div class="col-sm-8">
                <font face="myFirstFont">
                    <div class="title-action">
                        <button class="btn btn-success " type="button" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> إضافة مستخدم</button>
                    </div>
                </font>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>view and edit application setting</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <form method="post" action="php/edit_application_setting.php" class="form-horizontal">
                                    <?php
                                    $application_settings_query = mysqli_query($con,"
SELECT * FROM `application_setting`
") or die(mysqli_error($con));
                                    $application_settings_info = mysqli_fetch_assoc($application_settings_query);
                                    ?>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-4 control-label">تاريخ عرض المصروف قبل</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="expense_from_date" class="form-control" value="<?php echo $application_settings_info['expense_from_date'] ?>">
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-4 control-label">تاريخ عرض المصروف بعد</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="expense_to_date" class="form-control" value="<?php echo $application_settings_info['expense_to_date'] ?>">
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-4 control-label">تاريخ عرض العهده قبل</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="custodies_from_date" class="form-control" value="<?php echo $application_settings_info['custodies_from_date'] ?>">
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-4 control-label">تاريخ عرض العهده بعد</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="custodies_to_date" class="form-control" value="<?php echo $application_settings_info['custodies_to_date'] ?>">
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-4 control-label">تاريخ عرض الدفعات قبل</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="payment_from_date" class="form-control" value="<?php echo $application_settings_info['payment_from_date'] ?>">
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-4 control-label">تاريخ عرض الدفعات بعد</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="payment_to_date" class="form-control" value="<?php echo $application_settings_info['payment_to_date'] ?>">
                                            </div>
                                        </font>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-4">
                                            <button class="btn" type="reset">
                                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                                Reset
                                            </button>
                                            <button class="btn btn-info" type="Submit" name="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>view and edit application users</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                    <?php
                                    $application_users_query = mysqli_query($con,"
SELECT * FROM `users`") or die(mysqli_error($con));
                                    ?>
                                <table id="example1" class=" dataTables-example table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th style="width:4em"></th>
                                        <th>Nickname</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while($application_users_info = mysqli_fetch_assoc($application_users_query)) {
                                        ?>
                                        <tr> <!--info plus-->
                                            <th style="width:1em">
                                                <a class="btn btn-success btn-circle" type="button" href="user.php?user_id=<?php echo $application_users_info['id'] ?>"><i class="fa fa-cog"></i></a>
                                            </th>

                                            <td class="middle wrap">
                                                <?php echo $application_users_info['nickname']; ?>
                                            </td>
                                            <td class="middle wrap">
                                                <?php echo $application_users_info['username']; ?>
                                            </td>
                                            <td class="middle wrap">
                                                <?php echo $application_users_info['password']; ?>
                                            </td>
                                            <td class="middle wrap">
                                                <?php
                                                if ($application_users_info['role'] == 1){
                                                    echo "Administrator";
                                                }elseif($application_users_info['role'] == 2){
                                                    echo "Power user";
                                                }else{
                                                    echo "User";
                                                }
                                                ?>
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
                                    </tr>
                                    </tfoot>
                                </table>
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