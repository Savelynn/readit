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
    <title>Login Area</title>
    <link rel="stylesheet" href="/output.css">
    <link rel="stylesheet" href="/input.css">
</head>

<body class="w-full h-screen bg-slate-900">

    <?php
    $condir = "/components/navbar.php";
    include($_SERVER['DOCUMENT_ROOT'] . $condir);
    ?>

    <div class="absolute w-[448px] max-w-[90%] bg-white p-6 rounded-lg shadow-lg left-1/2 -translate-x-1/2 mt-28">
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
                <input type="text" name="nick" value="<?php echo $user['nick']; ?>" placeholder="<?php echo $user['nick'] ? $user['nick'] : 'Insert Nickname'; ?>" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <input type="number" name="age" value="<?php echo $user['age']; ?>" placeholder="<?php echo $user['age']; ?>" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <input type="tel" name="telp" value="<?php echo $user['telp']; ?>" placeholder="<?php echo $user['telp']; ?>" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4 h-full relative">
                <input type="checkbox" name="changePass" id="passTog"> Change Password?
                <div class="h-full relative mb-4">
                    <input type="password" name="password0" placeholder="Old Password" class="w-full p-2 border border-gray-300 rounded-lg" id="password0">
                    <button class="focus:outline-none absolute bottom-1/2 translate-y-1/2 -translate-x-6 mb-" type="button" onclick="showPass('password0','icon0')"><i class="ph ph-eye-closed" id="icon0"></i></button>
                </div>
                <div class="h-full relative mb-4">
                    <input type="password" name="password1" placeholder="New Password" class="w-full p-2 border border-gray-300 rounded-lg" id="password1">
                    <button class="focus:outline-none absolute bottom-1/2 translate-y-1/2 -translate-x-6 mb-" type="button" onclick="showPass('password1','icon1')"><i class="ph ph-eye-closed" id="icon1"></i></button>
                </div>
                <div class="h-full relative mb-4">
                    <input type="password" name="password2" placeholder="Confirm New Password" class="w-full p-2 border border-gray-300 rounded-lg" id="password2">
                    <button class="focus:outline-none absolute bottom-1/2 translate-y-1/2 -translate-x-6" type="button" onclick="showPass('password2','icon2')"><i class="ph ph-eye-closed" id="icon2"></i></button>
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
            $oldPass = $_POST['password0'];
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];

            if ($password1 === $password2) {

                $callPass = "SELECT password FROM user WHERE id='$id'";
                $result = mysqli_query($connect, $callPass);
                $pass = $result->fetch_assoc();


                if (password_verify($oldPass, $pass['password'])) {

                    $password = mysqli_real_escape_string($connect, $_POST['password1']);
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $update = "UPDATE user SET nick='$nick', age='$age', telp='$telp', password='$password' WHERE id='$id'";
                    mysqli_query($connect, $update);
                    echo "<script>
                    alert('data successfully updated! pw');
                    window.location.href = '';
                    </script>";
                } else {
                    echo "<script>
                    alert('Wrong Old Password!')
                    window.location.href = '';
                    </script>";
                }
            } else {
                echo "<script>
                alert('Confirm Password Not Match')
                window.location.href = '';
                </script>";
            }
        } else {
            $update = "UPDATE user SET nick='$nick', age='$age', telp='$telp' WHERE id='$id'";
            mysqli_query($connect, $update);
            echo "<script>
                  alert('data successfully updated! nopw');
                  window.location.href = '';
                  </script>";
        }
    }


    ?>

    <script>
        document.getElementById('passTog').addEventListener('click', function() {
            let isPass = document.getElementById('passTog').checked;
            if (isPass === true) {
                document.getElementById('password0').setAttribute('required', '');
                document.getElementById('password1').setAttribute('required', '');
                document.getElementById('password2').setAttribute('required', '');
            } else {
                document.getElementById('password0').removeAttribute('required');
                document.getElementById('password1').removeAttribute('required');
                document.getElementById('password2').removeAttribute('required');
            }
        })


        function showPass(pass, icon) {
            var passIn = document.getElementById(pass);
            var icon = document.getElementById(icon);

            if (passIn.getAttribute('type') === 'password') {
                passIn.setAttribute('type', 'text');
                icon.classList.remove('ph-eye-closed');
                icon.classList.add('ph-eye');
            } else {
                passIn.setAttribute('type', 'password');
                icon.classList.remove('ph-eye');
                icon.classList.add('ph-eye-closed');
            }
        }
    </script>

</body>

</html>