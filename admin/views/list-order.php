<?php
$sql_Order = mysqli_query($mysqli, "SELECT * FROM hoadon where XuLy='1'");
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Doanh Thu của cửa hàng</h5>
        </div>
        <table class="table table-striped table-checkall">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">ID Hóa đơn</th>
                    <th scope="col">ID thành viên</th>
                    <th scope="col">Thời gian thanh toán</th>
                    <th scope="col">Địa chỉ khách hàng</th>
                    <th scope="col">Giá tiền</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $num = 0;
                while ($row_Order = mysqli_fetch_array($sql_Order)) {
                    $i += $row_Order['GiaTien'];
                    $num++;
                ?>
                    <tr>
                        <td><?php echo $num ?></td>
                        <td><?php echo $row_Order['ID_HoaDon'] ?></td>
                        <td><?php echo $row_Order['ID_ThanhVien'] ?></td>
                        <td><?php echo $row_Order['ThoiGianLap'] ?></td>
                        <td><?php echo $row_Order['DiaChi'] ?></td>
                        <td>
                            <?php echo number_format($row_Order['GiaTien'], 0, ',', '.') ?>đ
                        </td>
                    </tr>

                <?php
                }
                $AllMoney = 0;
                ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation example">
            <h4 style="float: right;">Tổng tiền :<?= number_format($i, 0, ',', '.')  ?>đ</h4>

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
        background-color: #007bff;
        color: #fff;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .pagination a:hover {
        background-color: #0056b3;
    }

    .pagination .active {
        background-color: #0056b3;
        font-weight: bold;
    }
</style>