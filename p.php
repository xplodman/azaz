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
                <h2><p>Prosecution profile</p></h2>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>view and edit prosecution information</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <?php
                                $prosecutionid=$_GET['prosecutionid'];
                                $result = mysqli_query($con,"
                                Select prosecution.prosecutionid,
                                  prosecution.prosecutionname,
                                  prosecution.createddate,
                                  prosecution.updatedate
                                From prosecution
                                Where prosecution.prosecutionid = $prosecutionid") or die(mysqli_error($con));
                                $row = mysqli_fetch_assoc($result);
                                ?>
                                <form method="post" action="php/editprosecution.php?prosecutionid=<?php echo $row['prosecutionid'] ?>" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Prosecution ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" disabled="disabled" value="<?php echo $row['prosecutionid'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <font face="myFirstFont">
                                            <label class="col-sm-2 control-label">Prosecution name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="prosecutionname" class="form-control" value="<?php echo $row['prosecutionname'] ?>">
                                            </div>
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Creation date</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" disabled="disabled" value="<?php echo $row['createddate'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Last edit date</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" disabled="disabled" value="<?php echo $row['updatedate'] ?>">
                                        </div>
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
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>view prosecution papers</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="lightBoxGallery">
                                    <?php
                                    $query = "SELECT * FROM `prosimage` WHERE `prosecutionid` = $prosecutionid";
                                    $results = mysqli_query($con, $query);
                                    if (mysqli_num_rows($results)>0){
                                        foreach ($results as $newresults) {
                                            ?>
                                            <a href="data:image/jpeg;base64, <?php echo base64_encode($newresults['prosimagedata']) ?>" title="Image from Unsplash" data-gallery=""><img src="data:image/jpeg;base64, <?php echo base64_encode($newresults['prosimagedata']) ?>"></a>
                                            <?php
                                        }
                                    }else{
                                        echo "nothing here...";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="php/insertprospapers.php?prosecutionid=<?php echo $prosecutionid ?>" class="dropzone" id="dropzoneForm">
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </form>
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


<script>
    Dropzone.options.dropzoneForm = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 3, // MB
        addRemoveLinks: true,
        dictDefaultMessage: "<strong>Drop files here or click to upload. </strong>"

    };

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
</body>
</html>