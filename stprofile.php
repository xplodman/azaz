<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'Student profile';
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
                <h2><p>Student profile</p></h2>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>View and edit student information</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <?php
                                $student_id=$_GET['student_id'];
                                $result=mysqli_query($con, "SELECT * FROM `students` where `stid`=$student_id");
                                $stinfores = mysqli_fetch_assoc($result);
                                    $ressttype = $stinfores['sttype'];
                                    $ressttype2 = $stinfores['sttype2'];
                                    $resstyear = $stinfores['styear'];
                                    $resstterm = $stinfores['stterm'];
                                    $resstgroup = $stinfores['stgroup'];
                                ?>
                                <form method="post" action="php/editstudent.php?student_id=<?php echo $student_id ?>" class="form-horizontal">
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student name</label>
                                            <div class="col-sm-10">
                                                <input required value="<?php echo $stinfores['stname'] ;?>" type="text" class="form-control" name="stname" >
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student code</label>
                                            <div class="col-sm-10">
                                                <input value="<?php echo $stinfores['stcode'] ;?>" type="text" class="form-control" name="stcode" >
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student number</label>
                                            <div class="col-sm-10">
                                                <input required value="<?php echo $stinfores['stmob'] ;?>" type="text" class="form-control" name="stmob" >
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student number 2</label>
                                            <div class="col-sm-10">
                                                <input value="<?php echo $stinfores['sttel'] ;?>" type="text" class="form-control" name="sttel" >
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student parent type</label>
                                            <div class="col-sm-10">
                                                <input value="<?php echo $stinfores['stparenttype'] ;?>" type="text" class="form-control" name="stparenttype" >
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student parent name</label>
                                            <div class="col-sm-10">
                                                <input value="<?php echo $stinfores['stparentname'] ;?>" type="text" class="form-control" name="stparentname" >
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student parent mob</label>
                                            <div class="col-sm-10">
                                                <input required value="<?php echo $stinfores['stparentmob'] ;?>" type="text" class="form-control" name="stparentmob" >
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student E-mail</label>
                                            <div class="col-sm-10">
                                                <input value="<?php echo $stinfores['stemail'] ;?>" type="text" class="form-control" name="stemail" >
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student address</label>
                                            <div class="col-sm-10">
                                                <input value="<?php echo $stinfores['staddress'] ;?>" type="text" class="form-control" name="staddress" >
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student ID</label>
                                            <div class="col-sm-10">
                                                <input value="<?php echo $stinfores['stnationalid'] ;?>" type="text" class="form-control" name="stnationalid" >
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student nature</label>
                                            <div class="col-sm-10">
                                                <select required class="multiselect" id="form-field-4" name="sttype" >
                                                    <option value="1" <?php if($ressttype=="1") echo 'selected="selected"'; ?>> إنتظام</option>
                                                    <option value="2" <?php if($ressttype=="2") echo 'selected="selected"'; ?>> إنتساب</option>
                                                </select>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student year</label>
                                            <div class="col-sm-10">
                                                <select required class="multiselect" id="form-field-4" name="styear" >
                                                    <option value="1" <?php if($resstyear=="1") echo 'selected="selected"'; ?>> الأولى</option>
                                                    <option value="2" <?php if($resstyear=="2") echo 'selected="selected"'; ?>> الثانية</option>
                                                    <option value="3" <?php if($resstyear=="3") echo 'selected="selected"'; ?>> الثالثة</option>
                                                    <option value="4" <?php if($resstyear=="4") echo 'selected="selected"'; ?>> الرابعة</option>
                                                    <option value="5" <?php if($resstyear=="5") echo 'selected="selected"'; ?>> متخرج</option>
                                                </select>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student term</label>
                                            <div class="col-sm-10">
                                                <select required class="multiselect" id="form-field-4" name="stterm" >
                                                    <option value="1" <?php if($resstterm=="1") echo 'selected="selected"'; ?>> الأول</option>
                                                    <option value="2" <?php if($resstterm=="2") echo 'selected="selected"'; ?>> الثاني</option>
                                                    <option value="3" <?php if($resstterm=="3") echo 'selected="selected"'; ?>> صيف</option>
                                                </select>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student group</label>
                                            <div class="col-sm-10">
                                                <select class="multiselect" id="form-field-4" name="stgroup" >
                                                    <option value="A" <?php if($resstgroup=="A") echo 'selected="selected"'; ?>> A</option>
                                                    <option value="B" <?php if($resstgroup=="B") echo 'selected="selected"'; ?>> B</option>
                                                    <option value="C" <?php if($resstgroup=="C") echo 'selected="selected"'; ?>> C</option>
                                                    <option value="E" <?php if($resstgroup=="E") echo 'selected="selected"'; ?>> E</option>
                                                </select>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student type</label>
                                            <div class="col-sm-10">
                                                <select required class="multiselect" id="form-field-4" name="sttype2" >
                                                    <option value="A" <?php if($ressttype2=="A") echo 'selected="selected"'; ?>> باقي إعادة</option>
                                                    <option value="B" <?php if($ressttype2=="B") echo 'selected="selected"'; ?>> مستجد</option>
                                                    <option value="C" <?php if($ressttype2=="C") echo 'selected="selected"'; ?>> مراجعة نهائية</option>
                                                    <option value="E" <?php if($ressttype2=="E") echo 'selected="selected"'; ?>> منسحب</option>
                                                </select>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student balance</label>
                                            <div class="col-sm-10">
                                                <?php
                                                    if($_SESSION['5inarch']['role']=="1"){
                                                        ?>
                                                        <input value="<?php echo $stinfores['stbalance'] ;?>" type="number" class="form-control" name="stbalance" >
                                                        <?php
                                                }else{
                                                    if($stinfores['stbalance'] > 0):
                                                        $varb='<a href="" class="btn btn-xs btn-success">';
                                                    elseif($stinfores['stbalance'] < 0):
                                                        $varb='<a href="" class="btn btn-xs btn-danger">';
                                                    elseif($stinfores['stbalance'] == 0):
                                                        $varb='<a href="" class="btn btn-xs btn-warning">';
                                                    endif;
                                                    echo $varb.$stinfores['stbalance'];
                                                };
                                                ?>
                                                </a>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Materials</label>
                                            <div class="col-sm-10">
                                                <select class="form-control dual_select" name="materials[]" multiple>
                                                    <?php
                                                    $result2 = mysqli_query($con, "SELECT * FROM `stmatall` where stid=$student_id");
                                                    while ($row2 = $result2->fetch_assoc()) {
                                                        unset($id2, $name2);
                                                        $matid = $row2['matid'];
                                                        $matname = $row2['matname'];
                                                        $matyear = $row2['matyear'];
                                                        $matterm = $row2['matterm'];
                                                        ?>
                                                        <option selected value="<?php echo $row2['matid'] ?>"> <?php echo $row2['matname']." -  ".$row2['matterm']." -  ".$row2['matyear'] ?> </option>
                                                    <?php } ?>

                                                    <?php
                                                    $result2 = mysqli_query($con, "SELECT * FROM material WHERE matid NOT IN (SELECT material_matid FROM `stmat` where students_stid=$student_id AND status=1)");
                                                    while ($row2 = $result2->fetch_assoc()) {
                                                        unset($id2, $name2);
                                                        $matid = $row2['matid'];
                                                        $matname = $row2['matname'];
                                                        $matyear = $row2['matyear'];
                                                        $matterm = $row2['matterm'];
                                                        ?>
                                                        <option value="<?php echo $row2['matid'] ?>"> <?php echo $row2['matname']." -  ".$row2['matterm']." -  ".$row2['matyear'] ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </font>
                                    </div>
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
                                    </div>
                                </form>
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
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
</body>
</html>