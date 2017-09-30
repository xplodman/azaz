<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
include_once "php/functions.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'Dashboard';
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
                <h2><p>Dashboard</p></h2>
            </div>
        </div>

        <div class="wrapper wrapper-content animated bounceInDown">
            <div class="row">
                <div class="col-lg-3">
                    <div class="widget-head-color-box navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <h2 class="font-bold no-margins">
                                First year
                            </h2>
                        </div>
                        <img src="images/first-year-plan_0.png" height="120">
                        <div>
                            <h2 class="font-bold no-margins">
                                <?php
                                student_count("1");
                                ?>
                                 student
                            </h2>
                        </div>
                        <div>
                            <span>Gourp A : <?php student_summary("1","students.stgroup","A")?></span> |
                            <span>Gourp B : <?php student_summary("1","students.stgroup","B")?></span> <br>
                            <span>Gourp C : <?php student_summary("1","students.stgroup","C")?></span> |
                            <span>Gourp E : <?php student_summary("1","students.stgroup","E")?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget-head-color-box navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <h2 class="font-bold no-margins">
                                Second year
                            </h2>
                        </div>
                        <img src="images/second-year-plan_0.png" height="120">
                        <div>
                            <h2 class="font-bold no-margins">
                                <?php
                                student_count("2");
                                ?>
                                student
                            </h2>
                        </div>
                        <div>
                            <span>Gourp A : <?php student_summary("2","students.stgroup","A")?></span> |
                            <span>Gourp B : <?php student_summary("2","students.stgroup","B")?></span> <br>
                            <span>Gourp C : <?php student_summary("2","students.stgroup","C")?></span> |
                            <span>Gourp E : <?php student_summary("2","students.stgroup","E")?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget-head-color-box navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <h2 class="font-bold no-margins">
                                Third year
                            </h2>
                        </div>
                        <img src="images/third-year-plan_0.png" height="120">
                        <div>
                            <h2 class="font-bold no-margins">
                                <?php
                                student_count("3");
                                ?>
                                student
                            </h2>
                        </div>
                        <div>
                            <span>Gourp A : <?php student_summary("3","students.stgroup","A")?></span> |
                            <span>Gourp B : <?php student_summary("3","students.stgroup","B")?></span> <br>
                            <span>Gourp C : <?php student_summary("3","students.stgroup","C")?></span> |
                            <span>Gourp E : <?php student_summary("3","students.stgroup","E")?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget-head-color-box navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <h2 class="font-bold no-margins">
                                Fourth year
                            </h2>
                        </div>
                        <img src="images/fourth-year-plan_0.png" height="120">
                        <div>
                            <h2 class="font-bold no-margins">
                                <?php
                                student_count("4");
                                ?>
                                student
                            </h2>
                        </div>
                        <div>
                            <span>Gourp A : <?php student_summary("4","students.stgroup","A")?></span> |
                            <span>Gourp B : <?php student_summary("4","students.stgroup","B")?></span> <br>
                            <span>Gourp C : <?php student_summary("4","students.stgroup","C")?></span> |
                            <span>Gourp E : <?php student_summary("4","students.stgroup","E")?></span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>This chart shows the count of student per year by nature</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div id="chart1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>This chart shows the count of student per year by type</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div id="chart2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>This chart shows the count of student per material by nature</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <table id="example" class=" dataTables-example table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Material / Nature</th>
                                        <th>إنتظام</th>
                                        <th>إنتساب</th>
                                        <th>المجموع</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    $result4 = mysqli_query($con, "SELECT * FROM `material`");
                                    while($row4 = mysqli_fetch_assoc($result4))
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $row4['matname'] ?></td>
                                            <td><?php
                                                $matid=$row4['matid'];
                                                echo $first_entezam = material_summary_detail($matid,'students.sttype','1');
                                                ?>
                                            </td>
                                            <td><?php
                                                $matid=$row4['matid'];
                                                echo $first_entesab = material_summary_detail($matid,'students.sttype','2');
                                                ?>
                                            </td>
                                            <td><?php echo $first_entezam+$first_entesab ?></td>
                                        </tr>
                                        <?php
                                    };
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
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

<?php
$first_entzam = student_summary_detail(1,'students.sttype',1);
$second_entzam = student_summary_detail(2,'students.sttype',1);
$third_entzam = student_summary_detail(3,'students.sttype',1);
$fourth_entzam = student_summary_detail(4,'students.sttype',1);

