<?php
//import koneksi ke database
include 'function.php';
include 'cek.php';

$ido=$_GET['id_pes'];// harusnya id pesanan

$data = mysqli_query($koneksi, "SELECT * from detail d, pesanan p, tb_toko t where t.id_toko = p.id_toko and p.id_pesanan='$ido'");

foreach ($data as $dat) {

    // $ido = $dat['id_pesanan']; 
    $nop = $dat['no_order'];
    $tglo = $dat['tgl_order'];
    $namat = $dat['nama_toko'];
    $alamat = $dat['alamat'];                                  
}
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
    <div class="container">
        <hr>
        <div class="container-fluid px-4 mt-2">
            <div class="float-start" style="padding-left: 3px;">
                <div class="float-start">
                    <h4 style="padding-top: 1px; padding-left:2px"> Sinar Jaya Motor</h4>
                    <h5 style="padding-top: 1px; padding-left:2px">Ruko Elang Laut Boulevard Blok A.77-78 Jalan Pantai Indah Selatan 1</h5>
                    <h5 style="padding-top: 1px; padding-left:2px">Jakarta Utara</h5>
                </div>
                <div class="float-end">
                </div>
            </div>

            <div class="float-end">

                <div class="row">
                    <div class="col text-center">
                        <h2 class="h3 text-dark">Nota Pesanan</h2>
                    </div>
                </div>
                <br>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">Nomor Order</th>

                            <td><input type="text" class="form-control" name="no_order" value="<?php echo $nop ?>" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Tn / Toko</th>

                            <td><input class="form-control" name="nama_toko" type="text" value="<?php echo $namat ?>" readonly />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Alamat</th>

                            <td><input class="form-control" name="alamat" type="text" value="<?php echo $alamat ?>" readonly />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tanggal Order</th>

                            <td><input class="form-control" name="tgl_po" type="tgl_order" placeholder="Tanggal" value="<?php echo $tglo ?>" readonly />
                            </td>
                        </tr>

                        

                    </tbody>
                </table>
                <br>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <?php if($_SESSION['role'] != "Gudang"){?>
                                <th style="width: 100px" class="text-center">No</th>
                                <th style="width: 200px" class="text-center">Kode Barang</th>
                                <th style="width: 400px" class="text-center">Nama Produk</th>
                                <th style="width: 200px" class="text-center">Harga / Pcs</th>
                                <th style="width: 200px" class="text-center">Qty</th>
                                <th style="width: 200px" class="text-center">Total</th>
                            <?php } else if ($_SESSION['role'] == "Gudang"){ ?>
                                <th style="width: 300px" class="text-center">No</th>
                                <th style="width: 500px" class="text-center">Kode Barang</th>
                                <th style="width: 500px" class="text-center">Nama Produk</th>
                                <th style="width: 200px" class="text-center">Qty</th>
                            <?php }; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $datapo = mysqli_query($koneksi, "SELECT * FROM pesanan p, detail d, tb_barang b where p.id_pesanan = d.id_pes and b.id_b=d.id_b and p.id_pesanan='$ido'"); // id pesanan
                        while ($show = mysqli_fetch_array($datapo)) {
                            $hargap = $show['harga_p'];
                            $Harga = $show['harga'];
                            $qtyp = $show['qtyp'];
                            $totalh = $show['totalh'];
                            if ($hargap == "-") {
                                $total = $qtyp * $Harga;
                            } else if ($hargap != "-") {
                                $total = $qtyp * $hargap;
                            }
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $show['kode_b'] ?></td>
                                <td class="text-center"><?= $show['nama_b'] ?></td>
                                <?php if($_SESSION['role'] != "Gudang"){?>
                                <td class="text-center">Rp <?= number_format($show['harga']) ?></td>
                                <?php }; ?>
                                <td class="text-center"><?=  number_format($show['qtyp']) ?></td>
                                <?php if($_SESSION['role'] != "Gudang"){?>
                                <td class="text-center">Rp <?= number_format($total) ?></td>
                                <?php }; ?>
                            </tr>
                        <?php }; ?>
                    </tbody>
                    <tfoot>
                        <td>
                            <?php if($_SESSION['role'] != "Gudang"){?>
                                <th colspan="4" style="text-align: right">Total</th>
                            <?php } else if($_SESSION['role'] == "Gudang"){ ?>
                                <th colspan="2" style="text-align: right">Total</th>
                            <?php }; ?>
                            <td class="text-center">Rp <?= number_format($totalh) ?></td>
                        </td>
                    </tfoot>
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