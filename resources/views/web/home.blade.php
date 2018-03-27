<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{asset('css/home.css')}}">

    <title>Hello, world!</title>
</head>
<body>
<div id="preview-container">
    <div id="preview">
    </div>
</div>

<div id="home" class="container">
    <!-- Content here -->
    <div class="row">
        <div class="col home-block">
            <div class="home-profile">

            </div>
        </div>
        <div class="col home-block">
            2 of 2
        </div>
        <div class="col home-block">
            3 of 3
        </div>
    </div>
    <div class="row">
        <div class="col home-block">
            1 of 3
        </div>
        <div class="col home-block">
            2 of 3
        </div>
        <div class="col home-block">
            3 of 3
        </div>
    </div>
</div>

<script src="{{asset('js/jquery-1.11.0.min.js')}}"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{asset('js/background-blur.min.js')}}"></script>

<script>
    $( document ).ready(function() {
        var $previewEl = $('#preview');
        $previewEl.backgroundBlur({
            imageURL : '{{asset('images/home_bg/zongse.jpg')}}', // URL to the image that will be used for blurring
            blurAmount : 50, // Amount of blur (higher amount degrades browser performance)
            imageClass : 'bg-blur', // CSS class that will be applied to the image and to the SVG element,
            overlayClass : 'bg-blur-overlay', // CSS class of an element that will overlay the blur background (useful for additional effects or putting a spinner)
            duration: 1000, // If the image needs to be faded in, how long that should take
            endOpacity : 1 // Specify the final opacity that the image will have
        });
    });
</script>
</body>
</html>