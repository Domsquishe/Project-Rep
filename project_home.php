<!DOCTYPE html>
<html>

<head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    
    <title> Meetup Project </title>
    <style>
              html, body {
                height: 80%;
                margin: 30;
                padding: 0;
                background-color: #f1f1f1;
              }
              #map {
                height: 100%;
              }
              .box {
                  background-color : white;    
                  text-align: center;
              }
              .formDiv{
                  background-color : white;
                  position: absolute;
                  left: 40%;
              }
              
    </style>
        
    </head>
    <div class="container box"> 
    <h1>MeetEasy</h1>
    
    <body>
    
    <p>Please enter the address(es) you would like you use, followed by postcode</p> <br>
    
    <div class="formDiv" >
    <form id="addressform" name="addressform" method="post" action="project_display.php">
                <table>
                    <tr>
                        <td>1st address:</td><td><input type="text" id="address1" name="address1"></td>
                        <td>2nd address:</td><td><input type="text" id="address2" name="address2"></td>
                        <td><input type=hidden name="submitted"><input type="submit" value="Submit"></td>
                <table>
    </form>
    
   
    </div>
    </div>
    </body>
    </html>
    
    <!--AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU-->  
