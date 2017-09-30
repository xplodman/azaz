<?php
include_once "php/functions.php";
?>
<font face="myFirstFont">
    <div class="modal inmodal" id="addprof" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert a professor</h4>
                </div>
                <div class="modal-body">
                    Information
                    <form method="post" action="php/insertprof.php" class="form-horizontal">
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Professor name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="prname" class="form-control">
                                </div>
                            </font>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Professor number</label>
                                <div class="col-sm-10">
                                    <input type="text" name="prmob" class="form-control">
                                </div>
                            </font>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Professor number 2</label>
                                <div class="col-sm-10">
                                    <input type="text" name="prtel" class="form-control">
                                </div>
                            </font>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Professor parent name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="prparentname" class="form-control">
                                </div>
                            </font>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Professor parent number</label>
                                <div class="col-sm-10">
                                    <input type="text" name="prparentmob" class="form-control">
                                </div>
                            </font>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Professor E-mail</label>
                                <div class="col-sm-10">
                                    <input type="text" name="premail" class="form-control">
                                </div>
                            </font>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Professor salary</label>
                                <div class="col-sm-10">
                                    <input type="text" name="prbalance" class="form-control">
                                </div>
                            </font>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Professor app ID</label>
                                <div class="col-sm-10">
                                    <input type="text" name="professorsappid" class="form-control">
                                </div>
                            </font>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Professor app PW</label>
                                <div class="col-sm-10">
                                    <input type="text" name="professorsapppw" class="form-control">
                                </div>
                            </font>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Professor role</label>
                                <div class="col-sm-10">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="1" name="professorsrole">
                                            Administrator
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="2" name="professorsrole">
                                            Power user
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="3" name="professorsrole">
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
                                        $result2 = mysqli_query($con, "SELECT * FROM material");
                                        while ($row2 = $result2->fetch_assoc()) {
                                            unset($id2, $name2);
                                            $matid   = $row2['matid'];
                                            $matname = $row2['matname'];
                                            $matyear = $row2['matyear'];
                                            $matterm = $row2['matterm'];
                                            ?>
                                            <option value="<?php
                                            echo $row2['matid'];
                                            ?>"> <?php
                                                echo $row2['matname'] . " -  " . $row2['matterm'] . " -  " . $row2['matyear'];
                                                ?> </option>
                                            <?php
                                        }
                                        ?>
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
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="multiuseredit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Edit multiple users</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="php/xstudentedit.php" class="form-horizontal">
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Students</label>
                                <div class="col-xs-10">
                                    <div class="input-group">

                                        <select class="form-control dual_select" name="students[]" multiple>
                                            <?php
                                            $result2 = mysqli_query($con, "SELECT * FROM `students`");
                                            while ($row2 = $result2->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row2['stid'] ?>"> <?php echo $row2['stname']." - ".$row2['styear']." - ".$row2['stgroup'] ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>
                            </font>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Materials
                                    <input class="test1" type="checkbox" name="materials_check" id="materials_check">
                                </label>
                                <div class="col-xs-10" id="materials_content">
                                    <div class="input-group slideUp">

                                        <select id="yourText" class="form-control dual_select" name="materials[]" multiple>
                                            <?php
                                            $result2 = mysqli_query($con, "SELECT * FROM material");
                                            while ($row2 = $result2->fetch_assoc()) {
                                                unset($id2, $name2);
                                                $matid   = $row2['matid'];
                                                $matname = $row2['matname'];
                                                $matyear = $row2['matyear'];
                                                $matterm = $row2['matterm'];
                                                ?>
                                                <option value="<?php
                                                echo $row2['matid'];
                                                ?>"> <?php
                                                    echo $row2['matname'] . " -  " . $row2['matterm'] . " -  " . $row2['matyear'];
                                                    ?> </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </font>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">year
                                    <input type="checkbox" name="year_check" id="year_check">
                                </label>
                                <div class="col-xs-10" id="year_content">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="1" name="year">
                                            الأولى
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="2" name="year">
                                            الثانية
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="3" name="year">
                                            الثالثة
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="4" name="year">
                                            الرابعة
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="5" name="year">
                                            متخرج
                                        </label>
                                    </div>
                                </div>
                            </font>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Term
                                    <input type="checkbox" name="term_check" id="term_check">
                                </label>
                                <div class="col-xs-10" id="term_content">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="1" name="term">
                                            الأول
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="2" name="term">
                                            الثاني
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="3" name="term">
                                            صيف
                                        </label>
                                    </div>
                                </div>
                            </font>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Type
                                    <input type="checkbox" name="type_check" id="type_check">
                                </label>
                                <div class="col-xs-10" id="type_content">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="A" name="type">
                                            باقي إعادة
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="B" name="type">
                                            مستجد
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="C" name="type">
                                            مراجعة نهائية
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="E" name="type">
                                            منسحب
                                        </label>
                                    </div>
                                </div>
                            </font>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Nature
                                    <input type="checkbox" name="nature_check" id="nature_check">
                                </label>
                                <div class="col-xs-10" id="nature_content">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="1" name="nature">
إنتظام
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="2" name="nature">
                                            إنتساب
                                        </label>
                                    </div>
                                </div>
                            </font>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Balance
                                    <input type="checkbox" name="balance_check" id="balance_check">
                                </label>
                                <div class="col-xs-10" id="balance_content">
                                    <input type="number" name="balance" class="form-control">
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
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="addstudent" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert a student</h4>
                </div>
                <div class="modal-body">
                    Information
                    <form method="post" action="php/insertstudent.php" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> الأسم </label>
                            <div class="col-sm-9">
                                <input required type="text" id="form-field-1" placeholder="الأسم" class="col-xs-10 col-sm-5"  name="stname"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> التليفون </label>
                            <div class="col-xs-12 col-sm-8">
                                <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="ace-icon fa fa-phone"></i>
                                                                </span>
                                    <input required class="form-control input-mask-phone" type="text" id="form-field-2" name="stmob" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-3"> تليفون آخر </label>
                            <div class="col-xs-12 col-sm-8">
                                <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="ace-icon fa fa-phone"></i>
                                                                </span>
                                    <input class="form-control" type="text" id="form-field-3" name="sttel"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-4"> صفة ولي الأمر </label>
                            <div class="col-sm-9">
                                <input type="text" id="form-field-4" placeholder="صفة ولي الأمر" class="col-xs-10 col-sm-5" name="stparenttype" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-5"> أسم ولي الأمر </label>
                            <div class="col-sm-9">
                                <input type="text" id="form-field-5" placeholder="أسم ولي الأمر" class="col-xs-10 col-sm-5" name="stparentname" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-6"> تليفون ولي الآمر </label>
                            <div class="col-xs-12 col-sm-8">
                                <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="ace-icon fa fa-phone"></i>
                                                                </span>
                                    <input class="form-control input-mask-phone" type="text" id="form-field-6" name="stparentmob" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-9"> الرقم القومي </label>
                            <div class="col-xs-12 col-sm-8">
                                <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="ace-icon fa fa-ticket"></i>
                                                                </span>
                                    <input class="form-control input-mask-id" type="text" id="form-field-9" name="stnationalid" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-8"> العنوان </label>
                            <div class="col-sm-8">
                                <textarea id="form-field-8" class="autosize-transition form-control" name="staddress" ></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-7"> الإيميل </label>
                            <div class="col-sm-9">
                                <input type="text" id="form-field-7" placeholder="الإيميل" class="col-xs-10 col-sm-5" name="stemail" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-10"> الحالة </label>
                            <div class="col-sm-9">
                                <input required name="sttype" type="radio" class="ace" value="1"  />
                                <span class="lbl"> إنتظام</span>
                                <br>
                                <input  required name="sttype" type="radio" class="ace" value="2"  />
                                <span class="lbl"> إنتساب</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-10"> السنة </label>
                            <div class="col-sm-9">
                                <input required name="styear" type="radio" class="ace" value="1"  />
                                <span class="lbl"> الأولى</span>
                                <br>
                                <input required name="styear" type="radio" class="ace" value="2"  />
                                <span class="lbl"> الثانية</span>
                                <br>
                                <input required name="styear" type="radio" class="ace" value="3"  />
                                <span class="lbl"> الثالثة</span>
                                <br>
                                <input required name="styear" type="radio" class="ace" value="4"  />
                                <span class="lbl"> الرابعة</span>
                                <br>
                                <input required name="styear" type="radio" class="ace" value="5"  />
                                <span class="lbl"> متخرج</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-11"> الترم </label>
                            <div class="col-sm-9">
                                <input required name="stterm" type="radio" class="ace" value="1" />
                                <span class="lbl"> الأول</span>
                                <br>
                                <input required name="stterm" type="radio" class="ace" value="2" />
                                <span class="lbl"> الثاني</span>
                                <br>
                                <input required name="stterm" type="radio" class="ace" value="3" />
                                <span class="lbl"> صيف</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-12"> المجموعة </label>
                            <div class="col-sm-9">
                                <input name="stgroup" type="radio" class="ace"  value="A"/>
                                <span class="lbl"> A</span>
                                <br>
                                <input name="stgroup" type="radio" class="ace"  value="B"/>
                                <span class="lbl"> B</span>
                                <br>
                                <input name="stgroup" type="radio" class="ace"  value="C"/>
                                <span class="lbl"> C</span>
                                <br>
                                <input name="stgroup" type="radio" class="ace"  value="E"/>
                                <span class="lbl"> E</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-3"> الكود </label>
                            <div class="col-sm-8">
                                <input type="text" id="form-field-7" placeholder="الكود" class="col-xs-10 col-sm-5" name="stcode" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-13"> المواد </label>
                            <div class="col-sm-8">
                                <select required class="dual_select" multiple="multiple" size="16" name="material_matid1[]" id="form-field-13">
                                    <?php
                                    $result2 = mysqli_query($con, "SELECT * FROM `material`");
                                    while ($row2 = $result2->fetch_assoc()) {
                                        unset($id2, $name2);
                                        $matid   = $row2['matid'];
                                        $matname = $row2['matname'];
                                        $matyear = $row2['matyear'];
                                        $matterm = $row2['matterm'];
                                        ?>
                                        <option value="<?php
                                        echo $row2['matid'];
                                        ?>"> <?php
                                            echo $row2['matname'] . " - الترم " . $row2['matterm'] . " - السنة " . $row2['matyear'];
                                            ?> </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-12"> النوع </label>
                            <div class="col-sm-9">
                                <input required name="sttype2" type="radio" class="ace"  value="A"/>
                                <span class="lbl"> باقي إعادة</span>
                                <br>
                                <input required name="sttype2" type="radio" class="ace"  value="B"/>
                                <span class="lbl"> مستجد</span>
                                <br>
                                <input id="final_revesion_check" required name="sttype2" type="radio" class="ace"  value="C"/>
                                <span class="lbl"> مراجعة نهائية</span>
                            </div>
                        </div>
                        <div class="form-group" id="final_revesion_content">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-13"> تكلفة المراجعة النهائية </label>
                            <div class="col-sm-8">
                                <input type="text"  id="spinner6" placeholder="التكلفة" class="col-xs-10 col-sm-5" name="stbalance" />
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
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="addreceiptin" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert a receipt in</h4>
                </div>
                <div class="modal-body">
                    Information
                    <form method="post" action="php/insertreceipt.php" class="form-horizontal">
                        <input type="hidden" name="receipttype" value="1">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Number </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Recipient </label>
                            <div class="col-sm-10">
                                <select required class="chosen-select" size="16" name="recipient" id="form-field-13">
                                    <?php
                                    $result2 = mysqli_query($con, "SELECT * FROM `professors`");
                                    while ($row2 = $result2->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row2['prid'] ?>"> <?php echo $row2['prname'] ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Donor </label>
                            <div class="col-sm-10">
                                <select required class="chosen-select" size="16" name="donor" id="form-field-13">
                                    <?php
                                    $result2 = mysqli_query($con, "SELECT * FROM `students`");
                                    while ($row2 = $result2->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row2['stid'] ?>">
                                            <?php echo $row2['stname']." - ".$row2['styear']." - ".$row2['stgroup'] ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Amount </label>
                            <div class="col-sm-10">
                                <input required type="text" value="750" name="amount"/>
                            </div>
                        </div>
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" class="form-control" name="date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Reason</label>
                            <div class="col-sm-10">
                                <div class="col-sm-10">
                                    <font size="3">
                                        <span class="lbl">Course</span>
                                        <input required name="reason" type="radio" class="ace" value="p1" />
                                        &nbsp; &nbsp;
                                        <span class="lbl">Notes</span>
                                        <input required name="reason" type="radio" class="ace" value="p2" />
                                        &nbsp; &nbsp;
                                        <span class="lbl">Final revesion</span>
                                        <input required name="reason" type="radio" class="ace" value="p3" />
                                        &nbsp; &nbsp;
                                        <span class="lbl">Other</span>
                                        <input required name="reason" type="radio" class="ace" value="p4" />
                                    </font>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Note </label>
                            <div class="col-sm-10">
                                <textarea id="form-field-8" class="autosize-transition form-control" name="description" ></textarea>
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
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="addreceiptout" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert a receipt out</h4>
                </div>
                <div class="modal-body">
                    Information
                    <form method="post" action="php/insertreceipt.php" class="form-horizontal">
                        <input type="hidden" name="receipttype" value="2">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Number </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Recipint </label>
                            <div class="col-sm-10">
                                <select required class="chosen-select" size="16" name="recipient" id="form-field-13">
                                    <?php
                                    $result2 = mysqli_query($con, "SELECT * FROM `professors`");
                                    while ($row2 = $result2->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row2['prid'] ?>"> <?php echo $row2['prname'] ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Donor </label>
                            <div class="col-sm-10">
                                <select required class="chosen-select" size="16" name="donor" id="form-field-13">
                                    <?php
                                    $result2 = mysqli_query($con, "SELECT * FROM `professors`");
                                    while ($row2 = $result2->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row2['prid'] ?>"> <?php echo $row2['prname'] ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Amount </label>
                            <div class="col-sm-10">
                                <input required type="text" value="750" name="amount"/>
                            </div>
                        </div>
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input required type="text" class="form-control" name="date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Reason </label>
                            <div class="col-sm-10">
                                <select required class="chosen-select" name="reason" id="form-field-13">
                                    <option value="" selected disabled> select a reason </option>
                                    <?php
                                    $result2 = mysqli_query($con, "SELECT * FROM `expenses`");
                                    while ($row2 = $result2->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo 'm'.$row2['exid'] ?>"> <?php echo $row2['exname']?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Note </label>
                            <div class="col-sm-10">
                                <textarea required id="form-field-8" class="autosize-transition form-control" name="description" ></textarea>
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
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="addreceiptaid" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert aid receipt</h4>
                </div>
                <div class="modal-body">
                    Information
                    <form method="post" action="php/insertreceipt.php" class="form-horizontal">
                        <input type="hidden" name="receipttype" value="3">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Number </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Recipient </label>
                            <div class="col-sm-10">
                                <select required class="chosen-select" size="16" name="recipient" id="form-field-13">
                                    <?php
                                    $result2 = mysqli_query($con, "SELECT * FROM `students`");
                                    while ($row2 = $result2->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row2['stid'] ?>">
                                            <?php echo $row2['stname']." - ".$row2['styear']." - ".$row2['stgroup'] ?> </option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Donor </label>
                            <div class="col-sm-10">
                                <select required class="chosen-select" size="16" name="donor" id="form-field-13">
                                    <?php
                                    $result2 = mysqli_query($con, "SELECT * FROM `professors`");
                                    while ($row2 = $result2->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row2['prid'] ?>"> <?php echo $row2['prname'] ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Aid percentage</label>
                            <div class="col-sm-10">
                                <div class="col-sm-10">
                                    <font size="3">
                                        <span class="lbl">25%</span>
                                        <input required name="percent" type="radio" class="ace" value="25" />
                                        &nbsp; &nbsp;
                                        <span class="lbl">50%</span>
                                        <input required name="percent" type="radio" class="ace" value="50" />
                                        &nbsp; &nbsp;
                                        <span class="lbl">100%</span>
                                        <input required name="percent" type="radio" class="ace" value="100" />
                                    </font>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Amount before aid </label>
                            <div class="col-sm-10">
                                <input required type="text" value="750" name="amount"/>
                            </div>
                        </div>
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input required type="text" class="form-control" name="date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> Note </label>
                            <div class="col-sm-10">
                                <textarea id="form-field-8" class="autosize-transition form-control" name="description" ></textarea>
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
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="summary" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Reports</h4>
                </div>
                <div class="modal-body">
                    Information
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> المطلوب من سنة 1 </label>
                            <div class="col-sm-8">
                                <input  id="form-field-1" type="text" class="input-sm" disabled value="<?php sumincome("1")?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> المطلوب من سنة 2 </label>
                            <div class="col-sm-8">
                                <input  id="form-field-1" type="text" class="input-sm" disabled value="<?php sumincome("2")?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> المطلوب من سنة 3</label>
                            <div class="col-sm-8">
                                <input  id="form-field-1" type="text" class="input-sm" disabled value="<?php sumincome("3")?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> المطلوب من سنة 4</label>
                            <div class="col-sm-8">
                                <input  id="form-field-1" type="text" class="input-sm" disabled value="<?php sumincome("4")?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">مجموع المطلوب</label>
                            <div class="col-sm-8">
                                <input  id="form-field-1" type="text" class="input-sm" disabled value="<?php sumallincome(1)?>"/>
                            </div>
                        </div>
                    </form>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="addabsence" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Add absence</h4>
                </div>
                <div class="modal-body">
                    Information
                    <form class="form-horizontal" method="post" action="php/insertabs.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-3"> المادة </label>
                            <div class="col-sm-10">
                                <select class="chosen-select" required id="form-field-3" name="material_matid">
                                    <?php
                                    $result2 = mysqli_query($con, "SELECT * FROM `material`");
                                    while ($row2 = $result2->fetch_assoc()) {
                                        unset($id2, $name2);
                                        $matid = $row2['matid'];
                                        $matname = $row2['matname'];
                                        $matyear = $row2['matyear'];
                                        $matterm = $row2['matterm'];
                                        ?>
                                        <option value="<?php echo $row2['matid'] ?>"> <?php echo $row2['matname']." - الترم ".$row2['matterm']." - السنة ".$row2['matyear'] ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-4"> الطلاب </label>
                            <div class="col-sm-10">
                                <select class="dual_select" required id="form-field-4" name="students_stid[]" multiple="">
                                    <?php
                                    $result2 = mysqli_query($con, "SELECT * FROM `students`");
                                    while ($row2 = $result2->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row2['stid'] ?>"> <?php echo $row2['stname']." - ".$row2['styear']." - ".$row2['stgroup'] ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" required class="form-control" name="date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
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
                </div>
            </div>
        </div>
    </div>
</font>
<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
