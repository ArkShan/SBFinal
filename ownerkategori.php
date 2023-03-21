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
        <title>SJM - Owner_List Kategori</title>
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
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="ownermasuk.php">Barang Masuk</a>
                                    <a class="nav-link" href="ownerkeluar.php">Barang Keluar</a>
                                    <a class="nav-link" href="ownertables.php">List Barang</a>
                                    <a class="nav-link" href="owneruser.php">List User</a>
                                    <a class="nav-link" href="ownertoko.php">List Toko</a>
                                    <a class="nav-link" href="ownerkategori.php">List Kategori</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Owner
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
                                                <th>Kategori</th>
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
                                        
                                        $ambilsemuadatastock = mysqli_query($koneksi,"SELECT * FROM  tb_kategori");
                                        
                                        $i=1;
                                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                            $idkat    = $data['id_kat'];
                                            $kategori = $data['kategori'];
                                        ?>
                                        <tr>
                                            <td><?=$i++?></td>
                                            <td><?=$kategori;?></td>
                                          
                                            <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idkat;?>">
                                            Ubah
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idkat;?>">
                                            Hapus
                                            </td>
                                        </tr>
                                        <!-- END Selesai Field Table -->
                                        <!-- Aksi CRUD -->
                                        <!-- Modal Kategori -->
                                        <!-- The  Edit Modal -->
                                        <div class="modal fade" id="edit<?=$idkat;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Kategori</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <!-- Content 1 -->
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="kategori" type="text" placeholder="Kategori" value="<?=$kategori;?>" required/>
                                                                <input type="hidden" name="id_kat" value="<?=$idkat;?>">
                                                                <button type="submit" class="btn btn-primary" name="updatekategori">Submit</button>
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
                                        <!-- Modal Kategori -->
                                        <!-- The  delete Modal -->
                                        <div class="modal fade" id="delete<?=$idkat;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Kategori ?</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <!-- Content 1 -->
                                                    <form method="POST">
                                                        <div class="modal-body mb-2">
                                                            Apakah anda yakin ingin menghapus Toko <?=$kategori;?> ?
                                                            <input type="hidden" name="id_kat"   value="<?=$idkat;?>">
                                                            <input type="hidden" name="kategori" value="<?=$kategori;?>">
                                                            <br>
                                                            <br>
                                                            <button type="submit" class="btn btn-danger" name="hapuskategori" >Hapus</button>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
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
                    <h4 class="modal-title"> Tambah Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <form method="POST" >
                    <div class="modal-body">
                    <input  type="text" name="kategori" class="form-control mb-2  " placeholder="Kategori"   required  />

                    <!-- <input  type="text"   name="harga"          class="form-control mb-2  "   placeholder="Hargabarang" required  /> -->
                    <button type="submit" name="tambahkategori"    class="btn btn-primary" >Submit</button>
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
