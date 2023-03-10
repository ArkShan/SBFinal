<?php 
include 'function.php';
include 'cek.php';

// Function Login multi user berdasarakan Lvl
if (isset($_POST['login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  // Cocokan dengan database, cari data
  $cekdatabase = mysqli_query($koneksi, "SELECT * FROM tb_register where email='$email' and password='$password'");
  // Hitung jumlah data
  $hitung = mysqli_num_rows($cekdatabase);
  if ($hitung > 0) {
      // Kalau data ditemukan
      // $_SESSION['log']= 'TRUE';
      $ambilrole = mysqli_fetch_array($cekdatabase);
      $role = $ambilrole['role'];
      if ($role == 'Owner') {
          // Kalau dia owner
          $_SESSION['log'] = 'Logged';
          $_SESSION['role'] = 'Owner';
          header('location: ownerhome.php'); //halaman utama
      } else if ($role == 'Sales') {
          // Kalau bukan owner
          $_SESSION['log'] = 'Logged';
          $_SESSION['role'] = 'Sales';
          header('location: saleshome.php');
      } else if ($role == 'Gudang') {
          //Kalau bukan manager
          $_SESSION['log'] = 'Logged';
          $_SESSION['role'] = 'Gudang';
          header('location: gudanghome.php');
      } else {
          echo 'Data tidak ada';
      }
  }
};
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SJM - Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="email" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="text-center">
                                                <button class="btn btn-primary" name="login">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <br>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
