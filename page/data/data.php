<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3><b>Data Perkembangan COVID-19 Di Indonesia</b></h3>
                <h4>Silahkan tambahkan data per hari, perkembangan COVID-19 Di Indonesia, dengan merujuk pada Situs Resmi Gugus Tugas Percepatan Penanganan COVID-19 di Indonesia, <b>covid19.go.id</b></h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Terkonfirmasi Positif</th>
                                <th class="text-center">Sembuh</th>
                                <th class="text-center">Meninggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = $koneksi->query("SELECT * FROM datacovid ORDER BY id DESC");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                                <tr class="odd gradeX">
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="text-center"><?= date('d F Y', strtotime($data['tanggal'])); ?></td>
                                    <td class="text-center"><?= '+' . $data['terkonfirmasi']; ?></td>
                                    <td class="text-center"><?= '+' . $data['sembuh']; ?></td>
                                    <td class="text-center"><?= '+' . $data['meninggal']; ?></td>
                                    <td class="text-center">
                                        <a id="ubah_data" data-toggle="modal" data-target="#ubah" data-id="<?= $data['id'] ?>" data-tanggal="<?= $data['tanggal']; ?>" data-terkonfirmasi="<?= $data['terkonfirmasi']; ?>" data-dirawat="<?= $data['dirawat']; ?>" data-sembuh="<?= $data['sembuh']; ?>" data-meninggal="<?= $data['meninggal']; ?>" class="btn btn-info">Ubah</a>
                                        <a onclick="return confirm('Yakin Ingin Menghapus Data Ini ?')" id="hapus" href="?page=data&aksi=hapus&id=<?= $data['id']; ?>" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php
                                $total1 = $total1 + $data['terkonfirmasi'];
                                $total3 = $total3 + $data['sembuh'];
                                $total4 = $total4 + $data['meninggal'];
                            }
                            ?>
                        </tbody>
                        <tr>
                            <th colspan="2" class="text-center">TOTAL</th>
                            <td class="text-center"><b><?= $total1; ?></b></td>
                            <td class="text-center"><b><?= $total3; ?></b></td>
                            <td class="text-center"><b><?= $total4; ?></b></td>
                        </tr>
                    </table>
                </div>

                <!-- Modal Tambah -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#myModal">
                            Tambah Data
                        </button>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Form Penambahan Data Perkembangan COVID-19, Di Indonesia</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" method="post">
                                            <div class="form-group">
                                                <label for="tanggal">Tanggal</label>
                                                <input type="date" name="tanggal" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="terkonfirmasi">Terkonfirmasi Positif</label>
                                                <input type="number" name="terkonfirmasi" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="sembuh">Sembuh</label>
                                                <input type="number" name="sembuh" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="meninggal">Meninggal</label>
                                                <input type="number" name="meninggal" class="form-control">
                                            </div>
                                            <button type="reset" class="btn btn-danger">Reset</button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                        <button type="submit" name="tambah" class="btn btn-warning">Tambah</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_POST['tambah'])) {
                    $tanggal = $_POST['tanggal'];
                    $terkonfirmasi = $_POST['terkonfirmasi'];
                    $sembuh = $_POST['sembuh'];
                    $meninggal = $_POST['meninggal'];

                    $sql = $koneksi->query("INSERT INTO datacovid (tanggal, terkonfirmasi, sembuh, meninggal)values('$tanggal', '$terkonfirmasi', '$sembuh', '$meninggal')");

                    if ($sql) {
                ?>
                        <script>
                            alert("Terimakasih Telah Berpartisipasi Dalam Pengisian Penambahan Data Perkembangan COVID-19 Di Indonesia !");
                            window.location.href = "?page=data";
                        </script>
                <?php
                    }
                }
                ?>
                <!-- Akhir Modal Tambah -->

                <!-- Modal Ubah -->
                <div class="panel-body">
                    <div class="modal fade" id="ubah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Ubah Data COVID-19 Di Indonesia</h4>
                                </div>
                                <div class="modal-body" id="modal_ubah">
                                    <form role="form" method="post">
                                        <div class="form-group">
                                            <label for="id">ID</label>
                                            <input type="number" name="id" class="form-control" id="id" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" name="tanggal" class="form-control" id="tanggal">
                                        </div>
                                        <div class="form-group">
                                            <label for="terkonfirmasi">Terkonfirmasi Positif</label>
                                            <input type="number" name="terkonfirmasi" class="form-control" id="terkonfirmasi">
                                        </div>
                                        <div class="form-group">
                                            <label for="sembuh">Sembuh</label>
                                            <input type="number" name="sembuh" class="form-control" id="sembuh">
                                        </div>
                                        <div class="form-group">
                                            <label for="meninggal">Meninggal</label>
                                            <input type="number" name="meninggal" class="form-control" id="meninggal">
                                        </div>
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    <button type="submit" name="ubah" class="btn btn-warning">Ubah</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="assets/js/jquery-1.10.2.js"></script>

                <script>
                    $(document).on("click", "#ubah_data", function() {
                        var id = $(this).data('id');
                        var tanggal = $(this).data('tanggal');
                        var terkonfirmasi = $(this).data('terkonfirmasi');
                        var sembuh = $(this).data('sembuh');
                        var meninggal = $(this).data('meninggal');

                        $("#modal_ubah #id").val(id);
                        $("#modal_ubah #tanggal").val(tanggal);
                        $("#modal_ubah #terkonfirmasi").val(terkonfirmasi);
                        $("#modal_ubah #sembuh").val(sembuh);
                        $("#modal_ubah #meninggal").val(meninggal);
                    })
                </script>

                <?php
                if (isset($_POST['ubah'])) {
                    $id = $_POST['id'];
                    $tanggal = $_POST['tanggal'];
                    $terkonfirmasi = $_POST['terkonfirmasi'];
                    $sembuh = $_POST['sembuh'];
                    $meninggal = $_POST['meninggal'];

                    $sql = $koneksi->query("UPDATE datacovid SET tanggal = '$tanggal', terkonfirmasi = '$terkonfirmasi', sembuh = '$sembuh', meninggal = '$meninggal' WHERE id = '$id'");

                    if ($sql) {
                ?>
                        <script>
                            alert("Data Berhasil Diubah !");
                            window.location.href = "?page=data";
                        </script>
                <?php
                    }
                }
                ?>
                <!-- Akhir Modal Ubah -->
            </div>
        </div>
    </div>
</div>