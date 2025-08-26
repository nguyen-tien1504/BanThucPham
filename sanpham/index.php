<?php
include("../conection.php");
include("./productCard.php");
session_start();
$sql_product = "SELECT * FROM sanpham";
?>
<?php
$sql_getList = "SELECT * FROM danhmuc ORDER BY ID_DanhMuc";
$query_categoryList = mysqli_query($mysqli, $sql_getList);
$id_danhmuc = isset($_GET['categoryId']) ? (int)$_GET['categoryId'] : 0;;
$price_range = isset($_GET['price_range']) ? (int)$_GET['price_range'] : 0;
if ($id_danhmuc !== 0) {
    $sql_product .= " where ID_DanhMuc = $id_danhmuc";
    switch ($price_range) {
        case 1:
            $sql_product .= " And GiaBan < 20000";
            break;
        case 2:
            $sql_product .= " And GiaBan BETWEEN 20000 AND 50000";
            break;
        case 3:
            $sql_product .= " And GiaBan BETWEEN 50000 AND 100000";
            break;
        case 4:
            $sql_product .= " And GiaBan > 100000";
            break;
        default:
            $sql_product .= "";
    }
} else {
    switch ($price_range) {
        case 1:
            $sql_product .= " Where GiaBan < 20000";
            break;
        case 2:
            $sql_product .= " Where GiaBan BETWEEN 20000 AND 50000";
            break;
        case 3:
            $sql_product .= " Where GiaBan BETWEEN 50000 AND 100000";
            break;
        case 4:
            $sql_product .= " Where GiaBan > 100000";
            break;
        default:
            $sql_product .= "";
    }
};
if (isset($_POST['search'])) {
    $sql_product = "SELECT * FROM sanpham where TenSanPham LIKE '%" . $_POST['tukhoa'] . "%'";
    $id_danhmuc = $price_range = 0;
}
$sql_product .= " ORDER BY ID_SanPham LIMIT 8";
$query_product = mysqli_query($mysqli, $sql_product);
?>
<!DOCTYPE html>
<html style="scroll-behavior: smooth">

<head>
    <meta charset=utf-8>
    <title>Sản phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../themify-icons/themify-icons.css">
    <link rel="shortcut icon" href="../image/logo/logochinh.png" type="image/png">
</head>

