<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?>

<?php

session_start();

if ($_SESSION["login"]) {

    $koneksi = new mysqli("localhost", "u969920341_covid19", "Covid19abc123", "u969920341_covid19");

?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>AntiCOVID19</title>
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
    </head>

    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">AntiCOVID19</a>
                </div>
                <div class="logout">
                    <a href="logout.php" class="btn btn-danger square-btn-adjust" onclick="return confirm('Anda Yakin Ingin Logout ?')"><b>Logout</b></a>
                </div>
            </nav>
            <!-- /. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <li class="text-center">
                            <img src="assets/img/logo.png" class="user-image img-responsive" />
                        </li>

                        <li>
                            <a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a>
                        </li>

                        <li>
                            <a href="?page=data"><i class="glyphicon glyphicon-signal"></i> Data</a>
                        </li>

                        <li>
                            <a href="?page=biodata"><i class="glyphicon glyphicon-pencil"></i> Biodata</a>
                        </li>

                        <li>
                            <a href="?page=cekresiko"><i class="glyphicon glyphicon-tint"></i> Cek Resiko</a>
                        </li>

                        <li>
                            <a href="?page=about"><i class="glyphicon glyphicon-user"></i> About</a>
                        </li>
                    </ul>

                </div>

            </nav>
            <!-- /. NAV SIDE  -->
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">

                            <?php

                            $page = $_GET['page'];
                            $aksi = $_GET['aksi'];

                            if ($page == "data") {
                                if ($aksi == "") {
                                    include "page/data/data.php";
                                }
                                if ($aksi == "hapus") {
                                    include "page/data/hapus.php";
                                }
                            } elseif ($page == "biodata") {
                                if ($aksi == "") {
                                    include "page/biodata/biodata.php";
                                }
                            } elseif ($page == "cekresiko") {
                                if ($aksi == "") {
                                    include "page/cekresiko/cekresiko.php";
                                }
                            } elseif ($page == "about") {
                                if ($aksi == "") {
                                    include "page/about/about.php";
                                }
                            } elseif ($page == "") {
                                include "home.php";
                            }

                            ?>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
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

} else {
    header("location:login.php");
}

?>