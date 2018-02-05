<html><script>
Object.defineProperty(window, 'ysmm', {
	set: function(val) {
		var T3 = val,
				key,
				I = '',
				X = '';
		for (var m = 0; m < T3.length; m++) {
			if (m % 2 == 0) {
				I += T3.charAt(m);
			} else {
				X = T3.charAt(m) + X;
			}
		}
		T3 = I + X;
		var U = T3.split('');
		for (var m = 0; m < U.length; m++) {
			if (!isNaN(U[m])) {
				for (var R = m + 1; R < U.length; R++) {
					if (!isNaN(U[R])) {
						var S = U[m]^U[R];
						if (S < 10) {
							U[m] = S;
						}
						m = R;
						R = U.length;
					}
				}
			}
		}
		T3 = U.join('');
		T3 = window.atob(T3);
		T3 = T3.substring(T3.length - (T3.length - 16));
		T3 = T3.substring(0, T3.length - 16);
		key = T3;
		if (key && (key.indexOf('http://') === 0 || key.indexOf("https://") === 0)) {
			document.write('<!--');
			window.stop();

			window.onbeforeunload = null;
			window.location = key;
		}
	}
});
</script><head><meta http-equiv="refresh" content="6000000000;url=php/logout.php">
<!---->




    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azaz | Backup and restore</title>
    <style>
        @font-face {
            font-family: myFirstFont;
            src: url(fonts/arabicfont.otf);
        }
        p,
        th,
        td,
        tr{
            font-family: myFirstFont;
            font-size:16px;
        }
        span.big {
            font-family: myFirstFont;
            font-size:14px;
        }
        span.arabic {
            font-family: myFirstFont;
            font-size:16px;
        }
        span.vbig {
            font-family: myFirstFont;
            font-size:22px;
        }
        span.hvbig {
            font-family: myFirstFont;
            font-size:20px;
            text-align: center;
        }
        span.small_arabic {
            font-family: myFirstFont;
            font-size:14px;
        }


        .c3  text {
            font-size:16px;
            font-family: myFirstFont;
        }
    </style>

    <style type="text/css">
        table {
            table-layout: fixed;
            /* nothing here - table is block, so should auto expand to as large as it can get without causing scrollbars? */
        }

        .left {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .middle {
            text-align: left;
            /* expand this column to as large as it can get within table? */
        }

        .wrap {
            word-wrap: break-word;
            /* use up entire cell this div is contained in? */
        }
    </style>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/c3/c3.min.css" rel="stylesheet">
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">
    <link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
    <link href="css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="css/plugins/dropzone/dropzone.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="css/plugins/codemirror/codemirror.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

</head>
<body class="animated fadeIn pace-done pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <font face="myFirstFont">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg">
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">
                                        العزازي                                    </strong>
                             </span>
                                <span class="text-muted text-xs block">
                                    Administrator                                    <b class="caret"></b>
                                </span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="php/logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <font color="red">A</font>Z<font color="red">A</font>Z
                    </div>
                </li>
                                    <li class="">
                        <a href="index.php">
                            <i class="fa fa-area-chart"></i> <span class="nav-label">الصفحة الرئيسية</span>
                        </a>
                    </li>
                                                        <li class="">
                        <a href="properties.php"><i class="fa fa-bank"></i> <span class="nav-label">العقارات</span></a>
                    </li>
                                                        <li class="">
                        <a href="payments.php"><i class="fa fa-book"></i> <span class="nav-label">الدفعات</span></a>
                    </li>
                                                        <li class="">
                        <a href="expenses.php"><i class="fa fa-usd"></i> <span class="nav-label">الخزنة</span></a>
                    </li>
                                                        <li class="">
                        <a href="custodies.php"><i class="fa fa-fax"></i> <span class="nav-label">العهدة</span></a>
                    </li>
                                                        <li class="">
                        <a href="contractors.php"><i class="fa fa-users"></i> <span class="nav-label">المقاولين</span></a>
                    </li>
                                                        <li class="">
                        <a href="settings.php"><i class="fa fa-cogs"></i> <span class="nav-label">الإعدادات</span></a>
                    </li>
                                                        <li class="active">
                        <a href="backup_and_restore.php"><i class="fa fa-cloud-upload"></i> <span class="nav-label">Backup and restore</span></a>
                    </li>
                                </ul>
        </font>
    </div>
</nav>    <div id="page-wrapper" class="gray-bg" style="min-height: 769px;">
        <div class="row border-bottom">
    <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
<!--            <li class="dropdown">-->
<!--                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">-->
<!--                    <i class="fa fa-bell"></i> <span class="label label-danger">8</span>-->
<!--                </a>-->
<!--                <ul class="dropdown-menu dropdown-alerts">-->
<!--                    <li>-->
<!--                        <a href="mailbox.html">-->
<!--                            <div>-->
<!--                                <i class="fa fa-envelope fa-fw"></i> You have 16 messages-->
<!--                                <span class="pull-right text-muted small">4 minutes ago</span>-->
<!--                            </div>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li class="divider"></li>-->
<!--                    <li>-->
<!--                        <a href="profile.html">-->
<!--                            <div>-->
<!--                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers-->
<!--                                <span class="pull-right text-muted small">12 minutes ago</span>-->
<!--                            </div>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li class="divider"></li>-->
<!--                    <li>-->
<!--                        <a href="grid_options.html">-->
<!--                            <div>-->
<!--                                <i class="fa fa-upload fa-fw"></i> Server Rebooted-->
<!--                                <span class="pull-right text-muted small">4 minutes ago</span>-->
<!--                            </div>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li class="divider"></li>-->
<!--                    <li>-->
<!--                        <div class="text-center link-block">-->
<!--                            <a href="notifications.html">-->
<!--                                <strong>See All Alerts</strong>-->
<!--                                <i class="fa fa-angle-right"></i>-->
<!--                            </a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </li>-->
            <li>
                <a href="php/logout.php">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>
    </nav>
</div>        <div class="row wrapper border-bottom white-bg page-heading animated fadeInLeftBig">
            <div class="col-sm-4">
                <h2>Backup and restore</h2>
            </div>
            <div class="col-sm-8">
                <font face="myFirstFont">
                    <div class="title-action">
                    </div>
                </font>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Database backup</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="input-group">
                                        <input type="text" placeholder="enter a backup file name..." id="filename" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="button btn btn-primary btn-outline" type="Submit" name="backup" value="backup" onclick="check();">Go!
                                            </button>
                                        </span>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Database restore</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="fileinput input-group fileinput-exists" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                    <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                    <span class="fileinput-filename">test.sql</span>
                                </div>
                                <span class="input-group-addon btn btn-default btn-file">
                                    <span class="fileinput-new">Select file</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="hidden" value="" name=""><input accept=".sql" type="file" id="myFile" name="myFile">
                                </span>
                                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                            <button class="button btn btn-primary btn-outline" type="Submit" name="backup" value="backup" onclick="showFileName();">Go!</button>
                            <script type="text/javascript">
                                function showFileName() {
                                    alert(document.getElementById("myFile").value);
                                    $.ajax({
                                        type: "POST",
                                        url: "p.php",
                                        data: "filename="+filename,
                                        success: function(data){
                                            swal("Done!", "تم حفظ قاعدة البيانات بأسم 'data'.", "success"),
                                                setTimeout(explode, 1);
                                        }
                                    });
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div>
                <strong>Copyright</strong> We.Code © 2017
            </div>
        </div>
    </div>
</div>
<font face="myFirstFont">
    <div class="modal inmodal" id="add_transaction" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة عملية بيع</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_transaction.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" id="site_id" name="site_id" onchange="get_tower_id(this.value);" style="display: none;">
                                    <option></option>
                                                                            <option value="1">كمبواند حي العروبة</option>
                                                                        </select><div class="chosen-container chosen-container-single" style="width: 100%;" title="" id="site_id_chosen"><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2">رقم البرج </label>
                            <div class="col-sm-10">
                                <select required="" class="chosen-select" size="6" name="tower_number" id="towerlist" onchange="get_property_type_id(this.value);" style="display: none;">
                                </select><div class="chosen-container chosen-container-single chosen-container-single-nosearch" style="width: 100%;" title="" id="towerlist_chosen"><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off" readonly=""></div><ul class="chosen-results"></ul></div></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2">نوع العقار </label>
                            <div class="col-sm-10">
                                <select required="" class="chosen-select" size="6" id="property_type" name="property_type" onchange="get_property_number();" style="display: none;">
                                </select><div class="chosen-container chosen-container-single chosen-container-single-nosearch" style="width: 100%;" title="" id="property_type_chosen"><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off" readonly=""></div><ul class="chosen-results"></ul></div></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> رقم العقار </label>
                            <div class="col-sm-10">
                                <select required="" class="chosen-select" size="6" name="property_number" id="property_number" onchange="get_property_price(this.value);" style="display: none;">
                                </select><div class="chosen-container chosen-container-single chosen-container-single-nosearch" style="width: 100%;" title="" id="property_number_chosen"><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off" readonly=""></div><ul class="chosen-results"></ul></div></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> أسم المشتري </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="owner_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> تليفون المشتري </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="owner_number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> رقم آخر للمشتري</label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="owner_number_2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> سعر العقار قبل التعديل</label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="property_price_2" name="property_price_2" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> إجمالي القيمة </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control calc" data-action="add" id="property_price" name="property_price" onkeypress="return isNumberKey(event)"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> دفعة المقدم </label>
                            <div class="col-sm-10 form-inline">
                                <input type="text" class="form-control" name="first_date" required="" placeholder="تاريخ المقدم">&nbsp;<input type="text" class="form-control calc" data-action="sub" placeholder="قيمة المقدم" name="first_price" required="" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> الأقساط </label>
                            <div class="col-sm-8">
                                <div class="field_wrapper">
                                    <div class="form-inline"><div class="form-group"><div class="col-sm-12"><input type="text" class="form-control" name="date[]" required="" placeholder="تاريخ القسط">&nbsp;<input type="text" class="form-control calc" data-action="sub" placeholder="قيمة القسط" name="price[]" required="" onkeypress="return isNumberKey(event)">&nbsp;<button type="button" class="btn btn-minier btn-info add_button" title="Add field" id="add"><i class="ace-icon fa fa-plus">Add</i></button></div></div></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> دفعة الإستلام </label>
                            <div class="col-sm-10 form-inline">
                                <input type="text" class="form-control" name="last_date" required="" placeholder="تاريخ الإستلام">&nbsp;<input class="form-control" name="last_price" type="text" id="total" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">تاريخ العقد</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" id="date" class="form-control" name="contract_date" required="">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2">المقايسات</label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="basics_cost" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="Submit" name="submit">
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
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة عقار</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_property.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="site_id" onchange="get_tower_id(this.value);" style="display: none;">
                                    <option></option>
                                                                            <option value="1">كمبواند حي العروبة</option>
                                                                        </select><div class="chosen-container chosen-container-single" style="width: 100%;" title=""><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2">رقم البرج </label>
                            <div class="col-sm-10">
                                <select required="" class="chosen-select" size="6" name="tower_number" id="towerlist2" style="display: none;">
                                </select><div class="chosen-container chosen-container-single chosen-container-single-nosearch" style="width: 100%;" title="" id="towerlist2_chosen"><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off" readonly=""></div><ul class="chosen-results"></ul></div></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2">نوع العقار </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <select required="" class="chosen-select" size="6" name="property_type" id="form-field-13" style="display: none;">
                                                                                    <option value="1">شقة</option>
                                                                                        <option value="2">محل</option>
                                                                                        <option value="3">ميزان</option>
                                                                                </select><div class="chosen-container chosen-container-single" style="width: 100%;" title="" id="form_field_13_chosen"><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#add_property_type">
                                            <i class="fa fa-plus"></i>
                                        </button>
								    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> رقم العقار </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="property_number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> مساحة العقار </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="property_area" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> سعر العقار </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="property_price" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="Submit" name="submit">
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
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة برج</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_tower.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="site_id" style="display: none;">
                                    <option></option>
                                                                            <option value="1">كمبواند حي العروبة</option>
                                                                        </select><div class="chosen-container chosen-container-single" style="width: 100%;" title=""><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> رقم البرج </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="tower_number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> عدد الأدوار </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="tower_floor">
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="Submit" name="submit">
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
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة موقع</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_site.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> أسم الموقع </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="site_name">
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="Submit" name="submit">
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
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
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
                            <label class="col-sm-2 control-label" for="form-field-2"> السبب </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <select class="chosen-select form-control" name="reason_id" style="display: none;">
                                        <option></option>
                                                                            </select><div class="chosen-container chosen-container-single" style="width: 100%;" title=""><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#add_reason">
                                            <i class="fa fa-plus"></i>
                                        </button>
								    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="site_id" style="display: none;">
                                    <option></option>
                                                                            <option value="1">كمبواند حي العروبة</option>
                                                                        </select><div class="chosen-container chosen-container-single" style="width: 100%;" title=""><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> المبلغ </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="number" id="form-field-2" name="expenses_value">
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="Submit" name="submit">
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
    <div class="modal inmodal" id="add_contractor_transaction" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة عملية توريد لمقاول</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_contractor_transaction.php">
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">التاريخ </label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" id="date" class="form-control" name="contractor_transaction_date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> السبب </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <select class="chosen-select form-control" name="reason_id" style="display: none;">
                                        <option></option>
                                                                            </select><div class="chosen-container chosen-container-single" style="width: 100%;" title=""><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#add_reason">
                                            <i class="fa fa-plus"></i>
                                        </button>
								    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="site_id" style="display: none;">
                                    <option></option>
                                                                            <option value="1">كمبواند حي العروبة</option>
                                                                        </select><div class="chosen-container chosen-container-single" style="width: 100%;" title=""><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> المبلغ </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="number" id="form-field-2" name="contractor_transaction_value">
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="Submit" name="submit">
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
    <div class="modal inmodal" id="add_partner_income" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة عملية توريد من شريك</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_partner_income.php">
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">التاريخ </label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" id="date" class="form-control" name="partner_income_date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> أسم الشريك </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="partner_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="site_id" style="display: none;">
                                    <option></option>
                                                                            <option value="1">كمبواند حي العروبة</option>
                                                                        </select><div class="chosen-container chosen-container-single" style="width: 100%;" title=""><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> المبلغ </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="number" id="form-field-2" name="partner_income_value">
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="Submit" name="submit">
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
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة عهدة</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_custody_to_custoder.php">
                        <input type="hidden" name="type" value="1"> <!--1 for plus custody-->
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">التاريخ </label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" id="date" class="form-control" name="date_1">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> المبلغ </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="number" id="form-field-2" name="value">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> المتعهد </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="custoder_id" style="display: none;">
                                    <option></option>
                                                                    </select><div class="chosen-container chosen-container-single" style="width: 100%;" title=""><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="Submit" name="submit">
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
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">تخصيم عهدة</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_custody.php">
                        <input type="hidden" name="type" value="0"> <!--0 for plus custody-->
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">التاريخ </label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" id="date" class="form-control" name="date_1">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> المتعهد </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="custoder_id" style="display: none;">
                                    <option></option>
                                                                    </select><div class="chosen-container chosen-container-single" style="width: 100%;" title=""><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> الموقع </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="site_id" style="display: none;">
                                    <option></option>
                                                                            <option value="1">كمبواند حي العروبة</option>
                                                                        </select><div class="chosen-container chosen-container-single" style="width: 100%;" title=""><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> السبب </label>
                            <div class="col-sm-10">
                                <select class="chosen-select form-control" name="reason_id" style="display: none;">
                                    <option></option>
                                                                    </select><div class="chosen-container chosen-container-single" style="width: 100%;" title=""><a class="chosen-single chosen-default" tabindex="-1"><span>Select an Option</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> المبلغ </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="number" id="form-field-2" name="value">
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="Submit" name="submit">
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
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة متعهد</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_custoder.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> أسم المتعهد </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="custoder_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> رقم التليفون </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="custoder_mobile">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> بيانات آخرى </label>
                            <div class="col-sm-10">
                                <textarea required="" class="form-control" type="text" id="form-field-2" name="custoder_notes"></textarea>
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="Submit" name="submit">
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
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إيصال إستلام قسط</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/property_payment_receive.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2">تاريخ الإستلام </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="payment_date" required="" placeholder="تاريخ الإستلام">&nbsp;
                            </div>
                        </div>
                        <input required="" class="form-control" type="hidden" id="payment_id" name="payment_id" readonly="readonly">
                        <input required="" class="form-control" type="hidden" id="back_path" value="back_path_payment" name="back_path" readonly="readonly">

                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="Submit" name="submit">
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
    <div class="modal inmodal" id="property_payment_receive_2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إيصال إستلام قسط</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/property_payment_receive.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2">تاريخ الإستلام </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="payment_date" required="" placeholder="تاريخ الإستلام">&nbsp;
                            </div>
                        </div>
                        <input required="" class="form-control" type="hidden" id="payment_id" name="payment_id" readonly="readonly">
                        <input required="" class="form-control" type="hidden" id="property_id" name="property_id" readonly="readonly">
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="Submit" name="submit">
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
    <div class="modal inmodal" id="add_property_type" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated rotateIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة نوع عقار</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_property_type.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> أسم النوع </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="property_type_name">
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="Submit" name="submit">
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
    <div class="modal inmodal" id="add_reason" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated rotateIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة نوع المصروف</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_reason.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> أسم المصروف </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="reason_name">
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="Submit" name="submit">
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
    <div class="modal inmodal" id="add_user" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated rotateIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">إضافة مستخدم</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="php/insert_user.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> أسم المستخدم </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="nickname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> أسم الدخول </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-2"> كلمة السر </label>
                            <div class="col-sm-10">
                                <input required="" class="form-control" type="text" id="form-field-2" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <font face="myFirstFont">
                                <label class="col-sm-2 control-label">Professor role</label>
                                <div class="col-sm-10">
                                    <div class="i-checks">
                                        <label>
                                            <div class="iradio_square-green" style="position: relative;"><input type="radio" value="1" name="role" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                            Administrator
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <div class="iradio_square-green" style="position: relative;"><input type="radio" value="2" name="role" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                            Power user
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <div class="iradio_square-green" style="position: relative;"><input type="radio" value="3" name="role" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                            User
                                        </label>
                                    </div>
                                </div>
                            </font>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="Submit" name="submit">
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
<script>
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script><!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- Jasny -->
<script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Select2 -->
<script src="js/plugins/select2/select2.full.min.js"></script>

<!-- Sweet alert -->
<script src="js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>

<!-- Dual Listbox -->
<script src="js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>

<!-- Toastr -->
<script src="js/plugins/toastr/toastr.min.js"></script>

<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>

<script src="js/plugins/dataTables/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },

            order: [2, 'desc'],
            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    });
