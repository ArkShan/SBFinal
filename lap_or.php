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
                    <h3 class="h3 text-dark">Nota Pesanan</h3>
                </div>
            </div>
	        <div class="row">
                <div class="col-md-4">
                    <table class="table table-borderless">
                        <?php
                            $ido=$_GET['id_o'];

                            $sSQL=mysqli_query($koneksi, "SELECT * FROM tb_barang b, orderan o, tb_toko t WHERE o.id_o = '$ido' AND b.id_b = o.id_b AND o.id_toko = t.id_toko limit 1");
                            $ambilsemuadatastock = mysqli_query($koneksi,"SELECT * FROM  orderan o, tb_barang b, tb_toko t WHERE o.id_b = b.id_b && o.id_toko = t.id_toko");
                            $i=1;
                            while($data=mysqli_fetch_array($sSQL)){
                                $ido        = $data['id_o'];
                                $nop        = $data['no_order'];
                                $kodeb      = $data['kode_b'];
                                $namab      = $data['nama_b'];
                                $wilayah    = $data['wilayah'];
                                $Harga      = $data['harga'];
                                $qtyp       = $data['qtyp'];
                                $namat      = $data['nama_toko'];
                                $total      = $qtyp * $Harga;
                                $tglo       = $data['tgl_order'];
                                $alamat     = $data['alamat'];
                        ?>
                        <tr>
                            <td><strong>Tn / Toko</strong></td>  
                            <td><strong>:</strong></td> 
                            <td><?php echo $namat;?></td>
                        </tr>
                        <br>
                        <tr>
                            <td><strong>Alamat</strong></td>     
                            <td><strong>:</strong></td> 
                            <td><?php echo $alamat;?></td>
                        </tr>
                        <br>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><?php echo $wilayah;?></td>
                        </tr>
                        
                    </table>
                </div>
            </div>

		<div class="tables datatable-dark">
            <table class="table table-bordered" id="exportorder" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Pesanan</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Harga Satuan</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <!-- Mulai Field Table -->
                <tbody>
                    <tr>
                        <td><?=$i++?></td>
                        <td><?php echo $nop;?></td>
                        <td><?php echo $kodeb;?></td>
                        <td><?php echo $namab;?></td>
                        <td><?php echo $qtyp;?></td>
                        <td>Rp <?php echo $Harga;?></td>
                        <td><?php echo $tglo;?></td>
                        <td>Rp <?php echo $total;?></td> 
                    </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>
        <!--  -->
    </div>
<!-- 
        <script>
            $(document).ready(function() {
                $('#exportorder').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'copy','csv','excel', 'pdf', 'print'
                        ]
                } );
            } );
        </script> -->
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