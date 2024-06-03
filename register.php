<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    label {
        display: block;
    }
</style>

<body>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">username</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">password</label>
                <input type="text" name="password" id="password">
            </li>
            <li>
                <label for="password2">confirm password</label>
                <input type="text" name="password2" id="password2">
            </li>
            <li>
                <label for="telp">nomor telpon</label>
                <input type="number" name="telp" inputmode="numeric" maxlength="14" id="telp">
            </li>
            <li>
                <label for="age">umur</label>
                <input type="number" name="age" id="age">
            </li>
            <li>
                <button type="submit" name="regis">register</button>
            </li>
        </ul>
    </form>
</body>

</html>

<?php

$condir = "/conn/connect.php";
include($_SERVER['DOCUMENT_ROOT'] . $condir);
session_start();

if (isset($_POST['regis'])) {

    $username = strtolower(stripslashes($_POST['username']));
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $password2 = mysqli_real_escape_string($connect, $_POST['password2']);
    $telp = $_POST['telp'];
    $age = $_POST['age'];

    if ($password !== $password2) {
        echo "<script>
        alert('konfirmasi password salah');
        window.location.href = '';
        </script>";
    } else {

        $query = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($connect, $query);
        if ($result->num_rows === 0) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "ALTER TABLE user AUTO_INCREMENT=1";
            mysqli_query($connect, $query);
            $query = "INSERT INTO user SET id=NULL, username='$username', password='$password', telp='$telp', role='user', age='$age'";
            mysqli_query($connect, $query);
            echo "<script>alert('register success!'); window.location.href = '/';</script>";

        } else {
            echo "<script>
            alert('username sudah terdaftar');
            window.location.href = '';
            </script>";
        }

    }

}

?>