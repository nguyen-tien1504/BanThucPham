<?php $uri = $_SERVER['REQUEST_URI'];

if (strpos($uri, '/views/') !== false) { ?>
    <nav class="topnav shadow navbar-light bg-white d-flex">
        <div class="navbar-brand"><a href="../index.php">Quản Lý</a></div>
        <div class="nav-right ">
            <div class="btn-group mr-auto">
                <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="plus-icon fas fa-plus-circle"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="../index.php?view=add-product">Thêm sản phẩm</a>
                    <a class="dropdown-item" href="../index.php?view=cat-product">Thêm danh mục</a>
                    <a class="dropdown-item" href="../index.php?view=add-post">Thêm nhà cung cấp</a>
                </div>
            </div>
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    HUTECH
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Tài khoản</a>
                    <a class="dropdown-item" href="logout.php">Thoát</a>
                </div>
            </div>
        </div>
    </nav>
    <div id="sidebar" class="bg-white">
        <ul id="sidebar-menu">
            <li class="nav-link">
                <a href="../index.php?view=dashboard">
                    <div class="nav-link-icon d-inline-flex">
                        <i class="far fa-folder"></i>
                    </div>
                    Bảng thống kê
                </a>
                <i class="arrow fas fa-angle-right"></i>
            </li>
            <li class="nav-link">
                <a href="../index.php?view=list-post">
                    <div class="nav-link-icon d-inline-flex">
                        <i class="far fa-folder"></i>
                    </div>
                    Nhà cung cấp
                </a>
                <i class="arrow fas fa-angle-right"></i>
                <ul class="sub-menu">
                    <li><a href="../index.php?view=add-post">Thêm mới</a></li>
                    <li><a href="../index.php?view=list-post">Danh sách</a></li>
                </ul>
            </li>

            <li class="nav-link">
                <a href="../index.php?view=list-product">
                    <div class="nav-link-icon d-inline-flex">
                        <i class="far fa-folder"></i>
                    </div>
                    Sản phẩm
                </a>
                <i class="arrow fas fa-angle-right"></i>
                <ul class="sub-menu">
                    <li><a href="../index.php?view=add-product">Thêm mới</a></li>
                    <li><a href="../index.php?view=list-product">Danh sách</a></li>
                    <li><a href="../index.php?view=cat-product">Danh mục</a></li>
                </ul>
            </li>
            <li class="nav-link">
                <a href="../index.php?view=list-order">
                    <div class="nav-link-icon d-inline-flex">
                        <i class="far fa-folder"></i>
                    </div>
                    Thống kê doanh thu
                </a>
                <i class="arrow fas fa-angle-right"></i>
                <ul class="sub-menu">
                    <li><a href="../index.php?view=list-order">Đơn hàng</a></li>
                </ul>
            </li>
            <li class="nav-link">
                <a href="../index.php?view=list-user">
                    <div class="nav-link-icon d-inline-flex">
                        <i class="far fa-folder"></i>
                    </div>
                    Quản Lý Thành Viên
                </a>
                <i class="arrow fas fa-angle-right"></i>

                <ul class="sub-menu">
                    <li><a href="../index.php?view=list-user">Danh sách</a></li>
                </ul>
            </li>
        </ul>
    </div>
<?php } else { ?>
    <nav class="topnav shadow navbar-light bg-white d-flex">
        <div class="navbar-brand"><a href="index.php">Quản Lý</a></div>
        <div class="nav-right ">
            <div class="btn-group mr-auto">
                <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="plus-icon fas fa-plus-circle"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="?view=add-product">Thêm sản phẩm</a>
                    <a class="dropdown-item" href="?view=cat-product">Thêm danh mục</a>
                    <a class="dropdown-item" href="?view=add-post">Thêm nhà cung cấp</a>
                </div>
            </div>
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    HUTECH
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Tài khoản</a>
                    <a class="dropdown-item" href="logout.php">Thoát</a>
                </div>
            </div>
        </div>
    </nav>
    <div id="sidebar" class="bg-white">
        <ul id="sidebar-menu">
            <li class="nav-link">
                <a href="?view=dashboard">
                    <div class="nav-link-icon d-inline-flex">
                        <i class="far fa-folder"></i>
                    </div>
                    Bảng thống kê
                </a>
                <i class="arrow fas fa-angle-right"></i>
            </li>
            <li class="nav-link">
                <a href="?view=list-post">
                    <div class="nav-link-icon d-inline-flex">
                        <i class="far fa-folder"></i>
                    </div>
                    Nhà cung cấp
                </a>
                <i class="arrow fas fa-angle-right"></i>
                <ul class="sub-menu">
                    <li><a href="?view=add-post">Thêm mới</a></li>
                    <li><a href="?view=list-post">Danh sách</a></li>
                </ul>
            </li>

            <li class="nav-link">
                <a href="?view=list-product">
                    <div class="nav-link-icon d-inline-flex">
                        <i class="far fa-folder"></i>
                    </div>
                    Sản phẩm
                </a>
                <i class="arrow fas fa-angle-right"></i>
                <ul class="sub-menu">
                    <li><a href="?view=add-product">Thêm mới</a></li>
                    <li><a href="?view=list-product">Danh sách</a></li>
                    <li><a href="?view=cat-product">Danh mục</a></li>
                </ul>
            </li>
            <li class="nav-link">
                <a href="?view=list-order">
                    <div class="nav-link-icon d-inline-flex">
                        <i class="far fa-folder"></i>
                    </div>
                    Thống kê doanh thu
                </a>
                <i class="arrow fas fa-angle-right"></i>
                <ul class="sub-menu">
                    <li><a href="?view=list-order">Đơn hàng</a></li>
                </ul>
            </li>
            <li class="nav-link">
                <a href="?view=list-user">
                    <div class="nav-link-icon d-inline-flex">
                        <i class="far fa-folder"></i>
                    </div>
                    Quản Lý Thành Viên
                </a>
                <i class="arrow fas fa-angle-right"></i>

                <ul class="sub-menu">
                    <li><a href="?view=list-user">Danh sách</a></li>
                </ul>
            </li>
        </ul>
    </div>
<?php } ?>