<?php
include_once "php/functions.php";
?>
<font face="myFirstFont">
    <div class="modal inmodal" id="add_transaction" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة عملية بيع</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_transaction.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" id="site_id" name="site_id"  onchange="get_tower_id(this.value);">
                                    <option></option>
                                    <?php
                                    $query = "SELECT * FROM site";
                                    $results=mysqli_query($con, $query);
                                    //loop
                                    foreach ($results as $site){
                                        ?>
                                        <option value="<?php echo $site["id"];?>"><?php echo $site["name"];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2">رقم البرج </label>
                            <div class="col-sm-10">
                                <select required class="chosen-select" size="6" name="tower_number" id="towerlist" onchange="get_property_type_id(this.value);">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2">نوع العقار </label>
                            <div class="col-sm-10">
                                <select required class="chosen-select" size="6" id="property_type" name="property_type" onchange="get_property_number();">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> رقم العقار </label>
                            <div class="col-sm-10">
                                <select required class="chosen-select" size="6" name="property_number" id="property_number" onchange="get_property_price(this.value);">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> أسم المشتري </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="owner_name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> تليفون المشتري </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="owner_number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> سعر العقار قبل التعديل</label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="property_price_2" name="property_price_2"  readonly="readonly" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> إجمالي القيمة </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control calc" data-action="add" id="property_price" name="property_price"/></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> دفعة المقدم </label>
                            <div class="col-sm-10 form-inline">
                                <input type="text" class="form-control" name="first_date" required placeholder="تاريخ المقدم">&nbsp;<input type="text" class="form-control calc" data-action="sub" placeholder="قيمة المقدم" name="first_price" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> الأقساط </label>
                            <div class="col-sm-8">
                                <div class="field_wrapper">
                                    <div class="form-inline"><div class="form-group"><div class="col-sm-12"><input type="text" class="form-control" name="date[]" required placeholder="تاريخ القسط">&nbsp;<input type="text" class="form-control calc" data-action="sub" placeholder="قيمة القسط" name="price[]" required>&nbsp;<button type="button" class="btn btn-minier btn-info add_button" title="Add field" id="add"><i class="ace-icon fa fa-plus">Add</i></button></div></div></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> دفعة الإستلام </label>
                            <div class="col-sm-10 form-inline">
                                <input type="text" class="form-control" name="last_date" required placeholder="تاريخ الإستلام">&nbsp;<input class="form-control" name="last_price" type="text" id="total"  readonly="readonly" />
                            </div>
                        </div>
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">تاريخ العقد</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" id="date" class="form-control" name="contract_date" required>
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
    <div class="modal inmodal" id="add_properties" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة عقار</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_property.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="site_id"  onchange="get_tower_id(this.value);">
                                    <option></option>
                                    <?php
                                    $query = "SELECT * FROM site";
                                    $results=mysqli_query($con, $query);
                                    //loop
                                    foreach ($results as $site){
                                        ?>
                                        <option value="<?php echo $site["id"];?>"><?php echo $site["name"];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2">رقم البرج </label>
                            <div class="col-sm-10">
                                <select required class="chosen-select" size="6" name="tower_number" id="towerlist2">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2">نوع العقار </label>
                            <div class="col-sm-10">
                                <select required class="chosen-select" size="6" name="property_type" id="form-field-13">
                                    <?php
                                    $query = "SELECT * FROM property_type";
                                    $results=mysqli_query($con, $query);
                                    //loop
                                    foreach ($results as $property_type){
                                        ?>
                                        <option value="<?php echo $property_type["id"];?>"><?php echo $property_type["name"];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> رقم العقار </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="property_number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> مساحة العقار </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="property_area" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> سعر العقار </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="property_price" />
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
    <div class="modal inmodal" id="add_tower" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة برج</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_tower.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="site_id">
                                    <option></option>
                                    <?php
                                    $query = "SELECT * FROM site";
                                    $results=mysqli_query($con, $query);
                                    //loop
                                    foreach ($results as $site){
                                        ?>
                                        <option value="<?php echo $site["id"];?>"><?php echo $site["name"];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> رقم البرج </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="tower_number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> عدد الأدوار </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="tower_floor" />
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
    <div class="modal inmodal" id="add_site" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة موقع</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_site.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> أسم الموقع </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="site_name" />
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
    <div class="modal inmodal" id="add_expenses" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة مصروف</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_expenses.php">
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">التاريخ </label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" id="date" class="form-control" name="expenses_date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="site_id">
                                    <option></option>
                                    <?php
                                    $query = "SELECT * FROM site";
                                    $results=mysqli_query($con, $query);
                                    //loop
                                    foreach ($results as $site){
                                        ?>
                                        <option value="<?php echo $site["id"];?>"><?php echo $site["name"];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> البيان </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="expenses_subject" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> المبلغ </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="number" id="form-field-2" name="expenses_value" />
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
    <div class="modal inmodal" id="add_custody" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة عهدة</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_custody.php">
                        <input type="hidden" name="type" value="1"> <!--1 for plus custody-->
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">التاريخ </label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" id="date" class="form-control" name="custody_date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> المتعهد </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="custoder_id">
                                    <option></option>
                                    <?php
                                    $query = "SELECT * FROM custoder";
                                    $results=mysqli_query($con, $query);
                                    //loop
                                    foreach ($results as $custoder){
                                        ?>
                                        <option value="<?php echo $custoder["id"];?>"><?php echo $custoder["name"];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="site_id">
                                    <option></option>
                                    <?php
                                    $query = "SELECT * FROM site";
                                    $results=mysqli_query($con, $query);
                                    //loop
                                    foreach ($results as $site){
                                        ?>
                                        <option value="<?php echo $site["id"];?>"><?php echo $site["name"];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> البيان </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="subject" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> المبلغ </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="number" id="form-field-2" name="value" />
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
    <div class="modal inmodal" id="sub_custody" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">تخصيم عهدة</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_custody.php">
                        <input type="hidden" name="type" value="0"> <!--0 for plus custody-->
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">التاريخ </label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" id="date" class="form-control" name="custody_date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> المتعهد </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="custoder_id">
                                    <option></option>
                                    <?php
                                    $query = "SELECT * FROM custoder";
                                    $results=mysqli_query($con, $query);
                                    //loop
                                    foreach ($results as $custoder){
                                        ?>
                                        <option value="<?php echo $custoder["id"];?>"><?php echo $custoder["name"];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="site_id">
                                    <option></option>
                                    <?php
                                    $query = "SELECT * FROM site";
                                    $results=mysqli_query($con, $query);
                                    //loop
                                    foreach ($results as $site){
                                        ?>
                                        <option value="<?php echo $site["id"];?>"><?php echo $site["name"];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> البيان </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="subject" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> المبلغ </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="number" id="form-field-2" name="value" />
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
    <div class="modal inmodal" id="add_custoder" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة متعهد</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_custoder.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> أسم المتعهد </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="custoder_name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> رقم التليفون </label>
                            <div class="col-sm-10">
                                <input required class="form-control" type="text" id="form-field-2" name="custoder_mobile" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> بيانات آخرى </label>
                            <div class="col-sm-10">
                                <textarea required class="form-control"  type="text" id="form-field-2" name="custoder_notes" ></textarea>
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
    <div class="modal inmodal" id="property_payment_receive" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إيصال إستلام قسط</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/property_payment_receive.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2">تاريخ الإستلام </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="payment_date" required placeholder="تاريخ الإستلام">&nbsp;
                            </div>
                        </div>
                        <input required class="form-control" type="hidden" id="payment_id" name="payment_id" readonly="readonly"/>
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