<?php
include('../conection.php');
session_start();
$ID_ThanhVien=isset($_SESSION['ID_ThanhVien']) ? $_SESSION['ID_ThanhVien']: '';
$ID_SanPham = isset($_GET['id_product']) ? $_GET['id_product']: '';
$NoiDung = $_POST['NoiDung'];
date_default_timezone_set('Asia/Ho_Chi_Minh');
$ThoiGianBinhLuan = date("Y-m-d H:i:s");
$DanhGia = $_POST['DanhGia'];
echo($ThoiGianBinhLuan);
if (isset($_POST['comment'])) {
	//$sql_add = "INSERT INTO binhluan(ID_ThanhVien,ID_SanPham,NoiDung,ThoiGianBinhLuan,DanhGia) VALUES('".$ID_ThanhVien."','".$ID_SanPham."','".$NoiDung."','".$ThoiGianBinhLuan."')";
	$sql_add = "INSERT INTO binhluan(ID_ThanhVien,ID_SanPham,NoiDung,ThoiGianBinhLuan,DanhGia) VALUES(?,?,?,?,?)";
	$mysqli->execute_query($sql_add,[$ID_ThanhVien,$ID_SanPham,$NoiDung,$ThoiGianBinhLuan,$DanhGia]);
	header("location: infoProduct.php?id_product={$_GET['id_product']}");
}
else{
	header('location:../index.php');
}

?>
