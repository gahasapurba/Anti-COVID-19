<div class="row ">

    <style>
        .kotakdasar {
            background-color: #e0e0e0;
            border-radius: 30px;
            border-width: 5px;
            border-color: #202020;
        }
    </style>

    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="panel kotakdasar">
            <div class="panel-heading text-center">
                <h4><b>ISI BIODATA UNTUK MENGAKSES FITUR CEK RESIKO</b></h4>
                <img id="output" src="assets/img/find_user.png" class="user-image img-responsive" />
            </div>
            <div class="panel-body">
                <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Masukkan Nama</label>
                        <input class="form-control" name="nama" placeholder="Masukkan Nama Anda">
                    </div>
                    <div class="form-group">
                        <label for="jeniskelamin">Pilih Jenis Kelamin</label>
                        <select class="form-control" name="jeniskelamin">
                            <option>- Pilih Jenis Kelamin -</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Masukkan Foto Profil</label>
                        <input type="file" accept="image/*" onchange="loadFile(event)" class="form-control" name="gambar" id="gambar">
                    </div>
                    <div class="form-group">
                        <span class="pull-right">
                            <button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
                        </span>
                    </div>
                    <button type="submit" name="reset" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
    </div>

</div>

<?php
if (isset($_POST['daftar'])) {
    $nama = $_POST['nama'];
    $jeniskelamin = $_POST['jeniskelamin'];

    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $sql = $koneksi->query("INSERT INTO biodata (nama, jeniskelamin, gambar)values('$nama', '$jeniskelamin', '$gambar')");

    if ($sql) {
?>
        <script>
            alert("Terimakasih, Silahkan Masukkan Nama Anda di Form Cek Biodata Untuk Mengakses Fitur Cek Resiko !");
            window.location.href = "?page=cekresiko";
        </script>
<?php
    }
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('Pilih Gambar Terlebih Dahulu !');
              </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Yang Anda Upload Bukan Gambar !');
              </script>";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('Ukuran Gambar Terlalu Besar !');
              </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}
?>

<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>