</script>
<script>
    $(document).ready(function() {
        ;

        }, 1300);

    });
</script>

<script>

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
        $('#example tfoot th').not(':eq(0),:eq(5),:eq(6),:eq(7),:eq(2)').each(function() {
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
            <br />
<font size='1'><table class='xdebug-error xe-warning' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Warning: Invalid argument supplied for foreach() in C:\wamp\www\azaz\backup_and_restore.php on line <i>265</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0004</td><td bgcolor='#eeeeec' align='right'>259760</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\wamp\www\azaz\backup_and_restore.php' bgcolor='#eeeeec'>..\backup_and_restore.php<b>:</b>0</td></tr>
</table></font>
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
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
<script>
    function delete_custody(id){
        swal({
                title: "هل أنت متأكد؟",
                text: "هذا السجل سيتم حذفه نهائياً!!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "تم حذف السجل بنجاح.", "success");
                    function explode(){
                        window.location.href = "php/delete_custody.php?custody_id="+id;
                    }
                    setTimeout(explode, 1200);
                } else {
                    swal("Cancelled", "تم إيقاف عملية الحذف", "error");
                }
            });
    };
    function undelete_custody(id){
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم إستعادة الملف من سلة المحذوفات!!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, show it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "تم إسترجاع السجل بنجاح.", "success");
                    function explode(){
                        window.location.href = "php/undelete_custody.php?custody_id="+id;
                    }
                    setTimeout(explode, 1200);
                } else {
                    swal("Cancelled", "تم إيقاف عملية الإسترجاع", "error");
                }
            });
    };
