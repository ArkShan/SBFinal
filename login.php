<?php 
include 'function.php';
if(empty($_SESSION['isLoggedin'])){

}else{
        header('location:home.php');
}
// Function Login multi user berdasarakan Lvl
if (isset($_POST['login'])){
    $email    = $_POST['email'];
    $password = $_POST['password'];
    // Cocokan dengan database, cari data
    $cekdatabase = mysqli_query($koneksi, "SELECT * FROM tb_register where email='$email' and password='$password'");
    // Hitung jumlah data
    // die (mysqli_error ($koneksi));
    $hitung = mysqli_num_rows($cekdatabase);
    if(empty($email)){
        echo "<b>Email anda kosong</b>";
    } else if(empty($password)){
        echo "<b>Password anda kosong</b>";
    }else {
    if ($hitung > 0) {   
        // Kalau data ditemukan
        // $_SESSION['log']= 'TRUE';
        $ambilrole = mysqli_fetch_array($cekdatabase);
        session_start();
        $_SESSION['id_user'] = $ambilrole['id_user'];
        $role = $ambilrole['role'];
        if ($role == 'Owner') {
            // Kalau dia owner
            $_SESSION['isLoggedin']= '1';
            $_SESSION['log'] = 'Logged';
            $_SESSION['role'] = 'Owner';
            header('location: home.php'); //halaman utama
        } else if ($role == 'Admin') {
            // Kalau bukan owner
            $_SESSION['isLoggedin']= '1';
            $_SESSION['log'] = 'Logged';
            $_SESSION['role'] = 'Admin';
            header('location: home.php');
        }else if ($role == 'Sales') {
            // Kalau bukan owner
            $_SESSION['isLoggedin']= '1';
            $_SESSION['log'] = 'Logged';
            $_SESSION['role'] = 'Sales';
            header('location: home.php');
        } else if ($role == 'Gudang') {
            //Kalau bukan manager
            $_SESSION['isLoggedin']= '1';
            $_SESSION['log'] = 'Logged';
            $_SESSION['role'] = 'Gudang';
            header('location: home.php');
        } else {
            echo 'Data tidak ada';
        }
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
                                        <form method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputemail" name="email" type="text" placeholder="Email" />
                                                <label for="text">Email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <!-- <div class="form-floating mb-3">
                                                <input class="form-control" id="inputRole" name="role" type="text" placeholder="Role" />
                                                <label for="text">Role</label>
                                            </div> -->
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="text-center">
                                                <?php
                                                    $sSQL=mysqli_query($koneksi, "SELECT * FROM tb_register limit 1");
                                                    $ambilsemuadatastock = mysqli_query($koneksi,"SELECT * FROM  tb_register");
                                                    $i=1;
                                                    while($data=mysqli_fetch_array($sSQL)){
                                                        $idu        = $data['id_user'];
                                                        $namad      = $data['namadepan'];
                                                        $namab      = $data['namabelakang'];     
                                                ?>
                                                <?php echo "<a href='home.php?id_user=$idu'>" ;?><button class="btn btn-primary" name="login">Login</button>
                                                <?php }; ?>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- <div class="text-center">
                                    </div>
                                    <br>
                                    <div class="card-footer text-center py-3">
                                    </div> -->
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
