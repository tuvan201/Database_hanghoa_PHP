<?php 
include"import.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa dữ liệu</title>
	<link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
<?php 
$data=array();
$mahang=$_GET["mahang"];
$result=selectAllFromHangHoa($mahang);
isset($_GET["check_img"]) ? $check_img="" :$check_img="<br>tên file cũ:$result[5] (dữ liệu mặc định là file ảnh cũ)";
//var_dump($result);
    if(isset($_POST["submit"]))
    {   
		//tạo array_error, đang demo nên lược bớt
        $data["mahang"]=!empty($_POST['txtmahang']) ? $_POST['txtmahang'] : "";
        $data["tenhang"]=!empty($_POST['txttenhang']) ? $_POST['txttenhang'] : "";
        $data["dongia"]=!empty($_POST['txtdongia']) ? $_POST['txtdongia'] : "";
        $data["soluong"]=!empty($_POST['txtsoluong']) ? $_POST['txtsoluong'] : "";
        $data["dvt"]=!empty($_POST['txtdvt']) ? $_POST['txtdvt'] : "";

		//Nếu người dùng ấn xóa ảnh hiện tại và submit thì gán column hình ảnh có giá trị là "chưa có"
		if($_GET["check_img"]=="delete"){
			$data["anh"]="chưa có";
		}
		//Nếu xóa ảnh hiện tại và gán lại ảnh khác rồi submit
		if(!empty($_FILES['txtanh']['name'])){
			$data["anh"]=!empty($_FILES['txtanh']['name']) ? basename($_FILES['txtanh']['name']) : "" ;
		}
		//VALIDATE HÌNH ẢNH
		$target_dir="upload_img/";
		$target_file=$target_dir.$data["anh"];
        $imageFileTypes=pathinfo($target_file,PATHINFO_EXTENSION);
		$allowtypes = array('jpg', 'png', 'jpeg', 'gif');

		//Nếu người dùng upload file ảnh mới là file ảnh(true)
		if(in_array($imageFileTypes,$allowtypes))
		{
			move_uploaded_file($_FILES['txtanh']['tmp_name'],$target_file);

			if(updateTableHangHoa($data["mahang"],$data["tenhang"],$data["dongia"],$data["soluong"],$data["dvt"],$data["anh"]))
			{
				header("location:index.php");
			}
			else
			{
				echo"mã hàng bạn nhập không tồn tại";
			}
			
		}
		else
		{
			//Nếu người dùng giữ nguyên ảnh và ấn submit
			if(empty($data["anh"]))
			{
				if(updateTableHangHoa($data["mahang"],$data["tenhang"],$data["dongia"],$data["soluong"],$data["dvt"],$result["Anh"]))
				{
					header("location:index.php");
				}
				else
				{
					echo"mã hàng bạn nhập không tồn tại";
				}
			}
			//Nếu người dùng ấn xóa ảnh hiện tại và gửi submit 
			else if($_GET["check_img"]=="delete")
			{
				if(updateTableHangHoa($data["mahang"],$data["tenhang"],$data["dongia"],$data["soluong"],$data["dvt"],$data["anh"]))
				{
					header("location:index.php");
				}
				else
				{
					echo"mã hàng bạn nhập không tồn tại";
				}
			}
			//Nếu không phải là file ảnh
			else
			{
				echo "không phải là file ảnh";
			}
		}
    }
    ?>
		<a href="index.php">BACK</a>
<form method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<td>Mã hàng</td>
			<td><input type="text" name="txtmahang" value="<?php echo isset($_POST["submit"])? $data["mahang"] : $result[0]; ?>"></td>
		</tr>
		<tr>
			<td>Tên hàng</td>
			<td><input type="text" name="txttenhang" value="<?php echo isset($_POST["submit"])? $data["tenhang"] :$result[1]; ?>"></td>
		</tr>
		<tr>
			<td>Đơn giá</td>
			<td><input type="text" name="txtdongia" value="<?php echo isset($_POST["submit"])? $data["dongia"] : $result[2]; ?>"></td>
		</tr>
		<tr>
			<td>Số lượng</td>
			<td><input type="text" name="txtsoluong" value="<?php echo isset($_POST["submit"])? $data["soluong"] : $result[3]; ?>"></td>
		</tr>
		<tr>
			<td>DVT</td>
			<td><input type="text" name="txtdvt" value="<?php echo isset($_POST["submit"])? $data["dvt"] : $result[4]; ?>"></td>
		</tr>
		<tr>
			<td>Ảnh</td>
			<td><input type="file" name="txtanh"><?php echo $check_img;?>
			<a href="update.php?check_img=delete&mahang=<?php echo $result[0]; ?>" onclick="return confirm('Bạn có chắc muốn xóa ảnh hiện tại?');">
				<img style="vertical-align: middle;width:30px;"  src="icons/delete icon.svg" alt="delete image"></a></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Chỉnh sửa">
			    <input type="reset" name="" value="Nhập lại"></td>
		</tr>
	</table>
</form>
</body>
</html>