<?php 
session_start();

if (!isset($_SESSION['zzz21'])) {
   echo "<script>
         window.location.replace('../login.php');
       </script>";
  exit;
}

require 'functions.php';


$id = $_GET["id"];
$produk = query("SELECT * FROM produk WHERE id = $id")[0];

function edit($data) {
    global $conn;
     
    $id = $data["id"];
    $judul = $data["judul"];
    $deskripsi = $data["deskripsi"];
    $harga = $data["harga"];
    $stok = $data["stok"];

    $query = "UPDATE produk SET 
                judul = '$judul',
                deskripsi = '$deskripsi',
                harga = '$harga',
                stok = '$stok'
              WHERE id = $id
            ";
            
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

if (isset($_POST["edit"])) {

  if (edit($_POST) > 0) {
     echo "<script>
        alert('Data Berhasil Di-Edit!');
        window.location.href='produk.php';
      </script>";
  } else {
    echo mysqli_error($conn);
  }

} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'link.php'; ?>
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
                            <h3>Edit Data Produk</h3>
                            <!-- form -->
                            <div class="card shadow mb-4 p-3">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" id="id" name="id" value="<?= $produk['id']; ?>">
                                    <div class="mb-3">
                                        <a href="ubah-gambar.php?id=<?= $produk['id']; ?>" class="btn btn-info btn-sm">Ubah Gambar</a>
                                    </div>
                                    <div class="mb-3">
                                         <label for="">Nama Event</label>
                                         <input type="text" id="judul" name="judul" required value="<?= $produk['judul']; ?>">
                                    </div>
                                    <div class="mb-3">
                                         <label for="">Deskripsi</label>
                                         <input type="text" id="deskripsi" name="deskripsi" required value="<?= $produk['deskripsi']; ?>">
                                    </div>
                                    <div class="mb-3">
                                         <label for="">Stok Tiket</label>
                                         <input type="text" id="stok" name="stok" required value="<?= $produk['stok']; ?>">
                                    </div>
                                    <div class="mb-3">
                                         <label for="">Harga</label>
                                         <input type="text" id="harga" name="harga" required value="<?= $produk['harga']; ?>">
                                    </div>
                                    <button type="submit" name="edit" class="btn btn-info text-white" style="width: 100%;">Edit</button>
                                    <br><br>
                                    <a href="produk.php" class="btn btn-danger text-white" style="width: 100%;">Batal</a>
                                </form>
                              </div>
                                
                       
                        </div>

                        <!-- End Row -->
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