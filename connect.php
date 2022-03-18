<?php 
$server="localhost";
$user='mysqli';
$password='211001';
$database_name='mysqli';
//kết nối dữ liệu
$conn=mysqli_connect($server,$user,$password,$database_name);
// kiểm tra kết nối
if($conn)
{
    echo"kết nối thành công";
}
else
{
    echo"kết nối thất bại";
}
echo"<br>";
?>