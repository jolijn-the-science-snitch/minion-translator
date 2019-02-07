<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NASA - APOD</title>

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poiret+One|Pontano+Sans" rel="stylesheet"> 

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                height: 100vh;
                margin: 0;
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
                margin-top: 20px;
            }

            #copyright, #apod_title {
                text-align: center;
            }
            
            #apod_explaination {
                width: 40%;
                margin-left: 30%;
            }

            #apod_img_id, #apod_vid_id {
                margin-left: 40%;
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
                    <img id="apod_img_id" width="20%"/>

                    <iframe id="apod_vid_id" type="text/html" width="60%" height="35%" frameborder="0"></iframe>
                    <p id="copyright"></p>

                    <h3 id="apod_title"></h3>
                    <p id="apod_explaination"></p>
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
