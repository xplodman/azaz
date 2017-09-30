<?php
include_once "php/connection.php";
 include_once "php/checkauthentication.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'Receipt profile';
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
                <h2><p>Receipt profile</p></h2>
            </div>
            <?php
            $receiptid=$_GET['receiptid'];
            if($_SESSION['5inarch']['role'] < 3) {
                ?>
                <div class="col-sm-8">
                    <div class="title-action">
                        <a href="php/deletereceipt.php?receiptid=<?php echo $receiptid ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this receipt?')">
                        <font size="5" face="myFirstFont">
                            <b>Delete and repair</b>
                        </font>
                        </a>
                    </div>
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
                            <h5>view and edit receipt information</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <?php
                                $result=mysqli_query($con, "SELECT * FROM `tickets` where `tiid`=$receiptid");
                                $receiptresult = mysqli_fetch_assoc($result)
                                ?>
                                <font size="3">
                                <form class="form-horizontal" method="post" action="php/edittiplus.php?receiptid=<?php echo $receiptid ?>">
                                    <input type="hidden" name="receipttype" class="input-sm" value="<?php
                                    if($receiptresult['titype'] == '1'){
                                        echo "1";
                                    }elseif($receiptresult['titype'] == '2'){
                                        echo "2";
                                    }elseif($receiptresult['titype'] == '25' or $receiptresult['titype'] == '50' or $receiptresult['titype'] == '100'){
                                        echo "3";
                                    }
                                    ?>"/>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Receipt type</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="input-sm" disabled value="<?php
                                                if($receiptresult['titype'] == '1'){
                                                    echo "In";
                                                }elseif($receiptresult['titype'] == '2'){
                                                    echo "Out";
                                                }elseif($receiptresult['titype'] == '25' or $receiptresult['titype'] == '50' or $receiptresult['titype'] == '100'){
                                                    echo "Aid";
                                                }
                                                ?>"/>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Receipt number</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="input-sm" name="number" value="<?php echo $receiptresult['tinumber']?>"/>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Receipt recipient</label>
                                            <div class="col-sm-10">
                                                <select class="multiselect" id="form-field-4" name="recipient">
                                                    <?php
                                                    if($receiptresult['titype'] == '1'){ //in

                                                    $result2 = mysqli_query($con, "SELECT * FROM `professors`");
                                                    while ($row2 = $result2->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $row2['prid'] ?>" <?php if($receiptresult['tirecipient']==$row2['prid']) echo 'selected="selected"'; ?> > <?php echo $row2['prname'] ?> </option>
                                                    <?php }

                                                    }elseif($receiptresult['titype'] == '2'){ //out

                                                        $result2 = mysqli_query($con, "SELECT * FROM `professors`");
                                                        while ($row2 = $result2->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $row2['prid'] ?>" <?php if($receiptresult['tirecipient']==$row2['prid']) echo 'selected="selected"'; ?> > <?php echo $row2['prname'] ?> </option>
                                                        <?php }

                                                    }elseif($receiptresult['titype'] == '25' or $receiptresult['titype'] == '50' or $receiptresult['titype'] == '100'){ //aid

                                                        $result2 = mysqli_query($con, "SELECT * FROM `students`");
                                                        while ($row2 = $result2->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $row2['stid'] ?>" <?php if($receiptresult['tirecipient']==$row2['stid']) echo 'selected="selected"'; ?> > <?php echo $row2['stname'] ?> </option>
                                                        <?php }

                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Receipt donor</label>
                                            <div class="col-sm-10">
                                                <select class="multiselect" id="form-field-4" name="donor">
                                                    <?php
                                                    if($receiptresult['titype'] == '1'){ //in

                                                        $result2 = mysqli_query($con, "SELECT * FROM `students`");
                                                        while ($row2 = $result2->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $row2['stid'] ?>" <?php if($receiptresult['tidonor']==$row2['stid']) echo 'selected="selected"'; ?> > <?php echo $row2['stname'] ?> </option>
                                                        <?php }

                                                    }elseif($receiptresult['titype'] == '2'){ //out

                                                        $result2 = mysqli_query($con, "SELECT * FROM `professors`");
                                                        while ($row2 = $result2->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $row2['prid'] ?>" <?php if($receiptresult['tidonor']==$row2['prid']) echo 'selected="selected"'; ?> > <?php echo $row2['prname'] ?> </option>
                                                        <?php }

                                                    }elseif($receiptresult['titype'] == '25' or $receiptresult['titype'] == '50' or $receiptresult['titype'] == '100'){ //aid

                                                        $result2 = mysqli_query($con, "SELECT * FROM `professors`");
                                                        while ($row2 = $result2->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $row2['prid'] ?>" <?php if($receiptresult['tidonor']==$row2['prid']) echo 'selected="selected"'; ?> > <?php echo $row2['prname'] ?> </option>
                                                        <?php }

                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Receipt value</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="input-sm" name="amount" value="<?php echo $receiptresult['tiamount']?>"/>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group" id="data_1">
                                        <font face="myFirstFont">
                                        <label class="col-sm-2 control-label">Receipt date</label>
                                            <div class="col-sm-10">
                                                <div class="input-group date">
                                                    <input class="form-control date-picker" type="text" name="date" value="<?php echo $receiptresult['tirealdate']?>"/>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Receipt reason</label>
                                            <div class="col-sm-10">
                                                <?php
                                                if($receiptresult['titype'] == '1'){ //in
                                                    ?>
                                                    <input disabled name="reason" type="radio" class="ace" value="p1" <?php if($receiptresult['tireason']=="p1") echo 'checked="checked"'; ?>/>
                                                    <span class="lbl"> Course</span>
                                                    &nbsp; &nbsp; &nbsp; &nbsp;
                                                    <input disabled name="reason" type="radio" class="ace" value="p2" <?php if($receiptresult['tireason']=="p2") echo 'checked="checked"'; ?>/>
                                                    <span class="lbl"> Notes</span>
                                                    &nbsp; &nbsp; &nbsp; &nbsp;
                                                    <input disabled name="reason" type="radio" class="ace" value="p3" <?php if($receiptresult['tireason']=="p3") echo 'checked="checked"'; ?>/>
                                                    <span disabled class="lbl">Final revision</span>
                                                    &nbsp; &nbsp; &nbsp; &nbsp;
                                                    <input disabled name="reason" type="radio" class="ace" value="p4" <?php if($receiptresult['tireason']=="p4") echo 'checked="checked"'; ?>/>
                                                    <span class="lbl"> Others</span>
                                                    <?php
                                                }elseif($receiptresult['titype'] == '2'){ //out
                                                    ?>
                                                    <select class="multiselect" id="form-field-4" name="reason">
                                                        <?php
                                                        $result2 = mysqli_query($con, "SELECT * FROM `expenses`");
                                                        while ($row2 = $result2->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $row2['excode'] ?>"  <?php if($receiptresult['tireason']==$row2['excode']) echo 'selected="selected"'; ?>> <?php echo $row2['exname']?> </option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php
                                                }elseif($receiptresult['titype'] == '25' or $receiptresult['titype'] == '50' or $receiptresult['titype'] == '100'){ //aid
                                                    ?>
                                                    <input disabled name="reason" type="radio" class="ace" value="50" <?php if($receiptresult['titype']=="100") echo 'checked="checked"'; ?>/>
                                                    <span class="lbl">100%</span>
                                                    &nbsp; &nbsp; &nbsp; &nbsp;
                                                    <input disabled name="reason" type="radio" class="ace" value="50" <?php if($receiptresult['titype']=="50") echo 'checked="checked"'; ?>/>
                                                    <span class="lbl">50%</span>
                                                    &nbsp; &nbsp; &nbsp; &nbsp;
                                                    <input disabled name="reason" type="radio" class="ace" value="25" <?php if($receiptresult['titype']=="25") echo 'checked="checked"'; ?>/>
                                                    <span class="lbl">25%</span>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Receipt note</label>
                                            <div class="col-sm-10">
                                                <textarea id="form-field-8" class="autosize-transition form-control" name="description"><?php echo $receiptresult['tidescription']?></textarea>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="clearfix form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button class="btn btn-info"  type="Submit"  name="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                Submit
                                            </button>

                                            &nbsp; &nbsp; &nbsp;
                                            <button class="btn" type="reset">
                                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                                Reset
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                </font>
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
<!-- DROPZONE -->
<script src="js/plugins/dropzone/dropzone.js"></script>
<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>

<script>
    $('.dual_select').bootstrapDualListbox({
        selectorMinimalHeight: 300
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
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
</body>
</html>