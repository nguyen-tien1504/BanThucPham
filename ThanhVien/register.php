<?php
include("../conection.php");
// nhận dữ liệu từ người dùng
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password-repeat'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $phonenumber = $_POST['phonenumber'];
    $NgayDangKi = date("Y-m-d H:i:s");
    $partten = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    if (isset($_POST['register']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password-repeat']) && !empty($_POST['email']) && !empty($_POST['fullname']) && !empty($_POST['address']) && !empty($_POST['phonenumber'])) {
        if ($password != $password_repeat) {
            $checkRegister = "Nhập lại mật khẩu sai";
        } else if (!preg_match($partten, $email, $matchs))
            $checkRegister = "Mail bạn vừa nhập không đúng định dạng ";
        else if (!preg_match("/^[0-9]*$/", $phonenumber))
            $checkRegister = "Số điện thoại không hợp lệ.";
        else {
            $sql_add = "INSERT INTO thanhvien(TenDangNhap,MatKhau,Email,HoVaTen,DiaChi,SoDienThoai,NgayDangKi) VALUES('$username', '$password', '$email', '$fullname', '$address', '$phonenumber', '$NgayDangKi')";
            mysqli_query($mysqli, $sql_add);
            $checkRegister = "Đăng kí thành công";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset=utf-8>
    <title>Đăng kí</title>
    <link href="register.css" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap/js/bootstrap.bundle.js">
    <link rel="stylesheet" href="../bootstrap/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="image/logo/logochinh.png" type="image/png">
</head>
<body>

<div class="container mb-3">
    <nav class="navbar navbar-expand-lg header-custom sticky-top">
        <div class="container-fluid font-header-custom">
            <a class="navbar-branch" href="../index.php">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="login.php">ĐĂNG NHẬP</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h4 class="text-danger text-center">
        <?php if (isset($checkRegister)) {
            echo $checkRegister;
        } else {
            echo " ";
        }
        ?>
    </h4>

    <div class="row justify-content-center align-items-center">
        <form method="POST" action="" class="col-md-6">
            <h3>ĐĂNG KÍ</h3>
            <div class="form-group">
                <label class="mb-0 text-dark">Họ và Tên:</label>
                <input class="form-control" type="text" name="fullname" placeholder="Họ và Tên">
            </div>
            <div class="form-group">
                <label class="mb-0 text-dark">Địa Chỉ:</label>
                <input class="form-control" type="text" name="address" placeholder="Địa Chỉ">
            </div>
            <div class="form-group">
                <label class="mb-0 text-dark">Email:</label>
                <input class="form-control" type="text" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label class="mb-0 text-dark">Số Điện thoại:</label>
                <input class="form-control" type="text" name="phonenumber" placeholder="Số Điện thoại">
            </div>
            <div class="form-group">
                <label class="mb-0 text-dark">Tên tài khoản:</label>
                <input class="form-control" type="text" name="username" placeholder="Tên tài khoản">
            </div>
            <div class="form-group">
                <label class="mb-0 text-dark">Mật khẩu:</label>
                <input class="form-control" type="password" name="password" placeholder="Mật khẩu">
            </div>
            <div class="form-group">
                <label class="mb-0 text-dark">Nhập lại mật khẩu:</label>
                <input class="form-control" type="password" name="password-repeat" placeholder="Nhập lại mật khẩu">
            </div>
            </br>
            <td><input style="margin-top: -10px" type="submit" class="btn btn-info btn-md" name="register"
                       value="Đăng kí"></td>
        </form>
    </div>
</div>
</div>

</body>

</html>