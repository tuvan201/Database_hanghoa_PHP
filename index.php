<?php 
include"import.php";
$sql_query="SELECT * FROM hanghoa";
$result=mysqli_query($conn,$sql_query);
//kiểm tra dữ liệu
?>
<a href="insert_Item.php">THÊM</a>
<table border="1px" cellpadding="10" cellspacing="0">
    <caption><h2>Bảng hàng hóa</h2></caption>
    <tr>
        <th>ID</th>
        <th>Tên Hàng</th>
        <th>Đơn Gía</th>
        <th>Số Lượng</th>
        <th>Đơn vị tính</th>
        <th>Hình Ảnh</th>
        <th>Xóa hàng</th>
    </tr>
<?php
if(mysqli_num_rows($result)>0)
{
    while($row=mysqli_fetch_array($result))//trả về 1 dòng của kết quả trả về từ biến $result bằng dạng mảng
    { ?>
         <tr>
        <td><?php echo $row[0]?></td>
        <td><a href="update.php?mahang=<?php echo $row[0]?>"><?php echo $row[1] ?></a></td>
        <td><?php echo $row[2]?></td>
        <td><?php echo $row[3]?></td>
        <td><?php echo $row[4]?></td>
        <td><?php
        if($row[5]=="chưa có")
        {
            echo $row[5];
        }
        else { ?>
            <img src="<?php echo"upload_img/$row[5]"; ?>" width="50px" height="50px" alt="" srcset="">
        <?php } ?>
        </td>
        <td><form action="delete.php" method="post">
        <input type="hidden" name="mahang" value="<?php echo $row[0]; ?>">
        <input onclick="return confirm('Bạn có chắc muốn xóa mặt hàng này không?');" type="submit" value="Delete">
        </form></td>
        </tr>
    <?php }
}
else
{
    echo "Bảng hàng hóa hiện chưa có dữ liệu";
}
mysqli_close($conn);
// echo "<pre>";
// var_dump($row);
// echo "</pre>";
?>
</table>