<?php
//import koneksi ke database
include 'function.php';
include 'cek.php';

$idrp=$_GET['id_rp'];// harusnya id pesanan

$data = mysqli_query($koneksi, "SELECT * from detail_rp d, returp rp, tb_pabrik p where d.id_rp = rp.id_retp AND p.id_p = rp.id_p and rp.id_retp ='$idrp'");
foreach ($data as $dat) {

    // $ido = $dat['id_pesanan']; 
    $norp    = $dat['no_rp'];
    $namap    = $dat['nama_p'];
    $tglrp = $dat['tgl_rp'];
}
?>
<html>
<head>
  <title>Laporan Retur Pabrik Sinar Jaya</title>
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
    <div class="container">
        <hr>
        <div class="container-fluid px-4 mt-2">
            <div class="float-start" style="padding-left: 3px;">
                <div class="float-start">
                    <h4 style="padding-top: 1px; padding-left: 2px;"> Sinar Jaya Motor</h4>
                    <h5 style="padding-top: 1px; padding-left:2px">Ruko Elang Laut Boulevard Blok A.77-78 Jalan Pantai Indah Selatan 1</h5>
                    <h5 style="padding-top: 1px; padding-left:2px">Jakarta Utara</h5>
                </div>
                <div class="float-end">
                </div>
            </div>

            <div class="float-end">

                <div class="row">
                    <div class="col text-center">
                        <h2 class="h3 text-dark">Laporan Barang Retur Pabrik</h2>
                    </div>
                </div>
                <br>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">Nomor Retur Pabrik</th>

                            <td><input type="text" class="form-control" name="no_order" value="<?php echo $norp ?>" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Pabrik</th>

                            <td><input class="form-control" name="nama_p" type="text" value="<?php echo $namap ?>" readonly />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tanggal Order</th>

                            <td><input class="form-control" name="tgl_po" type="tgl_order" placeholder="Tanggal" value="<?php echo $tglrp ?>" readonly />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 100px" class="text-center">No</th>
                            <th style="width: 200px" class="text-center">Kode Barang</th>
                            <th style="width: 400px" class="text-center">Nama Produk</th>
                            <th style="width: 200px" class="text-center">Qty</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $datapo = mysqli_query($koneksi, "SELECT * from detail_rp d, returp rp, tb_barang b where d.id_ba = b.id_b AND d.id_rp = rp.id_retp  and rp.id_retp ='$idrp'");
                        
                        if (!$datapo) {
                            // Query execution failed, handle the error here
                            echo "Error executing the query: " . mysqli_error($koneksi);
                            exit; // Exit the script if the query failed
                        }

                        while ($show = mysqli_fetch_array($datapo)) {
                            $qtyrp = $show['qtyrp'];
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $show['kode_b'] ?></td>
                                <td><?= $show['nama_b'] ?></td>
                                <td class="text-center"><?=  number_format($show['qtyrp']); ?></td>
                            </tr>
                        <?php }; ?>
                    </tbody>
                </table>
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