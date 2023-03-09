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
    // $keterangan= $_POST['keterangan'];

    $addtotable = mysqli_query($koneksi,"INSERT INTO tb_barang (kode_b,nama_b,tipe_mobil,kategori,harga,pcs_dus,harga_p) VALUES ('$kodebarang','$namabarang','$tipemobil','$kategori','$harga','$qtyd','$hargapromo')");
    if($addtotable){
        echo "berhasil";
       
    }else{
        echo "error";
    }
}

if(isset($_POST['updatebarang'])){
    $idb       = $_POST['id_b'];
    $kodebarang = $_POST['kode_b'];
    $namabarang = $_POST['nama_b'];
    $tipemobil  = $_POST['tipe_mobil'];
    $kategori   = $_POST['kategori'];
    $harga      = $_POST['harga'];
    $qtyd       = $_POST['pcs_dus'];
    $hargapromo = $_POST['harga_p'];

    $update = mysqli_query($koneksi,"UPDATE tb_barang set kode_b='$kodebarang',nama_b='$namabarang',tipe_mobil='$tipemobil',kategori='$kategori',harga='$harga',pcs_dus='$qtyd',harga_p='$hargapromo' WHERE id_b='$idb'");
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
    $tambahkanstocksekarangdenganquantity = $qtysekarang+$qtym;

    $addtomasuk = mysqli_query($koneksi,"INSERT INTO b_masuk (id_b,qtym,pengirim) VALUES ('$barang','$qtym','$pengirim')");
    $updatesqtymasuk = mysqli_query($koneksi," UPDATE tb_barang set qty='$tambahkanstocksekarangdenganquantity' WHERE id_b='$barang'");
    if($addtomasuk && $updateqtymasuk){
        header('location:gudangmasuk.php');
    } else {
        echo 'gagal';
        header('location:gudangmasuk.php');
    }
}

if(isset($_POST['updatebarangmasuk']))
{
    $idb = $_POST ['id_b'];
    $idm = $_POST ['id_bm'];
    $namabarang = $_POST ['nama_b'];
    $kategori= $_POST ['kategori'];
    $keterangan= $_POST ['pengirim'];
    $qtym = $_POST ['qtym'];

    $lihatstock = mysqli_query($koneksi,"SELECT * FROM tb_barang where id_b='$idb'"); //lihat stock
    $stocknya = mysqli_fetch_array($lihatstock);// mengambil data
    $stockskrg=$stocknya['qty'];
    
    $qtyskrg= mysqli_query($koneksi,"SELECT * FROM b_masuk WHERE id_bm='$idm'");//lihat qty saat ini
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qtym'];

    if($qty>=$qtyskrg){ 
        //ternyata inputan baru lebih besar jumlah masuknya, maka tambahi lagi stock barang
        $selisih=$stockskrg-$qtyskrg;
        $tambahinstock= $stockskrg + $selisih;
        $updatenya = mysqli_query($koneksi, "UPDATE tb_barang set qty='$tambahinstock'WHERE id_b='$idb'");
        $kurangistocknya = mysqli_query($koneksi,"UPDATE b_masuk set qtym='$qtym', pengirim='$keterangan'WHERE id_bm='$idm'");

        if($kurangistocknya&&$updatenya){
            header('location :gudangmasuk.php');
        }else{
            echo 'gagal say';
            header('location:gudanghome.php');
        } 

    }else {
        //ternyata inputan baru lebih kecil jumlah masuknya, maka kurangi lagi stock barang
        $selisih = $qtyskrg-$qty;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($koneksi,"UPDATE tb_barang set qty='$kurangin' WHERE id_b='$idb'");
        $updatenya = mysqli_query($koneksi, "UPDATE b_masuk set qtym='$qtym', penerima='$keterangan' WHERE id_bm='$idm'");

        if($kurangistocknya&&$updatenya){
            header(' location:gudangmasuk.php');
        }else{
            echo 'gagal say';
            header(' location:gudanghome.php');
        }
    }
}

// Menghapus barang masuk 
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
        header('location : gudanghome.php');
    }
};

