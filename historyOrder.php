<?php
include("conection.php");
session_start();
if (isset($_SESSION['ID_ThanhVien'])) {
  $ID_ThanhVien = $_SESSION['ID_ThanhVien'];
  $sql_getOrder = "SELECT * FROM hoadon where ID_ThanhVien=$ID_ThanhVien";
  $query_getOrder = mysqli_query($mysqli, $sql_getOrder);
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset=utf-8>
  <title>Trang chủ</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="bootstrap/js/bootstrap.bundle.js">
  <link rel="stylesheet" href="bootstrap/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="themify-icons/themify-icons.css">
  <link rel="shortcut icon" href="https://img.icons8.com/cotton/2x/laptop--v3.png" type="image/png">
</head>

<body>
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
                <a class="nav-link active" href="cart/index.php" style="color:white;">
                  <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i> GIỎ HÀNG
                </a>
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
                <a class="nav-link" href="contact.php?id=<?php echo $_SESSION['ID_ThanhVien'] ?>" style="color:white;">LIÊN HỆ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#" style="color:white;">LỊCH SỬ ĐẶT HÀNG</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="ThanhVien/logout.php" style="color:white;">ĐĂNG XUẤT</a>
              </li>

              <li class="nav-item" style="float: right;">
                <a type="button" class="btn btn-danger custom-red-btn"
                  style="color:white;" href="ThanhVien/profile.php?id=<?php echo $_SESSION['ID_ThanhVien'] ?>"></span> <?php echo $_SESSION['HoVaTen'] ?></a>
              </li>
            <?php } else { ?>
              <li><a type="button" class="btn btn-secondary" href="ThanhVien/login.php" style="color:white;">&nbsp;ĐĂNG NHẬP </a></li>
              <h8> Bạn chưa đăng nhập? hãy đăng nhập để mua hàng</h8>
            <?php } ?>
          </ul>
        </div>
      </div>
      <form action="sanpham/actionSanPham.php?TimKiem" class="navbar-form navbar-right" method="POST">
        <div class="input-group">
          <input type="Search" placeholder="Tìm Kiếm..." class="form-control" name="tukhoa">
          <div class="input-group-btn">
            <input type="submit" class="btn btn-secondary" name='tim' value="Tìm">
          </div>
        </div>
      </form>
    </nav>
  </div>
  <div class="container">
    <div class="duyet">
      <h3>Đơn hàng của tôi</h3>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">STT</th>
            <th scope="col">Mã Đơn Hàng</th>
            <th scope="col">Thời gian đặt</th>
            <th scope="col">Địa Chỉ</th>
            <th scope="col">Ghi chú</th>
            <th scope="col">Giá tiền</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Tình trạng đơn</th>
            <th scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($_SESSION['ID_ThanhVien'])) {
            $i = 0;
            while ($row_Order = mysqli_fetch_array($query_getOrder)) {
              $i++;
          ?>
              <td><?php echo $i ?></td>
              <td><?php echo $row_Order['ID_HoaDon']; ?></td>
              <td><?php echo $row_Order['ThoiGianLap']; ?></td>
              <td><?php echo $row_Order['DiaChi']; ?></td>
              <td><?php echo $row_Order['GhiChu']; ?></td>
              <td><?= number_format($row_Order['GiaTien'], 0, ',', '.') ?>đ</td>
              <td><?php echo $row_Order['SoDienThoai']; ?></td>
              <td><?php echo ($row_Order['XuLy'] == 0) ? "Đang xác nhận" : "Đã xác nhận"; ?></td>
              <td><a href="order/orderDetail.php?orderId=<?= $row_Order['ID_HoaDon']; ?>">Xem chi tiết</a></td>
        </tbody>

      <?php
            }
          } else {
      ?>
      <h4>Không có lịch sử đặt hàng</h4>
    <?php
          }
    ?>
      </table>
    </div>
  </div>
</body>

</html>

<style>
  .duyet {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    margin-top: 30px;
  }

  .duyet h3 {
    text-align: center;
    margin-bottom: 20px;
    color: #248A32;
    font-weight: bold;
    font-size: 24px;
  }

  .table {
    border-collapse: collapse;
    width: 100%;
    font-size: 14px;
  }

  .table th {
    background-color: #248A32;
    color: white;
    padding: 12px;
    text-align: center;
  }

  .table td {
    padding: 10px;
    text-align: center;
    vertical-align: middle;
  }

  .table tbody tr:nth-child(even) {
    background-color: #f1f1f1;
  }

  .table tbody tr:hover {
    background-color: #e0ffe0;
    transition: 0.3s;
  }

  .table td[style*="color: red;"] {
    font-weight: bold;
  }
</style>