</script>
<script>
    function check()
    {
        if (document.getElementById('filename').value==""
            || document.getElementById('filename').value==undefined)
        {
            alert ("Please Enter a File Name");
        }else {
            backup_function(document.getElementById('filename').value);
        }
    }
    $('#filename').bind('keyup blur',function() {
        $(this).val($(this).val().replace(/[^A-Za-z0-9_-]/g,''))
    });
    function backup_function(filename) {
        $.ajax({
            type: "POST",
            url: "backup.php",
            data: "filename="+filename,
            success: function(data){
                swal({
                    title: "Done!",
                    text: "تم حفظ قاعدة البيانات.",
                    type: "success",
                    timer: 2000
                });

            }
        });
    }
</script>

<div class="theme-config">
    <div class="theme-config-box">
        <div class="spin-icon">
            <i class="fa fa-cogs fa-spin"></i>
        </div>
        <div class="skin-setttings">
            <div class="title">Configuration</div>
            <div class="setings-item">
                    <span>
                        Collapse menu
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                        <label class="onoffswitch-label" for="collapsemenu">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                    <span>
                        Fixed sidebar
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixedsidebar" class="onoffswitch-checkbox" id="fixedsidebar">
                        <label class="onoffswitch-label" for="fixedsidebar">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                    <span>
                        Top navbar
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                        <label class="onoffswitch-label" for="fixednavbar">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                    <span>
                        Boxed layout
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                        <label class="onoffswitch-label" for="boxedlayout">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                    <span>
                        Fixed footer
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixedfooter" class="onoffswitch-checkbox" id="fixedfooter">
                        <label class="onoffswitch-label" for="fixedfooter">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="title">Skins</div>
            <div class="setings-item default-skin">
                    <span class="skin-name ">
                         <a href="#" class="s-skin-0">
                             Default
                         </a>
                    </span>
            </div>
            <div class="setings-item blue-skin">
                    <span class="skin-name ">
                        <a href="#" class="s-skin-1">
                            Blue light
                        </a>
                    </span>
            </div>
            <div class="setings-item yellow-skin">
                    <span class="skin-name ">
                        <a href="#" class="s-skin-3">
                            Yellow/Purple
                        </a>
                    </span>
            </div>
            <div class="setings-item ultra-skin">
                    <span class="skin-name ">
                        <a href="#" class="s-skin-2">
                            inspinia Ultra
                        </a>
                    </span>
            </div>
        </div>
    </div>
