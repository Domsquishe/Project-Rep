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
  </head>
  <body style ="background-image:url(http://www.newyork-wallpapers.com/user-content/uploads/wall/o/42/New-York-Cityscape-2560x1600-Wallpaper.jpg)">
    <div class="container">
      <div class="col-xs-offset-3 col-xs-6">
        <br>
        <h2 style="text-align: center;">MeetEasy</h2>
        <h4 style="text-align: center;">Please enter the addresses you would like to use</h4>
        <br>
        <form class="" action="project_display.php" method="post">
          <div class="form-group">
            <label for="address1">Address 1</label>
            <input type="text" class="form-control" name="address1" placeholder="Address 1">
          </div>
          <div class="form-group ">
            <label for="address2">Address 2</label>
            <input type="text" class="form-control" name="address2" placeholder="Address 2">
          </div>
          <br>
          
          <label for="form-control">Place Preference</label>
          <select style="height: 150px" multiple class="form-control" action="project_display" method="post" name="type">
            <option>Shop</option>
            <option>Resturant</option>
            <option>Movie Theatre</option>
            <option>Parking Spots</option>
            <option>Cemetery</option>
            <option>Hindu Temple</option>
          </select>
          <br>
          
          <input type="submit" class="form-control" value="Submit">
        </form>
      </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      
      $(document).ready(function(){
        $('option').mousedown(function(e) {
            e.preventDefault();
            $(this).prop('selected', !$(this).prop('selected'));
            return false;
        });
      })
    </script>
  </body>
</html>

<!--AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU-->
