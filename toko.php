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
        <title>SJM - Owner_List Toko</title>
        <link href="./css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark"> 
            <a class="navbar-brand" href="home.php">Sinar Jaya Motor</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
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
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="ownerhome.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Home
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Owner
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="b_masuk.php">Barang Masuk</a>
                                    <a class="nav-link" href="b_keluar.php">Barang Keluar</a>
                                    <a class="nav-link" href="tables.php">List Barang</a>
                                    <a class="nav-link" href="user.php">List User</a>
                                    <a class="nav-link" href="toko.php">List Toko</a>
                                    <a class="nav-link" href="order.php">List Order</a>
                                    <a class="nav-link" href="pabrik.php">List Pabrik</a>
                                    <a class="nav-link" href="returp.php">Retur Pabrik</a>
                                    <a class="nav-link" href="returo.php">Retur Order</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="High">
                            Logged in as: Owner
                        </div>
                            <!-- Start Bootstrap -->
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Daftar Toko</h1>
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol> -->
                           
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#myModal">Tambah Toko</button>
                                <br>
                                <!-- end Button to Open the Modal  -->
                                <i class="fas fa-table mr-1"></i>
                                Data Toko Pelanggan Sinar Jaya Motor
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Toko</th>
                                                <th>Customer Service</th>
                                                <th>Nomor Telepon</th>
                                                <th>Alamat</th>
                                                <th>Wilayah</th>
                                                <th>Aksi</th>
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
                                        // Fungsi Filter tanggal
                                        
                                        $ambilsemuadatastock = mysqli_query($koneksi,"SELECT * FROM tb_wilayah w, tb_toko t  WHERE w.id_w = t.id_w");
                                        
                                        $i=1;
                                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                            $idw   = $data['id_w'];
                                            $idt   = $data['id_toko'];
                                            $namat = $data['nama_toko'];
                                            $cst = $data['cs_toko'];
                                            $notelp = $data['no_telp'];
                                            $alamat  = $data['alamat'];
                                            $wilayah  = $data['wilayah'];
                                        ?>
                                        <tr>
                                            <td><?=$i++?></td>
                                            <td><?=$namat;?></td>
                                            <td><?=$cst;?></td> 
                                            <td><?=$notelp;?></td>
                                            <td><?=$alamat;?></td>
                                            <td><?=$wilayah;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idt;?>">
                                                Ubah
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idt;?>">
                                                Hapus
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- END Selesai Field Table -->
                                        <!-- Aksi CRUD -->
                                        <!-- Modal stock Gudang -->
                                        <!-- The  Edit Modal -->
                                        <div class="modal fade" id="edit<?=$idt;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Edit Toko</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <!-- Content 1 -->
                                                <form method="post">
                                                <div class="modal-body">
                                                <div class="form-group">
                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="nama_toko"  type="text"     placeholder="Nama Toko"   value="<?=$namat;?>" required/>
                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="cs_toko" type="text"     placeholder="CS Toko"  value="<?=$cst;?>" required/>
                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="no_telp"    type="text"     placeholder="No. Telepon"      value="<?=$notelp;?>"/>
                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="alamat"         type="text"   placeholder="Alamat"  value="<?=$alamat;?>"required/>
                                                <select name="wilayahnya" class="form-control mb-2">
                                                    <?php
                                                        $ambilsemuadata = mysqli_query($koneksi,"SELECT * FROM tb_wilayah");
                                                        while($fetcharray = mysqli_fetch_array($ambilsemuadata)){
                                                            $wilayah = $fetcharray['wilayah'];
                                                            $idw = $fetcharray['id_w'];
                                                    ?>
                                                    <option value="<?=$idw;?>"><?=$wilayah;?></option> 
                                                    <?php }; ?>
                                                </select>
                                                <input type="hidden" name="id_toko" value="<?=$idt;?>">
                                                <button type="submit" class="btn btn-primary" name="updatetoko">Submit</button>
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
                                                <!-- Modal stock Gudang -->
                                                <!-- The  delete Modal -->
                                                <div class="modal fade" id="delete<?=$idt;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Hapus Toko ?</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <!-- Content 1 -->
                                                <form method="POST">
                                                <div class="modal-body mb-2">
                                                Apakah anda yakin ingin menghapus Toko <?=$namat;?> ?
                                                <input type="hidden" name="id_toko"    value="<?=$idt;?>">
                                                <input type="hidden" name="nama_toko" value="<?=$namat;?>">
                                                <input type="hidden" name="wilayah"     value="<?=$wilayah;?>">
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-danger" name="hapustoko" >Hapus</button>
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                </div>
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
                                        <?php
                                        };
                                        ?>
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
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
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
    <!-- Modal Barang Masuk -->
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"> Tambah Toko</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <form method="POST" >
                    <div class="modal-body">
                    <input  type="text" name="nama_toko" class="form-control mb-2" placeholder="Nama Toko"   required  />
                    <input  type="text" name="cs_toko"   class="form-control mb-2" placeholder="CS Toko"     required  />
                    <input  type="text" name="no_telp"   class="form-control mb-2" placeholder="No. Telepon" required  />
                    <input  type="text" name="alamat"    class="form-control mb-2" placeholder="Alamat"      required  />
                    <select name="wilayahnya" class="form-control mb-2">
                        <?php
                            $ambilsemuadata = mysqli_query($koneksi,"SELECT * FROM tb_wilayah");
                            while($fetcharray = mysqli_fetch_array($ambilsemuadata)){
                                $wilayah = $fetcharray['wilayah'];
                                $idw = $fetcharray['id_w'];
                        ?>
                        <option value="<?=$idw;?>"><?=$wilayah;?></option> 
                        <?php }; ?>
                    </select>
                    <button type="submit" name="tambahtoko" class="btn btn-primary" >Submit</button>
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
            <!-- Selesai modal barang masuk -->
</html>
