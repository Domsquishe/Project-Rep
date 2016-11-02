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
    <h2> DJSULST PROJ. </h2>
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

<!-------------------------------CREATE MAP + GEOCODE------------------------------------------>  
  
<script>

var geocoder;
var map;

  ////////////// INITIALISE MAP \\\\\\\\\\\\\\\\\\\
  
function initialise() 
  {
    var f = 1;
    var i;
    var lati;
    var lngi;
    var longlat = [];
    var addresses = ["<?php echo $address1?>","<?php echo $address2?>"];
    
    var address_count = (addresses.length-1);
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {zoom: 8, center: latlng}
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    
    for (i = 0; i <= address_count; i++)
      {
        longlat[i] = geocode(addresses,i)
          //SHOWS AS UNDEFINED WHEN CONSOLE.LOG(LONGLAT)
      }
    
    //var center = longlat[0] - longlat[1].lati;
    console.log(longlat);
    }
    

///////////////////// GEOCODE \\\\\\\\\\\\\\\\\\\\\\
  
function geocode(addresses, i, latlist, lnglist, f, lati, lngi, locat) 
  {
    geocoder.geocode( { 'address': addresses[i]}, function(results, status) 
    {
      if (status == 'OK') 
      {
        var address_count = (addresses.length-1);
        
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({map: map,position: results[0].geometry.location, title: results[0].formatted_address});
        lati = parseFloat(results[0].geometry.location.lat());
        lngi = parseFloat(results[0].geometry.location.lng());
        
        var latlng = {lati, lngi};
        console.log(latlng);
          
        //HERE THE LONGITUDE AND LATITUDE ARE RETURNED AS AN OBJECT
        return latlng;
      }
      else 
      {
        alert('The address(es) you entered cannot be located : ' + status);
        return "failed";
      }
    });
   }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU&callback=initialise"async defer></script>

<script>

//console.log(locat);

</script>
  
<!----------------------------------PLACES LIBRARY--------------------------------------->
  
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU&libraries=places"></script> 
  
<!--------------------------------------------------------------------------------------->
  
</body>
</html>
