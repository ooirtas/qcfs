<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav"> 
    <li class="nav-heading">Dashboard</li>      
        <li class="nav-item">
            <a class="nav-link {{ str_contains(strtolower($title), 'dashboard') ? '' : 'collapsed' }}"
                href="{{ route('Dashboard.dashboard') }}">
                <i class="bi bi-house-door-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <br/>
        <li class="nav-heading">Master</li>
        <li class="nav-item">
            <a class="nav-link {{ str_contains(strtolower($title), 'barang') ? '' : 'collapsed' }}"
                href="{{ route('barangs.index') }}">
                <i class="bi bi-box"></i>
                <span>Barang</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ str_contains(strtolower($title), 'produksi') ? '' : 'collapsed' }}"
                href="{{ route('produksi.index') }}">
                <i class="bi bi-gear"></i>
                <span>Produksi</span>
            </a>
        </li>

        <br/>
        <li class="nav-heading">Transaksi</li>
        <li class="nav-item">
            <a class="nav-link {{ str_contains(strtolower($title), 'prosesproduksi') ? '' : 'collapsed' }}"
                href="{{ route('ProsesProduksi.index') }}">
                <i class="bi bi-tools"></i>
                <span>Proses Produksi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ str_contains(strtolower($title), 'qualitycontrol') ? '' : 'collapsed' }}"
                href="{{ route('qualityControls.index') }}">
                <i class="bi bi-grid"></i>
                <span>Quality Control</span>
            </a>
        </li>

        <br/>
        <li class="nav-heading">Settings</li>
        <li class="nav-item">
            <a class="nav-link {{ str_contains(strtolower($title), 'logout') ? '' : 'collapsed' }}"
                href="{{ route('/') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
