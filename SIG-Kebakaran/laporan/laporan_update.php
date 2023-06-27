<?php
if (isset($_POST['update'])) {
    $id_la = $_POST['ID_Laporan'];
    $id_peng = $_POST['ID_Pengguna'];
    $tgl = $_POST['Tanggal_Waktu_Laporan'];
    $kordinat = $_POST['Koordinat_Lokasi'];
    $dspkr = $_POST['Deskripsi_Kebakaran'];
    $status = $_POST['Status_Laporan'];

    // update user data
    $result = mysqli_query($con, "UPDATE Laporan SET
ID_Pengguna='$id_peng',Tanggal_Waktu_Laporan='$tgl',Koordinat_Lokasi='$kordinat',
Deskripsi_Kebakaran='$dspkr',Status_Laporan='$status' WHERE ID_Laporan=$id_la");
    // Redirect to homepage to display updated user in list
    header("Location:?page=Laporan-show");
}