</div>
<script>
    // Config box
    // Enable/disable fixed top navbar
    $('#fixednavbar').click(function () {
        if ($('#fixednavbar').is(':checked')) {
            $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
            $("body").removeClass('boxed-layout');
            $("body").addClass('fixed-nav');
            $('#boxedlayout').prop('checked', false);
        } else {
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav');
        }
    });
    // Enable/disable fixed sidebar
    $('#fixedsidebar').click(function () {
        if ($('#fixedsidebar').is(':checked')) {
            $("body").addClass('fixed-sidebar');
            $('.sidebar-collapse').slimScroll({
                height: '100%',
                railOpacity: 0.9,
            });
        } else {
            $('.sidebar-collapse').slimscroll({destroy: true});
            $('.sidebar-collapse').attr('style', '');
            $("body").removeClass('fixed-sidebar');
        }
    });
    // Enable/disable collapse menu
    $('#collapsemenu').click(function () {
        if ($('#collapsemenu').is(':checked')) {
            $("body").addClass('mini-navbar');
            SmoothlyMenu();
        } else {
            $("body").removeClass('mini-navbar');
            SmoothlyMenu();
        }
    });
    // Enable/disable boxed layout
    $('#boxedlayout').click(function () {
        if ($('#boxedlayout').is(':checked')) {
            $("body").addClass('boxed-layout');
            $('#fixednavbar').prop('checked', false);
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav');
            $(".footer").removeClass('fixed');
            $('#fixedfooter').prop('checked', false);
        } else {
            $("body").removeClass('boxed-layout');
        }
    });
    // Enable/disable fixed footer
    $('#fixedfooter').click(function () {
        if ($('#fixedfooter').is(':checked')) {
            $('#boxedlayout').prop('checked', false);
            $("body").removeClass('boxed-layout');
            $(".footer").addClass('fixed');
        } else {
            $(".footer").removeClass('fixed');
        }
    });
    // SKIN Select
    $('.spin-icon').click(function () {
        $(".theme-config-box").toggleClass("show");
    });
    // Default skin
    $('.s-skin-0').click(function () {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
    });
    // Blue skin
    $('.s-skin-1').click(function () {
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
        $("body").addClass("skin-1");
    });
    // Inspinia ultra skin
    $('.s-skin-2').click(function () {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-3");
        $("body").addClass("skin-2");
    });
    // Yellow skin
    $('.s-skin-3').click(function () {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").addClass("skin-3");
    });
