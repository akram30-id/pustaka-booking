<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book-open"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Pustaka Booking</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li <?php if($where == "admin"){$here = 'active';}else{$here = '';} ?> class="nav-item <?= $here; ?>">
        <a class="nav-link" href="<?= base_url(); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <li <?php if($where == "kategori_buku"){$here = 'active';}else{$here = '';} ?> class="nav-item <?= $here; ?>">
        <a class="nav-link" href="<?= base_url() . 'buku/kategori'; ?>">
            <i class="fas fa-atlas"></i>
            <span>Kategori Buku</span></a>
    </li>

    <li <?php if($where == "data_buku"){$here = 'active';}else{$here = '';} ?> class="nav-item <?= $here; ?>">
        <a class="nav-link" href="<?= base_url() . 'buku'; ?>">
            <i class="fas fa-book"></i>
            <span>Data Buku</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-users"></i>
            <span>Data Anggota</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->