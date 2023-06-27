
<?php
include "../connection.php";
$id_laporan = $_GET['ID_Laporan'];
$result = mysqli_query($con, "DELETE FROM laporan_kebakaran WHERE ID_Laporan=$id_laporan");
header("Location:../admin/?page=laporan-kebakaran-show");
// echo "<meta http-equiv='refresh' content='0; url=../?page=mahasiswa-show'>";
?>
