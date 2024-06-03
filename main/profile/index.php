<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: /");
    exit();
}

// Koneksi ke database
$condir = "/conn/connect.php";
require($_SERVER['DOCUMENT_ROOT'] . $condir);

$username = $_SESSION['username'];
$query = "SELECT * FROM user WHERE username='$username'";
$result = $connect->query($query);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="/output.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body class="bg-gray-100">



    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4"><?php echo $user['username']; ?> Profile</h2>
        <form action="" method="post">
            <div class="flex justify-center mb-4">
                <img class="w-24 h-24 rounded-full rou object-cover" src="https://placehold.jp/150x150.png" alt="Profile Picture">
            </div>
            <div class="text-center p-2">
                <p class="font-semibold">Role : <?php echo $user['role']; ?></p>
            </div>
            <div class="mb-4">
                <input type="file" name="profile_picture" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-e-lg border border-gray-300 cursor-pointer focus:outline-none">
            </div>
            <div class="mb-4">
                <input type="text" name="nick" value="<?php echo $user['nick']; ?>" placeholder="<?php echo $user['nick'] ? $user['nick'] : 'Insert Nickname'; ?>" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <input type="number" name="age" value="<?php echo $user['age']; ?>" placeholder="<?php echo $user['age']; ?>" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <input type="tel" name="telp" value="<?php echo $user['telp']; ?>" placeholder="<?php echo $user['telp']; ?>" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4 h-full relative">
                <input type="checkbox" name="changePass" id=""> Change Password?
                <div class="h-full relative">
                    <input type="password" name="password" placeholder="New Password" class="w-full p-2 border border-gray-300 rounded-lg" id="password">
                    <button class="focus:outline-none absolute bottom-1/2 translate-y-1/2 -translate-x-6" type="button" id="togglePassword"><i class="ph ph-eye-closed" id="icon"></i></button>
                </div>
            </div>
            <button type="submit" name="update" class="w-full bg-blue-500 text-white p-2 rounded-lg">Update Profile</button>
        </form>
    </div>

    <?php

    if (isset($_POST['update'])) {

        $nick = $_POST['nick'];
        $age = $_POST['age'];
        $telp = $_POST['telp'];
        $id = $_SESSION['id'];

        if (isset($_POST['changePass'])) {
            $password = $_POST['password'];
            $password = mysqli_real_escape_string($connect, $_POST['password']);
            $password = password_hash($password, PASSWORD_DEFAULT);
            $update = "UPDATE user SET nick='$nick', age='$age', telp='$telp', password='$password' WHERE id='$id'";
            mysqli_query($connect, $update);
            echo "<script>
                  alert('ubah data berhasil');
                  window.location.href = '';
                  </script>";
        } else {
            $update = "UPDATE user SET nick='$nick', age='$age', telp='$telp' WHERE id='$id'";
            mysqli_query($connect, $update);
            echo "<script>
                  alert('ubah data berhasil');
                  window.location.href = '';
                  </script>";
        }
    }


    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passIn = document.getElementById('password');
            const btn = document.getElementById('togglePassword');
            const icon = document.getElementById('icon')
            btn.addEventListener('click', function() {
                if (passIn.getAttribute('type') === 'password') {
                    passIn.setAttribute('type', 'text');
                    icon.classList.remove('ph-eye-closed');
                    icon.classList.add('ph-eye');
                } else {
                    passIn.setAttribute('type', 'password');
                    icon.classList.remove('ph-eye');
                    icon.classList.add('ph-eye-closed');
                }
            });
        });
    </script>

</body>

</html>