<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('AdminLTE-2/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Alexander Pierce</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li>
            <a href="/dashboard">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
              </span>
            </a>
          </li>
      <li class="header">MASTER</li>
    </li>
    
  <li>
      <a href="{{ route('category.index') }}">
        <i class="fa fa-cubes"></i> <span>Category</span>
        <span class="pull-right-container">
        </span>
      </a>
    </li>
  <li>
      <a href="{{ route('produk.index') }}">
        <i class="fa fa-cubes"></i> <span>Produk</span>
        <span class="pull-right-container">
        </span>
      </a>
    </li>
        <li>
            <a href="{{ route('member.index') }}">
              <i class="fa fa-id-card"></i> <span>Member</span>
              <span class="pull-right-container">
              </span>
            </a>
          </li>
        
        <li>
            <a href="{{ route('supplier.index') }}">
              <i class="fa fa-id-card"></i> <span>Supplier</span>
              <span class="pull-right-container">
              </span>
            </a>
          </li>
        
        <li class="header">TRANSAKSI</li>
        <li>
          <a href="{{ route('pengeluaran.index') }}">
            <i class="fa fa-money"></i> <span>Pengeluaran</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li>
          <a href="{{ route('pembelian.index') }}">
            <i class="fa fa-download"></i> <span>Pembelian</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-upload"></i> <span>Penjualan</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-cart-arrow-down"></i> <span>Transaksi Lama</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-cart-arrow-down"></i> <span>Transaksi Baru</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li class="header">REPORT</li>
        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-file-pdf-o"></i> <span>Laporan</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li class="header">SYSTEM</li>
        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-user"></i> <span>User</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-cogs"></i> <span>Pengaturan</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
  </section>
  <!-- /.sidebar -->
</aside>
