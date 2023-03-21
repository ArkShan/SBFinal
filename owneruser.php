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
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="home.php">Sinar Jaya Motor</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form> -->
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!-- <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li> -->
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="home.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Owner
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="ownermasuk.php">Barang Masuk</a>
                                            <a class="nav-link" href="ownerkeluar.php">Barang Keluar</a>
                                            <a class="nav-link" href="ownertables.php">List Barang</a>
                                            <a class="nav-link" href="owneruser.php">List User</a>
                                            <a class="nav-link" href="ownertoko.php">List Toko</a>
                                            <a class="nav-link" href="ownerkategori.php">List Kategori</a>
                                        </nav>
                                    </div>
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
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Daftar User</h1>
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
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Email</th>
                                            <th>Nama</th>
                                            <th>Password</th>
                                            <th>Role</th>
                                            <th>Action</th>
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
                                    <tbody>
                                    <?php
                                        // Fungsi Filter tanggal
                                        
                                            $ambilsemuadatastock = mysqli_query($koneksi,"SELECT * FROM  tb_register");
                                        
                                        $i=1;
                                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                            $idu   = $data['id_user'];
                                            $email = $data['email'];
                                            $namad = $data['namadepan'];
                                            $namab = $data['namabelakang'];
                                            $pass  = $data['password'];
                                            $role  = $data['role'];
                                        ?>
                                        <tr>
                                            <td><?=$i++?></td>
                                            <td><?=$email;?></td>
                                            <td><?=$namad;?> <?=$namab;?></td>
                                            <td><?=$pass;?></td>
                                            <td><?=$role;?></td>
                                          
                                            <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idu;?>">
                                            Ubah
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idu;?>">
                                            Hapus
                                            </td>
                                        </tr>
                                        <!-- END Selesai Field Table -->
                                        <!-- Aksi CRUD -->
                                        <!-- Modal stock Gudang -->
                                        <!-- The  Edit Modal -->
                                        <div class="modal fade" id="edit<?=$idu;?>">
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
                                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="email"  type="text"     placeholder="Nama Barang"   value="<?=$email;?>" required/>
                                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="namadepan" type="text"     placeholder="Nama Depan"  value="<?=$namad;?>" required/>
                                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="namabelakang"    type="text"     placeholder="Nama Belakang"      value="<?=$namab;?>"/>
                                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="password"         type="text"   placeholder="Password"  value="<?=$pass;?>"required/>
                                                                <input type="hidden" name="id_user" value="<?=$idu;?>">
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
                                        <div class="modal fade" id="delete<?=$idu;?>">
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
                                                            <input type="hidden" name="id_user"  value="<?=$idu;?>">
                                                            <input type="hidden" name="email"    value="<?=$email;?>">
                                                            <input type="hidden" name="role"     value="<?=$role;?>">
                                                            <br>
                                                            <br>
                                                            <button type="submit" class="btn btn-danger" name="hapususer" >Hapus</button>
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
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
                </main>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
