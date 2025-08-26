<?php
global $mysqli;
include("../conection.php");
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == '' || $password == '') {
        $checkLogin = 'Xin nhập đủ!!';
    } else {
        $sql_login = mysqli_query($mysqli, "SELECT * FROM thanhvien WHERE TenDangNhap = '$username' AND MatKhau = '$password' LIMIT 1");
        if (mysqli_num_rows($sql_login) > 0) {
            $row_getName = mysqli_fetch_array($sql_login);
            $_SESSION['TenDangNhap'] = $username;
            $_SESSION['HoVaTen'] = $row_getName['HoVaTen'];
            $_SESSION['ID_ThanhVien'] = $row_getName['ID_ThanhVien'];
            $_SESSION['Email'] = $row_getName['Email'];
            header("location:../index.php");
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset=utf-8>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="image/logo/logochinh.png" type="image/png">
</head>

<body>
<div id="login" class="container">
    </br>
    <!-- <div style="width: 50%;"> -->
    <div id="login-row" class="row justify-content-center align-items-center">
        <div style="background:#CCFFFF	" id="login-column" class="col-md-6">
            <div id="login-box" class="col-md-12">
                <h2 class="text-center text-info">Đăng Nhập Tài Khoản Của Bạn</h2> </br>
                <h4 style="text-align:center;color:red">
                    <?php if (isset($checkLogin)) {
                        echo $checkLogin;
                    } else {
                        echo " ";
                    }
                    ?>
                </h4>

                <form method="POST" action="">
                    <div class="form-group">
                        <p class="mb-0 text-dark">Tên đăng nhập:</p>
                        <input class="form-control" type="text" name="username" autocomplete="true"/>
                    </div>
                    <div class="form-group">
                        <p class="mb-0 text-dark">Mật khẩu:</p>
                        <input class="form-control" type="password" name="password"/>
                    </div>
                    </br>
                    <input style="margin-top: -10px" type="submit" class="btn btn-info btn-md" name="login"
                           value="ĐĂNG NHẬP"/>
                </form>
                </br>
                <h6 style="margin-top: -15px"> Bạn chưa có tài khoản? Hãy đăng kí</h6>
                <a style="float: right" class="text-info" href="../admin/login.php">Bạn là admin?</a>
                <form method="POST" action="register.php">
                    <input style="margin-bottom: 10px" type="submit" class="btn btn-info btn-md" value="ĐĂNG KÍ"/>
                </form>
                <a class="text-info mb-1 d-inline-block" href="../index.php">Trang chủ</a>
            </div>
        </div>
    </div>
</div>
</div>
</body>

</html>