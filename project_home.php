<!DOCTYPE html>


<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MeetEasy</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!--[if lt IE 9]>
      <script src="/js/html5shiv.js" type="text/javascript"></script>
      <script src="/js/respond.min.js" type="text/javascript"></script>
      <![endif]-->

  <style>
    body {
      background-image: url("city.jpg");
      background-size: 100% auto;
    }
    
    #checkbox {
      height: 20px;
      padding-top: 10px;
    }
    
    . {
      padding-top: 25px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="col-xs-offset-3 col-xs-6">
      <br>
      <h2 style="text-align: center;">MeetEasy</h2>
      <h4 style="text-align: center;">Please enter the addresses you would like to use</h4>
      <br>
      <form method="post" name="inputForm" action="MeetEasyMain.php">
        <div class="form-group">
          <label for="address1">Address 1</label>
          <input type="text" class="form-control" name="address1" placeholder="Address 1" required>
        </div>
        <div class="form-group">
          <label for="address2">Address 2</label>
          <input type="text" class="form-control" name="address2" placeholder="Address 2" required>
        </div>
        <br>
        <div class="form-group">
          <label for="type">Place Preference</label>
          <input type="text" class="form-control" name="type" id="type" placeholder="Type your place preference here" required>
        </div>


        <div class="panel panel-default">
          <div class="panel-body">Here, type your place preference if you are looking for a specific type of establishment/location</div>
        </div>
        <br>

        <input type="submit" class="form-control" value="Submit">
      </form>
      <!------------------------->
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>
<script>

var placeOptions = ["accounting","airport","amusement_park","aquarium","art_gallery",
                        "atm","bakery","bank","bar","beauty_salon","bicycle_store","book_store",
                        "bowling_alley","bus_station","cafe","campground","car_dealer","car_rental",
                        "car_repair", "car_wash","casino","cemetery","church","city_hall","clothing_store",
                        "convenience_store","courthouse","dentist","department_store","doctor","electrician",
                        "electronics_store","embassy","fire_station","florist","food","funeral_home","furniture_store",
                        "gas_station","gym", "hair_care", "hardware_store","library","liquor_store","lodging","meal_delivery",
                        "meal_takeaway","mosque","movie_rental", "movie_theatre","museum","night_club","parking","restaurant",
                        "school","shopping_mall","spa","zoo"];
  
// validate place type
  $('form').submit(function () {
      if(placeOptions.indexOf($('#type').val())==-1){
            alert("The place type you have entered has not been found. Please try again.");
            return false;
        } else {
            return true;
        }
   })
</script>

</html>

<!--AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU-->
