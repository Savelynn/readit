<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: /");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/output.css">
    <link rel="stylesheet" href="/input.css">
</head>

<body>

    <?php
    $condir = "/components/navbar.php";
    include($_SERVER['DOCUMENT_ROOT'] . $condir);
    ?>

    <div class="bg-gradient-to-b from-purple-200 to-violet-400 bg-cover bg-no-repeat h-auto p-5">
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
                    <textarea name="content" id="" placeholder="Write Content Here!" required></textarea>
                </div>
                <div class="w-full flex justify-end mt-2">
                    <button onclick="window.location.href = ''" class="px-4 py-[6px] bg-rose-600 ms-3 rounded-full w-[100px] text-white font-medium text-center">Reset</button>
                    <button type="submit" name="up" class="px-4 py-[6px] bg-indigo-600 ms-3 rounded-full w-[100px] text-white font-medium text-center">Submit</button>
                </div>
            </form>
        </section>
    </div>
    <?php
    $condir = "/components/footer.php";
    include($_SERVER['DOCUMENT_ROOT'] . $condir);
    ?>

    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/spd80pirgpeyo3i3qj7xz57wumobzu0be6t66vjlrsqwi364/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

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
</body>

</html>

<?php

if (isset($_POST['up'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = date("Y-m-d H:i:s");
}

?>