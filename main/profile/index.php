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
</head>
<body class="bg-gray-100">



    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Profile Settings</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="flex justify-center mb-4">
                <img class="w-24 h-24 rounded-full rou object-cover" src="https://placehold.jp/150x150.png" alt="Profile Picture">
            </div>
            <div class="text-center p-2">
                <p class="font-semibold">Role : <?php echo $user['role'];?></p>
            </div>
            <div class="mb-4">
                <input type="file" name="profile_picture" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-e-lg border border-gray-300 cursor-pointer focus:outline-none">
            </div>
            <div class="mb-4">
                <input type="text" name="name" value="<?php echo $user['username']; ?>" placeholder="<?php echo $user['username']; ?>" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <input type="number" name="age" value="<?php echo $user['age']; ?>" placeholder="<?php echo $user['age']; ?>" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <input type="tel" name="phone" value="<?php echo $user['telp']; ?>" placeholder="<?php echo $user['telp']; ?>" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <input type="password" name="password" placeholder="New Password" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <button type="submit" name="update" class="w-full bg-blue-500 text-white p-2 rounded-lg">Update Profile</button>
        </form>
    </div>
</body>
</html>
