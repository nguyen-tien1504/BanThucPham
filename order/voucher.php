<?php
include("../conection.php");
session_start();

$ID_ThanhVien = $_SESSION['ID_ThanhVien'];
$sql = "SELECT * FROM voucher WHERE ID_ThanhVien = '$ID_ThanhVien' ORDER BY HanSuDung DESC";
$result = mysqli_query($mysqli, $sql);
?>

<h3>Phiếu giảm giá của bạn</h3>
<table border="1" class="table">
  <tr>
    <th>Mã Voucher</th>
    <th>Giá trị</th>
    <th>Hạn sử dụng</th>
    <th>Trạng thái</th>
  </tr>
  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $row['ID_Voucher']; ?></td>
      <td><?php echo number_format($row['GiaTri']); ?> đ</td>
      <td><?php echo $row['HanSuDung']; ?></td>
      <td><?php echo $row['TrangThai']; ?></td>
    </tr>
  <?php } ?>
</table>
