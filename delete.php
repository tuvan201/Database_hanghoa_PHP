<?php 
include"import.php";
if(deleteTableHangHoa($_POST["mahang"])){
    header("location:index.php");
}
else{
    echo "xóa không thành công";
}
?>