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

<style>
    #title {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
    }
</style>

<body class="w-full">

    <?php
    $navdir = "/components/navbar.php";
    include($_SERVER['DOCUMENT_ROOT'] . $navdir);
    ?>

    <?php
    $condir = "/conn/connect.php";
    require($_SERVER['DOCUMENT_ROOT'] . $condir);

    $sqlContent = "SELECT * FROM karya";
    $contentResult = mysqli_query($connect, $sqlContent);
    $contents = mysqli_fetch_all($contentResult, MYSQLI_ASSOC);
    ?>
    <section class="px-4 container mx-auto mb-4 mt-28">
        <div class="grid xl:grid-cols-4 grid-cols-2 gap-4">
            <?php foreach ($contents as $content) : ?>
                <?php
                $authorID = $content['author_id'];
                $SQLfindAuthor = "SELECT nick FROM user WHERE id=$authorID";
                $rawAuthor = $connect->query($SQLfindAuthor);
                $author = $rawAuthor->fetch_assoc();
                ?>
                <a class="overflow-hidden cursor-pointer shadow-xl rounded-xl border border-white hover:border-color-accent border-solid text-color-black hover:text-color-accent transition ease-in-out duration-300" href="read/?view=<?php $link = urlencode($content['title']);
                                                                                                                                                                                                                                        echo $link ?>">
                    <div class="overflow-hidden">
                        <img src="/image/cover/<?php echo $content['cover'] ?>" alt="" class="w-full h-64 object-cover hover:scale-125 transition-all ease duration-500" height="350px" width="350px">
                    </div>
                    <div class="p-4">
                        <p title="<?php echo $content['title']?>" class="font-bold md:text-xl text-md" id="title"><?php echo $content['title'] ?></p>
                        <p class="text-sm mt-2"><?php echo $author['nick'] ?></p>
                    </div>
                </a>
            <?php endforeach ?>
        </div>
    </section>

</body>

</html>