<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ohana means family</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Bootstrap js-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Custom CSS -->
    <link href="stylesheet.css" rel="stylesheet">

  </head>
    <body>
        <?php
            $client_id = ''; // imgur client id
            $album_url = ''; // album to scrap the images from

            // Get cURL resource
            $curl = curl_init();

            // Set some options (including authentication header)
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $album_url,
                CURLOPT_HTTPHEADER => array("Authorization: Client-ID $client_id")
            ));

            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            $obj = (json_decode($resp));

            // Close request to clear up some resources
            curl_close($curl);

            function get_imgur_thumb($full_link) {
                $path_parts = pathinfo($full_link);
                $basename = explode(".", $path_parts['basename'])[0];

                echo $path_parts['dirname'];
                echo '/';
                echo $basename;
                echo 'm.';
                echo $path_parts['extension'];
            }
        ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="upload.html">Envie uma foto!</a>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">
            <div class="well"><p><i>A GARDA TA SUBINDO A GARDA TA SUBINDO!</i></p></div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Woodbine House</h1>
                </div>

                <?php foreach ($obj->{"data"}->{"images"} as $key => $value) { ?>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="<?php echo $value->{'link'} ?>">
                            <img class="img-responsive" src="<?php get_imgur_thumb($value->{'link'}) ?>" alt="">
                        </a>
                    </div>
                <?php } ?>

            </div>

            <hr>

            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p><i>"Ohana means family. And family means no one gets behind or forgotten."</i></p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
