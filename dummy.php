<!DOCTYPE html>
<html lang="en">

    <head>

        <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <b>latitude:</b><span id="latitude"></span></br>
        <b>longitude:</b><span id="longitude"></span></br>
        <!-- <b>city:</b><span id="city"></span> -->
        <!-- <script>
        // Instance the tour
        var tour = new Tour({
            steps: [{
                    element: "#latitude",
                    title: "Title of my step",
                    content: "Content of my step"
                },
                {
                    element: "#longitude",
                    title: "Title of my step",
                    content: "Content of my step"
                }
            ]
        });



        // Start the tour

        $("#latitude").click(function() {
            // Initialize the tour
            tour.init();
            //do something
            tour.start();
            alert('hello');
        });
        </script> -->
        <script>
        $(document).ready(function() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(p) {
                    var latitude = p.coords.latitude;
                    var longitude = p.coords.longitude;

                    $("#latitude").text(latitude);
                    $("#longitude").text(longitude);

                }, function(e) {

                })
            } else {
                iplookup();

                function iplookup() {}
            }
        });
        </script>
        <?php
         $place= var_export(unserialize(file_get_contents('http://www.geoplugin.net/extras/location.gp?lat=26.8467&lon=80.9462&format=php'))) ;
         echo $place['geoplugin_city'];
?>

    </body>

</html>
