<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","db_sjm");
if(isset($_POST['registrasi'])){
    $email          = $_POST['email'];
    $nama           = $_POST['namadepan'];
    $namabelakang   = $_POST['namabelakang'];
    $password       = $_POST['password'];
    $role           = $_POST['role'];

    $database = mysqli_query($koneksi,"INSERT INTO tb_register (email,namadepan,namabelakang,password,role) VALUES ('$email','$nama','$namabelakang','$password','$role')"); 

    if($database){
        header('location:user.php');
    }else{
        echo "error";
        header('location:register.php');
    }
};

// Tombol Submit Barang
if(isset($_POST['tambahbarang'])){
    $kodebarang = $_POST['kode_b'];
    $namabarang = $_POST['nama_b'];
    $tipemobil  = $_POST['tipe_mobil'];
    $kategori   = $_POST['kategori'];
    $harga      = $_POST['harga'];
    $qtyd       = $_POST['pcs_dus'];
    $hargapromo = $_POST['harga_p'];
    $qty        = $_POST['qty'];

    $addtotable = mysqli_query($koneksi,"INSERT INTO tb_barang (kode_b,nama_b,tipe_mobil,kategori,harga,pcs_dus,harga_p, qty) VALUES ('$kodebarang','$namabarang','$tipemobil','$kategori','$harga','$qtyd','$hargapromo','$qty')");
    
    if($addtotable){
        echo "berhasil";
    }else{
        echo "error";
    }
}

if(isset($_POST['updatebarang'])){
    $idb        = $_POST['id_b'];
    $kodebarang = $_POST['kode_b'];
    $namabarang = $_POST['nama_b'];
    $tipemobil  = $_POST['tipe_mobil'];
    $kategori   = $_POST['kategori'];
    $harga      = $_POST['harga'];
    $qtyd       = $_POST['pcs_dus'];
    $hargapromo = $_POST['harga_p'];

    $update = mysqli_query($koneksi,"UPDATE tb_barang set kode_b='$kodebarang',nama_b='$namabarang',tipe_mobil='$tipemobil',kategori='$kategori',harga='$harga',pcs_dus='$qtyd',harga_p='$hargapromo' WHERE id_b='$idb'");
    if($update){
        header('location:tables.php');
    } else {
        echo 'gagal';
        header('location:tables.php');
    }
}

// Menghapus Barang
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['id_b'];
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_barang WHERE id_b='$idb'");
    if($hapus){
        header('location:tables.php');
    } else {
        echo 'gagal';
        header('location:tables.php');
    }
}

if(isset($_POST['masuk1'])){
    date_default_timezone_set('Asia/Jakarta');
    $pabrik    = $_POST['pabriknya'];
    $tanggal = date("Y-m-d H:i:s");
    $nomas  = $_POST['no_masuk'];
    
    $addtotable = mysqli_query($koneksi,"INSERT INTO masuk (id_p,no_masuk,tgl_mas) VALUES ('$pabrik','$nomas','$tanggal')");
    // die (mysqli_error($koneksi));
    if($addtotable){
        echo "berhasil";
    }else{
        echo "gagal";
    }  
}

if(isset($_POST['barangmasuk1'])){
    $barang   = $_POST['barangnya'];
    $idma     = $_POST['id_mas'];
    $qtym     = $_POST['qtym'];
   
    $cekqtyskrg = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$barang'"); 
    $ambildata = mysqli_fetch_array($cekqtyskrg);
    $qtysekarang= $ambildata['qty'];
    $updateqty = $qtysekarang+$qtym;

    $addtomasuk = mysqli_query($koneksi,"INSERT INTO detail_m (id_ma,id_b,qtym) VALUES ('$idma','$barang','$qtym')");
    $updatesqtymasuk = mysqli_query($koneksi," UPDATE tb_barang set qty='$updateqty' WHERE id_b='$barang'");

    if($addtomasuk && $updateqtymasuk){
        echo '
        <script>
            history.go(-1);
        </script>
    ';
    } else {
        echo 'gagal';
        header('location:detail-masuk.php');
    }
}

