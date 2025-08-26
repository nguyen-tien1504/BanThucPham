<?php
global $mysqli;
include("conection.php");
include("./sanpham/productCard.php");
$sql_product = "SELECT * FROM sanpham ORDER BY ID_SanPham LIMIT 8";
$query_product = mysqli_query($mysqli, $sql_product);
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset=utf-8>
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="themify-icons/themify-icons.css">
    <link rel="shortcut icon" href="image/logo/logochinh.png" type="image/png">
</head>

<body>
    <?php
    include("menu.php")
    ?>
    <div>
        <ul class="nav flex-column sticky-top">
            <li class="nav-item">
                <a class="navbar-branch nav-link" href="../index.php">
                    <img style="margin-top: 100px; display: none;" src="image/quangcaoo/thanh2.png" height="120">
                </a>
            </li>
        </ul>
    </div>

    <div class="d-flex justify-content-between position-fixed w-100 px-1">
        <img class="d-inline-block" src="image/quangcaoo/thanh2.png" width="10%">
        <div class="d-flex flex-column align-items-end">
            <img class="img-fluid" src="image/quangcaoo/thanh3.png" width="30%">
            <img class="img-fluid" src="image/quangcaoo/thanh4.png" width="30%">
        </div>
    </div>

    <div class="container px-5">
        <div id="slides" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#slides" data-slide-to="0" class="active"></li>
                <li data-target="#slides" data-slide-to="1"></li>
                <li data-target="#slides" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img style="text-align: center ;width: 100%; height: auto; " src="image/quangcaoo/bia3.png" alt="">
                </div>
                <div class="carousel-item">
                    <img style="text-align: center ;width: 100%; height: auto; " src="image/quangcaoo/bia4.png" alt="">
                </div>
                <div class="carousel-item">
                    <img style="text-align: center ;width: 100%; height: auto; " src="image/quangcaoo/bia2.png" alt="">
                </div>
            </div>
        </div>

        <div class="text-center">
            <img class="img-fluid" src="image/hotdealtrongthang.png">
        </div>

        <div class="row">
            <?php
            while ($row_product = mysqli_fetch_array($query_product)) {
            ?>
                <div class="col-4 px-0">
                    <?php
                    renderProductHome($row_product['ID_SanPham'], $row_product['Img'], $row_product['TenSanPham'], $row_product['GiaBan'], $row_product['TonKho']);
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <hr class="hr--large">
    <div class="space" style="text-align: center; background-color: white ">
        <img style="" src="image/thanhspace.PNG">
        <p class="site-footer__copyright-content">
            © 2025
            <a href="http://localhost/BanThucPham/index.php" \title="" style=" color: red"> HUTECH</a>
    </div>


</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</html>

<style>
    .card {
        width: 300px;
        height: 460px;
        margin: 20px;
        float: left;
        text-align: center;
        border: none;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        background-color: #fff;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
    }

    .card img.card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 1px solid #eee;
        transition: transform 0.3s ease;
    }

    .card:hover img.card-img-top {
        transform: scale(1.1);
    }

    .card-body {
        padding: 15px;
    }

    .card-body h2 {
        font-size: 20px;
        margin: 10px 0;
        color: #333;
        font-weight: bold;
    }

    .card-body h6 {
        color: red;
        font-size: 16px;
        margin-bottom: 15px;
    }

    .card-body input[type="submit"] {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .card-body input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>