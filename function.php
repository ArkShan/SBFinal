<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","db_sjm");
if(isset($_POST['registrasi'])){
    $email          = $_POST['email'];
    $nama           = $_POST['namadepan'];
    $namabelakang   = $_POST['namabelakang'];
    $password       = $_POST['password'];
    $database       = mysqli_query($koneksi,"INSERT INTO tb_register (email,namadepan,namabelakang,password) VALUES ('$email','$nama','$namabelakang','$password')"); 

    if($database){
        header('location: login.php');
        
    }else{
        header('location: register.php');
    }
};

// Tombol Submit Barang
if(isset($_POST['addnewbarang'])){
    $kodebarang = $_POST['kode_b'];
    $namabarang = $_POST['nama_b'];
    $tipemobil  = $_POST['tipe_mobil'];
    $kategori   = $_POST['kategori'];
    $harga      = $_POST['harga'];
    $qtyd       = $_POST['pcs_dus'];
    $hargapromo = $_POST['harga_p'];
    $qty       = $_POST['qty'];

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
    $qty        = $_POST['qty'];

    $update = mysqli_query($koneksi,"UPDATE tb_barang set kode_b='$kodebarang',nama_b='$namabarang',tipe_mobil='$tipemobil',kategori='$kategori',harga='$harga',pcs_dus='$qtyd',harga_p='$hargapromo', qty='$qty' WHERE id_b='$idb'");
    if($update){
        header('location:ownertables.php');
    } else {
        echo 'gagal';
        header('location:ownertables.php');
    }
}

// Menghapus Barang
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['id_b'];
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_barang WHERE id_b='$idb'");
    if($hapus){
        header('location:ownertables.php');
    } else {
        echo 'gagal';
        header('location:ownertables.php');
    }
}

if(isset($_POST['barangmasuk'])){
    $barang = $_POST['barang'];
    $pengirim = $_POST['pengirim'];
    $qtym = $_POST['qtym'];
   
    $cekqtyskrg = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$barang'"); 
    $ambildata = mysqli_fetch_array($cekqtyskrg);
    $qtysekarang= $ambildata['qty'];
    $updateqty = $qtysekarang+$qtym;
    
    $pilihbmasuk = mysqli_query($koneksi,"SELECT * FROM b_masuk WHERE id_b='$barang' && id_p='$pengirim'"); 
    $ambilbmasuk = mysqli_fetch_array($pilihbmasuk);
    $addtomasuk = mysqli_query($koneksi,"INSERT INTO b_masuk (id_b,id_p,qtym) VALUES ('$barang','$pengirim','$qtym')");
    $updatesqtymasuk = mysqli_query($koneksi," UPDATE tb_barang set qty='$updateqty' WHERE id_b='$barang'");

    if($ambilbmasuk && $addtomasuk && $updateqtymasuk){
        header('location:gudangmasuk.php');
    } else {
        echo 'gagal';
        header('location:gudangmasuk.php');
    }
}

if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['id_b'];
    $idm = $_POST['id_bm'];
   
    $lihatstock = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);   
    $stockskrg = $stocknya['qty'];// jumlah stock sekarang
    
    $lihatdataskrg = mysqli_query($koneksi,"SELECT * FROM b_masuk WHERE id_bm='$idm'"); //lihat qty saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
    $qtyskrg = $preqtyskrg['qtym'];//jumlah skrg
    
    $selisih = $stockskrg-$qtyskrg;
    $update = mysqli_query($koneksi,"UPDATE tb_barang set qty='$selisih' WHERE id_b='$idb'");
    $hapusdata = mysqli_query($koneksi,"DELETE FROM b_masuk WHERE id_bm='$idm'");
    
    // Check apakah ini akan berhasil
    if($update && $hapusdata){
        header('location : gudangmasuk.php');
    }else{
        header('location : gudangmasuk.php');
    }
};

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
    $updatestokgudang = mysqli_query($koneksi," UPDATE tb_barang set qty='$updateqty' WHERE id_b='$barang'");
    if($ambilbkeluar && $addtokeluar && $updatestokgudang){
        header('location:gudangkeluar.php');
    } else {
        echo 'gagal';
        header('location:gudangkeluar.php');
    }
}

if(isset($_POST['updateuser'])){
    $idu   = $_POST['id_user'];
    $email = $_POST['email'];
    $namad = $_POST['namadepan'];
    $namab = $_POST['namabelakang'];
    $pass  = $_POST['password'];
    $role  = $_POST['role'];

    $update = mysqli_query($koneksi,"UPDATE tb_register set email='$email',namadepan='$namad',namabelakang='$namab',password='$pass' WHERE id_user='$idu'");
    if($update){
        header('location:owneruser.php');
    } else {
        echo 'gagal';
        header('location:owneruser.php');
    }
}

if(isset($_POST['hapususer'])){
    $idu = $_POST['id_user'];
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_register WHERE id_user='$idu'");
    if($hapus){
        header('location:owneruser.php');
    } else {
        echo 'gagal';
        header('location:owneruser.php');
    }
}

