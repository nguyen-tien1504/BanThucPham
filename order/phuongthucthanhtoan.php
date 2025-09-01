<?php
include("../conection.php");
session_start();
// Lấy thông tin đơn hàng và khách hàng
$ID_ThanhVien = isset($_GET['id']) ? $_GET['id'] : '';
$sql_getOrder = "SELECT * FROM hoadon WHERE ID_ThanhVien='$ID_ThanhVien' ORDER BY ID_HoaDon DESC limit 1";
$query_getOrder = mysqli_query($mysqli, $sql_getOrder);
$row_getOrder = mysqli_fetch_array($query_getOrder);
$sql_getCus = "SELECT * FROM thanhvien WHERE ID_ThanhVien='$ID_ThanhVien' ORDER BY ID_ThanhVien DESC";
$query_getCus = mysqli_query($mysqli, $sql_getCus);
$row_getCus = mysqli_fetch_array($query_getCus);

if (isset($_POST['dathang'])) {
    $ID_HoaDon = $row_getOrder['ID_HoaDon'];
    $voucher_discount = isset($_SESSION['voucher_discount']) ? $_SESSION['voucher_discount'] : 0;
    $moneyAfterDiscount = $row_getOrder['GiaTien'] - $voucher_discount;
    $sql_updateOrderMoney = "update hoadon set GiaTien = '$moneyAfterDiscount' where ID_HoaDon='$ID_HoaDon'";
    $query_updateOrderMoney = mysqli_query($mysqli, $sql_updateOrderMoney);

    foreach ($_SESSION['cart'] as $item) {
        $ID_SanPham = $item['ID_SanPham'];
        $SoLuong = $item['qty'];
        $GiaBan = $item['GiaBan'];
        $TenSanPham = $item['TenSanPham'];
        $sql_insertDetail = "INSERT INTO chitiethoadon (ID_HoaDon, ID_SanPham, TenSanPham, SoLuong, GiaBan) 
            VALUES ('$ID_HoaDon', '$ID_SanPham', '$TenSanPham', '$SoLuong', '$GiaBan')";
        mysqli_query($mysqli, $sql_insertDetail);
    }

    $option = isset($_POST['selectPay']) ? $_POST['selectPay'] : false;
    if ($option) {
        if ($_POST['selectPay'] == "shipcod") {
            header('location:dathang.php');
        } else if ($_POST['selectPay'] == "shipchuyenkhoan") {
            header('location:finish.php');
        }
    } else {
        echo "task option is required";
        exit;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset=utf-8>
    <title>Sản phẩm</title>
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
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="../sanpham/index.php" style="color:white;">TẤT CẢ SẢN
                                    PHẨM</a>
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
                                <li><a type="button" class="btn btn-secondary" href="../ThanhVien/login.php">&nbsp;ĐĂNG NHẬP
                                    </a></li>
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

    <main role="main">
        <!-- Block content - Đục lỗ trên giao diện bố cục chung, đặt tên là `content` -->
        <div class="container mt-4">
            <form class="needs-validation" name="frmthanhtoan" method="post" action="#">
                <input type="hidden" name="kh_tendangnhap" value="dnpcuong">

                <div class="py-5 text-center">
                    <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
                    <h2>Thanh toán</h2>
                    <p class="lead">Vui lòng kiểm tra thông tin Khách hàng, thông tin Giỏ hàng trước khi Đặt hàng.</p>
                </div>

                <div class="row">
                    <div class="col-md-6 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Giỏ hàng</span>
                            <span class="badge badge-secondary badge-pill">2</span>
                        </h4>
                        <div class="tableInfo">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Giá tiền</th>
                                    </tr>
                                </thead>
                                <?php
                                $i = 0;
                                if (isset($_SESSION['cart'])) {
                                ?>
                                    <tbody>
                                        <?php foreach ($_SESSION['cart'] as $key => $value) {
                                            $i++;
                                        ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $value['TenSanPham'] ?></td>
                                                <td><?= $value['qty'] ?></td>
                                                <td><?= number_format($value['GiaBan']) ?> Đồng</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                <?php
                                } else {
                                    echo "<h4>Không có gì trong giỏ hàng</h4>";
                                }
                                ?>
                            </table>


                            <!-- Form nhập mã giảm giá -->
                            <form method="POST">
                                <label for="voucher_code">Mã giảm giá:</label>
                                <input type="text" name="voucher_code" class="form-control"
                                    placeholder="Nhập mã voucher nếu có">
                                <button type="submit" name="submit_voucher" class="btn btn-success mt-2">Áp dụng</button>
                            </form>
                            <?php
                            $voucher_code;
                            $voucher_discount = 0;
                            if (isset($_POST['submit_voucher'])) {
                                $voucher_code = $_POST['voucher_code'];
                                $sql_voucher = "SELECT * FROM voucher WHERE MaVoucher = '$voucher_code'";
                                $query_sqlVoucher = mysqli_query($mysqli, $sql_voucher);
                                if (mysqli_num_rows($query_sqlVoucher) == 0) {
                                    echo "<p style='color:red;'>Mã voucher không tồn tại!</p>";
                                } else {
                                    $row_sqlVoucher = mysqli_fetch_array($query_sqlVoucher);
                                    if ($row_sqlVoucher['SoLuong'] <= 0) {
                                        echo "<p style='color:red;'>Mã voucher đã hết lượt sử dụng!</p>";
                                    } else {
                                        echo "<p style='color:green;'>Áp dụng mã voucher thành công! Giảm giá: " . number_format($row_sqlVoucher['GiaTri']) . " Đồng</p>";
                                        $voucher_discount = $row_sqlVoucher['GiaTri'];
                                        $_SESSION['voucher_discount'] = $row_sqlVoucher['GiaTri'];
                                    }
                                }
                            }
                            ?>
                            <div class="total-price">
                                <?php if (isset($voucher_code)) { ?>
                                    <div class="discounted-price">
                                        <h5>Giảm giá Voucher: <?= number_format($voucher_discount) ?> Đồng</h5>
                                    </div>
                                    <h5 class="final-price">Tổng tiền sau giảm
                                        giá: <?= number_format($row_getOrder['GiaTien'] - $voucher_discount) ?> Đồng</h5>
                                <?php } else { ?>
                                    <div class="normal-price">
                                        <h5>Tổng tiền: <?= number_format($row_getOrder['GiaTien']) ?> Đồng</h5>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Thông tin khách hàng</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="kh_ten">Họ tên</label>
                            <input type="text" class="form-control" name="kh_ten" id="kh_ten"
                                value="<?php echo $row_getCus['HoVaTen'] ?>" readonly="">
                        </div>
                        <div class="col-md-12">
                            <label for="kh_diachi">Địa chỉ</label>
                            <input type="text" class="form-control" name="kh_diachi" id="kh_diachi"
                                value="<?php echo $row_getOrder['DiaChi'] ?>" readonly="">
                        </div>
                        <div class="col-md-12">
                            <label for="kh_dienthoai">Điện thoại</label>
                            <input type="text" class="form-control" name="kh_dienthoai" id="kh_dienthoai"
                                value="<?php echo $row_getCus['SoDienThoai'] ?>" readonly="">
                        </div>
                        <div class="col-md-12">
                            <label for="kh_email">Email</label>
                            <input type="text" class="form-control" name="kh_email" id="kh_email"
                                value="<?php echo $row_getCus['Email'] ?>" readonly="">
                        </div>
                        <div class="col-md-12">
                            <label for="kh_ghiChu">Ghi Chú</label>
                            <input type="text" class="form-control" name="kh_ngaysinh" id="kh_ngaysinh"
                                value="<?php echo $row_getOrder['GhiChu'] ?>" readonly="">
                        </div>
                        <div class="col-md-12">
                            <label for="kh_cmnd">Tổng tiền</label>
                            <input type="text" class="form-control" name="kh_cmnd" id="kh_cmnd"
                                value="<?= number_format($row_getOrder['GiaTien'] - $voucher_discount) ?>" readonly="">
                        </div>
                    </div>

                    <form action="" method="POST">
                        <label for="kh_hinhThucThanhToan">Phương Thức Thanh toán</label>
                        </br>
                        <select class="form-select" aria-label=".form-select-lg example" name="selectPay">
                            <option value="shipchuyenkhoan" selected>Thanh toán bằng thẻ</option>
                            <option value="shipcod">Thanh toán khi nhận hàng</option>
                        </select>
                        </br>
                        </br>

                        &nbsp;&nbsp;&nbsp;
                        <input type="submit" class="btn btn-info" name='dathang' value="Đặt hàng">
                        <a class="btn btn-primary" href="suaOrder.php?id=<?php echo $row_getOrder['ID_HoaDon']; ?>">
                            &nbsp;Sửa lại thông tin giao hàng</a>
                    </form>
                </div>
        </div>
        </form>

        </div>
        <!-- End block content -->
    </main>

    <hr class="hr--large">
    <div class="space" style="text-align: center; background-color: white ">
        <img src="../image/thanhspace.PNG">


        <p class="site-footer__copyright-content">
            © 2025,
            <a href="http://localhost/BanThucPham/index.php" \title="" style=" color: red"> HUTECH</a>
    </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/popperjs/popper.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Custom script - Các file js do mình tự viết -->
<script src="../assets/js/app.js"></script>

</html>

<style>
    /* CSS cho bảng */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #f9f9f9;
    }

    .table th,
    .table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
        color: #333;
    }

    .table th {
        background-color: #248A32;
        color: white;
        font-weight: bold;
    }

    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tr:hover {
        background-color: #e0e0e0;
    }

    /* CSS cho tổng tiền */
    .final-price {
        font-size: 24px;
        font-weight: bold;
        color: #248A32;
        /* Màu xanh đặc trưng */
        background-color: #f0f8f0;
        /* Nền sáng nhẹ để làm nổi bật */
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin-top: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Đổ bóng nhẹ để nổi bật hơn */
    }

    .total-price h5 {
        font-size: 20px;
        font-weight: 600;
        color: #333;
        margin: 10px 0;
    }

    /* Tổng tiền (khi chưa áp dụng mã giảm giá) */
    .total-price .normal-price {
        font-size: 20px;
        font-weight: 600;
        color: #555;
        /* Màu xám nhạt cho tổng tiền ban đầu */
        padding: 8px 10px;
        background-color: #f9f9f9;
        border-radius: 5px;
        text-align: center;
        margin-top: 10px;
        border: 1px solid #ddd;
    }

    .total-price .normal-price strong {
        color: #248A32;
        /* Màu xanh cho số tiền */
    }

    /* Tạo sự khác biệt cho trường hợp đã áp dụng mã giảm giá */
    .total-price .discounted-price {
        font-size: 22px;
        font-weight: 600;
        color: #d9534f;
        /* Màu đỏ cho phần giảm giá */
        padding: 10px 15px;
        background-color: #ffe5e5;
        border-radius: 5px;
        margin-top: 15px;
        border: 1px solid #d9534f;
        text-align: center;
    }

    .final-price {
        font-size: 24px;
        font-weight: bold;
        color: #248A32;
        /* Màu xanh đặc trưng */
        background-color: #f0f8f0;
        /* Nền sáng nhẹ để làm nổi bật */
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin-top: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Đổ bóng nhẹ để nổi bật hơn */
    }


    /* Form nhập mã giảm giá */
    form {
        margin-bottom: 20px;
    }

    form label {
        font-weight: bold;
        margin-right: 10px;
    }

    form input[type="text"] {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        width: 80%;
        margin-right: 10px;
    }

    form button {
        padding: 10px 20px;
        background-color: #248A32;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form button:hover {
        background-color: #1d7a27;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .total-price {
            flex-direction: column;
            align-items: flex-start;
        }

        form input[type="text"] {
            width: 100%;
        }

        form button {
            width: 100%;
            margin-top: 10px;
        }
    }
</style>