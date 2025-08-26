<?php
$sql_Customer = "SELECT * FROM thanhvien ORDER BY ID_ThanhVien DESC";
$query_Customer = mysqli_query($mysqli, $sql_Customer);

$countProduct = mysqli_num_rows($query_Customer);
// Lấy số trang hiện tại từ URL (mặc định = 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$limit = 5;
// Tính offset
$offset = ($page - 1) * $limit;

// Tính tổng số trang
$total_pages = ceil($countProduct / $limit);

// Query dữ liệu theo trang
$sql_CustomerByPage = "SELECT * FROM thanhvien ORDER BY ID_ThanhVien DESC LIMIT $limit OFFSET $offset ";
$query_Customer = mysqli_query($mysqli, $sql_CustomerByPage);

?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách Khách hàng</h5>

        </div>
        <div class="card-body">

            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Số Điện thoại</th>
                        <th scope="col">Ngày đăng kí</th>
                        <th scope="col">Tên tài khoản</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    while ($row_Customer = mysqli_fetch_array($query_Customer)) {
                        $i++;
                    ?>
                        <tr>

                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $row_Customer['HoVaTen'] ?></td>
                            <td><?php echo $row_Customer['DiaChi'] ?></td>
                            <td><?php echo $row_Customer['SoDienThoai'] ?></td>
                            <td><?php echo $row_Customer['NgayDangKi'] ?></td>
                            <td><?php echo $row_Customer['TenDangNhap'] ?></td>
                            <td>
                                <a href="views/fixUser.php?id=<?php echo $row_Customer['ID_ThanhVien'] ?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i>Edit</a>
                                <a href="views/deleteUser.php?id=<?php echo $row_Customer['ID_ThanhVien'] ?>" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i>Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <!-- Nút Previous -->
                    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?view=list-user&page=<?= $page - 1 ?>">Previous</a>
                    </li>

                    <!-- Số trang -->
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?view=list-user&page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Nút Next -->
                    <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?view=list-user&page=<?= $page + 1 ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<style>
    /* Định dạng bảng */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Định dạng tiêu đề cột */
    .table th {
        background-color: #007bff;
        color: #fff;
        padding: 12px;
        text-align: left;
        font-weight: bold;
        text-transform: uppercase;
    }

    /* Định dạng các ô dữ liệu */
    .table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #f1f1f1;
    }

    /* Hiệu ứng hover cho hàng */
    .table tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    /* Định dạng hàng chẵn */
    .table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Định dạng phân trang */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 1rem;
    }

    .pagination a {
        padding: 8px 16px;
        margin: 0 4px;
        text-decoration: none;
        color: #000;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .pagination a:hover {
        background-color: #0056b3;
        color: white;
    }

    .pagination .active {
        font-weight: bold;
    }
</style>