<body>
    <div class="menu sticky-top">
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
            <form action="" class="navbar-form navbar-right" method="POST">
                <div class="input-group">
                    <input type="Search" placeholder="Tìm Kiếm..." class="form-control" name="tukhoa">
                    <div class="input-group-btn">
                        <input type="submit" class="btn btn-secondary" name='search' value="Tìm">
                    </div>
                </div>
            </form>
        </nav>
    </div>
    <div class="position-fixed " style="align-items:center;top:225px; right:15px;">
        <a href="https://vzone.vn/wp-content/uploads/2020/10/Nen-mua-sua-vinamilk-khuyen-mai-hay-la-khong.jpg?v=1604044976">
            <img style="float: right;" src="../image/quangcaoo/thanh2.png" width="50%">
        </a>
    </div>

    <div class="position-fixed" style="top:20%; left:2px; width: 11%">
        <div class="nav flex-column">

        </div>
        <div class="filter-price mt-2">
            <h4>Liệt kê theo</h4>
            <form method="get" action="index.php">
                <div>
                    <input type="radio" name="categoryId" value="0" <?php if ($id_danhmuc == 0) echo "checked" ?> />
                    Tất cả
                </div>
                <?php
                while ($categoryRow = mysqli_fetch_array($query_categoryList)) { ?>
                    <div>
                        <input type="radio" name="categoryId"
                            value="<?php echo $categoryRow['ID_DanhMuc'] ?>" <?php if ($id_danhmuc == $categoryRow['ID_DanhMuc']) echo "checked" ?> />
                        <?php echo $categoryRow['TenDanhMuc'] ?>
                    </div>
                <?php } ?>
                <h4>Tìm theo giá</h4>
                <div>
                    <input type="radio" name="price_range" value="0" <?php if ($price_range == 0) echo "checked" ?>>Tất cả
                    giá
                </div>
                <div>
                    <input type="radio" name="price_range" value="1" <?php if ($price_range == 1) echo "checked" ?>>Dưới
                    20,000
                </div>
                <div>
                    <input type="radio" name="price_range" value="2" <?php if ($price_range == 2) echo "checked" ?>>20,000 -
                    50,000
                </div>
                <div>
                    <input type="radio" name="price_range" value="3" <?php if ($price_range == 3) echo "checked" ?>>50,000 -
                    100,000
                </div>
                <div>
                    <input type="radio" name="price_range" value="4" <?php if ($price_range == 4) echo "checked" ?>>Trên
                    100,000
                </div>
                <br>
                <button type="submit" class="btn btn-success">Lọc</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div id="allproduct">
            <div class="section-title">
                <h1>
                    <?php
                    if ($id_danhmuc !== 0) {
                        $sql_getCategoryName = "SELECT * FROM danhmuc WHERE ID_DanhMuc = $id_danhmuc";
                        $query_getCategoryName = mysqli_query($mysqli, $sql_getCategoryName);
                        $row_getCategoryName = mysqli_fetch_array($query_getCategoryName);
                        echo $row_getCategoryName['TenDanhMuc'];
                    } else echo "Tất cả sản phẩm";
                    ?>
                </h1>
            </div>
            <div class="row">
                <?php while ($row_product = mysqli_fetch_array($query_product)) { ?>
                    <div class="col-3 mb-3">
                        <?php
                        renderProduct($row_product['ID_SanPham'], $row_product['Img'], $row_product['TenSanPham'], $row_product['GiaBan'], $row_product['TonKho']);
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</body>

</html>


<style>
    /* Toàn bộ container */
    .container {
        padding: 40px 50px;
    }

    /* Các tiêu đề của từng phần */
    .section-title h1 {
        text-align: center;
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    /* Mỗi card sản phẩm */
    .card {
        display: flex;
        flex-direction: column;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    /* Phần hình ảnh sản phẩm */
    .product-card img {
        width: 100%;
        height: 200px;
        /* Đặt chiều cao cố định để các sản phẩm có cùng kích thước */
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }

    /* Tên sản phẩm và giá */
    .product-card h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        padding: 10px;
    }

    .product-card h6 {
        font-size: 1.2rem;
        color: red;
        padding: 0 10px 10px;
    }

    /* Hiệu ứng hover cho các card */
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* Hiệu ứng cho hình ảnh khi hover */
    .card:hover .product-card img {
        transform: scale(1.1);
    }

    /* Các nút mua hoặc xem thông tin */
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        font-size: 1.1rem;
        cursor: pointer;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #218838;
    }

    /* Responsive - Đảm bảo các sản phẩm hiển thị đẹp trên các màn hình nhỏ */
    @media (max-width: 768px) {
        .product-row {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            /* Điều chỉnh cột cho màn hình nhỏ hơn */
        }
    }

    @media (max-width: 480px) {
        .product-row {
            grid-template-columns: 1fr;
            /* Màn hình cực nhỏ, chỉ 1 sản phẩm trên mỗi hàng */
        }
    }

    .custom-red-btn {
        background-color: #dc3545;
        /* Màu nền đỏ */
        color: white;
        /* Chữ trắng */
        border: 2px solid #dc3545;
        /* Viền đỏ */
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 8px;
        transition: 0.3s ease;
        text-transform: uppercase;
        text-decoration: none;
    }

    .custom-red-btn:hover {
        color: #dc3545;
        /* Chữ đỏ */
        border-color: #dc3545;
        box-shadow: 0 0 10px rgba(220, 53, 69, 0.5);
    }
</style>