<?php
function active($currect_page){
    $url=strtok($_SERVER["REQUEST_URI"],'?');
    $url_array =  explode('/', $url) ;
    $url = end($url_array);
    if($currect_page == $url){
        echo 'active'; //class name in css
    }
}
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <font face="myFirstFont">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">
                                        <?php
                                        echo $_SESSION['azaz']['nickname']
                                        ?>
                                    </strong>
                             </span>
                                <span class="text-muted text-xs block">
                                    <?php
                                    switch ($_SESSION['azaz']['role'])
                                    {
                                        case "1":
                                            echo "Administrator";
                                            break;
                                        case "2":
                                            echo "Power user";
                                            break;
                                        case "3":
                                            echo "User";
                                            break;
                                        default:
                                            echo "Nothing here...";
                                    }
                                    ?>
                                    <b class="caret"></b>
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
                <?php
                if ($_SESSION['azaz']['role'] < 2){
                    ?>
                    <li class="<?php active('index.php');?>">
                        <a href="index.php">
                            <i class="fa fa-area-chart"></i> <span class="nav-label">الصفحة الرئيسية</span>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['azaz']['role'] < 2){
                    ?>
                    <li class="<?php active('properties.php');?>">
                        <a href="properties.php"><i class="fa fa-bank"></i> <span class="nav-label">العقارات</span></a>
                    </li>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['azaz']['role'] < 3){
                    ?>
                    <li class="<?php active('payments.php');?>">
                        <a href="payments.php"><i class="fa fa-book"></i> <span class="nav-label">الدفعات</span></a>
                    </li>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['azaz']['role'] < 2){
                    ?>
                    <li class="<?php active('expenses.php');?>">
                        <a href="expenses.php"><i class="fa fa-usd"></i> <span class="nav-label">الخزنة</span></a>
                    </li>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['azaz']['role'] < 2){
                    ?>
                    <li class="<?php active('custodies.php');?>">
                        <a href="custodies.php"><i class="fa fa-fax"></i> <span class="nav-label">العهدة</span></a>
                    </li>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['azaz']['role'] < 2){
                    ?>
                    <li class="<?php active('settings.php');?>">
                        <a href="settings.php"><i class="fa fa-cogs"></i> <span class="nav-label">الإعدادات</span></a>
                    </li>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['azaz']['role'] < 2){
                    ?>
                    <li class="<?php active('contractors.php');?>">
                        <a href="contractors.php"><i class="fa fa-users"></i> <span class="nav-label">المقاولين</span></a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </font>
    </div>
</nav>