<?php
include_once "php/connection.php";
?>
<!DOCTYPE html>
<html>

<?php
$pageTitle = 'Login page';
include_once "layout/header.php";
?>
<style>
    #over1 {
        position: absolute;
    }
    #over2 {
        position: absolute;
    }
    #over3 {
        position: absolute;
    }
    #over4 {
        position: absolute;
    }
    .maxwidth {
        max-width: 100%;
        max-height: 100%;
    }
    .square {
        height: 267px;
        width: 267px;
    }
    @-webkit-keyframes blink {
        0% {
            opacity: 1;
        }
        50% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }
    @-moz-keyframes blink {
        0% {
            opacity: 1;
        }
        50% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }
    @-o-keyframes blink {
        0% {
            opacity: 1;
        }
        50% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }
    .blink {
        -webkit-animation: blink 1s;
        -webkit-animation-iteration-count: infinite;
    }
</style>
<?php
if(isset($_POST['submit'])) {
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($con, "Select users.username,
  users.id,
  users.password,
  users.nickname,
  users.role
From users
Where users.username = '$username' And users.password = '$password' ");

    if (mysqli_num_rows($result) != 0) {
        header('Location: index.php');
        $fh = fopen('/tmp/track.txt','a');
        fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
        fclose($fh);

        $row = mysqli_fetch_assoc($result);


        $_SESSION['azaz']['timestamp'] = time();
        $_SESSION['azaz']['authenticate'] = "true";
        $_SESSION['azaz']['role'] = $row[role];
        $_SESSION['azaz']['id'] = $row[id];
        $_SESSION['azaz']['nickname'] = $row[nickname];
        exit;

    } else {
        header('Location: login.php?backresult=0');
        $fh = fopen('/tmp/track.txt', 'a');
        fwrite($fh, $_SERVER['REMOTE_ADDR'] . ' ' . date('c') . "\n");
        fclose($fh);
        $_SESSION['azaz']['username'] = $username;
        exit;
    }

}
session_start();
?>
<body>
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div class="col-xs-12" align="center">
            <div class="square center"  align="left">
                <img id="over1" src="img/1.png" class="animated fadeInDown maxwidth " >
                <img id="over2" src="img/2.png" class="animated flip maxwidth " >
                <img id="over3" src="img/3.png" class="animated fadeInDown maxwidth" >
                <img id="over4" src="img/4.png" class="animated flip maxwidth" >
            </div>
        </div>
        <div class="col-lg-12">
            <form class="m-t" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username" required value="<?php
                    if (isset($_SESSION['azaz']['username'])){echo $_SESSION['azaz']['username'];}?>">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="">
                </div>
                <button type="Submit"  name="submit" class="btn btn-primary block full-width m-b">Login</button>
            </form>
            <?php
            if (isset($_GET['backresult'])){
                $backresult=$_GET['backresult'];
                if ($backresult ==  "0") {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        Check your username and password.
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

</div>
<div class="footer">
    <div>
        <strong>Copyright</strong> We.Code &copy; 2017
    </div>
</div>
<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
