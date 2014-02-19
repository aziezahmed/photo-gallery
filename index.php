<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Slideshow</title>

    <meta name="description" content="A simple html/php slideshow page">
    <meta name="author" content="Aziez Ahmed Chawdhary">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css"/>
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>

    <script>

        var file_types = [".jpg", ".JPG", ".png"]; // This should include any file type that you want included. It is case-sensitive.

        var files = []; // The PHP code below will fill this array with the file name of all the files in this directory

        <?php
           $dir = '.';
           $files1 = scandir($dir);
           echo "files = ";
           echo json_encode($files1);
        ?>


        function update_image() {
            var index = sessionStorage['index'];
            var photos = sessionStorage['photos'].split(',');
            $('#photo').attr('src', photos[index]);
        }

        function previous_image() {
            var index = sessionStorage['index'];
            if (index > 0) {
                index--;
            }
            sessionStorage['index'] = index;

            update_image()
        }

        function next_image() {
            var index = sessionStorage['index'];
            var number_of_photos = sessionStorage['number_of_photos'];
            index++;
            if (index < number_of_photos) {
                sessionStorage['index'] = index;
            }
            update_image();
        }

        $(document).ready(function () {

            var photos = [];

            $.each(files, function (index, file) {
                $.each(file_types, function (index, file_type) {
                    if (file.indexOf(file_type) > 0) {
                        photos.push(file);
                    }
                });
            });

            sessionStorage['photos'] = photos;
            sessionStorage['index'] = 0;
            sessionStorage['number_of_photos'] = photos.length;

            if (photos.length > 0) {
                update_image();
            }

            $("body").keydown(function (e) {
                if (e.keyCode == 37) { // left
                    previous_image();
                }
                else if (e.keyCode == 39) { // right
                    next_image();
                }
            });


            $("#photo").on("swipeleft", function () {
                next_image();
            });

            $("#photo").on("swiperight", function () {
                previous_image()
            });

        });


    </script>
</head>

<body>

<img style="max-width: 100%; max-height: 100%;" id="photo">

</body>
</html>
