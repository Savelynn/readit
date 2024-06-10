<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: /");
    exit();
}

date_default_timezone_set('Asia/Jakarta');

$condir = "/conn/connect.php";
include($_SERVER['DOCUMENT_ROOT'] . $condir);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Story - Readit</title>
    <link rel="stylesheet" href="/output.css">
    <link rel="stylesheet" href="/input.css">
</head>

<style>
    .category {
        border: 2px solid white;
    }

    @media only screen and (min-width: 2200px) {
        body {
            height: 100vh;
        }
    }
</style>

<body class="bg-gradient-to-b from-purple-200 to-violet-400 bg-cover bg-no-repeat">

    <?php
    $navdir = "/components/navbar.php";
    include($_SERVER['DOCUMENT_ROOT'] . $navdir);
    ?>

    <?php

    $rawKategory = mysqli_query($connect, "SELECT * FROM kategori");
    $kategori = mysqli_fetch_all($rawKategory, MYSQLI_ASSOC);

    ?>
    <div class="p-5">
        <section class="mx-auto w-[1536px] max-w-[95%] p-2 mt-28 mb-10">
            <form action="" method="post" enctype="multipart/form-data" class="p-1">
                <div class="my-6 flex w-full justify-center items-center">
                    <label for="input-file" id="drop-area" class="w-[500px] h-[300px] p-[30px] bg-white rounded-[20px] text-center">
                        <input type="file" accept="image/*" name="cover" id="input-file" hidden>
                        <div id="img-view" class="bg-cover bg-center w-full h-full rounded-[20px] border-violet-400 bg-gray-100" style="border: dashed 2px;">
                            <img src="/assets/create/uploadimg.png" class="mx-auto w-[100px] mt-[25px]">
                            <p>Drag and drop or click here<br>to upload cover</p>
                            <span class="block text-[12px] text-gray-400 mt-[15px]">Upload any images from desktop</span>
                        </div>
                    </label>
                </div>
                <div class="mt-6">
                    <input type="text" name="title" id="title" class="py-4 px-4 bg-white rounded-t-md w-full text-xl font-bold focus:outline-none border-solid border-gray-200 border-2" placeholder="Input title" required>
                </div>
                <div class="mb-6 -mt-2">
                    <textarea name="content" id="" placeholder="Write Content Here!"></textarea>
                </div>
                <div class="flex-row flex-wrap p-3 border-solid border-violet-700 rounded-2xl border-t-[1px] border-s-[1px] border-e-[1px] rounded-br-none">
                    <?php foreach ($kategori as $cat) : ?>
                        <div class="inline-block my-5">
                            <label for="<?php echo $cat['id']; ?>" class="rounded-full px-4 py-1 text-center mx-1 mb-3 bg-white category">
                                <?php echo $cat['kategori']; ?>
                                <input type="checkbox" name="category[]" id="<?php echo $cat['id']; ?>" value="<?php echo $cat['id']; ?>" hidden>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p class="-translate-y-[18px] translate-x-[18px] text-white font-semibold text-xl">Genre</p>
                <div class="w-full flex justify-end mt-2">
                    <button onclick="window.location.href = ''" class="px-4 py-[6px] bg-rose-600 ms-3 rounded-full w-[100px] text-white font-medium text-center">Reset</button>
                    <button type="submit" name="up" class="px-4 py-[6px] bg-indigo-600 ms-3 rounded-full w-[100px] text-white font-medium text-center">Submit</button>
                </div>
            </form>
        </section>
    </div>

    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/6baj1zqurjx38kd05gsw5wh8ewepk2cfcjoq2bxib4a8hzke/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
        });
    </script>
    <script src="script.js"></script>
    <?php

    if (isset($_POST['up'])) {

        $title = $_POST['title'];
        $content = $_POST['content'];
        $authorID = $_SESSION['id'];
        $username = $_SESSION['username'];

        if (isset($_POST['category'])) {
            $category = implode(',', $_POST['category']);
        } else {
            $category = '';
        }

        $imgAble = false;
        if ($_FILES['cover']['name'] != NULL) {
            $fileName = $_FILES['cover']['name'];
            $tmp_file = $_FILES['cover']['tmp_name'];
            if (getimagesize($tmp_file) !== false) {
                $imgDate = date("Ymd_His");
                $newName = $imgDate . "_" . $title . "_" . $username . "_" . $fileName;
                $path = $_SERVER['DOCUMENT_ROOT'] . "/image/cover/" . $newName;
                $imgAble = true;
            } else {
                echo "<script>
                    alert('The uploaded file is not a valid image.');
                    window.location.href = '';
                    </script>";
                exit();
            }
        } else {
            $newName = "no_cover.png";
        }

        $postContentQuery = "INSERT INTO karya (id_kat, title, content, cover, author_id) VALUES ('$category', '$title', '$content', '$newName', $authorID)";
        if (mysqli_query($connect, $postContentQuery)) {
            if ($imgAble) {
                move_uploaded_file($tmp_file, $path);
            }
            echo "<script>
                alert('Content successfully added')
                window.location.href = '/main';
                </script>";
        } else {
            echo "<script>
                alert('Failed To Upload Content!');
                window.location.href = '';
                </script>";
        }
    }
    $connect->close();
    ?>
</body>

</html>