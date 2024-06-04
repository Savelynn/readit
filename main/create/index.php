<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/output.css">
</head>

<body class="bg-gradient-to-b from-purple-200 to-violet-400 bg-cover bg-no-repeat h-screen">

    <?php
    $condir = "/components/navbar.php";
    include($_SERVER['DOCUMENT_ROOT'] . $condir);
    ?>

    <section class="mx-auto mt-28 w-[1536px] max-w-[95%]">
        <form action="">
            <div class="my-6 flex w-full justify-center items-center">
                <label for="input-file" id="drop-area" class="w-[500px] h-[300px] p-[30px] bg-white rounded-[20px] text-center">
                    <input type="file" accept="image/*" name="cover" id="input-file" hidden>
                    <div id="img-view" class="bg-cover w-full h-full rounded-[20px] border-violet-400 bg-gray-100" style="border: dashed 2px;">
                        <img src="/assets/create/uploadimg.png" class="mx-auto w-[100px] mt-[25px]">
                        <p>Drag and drop or click here<br>to upload cover</p>
                        <span class="block text-[12px] text-gray-400 mt-[15px]">Upload any images from desktop</span>
                    </div>
                </label>
            </div>
            <div class="my-6">
                <input type="text" name="title" id="title" class="py-4 px-4 bg-white rounded-md w-full text-xl font-bold" placeholder="Input title" required>
            </div>
            <div class="my-6">
                <textarea name="" id="" placeholder="Write Content Here!" required></textarea>
            </div>

        </form>
    </section>

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
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    </script>
    <script src="script.js"></script>
</body>

</html>