<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
    <div class="panel kotakdasar">
        <div class="panel-heading text-center">
            <h4><b>CEK BIODATA</b></h4>
            <h5>Cek Apakah Anda Terdaftar Untuk Mengakses Fitur Cek Resiko</h5>
        </div>
        <div class="panel-body">
            <form role="form" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input class="form-control" name="nama" placeholder="Masukkan Nama Anda">
                </div>
                <div class="form-group text-center">
                    <span>
                        <button type="submit" name="cek" class="btn btn-primary">Cek</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['cek'])) {
    $nama = $_POST['nama'];
    $jeniskelamin = $_POST['jeniskelamin'];

    $sql = $koneksi->query("SELECT * FROM biodata WHERE nama = '$nama'");

    $data = $sql->fetch_assoc();

    $ketemu = $sql->num_rows;

    if ($ketemu >= 1) {
        $_SESSION["biodata"] = true;
?>
        <script>
            alert("Terimakasih, Anda Sekarang Dapat Mengakses Fitur Cek Resiko !");
            window.location.href = "?page=cekresiko";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Nama Yang Anda Masukkan Tidak Terdaftar, Silahkan Mendaftar Terlebih Dahulu !");
            window.location.href = "?page=biodata";
        </script>
<?php
    }
}
?>

<?php
session_start();

if ($_SESSION["biodata"]) {
?>

    <div class="row">
        <div class="col-md-12">
            <h2><b>Fitur Cek Resiko</b></h2>
            <h5><b>Dengan menjawab beberapa pertanyaan di bawah, Anda akan mengetahui seberapa besar potensi anda untuk
                    terinfeksi Virus COVID-19</b></h5>
        </div>
    </div>
    <hr />
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" aria-describedby="dataTables-example_info">
                    <h2 class="text-center">DAFTAR PERTANYAAN</h2>
                    <h3 class="text-center">Penilaian Resiko Pribadi Terkait COVID-19</h3>
                    <thead>
                        <tr>
                            <th class="text-center">
                                <h4><b>NO</b></h4>
                            </th>
                            <th>
                                <h4><b>KEGIATAN</b></h4>
                            </th>
                            <th class="text-center">
                                <h4><b>YA</b></h4>
                            </th>
                            <th class="text-center">
                                <h4><b>TIDAK</b></h4>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        <form action="" method="POST">
                            <tr>
                                <td class="text-center"><b>A.</b></td>
                                <td><b>POTENSI TERTULAR DI LUAR RUMAH</b></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                            $sql = $koneksi->query("SELECT * FROM pertanyaana");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                                <tr>
                                    <?php $i++; ?>
                                    <td class="text-center"><?= $i; ?></td>
                                    <td><?= $data['pertanyaan']; ?></td>
                                    <td class="text-center"><input type='radio' name='jawaban[<?= $data['id']; ?>]' value='ya'></td>
                                    <td class="text-center"><input type='radio' name='jawaban[<?= $data['id']; ?>]' value='tidak'></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td class="text-center"><b>B.</b></td>
                                <td><b>POTENSI TERTULAR DI DALAM RUMAH</b></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                            $sql = $koneksi->query("SELECT * FROM pertanyaanb");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                                <tr>
                                    <?php $i++; ?>
                                    <td class="text-center"><?= $i; ?></td>
                                    <td><?= $data['pertanyaan']; ?></td>
                                    <td class="text-center"><input type='radio' name='jawaban[<?= $data['id']; ?>]' value='ya'></td>
                                    <td class="text-center"><input type='radio' name='jawaban[<?= $data['id']; ?>]' value='tidak'></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td class="text-center"><b>C.</b></td>
                                <td><b>DAYA TAHAN TUBUH (IMUNITAS)</b></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                            $sql = $koneksi->query("SELECT * FROM pertanyaanc");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                                <tr>
                                    <?php $i++; ?>
                                    <td class="text-center"><?= $i; ?></td>
                                    <td><?= $data['pertanyaan']; ?></td>
                                    <td class="text-center"><input type='radio' name='jawaban[<?= $data['id']; ?>]' value='ya'></td>
                                    <td class="text-center"><input type='radio' name='jawaban[<?= $data['id']; ?>]' value='tidak'></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Cek Resiko</button>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </form>
                    </tbody>
                </table>
                </input>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST["submit"])) {
        $jawaban = $_POST["jawaban"];
        if (count($jawaban) < 1) {
            echo "<script>alert('Anda Belum Mengisi Kuesioner !');</script>";
            die;
        } else {
            $benar = 0;
            foreach ($jawaban as $i => $nilai) {
                $data_soal = $koneksi->query("SELECT * FROM pertanyaana WHERE id = '$i'");
                $data_jawab = $data_soal->fetch_assoc();
                if ($data_jawab["jawaban"] == $nilai) {
                    $benar = $benar + 1;
                }
            }
            $jumlah_soal = 10;
            $nilai_per_soal = 100 / $jumlah_soal;
            $salah = $jumlah_soal - $benar;
            $presentase_benar = $benar / $jumlah_soal * 100;
            $presentase_salah = $salah / $jumlah_soal * 100;
            $nilai_total1 = $nilai_per_soal * $benar;

            $benar = 0;
            foreach ($jawaban as $i => $nilai) {
                $data_soal = $koneksi->query("SELECT * FROM pertanyaanb WHERE id = '$i'");
                $data_jawab = $data_soal->fetch_assoc();
                if ($data_jawab["jawaban"] == $nilai) {
                    $benar = $benar + 1;
                }
            }
            $jumlah_soal = 5;
            $nilai_per_soal = 100 / $jumlah_soal;
            $salah = $jumlah_soal - $benar;
            $presentase_benar = $benar / $jumlah_soal * 100;
            $presentase_salah = $salah / $jumlah_soal * 100;
            $nilai_total2 = $nilai_per_soal * $benar;

            $benar = 0;
            foreach ($jawaban as $i => $nilai) {
                $data_soal = $koneksi->query("SELECT * FROM pertanyaanc WHERE id = '$i'");
                $data_jawab = $data_soal->fetch_assoc();
                if ($data_jawab["jawaban"] == $nilai) {
                    $benar = $benar + 1;
                }
            }
            $jumlah_soal = 5;
            $nilai_per_soal = 100 / $jumlah_soal;
            $salah = $jumlah_soal - $benar;
            $presentase_benar = $benar / $jumlah_soal * 100;
            $presentase_salah = $salah / $jumlah_soal * 100;
            $nilai_total3 = $nilai_per_soal * $benar;
        };

        $nilai_total = $nilai_total1 + $nilai_total2 + $nilai_total3;

        if ($nilai_total <= 100) {
            echo "<script>alert('Nilai Anda = $nilai_total Dari Total Nilai, 300. Awas ! Anda Berpotensi Sangat Besar Untuk Terinfeksi Virus COVID-19 !');</script>";
        } else if ($nilai_total <= 200) {
            echo "<script>alert('Nilai Anda = $nilai_total Dari Total Nilai, 300. Anda Masih Berpotensi Untuk Terinfeksi Virus COVID-19 !');</script>";
        } else if ($nilai_total <= 300) {
            echo "<script>alert('Nilai Anda = $nilai_total Dari Total Nilai, 300. Selamat ! Anda Tidak Berpotensi Untuk Terinfeksi Virus COVID-19 !');</script>";
        }
    }

    ?>

<?php } ?>