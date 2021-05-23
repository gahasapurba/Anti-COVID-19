<?php

$sql1 = $koneksi->query("SELECT * FROM datacovid");
while ($data1 = $sql1->fetch_assoc()) {
    $jml1 = $data1['terkonfirmasi'];
    $total1 = $total1 + $jml1;

    $jml3 = $data1['sembuh'];
    $total3 = $total3 + $jml3;

    $jml4 = $data1['meninggal'];
    $total4 = $total4 + $jml4;
}

$total2 = $total1 - ($total3 + $total4);

$sql2 = $koneksi->query("SELECT * FROM datacovid ORDER BY id DESC LIMIT 1");
while ($data2 = $sql2->fetch_assoc()) {
    $tambah1 = $data2['terkonfirmasi'];

    $tambah3 = $data2['sembuh'];

    $tambah4 = $data2['meninggal'];

    $update = $data2['update'];
}

$persenrawat = $total2 / $total1;
$persenrawat2 = round($persenrawat, 3) * 100;

$persensembuh = $total3 / $total1;
$persensembuh2 = round($persensembuh, 3) * 100;

$persenmeninggal = $total4 / $total1;
$persenmeninggal2 = round($persenmeninggal, 3) * 100;

?>

<div class="row">
    <div class="col-md-12">
        <h2><b>Ayo, Kita Kawal Corona di Indonesia !</b></h2>
        <h5><b>Dari IT Del, Untuk Indonesia Bebas Corona !</b></h5>
    </div>
    <hr>
    <div class="col-md-12">
        <h4><b>Update Terakhir : <?= $update; ?></b></h4>
        <h5>Data diupdate menurut Situs Resmi Gugus Tugas Percepatan Penanganan COVID-19 di Indonesia, <b>covid19.go.id</b></h5>
    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="panel panel-primary text-center no-boder kotak-biru" style="border-radius: 40px">
            <div class="panel-body">
                <i class="fa fa-user fa-5x"></i>
                <h1><b><?= $total1; ?></b></h1>
                <h3><b>+<?= $tambah1; ?></b></h3>
                <h5><b>ORANG</b></h5>
            </div>
            <div class="panel-footer dasar" style="border-radius: 20px">
                <h5><b>TERKONFIRMASI POSITIF</b></h5>
                <h5>Tersebar di 34 Provinsi</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="panel panel-primary text-center no-boder kotak-oranye" style="border-radius: 40px">
            <div class="panel-body">
                <i class="fa fa-user fa-5x"></i>
                <h1><b><?= $total2; ?></b></h1>
                <h3><b>.</b></h3>
                <h5><b>ORANG</b></h5>
            </div>
            <div class="panel-footer dasar" style="border-radius: 20px">
                <h5><b>DALAM TAHAP PERAWATAN</b></h5>
                <h5><?= $persenrawat2; ?> % Dari Terkonfirmasi Positif</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="panel panel-primary text-center no-boder kotak-hijau" style="border-radius: 40px">
            <div class="panel-body">
                <i class="fa fa-user fa-5x"></i>
                <h1><b><?= $total3; ?></b></h1>
                <h3><b>+<?= $tambah3; ?></b></h3>
                <h5><b>ORANG</b></h5>
            </div>
            <div class="panel-footer dasar" style="border-radius: 20px">
                <h5><b>SEMBUH</b></h5>
                <h5><?= $persensembuh2; ?> % Dari Terkonfirmasi Positif</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="panel panel-primary text-center no-boder kotak-merah" style="border-radius: 40px">
            <div class="panel-body">
                <i class="fa fa-user fa-5x"></i>
                <h1><b><?= $total4; ?></b></h1>
                <h3><b>+<?= $tambah4; ?></b></h3>
                <h5><b>ORANG</b></h5>
            </div>
            <div class="panel-footer dasar" style="border-radius: 20px">
                <h5><b>MENINGGAL</b></h5>
                <h5><?= $persenmeninggal2; ?> % Dari Terkonfirmasi Positif</h5>
            </div>
        </div>
    </div>
</div>

<br>

<div class="col-md-6 col-sm-12 col-xs-12">
    <canvas id="myChart1"></canvas>
</div>

<div class="col-md-6 col-sm-12 col-xs-12">
    <canvas id="myChart2"></canvas>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">

<script>
    var ctx = document.getElementById("myChart1").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Terkonfirmasi Positif", "Dalam Tahap Perawatan", "Sembuh", "Meninggal"],
            datasets: [{
                label: '',
                data: [
                    <?= $total1; ?>,
                    <?= $total2; ?>,
                    <?= $total3; ?>,
                    <?= $total4; ?>
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255,99,132,1)'
                ],
                borderWidth: 5
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Grafik Dalam Bentuk Pie'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById("myChart2").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Terkonfirmasi Positif", "Dalam Tahap Perawatan", "Sembuh", "Meninggal"],
            datasets: [{
                label: '',
                data: [
                    <?= $total1; ?>,
                    <?= $total2; ?>,
                    <?= $total3; ?>,
                    <?= $total4; ?>
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255,99,132,1)'
                ],
                borderWidth: 5
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Grafik Dalam Bentuk Bar'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>