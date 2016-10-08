<!DOCTYPE html>
<html>
<head>
    <title> Meetup Project </title>
    <style>
    html, body {
        height: 80%;
        margin: 30;
        padding: 0;
        background-color: #f1f1f1;;
    }
    .box {
        background-color : white;    
        text-align: center;
        }
    #map {
        height: 100%;
    }
    .title{
        text-align: center;
    }
    .maintext{
        text-align: center;
    }
    </style>

</head>
 
<body>

<div class = "title">
    <h1>Meetup Project</h1>
</div>    

<div id="map"></div>

<div class = "maintext">
<br>
    <h4 id="geocode"></h4>
</div>    
    
<?php 
  $address1 = $_POST['address1']; 
  $address2 = $_POST['address2'];
 ?> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>


<!-------------------------GET ADDRESS INPUTS--------------------------------------->

<script>
  
var addresses = ["<?php echo $address1?>","<?php echo $address2?>"];

</script>  

<!-------------------------------CREATE MAP + GEOCODE------------------------------------------>  
  
<script>

var geocoder;
var map;
function initialise(addresses) 
  {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {zoom: 8, center: latlng}
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
  }

function codeAddress() 
  {
    var address = addresses[1];
    console.log(address);
    geocoder.geocode( { 'address': address}, function(results, status) 
    {
      if (status == 'OK') 
      {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({map: map,position: results[0].geometry.location});
      } 
      else 
      {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    } );
  }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU&callback=initialise"async defer></script>
  
<!----------------------------------PLACES LIBRARY--------------------------------------->
  
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU&libraries=places"></script> 
  
<!--------------------------------------------------------------------------------------->
  
</body>
</html>
