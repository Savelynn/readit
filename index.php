<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Area</title>
    <link rel="stylesheet" href="/output.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    hr {
        height: 1px;
        background-color: grey;
        border: none;
        translate: x;
    }
</style>

<body class="w-full h-screen bg-no-repeat bg-cover relative" style="background-image: url('/assets/login/bg-login.png');">
    <div class="max-w-[90%] w-[450px] h-[550px] rounded-md bg-cyan-950 bg-opacity-[98%] py-8 px-8 fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" style="max-width: 90%;">
        <div class="h-full flex-col">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold opacity-100 text-white">LOGIN</h1>
            </div>
            <div class="flex-col h-96">
                <form method="post">
                    <div class="flex-col justify-between relative">
                        <div>
                            <div class="relative inline-block text-white w-full mt-6 mb-6">
                                <input class="px-6 peer pt-6 pb-2 bg-cyan-900 w-full rounded-md outline-none opacity-[99%]" type="text" name="username" id="username" placeholder=" " maxlength="16" require>
                                <label class="absolute peer-placeholder-shown:top-1/2 top-4 left-6 -translate-y-1/2 cursor-text text-xs peer-placeholder-shown:text-base peer-focus:top-4 peer-focus:text-xs peer-focus:text-gray-300 transition-all duration-200" for="username">username</label>
                            </div>

                            <div class="relative text-white w-full mt-6 flex items-center">
                                <input class="px-6 peer pt-6 pb-2 bg-cyan-900 w-full rounded-md outline-none opacity-[99%]" type="password" name="password" id="password" placeholder=" " maxlength="20" require>
                                <label class="absolute peer-placeholder-shown:top-1/2 top-4 left-6 -translate-y-1/2 cursor-text text-xs peer-placeholder-shown:text-base peer-focus:top-4 peer-focus:text-xs peer-focus:text-gray-300 transition-all duration-200" for="password">password</label>
                                <button class="focus:outline-none mx-4 absolute right-0" type="button" id="togglePassword"><i class="ph ph-eye-closed" id="icon"></i></button>
                            </div>
                            <div>
                                <a class="text-white underline underline-offset-2 cursor-pointer hover:text-cyan-600 my-1">forgot your password?</a>
                            </div>
                        </div>

                        <div class="mt-28">
                            <button class="bg-cyan-500 w-full px-4 py-4 rounded-md bottom-0 font-semibold text-xl" type="submit" name="login" value="login">Login</button>
                            <a href="/register.php" class="text-white underline underline-offset-2 text-sm cursor-pointer hover:text-cyan-600 my-1">Don't Have Account? Click Here!</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php

    $condir = "/conn/connect.php";
    include($_SERVER['DOCUMENT_ROOT'] . $condir);
    session_start();

    if (isset($_SESSION['username'])) {
        header("Location: main");
        exit();
    }

    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $result = $connect->query("SELECT * FROM user WHERE username='$username'");
        $user = $result->fetch_assoc();

        if ($result->num_rows > 0) {

            if (password_verify($password, $user['password'])) {
                // Login berhasil
                $_SESSION["username"] = $user['username'];
                $_SESSION["id"] = $user['id'];
                header("Location: main"); // Sesuaikan dengan halaman setelah login berhasil
                exit();
            } else {
                echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Failed Login',
                text: 'Check your username or password',
                showConfirmButton: false,
                timer: 1500
           })
           .then(function () {
               window.location.href = '';
           })
        </script>";
            }
        } else {
            echo "<script>
             Swal.fire({
                 icon: 'error',
                 title: 'Failed Login',
                 text: 'Check your username or password',
                 showConfirmButton: false,
                 timer: 1500
            })
            .then(function () {
                window.location.href = '';
            })
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