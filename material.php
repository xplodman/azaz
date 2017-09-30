<?php
include_once "php/connection.php";
 include_once "php/checkauthentication.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'Material profile';
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
                <h2><p>Material profile</p></h2>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>view and edit material information</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <?php
                                $materialid=$_GET['materialid'];
                                $result=mysqli_query($con, "SELECT * FROM `material` where `matid`=$materialid");
                                $matinfores = mysqli_fetch_assoc($result);
                                $resmatyear = $matinfores['matyear'];
                                $resmatterm = $matinfores['matterm'];
                                ?>
                                <form method="post" action="php/editmaterial.php?materialid=<?php echo $materialid;?>" class="form-horizontal">
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Material name</label>
                                            <div class="col-sm-10">
                                                <input value="<?php echo $matinfores['matname'] ;?>" type="text" class="form-control" name="matname" >
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Material year</label>
                                            <div class="col-sm-10">
                                                <select class="multiselect" id="form-field-4" name="matyear" >
                                                    <option value="1" <?php if($resmatyear=="1") echo 'selected="selected"'; ?>> الأولى</option>
                                                    <option value="2" <?php if($resmatyear=="2") echo 'selected="selected"'; ?>> الثانية</option>
                                                    <option value="3" <?php if($resmatyear=="3") echo 'selected="selected"'; ?>> الثالثة</option>
                                                    <option value="4" <?php if($resmatyear=="4") echo 'selected="selected"'; ?>> الرابعة</option>
                                                </select>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Material term</label>
                                            <div class="col-sm-10">
                                                <select class="multiselect" id="form-field-4" name="matterm" >
                                                    <option value="First" <?php if($resmatterm=="First") echo 'selected="selected"'; ?>> الأول</option>
                                                    <option value="second" <?php if($resmatterm=="second") echo 'selected="selected"'; ?>> الثاني</option>
                                                    <option value="Summer" <?php if($resmatterm=="Summer") echo 'selected="selected"'; ?>> صيف</option>
                                                </select>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Professor name</label>
                                            <div class="col-sm-10">
                                                <?php
                                                $result=mysqli_query($con, "SELECT * FROM `prmatall` where `matid`=$materialid");
                                                while($prmatinfores = mysqli_fetch_assoc($result))
                                                {
                                                    if (!empty($prmatinfores)) {
                                                        ?>
                                                        <a class="green" href="prprofile.php?profileid=<?php echo $prmatinfores['prid'] ?>"><?php echo $prmatinfores['prname'] ?></a>
                                                    <?php }};?>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Professor number</label>
                                            <div class="col-sm-10">
                                                <?php
                                                $result=mysqli_query($con, "SELECT * FROM `prmatall` where `matid`=$materialid");
                                                while($prmatinfores = mysqli_fetch_assoc($result))
                                                {
                                                if (!empty($prmatinfores)) {
                                                ?>
                                                <a class="green" href="prprofile.php?profileid=<?php echo $prmatinfores['prid'] ?>"><?php echo $prmatinfores['prmob'] ?></a>
                                                <?php }};?>
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Student count</label>
                                            <div class="col-sm-10">
                                                <?php
                                                $result=mysqli_query($con, "Select Count(stmatall.matid) as Count From stmatall Where stmatall.matid =$materialid");
                                                $prmatinfores = mysqli_fetch_assoc($result);
                                                echo $prmatinfores['Count'];
                                                ?>                                            </div>
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