<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'X-Students';
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
                <h2><p>X students</p></h2>
            </div>
            <div class="col-sm-8">
                <font face="myFirstFont">
                    <div class="title-action">
                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#multiuseredit"><i class="fa fa-snowflake-o"></i> Multi edit</button>
                    </div>
                </font>
            </div>
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
                                        $result4 = mysqli_query($con,"select t1.* from students t1 where t1.sttype2 in ('c','e') or t1.styear in ('5')");
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
                                                    <a class="green" href="stprofile.php?profileid=<?php echo $row4['stid'] ?>"><?php echo $row4['stname'] ?></a>
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
                                                        $varb='<span class="btn btn-xs btn-success">';
                                                    elseif($row4['stbalance'] < 0):
                                                        $varb='<span class="btn btn-xs btn-danger">';
                                                    elseif($row4['stbalance'] == 0):
                                                        $varb='<span class="btn btn-xs btn-warning">';
                                                    endif;
                                                    echo $varb.$row4['stbalance'];?></span>
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