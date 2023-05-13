<?php
//import koneksi ke database
include 'function.php';
include 'cek.php';
?>
<html>
<head>
  <title>List Barang Sinar Jaya</title>
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
                    <h3 class="h3 text-dark"><strong>List Barang Sinar Jaya Motor</strong></h3>
                </div>
            </div>
            <br>
            <br>
            <br>
		<div class="data-tables datatable-dark">
            <table class="table table-bordered" id="exportkeluar" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Kode barang</th>
                        <th>Nama Barang</th>
                        <th>Tipe Mobil</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Pcs/Dus</th>
                        <th>Harga Promo</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <!-- Mulai Field Table -->
                <tbody>
                    <?php
                        $ambilsemuadatastock = mysqli_query($koneksi,"SELECT * FROM  tb_barang");
                        $i=1;
                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                            $idb        = $data['id_b'];
                            $kodebarang = $data['kode_b'];
                            $namabarang = $data['nama_b'];
                            $Tipe_Mobil = $data['tipe_mobil'];
                            $Kategori   = $data['kategori'];
                            $Harga      = $data['harga'];
                            $qtyd       = $data['pcs_dus'];
                            $promo      = $data['harga_p'];
                            $qty        = $data['qty']
                    ?>
                    <tr>
                        <td><?=$i++?></td>
                        <td><?php echo $kodebarang;?></td>
                        <td><?php echo $namabarang;?></td>
                        <td><?php echo $Tipe_Mobil;?></td>
                        <td><?php echo $Kategori;?></td>
                        <td>Rp <?php echo $Harga;?></td>
                        <td><?php echo $qtyd;?></td>
                        <td><?php echo $promo;?></td>
                        <td><?php echo $qty;?></td> 
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