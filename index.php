<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Slideshow</title>

    <meta name="description" content="Single PHP page slideshow">
    <meta name="author" content="Aziez Ahmed Chawdhary">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script>

        var files = [];
        var file_types = [".jpg", ".JPG", ".png"];
        <?php
           $dir = '.';
           $files1 = scandir($dir);
           echo "files = ";
           echo json_encode($files1);
        ?>


        function update_image() {
            var index = sessionStorage['index'];
            var photos = sessionStorage['photos'].split(',');

            $('#photo').empty();
            $('#photo').append($("<img>", {src: photos[index]}));
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


            $("#next").click(function () {
                next_image();
            });

            $("#prev").click(function () {
                previous_image()
            });

        });


    </script>
    <style>
        body {
            padding: 0;
            margin: 0;
        }

        #photo img {
            max-width: 100%;
            max-height: 100%;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        #prev, #next {
            width: 50%;
            height: 100%;
        }

        #prev {
            position: absolute;
            top: 0;
            left: 0;
        }

        #next {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>

<body>
  
  <div id="photo">
    <!--  <img scr="img.JPG"> -->
  </div>
  
  
  <div id="prev"></div>
  <div id="next"></div>
</body>
</html>
