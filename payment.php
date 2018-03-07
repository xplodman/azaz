<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'القسط';
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
                <h2><p>تفاصيل السجل</p></h2>
            </div>
        </div>
        <div class="animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <?php
                        $transaction_id=$_GET['transaction_id'];
                        $result=mysqli_query($con, "
                    Select transaction.id,
                      transaction.date_1,
                      transaction.date_2,
                      transaction.number,
                      transaction.value,
                      transaction.status,
                      transaction.removed,
                      flag.id As flag_id,
                      flag.name As flag_name,
                      property.name As property_name,
                      property_type.name As property_type_name,
                      tower.name As tower_name,
                      site.name As site_name,
                      owner.id As owner_id,
                      owner.name As owner_name,
                      owner.mobile As owner_mobile
                    From transaction
                      Inner Join flag On flag.id = transaction.flag_id
                      Inner Join owner On transaction.owner_id = owner.id,
                      property
                      Inner Join property_type On property_type.id = property.property_type_id
                      Inner Join tower On tower.id = property.tower_id
                      Inner Join site On site.id = tower.site_id
                    Where transaction.id = $transaction_id And transaction.removed = 0 And
                      transaction.flag_id In ('1', '2', '3', '9', '12')");
                        $payment_info = mysqli_fetch_assoc($result)
                        ?>
                        <div class="ibox-title">
                            <h5><p>للتعديل على القسط</p></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <form method="post" id="form_submit" action="php/edit_payment.php?transaction_id=<?php echo $payment_info['id']; ?>" class="form-horizontal">

                                    <input type="hidden" name="owner_id" value="<?php echo $payment_info['owner_id']; ?>">
                                    <div class="form-group" id="data_1">
                                        <span class="arabic">
                                        <label class="col-sm-2 control-label">تاريخ الإستحقاق </label>
                                        <div class="col-sm-10">
                                            <div class="input-group date">
                                                <input type="text" id="date" class="form-control" name="date_1"  value="<?php echo $payment_info['date_1']; ?>">
                                                <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                        </span>
                                    </div>
                                    <div class="form-group" id="data_1">
                                        <span class="arabic">
                                        <label class="col-sm-2 control-label">تاريخ السداد </label>
                                        <div class="col-sm-10">
                                            <div class="input-group date">
                                                <input type="text" id="date" class="form-control" name="date_2" value="<?php echo $payment_info['date_2']; ?>" <?php if ($payment_info['status']==0){ echo "disabled";}?>>
                                                <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span class="arabic">
                                            <label class="col-sm-2 control-label" for="form-field-2"> نوع القسط </label>
                                            <div class="col-sm-10">
                                                <?php
                                                if(in_array($payment_info['flag_id'], [2,12])){
                                                  ?>
                                                    <select class="chosen-select form-control" id="site_id" name="flag_id">
                                                    <option value="2" <?php if($payment_info['flag_id']=="2") echo 'selected="selected"'; ?>> قسط</option>
                                                    <option value="12" <?php if($payment_info['flag_id']=="12") echo 'selected="selected"'; ?>> قسط سنوي</option>
                                                </select>
                                                <?php
                                                }else {
                                                    ?>
                                                    <input required class="form-control" type="text" id="form-field-2"
                                                           value="<?php
                                                           echo $payment_info['flag_name'];
                                                           ?>" readonly/>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                        </span>
                                    </div>
                                    <?php
                                    if($payment_info['flag_id']==2){
                                        ?>
                                        <div class="form-group">
                                        <span class="arabic">
                                            <label class="col-sm-2 control-label" for="form-field-2"> رقم القسط </label>
                                            <div class="col-sm-10">
                                                <input required class="form-control" type="text" value="<?php
                                                if(round($payment_info['number'])==$payment_info['number']){
                                                    echo round($payment_info['number']);
                                                }else{
                                                    echo round($payment_info['number'])."/".explode('.', number_format($payment_info['number'], 1))[1]; // 3
                                                }
                                                ?>" readonly/>
                                            </div>
                                        </span>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="form-group">
                                        <span class="arabic">
                                            <label class="col-sm-2 control-label" for="form-field-2"> المبلغ </label>
                                            <div class="col-sm-10">
                                                <input required class="form-control" type="number" id="form-field-2" name="value" value="<?php echo $payment_info['value']; ?>"/>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span class="arabic">
                                            <label class="col-sm-2 control-label" for="form-field-2"> أسم المشتري </label>
                                            <div class="col-sm-10">
                                                <input required class="form-control" type="text" name="owner_name" value="<?php echo $payment_info['owner_name']; ?>" />
                                            </div>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span class="arabic">
                                            <label class="col-sm-2 control-label" for="form-field-2"> رقم المشتري </label>
                                            <div class="col-sm-10">
                                                <input required class="form-control" type="text" name="owner_number" value="<?php echo $payment_info['owner_mobile']; ?>" />
                                            </div>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span class="arabic">
                                            <label class="col-sm-2 control-label" for="form-field-2"> رقم الوحدة</label>
                                            <div class="col-sm-10">
                                                <input required class="form-control" type="text" value="<?php echo $payment_info['property_name']; ?>" readonly />
                                            </div>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span class="arabic">
                                            <label class="col-sm-2 control-label" for="form-field-2">نوع الوحدة</label>
                                            <div class="col-sm-10">
                                                <input required class="form-control" type="text" value="<?php echo $payment_info['property_type_name']; ?>" readonly />
                                            </div>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span class="arabic">
                                            <label class="col-sm-2 control-label" for="form-field-2"> البرج</label>
                                            <div class="col-sm-10">
                                                <input required class="form-control" type="text" value="<?php echo $payment_info['tower_name']; ?>" readonly />
                                            </div>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span class="arabic">
                                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع</label>
                                            <div class="col-sm-10">
                                                <input required class="form-control" type="text" value="<?php echo $payment_info['site_name']; ?>" readonly />
                                            </div>
                                        </span>
                                    </div>
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <div class="col-sm-2 col-sm-offset-2">
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
                                        switch ($payment_info['status']) {
                                            case "0":
                                                ?>
                                                <div class="col-sm-4 col-sm-offset-4">
                                                    <a data-toggle='modal' class="property_payment_receive btn btn-info" href='#property_payment_receive' data-id='<?php echo $payment_info['id']; ?>'>
                                                        <span class="arabic">
                                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                                    تحصيل القسط
                                                        </span>
                                                    </a>
                                                    <a data-toggle='modal' class=" property_payment_receive btn btn-success" href='#property_payment_division' data-id='<?php echo $payment_info['id']; ?>'>
                                                        <span class="arabic">
                                                            <i class="ace-icon fa fa-usd bigger-110"></i>
                                                   تقسيم القسط
                                                        </span>
                                                    </a>
                                                </div>
                                                <?php
                                                break;
                                            case "1":
                                                ?>
                                        <div class="col-sm-4 col-sm-offset-4">
                                            <a data-toggle='modal' class="pull-right property_payment_receive btn btn-primary">
                                                <span class="arabic">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
تم السداد
                                                </span>
                                            </a>
                                        </div>
                                                <?php
                                                break;
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
    var date_input=$('input[name="payment_date"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
        format: 'd-m-yyyy',
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
    $(document).on("click", ".property_payment_receive", function () {
        var payment_id = $(this).data('id');
        $(".modal-body #payment_id").val( payment_id );
    });
</script>
</body>
</html>