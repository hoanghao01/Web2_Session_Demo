<?php 
    session_start();

    session_unset();

    session_destroy();

    header("Location: index.php");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log out</title>
</head>
<body>
    
</body>
</html>