<?php
include("../conection.php");
session_start();
if (isset($_SESSION['ID_ThanhVien'])) {
    $id_cus = $_SESSION['ID_ThanhVien'];
}
?>
<?php
$sql_product = "SELECT * FROM sanpham  where ID_SanPham='$_GET[id_product]'";
$query_product = mysqli_query($mysqli, $sql_product);
$row_product = mysqli_fetch_array($query_product);
$sql_comment = "SELECT * FROM binhluan,thanhvien where binhluan.ID_SanPham='$_GET[id_product]' and binhluan.ID_ThanhVien=thanhvien.ID_ThanhVien";
$query_comment = mysqli_query($mysqli, $sql_comment);
?>
<!DOCTYPE html>
<html style="scroll-behavior: smooth">

<head>
    <meta charset=utf-8>
    <title>Sản phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap/js/bootstrap.bundle.js">
    <link rel="stylesheet" href="../bootstrap/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../themify-icons/themify-icons.css">
    <link rel="shortcut icon" href="../image/logo/logochinh.pngs" type="image/png">
</head>

<body>

<div class="menu sticky-top ">
    <nav class="navbar navbar-expand-lg header-custom" style="background-color: #248A32;">
        <div class="container-fluid font-header-custom">
            <a class="navbar-branch" href="../index.php">
                <img src="../image/logo/logochinh.png" height="80">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['TenDangNhap'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php" style="color:white;">TẤT CẢ SẢN PHẨM</a>
                        </li>

                        <!-- Search -->

                        <li class="nav-item">
                            <a class="nav-link active" href="../cart/index.php" style="color:white;">GIỎ HÀNG</a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <a class="nav-link active" href="index.php" style="color:white;">TẤT CẢ SẢN PHẨM</a>
                        <?php
                    }
                    ?>
                    <?php if (isset($_SESSION['TenDangNhap'])) { ?>

                        <li class="nav-item">
                            <a class="nav-link text-white active" href="../historyOrder.php">LỊCH SỬ ĐẶT HÀNG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../contact.php">LIÊN HỆ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../ThanhVien/logout.php">ĐĂNG XUẤT</a>
                        </li>

                        <li class="nav-item" style="float: right;">
                            <a type="button" class="btn btn-danger custom-red-btn"
                               href="../ThanhVien/profile.php?id=<?php echo $_SESSION['ID_ThanhVien'] ?>"></span> <?php echo $_SESSION['HoVaTen'] ?></a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <div class="d-flex flex-column">
                                <a type="button" class="btn btn-secondary w-50" href="../ThanhVien/login.php"
                                   style="color:white">&nbsp;ĐĂNG NHẬP </a>
                                <h8> Bạn chưa đăng nhập? hãy đăng nhập để mua hàng</h8>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <form action="actionSanPham.php?TimKiem" class="navbar-form navbar-right" method="POST">
            <div class="input-group">
                <input type="Search" placeholder="Tìm Kiếm..." class="form-control" name="tukhoa">
                <div class="input-group-btn">
                    <input type="submit" class="btn btn-secondary" name='tim' value="Tìm">
                </div>
            </div>
        </form>
    </nav>
</div>

<main role="main">
    <!-- Block content - Đục lỗ trên giao diện bố cục chung, đặt tên là `content` -->
    <div class="container mt-4">
        <div class="card">
            <div class="container-fliud">
                <form name="frmsanphamchitiet" id="frmsanphamchitiet" method="post"
                      action="../cart/add.php?id=<?php echo $row_product['ID_SanPham']; ?>">
                    <input type="hidden" name="sp_ten" id="sp_ten" value="<?php echo $row_product['TenSanPham']; ?>">
                    <input type="hidden" name="sp_gia" id="sp_gia" value="<?php echo $row_product['GiaBan']; ?>">
                    <input type="hidden" name="hinhdaidien" id="hinhdaidien"
                           value="<?php echo $row_product['Img']; ?>">
                    <div class="card">
                        <div class="container-fluid">
                            <h3>Thông tin chi tiết về Sản phẩm</h3>

                        </div>
                    </div>
                    <div class="wrapper row">
                        <div class="preview col-md-6">
                            <div class="preview-pic tab-content">
                                <div class="tab-pane active" id="pic-3">
                                    <img src="../image/product/<?php echo $row_product['Img']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="details col-md-6">
                            <h3 class="product-title">
                                <?php echo $row_product['TenSanPham']; ?>
                            </h3>
                            <div class="rating-container">
                                <?php if ($row_product['DanhGiaTB'] > 0.0) : ?>
                                    <div class="rating-value">
                                        <?php echo $row_product['DanhGiaTB']; ?>/5
                                    </div>
                                    <div class="stars-outer">
                                        <div class="stars-inner"
                                             style="width: <?php echo ($row_product['DanhGiaTB'] / 5) * 100; ?>%;"></div>
                                    </div>
                                <?php else : ?>
                                    <p>Chưa có đánh giá nào.</p>
                                <?php endif; ?>
                            </div>
                            <p class="product-description">
                                <?php echo $row_product['MoTa']; ?>
                            </p>

                            <h4 class="price">Giá hiện tại: <span>
                                        <?php echo $row_product['GiaBan']; ?> Đồng/Kg
                                    </span></h4>
                            <p class="vote"><strong>100%</strong> hàng <strong>Chất lượng</strong>, đảm bảo
                                <strong>Uy tín</strong>!
                            </p>
                            <?php if (isset($_SESSION['TenDangNhap'])) {
                                ?>
                                <div class="form-group">
                                    <label for="soluong">Số lượng đặt mua:</label>
                                    <input type="number" class="form-control" id="soluong" name="soluong" value="1">
                                </div>
                                <div class="action">
                                    <input type="submit" class="btn btn-primary" name='submit' value="Mua hàng"
                                           style="background-color: #248A32;">
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="container-fluid">
                <h3>Bình luận về sản phẩm</h3>
                <?php
                while ($row_comment = mysqli_fetch_array($query_comment)) {
                    ?>
                    <div class="alert alert-success d-flex" role="alert">
                        <div class="">
                            <small>
                                <label for="floatingInputValue" class="mb-0 font-weight-bold">
                                    <?php echo $row_comment['HoVaTen']; ?>
                                </label>
                                <label for="floatingInputValue" class="mb-0">
                                    <?php echo $row_comment['ThoiGianBinhLuan']; ?>
                                </label>
                            </small>
                            <div>
                                <?php
                                for ($i = 0; $i < $row_comment['DanhGia']; $i++) {
                                    if ($i <= 5) {
                                        echo '<span>&#9733;</span>';
                                    } else {
                                        echo '<span>&#9733;</span>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div style="font-size: 20px" class="px-2">
                            <?php echo $row_comment['NoiDung']; ?>
                        </div>
                    </div>

                    <?php
                }
                ?>
                <?php if (isset($_SESSION['TenDangNhap'])) {
                    ?>
                    <form class="form-floating"
                          action="actionComment.php?id_product=<?php echo $row_product['ID_SanPham']; ?>"
                          method="POST">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Hãy bình luận sản phẩm tại đây"
                                      id="floatingTextarea2" name="NoiDung" style="height: 100px"></textarea>
                        </div>
                        <input type="hidden" name="DanhGia" id="rating-value"/>
                        <div class="action">
                            <div class="rating">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                            </div>
                            <input type="submit" class="btn btn-primary" name='comment' value="Bình luận"
                                   style="float:right; background-color: #248A32">
                        </div>
                    </form>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    </div>
</main>
<hr class="hr--large">
<div class="space" style="text-align: center; background-color: #white ">
    <img style="" src="../image/thanhspace.PNG">
    <p class="site-footer__copyright-content">
        © 2025,
        <a href="http://localhost/BanThucPham/index.php" title="" style=" color: red"> HUTECH</a>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</html>

<style>
    .rating {
        font-size: 40px;
        color: #ccc;
        cursor: pointer;
        user-select: none;
    }

    .star {
        transition: color 0.2s;
    }

    .star:hover {
        color: #ff9800;
    }

    .rated {
        color: #ff9800;
    }

    .rating-container {
        display: flex;
        align-items: center;
    }

    .rating-value {
        font-size: 24px;
        font-weight: bold;
        margin-right: 10px;
    }

    .stars-outer {
        position: relative;
        display: inline-block;
        font-size: 24px;
    }

    .stars-outer::before {
        content: '★★★★★';
        color: #ccc;
    }

    .stars-inner {
        position: absolute;
        top: 0;
        left: 0;
        white-space: nowrap;
        overflow: hidden;
    }

    .stars-inner::before {
        content: '★★★★★';
        color: gold;
    }
</style>

<script>
    $(document).ready(function () {
        const $stars = $('.star');

        let currentRating = 0;

        // Sự kiện khi di chuột vào sao
        $stars.on('mouseover', function () {
            const value = parseInt($(this).attr('data-value'));
            $stars.removeClass('rated');
            $stars.each(function (index) {
                if (index < value) {
                    $(this).addClass('rated');
                }
            });
        });

        // Sự kiện khi di chuột ra khỏi khu vực đánh giá
        $('.rating').on('mouseout', function () {
            $stars.removeClass('rated');
            $stars.each(function (index) {
                if (index < currentRating) {
                    $(this).addClass('rated');
                }
            });
        });

        // Sự kiện khi click vào sao
        $stars.on('click', function () {
            currentRating = parseInt($(this).attr('data-value'));
            $stars.removeClass('rated');
            $stars.each(function (index) {
                if (index < currentRating) {
                    $(this).addClass('rated');
                }
            });
            $('#rating-value').val(currentRating)
        });
    });
</script>