<?php
//import koneksi ke database
include 'function.php';
include 'cek.php';
?>
<html>
<head>
  <title>Nota Orderan Sinar Jaya</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class="container">
        <hr>
            <div class="row">
                <div class="col text-center">
                    <h3 class="h3 text-dark">Laporan Barang Masuk</h3>
                </div>
            </div>
            <br>
            <br>
            <br>
		<div class="data-tables datatable-dark">
            <table class="table table-bordered" id="exportmasuk" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Barang Masuk</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Pengirim</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Qty Bermasalah</th>
                    </tr>
                </thead>
                <!-- Mulai Field Table -->
                <tbody>
                    <?php
                        $ambilsemuadatastock = mysqli_query($koneksi,"SELECT * FROM tb_barang b, b_masuk m, tb_pabrik p WHERE b.id_b = m.id_b && m.id_p = p.id_p");
                        $i=1;
                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                            $idm        = $data['id_bm'];
                            $idb        = $data['id_b'];
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
                        <td><?=$i++?></td>
                        <td><?php echo $kodebarang;?></td>
                        <td><?php echo $namabarang;?></td>
                        <td><?php echo $Kategori;?></td>
                        <td><?php echo $tanggal;?></td>
                        <td><?php echo $pengirim;?></td>
                        <td><?php echo $qtym;?></td>
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
                        <td><?php echo $keterangan;?></td>
                        <td><?php echo $qtymas;?></td>
                    </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>
        <!--  -->
    </div>

        <script>
            window.print();
        </script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
</body>
</html>