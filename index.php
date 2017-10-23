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
                                                            SELECT COALESCE(SUM(expense.value),0) AS value
                                                            From expense
                                                            Where expense.status = 1 And Month(expense.date) = $month And expense.site_id = $site_info[id]") or die(mysqli_error($con));
                                                            $count_expenses_info = mysqli_fetch_assoc($count_expenses_query);

                                                        $count_custodies_query = mysqli_query($con,"
                                                            Select Coalesce(Sum(custoder_accounting.value), 0) As value
                                                            From custoder_accounting
                                                            Where custoder_accounting.site_id = $site_info[id] And Month(custoder_accounting.date)  = $month And custoder_accounting.status = 1 And custoder_accounting.type = 0") or die(mysqli_error($con));
                                                        $count_custodies_info = mysqli_fetch_assoc($count_custodies_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_expenses_info['value'] + $count_custodies_info['value']?></h2>
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
                                                        $month = date('m');
                                                        $count_payment_query = mysqli_query($con,"
                                                            Select Coalesce(Sum(payment.value), 0) As value
                                                            From payment
                                                              Inner Join property On property.id = payment.property_id
                                                              Inner Join tower On tower.id = property.tower_id
                                                              Inner Join site On tower.site_id = site.id
                                                            Where payment.status = 1 And Month(payment.payment_date)  = $month And payment.removed = 0 And site.id = $site_info[id]") or die(mysqli_error($con));
                                                        $count_payment_info = mysqli_fetch_assoc($count_payment_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_payment_info['value']?></h2>
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
                                                        $week = date('W');
                                                        $count_expenses_query = mysqli_query($con,"
                                                            SELECT COALESCE(SUM(expense.value),0) AS value
                                                            From expense
                                                            Where expense.status = 1 And WEEK(expense.date) = $week And expense.site_id = $site_info[id]") or die(mysqli_error($con));
                                                        $count_expenses_info = mysqli_fetch_assoc($count_expenses_query);

                                                        $count_custodies_query = mysqli_query($con,"
                                                            Select Coalesce(Sum(custoder_accounting.value), 0) As value
                                                            From custoder_accounting
                                                            Where custoder_accounting.site_id = $site_info[id] And WEEK(custoder_accounting.date)  = $week And custoder_accounting.status = 1 And custoder_accounting.type = 0") or die(mysqli_error($con));
                                                        $count_custodies_info = mysqli_fetch_assoc($count_custodies_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_expenses_info['value'] + $count_custodies_info['value']?></h2>                                                    </div>
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
                                                        $week = date('W');
                                                        $count_payment_query = mysqli_query($con,"
                                                            Select Coalesce(Sum(payment.value), 0) As value
                                                            From payment
                                                              Inner Join property On property.id = payment.property_id
                                                              Inner Join tower On tower.id = property.tower_id
                                                              Inner Join site On tower.site_id = site.id
                                                            Where payment.status = 1 And WEEK(payment.payment_date)  = $week And payment.removed = 0 And site.id = $site_info[id]") or die(mysqli_error($con));
                                                        $count_payment_info = mysqli_fetch_assoc($count_payment_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_payment_info['value']?></h2>                                                    </div>
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
                                                        $month = date('m');
                                                        $count_payment_query = mysqli_query($con,"
                                                            Select Coalesce(Sum(payment.value), 0) As value
                                                            From payment
                                                              Inner Join property On property.id = payment.property_id
                                                              Inner Join tower On tower.id = property.tower_id
                                                              Inner Join site On site.id = tower.site_id
                                                            Where payment.status = 0 And Month(payment.due_date) = $month And payment.removed = 0 And site.id = $site_info[id] ") or die(mysqli_error($con));
                                                        $count_payment_info = mysqli_fetch_assoc($count_payment_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_payment_info['value'] ?></h2>
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
                                                        $week = date('W');
                                                        $count_payment_query = mysqli_query($con,"
                                                            Select Coalesce(Sum(payment.value), 0) As value
                                                            From payment
                                                              Inner Join property On property.id = payment.property_id
                                                              Inner Join tower On tower.id = property.tower_id
                                                              Inner Join site On site.id = tower.site_id
                                                            Where payment.status = 0 And WEEK(payment.due_date) = $week And payment.removed = 0 And site.id = $site_info[id] ") or die(mysqli_error($con));
                                                        $count_payment_info = mysqli_fetch_assoc($count_payment_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_payment_info['value'] ?></h2>
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
                                                        $today = date('j');
                                                        $count_payment_query = mysqli_query($con,"
                                                            Select Coalesce(Sum(payment.value), 0) As value
                                                            From payment
                                                              Inner Join property On property.id = payment.property_id
                                                              Inner Join tower On tower.id = property.tower_id
                                                              Inner Join site On site.id = tower.site_id
                                                            Where payment.status = 0 And DATE(payment.due_date) = CURDATE() And payment.removed = 0 And site.id = $site_info[id] ") or die(mysqli_error($con));
                                                        $count_payment_info = mysqli_fetch_assoc($count_payment_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_payment_info['value'] ?></h2>
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
                                                            Select Coalesce(Sum(payment.value), 0) As value
                                                            From payment
                                                              Inner Join property On property.id = payment.property_id
                                                              Inner Join tower On tower.id = property.tower_id
                                                              Inner Join site On site.id = tower.site_id
                                                            Where payment.status = 0 And DATE(payment.due_date) <= CURDATE() And payment.removed = 0 And site.id = $site_info[id] ") or die(mysqli_error($con));
                                                        $count_payment_info = mysqli_fetch_assoc($count_payment_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_payment_info['value'] ?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="widget style1 blue-bg">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <i class="fa fa-home fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-8 text-right">
                                                        <span class="arabic"> تم البيع </span>
                                                        <?php
                                                        $count_properties_query = mysqli_query($con,"
                                                                Select Count(owner_has_property.id) As property_count
From owner_has_property
  Inner Join property On property.id = owner_has_property.property_id
  Inner Join tower On property.tower_id = tower.id
  Inner Join site On tower.site_id = site.id
  Inner Join property_type On property_type.id = property.property_type_id
  Inner Join payment On payment.property_id = property.id
Where owner_has_property.status = 1 And site.id = $site_info[id] And property_type.id = 3 And
  payment.status = 1 And payment.removed = 0 Group By property.id") or die(mysqli_error($con));
                                                        $count_properties_info = mysqli_fetch_assoc($count_properties_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_properties_info['property_count'] ?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="widget style1 yellow-bg">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <i class="fa fa-home fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-8 text-right">
                                                        <span class="arabic"> محجوز </span>
                                                        <?php
                                                        $count_properties_query = mysqli_query($con,"
                                                                Select Count(owner_has_property.id) As property_count
From owner_has_property
  Inner Join property On property.id = owner_has_property.property_id
  Inner Join tower On property.tower_id = tower.id
  Inner Join site On tower.site_id = site.id
  Inner Join property_type On property_type.id = property.property_type_id
  Inner Join payment On payment.property_id = property.id
Where owner_has_property.status = 1 And site.id = $site_info[id] And property_type.id = 3 And
  payment.status = 0 And payment.removed = 0 Group By property.id") or die(mysqli_error($con));
                                                        $count_properties_info = mysqli_fetch_assoc($count_properties_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_properties_info['property_count'] ?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="widget style1 red-bg">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <i class="fa fa-home fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-8 text-right">
                                                        <span class="arabic"> لم يتم بيعه </span>
                                                        <h2 class="font-bold">11</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="widget style1 lazur-bg">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <i class="fa fa-bank fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-8 text-right">
                                                        <span class="arabic"> تم البيع </span>
                                                        <?php
                                                        $count_properties_query = mysqli_query($con,"
                                                                Select Count(owner_has_property.id) As property_count
From owner_has_property
  Inner Join property On property.id = owner_has_property.property_id
  Inner Join tower On property.tower_id = tower.id
  Inner Join site On tower.site_id = site.id
  Inner Join property_type On property_type.id = property.property_type_id
  Inner Join payment On payment.property_id = property.id
Where owner_has_property.status = 1 And site.id = $site_info[id] And property_type.id = 4 And
  payment.status = 1 And payment.removed = 0 Group By property.id") or die(mysqli_error($con));
                                                        $count_properties_info = mysqli_fetch_assoc($count_properties_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_properties_info['property_count'] ?></h2>                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="widget style1 yellow-bg">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <i class="fa fa-bank fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-8 text-right">
                                                        <span class="arabic"> محجوز </span>
                                                        <?php
                                                        $count_properties_query = mysqli_query($con,"
                                                                Select Count(owner_has_property.id) As property_count
From owner_has_property
  Inner Join property On property.id = owner_has_property.property_id
  Inner Join tower On property.tower_id = tower.id
  Inner Join site On tower.site_id = site.id
  Inner Join property_type On property_type.id = property.property_type_id
  Inner Join payment On payment.property_id = property.id
Where owner_has_property.status = 1 And site.id = $site_info[id] And property_type.id = 4 And
  payment.status = 0 And payment.removed = 0 Group By property.id") or die(mysqli_error($con));
                                                        $count_properties_info = mysqli_fetch_assoc($count_properties_query);
                                                        ?>
                                                        <h2 class="font-bold"><?php echo $count_properties_info['property_count'] ?></h2>                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="widget style1 red-bg">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <i class="fa fa-bank fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-8 text-right">
                                                        <span class="arabic"> لم يتم بيعه </span>
                                                        <h2 class="font-bold">11</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <br><br><br>
                                            <div id="lineChart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }?>
            <div class="row">
                <div class="col-lg-4">
                    <div class="widget-head-color-box navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <h2 class="font-bold no-margins">
                                <span class="arabic">عهدة حمادة</span>
                            </h2>
                        </div>
                        <img src="img/a4.jpg" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="widget-text-box">
                        <div class="text-center">
                            <a href=""><button class="btn btn-primary  dim btn-large-dim" type="button"><span class="vbig">332111</span></button></a>
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


<script src="js/plugins/dataTables/datatables.min.js"></script>
<script>
    function format(value) {
        return '<div class="middle wrap col-sm-12"  >' + value + '</div>';
    }
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
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
</body>
<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Jul 2017 11:39:12 GMT -->


</html>