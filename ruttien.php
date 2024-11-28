<?php 
    session_start();

    if (isset($_SESSION['trangthailogin']) == false) {
        header("Location: index.php");
    } else {
        # session trangthailogin = true => da login <=> session đã được khởi tạo
        # kiểm tra trạng thái đăng nhập
        $isLogin = $_SESSION['trangthailogin'];
        if ($isLogin == true) {
            $tendn = $_SESSION['tendangnhap'];
            echo "Xin chao $tendn";
        } else {
            echo "Ban chua dang nhap";
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Rut tien</h1>
    <?php include("shared/menu.php") ?>
</body>
</html>