if(isset($_POST['barangmasuk'])){
    $barang   = $_POST['barang'];
    $pengirim = $_POST['pengirim'];
    $qtym     = $_POST['qtym'];
   
    $cekqtyskrg = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$barang'"); 
    $ambildata = mysqli_fetch_array($cekqtyskrg);
    $qtysekarang= $ambildata['qty'];
    $updateqty = $qtysekarang+$qtym;
    
    $pilihbmasuk = mysqli_query($koneksi,"SELECT * FROM b_masuk WHERE id_b='$barang' && id_p='$pengirim'"); 
    $ambilbmasuk = mysqli_fetch_array($pilihbmasuk);
    $addtomasuk = mysqli_query($koneksi,"INSERT INTO b_masuk (id_b,id_p,qtym) VALUES ('$barang','$pengirim','$qtym')");
    $updatesqtymasuk = mysqli_query($koneksi," UPDATE tb_barang set qty='$updateqty' WHERE id_b='$barang'");

    if($ambilbmasuk && $addtomasuk && $updateqtymasuk){
        header('location:b_masuk.php');
    } else {
        echo 'gagal';
        header('location:b_masuk.php');
    }
}

if(isset($_POST['hapusbarangmasuk'])){
    $id_b = $_POST['id_b'];
    $idm = $_POST['id_bm'];
   
    $lihatstock = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$id_b'");
    $stocknya = mysqli_fetch_array($lihatstock);   
    $stockskrg = $stocknya['qty'];// jumlah stock sekarang
    
    $lihatdataskrg = mysqli_query($koneksi,"SELECT * FROM b_masuk WHERE id_bm='$idm'"); //lihat qty saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
    $qtyskrg = $preqtyskrg['qtym'];//jumlah skrg
    
    $balik = $stockskrg-$qtyskrg;
    $update = mysqli_query($koneksi,"UPDATE tb_barang SET qty='$balik' WHERE id_b='$id_b'");
    $hapusdata = mysqli_query($koneksi,"DELETE FROM b_masuk WHERE id_bm='$idm'");
    
    // Check apakah ini akan berhasil
    if($update && $hapusdata == true){
        header('location:b_masuk.php');
        exit;
        // die (mysqli_error($koneksi));
    }else{
        echo 'gagal';
        header('location:b_masuk.php');
        exit;
    }
};

if(isset($_POST['keluar1'])){
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("Y-m-d H:i:s");
    $nokel  = $_POST['no_keluar'];
    $nop    = $_POST['ordernya'];
    
    $addtokeluarrevisi = mysqli_query($koneksi,"INSERT INTO keluar (id_pe,no_keluar,tgl_kel) VALUES ('$nop','$nokel','$tanggal')");
    // die (mysqli_error($koneksi));
    if($addtotable){
        echo "berhasil";
    }else{
        echo "gagal";
    }  
}

if(isset($_POST['barangkeluar1'])){
    $barang = $_POST['barangnya'];
    $idke = $_POST['id_kel'];
    $qtyk = $_POST['qtyk'];
   
    $cekstocksekarang = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$barang'"); 
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang= $ambildatanya['qty'];
    $updateqty = $stocksekarang-$qtyk;

    $addtokeluar = mysqli_query($koneksi," INSERT INTO detail_k (id_ke,id_b,qtyk) VALUES ('$idke','$barang','$qtyk')");
    $updatestokgudang = mysqli_query($koneksi," UPDATE tb_barang SET qty='$updateqty' WHERE id_b='$barang'");
    if($addtokeluar && $updatestokgudang){
        echo '
        <script>
            history.go(-1);
        </script>
    ';
    } else {
        echo 'gagal';
        header('location:detail-keluar.php');
    }
}

if(isset($_POST['barangkeluar'])){
    $barang = $_POST['barang'];
    $tujuan = $_POST['tujuan'];
    $qtyk = $_POST['qtyk'];
   
    $cekstocksekarang = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$barang'"); 
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang= $ambildatanya['qty'];
    $updateqty = $stocksekarang-$qtyk;

    $pilihbkeluar = mysqli_query($koneksi,"SELECT * FROM b_keluar WHERE id_b='$barang' && id_toko='$tujuan'"); 
    $ambilbkeluar = mysqli_fetch_array($pilihbkeluar);

    $addtokeluar = mysqli_query($koneksi," INSERT INTO b_keluar (id_b,id_toko,qtyk) VALUES ('$barang','$tujuan','$qtyk')");
    $updatestokgudang = mysqli_query($koneksi," UPDATE tb_barang SET qty='$updateqty' WHERE id_b='$barang'");
    if($ambilbkeluar && $addtokeluar && $updatestokgudang){
        header('location:b_keluar.php');
    } else {
        echo 'gagal';
        header('location:b_keluar.php');
    }
}

