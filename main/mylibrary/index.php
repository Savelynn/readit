<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: /");
    exit();
}

$condir = "/conn/connect.php";
include($_SERVER['DOCUMENT_ROOT'] . $condir);

$authorID = $_SESSION['id'];
$SQLcallMyContent = "SELECT * FROM karya WHERE author_id=$authorID";
$myContentRaw = mysqli_query($connect, $SQLcallMyContent);
$myContents = mysqli_fetch_all($myContentRaw, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Content - Readit</title>
    <link rel="stylesheet" href="/output.css">
    <link rel="stylesheet" href="/input.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body>

    <?php
    $navdir = "/components/navbar.php";
    include($_SERVER['DOCUMENT_ROOT'] . $navdir);
    ?>

    <section class="mt-28 mx-auto max-w-[95%] lg:max-w-[83%] bg-color-primary h-auto rounded-2xl drop-shadow-2xl py-10 px-4">
        <div class="text-center mb-5">
            <h1 class="text-2xl font-bold">Your Content</h1>
        </div>
        <div class="max-w-[98%] h-auto mx-auto p-2">
            <?php if ($myContents) : ?>
                <?php foreach ($myContents as $myContent) : ?>
                    <div class="h-[17vh] rounded-sm md:rounded-lg lg:rounded-2xl bg-gray-200 overflow-hidden p-[1%] mb-3">
                        <div class="max-w-[170px] w-[23%] md:w-[15%] h-full overflow-hidden rounded-xl">
                            <img src="/image/cover/<?php echo $myContent['cover'] ?>" alt="" class="w-full h-full">
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="text-center font-black opacity-35 text-xl">
                    <h1>YOU DONT HAVE ANY CONTENT HERE!</h1>
                </div>
            <?php endif; ?>
        </div>
    </section>

</body>

</html>