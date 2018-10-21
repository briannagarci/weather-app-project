<? 

  $weather = "";
  $error = "";

  if (isset($_GET['city']) && $_GET['city'] != NULL)  {

    $city = str_replace(" ", "+", $_GET['city']);

    $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=e507792db8d8e2da6abfa875ec00a35c");


    $weatherArray = json_decode($urlContents, true);

    if($weatherArray['cod'] == 200) {

    $weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'. ";

    $tempInFahrenheit = intval(($weatherArray['main']['temp'] * (9 / 5)) - (459 + (67/100))); 
    
    $milesPerHour = $weatherArray['wind']['speed'] * (2.237);

    $weather .= "The temperature is ".$tempInFahrenheit."&deg;F and wind speed is ".$milesPerHour." mph "."";  
    
    } else {

          $error ="Could not find city - please try again.";
      }
  
  }


?>

<!doctype html>
<html lang="en">


  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style type="text/css">

      html{
        background: url(background.jpg) no-repeat center center fixed;
        background-size: cover;
        background-size: cover;
        background-size: cover;
        background-size: cover;


      }

      body{
          background: none;
          text-align: center;
      }

      .container {
        text-align: center;
        margin-top: 100px;
        width: 450px;
      }

      input {

        margin: 20px 0;
      }

      #weather {

        margin-top: 15px;
      }
    
    
    </style>


    <title>What's The Weather?</title>
  </head>
  <body>
    
    <div class="container">

    <h1>What's The Weather?</h1>

  <form>
    <fieldset class="form-group">

      <label for="city">Enter the name of a city</label>
      <input type="text" class="form-control" name="city" id="city" placeholder="Eg. Paris, Tokyo" value="<?php 
      
          if (array_key_exists('city', $_GET)) {

            echo $_GET['city'];

           }
      
      
       ?>">
     
    
    </fieldset>
  
    <button type="submit" class="btn btn-primary">Submit</button>

  </form>

    <div id="weather"><?php

      if($weather) {

        echo '<div class="alert alert-success" role="alert">
        '.$weather.'
        </div>';
      }
    
      else if($error) {
        echo '<div class="alert alert-danger role="alert">'.$error.'</div>';

      }
    ?></div>


    </div>
   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>


