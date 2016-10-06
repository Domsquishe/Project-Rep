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

<!----------------------------FORMAT ADDRESS---------------------------------------->  

<script>

function FormatAddress(arr, var_lat, var_long, myLatLng, i) 
            {
                var_address = arr.formatted_address;
                console.log(var_address);
                var_lat = [parseFloat((arr.geometry.location.lat))];
                var_long = [parseFloat((arr.geometry.location.lng))];
                
                myLatLng = [var_lat,var_long];
                
                $("#geocode").append(var_address+"<br>");
                return myLatLng;
            }
</script>

<!-------------------------GET ADDRESS INPUTS--------------------------------------->

<script>
  
var addresses = ["<?php echo $address1?>","<?php echo $address2?>"];
var url = ["https://maps.googleapis.com/maps/api/geocode/json?address="+addresses[0]+"&key=AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU","https://maps.googleapis.com/maps/api/geocode/json?address="+addresses[1]+"&key=AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU"];
var myArr = [];
  
</script>  

<!------------------------RECEIVE FORMATTED ADDRESS-------------------------------->

<script>

var var_lat = [];
var var_long = [];
var var_address = [];  
var myLatLng = [];
for (i = 0; i <= 1; i++)
{
  console.log(i);
  $.ajax
  ({
    dataType: 'json',
    url: url[i],
    success: function(response)
    {
      var_address[i] = response.results[0].formatted_address;
      var_lat[i] = [parseFloat(response.results[0].geometry.location.lat)];
      var_long[i] = [parseFloat(response.results[0].geometry.location.lng)];
      console.log(var_address[i], var_lat[i], var_long[i]);
      $("#geocode").append(var_address[i]+"<br>");
    }
  })
}


</script>
  
<!-------------------------------CREATE MAP------------------------------------------>  
  
<script>
var map;
function initMap(myLatLng, response) 
  {
   myLatLng = {lat: 52, lng:-1.5};
   map = new google.maps.Map(document.getElementById('map'),{center: {lat: 52, lng: -1.5},zoom: 5})
    
   var marker = new google.maps.Marker({position: myLatLng, map: map, title: "address"});
    
   //service = new google.maps.places.PlacesService(map);
   //service.textSearch(request, callback);
   //var request = {location: pyrmont,radius: '500',query: 'restaurant'}
  }
  
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU&callback=initMap"async defer></script>
  
<!----------------------------------PLACES LIBRARY--------------------------------------->
  
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU&libraries=places"></script> 
  
<!--------------------------------------------------------------------------------------->
  

  


  
  
  
  
  
  
  
  
  
  
</body>
</html>
