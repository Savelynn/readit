<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/output.css">
</head>

<body class="">

    <?php
    $condir = "/components/navbar.php";
    include($_SERVER['DOCUMENT_ROOT'] . $condir);
    ?>

    <section class="mx-auto mt-28 w-[1536px] max-w-[95%]">
        <form action="">
            <div class="my-2">
                <label for="title" class="block">Title</label>
                <input type="text" name="title" id="title" class="p-2 bg-slate-300 rounded-sm w-full" required>
            </div>
            <div class="my-2">
                <label for="cover" class="block">Upload Cover</label>
                <input type="file" name="cover" id="cover" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-e-lg border border-gray-300 cursor-pointer focus:outline-none" required>
            </div>
            <div class="my-2">
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

</body>

</html>