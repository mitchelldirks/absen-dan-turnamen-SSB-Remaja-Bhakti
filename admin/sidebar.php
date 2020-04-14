<div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Home</li>
                                <li>
                                    <a href="index.php" class="mm-active">
                                        <i class="metismenu-icon pe-7s-rocket"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li class="app-sidebar__heading"><?=$_SESSION['level']?></li>
                                <?php if ($_SESSION['level']=='admin' || $_SESSION['level']=='Admin' || $_SESSION['level']=='ADMIN'){ ?>
                                <li>
                                    <a href="#" >
                                        <i class="metismenu-icon pe-7s-users"></i>
                                        User
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="?p=user">
                                                <i class="metismenu-icon"></i>
                                                Data User
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" >
                                        <i class="metismenu-icon pe-7s-user"></i>
                                        Pelatih
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="?p=pelatih">
                                                <i class="metismenu-icon"></i>
                                                Data Pelatih
                                            </a>
                                        </li>
                                        <!-- <li>
                                            <a href="agenda.php?p=pelatih">
                                                <i class="metismenu-icon"></i>
                                                Agenda Pelatih
                                            </a>
                                        </li> -->
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" >
                                        <i class="metismenu-icon pe-7s-add-user"></i>
                                        Murid
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="?p=murid">
                                                <i class="metismenu-icon"></i>
                                                Data Murid
                                            </a>
                                        </li>
                                        <li>
                                            <a href="print.php?p=murid&act=report">
                                                <i class="metismenu-icon"></i>
                                                Laporan Murid
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" >
                                        <i class="metismenu-icon pe-7s-date"></i>
                                        Jadwal
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="?p=latihan">
                                                <i class="metismenu-icon"></i>
                                                Latihan
                                            </a>
                                        </li>
                                        <li>
                                            <a href="?p=turnamen">
                                                <i class="metismenu-icon"></i>
                                                Turnamen / Kompetisi
                                            </a>
                                        </li>
                                        <li>
                                            <a href="?p=agenda">
                                                <i class="metismenu-icon"></i>
                                                Agenda
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php }elseif ($_SESSION['level']=='pelatih' || $_SESSION['level']=='Pelatih' || $_SESSION['level']=='PELATIH') { ?>
                                <li>
                                    <a href="#" >
                                        <i class="metismenu-icon pe-7s-note2"></i>
                                        Absensi
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="?p=absen">
                                                <i class="metismenu-icon"></i>
                                                Absensi
                                            </a>
                                        </li>
                                        <li>
                                            <a href="?p=filter&print=absen">
                                                <i class="metismenu-icon"></i>
                                                Laporan Absensi
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" >
                                        <i class="metismenu-icon fa fa-trophy"></i>
                                        Turnamen
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="?p=turnamen&act=seleksi">
                                                <i class="metismenu-icon"></i>
                                                Daftar Pemain
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php }else{
                                
                            } ?>


                                <!-- <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-car"></i>
                                        Components
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="components-tabs.html">
                                                <i class="metismenu-icon">
                                                </i>Tabs
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </li> -->
                                
                            </ul>
                        </div>
                    </div>
                </div>   