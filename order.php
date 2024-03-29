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
                                    <!-- Modal Tambah Barang -->
                                        
                                    <?php }; ?>
                                </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nomor Pesanan</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Qty</th>
                                                <!-- <th>Harga Satuan</th> -->
                                                <th>Wilayah</th>
                                                <th>Toko Pemesan</th>
                                                <th>Tanggal</th>
                                                <th>Total Harga</th>
                                                <th>PIC</th>
                                                <th>Pengiriman</th>
                                                <th>Pembayaran</th>
                                                <?php if($_SESSION['role'] == "Gudang"||$_SESSION['role'] == "Sales" || $_SESSION['role'] == "Admin"){?>
                                                <th>Aksi</th>
                                                <?php };?>
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
                                                $ambilsemuadatastock = mysqli_query($koneksi,"SELECT * FROM  orderan o, tb_barang b, tb_toko t, tb_register u WHERE o.id_b = b.id_b && o.id_toko = t.id_toko && o.id_user = u.id_user");
                                                $i=1;
                                                while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                    $ido        = $data['id_o'];
                                                    $idt        = $data['id_toko'];
                                                    $idu        = $data['id_user'];
                                                    $namad      = $data['namadepan'];
                                                    $nop        = $data['no_order'];
                                                    $kodeb      = $data['kode_b'];
                                                    $namabarang = $data['nama_b'];
                                                    $wilayah    = $data['wilayah'];
                                                    $Harga      = $data['harga'];
                                                    $hargap     = $data['harga_p'];
                                                    $qtyp       = $data['qtyp'];
                                                    $kirim      = $data['kirim'];
                                                    $bayar      = $data['bayar'];
                                                    $namat      = $data['nama_toko'];
                                                    if ($hargap == "-"){
                                                    $total      = $qtyp * $Harga;
                                                    } else if ($hargap != "-"){
                                                    $total      = $qtyp * $hargap; 
                                                    }
                                                    $tglo       = $data['tgl_order'];
                                            ?>
                                            <tr>
                                                <td><?=$i++?></td>
                                                <td><?=$nop;?></td>
                                                <td><?=$kodeb;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$qtyp;?></td>
                                                <!-- <?php if ($hargap == "-"){ ?>
                                                <td>Rp <?=$Harga;?></td>
                                                <?php } else if ($hargap != "-"){?>
                                                <td>Rp <?=$hargap;?></td> 
                                                <?php } ?> -->
                                                <td><?=$wilayah;?></td>
                                                <td><?=$namat;?></td>
                                                <td><?=$tglo;?></td>
                                                <td>Rp <?=number_format($total);?></td>
                                                <td><?=$namad;?></td>
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
                                                <td>
                                                    <?php 
                                                        if($bayar ==0){
                                                            echo "Belum Dibayar";
                                                        }else if($bayar == 1){
                                                            echo "Lunas";
                                                        }
                                                    ?>
                                                </td>
                                                    <td>
                                                    <?php if($_SESSION['role'] == "Gudang"){
                                                        if ($kirim == 0){?>
                                                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#pro<?=$ido;?>">
                                                            Diproses
                                                        </button>
                                                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#kir<?=$ido;?>">
                                                            Dikirim
                                                        </button>
                                                    <?php } else if ($kirim == 1) { ?>
                                                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#kir<?=$ido;?>">
                                                            Dikirim
                                                        </button>
                                                    <?php } }else if($_SESSION['role'] == "Sales" || $_SESSION['role'] == "Admin"){?>
                                                        
                                                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#lun<?=$ido;?>">
                                                            Lunas
                                                        </button>
                                                        <?php if ($kirim != 2) {?>
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$ido;?>">
                                                        Ubah  
                                                        <?php }?>
                                                        <?php echo "<a href='lap_or.php?id_o=$ido'>" ;?> <button target="_blank" type="button" class="btn btn-danger"><i class="fa fa-file-pdf"></i>Print</button></a>
                                                        <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$ido;?>"> Hapus -->
                                                    <?php }; ?>
                                                    </td>
                                            </tr>
                                            <!-- END Selesai Field Table -->  
                                            
                                            <!-- The  Edit Modal -->
                                            <div class="modal fade" id="edit<?=$ido;?>">
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
                                                                    <input class="form-control py-4 mb-2" id="updateqty" name="qtyp" type="number" placeholder="Qty" value="<?=$qtyp;?>" required/>
                                                                    <input type="hidden" name="id_o" value="<?=$ido;?>">
                                                                    <button type="submit" class="btn btn-primary" name="updateorder" >Submit</button>
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
                                            <div class="modal fade" id="delete<?=$ido;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Pesanan ?</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <!-- Content 1 -->
                                                        <form method="POST">
                                                            <div class="modal-body mb-2">
                                                                Apakah anda yakin ingin menghapus pesanan <?=$nop;?> untuk toko <?=$namat;?> ?
                                                                <input type="hidden" name="id_p"    value="<?=$ido;?>">
                                                                <input type="hidden" name="qtyp"         value="<?=$qtyp;?>">
                                                                <input type="hidden" name="nama_toko"     value="<?=$namat;?>">
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="hapusorder" >Hapus</button>
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End aksi Crud -->
                                            <!-- Pembayaran Lunas -->
                                            <div class="modal fade" id="lun<?=$ido;?>">
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
                                                                    <?=$nop;?> Barang <?=$namab;?> dengan tujuan <?=$namat;?>
                                                                    <input type="hidden" name="id_o" value="<?=$ido;?>">
                                                                    <br>
                                                                    <button type="submit" class="btn btn-primary" name="orderlunas" >Submit</button>
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
                                            <div class="modal fade" id="pro<?=$ido;?>">
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
                                                                    Apakah anda ingin mempacking pesanan <?=$nop;?> Barang <?=$namabarang;?> dengan tujuan <?=$namat;?> ?
                                                                    <input type="hidden" name="id_o" value="<?=$ido;?>">
                                                                    <br>
                                                                    <button type="submit" class="btn btn-primary" name="orderproses" >Submit</button>
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
                                            <div class="modal fade" id="kir<?=$ido;?>">
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
                                                                    <input type="hidden" name="id_o" value="<?=$ido;?>">
                                                                    <br>
                                                                    <button type="submit" class="btn btn-primary" name="orderkirim" >Submit</button>
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
                                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="no_order"      type="text"     placeholder="Nomor Pesanan"   value="" required/>
                                                                <select name="barangnya" class="form-control mb-2">
                                                                    <?php
                                                                        $ambilsemuadatanya = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE stat == 0");
                                                                        while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                                                                            $namab = $fetcharray['nama_b'];
                                                                            $idb   = $fetcharray['id_b'];
                                                                            $kodeb   = $fetcharray['kode_b'];
                                                                            $tipe   = $fetcharray['tipe_mobil'];
                                                                    ?>
                                                                    <option value="<?=$idb;?>"><?=$kodeb;?>  -  <?=$namab;?>  -  <?=$tipe;?></option>  
                                                                    <?php };?>
                                                                </select>
                                                                <input class="form-control py-4 mb-2" id="inputEmailAddress" name="qtyp" type="text"     placeholder="Qty"     value="" required/>
                                                                <select name="tokonya" class="form-control mb-2">
                                                                    <?php
                                                                        $ambilsemuadata = mysqli_query($koneksi,"SELECT * FROM tb_toko WHERE stat_to == 0");
                                                                        while($fetcharray = mysqli_fetch_array($ambilsemuadata)){
                                                                            $nama_t = $fetcharray['nama_toko'];
                                                                            $idt = $fetcharray['id_toko'];
                                                                    ?>
                                                                    <option value="<?=$idt;?>"><?=$nama_t;?></option> 
                                                                    <?php }; ?>
                                                                </select>
                                                                <button type="submit" name="tambahorder"    class="btn btn-primary" >Submit</button>
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