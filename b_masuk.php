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
        <title>SJM - Gudang_Barang Masuk</title>
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
                        <h1 class="mt-4">List Barang Masuk Sinar Jaya Motor</h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <?php if($_SESSION['role'] == "Gudang"){?>
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                 Tambah Barang Masuk
                                </button>
                                <?php }; ?>
                                <!-- End Notifikasi warning -->
                                <a href="lap_masuk.php" target="_blank" id="exportmasuk" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Export Data</a>
                                <br>
                                <!-- end Button to Open the Modal  -->
                                <!-- <i class="fas fa-table mr-1"></i> -->
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
                                                        <select name="barang" class="form-control mb-2">
                                                            <?php
                                                            $ambilsemuadatanya = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE stat = 0");
                                                            while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                                                                $namab = $fetcharray['nama_b'];
                                                                $id_b   = $fetcharray['id_b'];
                                                                $kodeb = $fetcharray['kode_b'];
                                                            ?>
                                                            <option value="<?=$id_b;?>"><?=$kodeb;?> - <?=$namab;?></option> 
                                                            <?php };?>
                                                        </select>
                                                        <input  type="number" name="qtym" class="form-control mb-2" min="1" placeholder="Qty" required  />
                                                        <select name="pengirim" class="form-control mb-2">
                                                            <?php
                                                            $ambilsemuadatanya = mysqli_query($koneksi,"SELECT * FROM tb_pabrik WHERE stat_p = 0");
                                                            while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                                                                $namap = $fetcharray['nama_p'];
                                                                $idp   = $fetcharray['id_p'];
                                                            ?>
                                                            <option value="<?=$idp;?>"><?=$namap;?></option> 
                                                            <?php };?>
                                                        </select>
                                                        <button type="submit" name="barangmasuk"    class="btn btn-primary" >Submit</button>
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
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori</th>
                                                <th>Tanggal</th>
                                                <th>Pengirim</th>
                                                <th>Qty</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                                <th>Qty Bermasalah</th>
                                                <?php if($_SESSION['role'] == "Gudang"){?>
                                                <th>Action</th>
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
                                                $ambilsemuadatastock = mysqli_query($koneksi,"SELECT * FROM tb_barang b, b_masuk m, tb_pabrik p WHERE b.id_b = m.id_b AND m.id_p = p.id_p ORDER BY m.id_bm ASC");
                                                $i=1;
                                                while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                    $idm        = $data['id_bm'];
                                                    $id_b       = $data['id_b'];
                                                    $kodebarang = $data['kode_b'];
                                                    $namabarang = $data['nama_b'];
                                                    $Kategori   = $data['kategori'];
                                                    $tanggal    = $data['tanggal'];
                                                    $pengirim   = $data['nama_p'];
                                                    $qtym       = $data['qtym'];
                                                    $keterangan = $data['keterangan'];
                                                    $stat       = $data['stat_bm'];
                                                    $qtymas     = $data['qtymas'];
                                            ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$kodebarang;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$Kategori;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$pengirim;?></td>
                                                <td><?=$qtym;?></td>
                                                <td>
                                                    <?php 
                                                        if($stat == 0){
                                                            echo "Masuk";
                                                        }else if($stat == 1){
                                                            echo "Selesai";
                                                        }else if($stat == 2){
                                                            echo "Bermasalah";
                                                        }
                                                    ?>  
                                                </td>
                                                <td><?=$keterangan;?></td>
                                                <td><?=$qtymas;?></td>
                                                <?php if($_SESSION['role'] == "Gudang"){?>
                                                <td>
                                                    <?php if($stat ==0){?>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#masalah<?=$idm;?>"> Bermasalah</button>
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#selesai<?=$idm;?>"> Selesai</button>
                                                        <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idm;?>"> Hapus -->
                                                    <?php };?>
                                                </td>
                                                <?php }; ?>
                                            </tr>
                                            <!-- END Selesai Field Table -->
                                            <!-- Aksi CRUD -->
                                            <!-- Modal Tambah Barang -->
                                            <!-- The Modal -->
                                            
                                            <!-- Selesai modal tambah barang -->
                                            <!-- Modal stock Gudang -->
                                            <?php }; ?>
                                        </tbody>
                                        <!-- The  delete Modal -->
                                        <div class="modal fade" id="delete<?=$idm;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Barang Masuk ?</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <!-- Content 1 -->
                                                    <form method="POST">
                                                        <div class="modal-body mb-2">
                                                            Apakah anda yakin ingin menghapus Barang <?=$namabarang;?> Jenis <?=$Kategori;?> ?
                                                            <input type="hidden" name="id_b"   value="<?=$id_b;?>">
                                                            <input type="hidden" name="qtym"   value="<?=$qtym;?>">
                                                            <input type="hidden" name="id_bm"  value="<?=$idm;?>">
                                                            <br>
                                                            <br>
                                                            <button type="submit" class="btn btn-danger" name="hapusbarangmasuk" >Hapus</button>
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="masalah<?=$idm;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Barang Masuk Bermasalah</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <!-- Content 1 -->
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <div class="modal-body mb-2">
                                                                Mengapa barang masuk ini bermasalah ?
                                                                <br>
                                                                Nama Barang : <?=$namabarang;?>
                                                                <br>
                                                                Pabrik      : <?=$pengirim;?>
                                                                <br>
                                                                Tanggal     : <?=$tanggal?> 
                                                                <br>
                                                                Jumlah      : <?=$qtym?>
                                                                <br>
                                                                <input type="form-control py-4 mb-2" name="keterangan" class="form-control mb-2" placeholder="Keterangan" required/>
                                                                <input class="text"  name="qtymas" type="number" placeholder="Qty yang bermasalah" min="1" value=""/>
                                                                <input type="hidden" name="id_bm" value="<?=$idm;?>">
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-primary" name="bmmasalah" >Submit</button>
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
                                        <div class="modal fade" id="selesai<?=$idm;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Barang Masuk Tidak Ada Masalah</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <!-- Content 1 -->
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <div class="modal-body mb-2">
                                                                Apakah anda yakin barang ini tidak bermasalah ?
                                                                <br>
                                                                Nama Barang : <?=$namabarang;?>
                                                                <br>
                                                                Pabrik      : <?=$pengirim;?>
                                                                <br>
                                                                Tanggal     : <?=$tanggal?> 
                                                                <br>
                                                                Jumlah      : <?=$qtym?>
                                                                <br>
                                                                <input type="hidden" name="id_bm" value="<?=$idm;?>">
                                                                <br>
                                                                <button type="submit" class="btn btn-primary" name="bmselesai" >Submit</button>
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
                                        <!-- End aksi Crud -->
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