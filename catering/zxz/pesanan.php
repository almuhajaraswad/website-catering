<?php 
session_start();

if (!isset($_SESSION['zzz21'])) {
   echo "<script>
         window.location.replace('../login.php');
       </script>";
  exit;
}

require 'functions.php';

function cari($keyword) {
    $query = "SELECT pesanan.id as id_pes, pesanan.verif as verif, pesanan.nohp as nohp, produk.judul as nama_produk, produk.harga as harga, pesanan.jumlah as jumlah, pesanan.tanggal as tanggal, pesanan.status as status, pesanan.file as file, pesanan.keterangan as nama_pemesan, pesanan.kode_unik as kode_unik FROM pesanan JOIN produk ON pesanan.id_produk = produk.id
                WHERE
              nohp LIKE '%$keyword%' OR
              kode_unik LIKE '%$keyword%' OR
              keterangan LIKE '%$keyword%' OR
              status LIKE '%$keyword%' AND pesanan.status = 'Sudah Dibayar' ORDER BY pesanan.id DESC
            ";
    return query($query);
}

$pesanan = mysqli_query($conn, "SELECT pesanan.id as id_pes, pesanan.verif as verif, pesanan.nohp as nohp, produk.judul as nama_produk, produk.harga as harga, pesanan.jumlah as jumlah, pesanan.tanggal as tanggal, pesanan.status as status, pesanan.file as file, pesanan.keterangan as nama_pemesan, pesanan.kode_unik as kode_unik FROM pesanan JOIN produk ON pesanan.id_produk = produk.id WHERE pesanan.status = 'Sudah Dibayar'");

// jika tombol cari di tekan
if (isset($_POST["cari"])) {
    $pesanan = cari($_POST["keyword"]);
} 


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'link.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script>
         $(document).ready(function() {

         $("#form").hide();

         $("#btn-show").click(function() {
           $("#form").show();
         })

         $("#btn-hide").click(function() {
           $("#form").hide();
         })

       });
    </script>
    <style>
        table img {
            transition: 0.5s;
        }
        table img:hover {
            transition: 0.5s;
            transform: scale(2.5);
        }
        th, td {
            min-width: 120px;
            text-align: center;
        }
        @media screen and (max-width: 1000px) {
            form, button {
                font-size: 0.8rem;
            }
        }
        label {
            color: black;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include 'sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include 'topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">


                        <div class="col mb-4">
                            


                            <!-- Data -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#card-p" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="card-p">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Pesanan</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="card-p">
                                    <div class="card-body">
                                        <div class="my-3">
                                            <form action="" method="post">
                                                <center>
                                                <input type="text" name="keyword" style="width: 60%;" autofocus placeholder="Ketik Keyword Pencarian..." autocomplete="off">
                                                <button class="btn text-primary" type="submit" name="cari"><i class="fab fa-searchengin"></i></button>
                                                </center> 
                                            </form>
                                        </div>
                                        <div class="table-responsive" style="max-height: 800px;">
                                        <table class="table table-striped" >
                                          <thead>
                                            <tr>
                                              <th>Client</th>
                                              <th>Kode Pesanan</th>
                                              <th>Produk</th>
                                              <th>Harga</th>
                                              <th>Jumlah</th>
                                              <th>Total Harga</th>
                                              <th>Tanggal Pesan</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                    <?php $i=1; ?>
                                    <?php foreach ($pesanan as $data) : ?>
                                            <tr>
                                              <td><a href="https://api.whatsapp.com/send?phone=62<?= $data['nohp']; ?>">62<?= $data['nohp']; ?></a> - <?= $data['nama_pemesan']; ?>
                                              </td>
                                              <td><?= $data['kode_unik']; ?></td>
                                              <td><?= $data['nama_produk']; ?></td>
                                              <td>Rp<?= number_format($data['harga'],0,',','.'); ?></td>
                                              <td><?= $data['jumlah']; ?></td>
                                              <?php $total = $data['jumlah'] * $data['harga']; ?>
                                              <td>Rp<?= number_format($total,0,',','.'); ?></td>
                                              <td><?= date("d F Y",strtotime($data["tanggal"])); ?></td>
                                            </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                          </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include 'footer.php' ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>