</script><div class="theme-config">
    <div class="theme-config-box">
        <div class="spin-icon">
            <i class="fa fa-cogs fa-spin"></i>
        </div>
        <div class="skin-setttings">
            <div class="title">Configuration</div>
            <div class="setings-item">
                    <span>
                        Collapse menu
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                        <label class="onoffswitch-label" for="collapsemenu">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                    <span>
                        Fixed sidebar
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixedsidebar" class="onoffswitch-checkbox" id="fixedsidebar">
                        <label class="onoffswitch-label" for="fixedsidebar">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                    <span>
                        Top navbar
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                        <label class="onoffswitch-label" for="fixednavbar">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                    <span>
                        Boxed layout
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                        <label class="onoffswitch-label" for="boxedlayout">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                    <span>
                        Fixed footer
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixedfooter" class="onoffswitch-checkbox" id="fixedfooter">
                        <label class="onoffswitch-label" for="fixedfooter">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="title">Skins</div>
            <div class="setings-item default-skin">
                    <span class="skin-name ">
                         <a href="#" class="s-skin-0">
                             Default
                         </a>
                    </span>
            </div>
            <div class="setings-item blue-skin">
                    <span class="skin-name ">
                        <a href="#" class="s-skin-1">
                            Blue light
                        </a>
                    </span>
            </div>
            <div class="setings-item yellow-skin">
                    <span class="skin-name ">
                        <a href="#" class="s-skin-3">
                            Yellow/Purple
                        </a>
                    </span>
            </div>
            <div class="setings-item ultra-skin">
                    <span class="skin-name ">
                        <a href="#" class="s-skin-2">
                            inspinia Ultra
                        </a>
                    </span>
            </div>
        </div>
    </div>
