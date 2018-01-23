<meta http-equiv="refresh" content="6000000000;url=php/logout.php" />
<!---->
<?php
session_start();
if (!isset($_SESSION['azaz']['authenticate']) or $_SESSION['azaz']['authenticate']!="true")
{
    header('Location: login.php');
}
/**
 * check user is authenticated
 */
if (($_SESSION['azaz']['authenticate']))
{
    if(time() - $_SESSION['azaz']['timestamp'] > 1*60) { //subtract new timestamp from the old one
        header('Location: php/logout.php');
    } else {
        $_SESSION['azaz']['timestamp'] = time(); //set new timestamp
    }
}

$admin_security = array("user.php", "settings.php", "properties.php", "custoder.php", "custody.php", "custodies.php", "custody_plus.php", "expenses.php", "expense.php", "property.php");
$power_security = array("stprofile.php");

// Validate user is authorize to access this page
if (in_array(basename($_SERVER['PHP_SELF']), $admin_security)) {
    if ($_SESSION['azaz']['role'] > 1){
        header("location:javascript://history.go(-1)");
        exit;
    }
}

if (in_array(basename($_SERVER['PHP_SELF']), $power_security)) {
    if ($_SESSION['azaz']['role'] > 2){
        header("location:javascript://history.go(-1)");
        exit;
    }
}
