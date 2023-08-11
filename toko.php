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
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama Toko</th>
                                                <th class="text-center">Nomor Telepon</th>
                                                <th class="text-center">Alamat</th>
                                                <th class="text-center">Wilayah</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
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
                                        
                                        $ambilsemuadatastock = mysqli_query($koneksi,"SELECT * FROM tb_toko");
                                        
                                        $i=1;
                                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                            $idt     = $data['id_toko'];
                                            $namat   = $data['nama_toko'];
                                            $notelp  = $data['no_telp'];
                                            $alamat  = $data['alamat'];
                                            $wilayah = $data['wilayah'];
                                            $stat    = $data['stat_to'];
                                        ?>
                                        <tr>
                                            <td class="text-center"><?=$i++?></td>
                                            <td class="text-center"><?=$namat;?></td>
                                            <td class="text-center"><?=$notelp;?></td>
                                            <td class="text-center"><?=$alamat;?></td>
                                            <td class="text-center"><?=$wilayah;?></td>
                                            <td class="text-center">
                                                <?php 
                                                    if($stat ==0){
                                                        echo "Active";
                                                    }else if($stat == 1){
                                                        echo "Inactive";
                                                    }
                                                ?>  
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idt;?>">
                                                Ubah
                                                </button>
                                                <?php if($stat == 0){?>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#inactive<?=$idt;?>"> Inactive</button>
                                                <?php }else if($stat == 1){?>
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#active<?=$idt;?>"> Active</button>
                                                <?php };?>
                                                <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idt;?>">
                                                Hapus
                                                </button> -->
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
                                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="no_telp"    type="text"     placeholder="No. Telepon"      value="<?=$notelp;?>"/>
                                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="alamat"         type="text"   placeholder="Alamat"  value="<?=$alamat;?>"required/>
                                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="wilayah"         type="text"   placeholder="Wilayah"  value="<?=$wilayah;?>"required/>
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
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="inactive<?=$idt;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Status Toko</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <!-- Content 1 -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    Apakah anda yakin ingin mengubah status toko ini menjadi Inactive ?
                                                                    Toko <?=$namat;?>
                                                                    <input type="hidden" name="id_toko" value="<?=$idt;?>">
                                                                    <br>
                                                                    <button type="submit" class="btn btn-primary" name="tokoinactive" >Submit</button>
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
                                            <div class="modal fade" id="active<?=$idt;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Status Toko</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <!-- Content 1 -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    Apakah anda yakin ingin mengubah status toko ini menjadi Active ?
                                                                    Toko <?=$namat;?>
                                                                    <input type="hidden" name="id_toko" value="<?=$idt;?>">
                                                                    <br>
                                                                    <button type="submit" class="btn btn-primary" name="tokoactive" >Submit</button>
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
                                        <?php };?>
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
                    <input  type="text" name="no_telp"   class="form-control mb-2" placeholder="No. Telepon" required  />
                    <input  type="text" name="alamat"    class="form-control mb-2" placeholder="Alamat"      required  />
                    <input  type="text" name="wilayah"   class="form-control mb-2" placeholder="Wilayah"     required  />
                    <button type="submit" name="tambahtoko" class="btn btn-primary">Submit</button>
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
