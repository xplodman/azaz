<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
include_once "php/functions.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'تفاصيل المتعهد';
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
                <h2><p>تفاصيل المتعهد</p></h2>
            </div>
            <div class="col-sm-8">
                <font face="myFirstFont">
                    <div class="title-action">
                        <button class="btn btn-success " type="button" data-toggle="modal" data-target="#add_custody"><i class="fa fa-plus"></i> إضافة عهده</button>
                    </div>
                </font>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <?php
                            if (isset($_POST['submit']))
                            {
                                $custoder_id = $_POST['custoder_id'];
                            }else{
                                $custoder_id=$_GET['custoder_id'];
                            }

                        $result=mysqli_query($con, "
                            Select custoder.name,
                              custoder.mobile,
                              custoder.notes,
                              custoder.id
                            From custoder
                            Where custoder.id = $custoder_id");
                        $custody_info = mysqli_fetch_assoc($result)
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
                                <form method="post" action="php/edit_custoder.php?custoder_id=<?php echo $custoder_id?>" class="form-horizontal">
                                    <div class="form-group">
                                        <span class="arabic">
                                            <label class="col-sm-2 control-label">الأسم</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="name"   value="<?php echo $custody_info['name']?>" required/>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span class="arabic">
                                            <label class="col-sm-2 control-label">الموبايل</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="mobile"   value="<?php echo $custody_info['mobile']?>" required/>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span class="arabic">
                                            <label class="col-sm-2 control-label">ملاحظات</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="notes"   value="<?php echo $custody_info['notes']?>" required/>
                                                </textarea>
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
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <?php
                        $result=mysqli_query($con, "
                            Select custoder.name,
                              custoder.mobile,
                              custoder.notes,
                              custoder.id
                            From custoder
                            Where custoder.id = $custoder_id");
                        $custody_info = mysqli_fetch_assoc($result)
                        ?>
                        <div class="ibox-title">
                            <h5><span class="big">إحصائية عن ما تم صرفة و ما تم خصمه</span> </h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['submit']))
                        {
                            $from_date=$_POST['date_1'];
                            $to_date=$_POST['date_2'];
                            $get_spent_value_query="
                        Select COALESCE(SUM(transaction.value),0) As spent_count
From custoder
  Inner Join transaction On custoder.id = transaction.custoder_id
Where custoder.id = $custoder_id And transaction.removed = 0 And transaction.flag_id = 5 And transaction.date_1 BETWEEN '$from_date' and '$to_date 23:59:59'";

                            $get_received_value_query="
                        Select COALESCE(SUM(transaction.value),0) As received_count
From custoder
  Inner Join transaction On custoder.id = transaction.custoder_id
Where custoder.id = $custoder_id And transaction.removed = 0 And transaction.flag_id = 6 And transaction.date_1 BETWEEN '$from_date' and '$to_date 23:59:59'";

                        }else{

                            $get_spent_value_query="
                        Select COALESCE(SUM(transaction.value),0) As spent_count
From custoder
  Inner Join transaction On custoder.id = transaction.custoder_id
Where custoder.id = $custoder_id And transaction.removed = 0 And transaction.flag_id = 5";

                            $get_received_value_query="
                        Select COALESCE(SUM(transaction.value),0) As received_count
From custoder
  Inner Join transaction On custoder.id = transaction.custoder_id
Where custoder.id = $custoder_id And transaction.removed = 0 And transaction.flag_id = 6";

                        }
                        $get_spent_value = mysqli_query($con, $get_spent_value_query);
                        $get_spent_value = mysqli_fetch_assoc($get_spent_value);

                        $get_received_value = mysqli_query($con, $get_received_value_query);
                        $get_received_value = mysqli_fetch_assoc($get_received_value);
                        ?>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-inline">
                                            <input type="hidden" name="custoder_id" value="<?php echo $custoder_id ?>"/>

                                            <?php
                                            if (isset($_POST['custoder_id'])){

                                                ?>
                                                <input type="hidden" name="custoder_id" value="<?php echo $custoder_id ?>"/>
                                            <?php
                                            }
                                            ?>
                                            <div class="form-group" id="date_2">
                                                <div class="input-group date">
                                                    <input type="text" id="date_1" class="form-control" name="date_1"  required>
                                                    <span class="input-group-addon arabic">
                                                من
                                                </span>
                                                </div>
                                            </div>
                                            <div class="form-group" id="date_3">
                                                <div class="input-group date">
                                                    <input type="text" id="date" class="form-control" name="date_2"  required>
                                                    <span class="input-group-addon arabic">
                                                إلى
                                                </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-info" type="Submit" name="submit">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Search
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="col-lg-4">
                                            <div class="widget style1 red-bg">
                                                <div class="row vertical-align">
                                                    <div class="col-xs-12 text-center">
                                                        <h2 class="font-bold">
                                                            <?php
                                                            echo $get_spent_value['spent_count']*-1;
                                                            ?>
                                                            المصروف
                                                        </h2>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="widget style1 navy-bg">
                                                <div class="row vertical-align">
                                                    <div class="col-xs-12 text-center">
                                                        <h2 class="font-bold">
                                                            <?php
                                                                echo $get_received_value['received_count']*-1;
                                                            ?>
                                                            ما تم إضافته
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="widget style1 lazur-bg">
                                                <div class="row vertical-align">
                                                    <div class="col-xs-12 text-center">
                                                        <h2 class="font-bold">
                                                            <?php
                                                            echo ($get_received_value['received_count']*-1)+($get_spent_value['spent_count']);
                                                            ?>
                                                            المتبقي
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><span class="big">ما تم صرفه</span> </h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <?php
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
                        Where transaction.flag_id = 5 And custoder_id = $custoder_id";
                                ?>
                                <table id="example1" class=" dataTables-example table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th style="width:4em"></th>
                                        <th>التاريخ</th>
                                        <th>السبب</th>
                                        <th>المبلغ</th>
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
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><span class="big">ما تم إضافته</span> </h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <?php
                                $query="
                        Select transaction.id,
                          transaction.date_1,
                          transaction.value,
                          transaction.custoder_id,
                          transaction.removed,
                          custoder.name
                        From transaction
                          Inner Join custoder On custoder.id = transaction.custoder_id
                        Where transaction.removed = 0 And transaction.flag_id = 6  And custoder_id = $custoder_id";
                                ?>
                                <table id="example2" class=" dataTables-example table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th style="width:4em"></th>
                                        <th>التاريخ</th>
                                        <th>المبلغ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $result = mysqli_query($con, $query);
                                    while($custodies = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr> <!--info plus-->
                                            <th style="width:1em">
                                                <a class="btn btn-success btn-circle" type="button" href="custody_plus.php?transaction_id=<?php echo $custodies['id'] ?>"><i class="fa fa-cog"></i></a>
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
                                                <?php echo $custodies['value']*-1; ?>
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
        $('#example1').DataTable({
            initComplete: function () {
                this.api().columns(':eq(2),:eq(4),:eq(7),:eq(8)').every( function () {
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
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#example1 tfoot th').not(':eq(0),:eq(2),:eq(4)').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" />');
        });
        // DataTable
        var table = $('#example1').DataTable();
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
    $(document).ready(function() {
        $('#example2').DataTable({
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
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#example2 tfoot th').not(':eq(0)').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" />');
        });
        // DataTable
        var table = $('#example2').DataTable();
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



</script>
<script>
    $('.dual_select').bootstrapDualListbox({
        selectorMinimalHeight: 160
    });
    $('.chosen-select').chosen({width: "100%"});
    $('.chosen-select2').chosen({width: "200px"});
    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'yyyy-m-d'
    });
    $('#date_2 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'yyyy-m-d'
    });
    $('#date_3 .input-group.date').datepicker({
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