<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Your Favorite Story</title>
    <link rel="stylesheet" href="/output.css">
    <link rel="stylesheet" href="/input.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body class="w-full">

    <?php
    $condir = "/components/navbar.php";
    include($_SERVER['DOCUMENT_ROOT'] . $condir);
    ?>



    <?php
    $condir = "/components/footer.php";
    include($_SERVER['DOCUMENT_ROOT'] . $condir);
    ?>

</body>

</html>