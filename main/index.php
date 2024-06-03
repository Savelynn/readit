<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="/output.css">
</head>

<body class="w-full">

    <?php
    $condir = "/components/navbar.php";
    include($_SERVER['DOCUMENT_ROOT'] . $condir);
    ?>

    <script>
        const menuDropdown = () => {
            const navDrop = document.getElementById('dropdown');
            navDrop.classList.toggle('hidden')
        }
    </script>

</body>

</html>