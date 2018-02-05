<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
include_once "php/functions.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'المقاول';
include_once "layout/header.php";
?>

<?php
if (!isset($_GET['reason_id'])){
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
                <h2><p>تفاصيل المقاول</p></h2>
            </div>
            <div class="col-sm-8">
                <font face="myFirstFont">
                    <div class="title-action">
                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#add_contractor_transaction"><i class="fa fa-plus"></i> إضافة عملية توريد</button>
                    </div>
                </font>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <?php
                        $reason_id=$_GET['reason_id'];
                        $contractor_query_info=mysqli_query($con, "
                            SELECT
                              reason.id,
                              reason.name
                            FROM
                              reason
                            WHERE
                              reason.id = $reason_id");
                        $contractor_info = mysqli_fetch_assoc($contractor_query_info);

                        $contractor_query_records_info=mysqli_query($con, "
                            SELECT
                              transaction.date_1,
                              transaction.value,
                              site.id As site_id,
                              site.name As site_name,
                              reason.id AS reason_id,
                              reason.name AS reason_name
                            FROM
                              transaction
                              INNER JOIN site ON transaction.site_id = site.id
                              INNER JOIN reason ON transaction.reason_id = reason.id
                            WHERE
                              transaction.removed = 0 AND
                              transaction.flag_id IN (4, 5, 7) AND
                              reason.id = $reason_id");
                        $contractor_records_info = mysqli_fetch_assoc($contractor_query_records_info);
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
                                <form method="post" action="php/edit_reason.php?reason_id=<?php echo $contractor_info['id']?>" class="form-horizontal">
                                    <span class="arabic">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="form-field-2">الأسم</label>
                                            <div class="col-sm-10">
                                                <input required class="form-control" type="text" id="form-field-2" name="name" value="<?php echo $contractor_info['name']?>" required />
                                            </div>
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
                                            <div class="col-sm-2 col-sm-offset-4">
                                                <button class="arabic btn btn-danger" type="button" onclick="delete_reason(<?php echo $reason_id ?>)" data-value="1" > لحذف المقاول </button>
                                            </div>
                                        </div>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5><span class="big">إحصائية ما له و ما عليه</span> </h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <?php
                            $contractor_query_out_info = mysqli_query($con,"
                                                SELECT
                                                  ABS(COALESCE(SUM(transaction.value),0)) AS Sum_value,
                                                  reason.name,
                                                  reason.id
                                                FROM
                                                  transaction
                                                  INNER JOIN reason ON transaction.reason_id = reason.id
                                                WHERE
                                                  transaction.flag_id IN (4, 5) AND
                                                  transaction.removed = 0 AND 
                                                  reason.id = $reason_id
                                                  ") or die(mysqli_error($con));
                            $contractor_out_info = mysqli_fetch_assoc($contractor_query_out_info);

                            $contractor_query_in_info = mysqli_query($con,"
                                                SELECT
                                                  ABS(COALESCE(SUM(transaction.value),0)) AS Sum_value,
                                                  reason.name,
                                                  reason.id
                                                FROM
                                                  transaction
                                                  INNER JOIN reason ON transaction.reason_id = reason.id
                                                WHERE
                                                  transaction.flag_id = 7 AND
                                                  transaction.removed = 0 AND 
                                                  reason.id = $reason_id
                                                  ") or die(mysqli_error($con));
                            $contractor_in_info = mysqli_fetch_assoc($contractor_query_in_info)
                            ?>
                            <div class="ibox-content">
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <div class="widget style1 red-bg">
                                                    <div class="row vertical-align">
                                                        <div class="col-xs-12 text-center">
                                                            <h2 class="font-bold">
                                                                <?php echo $contractor_out_info['Sum_value']; ?>
                                                                عليه
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
                                                                <?php echo $contractor_in_info['Sum_value']; ?>
                                                                له
                                                            </h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="widget style1">
                                                    <div class="row vertical-align">
                                                        <div class="col-xs-12 text-center">
                                                            <h2 class="font-bold">
                                                                <?php $contractor_result = $contractor_in_info['Sum_value'] - $contractor_out_info['Sum_value'];
                                                                if ($contractor_result > 0)
                                                                {
                                                                    echo $contractor_result;
                                                                    ?>
                                                                    <span class='big badge badge-danger'>له</span>
                                                                    <?php
                                                                }else{
                                                                    echo $contractor_result*-1;
                                                                    ?>
                                                                    <span class='big badge badge-success'>عليه</span>
                                                                    <?php
                                                                }
                                                                ?>
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
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <font face="myFirstFont">
                                <h5>للبحث و مشاهدة تفاصيل الحسابات</h5>
                            </font>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <?php
                                $query="
                            SELECT
                              transaction.date_1,
                              transaction.flag_id,
                              transaction.value,
                              site.id AS site_id,
                              site.name AS site_name,
                              reason.id AS reason_id,
                              reason.name AS reason_name,
                              transaction.id
                            FROM
                              transaction
                              INNER JOIN site ON transaction.site_id = site.id
                              INNER JOIN reason ON transaction.reason_id = reason.id
                            WHERE
                              transaction.removed = 0 AND
                              transaction.flag_id IN (4, 5, 7) AND 
                              reason.id= $reason_id
                            ORDER BY
                              transaction.date_1 DESC
                              "
                            ?>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="table-responsive">
                                    <table id="example" class=" dataTables-example table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th style="width:4em"></th>
                                            <th>التاريخ</th>
                                            <th>المبلغ</th>
                                            <th>الموقع</th>
                                            <th>النوع</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $result = mysqli_query($con, $query);
                                        while($records = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr> <!--info plus-->
                                                <th style="width:1em">
                                                    <?php
                                                    switch ($records['flag_id']) {
                                                        case "4":
                                                            ?>
                                                            <a class="btn btn-success btn-circle" type="button" href="expense.php?transaction_id=<?php echo $records['id'] ?>"><i class="fa fa-cog"></i></a>
                                                            <?php
                                                            break;
                                                        case "5":
                                                            ?>
                                                            <a class="btn btn-success btn-circle" type="button" href="expense.php?transaction_id=<?php echo $records['id'] ?>"><i class="fa fa-cog"></i></a>
                                                            <?php
                                                            break;
                                                        case "7":
                                                            ?>
                                                            <a class="btn btn-success btn-circle" type="button" href="contractor_transaction.php?transaction_id=<?php echo $records['id'] ?>"><i class="fa fa-cog"></i></a>
                                                            <?php
                                                            break;
                                                    }
                                                    ?>
                                                </th>
                                                <td class="middle wrap">
                                                    <span class="big badge badge-primary arabic">
                                                        <?php echo $records['date_1'] ?>
                                                    </span>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php
                                                        if ($records['value'] > 0)
                                                        {
                                                            echo $records['value'];
                                                        }else{
                                                            echo $records['value']*-1;
                                                        }
                                                    ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php echo $records['site_name']; ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php
                                                    switch ($records['flag_id']) {
                                                        case "4":
                                                            ?>
                                                            <span class='big badge badge-success'>عليه</span>
                                                            <?php
                                                            break;
                                                        case "5":
                                                            ?>
                                                            <span class='big badge badge-success'>عليه</span>
                                                            <?php
                                                            break;
                                                        case "7":
                                                            ?>
                                                            <span class='big badge badge-danger'>له</span>
                                                            <?php
                                                            break;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
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
            pageLength: 10,
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },

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
    function disable_tower_and_type(site_id) {
        $("#towerlist2 option:selected").removeAttr("selected").trigger('chosen:updated');
        $("#property_type option:selected").removeAttr("selected").trigger('chosen:updated');
            //We create ajax function
            $.ajax({
                type: "POST",
                url: "php/get_tower.php",
                data: "site="+site_id,
                success: function(data){
                    $("#towerlist2").empty();
                    $("#towerlist2").append(data);
                    $("#towerlist2").trigger("chosen:updated");
                }
            });
//        $('#property_type').prop('disabled', true).trigger("chosen:updated");
    }
</script>
<script>
    function delete_contract(id,id2){
        swal({
                title: "هل أنت متأكد؟",
                text: "هذا العقد سيتم إلغائه!!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "تم حذف العقد بنجاح.", "success");
                    function explode(){
                        window.location.href = "php/delete_contract.php?contract_id=" + id + "&property_id=" + id2;

                    }
                    setTimeout(explode, 1200);
                } else {
                    swal("Cancelled", "تم إيقاف عملية الحذف", "error");
                }
            });
    };
</script>
<script>
    function delete_reason(id){
        swal({
                title: "هل أنت متأكد؟",
                text: "هذا المقاول سيتم إلغائه!!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "تم حذف المقاول بنجاح.", "success");
                    function explode(){
                        window.location.href = "php/delete_reason.php?reason_id=" + id;

                    }
                    setTimeout(explode, 1200);
                } else {
                    swal("Cancelled", "تم إيقاف عملية الحذف", "error");
                }
            });
    };
</script>
</body>
</html>