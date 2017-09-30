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
                                        echo $_SESSION['5inarch']['username']
                                        ?>
                                    </strong>
                             </span>
                                <span class="text-muted text-xs block">
                                    <?php
                                    switch ($_SESSION['5inarch']['role'])
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
                        <font color="red">5</font> in<br><small>ARCH</small>
                    </div>
                </li>
                <li class="<?php active('index.php');?>">
                    <a href="index.php">
                        <i class="fa fa-area-chart"></i> <span class="nav-label">Dashboard</span>
                    </a>
                </li>
                <li class="<?php active('professors.php');?>">
                    <a href="professors.php"><i class="fa fa-user-circle"></i> <span class="nav-label">Professors</span></a>
                </li>
                <li class="<?php active('students.php');?>">
                    <a href="students.php"><i class="fa fa-users"></i> <span class="nav-label">Students</span></a>
                </li>
                <li class="<?php active('materials.php');?>">
                    <a href="materials.php"><i class="fa fa-database fa-1x"></i> <span class="nav-label">Materials</span></a>
                </li>
                <?php
                if ($_SESSION['5inarch']['role'] < 3){
                    ?>
                    <li class="<?php active('receipts.php');?>">
                        <a href="receipts.php"><i class="fa fa-money fa-1x"></i> <span class="nav-label">Receipts</span></a>
                    </li>
                    <?php
                }
                ?>

                <?php
                if ($_SESSION['5inarch']['role'] == 1){
                    ?>
                    <li class="<?php active('reports.php');?>">
                        <a href="reports.php"><i class="fa fa-thermometer-full fa-1x"></i> <span class="nav-label">Reports</span></a>
                    </li>
                    <?php
                }
                ?>

            </ul>
        </font>
    </div>
</nav>