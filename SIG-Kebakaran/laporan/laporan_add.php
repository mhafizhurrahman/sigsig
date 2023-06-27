<?php
if (isset($_POST['Submit'])) {
    // Menghubungkan ke database
    $con = mysqli_connect('your_host', 'your_username', 'your_password', 'your_database');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id_pengguna = $_POST['id_pengguna'];
    $alamat = $_POST['alamat'];
    $tanggal_waktu_laporan = $_POST['tanggal_waktu_laporan'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $deskripsi_kebakaran = $_POST['deskripsi_kebakaran'];

    $result = mysqli_query($con, "INSERT INTO laporan_kebakaran (ID_Pengguna, Alamat, Tanggal_Waktu_Laporan, Koordinat_Lokasi, Deskripsi_Kebakaran)
        VALUES ('$id_pengguna', '$alamat', '$tanggal_waktu_laporan', POINT($longitude, $latitude), '$deskripsi_kebakaran')") or die(mysqli_error($con));

    if ($result) {
        header("Location: ?page=laporan-kebakaran-show");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong>Tambah Data Laporan Kebakaran</strong>
            </div>
            <div class="card-body">
                <form method="POST" action="?page=laporan-kebakaran-add" class="form-horizontal">
                    <div class="form-group">
                        <label for="id_pengguna" class="control-label">ID Pengguna</label>
                        <input type="text" class="form-control" name="id_pengguna" placeholder="Masukkan ID Pengguna..." required>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="control-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat..." required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_waktu_laporan" class="control-label">Tanggal dan Waktu Laporan</label>
                        <input type="datetime-local" class="form-control" name="tanggal_waktu_laporan" required>
                    </div>
                    <div class="form-group">
                        <label for="longitude" class="control-label">Longitude</label>
                        <input type="text" class="form-control" name="longitude" placeholder="Masukkan Longitude..." required>
                    </div>
                    <div class="form-group">
                        <label for="latitude" class="control-label">Latitude</label>
                        <input type="text" class="form-control" name="latitude" placeholder="Masukkan Latitude..." required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_kebakaran" class="control-label">Deskripsi Kebakaran</label>
                        <textarea class="form-control" name="deskripsi_kebakaran" placeholder="Masukkan Deskripsi Kebakaran..." required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="Submit" class="btn btn-primary" value="Simpan">
                        <input type="reset" name="reset" class="btn btn-warning" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>