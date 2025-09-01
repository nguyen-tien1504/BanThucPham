<?php
include("../conection.php");
session_start();
$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : '';
$sql_orderDetail = "select c.TenSanPham,Img,c.SoLuong,c.GiaBan  from chitiethoadon c join sanpham s on c.ID_SanPham  = s.ID_SanPham where c.ID_HoaDon = $orderId";
$query_orderDetail = mysqli_query($mysqli, $sql_orderDetail);

$sql_order = "select h.GiaTien, v.GiaTri  from hoadon h join voucher v on h.ID_Voucher = v.ID_Voucher where ID_HoaDon = $orderId";
$query_order = mysqli_query($mysqli, $sql_order);
$row_order = mysqli_fetch_assoc($query_order);
$totalMoney = $row_order['GiaTien'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset=utf-8>
    <title>Chi tiết hóa đơn</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap/js/bootstrap.bundle.js">
    <link rel="stylesheet" href="../bootstrap/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../themify-icons/themify-icons.css">
    <link rel="shortcut icon" href="https://img.icons8.com/cotton/2x/laptop--v3.png" type="image/png">
</head>

<body>
    <div class="sticky-top">
        <div class="menu sticky-top">
            <nav class="navbar navbar-expand-lg header-custom" style="background-color: #248A32;">
                <div class="container-fluid font-header-custom">
                    <a class="navbar-branch" href="../index.php">
                        <img src="../image/logo/logochinh.png" height="80">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="../index.php" style="color:white;">TẤT CẢ SẢN PHẨM</a>
                            </li>
                            <!-- Search -->
                            <li class="nav-item">
                                <a class="nav-link" href="../cart" style="color:white;">
                                    <i class="fas fa-shopping-cart"></i> GIỎ HÀNG
                                </a>
                            </li>
                            <?php if (isset($_SESSION['TenDangNhap'])) { ?>

                                <li class="nav-item">
                                    <a class="nav-link active" href="../historyOrder.php" style="color:white;">LỊCH SỬ ĐẶT
                                        HÀNG</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../ThanhVien/logout.php" style="color:white;">ĐĂNG XUẤT</a>
                                </li>
                                <li class="nav-item">
                                    <a type="button" class="btn btn-danger custom-red-btn"
                                        href="../ThanhVien/profile.php?id=<?php echo $_SESSION['ID_ThanhVien'] ?>" id="btn"
                                        style="color:white;"></span>
                                        <?php echo $_SESSION['HoVaTen'] ?>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li><a type="button" class="btn btn-secondary" href="../ThanhVien/login.php">&nbsp;ĐĂNG
                                        NHẬP </a></li>
                            <?php } ?>
                        </ul>


                    </div>
                </div>
                <form action="../sanpham/actionSanPham.php?TimKiem" class="navbar-form navbar-right" method="POST">
                    <div class="input-group">
                        <input type="Search" placeholder="Tìm Kiếm..." class="form-control" name="tukhoa">
                        <div class="input-group-btn">
                            <input type="submit" class="btn btn-secondary" name='tim' value="Tìm">
                        </div>
                    </div>
                </form>
            </nav>
        </div>
    </div>
    <div class="container">
        <h2 class="mt-4">Hóa đơn của bạn</h2>
        </br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                while ($row_orderDetail = mysqli_fetch_array($query_orderDetail)) {
                    $i++;
                ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $row_orderDetail['TenSanPham'] ?></td>
                        <td><img src="../image/product/<?= $row_orderDetail['Img'] ?>" style="width:60px;"></td>
                        <td><?= $row_orderDetail['SoLuong'] ?></td>
                        <td><?= number_format($row_orderDetail['GiaBan'], 0, ',', '.')  ?> Đồng/Kg</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <hr>
        <div class="text-right">
            <h5>Tạm tính: <?= number_format($totalMoney + $row_order['GiaTri'], 0, ',', '.')  ?></h5>
            <p class="text-success">Voucher: -<?= number_format($row_order['GiaTri'], 0, ',', '.')  ?></p>
            <h4>Tổng tiền :
                <?= number_format($totalMoney, 0, ',', '.') ?> Đồng
            </h4>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</html>