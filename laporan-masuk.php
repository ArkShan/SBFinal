<?php
     include 'function.php';
     include 'cek.php';

     $idmas=$_GET['id_mas'];
     $sSQL=mysqli_query($koneksi, "SELECT * FROM masuk m, tb_pabrik p WHERE m.id_mas = '$idmas' AND m.id_p = p.id_p limit 1");
     $i=1;
     if ($sSQL) {
        // Process the fetched data
        while ($data = mysqli_fetch_array($sSQL)) {
            // $idp        = $data['id_pesanan'];
            $nomas        = $data['no_masuk'];;
            $namap    = $data['nama_p'];
            // Your code to handle the fetched data goes here
        }
    } else {
        die("Query failed: " . mysqli_error($koneksi));
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SJM - Daftar Orderan</title>
        <link href="./css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark"> 
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <a class="navbar-brand" href="home.php">Sinar Jaya Motor</a>
            <!-- Navbar Search-->
            <!-- <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form> -->
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <!-- <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div> -->
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <?php require 'nav.php'; ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>    
                        <div class="card mb-4">
                            <div class="card-header">                            
                                <a href="masuk-revisi.php" class="btn btn-danger mt-3"><i class="fa-solid fa-arrow-left">Kembali</i></a>
                                <h2 class="mt-4">Nomor Masuk : <?= $nomas ?></h2>
                                <h2 class="mt-4">Nama Pabrik : <?= $namap ?></h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <?php if($_SESSION['role'] == "Gudang"){?>
                                                    <!-- Button to Open the Modal -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                                    Tambah Item
                                                    </button>
                                                    <br>
                                                    <!-- end Button to Open the Modal  -->
                                                    <!-- <i class="fas fa-table mr-1"></i> -->
                                                <?php }; ?>
                                            </tr>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <!-- <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </tfoot> -->
                                        <!-- Mulai Field Table -->
                                        <tbody>
                                            <?php
                                               $ambilsemuadatastock = mysqli_query($koneksi, "SELECT * FROM masuk m, detail_m d, tb_barang b where m.id_mas = d.id_ma and b.id_b=d.id_b and m.id_mas='$idmas'");

                                               if (!$ambilsemuadatastock) {
                                                   // Query execution failed, handle the error here
                                                   echo "Error executing the query: " . mysqli_error($koneksi);
                                                   exit; // Exit the script if the query failed
                                               }
                                               
                                               $i = 1;
                                               while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                                                   $ido        = $data['id_dm'];
                                                   $idma       = $data['id_ma'];
                                                   $kodeb      = $data['kode_b']; 
                                                   $namabarang = $data['nama_b'];
                                                   $Harga      = $data['harga'];
                                                   $hargap     = $data['harga_p'];
                                                   $qtym       = $data['qtym'];
                                               
                                            ?>
                                            <tr>
                                                <td><?=$i++?></td>
                                                <td><?=$kodeb;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$qtym;?></td>
                                            </tr>
                                            <!-- END Selesai Field Table -->                                                                 
                                        <?php }; ?>
                                    </tbody>
                                    <?php if($_SESSION['role'] != "Gudang"){?>
                                    
                                    <!-- <?php echo "<a href='lap_or-revisi.php?id_det=$ido'>" ;?> <button target="_blank" type="button" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Print</button></a>- -->
                                    <a href="lapmas.php?id_ma=<?=$idma?>" target="_blank" id="exportmasuk" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Print</a>
                                <?php }; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
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
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
<!-- Modal Tambah Barang -->
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Tambah Barang Masuk</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <form method="POST" >
            <div class="modal-body">
                <div class="form-group">
                    <select name="barangnya" class="form-control mb-2">
                        <?php
                            $ambilsemuadatanya = mysqli_query($koneksi,"SELECT * FROM tb_barang");
                            while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                                $namab = $fetcharray['nama_b'];
                                $idb   = $fetcharray['id_b'];
                                $kodeb   = $fetcharray['kode_b'];
                                $tipe   = $fetcharray['tipe_mobil'];
                        ?>
                            <option value="<?=$idb;?>"><?=$kodeb;?>  -  <?=$namab;?>  -  <?=$tipe;?></option>  
                        <?php };?>
                    </select>
                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="qtym" type="number" placeholder="Qty" value="" required/>
                    <input type="hidden" name="id_mas" value="<?= $idmas; ?>">
                    <!-- <input type="hidden" name="totalh" value="<?= $totalh; ?>"> -->
                    <button type="submit" name="barangmasuk1"    class="btn btn-primary" >Submit</button>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
<!-- Selesai modal tambah barang -->
</html>                