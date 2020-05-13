  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="admin.php">
            <i class="fa fa-sign-out"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Main panel</small>
            </span>
          </a>
        </li>

        <li class="treeview">
          <a href="admin.php?p=L_Matakuliah">
            <i class="fa fa-edit"></i> <span>Lihat dan edit data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="admin.php?p=L_Matakuliah"><i class="fa fa-circle-o"></i> Data Matapelajaran</a></li>
            <li><a href="admin.php?p=L_Ruang"><i class="fa fa-circle-o"></i> Data Ruang</a></li>
            <li><a href="admin.php?p=L_Jadwal"><i class="fa fa-circle-o"></i> Data Jadwal</a></li>
            <li><a href="admin.php?p=L_Dosen"><i class="fa fa-circle-o"></i> Data Guru</a></li>
            <li><a href="admin.php?p=L_User"><i class="fa fa-circle-o"></i> Data User</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="admin.php?p=ADD_Dosen">
            <i class="fa fa-plus"></i> <span>Tambah Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="admin.php?p=ADD_Dosen"><i class="fa fa-circle-o"></i> Data Guru</a></li>
            <li><a href="admin.php?p=ADD_Matakuliah"><i class="fa fa-circle-o"></i> Data Matapelajaran</a></li>
            <li><a href="admin.php?p=ADD_Jadwal"><i class="fa fa-circle-o"></i> Data Jadwal</a></li>
            <li><a href="admin.php?p=ADD_Ruang"><i class="fa fa-circle-o"></i> Data Ruang</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="admin.php?p=C_Jadwal">
            <i class="fa fa-search"></i> <span>Cari</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="admin.php?p=C_Jadwal"><i class="fa fa-circle-o"></i> Cari Data Jadwal</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="admin.php?p=g_jadwal">
            <i class="fa fa-star"></i> <span>Generate Jadwal</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="admin.php?p=g_jadwal"><i class="fa fa-circle-o"></i> Lihat Rincian</a></li>

          </ul>
        <li>
          <a href="admin.php?p=logout">
            <i class="fa fa-sign-out"></i> <span>Logout</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">Keluar</small>
            </span>
          </a>
        </li>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>