if(isset($_POST['tambahtoko'])){
    $namat   = $_POST['nama_toko'];
    $cst     = $_POST['cs_toko'];
    $notelp  = $_POST['no_telp'];
    $alamat  = $_POST['alamat'];
    $wilayah = $_POST['wilayahnya'];
        
    $pilihtoko = mysqli_query($koneksi,"SELECT * FROM tb_toko WHERE id_w = '$wilayah'");
    $ambilwilayah = mysqli_fetch_array($pilihtoko);

    $addtotable = mysqli_query($koneksi,"INSERT INTO tb_toko (id_w,nama_toko,cs_toko,no_telp,alamat) VALUES ('$wilayah','$namat','$cst','$notelp','$alamat')");
    if($addtotable && $ambilwilayah){
        echo "berhasil";
       
    }else{
        echo "error";
    }
}

if(isset($_POST['updatetoko'])){
    $idt   = $_POST['id_toko'];
    $namat = $_POST['nama_toko'];
    $cst = $_POST['cs_toko'];
    $notelp = $_POST['no_telp'];
    $alamat  = $_POST['alamat'];
    $wilayah = $_POST['wilayahnya'];

    $pilihtoko = mysqli_query($koneksi,"SELECT * FROM tb_toko WHERE id_w = '$wilayah'");
    $ambilwilayah = mysqli_fetch_array($pilihtoko);
    $pilihintoko = mysqli_query($koneksi,"SELECT * FROM tb_toko WHERE id_toko = '$idt'");
    $update = mysqli_query($koneksi,"UPDATE tb_toko set id_w='$wilayah',nama_toko='$namat',cs_toko='$cst',no_telp='$notelp',alamat='$alamat' WHERE id_toko='$idt'");

    if($update && $pilihintoko){
        header('location:ownertoko.php');
    } else {
        echo 'gagal';
        header('location:ownertoko.php');
    }
}

if(isset($_POST['hapustoko'])){
    $idt = $_POST['id_toko'];
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_toko WHERE id_toko='$idt'");
    if($hapus){
        header('location:ownertoko.php');
    } else {
        echo 'gagal';
        header('location:ownertoko.php');
    }
}

if(isset($_POST['tambahorder'])){
    $qtyp  = $_POST['qtyp'];
    $nop   = $_POST['no_order'];
    $barang   = $_POST['barangnya'];
    $wilayah   = $_POST['wilayahnya'];
    $toko   = $_POST['tokonya'];

    $addtotable = mysqli_query($koneksi,"INSERT INTO orderan (id_b,id_w,id_toko,no_order,qtyp) WHERE id_b = '$barang'(id_b), id_w = '$wilayah'(id_w), id_toko = '$toko'(id_toko) VALUES ('$barang','$wilayah','$toko','$nop','$qtyp')");
    if($addtotable){
        echo "berhasil";
       
    }else{
        echo "error";
    }
}

if(isset($_POST['hapusorder'])){
    $ido = $_POST['id_o'];
    $hapus = mysqli_query($koneksi, "DELETE FROM orderan WHERE id_o='$ido'");
    if($hapus){
        header('location:salesorder.php');
    } else {
        echo 'gagal';
        header('location:salesorder.php');
    }
}

if(isset($_POST['tambahkategori'])){
    $kategori = $_POST['kategori'];

    $addtotable = mysqli_query($koneksi,"INSERT INTO tb_kategori (kategori) VALUES ('$kategori')");
    if($addtotable){
        echo "berhasil";
       
    }else{
        echo "error";
    }
}

if(isset($_POST['updatekategori'])){
    $idkat    = $_POST['id_kat'];
    $kategori = $_POST['kategori'];

    $update = mysqli_query($koneksi,"UPDATE tb_kategori set kategori='$kategori' WHERE id_kat='$idkat'");
    if($update){
        header('location:ownerkategori.php');
    } else {
        echo 'gagal';
        header('location:ownerkategori.php');
    }
}

if(isset($_POST['hapuskategori'])){
    $idkat   = $_POST['id_kat'];
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_kategori WHERE id_kat='$idkat'");
    if($hapus){
        header('location:ownerkategori.php');
    } else {
        echo 'gagal';
        header('location:ownerkategori.php');
    }
}


// if(isset($_POST['barangnya'])){
//     $idb   = $_POST['id_b'];
//     $pilihbarang = mysqli_query($koneksi,"INSERT INTO orderan (id_b) VALUES ('$idb')");
// }

// if(isset($_POST['wilayahnya'])){
//     $idw   = $_POST['id_w'];
//     $pilihwilayah = mysqli_query($koneksi,"INSERT INTO orderan (id_w) VALUES ('$idw')");
// }

// if(isset($_POST['tokonya'])){
//     $idt   = $_POST['id_t'];
//     $pilihtoko = mysqli_query($koneksi,"INSERT INTO orderan (id_t) VALUES ('$idt')");
// }
?>