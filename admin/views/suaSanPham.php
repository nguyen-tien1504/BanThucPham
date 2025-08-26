<?php
include("../../conection.php");
if (isset($_GET['id'])) {
    $ID_SanPham = $_GET['id'];
    $sql_getSanPham = "SELECT * FROM sanpham where ID_SanPham=$ID_SanPham LIMIT 1";
    $query_getSanPham = mysqli_query($mysqli, $sql_getSanPham);
    $row = mysqli_fetch_array($query_getSanPham);
}
if (isset($_POST['submit'])) {
    $TenSanPham = $_POST['TenSanPham'];
    $MoTa = $_POST['MoTa'];
    $GiaBan = $_POST['GiaBan'];
    if ($TenSanPham == "") {
        echo "Vui lòng nhập đủ tên!<br />";
    }
    if ($MoTa == "") {
        echo "Vui lòng nhập đủ Mô Tả!<br />";
    }
    if ($GiaBan == "") {
        echo "Vui lòng nhập giá bán!<br />";
    }
    if ($TenSanPham != "" && $MoTa != "" && $GiaBan != "") {
        $sql_fix = "UPDATE sanpham SET TenSanPham = '" . $TenSanPham . "', MoTa = '" . $MoTa . "',GiaBan = '" . $GiaBan . "' WHERE ID_SanPham= '$_GET[id]' ";
        mysqli_query($mysqli, $sql_fix);
        header("location: ../index.php?view=list-product");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Admintrator</title>
</head>

<body>
    <div id="warpper" class="nav-fixed">
        <?php require("../navbar.php") ?>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">
            
            <div id="wp-content">
                <div id="content" class="container-fluid">
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            Sửa Sản phẩm
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="name">Tên Sản Phẩm</label>
                                    <input class="form-control" type="text" name="TenSanPham" id="name"
                                        value="<?php echo $row['TenSanPham'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="name">Mô tả</label>
                                    <input class="form-control" type="text" name="MoTa" id="name"
                                        value="<?php echo $row['MoTa'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="name">Giá Bán</label>
                                    <input class="form-control" type="text" name="GiaBan" id="name"
                                        value="<?php echo $row['GiaBan'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="formFile">Hình ảnh</label>
                                    <img style="width: 276px;height: 247px;"
                                        src="../../image/product/<?php echo $row['Img']; ?>">
                                    <input class="form-control" type="file" name="image"
                                        value="<?php echo $row['Img']; ?>">
                                </div>

                                <input type="submit" class="btn btn-primary" name="submit" value="Sửa">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../js/app.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>