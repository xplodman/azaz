<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'Students';
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
                <h2><p>Students</p></h2>
            </div>
            <?php
            if($_SESSION['5inarch']['role'] < 3) {
                ?>
                <div class="col-sm-8">
                    <font face="myFirstFont">
                        <div class="title-action">
                            <button class="btn btn-primary " type="button" data-toggle="modal"
                                    data-target="#addstudent"><i class="fa fa-plus"></i> Add
                            </button>
                            <a href="absence.php" class="btn btn-primary">
                                <i class="fa fa-address-book"></i> <b> Absence</b>
                            </a>
                            <button class="btn btn-primary " type="button" data-toggle="modal"
                                    data-target="#multiuseredit"><i class="fa fa-snowflake-o"></i> Multi edit
                            </button>
                            <a href="xstudents.php" class="btn btn-primary">
                                <b>X students</b>
                            </a>
                        </div>
                    </font>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="wrapper wrapper-content animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Search and view Students</h5>
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
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Nature</th>
                                            <th>Year</th>
                                            <th>Group</th>
                                            <th>Mob</th>
                                            <th>Balance</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $query="select t1.* from students t1 where t1.sttype2 not in ('c','e') and t1.styear not in ('5')";
                                        if($_SESSION['5inarch']['role']=="3"){
                                            $query .= " AND  t1.stbalance < 0";
                                        }
                                        $result4 = mysqli_query($con, $query);
                                        while($row4 = mysqli_fetch_assoc($result4))
                                        {
                                            ?>
                                                <?php
                                                $matresult = mysqli_query($con, "SELECT * FROM `stmatall` where stid='".$row4['stid']."'");
                                                $color = "purple";

                                                ?>
                                            <tr data-child-value="
                                            <?php
                                            while ($row = $matresult->fetch_assoc()) {
                                                $matid= $row['matid'];
                                                $productname = $row['matname'];

                                                echo $productname.' & ';
                                            };
                                            ?>
                                            "> <!--info plus-->
                                                <td><!--search in info plus-->

                                                </td>
                                                <td class="details-control"></td>
                                                <td>
                                                    <?php echo $row4['stid'] ?>
                                                </td><!--order column-->
                                                <td>
                                                    <a class="green" href="stprofile.php?student_id=<?php echo $row4['stid'] ?>"><?php echo $row4['stname'] ?></a>
                                                </td>
                                                <td><?php
                                                    if($row4['sttype2'] == "C"):
                                                        echo "مراجعة نهائية";
                                                    elseif($row4['sttype2'] == 'E'):
                                                        echo "منسحب";
                                                    elseif($row4['sttype2'] == "A"):
                                                        echo "باقي إعادة";
                                                    elseif($row4['sttype2'] == "B"):
                                                        echo "مستجد";
                                                    else:
                                                        echo "???????";
                                                    endif;
                                                    ?></td>
                                                <td><?php
                                                    if($row4['sttype'] == 1):
                                                        echo "إنتظام";
                                                    elseif($row4['sttype'] == 2):
                                                        echo "إنتساب";
                                                    endif;
                                                    ?>
                                                </td>
                                                <td><?php
                                                    if($row4['styear'] == "1"):
                                                        echo "الأولى";
                                                    elseif($row4['styear'] == "2"):
                                                        echo "الثانية";
                                                    elseif($row4['styear'] == "3"):
                                                        echo "الثالثة";
                                                    elseif($row4['styear'] == "4"):
                                                        echo "الرابعة";
                                                    elseif($row4['styear'] == "5"):
                                                        echo "متخرج";
                                                    endif;
                                                    ?></td>

                                                <td><?php echo $row4['stgroup'] ?></td>
                                                <td><?php echo $row4['stmob'] ?></td>
                                                <td><?php
                                                    if($row4['stbalance'] > 0):
                                                        ?>
                                                        <span class="btn btn-xs btn-success">
                                                            <?php
                                                    elseif($row4['stbalance'] < 0):
                                                        ?>
                                                        <span class="btn btn-xs btn-danger">
                                                            <?php
                                                    elseif($row4['stbalance'] == 0):
                                                        ?>
                                                        <span class="btn btn-xs btn-warning">
                                                            <?php
                                                    endif;
                                                    echo $row4['stbalance'];?></span>
                                                </td>
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

<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>

<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Select2 -->
<script src="js/plugins/select2/select2.full.min.js"></script>

<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>

<!-- Dual Listbox -->
<script src="js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>

<!-- Toastr -->
<script src="js/plugins/toastr/toastr.min.js"></script>


<script src="js/plugins/dataTables/datatables.min.js"></script>
<script>
    function format(value) {
        return '<div class="middle wrap col-sm-12"  >' + value + '</div>';
    }
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            initComplete: function () {
                this.api().columns(':eq(4),:eq(5),:eq(6),:eq(7)').every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.header()).empty() )
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
                targets: [ 0 ,  2 ],
                visible: false
            }],

            order: [2, 'desc']
            <?php
            if($_SESSION['5inarch']['role'] < 3) {
            ?>
            ,
            dom: 'Blfrtip'
            ,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
            <?php
            }
                ?>
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
<script>
    $(document).ready(function () {
        $('#materials_content').slideUp();
    });
        $('input[id="materials_check"]').click(function(){
        if(this.checked)
            $('#materials_content').slideDown();
        else
            $('#materials_content').slideUp();
    });
    $(document).ready(function () {
        $('#year_content').slideUp();
    });
    $('input[id="year_check"]').click(function(){
        if(this.checked)
            $('#year_content').slideDown();
        else
            $('#year_content').slideUp();
    });
    $(document).ready(function () {
        $('#term_content').slideUp();
    });
    $('input[id="term_check"]').click(function(){
        if(this.checked)
            $('#term_content').slideDown();
        else
            $('#term_content').slideUp();
    });
    $(document).ready(function () {
        $('#type_content').slideUp();
    });
    $('input[id="type_check"]').click(function(){
        if(this.checked)
            $('#type_content').slideDown();
        else
            $('#type_content').slideUp();
    });
    $(document).ready(function () {
        $('#balance_content').slideUp();
    });
    $('input[id="balance_check"]').click(function(){
        if(this.checked)
            $('#balance_content').slideDown();
        else
            $('#balance_content').slideUp();
    });
    $(document).ready(function () {
        $('#nature_content').slideUp();
    });
    $('input[id="nature_check"]').click(function(){
        if(this.checked)
            $('#nature_content').slideDown();
        else
            $('#nature_content').slideUp();
    });
    $(document).ready(function () {
        $('#final_revesion_content').slideUp();
    });
    $('input[id="final_revesion_check"]').click(function(){
        if(this.checked)
            $('#final_revesion_content').slideDown();
        else
            $('#final_revesion_content').slideUp();
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

</body>
</html>