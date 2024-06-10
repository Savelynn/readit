<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../");
    exit();
}

$condir = "/conn/connect.php";
require($_SERVER['DOCUMENT_ROOT'] . $condir);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/output.css">
    <link rel="stylesheet" href="/input.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<style>
    #content p {
        margin-bottom: 20px;
    }

    #content img {
        margin: 0 auto;
    }
</style>

<body>
    <?php
    $navdir = "/components/navbar.php";
    include($_SERVER['DOCUMENT_ROOT'] . $navdir);
    ?>

    <?php if (isset($_GET['view'])) : ?>

        <?php
        $getContent = $_GET['view'];
        $callContent = "SELECT * FROM karya WHERE title='$getContent'";
        $contentRaw = $connect->query($callContent);
        ?>

        <?php if ($contentRaw->num_rows > 0) : ?>

            <?php
            $content = mysqli_fetch_all($contentRaw, MYSQLI_ASSOC);
            $authorID = $content[0]['author_id'];
            $callAuthor = "SELECT nick FROM user WHERE id=$authorID";
            $authorRaw = mysqli_query($connect, $callAuthor);
            $author = mysqli_fetch_all($authorRaw, MYSQLI_ASSOC);

            $viewNow = $content[0]['open'];
            $viewNow +=1;
            $tit = $content[0]['title'];
            $SQLaddViewer = "UPDATE karya SET open=$viewNow WHERE title='$tit'";
            mysqli_query($connect, $SQLaddViewer);
            ?>

            <title>Reading <?php echo $content[0]['title'] ?></title>

            <section class="w-[75%] xl:w-[70%] mx-auto py-10 px-5 bg-color-primary h-auto mt-28 rounded-2px">
                <div class="text-center">
                    <h1 class="font-extrabold lg:text-2xl sm:text-md text-sm mb-10"><?php echo $content[0]['title'] ?></h1>
                </div>
                <div class="text-center mb-6">
                    <h5 class="font-bold opacity-30">author : <?php echo $author[0]['nick'] ?></h5>
                    <?php if ($content[0]['id_kat']) : ?>
                        <div class="px-4 py-1 text-center border-[1px] border-solid border-black hover:border-color-accent duration-300 my-7 inline-block rounded-full mx-auto">
                            <?php
                            $kategori_ids = explode(',', $content[0]['id_kat']);
                            foreach ($kategori_ids as $id) :
                                $sql_kategori = "SELECT kategori FROM kategori WHERE id = $id";
                                $kategoriRaw = $connect->query($sql_kategori);
                                $kategoriString = $kategoriRaw->fetch_assoc();
                            ?>
                                <p class="inline-block opacity-70 text-sm"><?php echo $kategoriString['kategori'] ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <img src="/image/cover/<?php echo $content[0]['cover'] ?>" alt="" class="lg:w-[60%] mx-auto mb-20">
                </div>
                <div class="break-words" id="content">
                    <?php echo $content[0]['content'] ?>
                </div>
            </section>
        <?php else : ?>
            <section class="w-[75%] xl:w-[70%] mx-auto py-10 px-5 bg-color-primary h-auto mt-28 rounded-2px">
                <div class="text-center">
                    <h1 class="font-extrabold lg:text-2xl sm:text-md text-sm mb-10">CONTENT NOT AVAILABLE</h1>
                </div>
            </section>
        <?php endif; ?>
    <?php else : ?>
        <section class="w-[75%] xl:w-[70%] mx-auto py-10 px-5 bg-color-primary h-auto mt-28 rounded-2px">
            <div class="text-center">
                <h1 class="font-extrabold lg:text-2xl sm:text-md text-sm mb-10">CONTENT NOT AVAILABLE</h1>
            </div>
        </section>
    <?php endif; ?>
</body>

</html>