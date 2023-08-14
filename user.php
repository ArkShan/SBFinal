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
        <title>SJM - Owner_List User</title>
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
                        <h1 class="mt-4">Daftar List User Sinar Jaya Motor</h1>
                            
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-success"  onclick="window.location.href='register.php'">Tambah User</button>
                                <br>
                                <!-- end Button to Open the Modal  -->
                                <i class="fas fa-table me-1"></i>
                                Data User Sinar Jaya Motor
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Password</th>
                                                <th class="text-center">Role</th>
                                                <th class="text-center">Status Akun</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <!-- Mulai Field Table -->
                                        <tbody>
                                            <?php
                                                $ambilsemuadatastock = mysqli_query($koneksi,"SELECT * FROM  tb_register");
                                                $i=1;
                                                while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                    $id_u  = $data['id_user'];
                                                    $email = $data['email'];
                                                    $namad = $data['namadepan'];
                                                    $namab = $data['namabelakang'];
                                                    $pass  = $data['password'];
                                                    $role  = $data['role'];
                                                    $stat  = $data['status']
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?=$i++?></td>
                                                    <td class="text-center"><?=$email;?></td>
                                                    <td class="text-center"><?=$namad;?> <?=$namab;?></td>
                                                    <td class="text-center"><?=$pass;?></td>
                                                    <td class="text-center"><?=$role;?></td>
                                                    <td class="text-center">
                                                        <?php 
                                                            if($stat == 0){
                                                                echo "Active";
                                                            }else if($stat == 1){
                                                                echo "Inactive";
                                                            }
                                                        ?>  
                                                    </td>
                                                    <td class="text-center">
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$id_u;?>">
                                                    Ubah
                                                    </button>
                                                        <?php 
                                                        if($role != "Owner"){
                                                            if($stat == 0){?>
                                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#inactive<?=$id_u;?>"> Inactive</button>
                                                        <?php }else if($stat == 1){?>
                                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#active<?=$id_u;?>"> Active</button>;
                                                        <?php }}; ?> 
                                                    </td>
                                            </tr>
                                            <!-- END Selesai Field Table -->
                                            <!-- Aksi CRUD -->
                                            <!-- Modal stock Gudang -->
                                            <!-- The  Edit Modal -->
                                            <div class="modal fade" id="edit<?=$id_u;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit User</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <!-- Content 1 -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group">                                                                  
                                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="email"        type="text" placeholder="Nama Barang"   value="<?=$email;?>" required/>
                                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="namadepan"    type="text" placeholder="Nama Depan"    value="<?=$namad;?>" required/>
                                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="namabelakang" type="text" placeholder="Nama Belakang" value="<?=$namab;?>" required/>
                                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="password"     type="text" placeholder="Password"      value="<?=$pass;?>"  required/>
                                                                <input type="hidden" name="id_user" value="<?=$id_u;?>">
                                                                <button type="submit" class="btn btn-primary" name="updateuser" >Submit</button>
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
                                            <div class="modal fade" id="delete<?=$id_u;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus User ?</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <!-- Content 1 -->
                                                        <form method="POST">
                                                            <div class="modal-body mb-2">
                                                                Apakah anda yakin ingin menghapus user dengan nama <?=$namad;?> <?=$namab;?> dengan role <?=$role;?> ?
                                                                <input type="hidden" name="id_user" value="<?=$id_u;?>">
                                                                <input type="hidden" name="email"   value="<?=$email;?>">
                                                                <input type="hidden" name="role"    value="<?=$role;?>">
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="hapususer" >Hapus</button>
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="inactive<?=$id_u;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Status Akun Karyawan</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <!-- Content 1 -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    Apakah anda yakin ingin mengubah status akun ini menjadi Inactive ?
                                                                    Nama <?=$namad;?> <?=$namab;?>
                                                                    <input type="hidden" name="id_u" value="<?=$id_u;?>">
                                                                    <br>
                                                                    <button type="submit" class="btn btn-primary" name="akuninactive" >Submit</button>
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
                                            <div class="modal fade" id="active<?=$id_u;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Status Akun Karyawan</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <!-- Content 1 -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    Apakah anda yakin ingin mengubah status akun ini menjadi Active ?
                                                                    Nama <?=$namad;?> <?=$namab;?>
                                                                    <input type="hidden" name="id_u" value="<?=$id_u;?>">
                                                                    <br>
                                                                    <button type="submit" class="btn btn-primary" name="akunactive" >Submit</button>
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