if(isset($_POST['hapusbarangkeluar'])){
    $id_b = $_POST['id_b'];
    $idk = $_POST['id_bk'];
   
    $lihatstock = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$id_b'");
    $stocknya = mysqli_fetch_array($lihatstock);   
    $stockskrg = $stocknya['qty'];// jumlah stock sekarang
    
    $lihatdataskrg = mysqli_query($koneksi,"SELECT * FROM b_keluar WHERE id_bk='$idk'"); //lihat qty saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
    $qtyskrg = $preqtyskrg['qtyk'];//jumlah skrg
    
    $selisih = $stockskrg+$qtyskrg;
    $update = mysqli_query($koneksi,"UPDATE tb_barang SET qty='$selisih' WHERE id_b='$id_b'");
    $hapusdata = mysqli_query($koneksi,"DELETE FROM b_keluar WHERE id_bk='$idk'");
    
    // Check apakah ini akan berhasil
    if($update && $hapusdata == true){
        header('location:b_keluar.php');
        exit;
    }else{
        echo 'gagal';
        header('location:b_keluar.php');
        exit;
    }
};

if(isset($_POST['updateuser'])){
    $idu   = $_POST['id_user'];
    $email = $_POST['email'];
    $namad = $_POST['namadepan'];
    $namab = $_POST['namabelakang'];
    $pass  = $_POST['password'];
    $role  = $_POST['role'];

    $update = mysqli_query($koneksi,"UPDATE tb_register set email='$email',namadepan='$namad',namabelakang='$namab',password='$pass' WHERE id_user='$idu'");
    if($update){
        header('location:user.php');
    } else {
        echo 'gagal';
        header('location:user.php');
    }
}

if(isset($_POST['hapususer'])){
    $idu = $_POST['id_user'];
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_register WHERE id_user='$idu'");
    if($hapus){
        header('location:user.php');
    } else {
        echo 'gagal';
        header('location:user.php');
    }
}

if(isset($_POST['tambahtoko'])){
    $namat   = $_POST['nama_toko'];
    $notelp  = $_POST['no_telp'];
    $alamat  = $_POST['alamat'];
    $wilayah = $_POST['wilayah'];

    $addtotable = mysqli_query($koneksi,"INSERT INTO tb_toko (nama_toko,no_telp,alamat,wilayah) VALUES ('$namat','$notelp','$alamat','$wilayah')");
    if($addtotable && $ambilwilayah){
        echo "berhasil";
       
    }else{
        echo "error";
    }
}

if(isset($_POST['updatetoko'])){
    $idt   = $_POST['id_toko'];
    $namat = $_POST['nama_toko'];
    $notelp = $_POST['no_telp'];
    $alamat  = $_POST['alamat'];
    $wilayah = $_POST['wilayah'];

    $update = mysqli_query($koneksi,"UPDATE tb_toko set wilayah='$wilayah',nama_toko='$namat',no_telp='$notelp',alamat='$alamat' WHERE id_toko='$idt'");

    if($update && $pilihintoko){
        header('location:toko.php');
    } else {
        echo 'gagal';
        header('location:toko.php');
    }
}

if(isset($_POST['hapustoko'])){
    $idt = $_POST['id_toko'];
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_toko WHERE id_toko='$idt'");
    if($hapus){
        header('location:toko.php');
    } else {
        echo 'gagal';
        header('location:toko.php');
    }
}


if(isset($_POST['orderlunas'])){
    $ido = $_POST['id_o'];
    // $qty = $_POST['qty'];
    $cekreq = mysqli_query($koneksi,"UPDATE orderan SET bayar =1  WHERE  id_o='$ido'");
    if($cekreq){
        echo'<script>
        alert("Barang Sudah Diterima di Gudang, Silahkan klik tombol ok untuk melanjutkan ");
        window.location.href = "order.php"
        </script>';
    }else{
        header("Location:home.php");
    }
}

if(isset($_POST['orderproses'])){
    $ido = $_POST['id_o'];
    // $qty = $_POST['qty'];
    $cekreq = mysqli_query($koneksi,"UPDATE orderan SET kirim =1  WHERE  id_o='$ido'");
    if($cekreq){
        // berhasil
        // header("Location:approval.php");
        echo'<script>
        alert("Barang Sudah Diterima di Gudang, Silahkan klik tombol ok untuk melanjutkan ");
        window.location.href = "order.php"
        </script>';
    }else{
        header("Location:order.php");
    }
}

if(isset($_POST['orderproses1'])){
    $ido = $_POST['id_pesanan'];
    // $qty = $_POST['qty'];
    $cekreq = mysqli_query($koneksi,"UPDATE pesanan SET kirim =1  WHERE  id_pesanan='$ido'");
    if($cekreq){
        // berhasil
        // header("Location:approval.php");
        echo'<script>
        alert("Barang Sudah Diproses di Gudang, Silahkan klik tombol ok untuk melanjutkan ");
        window.location.href = "order-revisi.php"
        </script>';
    }else{
        header("Location:order-revisi.php");
    }
}

