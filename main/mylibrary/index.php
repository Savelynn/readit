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

<style>
    #title {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
    }
    @media only screen and (min-width: 640px) {
        #title {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
    }
    }
</style>

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
                    <div class="sm:h-[17vh] h-[8vh] rounded-sm md:rounded-lg lg:rounded-2xl bg-gray-200 overflow-hidden p-[1%] mb-3 relative">
                        <div class="max-w-[170px] w-[23%] md:w-[15%] h-full overflow-hidden rounded-xl inline-block">
                            <img src="/image/cover/<?php echo $myContent['cover'] ?>" alt="" class="w-full h-full object-cover">
                        </div>
                        <div class="inline-block absolute top-0 ms-3 max-w-[45%] md:max-w-[70%] overflow-hidden translate-y-[5%] h-full">
                            <h1 class="sm:text-xl text-sm font-semibold" id="title"><?php echo $myContent['title'];?></h1>
                        </div>
                        <div class="inline-block absolute right-2 top-1/2 -translate-y-1/2 text-center flex-col justify-between">
                            <a href="edit/?edit=<?php echo urlencode($myContent['title']) ?>" class="cursor-pointer py-1 px-2 sm:mb-[20%] md:py-1 md:px-2 md:text-xl text-white rounded-md block bg-blue-500">Edit</a>
                            <a href="delete.php?id=<?php echo $myContent['id']?>" class="cursor-pointer py-1 px-2 md:py-1 md:px-2 md:text-xl text-white rounded-md block bg-color-youtube">Delete</a>
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