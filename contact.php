<?php
include("conection.php");
if (isset($_POST['contact'])) {
    $ID_ThanhVien = $_GET['id'];
    $TenThanhVien = $_POST['name'];
    $Email = $_POST['email'];
    $NoiDung = $_POST['NoiDung'];
    $sql_ThanhVien = "INSERT INTO lienhe(ID_ThanhVien,TenThanhVien,Email,NoiDung) VALUES('$ID_ThanhVien ', '$TenThanhVien ','$Email',' $NoiDung')";
    mysqli_query($mysqli, $sql_ThanhVien);
    header("location:contact.php?id={$ID_ThanhVien}");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title>Liên hệ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/js/bootstrap.bundle.js">
    <link rel="stylesheet" href="bootstrap/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="themify-icons/themify-icons.css">
    <link rel="shortcut icon" href="image/logo/logochinh.png" type="image/png">
</head>
<body>
<?php require("menu.php")?>
<div class="container">
    <h2 style="text-align:center; margin-top: 30px;">Liên hệ</h2>
    <div class="get-order" style=" margin-left: 250px; width: 600px;">

        <div class="alert alert-success" role="alert">
            <form method="POST" action="">
                <td>Tên Người dùng</td>
                <td><input class="form-control" style="width:300px" type="text" name="name"
                           value="<?php echo $_SESSION['HoVaTen'] ?>" disabled></td>
                <td><p>Email</p></td>
                <td><input class="form-control" style="width:300px" type="text" name="email"
                           value="<?php echo $_SESSION['Email'] ?>" disabled></td>
                <td><p>Nội dung</p></td>
                <td><textarea class="form-control" type="text" name="NoiDung" value=""></textarea></td>
                <td></br></td>
                <td><input type="submit" name="contact" value="Gửi"></td>
                </tr>
            </form>
        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</html>
