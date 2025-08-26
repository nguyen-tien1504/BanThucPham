<?php
$mysqli = new mysqli("localhost:3310","root","","banthucpham");
// Check connection
if ($mysqli -> connect_errno) {
  echo "Kết nối thất bại: " . $mysqli -> connect_error;
  exit();
}
?>