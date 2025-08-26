<?php
include("conection.php");
session_start();
?>
<div class="menu sticky-top ">
    <nav class="navbar navbar-expand-lg header-custom" style="background-color: #248A32;">
        <div class="container-fluid font-header-custom">
            <a class="navbar-branch" href="index.php">
                <img src="image/logo/logochinh.png" height="80">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['TenDangNhap'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="sanpham/index.php" style="color:white;">TẤT CẢ SẢN PHẨM</a>
                        </li>

                        <!-- Search -->

                        <li class="nav-item">
                            <a class="nav-link active" href="cart/index.php" style="color:white;">GIỎ HÀNG</a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <a class="nav-link active" href="sanpham/index.php" style="color:white;">TẤT CẢ SẢN PHẨM</a>
                        <?php
                    }
                    ?>
                    <?php if (isset($_SESSION['TenDangNhap'])) { ?>

                        <li class="nav-item">
                            <a class="nav-link text-white active" href="historyOrder.php">LỊCH SỬ ĐẶT HÀNG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="contact.php">LIÊN HỆ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="ThanhVien/logout.php">ĐĂNG XUẤT</a>
                        </li>

                        <li class="nav-item" style="float: right;">
                            <a type="button" class="btn btn-danger custom-red-btn"
                               href="ThanhVien/profile.php?id=<?php echo $_SESSION['ID_ThanhVien'] ?>"></span> <?php echo $_SESSION['HoVaTen'] ?></a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <div class="d-flex flex-column">
                                <a type="button" class="btn btn-secondary w-50" href="ThanhVien/login.php"
                                   style="color:white">&nbsp;ĐĂNG NHẬP </a>
                                <h8> Bạn chưa đăng nhập? hãy đăng nhập để mua hàng</h8>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <form action="sanpham/index.php" class="navbar-form navbar-right" method="POST">
            <div class="input-group">
                <input type="Search" placeholder="Tìm Kiếm..." class="form-control" name="tukhoa">
                <div class="input-group-btn">
                    <input type="submit" class="btn btn-secondary" name='search' value="Tìm">
                </div>
            </div>
        </form>
    </nav>
</div>