if(isset($_POST['barangkeluar'])){
    $barang = $_POST['barang'];
    $tujuan = $_POST['tokonya'];
    $qtyk = $_POST['qtyk'];
   
    $cekstocksekarang = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$barang'"); 
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang= $ambildatanya['qty'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$qtyk;

    $addtokeluar = mysqli_query($koneksi," INSERT INTO b_keluar (id_bk, qtyk, tujuan) VALUES ('$barang','$qtyk','$tujuan')");
    $updatestokgudang = mysqli_query($koneksi," UPDATE tb_barang set qty='$tambahkanstocksekarangdenganquantity' WHERE id_b='$barang'");
    if($addtokeluar && $updatestokgudang){
        header('location:gudangkeluar.php');
    } else {
        echo 'gagal';
        header('location:gudanghome.php');
    }
}

if(isset($_POST['updatebarangkeluar'])){
    $idk        = $_POST['id_bk'];
    $idb        = $_POST['id_b'];
    $qty       = $_POST['qtyk'];
    $tujuan     = $_POST['tokonya'];

    $lihatstock = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE id_b='$idb'"); //lihat stock barang itu saat ini
    $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
    $stockskrg = $stocknya['qty'];//jumlah stocknya skrg

    $lihatdataskrg = mysqli_query($koneksi,"SELECT * FROM b_keluar WHERE id_bk='$idk'"); //lihat qty saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
    $qtyskrg = $preqtyskrg['qtyk'];//jumlah skrg

    if($qty >= $qtyskrg){
        //ternyata inputan baru lebih besar jumlah keluarnya, maka kurangi lagi stock barang
        $hitungselisih = $qty-$qtyskrg;
        $kurangistock = $stockskrg-$hitungselisih;

        $queryx = mysqli_query($koneksi,"UPDATE tb_barang SET qty='$kurangistock' WHERE id_b='$idb'");
        $updatedata1 = mysqli_query($koneksi,"UPDATE b_keluar SET qtyk='$qty',tujuan='$tujuan' WHERE id_bk='$idk'");
        
        //cek apakah berhasil
        if ($updatedata1 && $queryx){
            echo 'Berhasil Diubah';
        } else { 
            echo 'gagal';
        };


    } else {
        //ternyata inputan baru lebih kecil jumlah keluarnya, maka tambahi lagi stock barang
        $hitungselisih = $qtyskrg-$qty;
        $tambahistock = $stockskrg+$hitungselisih;

        $query1 = mysqli_query($koneksi,"UPDATE tb_barang SET qty='$tambahistock' WHERE id_b='$idb'");

        $updatedata = mysqli_query($koneksi,"UPDATE b_keluar SET qtyk='$qtyk', tujuan='$tujuan' WHERE id_bk='$idk'");
        
        //cek apakah berhasil
        if ($query1 && $updatedata){
            echo 'Berhasil Diubah';
        } else { 
            echo 'gagal';
        };

    };        
};

if(isset($_POST['updateuser'])){
    $idu   = $data['id_user'];
    $email = $data['email'];
    $namad = $data['namadepan'];
    $namab = $data['namabelakang'];
    $pass  = $data['password'];
    $role  = $data['role'];

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
    $idt   = $data['id_toko'];
    $namat = $data['nama_toko'];
    $cst = $data['cs_toko'];
    $notelp = $data['no_telp'];
    $alamat  = $data['alamat'];
    $wilayah  = $data['wilayah'];

    $addtotable = mysqli_query($koneksi,"INSERT INTO tb_toko (nama_toko,cs_toko,no_telp,alamat,wilayah) VALUES ('$namat','$cst','$notelp','$alamat','$wilayah')");
    if($addtotable){
        echo "berhasil";
       
    }else{
        echo "error";
    }
}

if(isset($_POST['updatetoko'])){
    $idt   = $data['id_toko'];
    $namat = $data['nama_toko'];
    $cst = $data['cs_toko'];
    $notelp = $data['no_telp'];
    $alamat  = $data['alamat'];
    $wilayah  = $data['wilayah'];

    $update = mysqli_query($koneksi,"UPDATE tb_toko set nama_toko'$namat',cs_toko='$cst',no_telp='$notelp',alamat='$alamat',wilayah='$wilayah' WHERE id_user='$idu'");
    if($update){
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
    $ido        = $data['id_o'];
    $nop        = $data['no_order'];
    $kodeb      = $data['kode_b'];
    $namab      = $data['nama_b'];
    $wilayah    = $data['wilayah'];
    $Harga      = $data['harga'];
    $total      = $qtyp * $Harga;
    $tglo       = $data['tgl_order'];
    $qtyp       = $data['qtyp'];
    $barang     = $data['barangnya'];

    $addtotable = mysqli_query($koneksi,"INSERT INTO orderan (no_order,qtyp,tgl_order) VALUES ('$nop','$qtyp','$tglo')");
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

if(isset($_POST['printorder'])){
    $ido = $_POST['id_o'];
    $nop = $_POST['no_order'];
    $print = mysqli_query($koneksi, "SELECT * FROM orderan WHERE id_o='$ido'");
    if($print){
        header('location:saleslap_or.php');
    } else {
        echo 'gagal';
        header('location:saleslap_or.php');
    }
}
?>