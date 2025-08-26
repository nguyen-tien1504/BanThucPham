<?php
include("../conection.php");
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$soluong = isset($_GET['soluong']) ? (int)$_GET['soluong'] : 1;

// Nếu không có ID sản phẩm thì quay về
if ($id == '') {
    header('location:index.php');
    exit();
}

// Nếu số lượng = 0 → Xóa sản phẩm khỏi giỏ
if ($soluong == 0) {
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
    header('location:index.php');
    exit();
}

// Nếu số lượng = -1 → Giảm số lượng
if ($soluong == -1) {
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty']--;
        // Nếu số lượng giảm về 0 thì xóa luôn sản phẩm
        if ($_SESSION['cart'][$id]['qty'] <= 0) {
            unset($_SESSION['cart'][$id]);
        }
    }
    header('location:index.php');
    exit();
}

// Trường hợp còn lại là thêm sản phẩm (mặc định là +1)
$product = "SELECT * FROM sanpham WHERE ID_SanPham='" . $id . "' LIMIT 1";
$query = mysqli_query($mysqli, $product);
$row = mysqli_fetch_assoc($query);

if ($row) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += $soluong;
    } else {
        $_SESSION['cart'][$id] = [
            'ID_SanPham' => $row['ID_SanPham'],
            'TenSanPham' => $row['TenSanPham'],
            'Img' => $row['Img'],
            'GiaBan' => $row['GiaBan'],
            'qty' => $soluong
        ];
    }

    header('location:index.php');
    exit();
} else {
    header('location:../index.php');
    exit();
}
?>
