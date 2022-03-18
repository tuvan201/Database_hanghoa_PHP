<?php
include"import.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng hàng hóa</title>
</head>
<body>
    <?php 
    if(isset($_POST["submit"]))
    {
        //tạo array_error để hiển thị lỗi, đang demo nên lược bớt
        //empty các giá trị ? "chưa nhập đủ dữ liệu" : tiếp tục công việc, đang demo nên lược bớt
        //gán giá trị cho các biến
        $mahang=!empty($_POST['txtmahang']) ? $_POST['txtmahang'] : "";
        $tenhang=!empty($_POST['txttenhang']) ? $_POST['txttenhang'] : "";
        $dongia=!empty($_POST['txtdongia']) ? $_POST['txtdongia'] : "";
        $soluong=!empty($_POST['txtsoluong']) ? $_POST['txtsoluong'] : "";
        $dvt=!empty($_POST['txtdvt']) ? $_POST['txtdvt'] : "";
		$anh=!empty($_FILES['txtanh']['name']) ? basename($_FILES['txtanh']['name']) : "" ;
		//VALIDATE HÌNH ẢNH
		//Thư mục bạn sẽ lưu file upload
		$target_dir="upload_img/";
		//Vị trí file lưu tạm trong server (file sẽ lưu trong upload_img, với tên giống tên ban đầu)
		$target_file=$target_dir.$anh;
        $imageFileTypes=pathinfo($target_file,PATHINFO_EXTENSION);
		//Những loại file được phép upload
		 $allowtypes = array('jpg', 'png', 'jpeg', 'gif');
		if(in_array($imageFileTypes,$allowtypes))
		{

			move_uploaded_file($_FILES['txtanh']['tmp_name'],$target_file);
			if(insertTableHangHoa($mahang,$tenhang,$dongia,$soluong,$dvt,$anh))
			{
				header("location:index.php");
			}
			else
			{
				echo "trùng mã hàng";
			}
		}
		else
		{
			echo"file upload không phải là file ảnh";	
		}
    }
    ?>
	<a href="index.php">BACK</a>
<form method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<td>Mã hàng</td>
			<td><input type="text" name="txtmahang"></td>
		</tr>
		<tr>
			<td>Tên hàng</td>
			<td><input type="text" name="txttenhang"></td>
		</tr>
		<tr>
			<td>Đơn giá</td>
			<td><input type="text" name="txtdongia"></td>
		</tr>
		<tr>
			<td>Số lượng</td>
			<td><input type="text" name="txtsoluong"></td>
		</tr>
		<tr>
			<td>DVT</td>
			<td><input type="text" name="txtdvt"></td>
		</tr>
		<tr>
			<td>Ảnh</td>
			<td><input type="file" name="txtanh"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Thêm mới">
			    <input type="reset" name="" value="Nhập lại"></td>
		</tr>
	</table>
</form>
</body>
</html>