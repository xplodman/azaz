<?php
include_once "php/connection.php";
 include_once "php/checkauthentication.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'Receipts';
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
                <h2><p>Receipts</p></h2>
            </div>
            <div class="col-sm-8">
                <font face="myFirstFont">
                    <div class="title-action">
                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#addreceiptin"><i class="fa fa-plus"></i> In</button>
                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#addreceiptout"><i class="fa fa-minus"></i> Out</button>
                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#addreceiptaid"><i class="fa fa-medkit"></i> Aid</button>
                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#summary"><i class="fa fa-list-alt"></i> summary</button>
                    </div>
                </font>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Search and view receipts informations</h5>
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
                                            <th style="width:4em">ID</th>
                                            <th>Donor</th>
                                            <th>Recipient</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Reason</th>
                                            <th>Type</th>
                                            <th>Serial</th>
                                            <th>Note</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $result22 = mysqli_query($con,"SELECT * FROM `tickets` ORDER BY `tickets`.`tiid` desc") or die(mysqli_error($con));
                                        while($row22 = mysqli_fetch_assoc($result22)) {
                                            ?>
                                            <tr data-child-value=""> <!--info plus-->
                                                <td><!--search in info plus-->
                                                </td>
                                                <td class="details-control"></td>
                                                <td class="middle wrap">
                                                    <font size="3">
                                                        <?php
                                                        if ($_SESSION['5inarch']['role'] == 1){
                                                            ?>
                                                            <a class="green" href="receipt.php?receiptid=<?php echo $row22['tiid'] ?>"><?php echo $row22['tiid'] ?></a>
                                                            <?php
                                                        }else{
                                                        echo $row22['tiid'];
                                                        }
                                                        ?>
                                                    </font>
                                                </td>
                                                <td class="middle wrap">
                                                    <font size="3">
                                                        <?php
                                                        if ($row22['tidonortype'] == "1")
                                                        {
                                                        $result=mysqli_query($con, "select * FROM professors where prid = $row22[tidonor];");
                                                        while($x = mysqli_fetch_assoc($result))
                                                        {	?>
                                                <a class="green" href="professor.php?professorid=<?php echo $x['prid'] ?>"><?php echo $x['prname'] ?></a>
                                                <?php
                                                };
                                                } elseif ($row22['tidonortype'] == "2")
                                                {
                                                    $result=mysqli_query($con, "select * FROM students where stid = $row22[tidonor];");
                                                    while($x = mysqli_fetch_assoc($result))
                                                    {	?>
                                                        <a class="green" href="stprofile.php?student_id=<?php echo $x['stid'] ?>"><?php echo $x['stname'] ?></a>
                                                        <?php
                                                    };
                                                }
                                                elseif ($row22['tidonortype'] == "3")
                                                {
                                                    $result=mysqli_query($con, "select * FROM expenses where exid = $row22[tidonor];");
                                                    while($x = mysqli_fetch_assoc($result))
                                                    {	?>
                                                        <a class="green" href="matprofile.php?profileid=<?php echo $x['matid'] ?>"><?php echo $x['matname'] ?></a>
                                                        <?php
                                                    };
                                                }

                                                ?>
                                                    </font>
                                                </td>
                                                <td class="middle wrap">
                                                    <font size="3">
                                                        <?php
                                                        if ($row22['tirecipienttype'] == "1")
                                                        {
                                                        $result=mysqli_query($con, "select * FROM professors where prid = $row22[tirecipient];");
                                                        while($y = mysqli_fetch_assoc($result))
                                                        {	?>
                                                <a class="green" href="professor.php?professorid=<?php echo $y['prid'] ?>"><?php echo $y['prname'] ?></a>
                                                <?php
                                                };
                                                } elseif ($row22['tirecipienttype'] == "2")
                                                {
                                                    $result=mysqli_query($con, "select * FROM students where stid = $row22[tirecipient];");
                                                    while($y = mysqli_fetch_assoc($result))
                                                    {	?>
                                                        <a class="green" href="stprofile.php?student_id=<?php echo $y['stid'] ?>"><?php echo $y['stname'] ?></a>
                                                        <?php
                                                    };
                                                }
                                                elseif ($row22['tirecipienttype'] == "3")
                                                {
                                                    $result=mysqli_query($con, "select * FROM expenses where exid = $row22[tirecipient];");
                                                    while($y = mysqli_fetch_assoc($result))
                                                    {	?>
                                                        <a class="green" href="exprofile.php?profileid=<?php echo $y['exid'] ?>"><?php echo $y['exname'] ?></a>
                                                        <?php
                                                    };
                                                }

                                                ?>
                                                    </font>
                                                </td>
                                                <td class="middle wrap">
                                                    <font size="3">
                                                        <?php echo $row22['tiamount'] ?>
                                                    </font>
                                                </td>
                                                <td class="middle wrap">
                                                    <font size="3">
                                                        <?php echo $row22['tirealdate'] ?>
                                                    </font>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php
                                                    if($row22['tireason'] == 'p1'):
                                                        echo "كورس";
                                                    elseif($row22['tireason'] == 'p2'):
                                                        echo "مذكرات";
                                                    elseif($row22['tireason'] == 'p3'):
                                                        echo "مراجعة نهائية";
                                                    elseif($row22['tireason'] == 'p4'):
                                                        echo "آخري";
                                                    elseif($row22['tireason'] == 'm0'):
                                                        echo "دعم";
                                                    elseif($row22['tireason'] == 'm1'):
                                                        echo "سلفة";
                                                    elseif($row22['tireason'] == 'm2'):
                                                        echo "محمول";
                                                    elseif($row22['tireason'] == 'm3'):
                                                        echo "راتب";
                                                    elseif($row22['tireason'] == 'm4'):
                                                        echo "تصوير";
                                                    elseif($row22['tireason'] == 'm5'):
                                                        echo "طباعة";
                                                    elseif($row22['tireason'] == 'm6'):
                                                        echo "مواصلات";
                                                    elseif($row22['tireason'] == 'm7'):
                                                        echo "دعاية";
                                                    elseif($row22['tireason'] == 'm8'):
                                                        echo "مكافأة";
                                                    elseif($row22['tireason'] == 'm9'):
                                                        echo "آخري";
                                                    elseif($row22['tireason'] == 'm10'):
                                                        echo "أدوات مكتبية";
                                                    endif;
                                                    ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <?php
                                                    if($row22['titype'] == '1'):
                                                        echo "إستلام";
                                                    elseif($row22['titype'] == '2'):
                                                        echo "صرف";
                                                    elseif($row22['titype'] == '25'):
                                                        echo "%دعم 25";
                                                    elseif($row22['titype'] == '50'):
                                                        echo "%دعم 50";
                                                    elseif($row22['titype'] == '100'):
                                                        echo "%دعم 100";
                                                    endif;
                                                    ?>
                                                </td>
                                                <td class="middle wrap">
                                                    <font size="3">
                                                        <?php echo $row22['tinumber'] ?>
                                                    </font>
                                                </td>
                                                <td class="middle wrap">
                                                    <font size="3">
                                                        <?php echo $row22['tidescription'] ?>
                                                    </font>
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

<!-- Dual Listbox -->
<script src="js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>

<!-- Toastr -->
<script src="js/plugins/toastr/toastr.min.js"></script>


<script src="js/plugins/dataTables/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            initComplete: function () {
                this.api().columns(':eq(7),:eq(8)').every( function () {
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
                className: 'control',
                orderable: false,
                targets: [ 1 ]
            }],
            columnDefs: [{
                targets: [ 0 ],
                visible: false
            }],
            order: [9]
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
        $('.chosen-select').chosen({
            width: "100%",
            placeholder: "",
            allowClear: true
        });
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
            '<input style="width: 50px" type="text" class="form-control" name="itemquantity[]"/>' +
            '<select class="chosen-select2 form-control" name="itemcategory[]">' +
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
</body>
</html>