<?php
include("../conection.php");
$sql_product = "SELECT * FROM sanpham";
$query_product = mysqli_query($mysqli, $sql_product);
$countProduct = mysqli_num_rows($query_product);
if (isset($_POST['tukhoa'])) {
    $tukhoa = $_POST['tukhoa'];
    $sql_search = "SELECT * FROM sanpham where sanpham.TenSanPham LIKE 
  '%" . $tukhoa . "%'";
    $query_search = mysqli_query($mysqli, $sql_search);
}
?>
<?php
// Lấy số trang hiện tại từ URL (mặc định = 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$limit = 5;
// Tính offset
$offset = ($page - 1) * $limit;

// Tính tổng số trang
$total_pages = ceil($countProduct / $limit);

// Query dữ liệu theo trang
$sql_productPerPage = "SELECT * FROM sanpham ORDER BY ID_SanPham DESC LIMIT $limit OFFSET $offset ";
$query_product = mysqli_query($mysqli, $sql_productPerPage);

?>
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="" method="POST">
                    <input type="" class="form-control form-search" placeholder="Tìm kiếm" name="tukhoa">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary" name="tim">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="tableInfo">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col" class="w-50">Mô tả</th>
                            <th scope="col">Tồn kho</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Quản lý</th>
                        </tr>
                    </thead>

                    <?php
                    while ($row = mysqli_fetch_array($query_product)) {
                    ?>
                        <tbody>
                            <td><?php echo $row['TenSanPham']; ?></td>
                            <td><?php echo $row['MoTa']; ?></td>
                            <td><?php echo $row['TonKho']; ?></td>
                            <td><img class="product-icon" src="../image/product/<?php echo $row['Img']; ?>"
                                    alt="icon sản phẩm"></td>
                            <td><?php echo number_format($row['GiaBan'], 0, ',', '.') ?>đ</td>
                            <td>
                                <a class="btn btn-primary" href="views/suaSanPham.php?id=<?php echo $row['ID_SanPham']; ?>">Sửa</a>
                                <a class="btn btn-danger" href="views/deleteProduct.php?id_pro=<?php echo $row['ID_SanPham']; ?>">Xóa</a>
                            </td>
                        </tbody>
                    <?php
                    }

                    ?>
                </table>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <!-- Nút Previous -->
                    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?view=list-product&page=<?= $page - 1 ?>">Previous</a>
                    </li>

                    <!-- Số trang -->
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?view=list-product&page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Nút Next -->
                    <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?view=list-product&page=<?= $page + 1 ?>">Next</a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
</div>

<style>
    /* ==== TABLE STYLE ==== */
    .tableInfo .table {
        border-collapse: collapse;
        width: 100%;
        font-size: 15px;
        text-align: center;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    .table thead {
        background-color: #248A32;
        color: white;
    }

    .table th,
    .table td {
        vertical-align: middle;
        padding: 12px;
        border: 1px solid #dee2e6;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }

    /* ==== IMAGE ICON STYLE ==== */
    .product-icon {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ddd;
        transition: transform 0.2s ease-in-out;
    }

    .product-icon:hover {
        transform: scale(1.2);
    }

    /* ==== BUTTON STYLE ==== */
    .btn {
        padding: 6px 12px;
        font-size: 14px;
        border-radius: 6px;
    }

    .btn-primary {
        background-color: #248A32;
        border-color: #248A32;
    }

    .btn-primary:hover {
        background-color: #1e6e29;
        border-color: #1e6e29;
    }

    /* ==== SEARCH BAR ==== */
    .form-search input[type="text"],
    .form-search input[type="submit"] {
        margin-left: 5px;
    }

    .form-search input[type="text"] {
        border-radius: 6px;
        border: 1px solid #ccc;
        padding: 5px 10px;
    }

    .form-search input[type="submit"] {
        border-radius: 6px;
        background-color: #248A32;
        border: none;
        color: white;
    }

    .form-search input[type="submit"]:hover {
        background-color: #1e6e29;
    }

    /* ==== PAGINATION ==== */
    .pagination .page-link {
        color: #248A32;
        border-radius: 6px;
    }

    .pagination .page-item.active .page-link,
    .pagination .page-link:hover {
        background-color: #248A32;
        color: white;
    }
</style>