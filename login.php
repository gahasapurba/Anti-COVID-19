<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?>
<?php

ob_start();

session_start();

$koneksi = new mysqli("localhost", "u969920341_covid19", "Covid19abc123", "u969920341_covid19");

if ($_SESSION["login"]) {
    header("location:index.php");
} else {

?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Halaman Login - AntiCOVID19</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="assets/css/custom.css" rel="stylesheet" />
        <!-- CSS KU -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

        <style>
            body {
                height: 950px;
                background: linear-gradient(to bottom, #EA2027 0%, #f5f6fa 100%);
            }
        </style>

    </head>

    <body>
        <div class="container">
            <div class="row text-center ">
                <div class="col-md-12">
                    <br><br>
                    <h1 style="color : white;"><b>AntiCOVID19</b></h2>
                        <h4 style="color : white">Dari IT Del, Untuk Indonesia Bebas Corona !</h5>
                            <br>
                </div>
            </div>
            <div class="row ">

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="panel kotakdel">
                        <div class="panel-heading">
                            <img src="assets/img/logo.png" class="user-image img-responsive" />
                        </div>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <br />
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                    <input type="text" name="username" class="form-control" placeholder="Masukkan Username" value="<?php if (isset($_POST['reset'])) {
                                                                                                                                        echo 'gahasapurba';
                                                                                                                                    } ?>" />
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password" value="<?php if (isset($_POST['reset'])) {
                                                                                                                                            echo 'gahasa123456';
                                                                                                                                        } ?>" />
                                </div>
                                <div class="form-group">
                                    <span class="pull-right">
                                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                                    </span>
                                </div>
                                <button type="submit" name="reset" class="btn btn-danger">Reset</button>
                            </form>
                        </div>

                    </div>
                </div>


            </div>
        </div>

        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="assets/js/jquery.metisMenu.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="assets/js/custom.js"></script>

    </body>

    </html>

    <?php
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = $koneksi->query("SELECT * FROM user WHERE username = '$username' AND password = '$password'");

        $data = $sql->fetch_assoc();

        $ketemu = $sql->num_rows;

        if ($ketemu >= 1) {
            $_SESSION["login"] = true;
            header("location:index.php");
        } else {
    ?>
            <script>
                alert("Username dan Password Tidak Terdaftar !");
            </script>
<?php
        }
    }
}

?>