if(isset($_POST['orderkirim'])){
    $ido = $_POST['id_o'];
    // $qty = $_POST['qty'];
    $cekreq = mysqli_query($koneksi,"UPDATE orderan SET kirim =2  WHERE  id_o='$ido'");
    if($cekreq){
        // berhasil
        // header("Location:approval.php");
        echo'<script>
        alert("Barang Sudah Dikirim, Silahkan klik tombol ok untuk melanjutkan ");
        window.location.href = "order.php"
        </script>';
    }else{
        header("Location:order.php");
    }
}

if(isset($_POST['orderkirim2'])){
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("Y-m-d H:i:s");
    $ido = $_POST['id_pesanan'];
    $qtyp = $_POST['qtyp'];
    $nop    = $_POST['no_order'];

    $char = 'KEL';
    $query=mysqli_query($koneksi,"SELECT max(no_keluar) as max_kode FROM keluar 
    WHERE no_keluar LIKE '{$char}%' ORDER BY no_keluar DESC LIMIT 1");
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
    $newNomorKel = $char . sprintf("%03s", $no);

    $addtokeluarrevisi = mysqli_query($koneksi,"INSERT INTO keluar (id_pes,no_keluar,tgl_kel) VALUES ('$ido','$newNomorKel','$tanggal')");
     
    $cekreq = mysqli_query($koneksi,"UPDATE pesanan SET kirim =2  WHERE  id_pesanan='$ido'");
    if($cekreq AND $updatestokgudang){
        // berhasil
        // header("Location:approval.php");
        echo'<script>
        alert("Barang Sudah Dikirim, Silahkan klik tombol ok untuk melanjutkan ");
        window.location.href = "order-revisi.php"
        </script>';
    }else{
        header("Location:order-revisi.php");
    }
}

if(isset($_POST['orderkirim1'])){
    $ido = $_POST['id_pesanan'];
    // $qty = $_POST['qty'];
    $cekreq = mysqli_query($koneksi,"UPDATE pesanan SET kirim =2  WHERE  id_pesanan='$ido'");
    if($cekreq){
        // berhasil
        // header("Location:approval.php");
        echo'<script>
        alert("Barang Sudah Dikirim, Silahkan klik tombol ok untuk melanjutkan ");
        window.location.href = "order-revisi.php"
        </script>';
    }else{
        header("Location:order-revisi.php");
    }
}

if(isset($_POST['submit'])){
    $ido = $_POST['id_pes'];
    // $qty = $_POST['qty'];
    $cekreq = mysqli_query($koneksi,"UPDATE detail SET submit =1  WHERE  id_pes='$ido'");
    if($cekreq){
        echo'<script>
        alert("Order Sudah Submit, Silahkan klik tombol ok untuk melanjutkan ");
            history.go(0);
        </script>';
    }else{
        header("Location:home.php");
    }
}

if(isset($_POST['hapusorder1'])){
    $ido = $_POST['id_det'];
    $hapus = mysqli_query($koneksi, "DELETE FROM detail WHERE id_det='$ido'");
    if($hapus){
        echo'window.location.href = "detail-order-revisi.php?id_det=<?=$ido?>"';
    } else {
        echo 'gagal';
        echo'<script>history.go(0);</script';
    }
}

if(isset($_POST['tambahorder1'])){
    date_default_timezone_set('Asia/Jakarta');
    $toko    = $_POST['tokonya'];
    $tanggal = date("Y-m-d H:i:s");
    $idu     = $_SESSION['id_user'];
    $nopes    = $_POST['no_order'];

    $addtotable = mysqli_query($koneksi,"INSERT INTO pesanan (id_toko,id_user,no_order,tgl_order) VALUES ('$toko','$idu','$nopes','$tanggal')");
    // die (mysqli_error($koneksi));
    if($addtotable){
        echo "berhasil";
    }else{
        echo "gagal";
    }  
}

if(isset($_POST['tambahorder2'])){
    $qtyp    = $_POST['qtyp'];
    $ido     = $_POST['id_pesanan'];
    $barang  = $_POST['barangnya'];

    $tot = 0;
    $cek = mysqli_query($koneksi, "SELECT * from pesanan where id_pesanan = $ido");
    foreach ($cek as $data) {
        $total = $data['totalh'];
    }

    $cekqty = mysqli_query($koneksi, "SELECT * from tb_barang where id_b = $barang");
    foreach ($cekqty as $data) {
        $Harga = $data['harga'];  
        $hargap = $data['harga_p']; 
    }

    if ($hargap == 0) {
        $tot = $qtyp * $Harga;
    } else if ($hargap != 0) {
        $tot = $qtyp * $hargap;
    }

    $totalh = $total+$tot;

    $upd = mysqli_query($koneksi, "UPDATE pesanan SET totalh=$totalh where id_pesanan='$ido'");
    
    $addtotable = mysqli_query($koneksi,"INSERT INTO detail (id_pes,id_b,qtyp) VALUES ('$ido','$barang','$qtyp')");
    
    if($addtotable){
        echo "berhasil";
    }else{
        echo "gagal";
    }  
}

if(isset($_POST['tambahorder'])){
    date_default_timezone_set('Asia/Jakarta');
    $qtyp    = $_POST['qtyp'];
    $nop     = $_POST['no_order'];
    $barang  = $_POST['barangnya'];
    $toko    = $_POST['tokonya'];
    $tanggal = date("Y-m-d H:i:s");
    $idu     = $_SESSION['id_user'];

    $addtotable = mysqli_query($koneksi,"INSERT INTO orderan (id_b,id_toko,id_user,no_order,qtyp,tgl_order) VALUES ('$barang','$toko','$idu','$nop','$qtyp', '$tanggal')");
    // die (mysqli_error($koneksi));
    if($addtotable){
        echo "berhasil";
    }else{
        echo "gagal";
    }  
}

if(isset($_POST['updateorder'])){
    $qtyp  = $_POST['qtyp'];
    $ido = $_POST['id_o'];
    $addtotable = mysqli_query($koneksi,"UPDATE orderan SET qtyp ='$qtyp' WHERE id_o='$ido'");
    if($addtotable){
        echo "berhasil";
    }else{
        echo "gagal";
        
    }  
}

if(isset($_POST['hapusorder'])){
    $ido = $_POST['id_o'];
    $hapus = mysqli_query($koneksi, "DELETE FROM orderan WHERE id_o='$ido'");
    if($hapus){
        header('location:order.php');
    } else {
        echo 'gagal';
        header('location:order.php');
    }
}

if(isset($_POST['tambahpabrik'])){
    $namap = $_POST['nama_p'];

    $addtotable = mysqli_query($koneksi,"INSERT INTO tb_pabrik (nama_p) VALUES ('$namap')");
    if($addtotable){
        echo "berhasil";
       
    }else{
        echo "error";
    }
}

if(isset($_POST['updatepabrik'])){
    $idp    = $_POST['id_p'];
    $namap = $_POST['nama_p'];

    $update = mysqli_query($koneksi,"UPDATE tb_pabrik set nama_p='$namap' WHERE id_p='$idp'");
    if($update){
        header('location:pabrik.php');
    } else {
        echo 'gagal';
        header('location:pabrik.php');
    }
}

if(isset($_POST['hapuspabrik'])){
    $idp   = $_POST['id_p'];
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_pabrik WHERE id_p='$idp'");
    if($hapus){
        header('location:pabrik.php');
    } else {
        echo 'gagal';
        header('location:pabrik.php');
    }
}

if(isset($_POST['rp1'])){
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("Y-m-d H:i:s");
    $norp  = $_POST['no_rp'];
    $nop    = $_POST['pabriknya'];
    
    $addtokeluarrevisi = mysqli_query($koneksi,"INSERT INTO returp (id_p,no_rp,tgl_rp) VALUES ('$nop','$norp','$tanggal')");
    // die (mysqli_error($koneksi));
    if($addtotable){
        echo "berhasil";
    }else{
        echo "gagal";
    }  
}

if(isset($_POST['tambahrp1'])){
    $barang = $_POST['barangnya'];
    $qtyrp  = $_POST['qtyrp'];
    $idrp   = $_POST['id_retp'];
    $ido    = $_POST['id_drp'];
   
    $cekqtyskrg = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$barang'"); 
    $ambildata = mysqli_fetch_array($cekqtyskrg);
    $qtysekarang= $ambildata['qty'];
    $updateqty = $qtysekarang-$qtyrp;
    
    $addtorp = mysqli_query($koneksi,"INSERT INTO detail_rp (id_rp,id_ba,qtyrp) VALUES ('$idrp','$barang','$qtyrp')");
    $updateqtyrp = mysqli_query($koneksi," UPDATE tb_barang set qty='$updateqty' WHERE id_b='$barang'");
    

    if($addtorp && $updateqtyrp){
        echo'
        window.location.href = "detail-returp.php?id_retp=<?=$idrp?>"';
    } else {
        echo 'gagal
        window.location.href = "detail-returp.php?id_retp=<?=$idrp?>"';
    }
    // die (mysqli_error($koneksi));
}

if(isset($_POST['submitrp'])){
    $ido = $_POST['id_drp'];
    // $qty = $_POST['qty'];
    $cekreq = mysqli_query($koneksi,"UPDATE detail_rp SET submit =1  WHERE  id_drp='$ido'");
    if($cekreq){
        echo'<script>
        alert("Order Sudah Submit, Silahkan klik tombol ok untuk melanjutkan ");
        </script>
        window.location.href = "detail-returp.php?id_drp=<?=$ido?>"';
    }else{
        header("Location:home.php");
    }
}

if(isset($_POST['hapusrp1'])){
    $ido = $_POST['id_drp'];
    $idb = $_POST['id_ba'];

    $lihatstock = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$idb'");
    foreach ($lihatstock as $data) {
        $stockskrg = $data['qty'];
    }// jumlah stock sekarang
    
    $lihatdataskrg = mysqli_query($koneksi,"SELECT * FROM detail_rp WHERE id_drp='$ido'"); //lihat qty saat ini
    foreach ($lihatdataskrg as $data) {
        $qtyskrg = $data['qtyrp'];
    }//jumlah skrg
    
    $selisih = $stockskrg+$qtyskrg;
    $update = mysqli_query($koneksi,"UPDATE tb_barang SET qty='$selisih' WHERE id_b='$idb'");
    $hapus = mysqli_query($koneksi, "DELETE FROM detail_rp WHERE id_drp='$ido'");
    if($update AND $hapus){
        echo'window.location.href = "detail-returp.php?id_drp=<?=$ido?>"';
    } else {
        echo 'gagal';
        echo'<script>history.go(-1);</script';
    }
}

if(isset($_POST['tambahro1'])){
    $barang = $_POST['barangnya'];
    $qtyro  = $_POST['qtyro'];
    $idro   = $_POST['id_reto'];
    $ido    = $_POST['id_dro'];
   
    $cekqtyskrg = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$barang'"); 
    $ambildata = mysqli_fetch_array($cekqtyskrg);
    $qtysekarang= $ambildata['qty'];
    $updateqty = $qtysekarang+$qtyro;
    
    $addtoro = mysqli_query($koneksi,"INSERT INTO detail_ro (id_ro,id_b,qtyro) VALUES ('$idro','$barang','$qtyro')");
    $updateqtyro = mysqli_query($koneksi," UPDATE tb_barang set qty='$updateqty' WHERE id_b='$barang'");
    

    if($addtoro && $updateqtyro){
        echo'window.location.href = "detail-returo.php?id_reto=<?=$ido?>"';
    } else {
        echo 'gagal 
        window.location.href = "detail-returo.php?id_reto=<?=$ido?>"';
    }
    // die (mysqli_error($koneksi));
}

if(isset($_POST['submitro'])){
    $ido = $_POST['id_dro'];
    // $qty = $_POST['qty'];
    $cekreq = mysqli_query($koneksi,"UPDATE detail_ro SET submit =1  WHERE  id_dro='$ido'");
    if($cekreq){
        echo'<script>
        alert("Order Sudah Submit, Silahkan klik tombol ok untuk melanjutkan ");
        </script>
        window.location.href = "detail-returo.php?id_dro=<?=$ido?>"';
    }else{
        header("Location:home.php");
    }
}

if(isset($_POST['hapusro1'])){
    $ido = $_POST['id_dro'];
    $idb = $_POST['id_b'];

    $lihatstock = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$idb'");
    foreach ($lihatstock as $data) {
        $stockskrg = $data['qty'];
    }// jumlah stock sekarang
    
    $lihatdataskrg = mysqli_query($koneksi,"SELECT * FROM detail_ro WHERE id_dro='$ido'"); //lihat qty saat ini
    foreach ($lihatdataskrg as $data) {
        $qtyskrg = $data['qtyro'];
    }//jumlah skrg
    
    $selisih = $stockskrg-$qtyskrg;
    $update = mysqli_query($koneksi,"UPDATE tb_barang SET qty='$selisih' WHERE id_b='$idb'");
    $hapus = mysqli_query($koneksi, "DELETE FROM detail_ro WHERE id_dro='$ido'");
    if($update AND $hapus){
        echo'window.location.href = "detail-returo.php?id_dro=<?=$ido?>"';
    } else {
        echo 'gagal';
        echo'window.location.href = "detail-returo.php?id_dro=<?=$ido?>"';
    }
}

if(isset($_POST['tambahrp'])){
    $barang = $_POST['barang'];
    $pabrik = $_POST['pabrik'];
    $qtyrp  = $_POST['qtyrp'];
   
    $cekqtyskrg = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$barang'"); 
    $ambildata = mysqli_fetch_array($cekqtyskrg);
    $qtysekarang= $ambildata['qty'];
    $updateqty = $qtysekarang-$qtyrp;
    
    $pilihrp = mysqli_query($koneksi,"SELECT * FROM retur_p WHERE id_b='$barang' && id_p='$pabrik'"); 
    $ambilrp = mysqli_fetch_array($pilihrp);
    $addtorp = mysqli_query($koneksi,"INSERT INTO retur_p (id_b,id_p,qtyrp) VALUES ('$barang','$pabrik','$qtyrp')");
    $updateqtyrp = mysqli_query($koneksi," UPDATE tb_barang set qty='$updateqty' WHERE id_b='$barang'");
    

    if($ambilrp && $addtorp && $updateqtyrp){
        header('location:returp.php');
    } else {
        echo 'gagal';
        header('location:returp.php');
    }
    // die (mysqli_error($koneksi));
}

if(isset($_POST['hapusrp'])){
    $id_b = $_POST['id_b'];
    $idrp = $_POST['id_rp'];
   
    $lihatstock = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$id_b'");
    $stocknya = mysqli_fetch_array($lihatstock);   
    $stockskrg = $stocknya['qty'];// jumlah stock sekarang
    
    $lihatdataskrg = mysqli_query($koneksi,"SELECT * FROM retur_p WHERE id_rp='$idrp'"); //lihat qty saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
    $qtyskrg = $preqtyskrg['qtyrp'];//jumlah skrg
    
    $selisih = $stockskrg+$qtyskrg;
    $update = mysqli_query($koneksi,"UPDATE tb_barang SET qty='$selisih' WHERE id_b='$id_b'");
    $hapusdata = mysqli_query($koneksi,"DELETE FROM retur_p WHERE id_rp='$idrp'");
    
    // Check apakah ini akan berhasil
    if($update && $hapusdata == true){
        header('location:returp.php');
        exit;
    }else{
        echo 'gagal';
        header('location:returp.php');
        exit;
    }   
};

if(isset($_POST['ro1'])){
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("Y-m-d H:i:s");
    $noro  = $_POST['no_ro'];
    $nop    = $_POST['ordernya'];
    
    $addtokeluarrevisi = mysqli_query($koneksi,"INSERT INTO returo (id_pes,no_ro,tgl_ro) VALUES ('$nop','$noro','$tanggal')");
    // die (mysqli_error($koneksi));
    if($addtotable){
        echo "berhasil";
    }else{
        echo "gagal";
    }  
}

if(isset($_POST['tambahro'])){
    $barang = $_POST['barang'];
    $toko   = $_POST['tokonya'];
    $qtyro  = $_POST['qtyro'];
   
    $cekqtyskrg = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$barang'"); 
    $ambildata = mysqli_fetch_array($cekqtyskrg);
    $qtysekarang= $ambildata['qty'];
    $updateqty = $qtysekarang+$qtyro;
    
    $pilihro = mysqli_query($koneksi,"SELECT * FROM retur_o WHERE id_b='$barang' && id_toko='$toko'"); 
    $ambilro = mysqli_fetch_array($pilihro);
    $addtoro = mysqli_query($koneksi,"INSERT INTO retur_o (id_b,id_toko,qtyro) VALUES ('$barang','$toko','$qtyro')");
    $updateqtyro= mysqli_query($koneksi," UPDATE tb_barang set qty='$updateqty' WHERE id_b='$barang'");
    

    if($ambilro && $addtoro && $updateqtyro){
        header('location:returo.php');
    } else {
        echo 'gagal';
        header('location:returo.php');
    }
    // die (mysqli_error($koneksi));
}

if(isset($_POST['hapusro'])){
    $id_b = $_POST['id_b'];
    $idro = $_POST['id_ro'];

    $lihatstock = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$id_b'");
    $stocknya = mysqli_fetch_array($lihatstock);   
    $stockskrg = $stocknya['qty'];// jumlah stock sekarang
    
    $lihatdataskrg = mysqli_query($koneksi,"SELECT * FROM retur_o WHERE id_ro='$idro'"); //lihat qty saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
    $qtyskrggg = $preqtyskrg['qtyro'];//jumlah skrg

    $a = (int)$stockskrg;
    $b = (int)$qtyskrggg;

    $updateee = mysqli_query($koneksi,"UPDATE tb_barang set qty = '".$a - $b."'  WHERE id_b ='".$id_b."' ");
    $hapusdataaa = mysqli_query($koneksi,"DELETE FROM retur_o WHERE id_ro = '".$idro."' ");
    
    // Check apakah ini akan berhasil
    if($updateee && $hapusdataaa == true){
        header('location:returo.php');
        exit;
    }else{
        echo 'gagal';
        header('location:returo.php');
        exit;
    }
};

if(isset($_POST['akuninactive'])){
    $id_u = $_POST['id_u'];

    $cekreq = mysqli_query($koneksi,"UPDATE tb_register SET status = 1  WHERE  id_user='$id_u'");
    if($cekreq == TRUE){
        echo'<script>
        alert("Akun sudah di non-aktifkan, Silahkan klik tombol ok untuk melanjutkan ");
        window.location.href = "user.php"
        </script>';
    }else{
        header("Location:home.php");
    }
};

if(isset($_POST['akunactive'])){
    $id_u = $_POST['id_u'];

    $cekreq = mysqli_query($koneksi,"UPDATE tb_register SET status = 0 WHERE id_user='$id_u'");
    if($cekreq == TRUE){
        echo'<script>
        alert("Akun sudah di aktifkan, Silahkan klik tombol ok untuk melanjutkan ");
        window.location.href = "user.php"
        </script>';
    }else{
        header("Location:home.php");
    }
};

if(isset($_POST['pabrikinactive'])){
    $idp = $_POST['id_p'];

    $cekreq = mysqli_query($koneksi,"UPDATE tb_pabrik SET stat_p = 1  WHERE  id_p='$idp'");
    if($cekreq == TRUE){
        echo'<script>
        alert("Akun sudah di non-aktifkan, Silahkan klik tombol ok untuk melanjutkan ");
        window.location.href = "pabrik.php"
        </script>';
    }else{
        header("Location:home.php");
    }
};

if(isset($_POST['pabrikactive'])){
    $idp = $_POST['id_p'];

    $cekreq = mysqli_query($koneksi,"UPDATE tb_pabrik SET stat_p = 0 WHERE id_p='$idp'");
    if($cekreq == TRUE){
        echo'<script>
        alert("Akun sudah di aktifkan, Silahkan klik tombol ok untuk melanjutkan ");
        window.location.href = "pabrik.php"
        </script>';
    }else{
        header("Location:home.php");
    }
};

if(isset($_POST['tokoinactive'])){
    $idt = $_POST['id_toko'];

    $cekreq = mysqli_query($koneksi,"UPDATE tb_toko SET stat_to = 1  WHERE  id_toko='$idt'");
    if($cekreq == TRUE){
        echo'<script>
        alert("Akun sudah di non-aktifkan, Silahkan klik tombol ok untuk melanjutkan ");
        window.location.href = "toko.php"
        </script>';
    }else{
        header("Location:home.php");
    }
};

if(isset($_POST['tokoactive'])){
    $idt = $_POST['id_toko'];

    $cekreq = mysqli_query($koneksi,"UPDATE tb_toko SET stat_to = 0 WHERE id_toko='$idt'");
    if($cekreq == TRUE){
        echo'<script>
        alert("Akun sudah di aktifkan, Silahkan klik tombol ok untuk melanjutkan ");
        window.location.href = "toko.php"
        </script>';
    }else{
        header("Location:home.php");
    }
};

if(isset($_POST['bmmasalah'])){
    $idm        = $_POST['id_bm'];
    $keterangan = $_POST['keterangan'];
    $qtymas     = $_POST['qtymas'];

    $cekreq = mysqli_query($koneksi,"UPDATE b_masuk SET stat_bm = 2, keterangan = '$keterangan', qtymas = '$qtymas'  WHERE  id_bm='$idm'");

    if($cekreq == TRUE){
        echo'<script>
        alert("Keterangan sudah diinput, Silahkan klik tombol ok untuk melanjutkan ");
        window.location.href = "b_masuk.php"
        </script>';
    }else{
        header("Location:home.php");
    }
};

if(isset($_POST['bmselesai'])){
    $idm = $_POST['id_bm'];

    $cekreq = mysqli_query($koneksi,"UPDATE b_masuk SET stat_bm = 1 WHERE id_bm='$idm'");
    if($cekreq == TRUE){
        echo'<script>
        alert("Barang masuk sudah tidak ada masalah, Silahkan klik tombol ok untuk melanjutkan ");
        window.location.href = "b_masuk.php"
        </script>';
    }else{
        header("Location:home.php");
    }
};
?>