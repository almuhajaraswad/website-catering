<?php 
session_start();

if (!isset($_SESSION['zzz21'])) {
   echo "<script>
         window.location.replace('../login.php');
       </script>";
  exit;
}

require 'functions.php';

function add_produk($data) {
    global $conn;

    // htmlspecialchars berfungsi untuk tidak menjalankan script
    $gambar1 = upload_foto();
    $judul = htmlspecialchars($data["judul"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);
    

        // tambahkan ke database
        // NULL digunakan karena jika dikosongkan maka akan terjadi error di database yang sudah online
        // sedangkan jika masih di localhost, bisa memakai ''
    mysqli_query($conn, "INSERT INTO produk VALUES(NULL, '$gambar1', '$judul', '$deskripsi', '$harga',  '$stok')");
    return mysqli_affected_rows($conn);
}


if (isset($_POST["register"])) {
  
  if (add_produk($_POST) > 0 ) {
     echo "<script>
        alert('Data Berhasil Ditambahkan!');
        window.location.href='produk.php';
      </script>";
  } else {
    echo mysqli_error($conn);
  }

} 

function cari($keyword) {
    $query = "SELECT * FROM produk
                WHERE
              judul LIKE '%$keyword%' OR
              deskripsi LIKE '%$keyword%'
            ";
    return query($query);
}

$produk = mysqli_query($conn, 'SELECT * FROM produk ORDER BY id DESC');

// jika tombol cari di tekan
if (isset($_POST["cari"])) {
    $produk = cari($_POST["keyword"]);
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
                            <!-- btn show -->
                            <a id="btn-show" class="btn btn-info mb-4 text-white"><i class="fas fa-plus"></i> Tambah Data</a>

                            <span id="form">

                            <span><a id="btn-hide" class="btn btn-danger mb-4 text-white"><i class="fas fa-minus-circle"></i> Tutup Form</a></span>
                            <!-- form -->
                            <div class="card shadow mb-4 p-3">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                 <label for="">Gambar</label>
                                                 <input type="file" id="foto" name="foto" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="judul">Nama Produk</label>
                                        <input type="text" id="judul" name="judul" placeholder="Nama Produk" required>
                                    </div>
                                    <div class="mb-3">
                                         <label for="deskripsi">Deskripsi</label>
                                         <textarea name="deskripsi" id="deskripsi" cols="20" rows="5" placeholder="Deskripsi" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga">Harga</label>
                                        <input type="number" id="harga" name="harga" placeholder="Harga" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stok">Stok</label>
                                        <input type="number" id="stok" name="stok" placeholder="Stok" required>
                                    </div>
                                    <button type="submit" name="register" class="btn btn-info text-white" style="width: 100%;">Tambah</button>
                                </form>
                              </div>
                            </span>


                            <!-- Data -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#card-p" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="card-p">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
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
                                              <th>#</th>
                                              <th>Gambar</th>
                                              <th>Nama Produk</th>
                                              <th>Stok</th>
                                              <th>Deskripsi</th>
                                              <th>Harga</th>
                                              <th colspan="2">Aksi</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                    <?php $i=1; ?>
                                    <?php foreach ($produk as $data) : ?>
                                            <tr>
                                              <th><?= $i; ?></th>
                                              <td><a href="../foto/<?= $data['gambar1']; ?>"><?= $data['gambar1']; ?></a></td>
                                              <td><?= $data['judul']; ?></td>
                                              <td><?= $data['stok']; ?></td>
                                              <td><?= $data['deskripsi']; ?></td>
                                              <td>Rp<?= number_format($data['harga'],2,',','.'); ?></td>
                                              <td>
                                                  <a href="edit-produk.php?id=<?= $data['id']; ?>"><i class="fas fa-edit text-warning"></i></a>
                                              </td>
                                              <td>
                                                  <a href="hapus-produk.php?id=<?= $data['id']; ?>"><i class="fas fa-trash text-danger"></i></a>
                                              </td>
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