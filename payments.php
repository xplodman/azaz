<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
include_once "php/functions.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'الدفعات';
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
                <h2><p>الدفعات</p></h2>
            </div>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading animated fadeInRightBig">
            <?php
            $payment_from_date = date('Y-m-d',strtotime("-$application_setting[payment_from_date] days"));
            $payment_to_date = date('Y-m-d',strtotime("$application_setting[payment_to_date] days"));
            if (isset($_POST['submit']))
            {
                $from_date=$_POST['from_date'];
                $to_date=$_POST['to_date'];
                $query="
                    Select payment.due_date As payment_due_date,
                      payment.id As payment_id,
                      payment.payment_date As payment_payment_date,
                      payment.value As payment_value,
                      owner.name As owner_name,
                      owner.mobile As owner_mobile,
                      property_type.name As property_type_name,
                      property.id As property_id,
                      property.name As property_name,
                      tower.name As tower_name,
                      site.name As site_name,
                      payment.status As payment_status
                    From payment
                      Inner Join property On property.id = payment.property_id
                      Inner Join property_type On property_type.id = property.property_type_id
                      Inner Join owner On owner.id = payment.owner_id
                      Inner Join tower On tower.id = property.tower_id
                      Inner Join site On tower.site_id = site.id
                    Where payment.removed = '0' AND payment.due_date BETWEEN '$from_date' and '$to_date 23:59:59'";
            }else{
                $query="
                    Select payment.due_date As payment_due_date,
                      payment.id As payment_id,
                      payment.payment_date As payment_payment_date,
                      payment.value As payment_value,
                      owner.name As owner_name,
                      owner.mobile As owner_mobile,
                      property_type.name As property_type_name,
                      property.id As property_id,
                      property.name As property_name,
                      tower.name As tower_name,
                      site.name As site_name,
                      payment.status As payment_status
                    From payment
                      Inner Join property On property.id = payment.property_id
                      Inner Join property_type On property_type.id = property.property_type_id
                      Inner Join owner On owner.id = payment.owner_id
                      Inner Join tower On tower.id = property.tower_id
                      Inner Join site On tower.site_id = site.id
                    Where payment.removed = '0' AND payment.due_date BETWEEN '$payment_from_date' and '$payment_to_date 23:59:59'";
            }
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
                                    echo $payment_from_date;
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
                                    echo $payment_to_date;
                                }?>">
                                <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
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
        <div class="animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <font face="myFirstFont">
                                <h5>للبحث و مشاهدة الدفعات</h5>
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
                                            <th>المبلغ</th>
                                            <th>أسم المشتري</th>
                                            <th>رقم المشتري</th>
                                            <th>نوع الوحدة</th>
                                            <th>رقم الوحدة</th>
                                            <th>البرج</th>
                                            <th>الموقع</th>
                                            <th>الحالة</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $result = mysqli_query($con, $query);
                                        while($payments = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr> <!--info plus-->
                                                <th style="width:1em">
                                                    <a class="btn btn-success btn-circle" type="button" href="payment.php?payment_id=<?php echo $payments['payment_id'] ?>"><i class="fa fa-cog"></i></a>
                                                    <?php
                                                    switch ($payments['payment_status']) {
                                                        case "0":
                                                            ?>
                                                            <a data-toggle='modal'
                                                               data-id='<?php echo $payments['payment_id']; ?>'
                                                               title='Add this item'
                                                               class='property_payment_receive btn btn-primary fa fa-check'
                                                               href='#property_payment_receive'></a>
                                                            <?php
                                                            break;
                                                    }
                                                    ?>
                                                </th>
                                                <td class="middle wrap">
                                                    <?php
                                                    $date1 = new DateTime($payments['payment_payment_date']);
                                                    $date2 = new DateTime($payments['payment_due_date']);

                                                    $variable =$date1 ->diff($date2)->format("%a");
                                                    if($date1 < $date2){
                                                        $variable = $variable *-1;
                                                    }
                                                    switch ($payments['payment_status']) {
                                                        case "1":
                                                        if ($variable <= 0)
                                                        {
                                                            ?>
                                                            <span class="big badge badge-primary arabic">
                                                            <?php echo $payments['payment_payment_date'] ?>
                                                            </span>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <span class="big badge badge-warning arabic">
                                                                <?php echo $payments['payment_payment_date'] ?>
                                                            </span>
                                                            <?php
                                                        }
                                                        break;
                                                        case "0":
                                                            ?>
                                                            <span class="big badge badge-danger arabic">
                                                                <?php echo $payments['payment_due_date'] ?>
                                                            </span>
                                                            <?php
                                                            break;
                                                        case "3":
                                                            echo "دفعة إستلام";
                                                            break;
                                                    }
                                                    ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php echo $payments['payment_value']; ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php echo $payments['owner_name']; ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php echo $payments['owner_mobile']; ?>
                                                </td>

                                                <td class="middle wrap">
                                                    <?php echo $payments['property_type_name'] ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <span class='big'>
                                                        <a href="property.php?property_id=<?php echo $payments['property_id']; ?>"><button type='button' class='btn btn-outline btn-info'>
                                                            <?php echo $payments['property_name']; ?>
                                                        </button></a>
                                                    </span>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php echo $payments['tower_name'] ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php echo $payments['site_name'] ?>
                                                </td>
                                                    <?php
                                                    if ($payments['payment_status'] == 0){?>
                                                <td class="middle wrap">لم يتم الدفع</td>
                                                        <?php
                                                        }else{
                                                        ?>
                                                <td class="middle wrap">تم الدفع</td>
                                                        <?php
                                                        }
                                                    ?>
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
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <span class="big badge badge-primary arabic">تم السداد في/قبل الميعاد</span> -
                                    <span class="big badge badge-warning arabic">تم السداد بعد الميعاد</span> -
                                    <span class="big badge badge-danger arabic">لم يتم السداد</span>
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

<!-- Sweet alert -->
<script src="js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Select2 -->
<script src="js/plugins/select2/select2.full.min.js"></script>

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
                this.api().columns(':eq(4),:eq(5),:eq(6),:eq(7),:eq(8),:eq(9)').every( function () {
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
            aaSorting: [ [9,'desc'],[1,'desc']],
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
        $('#example tfoot th').not(':eq(0),:eq(7),:eq(8),:eq(9)').each(function() {
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
    var date_input=$('input[name="payment_date"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
        format: 'yyyy-m-d',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
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
                        if (isConfirm) {
                            setTimeout(function() {
                                $("#test").submit()
                            }, 1200);
                        }
                    } else {
                        swal("Cancelled", "تم إيقاف عملية الحذف", "error");
                    }
                });
        });


    });

</script>
<script>
    $(document).on("click", ".property_payment_receive", function () {
        var payment_id = $(this).data('id');
        $(".modal-body #payment_id").val( payment_id );
    });
</script>
</body>
</html>