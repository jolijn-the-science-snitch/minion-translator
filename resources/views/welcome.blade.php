<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NASA - APOTD</title>

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poiret+One|Pontano+Sans|Rock+Salt|La+Belle+Aurore" rel="stylesheet"> 

        <!-- Styles -->
        <style>
            html, body {
                background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/3472/subtlepatterns-wavegrid.png');
                height: 100vh;
                margin: 0;
                padding-bottom: 100%;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .title {
                font-size: 74px;
                color: #636b6f;
                font-family: 'Poiret One', cursive;
                font-weight: 200;
                text-align: center;
                margin-top: 50px;
            }

            h3 {
                font-size: 44px;
                color: #636b6f;
                font-family: 'Poiret One', cursive;
                font-weight: 200;
            }

            p {
                color: #636b6f;
                padding: 0 25px;
                font-size: 18px;
                font-weight: 600;
                font-family: 'Pontano Sans', sans-serif;
            }

            .m-b-md {
                margin-bottom: 10px;
            }

            .polaroid {
                border: 1rem solid #f6f6f3;
                border-bottom: 5rem solid #f6f6f3;
                width: 40vw;
                min-width: 18rem;
                height: 40vw;
                min-height: 18rem;
                box-shadow: 1rem 1rem 1rem -0.5rem rgba(0, 0, 0, 0.54);
                margin: 4rem auto;
                text-align: right;
                position: relative;
                transition: all 250ms ease;
            }

            .polaroid__image {
                max-width: 100%;
                margin: 0;
                background: 50% 50% no-repeat; /* 50% 50% centers image in div */
                width: 40vw;
                height: 34.5vw;
            }

            .polaroid__caption {
                font-family: 'Rock Salt', cursive;
                padding: 0.5rem;
            }

            .polaroid--rotate-right {
                transform: rotate(3deg);
            }

            .polaroid--rotate-left {
                transform: rotate(-4deg);
            }

            .post-card {
                width: 900px;
                height: auto;
                background: url('https://www.toptal.com/designers/subtlepatterns/patterns/lightpaperfibers.png');
                transform: translate(-50%, -50%);
                left: 50%;
                margin-top: 20%;
                position: absolute;
                padding: 12px;
            }

            .post-stample {
                background: url('http://virtualstampclub.com/lloydblog/wp-content/uploads/2017/12/s_2018usflag.png');
                background-size: 70px 100px;
                width: 70px;
                height: 100px;
                position: absolute;
                right: 12px;
                border: 1px solid black;
            }

            .post-card__title {
                font-family: 'La Belle Aurore';
            }

            .content-left {
                width: calc(50%);
                font-family: 'La Belle Aurore';
                font-size: 21px;
                line-height: 1.2;
                float: left;
            }

            .content-right {
                margin-top: 65px;
                width: 40%;
                float: right;
            }

            .adress-line {
                display: block;
                margin: 10px 20px;
                font-family: 'La Belle Aurore';
                font-size: 18px;
                border-bottom: 1px solid black;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    NASA - Astronomy Picture of the Day
                </div>

                <div class="form-group">
                    <div class="polaroid polaroid--rotate-left">
                        <img id="apod_img_id" class="polaroid__image"/>
                        <span id="copyright" class="polaroid__caption"></span>
                    </div>

                    <iframe id="apod_vid_id" type="text/html" width="60%" height="35%" frameborder="0"></iframe>
                    <p id="copyright"></p>
                </div>

                <div class="post-card">
                    <div class="post-stample"></div>
                    <h1 id="apod_title" class="post-card__title"></h1>
                    <div id="apod_explaination" class="content-left"></div>
                    <div class="content-right">
                        <span class="adress-line">Kennedy Space Center</span>
                        <span class="adress-line">32899 (FL)</span>
                        <span class="adress-line">USA</span>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $.ajax({
                type:'GET',
                url:'https://api.nasa.gov/planetary/apod?api_key=SEMZJDW4gyjVfIlczzCmvvD0va3zGBx9foWbuCMU',
                success: function(result){
                    if("copyright" in result) {
                        $("#copyright").text("Credits: " + result.copyright);
                    }
                    else {
                        $("#copyright").text("Credits: " + "Public Domain");
                    }
                    
                    if(result.media_type == "video") {
                        $("#apod_img_id").css("display", "none"); 
                        $("#apod_vid_id").attr("src", result.url);
                    }
                    else {
                        $("#apod_vid_id").css("display", "none"); 
                        $("#apod_img_id").attr("src", result.url);
                    }

                    $("#apod_explaination").text(result.explanation);
                    $("#apod_title").text(result.title);
                },
            });
        </script>
    </body>
</html>
