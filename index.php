<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
include_once "php/functions.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'الصفحة الرئيسية';
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
<!--        --><?php //echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>'; ?>
        <div class="row wrapper border-bottom white-bg page-heading animated fadeInLeftBig">
            <div class="col-sm-4">
                <h2><p>الصفحة الرئيسية</p></h2>
            </div>
        </div>
        <div class="wrapper wrapper-content animated bounceInDown">
            <?php

            $site_query = mysqli_query($con,"Select site.name, site.id From site") or die(mysqli_error($con));
            while($site_info = mysqli_fetch_assoc($site_query))
            {
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <font face="myFirstFont"><h5>تفاصيل موقع <?php echo $site_info['name']?></h5></font>
                            <div class="ibox-tools">
                                <button class="btn btn-danger" type="button"  onclick="delete_site(<?php echo $site_info['id'] ?>)">
                                    <font face="myFirstFont">
                                    لإزالة الموقع
                                    </font>
                                </button>
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="wrapper wrapper-content animated fadeInRight">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="widget style1 red-bg">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-usd fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <span class="small_arabic font-bold">ما تم صرفه خلال الشهر </span>
                                                        <?php
                                                        $month = date('m');
                                                        $count_expenses_query = mysqli_query($con,"
                                                        Select Coalesce(Sum(transaction.value), 0) As Count_value
                                                        From transaction
                                                        Where transaction.site_id = $site_info[id] And Month(transaction.date_1) = $month And transaction.removed = 0 And transaction.flag_id In (4, 5)") or die(mysqli_error($con));
                                                            $count_expenses_info = mysqli_fetch_assoc($count_expenses_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_expenses_info['Count_value']*-1?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="widget style1 blue-bg">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-usd fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <span class="small_arabic font-bold">ما تم توريده خلال الشهر </span>
                                                        <?php
                                                        $count_payment_query = mysqli_query($con,"
                                                        select Coalesce(Sum(transaction.value), 0) As Count_value
From transaction
  Inner Join property On property.id = transaction.property_id
  Inner Join tower On property.tower_id = tower.id
  Inner Join site On tower.site_id = site.id
Where Month(transaction.date_2) = Month(curdate()) And transaction.status = 1 And
  transaction.removed = 0 And transaction.flag_id In (1, 2, 3) And site.id = $site_info[id]") or die(mysqli_error($con));
                                                        $count_payment_info = mysqli_fetch_assoc($count_payment_query);

                                                        $count_partner_income_query = mysqli_query($con,"
                                                        select Coalesce(Sum(transaction.value), 0) As Count_value
From transaction
  Inner Join site On transaction.site_id = site.id
Where Month(transaction.date_1) = Month(curdate()) And transaction.status = 1 And
  transaction.removed = 0 And transaction.flag_id In (8) And site.id = $site_info[id]") or die(mysqli_error($con));
                                                        $count_partner_income_info = mysqli_fetch_assoc($count_partner_income_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_payment_info['Count_value']+$count_partner_income_info['Count_value']?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="widget style1 red-bg">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-usd fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <span class="small_arabic font-bold">ما تم صرفه خلال الإسبوع </span>

                                                        <?php
                                                        $count_expenses_query = mysqli_query($con,"
                                                        Select Coalesce(Sum(transaction.value), 0) As Count_value
                                                        From transaction
                                                        Where transaction.site_id = $site_info[id] And WEEK(transaction.date_1) = WEEK(curdate()) And transaction.removed = 0 And transaction.flag_id In (4, 5)") or die(mysqli_error($con));
                                                        $count_expenses_info = mysqli_fetch_assoc($count_expenses_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_expenses_info['Count_value']*-1?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="widget style1 blue-bg">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-usd fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <span class="small_arabic font-bold">ما تم توريده خلال الإسبوع </span>
                                                        <?php
                                                        $count_payment_query = mysqli_query($con,"
                                                        select Coalesce(Sum(transaction.value), 0) As Count_value
From transaction
  Inner Join property On property.id = transaction.property_id
  Inner Join tower On property.tower_id = tower.id
  Inner Join site On tower.site_id = site.id
Where WEEK(transaction.date_2) = WEEK(curdate()) And transaction.status = 1 And
  transaction.removed = 0 And transaction.flag_id In (1, 2, 3, 8) And site.id = $site_info[id]") or die(mysqli_error($con));
                                                        $count_payment_info = mysqli_fetch_assoc($count_payment_query);

                                                        $count_partner_income_query = mysqli_query($con,"
                                                        select Coalesce(Sum(transaction.value), 0) As Count_value
From transaction
  Inner Join site On transaction.site_id = site.id
Where WEEK(transaction.date_1) = WEEK(curdate()) And transaction.status = 1 And
  transaction.removed = 0 And transaction.flag_id In (8) And site.id = $site_info[id]") or die(mysqli_error($con));
                                                        $count_partner_income_info = mysqli_fetch_assoc($count_partner_income_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_payment_info['Count_value']+$count_partner_income_info['Count_value']?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="widget style1 red-bg">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-usd fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <span class="small_arabic font-bold"> المطلوب تحصيلة خلال الشهر </span>
                                                        <?php
                                                        $count_payment_query = mysqli_query($con,"
                                                        Select Coalesce(Sum(transaction.value), 0) As Count_value
From transaction
  Inner Join property On property.id = transaction.property_id
  Inner Join tower On tower.id = property.tower_id
  Inner Join site On tower.site_id = site.id
Where Month(transaction.date_1) = Month(CurDate()) And transaction.status = 0
  And transaction.removed = 0 And transaction.flag_id In (1, 2, 3, 9) And
  site.id = $site_info[id]") or die(mysqli_error($con));
                                                        $count_payment_info = mysqli_fetch_assoc($count_payment_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_payment_info['Count_value']?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="widget style1 red-bg">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-usd fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <span class="small_arabic font-bold">
                                                            المطلوب تحصيلة خلال الإسبوع
                                                        </span>
                                                        <?php
                                                        $count_payment_query = mysqli_query($con,"
                                                        Select Coalesce(Sum(transaction.value), 0) As Count_value
From transaction
  Inner Join property On property.id = transaction.property_id
  Inner Join tower On tower.id = property.tower_id
  Inner Join site On tower.site_id = site.id
Where WEEK(transaction.date_1) = WEEK(CurDate()) And transaction.status = 0
  And transaction.removed = 0 And transaction.flag_id In (1, 2, 3, 9) And
  site.id = $site_info[id]") or die(mysqli_error($con));
                                                        $count_payment_info = mysqli_fetch_assoc($count_payment_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_payment_info['Count_value']?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="widget style1 red-bg">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-usd fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <span class="small_arabic font-bold">
                                                            المطلوب تحصيلة خلال اليوم
                                                        </span>
                                                        <?php
                                                        $count_payment_query = mysqli_query($con,"
                                                        Select Coalesce(Sum(transaction.value), 0) As Count_value
From transaction
  Inner Join property On property.id = transaction.property_id
  Inner Join tower On tower.id = property.tower_id
  Inner Join site On tower.site_id = site.id
Where transaction.date_1 = CurDate() And transaction.status = 0
  And transaction.removed = 0 And transaction.flag_id In (1, 2, 3, 9) And
  site.id = $site_info[id]") or die(mysqli_error($con));
                                                        $count_payment_info = mysqli_fetch_assoc($count_payment_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_payment_info['Count_value']?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="widget style1 red-bg">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-usd fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <span class="small_arabic font-bold">ما لم يتم تحصيلة حتى الأن</span>
                                                        <?php
                                                        $count_payment_query = mysqli_query($con,"
                                                        Select Coalesce(Sum(transaction.value), 0) As Count_value
From transaction
  Inner Join property On property.id = transaction.property_id
  Inner Join tower On tower.id = property.tower_id
  Inner Join site On tower.site_id = site.id
Where transaction.date_1 <= CurDate() And transaction.status = 0
  And transaction.removed = 0 And transaction.flag_id In (1, 2, 3, 9) And
  site.id = $site_info[id]") or die(mysqli_error($con));
                                                        $count_payment_info = mysqli_fetch_assoc($count_payment_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_payment_info['Count_value']?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php
                                        $count_properties_query = mysqli_query($con,"
Select Count(Distinct(property.id)) As property_count,
  property_type.name
From property
  Inner Join property_type On property.property_type_id = property_type.id
  Inner Join tower On property.tower_id = tower.id
  Inner Join site On tower.site_id = site.id
  Inner Join owner_has_property On owner_has_property.property_id = property.id
  Inner Join transaction On property.id = transaction.property_id And
    owner_has_property.owner_id = transaction.owner_id
Where property.id Not In (Select property.id
  From property Inner Join property_type On property.property_type_id =
      property_type.id Inner Join tower On property.tower_id = tower.id
    Inner Join site On tower.site_id = site.id Inner Join owner_has_property
      On owner_has_property.property_id = property.id Inner Join transaction
      On property.id = transaction.property_id And owner_has_property.owner_id =
      transaction.owner_id
  Where transaction.flag_id In (1, 2, 3) And owner_has_property.status = 1 And site.id = $site_info[id] And transaction.status = 0
  Group By property.id) And transaction.flag_id In (1, 2, 3)And owner_has_property.status = 1 And site.id = $site_info[id] And
  transaction.status = 1
Group By 
  property_type.name
  ") or die(mysqli_error($con));
                                        while($count_properties_info = mysqli_fetch_assoc($count_properties_query))
                                        {
                                            ?>
                                            <div class="col-lg-2">
                                                <div class="widget style1 blue-bg">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <span class="arabic"><?php echo $count_properties_info['name'] ?></span>
                                                        </div>
                                                        <div class="col-xs-8 text-right">
                                                            <span class="arabic"> تم السداد </span>

                                                            <h2 class="font-bold"><?php echo $count_properties_info['property_count'] ?></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        $count_properties_query = mysqli_query($con,"

Select Count(Distinct property.id) As property_count,
  property_type.name
From property
  Inner Join owner_has_property On owner_has_property.property_id = property.id
  Inner Join property_type On property_type.id = property.property_type_id
  Inner Join tower On property.tower_id = tower.id
  Inner Join site On tower.site_id = site.id
  Inner Join transaction On transaction.property_id = property.id
Where site.id = $site_info[id] And transaction.status = 0 And transaction.removed = 0 And
  transaction.flag_id In (1, 2, 3) And owner_has_property.status = 1
Group By property_type.name
") or die(mysqli_error($con));
                                        while($count_properties_info = mysqli_fetch_assoc($count_properties_query))
                                        {
                                            ?>
                                            <div class="col-lg-2">
                                                <div class="widget style1 yellow-bg">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <span class="arabic"><?php echo $count_properties_info['name'] ?></span>
                                                        </div>
                                                        <div class="col-xs-8 text-right">
                                                            <span class="arabic"> تم البيع </span>

                                                            <h2 class="font-bold"><?php echo $count_properties_info['property_count'] ?></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        $count_properties_query = mysqli_query($con,"

Select Count(Distinct property.id) As property_count,
  property_type.name
From property
  Inner Join property_type On property_type.id = property.property_type_id
  Inner Join tower On tower.id = property.tower_id
  Inner Join site On tower.site_id = site.id
  Left Join owner_has_property On owner_has_property.property_id = property.id
Where site.id = $site_info[id] And (property.id Not In (Select property.id
  From property Inner Join property_type On property_type.id =
      property.property_type_id Inner Join tower On tower.id = property.tower_id
    Inner Join site On tower.site_id = site.id Left Join owner_has_property
      On owner_has_property.property_id = property.id
  Where owner_has_property.status = 1)) Or
  (owner_has_property.status Is Null)
Group By property_type.name 
") or die(mysqli_error($con));
                                        while($count_properties_info = mysqli_fetch_assoc($count_properties_query))
                                        {
                                            ?>
                                            <div class="col-lg-2">
                                                <div class="widget style1 red-bg">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <span class="arabic"><?php echo $count_properties_info['name'] ?></span>
                                                        </div>
                                                        <div class="col-xs-8 text-right">
                                                            <span class="arabic"> لم يتم بيعه </span>

                                                            <h2 class="font-bold"><?php echo $count_properties_info['property_count'] ?></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
<!--                                        <div class="col-lg-12">-->
<!--                                            <br><br><br>-->
<!--                                            <div id="lineChart"></div>-->
<!--                                        </div>-->
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="widget style1 navy-bg">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-usd fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <span class="small_arabic font-bold">إجمالي سعر الوحدات بعد البيع</span>
                                                        <?php
                                                        $count_all_income_query = mysqli_query($con,"
                                                        Select Coalesce(Sum(transaction.value), 0) As sum_transaction_value
From transaction
  Inner Join property On property.id = transaction.property_id
  Inner Join tower On tower.id = property.tower_id
  Inner Join site On site.id = tower.site_id
Where transaction.removed = 0 And transaction.flag_id In (1, 2, 3, 9) And
  site.id = $site_info[id]") or die(mysqli_error($con));
                                                        $count_all_income = mysqli_fetch_assoc($count_all_income_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_all_income['sum_transaction_value']?></h2>
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
            <?php
            }?>
            <?php
            $custoders_query = mysqli_query($con,"

Select custoder.name,
  custoder.id
From custoder 
") or die(mysqli_error($con));
            while($custoders_info = mysqli_fetch_assoc($custoders_query)) {
                $get_spent_value_query="
                        Select COALESCE(SUM(transaction.value),0) As spent_count
From custoder
  Inner Join transaction On custoder.id = transaction.custoder_id
Where custoder.id = $custoders_info[id] And transaction.removed = 0 And transaction.flag_id = 5";

                $get_received_value_query="
                        Select COALESCE(SUM(transaction.value),0) As received_count
From custoder
  Inner Join transaction On custoder.id = transaction.custoder_id
Where custoder.id = $custoders_info[id] And transaction.removed = 0 And transaction.flag_id = 6";


            $get_spent_value = mysqli_query($con, $get_spent_value_query);
            $get_spent_value = mysqli_fetch_assoc($get_spent_value);

            $get_received_value = mysqli_query($con, $get_received_value_query);
            $get_received_value = mysqli_fetch_assoc($get_received_value);
                ?>
                    <div class="col-lg-4">
                        <div class="widget-head-color-box navy-bg p-lg text-center">
                            <div class="m-b-md">
                                <h2 class="font-bold no-margins">
                                    <span class="arabic"><?php echo $custoders_info['name'] ?></span>
                                </h2>
                            </div>
                            <img src="img/a4.jpg" class="img-circle circle-border m-b-md" alt="profile">
                        </div>
                        <div class="widget-text-box">
                            <div class="text-center">
                                <a href="custoder.php?custoder_id=<?php echo $custoders_info['id']; ?>">
                                    <button class="btn btn-primary  dim btn-large-dim" type="button">
                                        <span class="hvbig">
                                            <?php
                                            echo ($get_received_value['received_count']*-1)+($get_spent_value['spent_count']);
                                            ?>
                                        </span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
            }
            ?>
            </div>
        </div>
        <div class="footer">
            <div>
                <strong>Copyright</strong> We.Code &copy; 2017
            </div>
        </div>
    </div>
</div>

<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- d3 and c3 charts -->
<script src="js/plugins/d3/d3.min.js"></script>
<script src="js/plugins/c3/c3.min.js"></script>

<!-- Select2 -->
<script src="js/plugins/select2/select2.full.min.js"></script>

<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>

<!-- Toastr -->
<script src="js/plugins/toastr/toastr.min.js"></script>

<!-- Sweet alert -->
<script src="js/plugins/sweetalert/sweetalert.min.js"></script>

<script src="js/plugins/dataTables/datatables.min.js"></script>
<script>
    function format(value) {
        return '<div class="middle wrap col-sm-12"  >' + value + '</div>';
    }
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
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
                targets: 1
            }],
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
        $('.chosen-select').chosen({width: "100%"});
        $(".category").select2({
            placeholder: "Select a category",
            allowClear: true
        });
        $(".storepros").select2({
            placeholder: "Select a prosecution",
            allowClear: true
        });
        // Setup - add a text input to each footer cell
        $('#example tfoot th').not("").each(function() {
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
    $(document).ready(function () {
        c3.generate({
            bindto: '#lineChart',
            size: {
                height: '100%',
            },
            data: {
                x : 'x',
                columns: [
                    ['x', 'شهر 10', 'شهر 9', 'شهر 8', 'شهر 7', 'شهر 6', 'شهر 5'],
                    ['الإيراد', '55445', '55415', '44332', '28394', '14445', '55113' ],
                    ['المصروف', '12111', '44', '31', '12511', '54', '53' ],
                ],
            },
            axis: {
                x: {
                    type: 'category',
                    tick: {
                        rotate: 0,
                        size: 15,
                        multiline: false,
                    },
                }
            }
        });
    });
</script>
<script>
    function delete_site(id){
        swal({
                title: "هل أنت متأكد؟",
                text: "هذا الموقع سيتم إلغائه!!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "تم حذف الموقع بنجاح.", "success");
                    function explode(){
                        window.location.href = "php/delete_site.php?site_id=" + id;

                    }
                    setTimeout(explode, 1200);
                } else {
                    swal("Cancelled", "تم إيقاف عملية الحذف", "error");
                }
            });
    };
</script>
</body>
<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Jul 2017 11:39:12 GMT -->


</html>