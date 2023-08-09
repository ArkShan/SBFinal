<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="home.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <?php if($_SESSION['role'] == "Owner"){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                    Owner
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="b_masuk.php">Barang Masuk</a>
                                        <a class="nav-link" href="masuk-revisi.php">Barang Masuk Revisi</a>
                                        <a class="nav-link" href="b_keluar.php">Barang Keluar</a>
                                        <a class="nav-link" href="keluar-revisi.php">Barang Keluar Revisi</a>
                                        <a class="nav-link" href="tables.php">List Barang</a>
                                        <a class="nav-link" href="user.php">List User</a>
                                        <a class="nav-link" href="toko.php">List Toko</a>
                                        <a class="nav-link" href="order.php">List Order</a>
                                        <a class="nav-link" href="order-revisi.php">List Order Revisi</a>
                                        <a class="nav-link" href="pabrik.php">List Pabrik</a>
                                        <a class="nav-link" href="returp.php">Retur Pabrik</a>
                                        <a class="nav-link" href="revisi-returp.php">Retur Pabrik Revisi</a>
                                        <a class="nav-link" href="returo.php">Retur Order</a>
                                        <a class="nav-link" href="revisi-returp.php">Retur Order Revisi</a>
                                        <a class="nav-link" href="list-lapmasuk.php">Laporan Barang Masuk</a>
                                        <a class="nav-link" href="list-lapkeluar.php">Laporan Barang Keluar</a>
                                    </nav>
                                </div>
                            <?php }; ?>
                            <?php if($_SESSION['role'] == "Admin"){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                    Administrasi
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="b_masuk.php">Barang Masuk</a>
                                        <a class="nav-link" href="masuk-revisi.php">Barang Masuk Revisi</a>
                                        <a class="nav-link" href="b_keluar.php">Barang Keluar</a>
                                        <a class="nav-link" href="keluar-revisi.php">Barang Keluar Revisi</a>
                                        <a class="nav-link" href="tables.php">List Barang</a>
                                        <a class="nav-link" href="toko.php">List Toko</a>
                                        <a class="nav-link" href="order.php">List Order</a>
                                        <a class="nav-link" href="order-revisi.php">List Order Revisi</a>
                                        <a class="nav-link" href="pabrik.php">List Pabrik</a>
                                        <a class="nav-link" href="returp.php">Retur Pabrik</a>
                                        <a class="nav-link" href="revisi-returp.php">Retur Pabrik Revisi</a>
                                        <a class="nav-link" href="returo.php">Retur Order</a>
                                        <a class="nav-link" href="revisi-returp.php">Retur Order Revisi</a>
                                        <a class="nav-link" href="list-lapmasuk.php">Laporan Barang Masuk</a>
                                        <a class="nav-link" href="list-lapkeluar.php">Laporan Barang Keluar</a>   
                                    </nav>
                                </div>     
                            <?php }; ?>
                            <?php if($_SESSION['role'] == "Gudang"){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                    Pergudangan
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="b_masuk.php">Barang Masuk</a>
                                        <a class="nav-link" href="masuk-revisi.php">Barang Masuk Revisi</a>
                                        <a class="nav-link" href="b_keluar.php">Barang Keluar</a>
                                        <a class="nav-link" href="keluar-revisi.php">Barang Keluar Revisi</a>
                                        <a class="nav-link" href="tables.php">List Barang</a>
                                        <a class="nav-link" href="order.php">List Order</a>
                                        <a class="nav-link" href="order-revisi.php">List Order Revisi</a>
                                        <a class="nav-link" href="returp.php">Retur Pabrik</a>
                                        <a class="nav-link" href="revisi-returp.php">Retur Pabrik Revisi</a>
                                        <a class="nav-link" href="returo.php">Retur Order</a>
                                        <a class="nav-link" href="revisi-returp.php">Retur Order Revisi</a>
                                    </nav>
                                </div>
                            <?php }; ?>
                            <?php if($_SESSION['role'] == "Sales"){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                    Sales
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="tables.php">List Barang</a>
                                        <a class="nav-link" href="order.php">List Orderan</a>
                                    </nav>
                                </div>
                            <?php }; ?>
                        </div>
                    </div>
                    <?php if($_SESSION['role'] == "Owner"){?>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Owner
                    </div>
                    <?php }; ?>
                    <?php if($_SESSION['role'] == "Admin"){?>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Administrasi
                    </div>
                    <?php }; ?>
                    <?php if($_SESSION['role'] == "Gudang"){?>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Kepala Gudang
                    </div>
                    <?php }; ?>
                    <?php if($_SESSION['role'] == "Sales"){?>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Sales
                    </div>
                    <?php }; ?>
                </nav>