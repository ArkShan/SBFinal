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
        <title>SJM - List Orderan</title>
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
                        <h1 class="mt-4">List Order Sinar Jaya Motor</h1>    
                        <div class="card mb-4">
                            <div class="card-header">
                                <?php if($_SESSION['role'] == "Sales"){?>
                                    <!-- Button to Open the Modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Order
                                    </button>
                                    <!-- end Button to Open the Modal  -->
                                    <!-- <i class="fas fa-table mr-1"></i> -->
                                    
                                <?php }; ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nomor Pesanan</th>
                                                <th>Tanggal</th>
                                                <th>Nama Sales</th>
                                                <th>Tujuan</th>
                                                <th>Pengiriman</th>
                                                <?php if($_SESSION['role'] != "Gudang"){?>
                                                <th>Pembayaran</th>
                                                <?php }; ?>
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
                                                $ambilsemuadatastock = mysqli_query($koneksi,"SELECT * FROM  pesanan o, tb_toko t, tb_register u WHERE o.id_toko = t.id_toko && o.id_user = u.id_user");
                                                $i=1;
                                                while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                    $idp        = $data['id_pesanan'];
                                                    $idt        = $data['id_toko'];
                                                    $idu        = $data['id_user'];
                                                    $namad      = $data['namadepan'];
                                                    $nop        = $data['no_order'];
                                                    $namat      = $data['nama_toko'];
                                                    $tglo       = $data['tgl_order'];
                                                    $kirim      = $data['kirim'];
                                                    $bayar      = $data['bayar'];
                                            ?>
                                            <tr>
                                                <td><?=$i++?></td>
                                                <td><?=$nop;?></td>
                                                <td><?=$tglo;?></td>
                                                <td><?=$namad;?></td>
                                                <td><?=$namat;?></td>
                                                <td>
                                                    <?php 
                                                        if($kirim ==0){
                                                            echo "Diterima";
                                                        }else if($kirim == 1){
                                                            echo "Diproses";
                                                        }else if($kirim == 2){
                                                            echo "Dikirim";
                                                        }
                                                    ?>
                                                </td>
                                                <?php if($_SESSION['role'] != "Gudang"){?>
                                                <td>
                                                    <?php 
                                                        if($bayar ==0){
                                                            echo "Belum Dibayar";
                                                        }else if($bayar == 1){
                                                            echo "Lunas";
                                                        }
                                                    ?>
                                                </td>
                                                <?php }; ?>
                                                <td>
                                                    <?php echo "<a href='detail-order-revisi.php?id_pesanan=$idp'>" ;?><button target="_blank" type="button" class="btn btn-primary">Detail</button></a>
                                                    <?php if($_SESSION['role'] == "Sales" || $_SESSION['role'] == "Admin"){?>
                                                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#lun<?=$idp;?>">
                                                            Lunas
                                                        </button>
                                                    <?php }; ?>
                                                    <?php if($_SESSION['role'] == "Gudang"){
                                                        if ($kirim == 0){?>
                                                            <button type="button" class="btn btn-warning mb-2" data-toggle="modal" data-target="#pro<?=$idp;?>">
                                                                Diproses
                                                            </button>
                                                        <?php } else if ($kirim == 1) { ?>
                                                            <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#kir<?=$idp;?>">
                                                                Dikirim
                                                            </button>
                                                        <?php }; ?>
                                                    <?php }; ?>
                                                    <!--  <button target="_blank" type="button" class="btn btn-outline-primary"><i class="fa fa-file-pdf"></i>Print</button></a>   -->
                                                    <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$ido;?>"> Hapus -->
                                                    </td>
                                            </tr>
                                            <!-- END Selesai Field Table --> 
                                            <!-- Modal Tambah Barang -->
                                     
                                            
                                            <!-- Pembayaran Lunas -->
                                            <div class="modal fade" id="lun<?=$idp;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Status Pembayaran</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <!-- Content 1 -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    Apakah anda yakin pesanan ini sudah lunas  ?
                                                                    <?=$nop;?> dengan tujuan <?=$namat;?>
                                                                    <input type="hidden" name="id_pesanan" value="<?=$idp;?>">
                                                                    <br>
                                                                    <button type="submit" class="btn btn-primary" name="orderlunas1" >Submit</button>
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
                                            <!-- End Pembayaran Lunas -->
                                            <!-- Barang Diproses -->
                                            <div class="modal fade" id="pro<?=$idp;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Status Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <!-- Content 1 -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    Apakah anda ingin mempacking pesanan <?=$nop;?> dengan tujuan <?=$namat;?> ?
                                                                    <input type="hidden" name="id_pesanan" value="<?=$idp;?>">
                                                                    <br>
                                                                    <button type="submit" class="btn btn-primary" name="orderproses1" >Submit</button>
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
                                            <!-- End Barang Diproses -->
                                            <!-- Barang Dikirim -->
                                            <div class="modal fade" id="kir<?=$idp;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Status Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <!-- Content 1 -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    Apakah anda ingin mengirim pesanan <?=$nop;?> Barang <?=$namabarang;?> dengan tujuan <?=$namat;?> ?
                                                                    <input type="hidden" name="id_pesanan" value="<?=$idp;?>">
                                                                    <br>
                                                                    <button type="submit" class="btn btn-primary" name="orderkirim1" >Submit</button>
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
                                            <!-- End Pembayaran Lunas -->                                      
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
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Tambah Order</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <form method="POST" >
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                        <?php 
                                                                //ambil data terbesar 
                                                                $char = 'ORDER';
                                                                $query=mysqli_query($koneksi,"SELECT max(no_order) as max_kode FROM pesanan 
                                                                WHERE no_order LIKE '{$char}%' ORDER BY no_order DESC LIMIT 1");
                                                                $data = mysqli_fetch_array($query);
                                                                $kodeBarang = $data['max_kode'];

                                                                //mengambil data menggunakan fungsi subtr, 
                                                                //misal data BRG001 akan diambil 001 
                                                                $no = substr($kodeBarang, -3, 3);

                                                                //setelah substring bilangan diambil lantas dicasting menjadi integer
                                                                $no = (int) $no;

                                                                //bilangan yang diambil akan ditambah 1 untuk menentukan nomor urut berikutnya
                                                                $no += 1;

                                                                //perintah sprintf("%03s", $no) berguna untuk membuat string menjadi 3 karakter
                                                                $newKodeBarang = $char . sprintf("%03s", $no);
                                                            ?>
                                                            <input type="text" name="no_order" id="nmr_po" value="<?= $newKodeBarang; ?>" class="form-control" readonly>
                                                            <!-- <input class="form-control py-4 mb-2" id="inputEmailAddress" name="no_order"      type="text"     placeholder="Nomor Pesanan"   value="<?$newKodeBarang?>"/>                                 -->
                                                            <select name="tokonya" class="form-control mb-2">
                                                                <?php
                                                                    $ambilsemuadata = mysqli_query($koneksi,"SELECT * FROM tb_toko WHERE stat_to = 0");
                                                                    while($fetcharray = mysqli_fetch_array($ambilsemuadata)){
                                                                        $nama_t = $fetcharray['nama_toko'];
                                                                        $idt = $fetcharray['id_toko'];
                                                                ?>
                                                                    <option value="<?=$idt;?>"><?=$nama_t;?></option> 
                                                                <?php }; ?>
                                                            </select>
                                                            <button type="submit" name="tambahorder1" class="btn btn-primary" >Submit</button>
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
</html>