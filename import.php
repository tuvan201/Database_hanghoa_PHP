<?php 
// $server="localhost";
// $user='mysqli';
// $password='211001';
// $database_name='mysqli';
//kết nối dữ liệu
$conn=mysqli_connect("localhost",'mysqli','211001','mysqli');
function connectDatabase()
{
    $conn=mysqli_connect("localhost",'mysqli','211001','mysqli');
    return $conn;   
}
function insertTableHangHoa($mahang,$tenhang,$dongia,$soluong,$dvt,$hinhanh){

    $bool=false;
    $conn=connectDatabase();
    //Kiểm tra trước đó đã tồn tại mã hàng người dùng định truyền vào chưa
    $sql="SELECT * FROM hanghoa WHERE Mahang='$mahang'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)==0)
    {
     //thỏa mãn thì insert
     $sql= "INSERT INTO `hanghoa`(`Mahang`, `Tenhang`, `Dongia`, `Soluong`, `DVT`, `Anh`)
      VALUES ('$mahang','$tenhang','$dongia','$soluong','$dvt','$hinhanh')";
     mysqli_query($conn,$sql);
     $bool=true;
    }
    
    return $bool;
}
function updateTableHangHoa($mahang,$tenhang,$dongia,$soluong,$dvt,$hinhanh){

    $bool=false;
    $conn=connectDatabase();
    $sql="SELECT * FROM hanghoa WHERE Mahang=$mahang";
    $result = mysqli_query($conn,$sql);
    //kiểm tra xem có tồn tại mã hàng mà người dùng muốn thay đổi không
    if(mysqli_num_rows($result)>0){
        $sql="UPDATE `hanghoa` SET `Mahang`='$mahang',`Tenhang`='$tenhang',`Dongia`='$dongia',`Soluong`='$soluong',`DVT`='$dvt',`Anh`='$hinhanh' WHERE Mahang = '$mahang'";
        mysqli_query($conn,$sql);
        $bool=true;
    }
    return $bool;

}
function deleteTableHangHoa($mahang){
    
    $bool=false;
    $conn=connectDatabase();
    $sql="SELECT * FROM hanghoa WHERE Mahang=$mahang";
    $result = mysqli_query($conn,$sql);
    //kiểm tra xem có tồn tại mã hàng mà người dùng muốn xóa
    if(mysqli_num_rows($result)>0){
        $sql="DELETE FROM `hanghoa` WHERE mahang='$mahang'";
        mysqli_query($conn,$sql);
        $bool=true;
    }
    return $bool;
}
function selectAllFromHangHoa($mahang){
    
    $bool=false;
    $conn=connectDatabase();
    $sql="SELECT * FROM hanghoa WHERE Mahang=$mahang";
    $result = mysqli_query($conn,$sql);
    //kiểm tra xem có tồn tại hàng hóa mà người dùng muốn tìm
    if(mysqli_num_rows($result)>0){
        
        $row=mysqli_fetch_array($result);
        return $row;
        exit();
    }
    return $bool;
}

?>