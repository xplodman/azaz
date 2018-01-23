<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
include_once "php/functions.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'الوحدة';
include_once "layout/header.php";
?>

<?php
if (!isset($_GET['property_id'])){
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
                <h2><p>تفاصيل الوحدة</p></h2>
            </div>
        </div>
        <div class="animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <?php
                        $property_id=$_GET['property_id'];
                        $result=mysqli_query($con, "
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
                            Where property.id = $property_id");
                        $property_info = mysqli_fetch_assoc($result);

                        $result2=mysqli_query($con, "
                            Select owner.id As owner_id,
                              owner.name,
                              owner.mobile,
                              owner.mobile_2,
                              owner_has_property.contract_date,
                              owner_has_property.id As owner_has_property_id,
                              owner_has_property.status,
                              property.id
                            From owner
                              Inner Join owner_has_property On owner_has_property.owner_id = owner.id
                              Inner Join property On property.id = owner_has_property.property_id
                            Where property.id = $property_id and owner_has_property.status = 1");
                        $owner_info = mysqli_fetch_assoc($result2);
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
                                <form method="post" action="php/edit_property.php?property_id=<?php echo $property_info['property_id']?>" class="form-horizontal">
                                    <span class="arabic">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع </label>
                                            <div class="col-sm-10">
                                                <select class="chosen-select form-control" id="site_id" name="site_id"  onchange="disable_tower_and_type(this.value)">
                                                    <option></option>
                                                    <?php
                                                    $query = "SELECT * FROM site";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $site){
                                                        ?>
                                                        <option <?php if ($property_info['site_id']==$site['id']){ echo 'selected="selected"' ;} ?> value="<?php echo $site["id"];?>"><?php echo $site["name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="form-field-2">رقم البرج </label>
                                            <div class="col-sm-10">
                                                <select required class="chosen-select" size="6" name="tower_number" id="towerlist2" >
                                                    <option></option>
                                                    <?php
                                                    $query = "Select tower.name,
                                                                  tower.id
                                                                From tower
                                                                  Inner Join site On site.id = tower.site_id";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $tower){
                                                        ?>
                                                        <option <?php if ($property_info['tower_id']==$tower['id']){ echo 'selected="selected"' ;} ?> value="<?php echo $tower["id"];?>"><?php echo $tower["name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="form-field-2">نوع العقار </label>
                                            <div class="col-sm-10">
                                                <select required class="chosen-select" size="6" name="property_type" id="property_type">
                                                    <option></option>
                                                    <?php
                                                    $query = "Select property_type.name,
                  property_type.id
                From property_type";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $property_type){
                                                        ?>
                                                        <option <?php if ($property_info['property_type_id']==$property_type['id']){ echo 'selected="selected"' ;} ?> value="<?php echo $property_type["id"];?>"><?php echo $property_type["name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="form-field-2"> رقم العقار </label>
                                            <div class="col-sm-10">
                                                <input required class="form-control" type="text" id="form-field-2" name="property_number" value="<?php echo $property_info['property_name']?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="form-field-2"> مساحة العقار </label>
                                            <div class="col-sm-10">
                                                <input required class="form-control" type="text" id="form-field-2" name="property_area" value="<?php echo $property_info['property_area']?>" required  />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="form-field-2">سعر العقار قبل البيع</label>
                                            <div class="col-sm-10">
                                                <input required class="form-control" type="text" id="form-field-2" name="property_price"  value="<?php echo $property_info['property_price']?>" required />
                                            </div>
                                        </div>
                                        <?php
                                        $property_price_query="SELECT
  Sum(transaction.value) AS property_price
FROM
  transaction
WHERE
  transaction.removed = 0 AND
  transaction.flag_id IN ('1', '2', '3', '9')";
                                        $property_price_info = mysqli_query($con, $property_price_query);
                                        $property_price_info_sum = mysqli_fetch_assoc($property_price_info)

                                        ?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="form-field-2">سعر العقار بعد البيع</label>
                                            <div class="col-sm-10">
                                                <input required class="form-control" type="text" id="form-field-2" name="property_price"  value="<?php echo $property_price_info_sum['property_price']?>" readonly />
                                            </div>
                                        </div>
                                        <input type="hidden" name="property_status"  value="<?php echo $owner_info['status']?>" />
                                        <input type="hidden" name="owner_has_property_id"  value="<?php echo $owner_info['owner_has_property_id']?>" />
                                        <input type="hidden" name="owner_id"  value="<?php echo $owner_info['owner_id']?>" />
                                        <?php
                                        switch ($owner_info['status']) {
                                        case "1":?>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> أسم المشتري</label>
                                                <div class="col-sm-10">
                                                    <input required class="form-control" type="text" name="owner_name"  value="<?php echo $owner_info['name']?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> رقم المشتري</label>
                                                <div class="col-sm-10">
                                                    <input required class="form-control" type="text" name="owner_mobile"  value="<?php echo $owner_info['mobile']?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> رقم آخر للمشتري</label>
                                                <div class="col-sm-10">
                                                    <input required class="form-control" type="text" name="owner_mobile_2"  value="<?php echo $owner_info['mobile_2']?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group" id="data_1">
                                                <span class="arabic">
                                                <label class="col-sm-2 control-label">تاريخ التعاقد </label>
                                                <div class="col-sm-10">
                                                    <div class="input-group date">
                                                        <input type="text" id="date" class="form-control" name="contract_date"  value="<?php echo $owner_info['contract_date']; ?>">
                                                        <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                </span>
                                            </div>
                                            <?php
                                            break;
                                        }
                                        ?>
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
                                            switch ($owner_info['status']) {
                                                default:
                                                    ?>
                                                    <div class="col-sm-2 col-sm-offset-2">
                                                        <span class="arabic  pull-right btn btn-warning">
لم يتم البيع
                                                        </span>
                                                    </div>
                                                <?php
                                                break;
                                                case "1":
                                                    ?>
                                                    <div class="col-sm-2 col-sm-offset-2">
                                                        <span class="arabic  pull-right btn btn-info">
تم البيع
                                                        </span>
                                                    </div>
                                                    <button class="arabic btn btn-danger" type="button" onclick="delete_contract(<?php echo $owner_info['owner_has_property_id'] ?> , <?php echo $property_info['property_id'] ?>)" data-value="1" > لفسخ التعاقد </button>
                                                    <button class="arabic btn btn-danger" type="button" onclick="delete_property(<?php echo $property_info['property_id'] ?>)" data-value="1" > لحذف العقار </button>
                                                    <?php
                                                break;
                                                }
                                            ?>
                                        </div>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <?php
                                $query="
                    Select transaction.id,
                      transaction.date_1,
                      transaction.date_2,
                      transaction.value,
                      transaction.status,
                      transaction.removed,
                      flag.name As flag_name,
                      flag.id As flag_id,
                      property.id As property_id,
                      property.name As property_name,
                      property_type.name As property_type_name,
                      tower.name As tower_name,
                      site.name As site_name,
                      owner.name As owner_name,
                      owner.mobile As owner_mobile
                    From transaction
                      Inner Join flag On flag.id = transaction.flag_id
                      Inner Join owner On transaction.owner_id = owner.id
                      Inner Join property On property.id = transaction.property_id 
                      Inner Join property_type On property_type.id = property.property_type_id
                      Inner Join tower On tower.id = property.tower_id
                      Inner Join site On site.id = tower.site_id
                    Where transaction.removed = 0 And transaction.flag_id In ('1', '2', '3', '9') AND property.id= $property_id"
                            ?>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="table-responsive">
                                    <table id="example" class=" dataTables-example table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th style="width:10em"></th>
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
                                                    <a class="btn btn-success btn-circle" type="button" href="payment.php?transaction_id=<?php echo $payments['id'] ?>"><i class="fa fa-cog"></i></a>
                                                    <?php
                                                    switch ($payments['status']) {
                                                        case "0":
                                                            ?>
                                                            <a data-toggle='modal'
                                                               data-id='<?php echo $payments['id']; ?>'
                                                               title='Add this item'
                                                               class='property_payment_receive btn btn-primary fa fa-check'
                                                               href='#property_payment_receive_2'></a>
                                                            <?php
                                                            break;
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($payments['flag_id']=='6'){
                                                        ?>
                                                        <span class="badge badge-danger arabic">إضافة عهده</span>
                                                        <?php
                                                    }elseif ($payments['flag_id']=='8'){
                                                        ?>
                                                        <span class="badge badge-primary arabic">إيراد من شريك</span>
                                                        <?php
                                                    }elseif ($payments['flag_id']=='4'){
                                                        ?>
                                                        <span class="badge badge-danger arabic">مصروف</span>
                                                        <?php
                                                    }elseif (in_array($payments['flag_id'], [1,2,3,9])){
                                                        ?>
                                                        <span class="badge badge-success arabic"><?php echo $payments['flag_name'] ?></span>
                                                        <?php
                                                    }
                                                    ?>
                                                </th>
                                                <td class="middle wrap">
                                                    <?php
                                                    $date1 = new DateTime($payments['date_1']);
                                                    $date2 = new DateTime($payments['date_2']);
                                                    $variable =$date1 ->diff($date2)->format("%a");
                                                    if($date1 < $date2){
                                                        $variable = $variable *-1;
                                                    }
                                                    switch ($payments['status']) {
                                                        case "1":
                                                            if ($variable >= 0)
                                                            {
                                                                ?>
                                                                <span class="big badge badge-primary arabic">
                                                            <?php echo $payments['date_2'] ?>
                                                            </span>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <span class="big badge badge-warning arabic">
                                                                <?php echo $payments['date_2'] ?>
                                                            </span>
                                                                <?php
                                                            }
                                                            break;
                                                        case "0":
                                                            ?>
                                                            <span class="big badge badge-danger arabic">
                                                                <?php echo $payments['date_1'] ?>
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
                                                    <?php echo $payments['value']; ?>
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
                                                if ($payments['status'] == 0){?>
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
    function delete_property(id){
        swal({
                title: "هل أنت متأكد؟",
                text: "هذا العقار سيتم إلغائه!!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "تم حذف العقار بنجاح.", "success");
                    function explode(){
                        window.location.href = "php/delete_property.php?property_id=" + id;

                    }
                    setTimeout(explode, 1200);
                } else {
                    swal("Cancelled", "تم إيقاف عملية الحذف", "error");
                }
            });
    };
</script>
<script>
    $(document).on("click", ".property_payment_receive", function () {
        var payment_id = $(this).data('id');
        var property_id = "<?php echo $property_id ?>";
        $(".modal-body #payment_id").val( payment_id );
        $(".modal-body #property_id").val( property_id );
    });
</script>
</body>
</html>