$first_entesab = student_summary_detail(1,'students.sttype',2);
$second_entesab = student_summary_detail(2,'students.sttype',2);
$third_entesab = student_summary_detail(3,'students.sttype',2);
$fourth_entesab = student_summary_detail(4,'students.sttype',2);
$php_data = array(
    'x_labels' => array('First', 'Second', 'Third', 'Fourth', ),
    'إنتظام' => array($first_entzam, $second_entzam, $third_entzam, $fourth_entzam),
    'إنتساب' => array($first_entesab, $second_entesab, $third_entesab, $fourth_entesab)
);
?>
<script>
    var json_data = <?php echo json_encode($php_data) ?>;
    var chart1 = c3.generate({
        bindto: "#chart1",
        data: {
            x: 'x_labels',
            json: json_data,
            type: 'bar',
            groups: [
                ['إنتظام', 'إنتساب']
            ]
        },
        axis: {
            x: {
                type: 'category'
            },
        }
    });

</script>
<?php
$first_new = student_summary_detail(1,'students.sttype2','A');
$second_new = student_summary_detail(2,'students.sttype2','A');
$third_new = student_summary_detail(3,'students.sttype2','A');
$fourth_new = student_summary_detail(4,'students.sttype2','A');

$first_old = student_summary_detail(1,'students.sttype2','B');
$second_old = student_summary_detail(2,'students.sttype2','B');
$third_old = student_summary_detail(3,'students.sttype2','B');
$fourth_old = student_summary_detail(4,'students.sttype2','B');

$first_final = student_summary_detail(1,'students.sttype2','C');
$second_final = student_summary_detail(2,'students.sttype2','C');
$third_final = student_summary_detail(3,'students.sttype2','C');
$fourth_final = student_summary_detail(4,'students.sttype2','C');
unset($php_data);
$php_data = array(
    'x_labels' => array('First', 'Second', 'Third', 'Fourth', ),
    'مستجد' => array($first_new, $second_new, $third_new, $fourth_new),
    'باقي إعادة' => array($first_old, $second_old, $third_old, $fourth_old),
    'مراجعة نهائية' => array($first_final, $second_final, $third_final, $fourth_final)
);
?>
<script>
    var json_data = <?php echo json_encode($php_data) ?>;
    var chart2 = c3.generate({
        bindto: "#chart2",
        data: {
            x: 'x_labels',
            json: json_data,
            type: 'bar',
            groups: [
                ['مستجد', 'باقي إعادة', 'مراجعة نهائية']
            ]
        },
        axis: {
            x: {
                type: 'category'
            },
        }
    });

</script>
<?php
$first_new = student_summary_detail(1,'students.sttype2','A');
$second_new = student_summary_detail(2,'students.sttype2','A');
$third_new = student_summary_detail(3,'students.sttype2','A');
$fourth_new = student_summary_detail(4,'students.sttype2','A');

$first_old = student_summary_detail(1,'students.sttype2','B');
$second_old = student_summary_detail(2,'students.sttype2','B');
$third_old = student_summary_detail(3,'students.sttype2','B');
$fourth_old = student_summary_detail(4,'students.sttype2','B');

$first_final = student_summary_detail(1,'students.sttype2','C');
$second_final = student_summary_detail(2,'students.sttype2','C');
$third_final = student_summary_detail(3,'students.sttype2','C');
$fourth_final = student_summary_detail(4,'students.sttype2','C');
unset($php_data);
$php_data = array(
    'x_labels' => array('First', 'Second', 'Third', 'Fourth', ),
    'مستجد' => array($first_new, $second_new, $third_new, $fourth_new),
    'باقي إعادة' => array($first_old, $second_old, $third_old, $fourth_old),
    'مراجعة نهائية' => array($first_final, $second_final, $third_final, $fourth_final)
);
?>
<script>
    var json_data = <?php echo json_encode($php_data) ?>;
    var chart2 = c3.generate({
        bindto: "#chart2",
        data: {
            x: 'x_labels',
            json: json_data,
            type: 'bar',
            groups: [
                ['مستجد', 'باقي إعادة', 'مراجعة نهائية']
            ]
        },
        axis: {
            x: {
                type: 'category'
            },
        }
    });

</script>

<?php
$first_entezam = material_summary_detail(1,'students.sttype','1');
$fourth_entesab = material_summary_detail(1,'students.sttype','2');
?>
<script>
    var json_data = <?php echo json_encode($php_data) ?>;
    var chart2 = c3.generate({
        bindto: "#chart2",
        data: {
            x: 'x_labels',
            json: json_data,
            type: 'bar',
            groups: [
                ['مستجد', 'باقي إعادة', 'مراجعة نهائية']
            ]
        },
        axis: {
            x: {
                type: 'category'
            },
        }
    });

</script>

</body>
<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Jul 2017 11:39:12 GMT -->


</html>