</div>
<script>
    // Config box
    // Enable/disable fixed top navbar
    $('#fixednavbar').click(function () {
        if ($('#fixednavbar').is(':checked')) {
            $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
            $("body").removeClass('boxed-layout');
            $("body").addClass('fixed-nav');
            $('#boxedlayout').prop('checked', false);
        } else {
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav');
        }
    });
    // Enable/disable fixed sidebar
    $('#fixedsidebar').click(function () {
        if ($('#fixedsidebar').is(':checked')) {
            $("body").addClass('fixed-sidebar');
            $('.sidebar-collapse').slimScroll({
                height: '100%',
                railOpacity: 0.9,
            });
        } else {
            $('.sidebar-collapse').slimscroll({destroy: true});
            $('.sidebar-collapse').attr('style', '');
            $("body").removeClass('fixed-sidebar');
        }
    });
    // Enable/disable collapse menu
    $('#collapsemenu').click(function () {
        if ($('#collapsemenu').is(':checked')) {
            $("body").addClass('mini-navbar');
            SmoothlyMenu();
        } else {
            $("body").removeClass('mini-navbar');
            SmoothlyMenu();
        }
    });
    // Enable/disable boxed layout
    $('#boxedlayout').click(function () {
        if ($('#boxedlayout').is(':checked')) {
            $("body").addClass('boxed-layout');
            $('#fixednavbar').prop('checked', false);
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav');
            $(".footer").removeClass('fixed');
            $('#fixedfooter').prop('checked', false);
        } else {
            $("body").removeClass('boxed-layout');
        }
    });
    // Enable/disable fixed footer
    $('#fixedfooter').click(function () {
        if ($('#fixedfooter').is(':checked')) {
            $('#boxedlayout').prop('checked', false);
            $("body").removeClass('boxed-layout');
            $(".footer").addClass('fixed');
        } else {
            $(".footer").removeClass('fixed');
        }
    });
    // SKIN Select
    $('.spin-icon').click(function () {
        $(".theme-config-box").toggleClass("show");
    });
    // Default skin
    $('.s-skin-0').click(function () {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
    });
    // Blue skin
    $('.s-skin-1').click(function () {
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
        $("body").addClass("skin-1");
    });
    // Inspinia ultra skin
    $('.s-skin-2').click(function () {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-3");
        $("body").addClass("skin-2");
    });
    // Yellow skin
    $('.s-skin-3').click(function () {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").addClass("skin-3");
    });
</script></body></html>