<?php
    session_start();

    echo "<p>Trước khi khởi tạo session:</p>";
    var_dump($_SESSION['trangthailogin']);

    #khởi tạo session lần đầu (1 lần duy nhất)
    if (isset($_SESSION['trangthailogin']) == false) {
        $_SESSION['trangthailogin'] = false;    #false = chua login
        $_SESSION['tendangnhap'] = "";
    }

    echo "<p>Sau khi khởi tạo session:</p>";
    var_dump($_SESSION['trangthailogin']);

    //------------------------------------------------------------------------
    $host = "localhost";
    $dbname = "session_demo_db";
    $username = "root";
    $password = "";

    #ket noi csdl
    $ketnoi = mysqli_connect($host, $username, $password, $dbname);

    #kiem tra ket noi
    if (!$ketnoi) {
        die("Ket noi that bai: " . mysqli_connect_error());
    }

    //------------------------------------------------------------------------
    # Xử lý dữ liệu login nếu có
    $errorLogin = "";
    if (isset($_POST['tendangnhap'])) {
        $tendangnhap_input = $_POST['tendangnhap'];
        $matkhau_input = $_POST['matkhau'];

        $sql = "SELECT username, matkhau FROM user WHERE username = '$tendangnhap_input'";
        $result = mysqli_query($ketnoi, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $db_username = $row['username'];
            $db_matkhau = $row['matkhau'];

            if ($db_matkhau == $matkhau_input) {
                // Đăng nhập thành công
                $_SESSION['trangthailogin'] = true;
                $_SESSION['tendangnhap'] = $tendangnhap_input;
                $errorLogin = "";
            } else {
                $errorLogin = "<b style='color:red'>Mật khẩu không chính xác!</b>";
            }
            
            
        } else {
            $errorLogin = "<b style='color:red'>Tên đăng nhập không tồn tại!</b>";
        }

        // if ($tendangnhap_input == "admin" && $matkhau_input == "123") {
        //     $_SESSION['trangthailogin'] = true;
        //     $_SESSION['tendangnhap'] = $tendangnhap;
        //     $errorLogin = "";
        // } else {
        //     $errorLogin = "<b style='color:red'>Đăng nhập thất bại!</b>";
        // }
    } else {
        $errorLogin = "<b style='color:red'>Đăng nhập thất bại!</b>";
    }

    mysqli_close($ketnoi);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Demo PHP Session</h1>

    <?php include("shared/menu.php") ?>
    <hr>

    <?php
    if ($_SESSION['trangthailogin'] == false) {
    ?>
        <?php echo $errorLogin; ?>


        <form action="" method="post">
            <div>
                Username: <input type="text" name="tendangnhap" placeholder="admin">
            </div>
            <div>
                Password: <input type="password" name="matkhau" placeholder="123">
            </div>
            <div>
                <input type="submit" value="Login">
            </div>
            
        </form>
    <?php
    } else {
        echo "<p>Hello " . $_SESSION['tendangnhap'] . "</p>";
        echo "<a href='logout.php'>Log out</a>";
    }
    ?>

</body>

</html>