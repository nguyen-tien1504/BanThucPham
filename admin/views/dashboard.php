<?php
include("../conection.php");

$sql_CountOrderSuccess = mysqli_query($mysqli, "SELECT * FROM hoadon WHERE XuLy= '1'");
$CountOrderSuccess = mysqli_num_rows($sql_CountOrderSuccess);
$sql_AllMoney = mysqli_query($mysqli, "SELECT sum(GiaTien) FROM hoadon where XuLy='1'");
$queryAllMoney = mysqli_fetch_assoc($sql_AllMoney)['sum(GiaTien)'];
$sql_CountOrder2 = mysqli_query($mysqli, "SELECT * FROM hoadon WHERE XuLy= '0'");
$CountOrder2 = mysqli_num_rows($sql_CountOrder2);
$sql_CountOrder3 = mysqli_query($mysqli, "SELECT ID_HoaDon FROM hoadon WHERE XuLy= '2'");
$CountOrder3 = mysqli_num_rows($sql_CountOrder3);
?>
<?php
// Lấy số trang hiện tại từ URL (mặc định = 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$limit = 5;
// Tính offset
$offset = ($page - 1) * $limit;

// Tính tổng số trang
$total_pages = ceil($CountOrder2 / $limit);

// Query dữ liệu theo trang
$sql_productPerPage = "SELECT * FROM hoadon hd join thanhvien tv on hd.ID_ThanhVien = tv.ID_ThanhVien WHERE XuLy= '0'  LIMIT $limit OFFSET $offset";
$query_productPerPage = mysqli_query($mysqli, $sql_productPerPage);
?>
<div class="container-fluid py-5">

    <div class="row">
        <div class="col">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $CountOrderSuccess ?></h5>
                    <p class="card-text">Đơn hàng giao dịch thành công</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐANG XỬ LÝ</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $CountOrder2 ?></h5>
                    <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">DOANH SỐ</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo number_format($queryAllMoney, 0, ',', '.') ?>đ</h5>
                    <p class="card-text">Doanh số hệ thống</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG HỦY</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $CountOrder3 ?></h5>
                    <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end analytic  -->
    <div class="card">

        <div class="card-header font-weight-bold">
            ĐƠN HÀNG MỚI
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên Khách hàng</th>
                        <th scope="col">Số Điện Thoại</th>
                        <th scope="col">Giá Tiền</th>
                        <th scope="col">Địa Chỉ</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($query_productPerPage)) {
                        $i++; ?>
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $row['HoVaTen'] ?></td>
                            <td><a href="#"><?php echo $row['SoDienThoai'] ?></a></td>
                            <td><?php echo number_format($row['GiaTien'], 0, ',', '.') ?>đ</td>
                            <td><?php echo $row['DiaChi'] ?></td>
                            <td><span class="badge badge-warning">Đang xử lí</span></td>
                            <td><?php echo $row['ThoiGianLap'] ?></td>
                            <td>
                                <a href="views/actionOrder.php?id=<?php echo $row['ID_HoaDon'] ?>"
                                    class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Success"><i class="fa fa-edit"></i> Success</a>
                                <a href="views/deleteOrder.php?id=<?php echo $row['ID_HoaDon'] ?>"
                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Cancel"><i class="fa fa-trash"></i> Cancel</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <!-- Nút Previous -->
                    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                    </li>

                    <!-- Số trang -->
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Nút Next -->
                    <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>

</div>

<style>
    /* General Styles for the Dashboard */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fc;
        margin: 0;
        padding: 0;
    }

    /* Card Styles */
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        font-weight: bold;
        font-size: 16px;
    }

    .card-body {
        padding: 15px;
    }

    .card-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    /* Analytics Card Section */
    .card.bg-primary {
        background-color: #007bff !important;
    }

    .card.bg-danger {
        background-color: #dc3545 !important;
    }

    .card.bg-success {
        background-color: #28a745 !important;
    }

    .card.bg-dark {
        background-color: #343a40 !important;
    }

    .card-header {
        font-size: 1.2rem;
        text-align: center;
    }

    .card-body .card-title {
        font-size: 1.6rem;
        margin-bottom: 8px;
    }

    /* Table Styles */
    .table {
        width: 100%;
        border-radius: 10px;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
    }

    .table th,
    .table td {
        padding: 12px;
        text-align: left;
    }

    .table th {
        background-color: #007bff;
        color: white;
        font-size: 1rem;
    }

    .table td {
        border-bottom: 1px solid #f1f1f1;
        font-size: 0.9rem;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table tbody tr:hover {
        background-color: #e9ecef;
        cursor: pointer;
    }

    /* Pagination Styles */
    .pagination {
        justify-content: center;
        margin-top: 20px;
    }

    .pagination .page-link {
        padding: 8px 16px;
        margin: 0 4px;
        border-radius: 5px;
        background-color: #007bff;
        color: white;
        transition: background-color 0.3s;
    }

    .pagination .page-item.active .page-link {
        background-color: #0056b3;
    }

    .pagination .page-link:hover {
        background-color: #0056b3;
    }

    /* Badge Styles for Order Status */
    .badge-warning {
        background-color: #ffc107;
        color: #212529;
        padding: 5px 10px;
        border-radius: 12px;
    }
</style>