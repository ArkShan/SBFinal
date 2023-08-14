<?php
     include 'function.php';
     include 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SJM - List Barang</title>
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
                        <h1 class="mt-4">Daftar List Barang Sinar Jaya Motor</h1>
                            
                        <div class="card mb-4">
                            <div class="card-header">
                                <?php if($_SESSION['role'] != "Sales"){?>
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                 Tambah Barang
                                </button>
                                <!-- End Notifikasi warning -->
                                <a href="list_b.php" target="_blank" id="exportmasuk" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Export data</a>
                                <br>
                                <?php }; ?>
                                <!-- end Button to Open the Modal  -->
                                <i class="fas fa-table mr-1"></i>
                                List Barang Sinar Jaya Motor
                            </div>
                            <div class="card-body">
                                <!-- Notifikasi Danger-->
                                <?php if($_SESSION['role'] != "Sales"){ ?>
                                <?php 
                                    $ambilsemuadatastock = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE qty <=1000");
                                    while($fetch=mysqli_fetch_array($ambilsemuadatastock)){
                                        $namabar = $fetch['nama_b'];
                                        $kodebar = $fetch['kode_b'];
                                        $qty = $fetch['qty'];
                                ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Perhatian !</strong> Stok barang <?=$kodebar;?> - <?=$namabar;?> tersisa <?=$qty;?>
                                </div>
                                <?php };?>
                                <!-- End Notifikasi Danger -->
                                <!-- Notifikasi Warning-->
                                <?php 
                                    $ambilsemuadatastock = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE qty >1000 AND qty <10000");
                                    while($fetch=mysqli_fetch_array($ambilsemuadatastock)){
                                        $namabar = $fetch['nama_b'];
                                        $kodebar = $fetch['kode_b'];
                                        $qty = $fetch['qty'];
                                ?>
                                <div class="alert alert-warning alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Perhatian !</strong> Stok barang <?=$kodebar;?> - <?=$namabar;?> tersisa <?=$qty;?>
                                </div>
                                <?php };?>
                                <?php };?>
                                <!-- End Notifikasi warning -->
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <!-- <th>Id_MasukBarang</th> -->
                                                <th class="text-center">ID Barang</th>
                                                <th class="text-center">Kode barang</th>
                                                <th class="text-center">Nama Barang</th>
                                                <th class="text-center">Tipe Mobil</th>
                                                <th class="text-center">Kategori</th>
                                                <th class="text-center">Harga</th>
                                                <th class="text-center">Pcs/Dus</th>
                                                <th class="text-center">Harga Promo</th>
                                                <th class="text-center">Qty</th>
                                                <?php if($_SESSION['role'] != "Sales" && $_SESSION['role'] != "Gudang"){?>
                                                <th>Aksi</th>
                                                <?php }; ?>
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
                                                $ambilsemuadatastock = mysqli_query($koneksi,"SELECT * FROM  tb_barang");
                                                $i=1;
                                                while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                    $idb        = $data['id_b'];
                                                    $kodebarang = $data['kode_b'];
                                                    $namabarang = $data['nama_b'];
                                                    $Tipe_Mobil = $data['tipe_mobil'];
                                                    $Kategori   = $data['kategori'];
                                                    $Harga      = $data['harga'];
                                                    $qtyd       = $data['pcs_dus'];
                                                    $promo      = $data['harga_p'];
                                                    $qty        = $data['qty'];
                                                    if ($qty == '0'){
                                                        mysqli_query($koneksi,"UPDATE tb_barang SET stat =1  WHERE  id_b='$idb'");
                                                    }else if($qty > '0'){
                                                        mysqli_query($koneksi,"UPDATE tb_barang SET stat =0  WHERE  id_b='$idb'");
                                                    }
                                                    $stat       = $data['stat'];
                                            ?>
                                            <tr>
                                                <td class="text-center"><?=$i++?></td>
                                                <td class="text-center"><?=$kodebarang;?></td>
                                                <td class="text-center"><?=$namabarang;?></td>
                                                <td class="text-center"><?=$Tipe_Mobil;?></td>
                                                <td class="text-center"><?=$Kategori;?></td>
                                                <td class="text-center">Rp <?= number_format($Harga);?></td>
                                                <td class="text-center"><?= number_format($qtyd);?></td>
                                                <?php if ($promo == 0) { ?>
                                                    <td class="text-center"><?= $promo;?></td>  
                                                <?php } else if ($promo != 0) { ?>
                                                    <td class="text-center">Rp <?= number_format($promo);?></td>
                                                <?php }?>
                                                <?php if($_SESSION['role'] == "Sales"){?>
                                                <td class="text-center">
                                                    <?php 
                                                        if($stat ==0){
                                                            echo "Tersedia";
                                                        }else if($stat == 1){
                                                            echo "Kosong";
                                                        }
                                                    ?>
                                                </td>
                                                <?php }else if($_SESSION['role'] != "Sales"){?>
                                                <td class="text-center"><?= $qty;?></td>
                                                <?php if($_SESSION['role'] != "Gudang"){?>
                                                <td class="text-center">
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idb;?>"> Ubah </button>
                                                <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idb;?>"> Hapus </button>-->
                                                </td>
                                                <?php }}; ?>
                                            </tr>
                                            <!-- END Selesai Field Table -->
                                            <!-- Aksi CRUD -->
                                            <!-- Modal Tambah Barang -->
                                            <!-- The Modal -->
                                            <div class="modal fade" id="myModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Tambah Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form method="POST" >
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="kode_b"      type="text"     placeholder="Kode Barang"   value="" required/>
                                                                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="nama_b"      type="text"     placeholder="Nama Barang"   value="" required/>
                                                                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="tipe_mobil"  type="text"     placeholder="Tipe Mobil"    value="" required/>
                                                                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="kategori"    type="text"     placeholder="Kategori"      value="" required/>
                                                                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="harga"       type="text"     placeholder="Harga"         value="" required/>
                                                                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="pcs_dus"     type="number"   placeholder="Pcs/Dus"       value="" required/>
                                                                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="harga_p"     type="text"     placeholder="Harga Promo"   value="" required/>
                                                                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="qty"         type="number"   placeholder="Qty"   min="1" value="" required/>
                                                                    <button type="submit" name="tambahbarang"    class="btn btn-primary" >Submit</button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Selesai modal tambah barang -->
                                            <!-- Modal stock Gudang -->
                                            <!-- The  Edit Modal -->
                                            <div class="modal fade" id="edit<?=$idb;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <!-- Content 1 -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group">                                                                  
                                                                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="kode_b"     type="text"   placeholder="Kode Barang" value="<?=$kodebarang;?>" required/>
                                                                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="nama_b"     type="text"   placeholder="Nama_Barang" value="<?=$namabarang;?>" required/>
                                                                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="tipe_mobil" type="text"   placeholder="Tipe_Mobil"  value="<?=$Tipe_Mobil;?>" required/>
                                                                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="kategori"   type="text"   placeholder="Kategori"    value="<?=$Kategori;?>" required/>
                                                                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="harga"      type="text"   placeholder="Harga"       value="<?=$Harga;?>" required/>
                                                                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="pcs_dus"    type="number" placeholder="Pcs/Dus"     value="<?=$qtyd;?>" required/>
                                                                    <input class="form-control py-4 mb-2" id="inputEmailAddress" name="harga_p"    type="text"   placeholder="Harga_Promo" value="<?=$promo;?>" required/>
                                                                    <input type="hidden" name="id_b" value="<?=$idb;?>">
                                                                    <button type="submit" class="btn btn-primary" name="updatebarang" >Submit</button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Modal stock Gudang -->
                                                <!-- The  delete Modal -->
                                                <div class="modal fade" id="delete<?=$idb;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Hapus Barang ?</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <!-- Content 1 -->
                                                            <form method="POST">
                                                                <div class="modal-body mb-2">
                                                                    Apakah anda yakin ingin menghapus Barang <?=$namabarang;?> Jenis <?=$Kategori;?> ?
                                                                    <input type="hidden" name="id_b"    value="<?=$idb;?>">
                                                                    <input type="hidden" name="qty"         value="<?=$qty;?>">
                                                                    <br>
                                                                    <br>
                                                                    <button type="submit" class="btn btn-danger" name="hapusbarang" >Hapus</button>
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                                </div>
                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End aksi Crud -->
                                            <?php }; ?>
                                        </tbody>
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
        
</html>
