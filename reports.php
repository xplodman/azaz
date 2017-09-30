<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
include_once "php/functions.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'Reports';
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
                <h2><p>Reports</p></h2>
            </div>
        </div>
        <div class="wrapper wrapper-content animated bounceInDown">
            <div class="row">
                <div class="col-lg-3">
                    <div class="widget style1 yellow-bg">
                        <div class="row vertical-align">
                            <div class="col-xs-12 text-center">
                                <h3 class="font-bold">Remain first year : <?php sumincome("1")?> جنيه</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 yellow-bg">
                        <div class="row vertical-align">
                            <div class="col-xs-12 text-center">
                                <h3 class="font-bold">Remain second year : <?php sumincome("2")?> جنيه</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 yellow-bg">
                        <div class="row vertical-align">
                            <div class="col-xs-12 text-center">
                                <h3 class="font-bold">Remain third year : <?php sumincome("3")?> جنيه</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 yellow-bg">
                        <div class="row vertical-align">
                            <div class="col-xs-12 text-center">
                                <h3 class="font-bold">Remain fourth year : <?php sumincome("4")?> جنيه</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>In first year</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div id="chart1"></div>
                                Total :
                                <?php
                                $result = mysqli_query($con,"SELECT   
  Sum(tickets.tiamount)  AS amount                 
From tickets
  Inner Join students On students.stid = tickets.tidonor
Where tickets.titype in ('1') And students.styear = '1'");
                                $y = mysqli_fetch_assoc($result);

                                echo $y['amount'];
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>In second year</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div id="chart2"></div>
                                Total :
                                <?php
                                $result = mysqli_query($con,"SELECT   
  Sum(tickets.tiamount)  AS amount                 
From tickets
  Inner Join students On students.stid = tickets.tidonor
Where tickets.titype in ('1') And students.styear = '2'");
                                $y = mysqli_fetch_assoc($result);

                                echo $y['amount'];
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>In third year</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div id="chart3"></div>
                                Total :
                                <?php
                                $result = mysqli_query($con,"SELECT   
  Sum(tickets.tiamount)  AS amount                 
From tickets
  Inner Join students On students.stid = tickets.tidonor
Where tickets.titype in ('1') And students.styear = '3'");
                                $y = mysqli_fetch_assoc($result);

                                echo $y['amount'];
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>In fourth year</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div id="chart4"></div>
                                Total :
                                <?php
                                $result = mysqli_query($con,"SELECT   
  Sum(tickets.tiamount)  AS amount                 
From tickets
  Inner Join students On students.stid = tickets.tidonor
Where tickets.titype in ('1') And students.styear = '4'");
                                $y = mysqli_fetch_assoc($result);

                                echo $y['amount'];
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Out summary</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div id="chart5"></div>
                                Total :
                                <?php
                                $result = mysqli_query($con,"SELECT    
  Sum(tickets.tiamount) AS amount                 
From tickets
Where tickets.titype = '2'");
                                $y = mysqli_fetch_assoc($result);

                                echo $y['amount'];
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Aid summary</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div id="chart6"></div>
                                Total :
                                <?php
                                $result = mysqli_query($con,"SELECT    
  Sum(tickets.tiamount) AS amount        
From tickets
Where tickets.tireason = 'm0'");
                                $y = mysqli_fetch_assoc($result);

                                echo $y['amount'];
                                ?>
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
            columnDefs: [{
                targets: 0,
                visible: false
            }],
            order: [2, 'asc']

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
        $('#example tfoot th').not(":eq(0)").each(function() {
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
    var chart = c3.generate({
        bindto: "#chart1",
        data: {
            columns: [
                <?php
                    $first_new = summary_all_in(1,'1');
                    while($y = mysqli_fetch_assoc($first_new)) {
                        echo "['".$y['reason']."','".$y['amount']."'],";
                    }
                ?>
            ],
            type: 'pie',
            empty: {
                label: {
                    text: "No Data Available"
                }
            }
        },
        pie: {
            label: {
                format: function(value, ratio, id) {
                    return value;
                }
            }
        }
    });
    var chart = c3.generate({
        bindto: "#chart2",
        data: {
            columns: [
                <?php
                    $first_new = summary_all_in(1,'2');
                    while($y = mysqli_fetch_assoc($first_new)) {
                        echo "['".$y['reason']."','".$y['amount']."'],";
                    }
                ?>

            ],
            type: 'pie',
            empty: {
                label: {
                    text: "No Data Available"
                }
            }
        },
        pie: {
            label: {
                format: function(value, ratio, id) {
                    return value;
                }
            }
        }
    });
    var chart = c3.generate({
        bindto: "#chart3",
        data: {
            columns: [
                <?php
                $first_new = summary_all_in(1,'3');
                while($y = mysqli_fetch_assoc($first_new)) {
                    echo "['".$y['reason']."','".$y['amount']."'],";
                }
                ?>

            ],
            type: 'pie',
            empty: {
                label: {
                    text: "No Data Available"
                }
            }
        },
        pie: {
            label: {
                format: function(value, ratio, id) {
                    return value;
                }
            }
        }
    });
    var chart = c3.generate({
        bindto: "#chart4",
        data: {
            columns: [
                <?php
                $first_new = summary_all_in(1,'4');
                while($y = mysqli_fetch_assoc($first_new)) {
                    echo "['".$y['reason']."','".$y['amount']."'],";
                }
                ?>

            ],
            type: 'pie',
            empty: {
                label: {
                    text: "No Data Available"
                }
            }
        },
        pie: {
            label: {
                format: function(value, ratio, id) {
                    return value;
                }
            }
        }
    });
    var chart = c3.generate({
        bindto: "#chart5",
        data: {
            columns: [
                <?php
                $first_new = summary_all_out(2);
                while($y = mysqli_fetch_assoc($first_new)) {
                    echo "['".$y['reason']."','".$y['amount']."'],";
                }
                ?>

            ],
            type: 'donut',
            empty: {
                label: {
                    text: "No Data Available"
                }
            }
        },
        donut: {
            label: {
                format: function(value, ratio, id) {
                    return value;
                }
            }
        }
    });
    var chart = c3.generate({
        bindto: "#chart6",
        data: {
            columns: [
                <?php
                $first_new = summary_all_aid();
                while($y = mysqli_fetch_assoc($first_new)) {
                    echo "['".$y['year']."','".$y['amount']."'],";
                }
                ?>

            ],
            type: 'donut',
            empty: {
                label: {
                    text: "No Data Available"
                }
            }
        },
        donut: {
            label: {
                format: function(value, ratio, id) {
                    return value;
                }
            }
        }
    });
</script>
</body>
</html>