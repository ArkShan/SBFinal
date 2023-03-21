<?php
// include ("function.php");
// // session_start();

// $_SESSION['isLoggedin']= '1';
// $email = $_POST['email'];
// $password = $_POST['password'];
// // $password2 = sha1($password);
//     die(mysqli_error($koneksi));

// $email = mysqli_real_escape_string($koneksi, $email);
// $password = mysqli_real_escape_string($koneksi, $password);

// if (empty($email) && empty($password)) {
// 	header('location:index.php?error=Email dan Password Kosong!');
// } else if (empty($email)) {
// 	header('location:indexx.php?error=Email Kosong!');
// } else if (empty($password)) {
// 	header('location:indexx.php?error=Password Kosong!');
// }

// $q = mysqli_query($koneksi, "SELECT * FROM tb_register where email='$email' and password='$password'");
// $row = mysqli_fetch_array ($q);

// if (mysqli_num_rows($q) == 1) {
//     $_SESSION['id'] = $row['id'];
// 	$_SESSION['email'] = $email;
//     $_SESSION['fullname'] = $row['fullname'];
//     $_SESSION['role']    = $row['role'];
    
//     if ($_SESSION['role'] == 'Owner'){
//         header('location:home.php');
//     } else if ($_SESSION['role'] == 'Sales'){
//         header('location:home.php');
//     } else if ($_SESSION['role'] == 'Gudang'){
//         header('location:home.php');
//     }

	
// } else {
// 	header('location:login.php?error=Anda Belum Terdaftar!');
// }
?>