<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'المقاولين';
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
                <h2><p>المقاولين</p></h2>
            </div>
            <div class="col-sm-8">
                <font face="myFirstFont">

                </font>
            </div>
        </div>
        <div class="animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <font face="myFirstFont">
                                <h5>للبحث و مشاهدة المقاولين</h5>
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
                                            <th style="width:1em"></th>
                                            <th>الأسم</th>
                                            <th>عليه</th>
                                            <th>له</th>
                                            <th>الإجمالي</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $contractor_query_info = mysqli_query($con,"
                                                SELECT
                                                  reason.name,
                                                  reason.id
                                                FROM
                                                  reason") or die(mysqli_error($con));
                                        while($contractor_info = mysqli_fetch_assoc($contractor_query_info))
                                        {
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
                                                  reason.id = $contractor_info[id]
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
                                                  reason.id = $contractor_info[id]
                                                  ") or die(mysqli_error($con));
                                            $contractor_in_info = mysqli_fetch_assoc($contractor_query_in_info)
                                            ?>
                                            <tr data-child-value=""> <!--info plus-->
                                                <td><!--search in info plus-->
                                                </td>
                                                <td class="middle wrap">
                                                    <span class='big'>
                                                        <a href="contractor.php?reason_id=<?php echo $contractor_out_info['id']; ?>"><button type='button' class='btn btn-outline btn-info'>
                                                    <?php echo $contractor_out_info['name']; ?>
                                                        </button></a>
                                                    </span>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php echo $contractor_out_info['Sum_value']; ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php echo $contractor_in_info['Sum_value']; ?>
                                                </td>
                                                <td class="middle wrap">
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
                this.api().columns('').every( function () {
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
            columnDefs: [{
                className: 'control',
                orderable: false,
                targets: [ 1 ]
            }],
            columnDefs: [{
                targets: [ 0 ],
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
        $('#example tfoot th').not('').each(function() {
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
            format: 'd-m-yyyy',
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
        var fieldHTML = '<div class="form-inline"><div class="form-group"><div class="col-sm-12"><input type="text" class="form-control" name="date[]" placeholder="تاريخ القسط" required>&nbsp;<input type="text" class="form-control calc"  data-action="sub" placeholder="قيمة القسط" name="price[]" required>&nbsp;<button type="button" class="btn btn-minier btn-danger remove_button" title="Remove" id="Remove"><i class="ace-icon fa fa-minus">Remove</i></button></div></div></div>'; //New input field html
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