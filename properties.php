<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'عقارات';
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
                <h2><p>عقارات</p></h2>
            </div>
            <div class="col-sm-8">
                <font face="myFirstFont">
                    <div class="title-action">
                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#add_properties"><i class="fa fa-plus"></i> إضافة عقار</button>
                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#add_tower"><i class="fa fa-plus"></i> إضافة برج</button>
                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#add_site"><i class="fa fa-plus"></i> إضافة موقع</button>
                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#add_transaction"><i class="fa fa-plus"></i> إضافة عملية بيع</button>
                    </div>
                </font>
            </div>
        </div>
        <div class="animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <font face="myFirstFont">
                                <h5>للبحث و مشاهدة العقارات</h5>
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
                                            <th>extn</th>
                                            <th style="width:1em"></th>
                                            <th style="width:1em"></th><!--order column-->
                                            <th>نوع الوحدة</th>
                                            <th>رقم الوحدة</th>
                                            <th>المساحة</th>
                                            <th>السعر</th>
                                            <th>أسم المالك</th>
                                            <th>تاريخ التعاقد</th>
                                            <th>البرج</th>
                                            <th>الموقع</th>
                                            <th>الحالة</th>
                                            <th>الحسابات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $property_query_info = mysqli_query($con,"
                                                Select tower.name As tower_name,
                                                  tower.id As tower_id,
                                                  site.name As site_name,
                                                  site.id As site_id,
                                                  property_type.id As property_type_id,
                                                  property_type.name As property_type_name,
                                                  property.id As property_id,
                                                  property.name As property_name,
                                                  property.area As property_area,
                                                  property.price As property_price
                                                From property
                                                  Inner Join tower On tower.id = property.tower_id
                                                  Inner Join site On site.id = tower.site_id
                                                  Inner Join property_type On property_type.id = property.property_type_id
                                                  Order By property_id desc") or die(mysqli_error($con));
                                        while($property_info = mysqli_fetch_assoc($property_query_info))
                                        {
                                            ?>
                                            <tr data-child-value="<p><?php
                                            $y=0;
                                            $property_query_payment_info = mysqli_query($con,"
                                                Select transaction.id,
                                                  transaction.date_1,
                                                  transaction.date_2,
                                                  transaction.value,
                                                  transaction.status,
                                                  flag.id As flag_id,
                                                  flag.name As flag_name,
                                                  property.name As property_name,
                                                  owner.name As owner_name,
                                                  property.id As property_id
                                                From transaction
                                                  Inner Join flag On flag.id = transaction.flag_id
                                                  Inner Join property On property.id = transaction.property_id
                                                  Inner Join owner On owner.id = transaction.owner_id
                                                Where transaction.removed = 0 And property.id = $property_info[property_id]") or die(mysqli_error($con));
                                            while($property_payment_info = mysqli_fetch_assoc($property_query_payment_info))
                                            {
                                                ?>
                                                <a href='payment.php?transaction_id=<?php echo $property_payment_info['id'] ?>'><span class='badge big badge-success'>
                                                <?php
                                                switch ($property_payment_info['flag_id']) {
                                                    case "1":
                                                        echo "مقدم";
                                                        break;
                                                    case "2":
                                                        echo $y.' قسط رقم';
                                                        break;
                                                    case "3":
                                                        echo "دفعة إستلام";
                                                        break;
                                                    default:
                                                        break;
                                                }
                                                $y++;
                                                ?>
                                                </span>
                                                <span class='big'> <button type='button' class='btn btn-outline btn-info'>
                                                <?php
echo $property_payment_info['value'];
                                                ?>
                                                جنيه </button>
                                                <?php
                                                if ($property_payment_info['status'] == 0){
                                                    echo $property_payment_info['date_1'];
                                                    ?>
                                                    <span class='big badge badge-danger'>لم يتم الدفع</span>

                                        <a data-toggle='modal' data-id='<?php echo $property_payment_info['id'];?>' title='Add this item' class='property_payment_receive btn btn-primary fa fa-check' href='#property_payment_receive'></a>
                                                    <?php
                                                }else{
                                                    echo $property_payment_info['date_2'];

                                                    $date1 = new DateTime($property_payment_info['date_1']);
                                                    $date2 = new DateTime($property_payment_info['date_2']);
                                                    $variable =$date1 ->diff($date2)->format('%a');
                                                    if($date1 < $date2){
                                                        $variable = $variable *-1;
                                                    }
                                                    if ($variable >= 0)
                                                        {
                                                            ?>
                                                            <span class='big badge badge-primary arabic'>
تم الدفع                                                            </span>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <span class='big badge badge-warning arabic'>
تم الدفع                                                            </span>
                                                            <?php
                                                        }
                                                }
                                                echo '<br>';
                                            }
                                            ?></a></p>"> <!--info plus-->
                                                <td><!--search in info plus-->
                                                </td>
                                                <td class="details-control"></td>
                                                <td>
                                                    order
                                                </td><!--order column-->
                                                <td class="middle wrap">
                                                    <?php echo $property_info['property_type_name']; ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <span class='big'>
                                                        <a href="property.php?property_id=<?php echo $property_info['property_id']; ?>"><button type='button' class='btn btn-outline btn-info'>
                                                            <?php echo $property_info['property_name']; ?>
                                                        </button></a>
                                                    </span>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php echo $property_info['property_area']; ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php echo $property_info['property_price']; ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php
                                                        $owner_query_info = mysqli_query($con, "
                                                        Select property.id As property_id,
                                                          property.name As property_name,
                                                          property.area As property_area,
                                                          property.price As property_price,
                                                          owner_has_property.contract_date As contract_date,
                                                          owner.name As owner_name,
                                                          owner.mobile As owner_mobile
                                                        From property
                                                          Inner Join owner_has_property On owner_has_property.property_id = property.id
                                                          Inner Join owner On owner.id = owner_has_property.owner_id
                                                        Where property.id = $property_info[property_id] And owner_has_property.status = 1");

                                                        $owner_info = mysqli_fetch_assoc($owner_query_info);
                                                        echo $owner_info['owner_name'];
                                                    ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php echo $owner_info['contract_date']; ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <a href="tower.php?tower_id=<?php echo $property_info['tower_id']; ?>"><button type='button' class='btn btn-outline btn-info'>
                                                            <?php echo $property_info['tower_name']; ?>
                                                        </button></a>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php echo $property_info['site_name']; ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php
                                                    if ($owner_info == 0){
                                                        echo "لم يتم البيع";
                                                    }else{
                                                        echo "تم البيع";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php
                                                    if ($owner_info == 0){
                                                        echo "";
                                                    }else{
                                                        $payment_query_info = mysqli_query($con, "
                                                            Select Coalesce(Count(property.id), 0) As property_id_count
                                                            From transaction
                                                              Inner Join property On property.id = transaction.property_id
                                                            Where transaction.status = 0 And transaction.removed = 0 And
                                                              transaction.flag_id in (1,2,3) And property.id = $property_info[property_id]");
                                                        $payment_info = mysqli_fetch_assoc($payment_query_info);
                                                        if ($payment_info['property_id_count'] > 0){
                                                            echo "جاري الدفع";
                                                        }else{
                                                            echo "تم الدفع";
                                                        }
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

<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>

<!-- Sweet alert -->
<script src="js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Dual Listbox -->
<script src="js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>

<!-- Toastr -->
<script src="js/plugins/toastr/toastr.min.js"></script>

<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>

<script src="js/plugins/dataTables/datatables.min.js"></script>
<script>
    function format(value) {
        return '<div class="middle wrap col-sm-12"  >' + value + '</div>';
    }
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            initComplete: function () {
                this.api().columns(':eq(3),:eq(10),:eq(11),:eq(12)').every( function () {
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
            columnDefs: [{
                className: 'control',
                orderable: false,
                targets: [ 1 ]
            }],
            columnDefs: [{
                targets: [ 0,2 ],
                visible: false
            }],

            order: [2, 'desc'],
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'print',
                    autoPrint: true,
                    exportOptions: {
                        columns: [ 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 ]
                    },
                },
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [ 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 ]
                    }
                }
                ,
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 ]
                    }
                }
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
        var table = $('.dataTables-example').DataTable();
        // Add event listener for opening and closing details
        $('#example').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(tr.data('child-value'))).show();
                tr.addClass('shown');
            }
        });
    });
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
        $('#example tfoot th').not(':eq(0),:eq(1),:eq(8),:eq(9),:eq(10)').each(function() {
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
    $(document).ready(function(){
        var date_input=$('input[name="date[]"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-m-d',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
        var date_input=$('input[name="first_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-m-d',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
        var date_input=$('input[name="last_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-m-d',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
        var date_input=$('input[name="payment_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-m-d',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
        var date_input=$('input[name="contract_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-m-d',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>

<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 150; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var y = 1; //Initial field counter is 1
        var fieldHTML = '<div class="form-inline"><div class="form-group"><div class="col-sm-12"><input type="text" class="form-control" name="date[]" placeholder="تاريخ القسط" required>&nbsp;<input type="text" class="form-control calc"  data-action="sub" placeholder="قيمة القسط" name="price[]" required onkeypress="return isNumberKey(event)">&nbsp;<button type="button" class="btn btn-minier btn-danger remove_button" title="Remove" id="Remove"><i class="ace-icon fa fa-minus">Remove</i></button></div></div></div>'; //New input field html
        var x = 1; //Initial field counter is 1
        $(addButton).click(function(){ //Once add button is clicked
            y++; //Increment field counter
            if(x < maxField){ //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append("القسط رقم"+y+fieldHTML); // Add field html
                var date_input=$('input[name="date[]"]'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                date_input.datepicker({
                    format: 'yyyy-m-d',
                    container: container,
                    todayHighlight: true,
                    autoclose: true,
                })
            }
        });
        $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>
<script type="text/javascript">
    $(document.body).on('blur', '.calc', function() {
        var result = 0;
        $('.calc').each(function() {
            var $input = $(this),
                value = parseFloat($input.val());

            if (isNaN(value)) {
                return;
            }

            var action = $input.data('action') == 'add' ? 1 : -1;

            result += value * action;
        });
        $('#total').val(result.toFixed(0));
    });
</script>
<script>
    function get_tower_id(val){
        //We create ajax function
        $.ajax({
            type: "POST",
            url: "php/get_tower.php",
            data: "site="+val,
            success: function(data){
                $("#towerlist").empty();
                $("#towerlist").append(data);
                $("#towerlist").trigger("chosen:updated");
                $("#towerlist2").empty();
                $("#towerlist2").append(data);
                $("#towerlist2").trigger("chosen:updated");
            }
        });
    }
    function get_property_type_id(val){
        //We create ajax function
        $.ajax({
            type: "POST",
            url: "php/get_property_type.php",
            data: "tower_number="+val,
            success: function(data){
                $("#property_type").empty();
                $("#property_type").append(data);
                $("#property_type").trigger("chosen:updated");
            }
        });
    }
</script>
<script>
    function get_property_number(){
    //We create ajax function
        var site_id = $("#site_id").val();
        var towerlist = $("#towerlist").val();
        var property_type = $("#property_type").val();

        $.ajax({
            type: "POST",
            url: "php/get_property_number.php",
            data: {site_id:site_id,towerlist:towerlist,property_type:property_type},
            success: function(data){
                $("#property_number").empty();
                $("#property_number").append(data);
                $("#property_number").trigger("chosen:updated");
            }
        });
    }
</script>
<script>
    function get_property_price(val){
        //We create ajax function
        $.ajax({
            type: "POST",
            url: "php/property_price.php",
            data: "property_number="+val,
            success: function(data){
                $("#property_price").val('');
                $("#property_price").val(data);
                $("#property_price_2").val('');
                $("#property_price_2").val(data);
            }
        });
    }

</script>

<script>
    $(document).on("click", ".property_payment_receive", function () {
        var payment_id = $(this).data('id');
        $(".modal-body #payment_id").val( payment_id );
    });
</script>

</body>
</html>