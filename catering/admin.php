<?php 

session_start();
require 'functions.php';

if (isset($_SESSION['admin'])) {
    header("Location: xxx");
    exit;
}
if (isset($_SESSION['pegawai'])) {
    header("Location: admin");
    exit;
}

 if (isset($_POST["login"])) {
  
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);

  $super_user = query("SELECT * FROM super_user WHERE username = '$username'");
  foreach ($super_user as $a) {}

  ini_set("display_errors", 0);
  
if ($a["level"] == 'Admin') {

    $result = mysqli_query($conn, "SELECT * FROM super_user WHERE username = '$username'");


  if (mysqli_num_rows($result) === 1 ) {
    

    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {

                $_SESSION["login"] = true;
                $_SESSION["zzz21"] = true;
                $_SESSION["username"] = $username;

                header("Location: zxz");
                exit;
    }

  } 

}

$error = true;
  
}

?>
<!doctype html>
<html lang="en">
  <head>
    <?php include 'link.php'; ?>
  </head>
  <body>
    
    
    <div class="container" style="margin-top: 100px;">
        <center>
            <h4>Login</h4>
        </center>
        <br>
      <?php if (isset($error)) : ?>
        <center>
            <p style="color: #E30A0A;"><b>Username / Password Salah!</b> <i class="fas fa-times-circle"></i></p>
        </center>
        <?php endif; ?>
        <article class="card p-5">
            <form action="" method="post">
                <div class="mb-3">
                     <label for="username">Username</label>
                     <input class="form-control" type="text" id="username" name="username" placeholder="Masukkan Username" required>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password" placeholder="Masukkan Password" required>
                </div>
                <button type="submit" name="login" class="btn btn-info text-white" style="width: 100%;">Login</button>
            </form>
        </article>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
  </body>
</html>