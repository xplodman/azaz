<?php
include_once "php/connection.php";
 include_once "php/checkauthentication.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'Prosecutions';
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
                <h2><p>Professor profile</p></h2>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>view and edit professor information</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <?php
                                $professorid=$_GET['professorid'];
                                $result = mysqli_query($con,"
                                Select professors.prid,
                                  professors.prname,
                                  professors.prmob,
                                  professors.prtel,
                                  professors.prparentmob,
                                  professors.prparentname,
                                  professors.premail,
                                  professors.prbalance,
                                  professors.professorsappid,
                                  professors.professorsapppw,
                                  professors.professorsrole
                                From professors
                                Where professors.prid = $professorid") or die(mysqli_error($con));
                                $row = mysqli_fetch_assoc($result);
                                ?>
                                <form method="post" action="php/editprofessor.php?professorid=<?php echo $row['prid'] ?>" class="form-horizontal">
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Professor name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="prname" class="form-control" value="<?php echo $row['prname'] ?>">
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Professor number</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="prmob" class="form-control" value="<?php echo $row['prmob'] ?>">
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Professor number 2</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="prtel" class="form-control" value="<?php echo $row['prtel'] ?>">
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Professor parent name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="prparentname" class="form-control" value="<?php echo $row['prparentname'] ?>">
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Professor parent number</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="prparentmob" class="form-control" value="<?php echo $row['prparentmob'] ?>">
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Professor E-mail</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="premail" class="form-control" value="<?php echo $row['premail'] ?>">
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Professor salary</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="prbalance" class="form-control" value="<?php echo $row['prbalance'] ?>">
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Professor app ID</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="professorsappid" class="form-control" value="<?php echo $row['professorsappid'] ?>">
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Professor app PW</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="professorsapppw" class="form-control" value="<?php echo $row['professorsapppw'] ?>">
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Professor role</label>
                                            <div class="col-sm-10">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="radio" value="1" name="professorsrole" <?php if($row['professorsrole']=="1") echo 'checked="checked"'; ?>>
                                                        Administrator
                                                    </label>
                                                </div>
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="radio" value="2" name="professorsrole" <?php if($row['professorsrole']=="2") echo 'checked="checked"'; ?>>
                                                        Power user
                                                    </label>
                                                </div>
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="radio" value="3" name="professorsrole" <?php if($row['professorsrole']=="3") echo 'checked="checked"'; ?>>
                                                        User
                                                    </label>
                                                </div>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Materials</label>
                                            <div class="col-sm-10">
                                                <select class="form-control dual_select" name="materials[]" multiple>
                                                    <?php
                                                    $result2 = mysqli_query($con, "SELECT * FROM `prmatall` where prid=$professorid");
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
                                                    $result2 = mysqli_query($con, "SELECT * FROM material WHERE matid NOT IN (SELECT material_matid FROM `prmat` where professors_prid=$professorid)");
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