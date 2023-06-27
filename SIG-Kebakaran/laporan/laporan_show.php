<div class="card">
    <div class="card-header">
        <strong>Data Laporan Kebakaran</strong>
    </div>
    <div class="card-body">
        <form action="?page=laporan-kebakaran-show" method="POST">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Masukkan Alamat atau Koordinat Lokasi..." name="keyword">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" value="Cari" id="button-search" name="search">Cari!
                    </button>
                </div>
            </div>
        </form>

        <a href="?page=laporan-kebakaran-add" class="btn btn-primary mb-2">Tambah Data</a>
        <a href="../laporan_kebakaran/laporan_kebakaran_print.php" target="_blank" class="btn btn-success mb-2">Cetak Data</a>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover m-0">
                <?php
                $limit = 5;
                $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                $mulai = ($page > 1) ? ($page * $limit) - $limit : 0;
                if (isset($_POST['search'])) {
                    $keyword = trim($_POST['keyword']);
                    if (!empty($keyword)) {
                        $query = mysqli_query($con, "SELECT * FROM laporan_kebakaran WHERE Alamat LIKE '%" . $keyword . "%' OR Koordinat_Lokasi LIKE '%" . $keyword . "%'");
                    }
                } else {
                    $query = mysqli_query($con, "SELECT * FROM laporan_kebakaran LIMIT $mulai, $limit") or die(mysqli_error($con));
                }
                ?>
                <thead>
                    <tr>
                        <th>ID Laporan</th>
                        <th>ID Pengguna</th>
                        <th>Alamat</th>
                        <th>Tanggal</th>
                        <th>Koordinat Lokasi</th>
                        <th>Deskripsi Kebakaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $no = $mulai + 1;
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?php echo $data['ID_Laporan']; ?></td>
                            <td><?php echo $data['ID_Pengguna']; ?></td>
                            <td><?php echo $data['Alamat']; ?></td>
                            <td><?php echo $data['Tanggal_Waktu_Laporan']; ?></td>
                            <td><?php echo $data['Koordinat_Lokasi']; ?></td>
                            <td><?php echo $data['Deskripsi_Kebakaran']; ?></td>
                            <td><?php echo $data['Status_Laporan']; ?></td>
                            <td>
                                <a class="btn btn-sm btn-success" href="?page=laporan-edit&id=<?php echo $data['ID_Laporan']; ?>">Edit</a><!-- ini edit -->
                                <a class="btn btn-sm btn-danger" href="../laporan/laporan_delete.php?id=<?php echo $data['ID_Laporan']; ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')">Hapus</a><!-- ini hapus -->
                            </td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        $result = mysqli_query($con, "SELECT COUNT(*) AS total FROM laporan_kebakaran");
        $row = mysqli_fetch_assoc($result);
        $total_records = $row['total'];
        ?>
        <p>Jumlah Data : <?php echo $total_records; ?></p>
        <nav class="mb-5">
            <ul class="pagination justify-content-end">
                <?php
                $jumlah_page = ceil($total_records / $limit);
                $jumlah_number = 1; // jumlah halaman ke kanan dan kiri dari halaman yang aktif
                $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
                $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;
                if ($page == 1) {
                    echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                    echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                } else {
                    $link_prev = ($page > 1) ? $page - 1 : 1;
                    echo '<li class="page-item"><a class="page-link" href="?page=laporan-kebakaran-show&halaman=1">First</a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?page=laporan-kebakaran-show&halaman=' . $link_prev . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                }
                for ($i = $start_number; $i <= $end_number; $i++) {
                    $link_active = ($page == $i) ? ' active' : '';
                    echo '<li class="page-item ' . $link_active . '"><a class="page-link" href="?page=laporan-kebakaran-show&halaman=' . $i . '">' . $i . '</a></li>';
                }
                if ($page == $jumlah_page) {
                    echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                    echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
                } else {
                    $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
                    echo '<li class="page-item"><a class="page-link" href="?page=laporan-kebakaran-show&halaman=' . $link_next . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?page=laporan-kebakaran-show&halaman=' . $jumlah_page . '">Last</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</div>