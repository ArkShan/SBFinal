<?php
// jika belom login
if(empty($_SESSION['isLoggedin'])){
header('location:logout.php');
}else{
    // header('location:login.php');
}
?>