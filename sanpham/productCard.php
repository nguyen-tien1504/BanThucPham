<?php
function renderProduct($ID_SanPham, $Img, $TenSanPham, $GiaBan, $TonKho)
{
?>
    <form class="card" action="infoProduct.php?id_product=<?php echo $ID_SanPham ?>" method="POST">
        <div class="product-card">
            <?php if ($TonKho == 0) { ?>
                <span class="badge bg-danger position-absolute top-0 start-0 m-2" style="z-index: 1">Hết hàng</span>
            <?php } ?>
            <img src="../image/product/<?php echo $Img ?>" alt="<?php echo $TenSanPham ?>">
            <h2><?php echo $TenSanPham ?></h2>
            <h6>Giá: <?php echo number_format($GiaBan, 0, ',', '.') ?> VNĐ</h6>

            <?php if (isset($_SESSION['TenDangNhap'])) { ?>
                <input type="submit" class="btn btn-info" name="submit"
                    <?php if ($TonKho == 0) echo "value='Xem Thông Tin'";
                    else echo "value='Mua'"; ?> />
            <?php } else { ?>
                <input type="submit" class="btn btn-info" name="submit" value="Xem Thông Tin" />
            <?php } ?>
        </div>
    </form>
<?php
}

function renderProductHome($ID_SanPham, $Img, $TenSanPham, $GiaBan, $TonKho)
{
?>
    <form action="sanpham/infoProduct.php?id_product=<?php echo $ID_SanPham; ?>"
        method="POST">
        <div style="margin: 20px">
            <div class="card text-center">
                <?php if ($TonKho == 0) { ?>
                    <span class="badge bg-danger position-absolute top-0 start-0 m-2" style="z-index: 1">Hết hàng</span>
                <?php } ?>
                <img src="image/product/<?php echo $Img; ?>" class="card-img-top"
                    alt="...">
                <div class="card-body">
                    <h2>
                        <?php echo $TenSanPham; ?>
                    </h2>
                    <h6>Giá: <?php echo number_format($GiaBan, 0, ',', '.') ?> VNĐ</h6>
                    <?php if (isset($_SESSION['TenDangNhap'])) { ?>
                        <input type="submit" class="btn btn-info" name="submit"
                            <?php if ($TonKho == 0) echo "value='Xem Thông Tin'";
                            else echo "value='Mua'"; ?> />
                    <?php } else { ?>
                        <input type="submit" class="btn btn-info" name="submit" value="Xem Thông Tin" />
                    <?php } ?>
                </div>
            </div>
        </div>
    </form>
<?php
}
?>