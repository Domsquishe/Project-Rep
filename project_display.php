<!DOCTYPE html>
<html>
<head>
    <title> Meetup Project </title>
    <style>
    html, body {
        height: 80%;
        margin: 30;
        padding: 0;
        background-color: #f1f1f1;
        }
    .box {
        background-color : white;    
        text-align: center;
        }
    .recommend{
        background-color : white;
        text-align: right;
      }
    #map {
        z-index: 1;
        height: 650px;
        
    }
      #recommend {
        z-index: 3;
        position: fixed;
        top: 495px;
        right: 45px;
        }
      
     .panel{
       height: 220px;
       width: 420px;
        
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
  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!--[if lt IE 9]>
<script src="/js/html5shiv.js" type="text/javascript"></script>
<script src="/js/respond.min.js" type="text/javascript"></script>
<![endif]-->

<div class = "title">
<br>
    <h2> MeetEasy </h2>
</div>    

<div id = "map"></div>
  

 
<div class = "maintext">
<br>
    <h4 id="geocode"></h4>
</div>  
  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  
  
<?php 
  $address1 = $_POST['address1']; 
  $address2 = $_POST['address2'];
  $type = $_POST['type'];
  //$train = $_POST['train_station'];
  //$cinema = $_POST['movie_theatre'];
 ?> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>


  
<script>
  
var results1;
var results2; 

var geocoder;
var map;
var longlat = [];
var place_results;
var place_resultsArray = [];
 
/////////////// Basic Autocorrect Match (needs refinement) \\\\\\\\\\\\\\\\\\\
  
function formatType(types)
  {
   // place options are subject to change, according to Google
   var placeOptions = ["accounting","airport","amusement_park","aquarium","art_gallery",
                        "atm","bakery","bank","bar","beauty_salon","bicycle_store","book_store",
                        "bowling_alley","bus_station","cafe","campground","car_dealer","car_rental",
                        "car_repair", "car_wash","casino","cemetery","church","city_hall","clothing_store",
                        "convenience_store","courthouse","dentist","department_store","doctor","electrician",
                        "electronics_store","embassy","fire_station","florist","food","funeral_home","furniture_store",
                        "gas_station","gym", "hair_care", "hardware_store","library","liquor_store","lodging","meal_delivery",
                        "meal_takeaway","mosque","movie_rental", "movie_theatre","museum","night_club","parking","restaurant",
                        "school","shopping_mall","spa","zoo"];
    
    var typesLeft = placeOptions;
    for (i = 0; i <= placeOptions.length-1; i++)
    {
     if (typesLeft[i].substring(0,3) == types.substring(0,3))
      {
        return typesLeft[i];
      }
    }
  }

////////////////////////////////////////////////////////////////
  
  
  
  
////////////////////Set Radius of Search+Circle//////////////////////////
  
function setradius(longlat)
            {
              var latdiff;
              var lngdiff;
              
              latdiff = Math.abs(longlat[0] - longlat[2]);
              lngdiff = Math.abs(longlat[1] - longlat[3]);
             
            var radius = ((lngdiff+latdiff)*7000);
              // 7000 is a suitable number to use for a 
              // circle that is larger at a further distance
              // but is a smaller size when the addresses
              // are nearer to each other
            return radius;
            }
  
//////////////////////////////////////////////////////////////////////////
  
  
  
  
  
////////////////////////Callback for Place Search///////////////////////////////
  
function callback(place_results, status, pinColor, pinImage, pinShadow)
            {
              var recommend;
              if (status != 'OK') 
              {
                console.error(status);
                return;
              }
              for (var i = 0, place_results; result = place_results[i]; i++) 
              {
                place_resultsArray.push(result);
                addMarker(result, formatted_add, pinColor, pinImage, pinShadow);
              }
            
              recommend = place_resultsArray[findRecommendation(place_resultsArray)];
              
              addRecMarker(recommend, pinColor, pinImage, pinShadow);
              var request = {placeId: recommend.place_id}
              
              service.getDetails(request, detailed_callback);
            }
  
////////////////////////////////////////////////////////////////////////////
 
  
  
  
///////////////////////////Recommendation Bar///////////////////////////////
  
function findRecommendation(place_resultsArray)
  {
    
    var recommend = 0;
    var highestRating = 0;
    
    for (i = 0; i <= (place_resultsArray.length)-1;  i++)
      {
        
        if (place_resultsArray[i])
          {
            if (place_resultsArray[i].hasOwnProperty('rating'))
            {
              if (place_resultsArray[i].rating >= highestRating)
                {
                  recommend = i;
                  highestRating = place_resultsArray[i].rating;
                }
            }
        }
        else{console.log("There are no places in the vicinity")}
      }
        return recommend;
      }
  
////////////////////////////////////////////////////////////////////////////

  
//////////////////////////Detailed Place Search////////////////////////////
  
function detailed_callback(place, status)
  {
    if (status == google.maps.places.PlacesServiceStatus.OK) {
      $("#placename").append(place.name, " -- Rating : ", place.rating);
      $("#address").append(place.formatted_address);
      $("#number").append(place.formatted_phone_number);
      $("#website").attr("onClick", "window.open('"+place.website+"')");
      $("#directions").attr("OnClick", "window.open('https://www.google.co.uk/maps/dir/warwick/"+(place.formatted_address)+"')");
      for (i = 0; i <= (place.types.length)-1; i++)
        {
          $("#type").append(place.types[i],", ");
        }
     }
  }  

//////////////////////////////Marker Addition////////////////////////////////
  
function addMarker(result, formatted_add, pinColor, pinImage, pinShadow) 
  {
    console.log(result)
    var placeLoc = result.geometry.location;
    var marker = new google.maps.Marker({map: map, position: result.geometry.location, title: result.name, icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'});
    marker.addListener("click", function(){window.open("https://www.google.co.uk/maps/dir/"+(formatted_add)+"/"+(result.vicinity)+"'")});
  }
  
function addRecMarker(result)
  {
    var placeLoc = result.geometry.location;
    var marker = new google.maps.Marker({map : map, position: result.geometry.location, title: result.name, icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'});
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
  
//////////////////////////////////////////////////////////////////////////////

 
/////////////////////////////////////////////////////////////////////////////  
  function initialise() 
  {
    var list = [];
    var i;
    var lati;
    var lngi;
    var addresses = ["<?php echo $address1?>","<?php echo $address2?>"];
    var types = "<?php echo $type ?>";
   
    var address_count = (addresses.length)-1;
    
    var foundType = formatType(types);
    
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {zoom: 1, center: latlng};
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    google.maps.event.trigger(map, "resize");
    
    main(addresses, i, lati, lngi, foundType);
  }
  //////////////////////////////////////////////////////////////////////////

  
  
//////////////////////////////////////////////////////////////////////////////////////////////////
  
function main(addresses, lati, lngi, list, foundType) 
  {
    // Changing pins for places
    var pinColor = "FE7569";
    var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
    new google.maps.Size(21, 34),
    new google.maps.Point(0,0),
    new google.maps.Point(10, 34));
    var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
    new google.maps.Size(40, 37),
    new google.maps.Point(0, 0),
    new google.maps.Point(12, 35));
    
    var bounds = new google.maps.LatLngBounds();
    var center;
    var center_lat;
    var center_lng;
    
    //geocoding address
    geocoder.geocode({'address': addresses[0]}, function(results, status) 
    {
      if (status == 'OK')
      {
        formatted_add = results[0].formatted_address;
        results1 = results[0].geometry.location;
        geocoder.geocode( { 'address': addresses[1]}, function(results, status) 
        {
          if (status == 'OK')
          {
            results2 = results[0].geometry.location;
            var marker = new google.maps.Marker({map : map, position: results2, title: 'Friends Address'});
           
            
            longlat = [results1.lat(), results1.lng(), results2.lat(), results2.lng()];
            center_lat = ((results1.lat() + results2.lat()) / 2) 
            center_lng = ((results1.lng() + results2.lng()) / 2);
            center = {lat: center_lat, lng: center_lng};
            
            var request = {location: center,radius: setradius(longlat), type: foundType};
            
            service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, callback);
           
//////////////////////////////////////calculate route/////////////////////////////////////////////////            
            
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            
           
            function calcRoute(directionDisplay, directionService, results1, recommend, center) 
            {
              var routeVar = {origin: results1, destination: center, travelMode: 'DRIVING'};
              
              directionsService.route(routeVar, function(result, status) {
                if (status == 'OK') {
                  directionsDisplay.setDirections(result);
                }
              });
            }
            
            directionsDisplay.setMap(map);
            // modifying map to center upon results whilst keeping markers in view
            bounds.extend(results2);
            console.log(results2)
            bounds.extend(results1);
            map.panTo(center);
            map.fitBounds(bounds);
            
            calcRoute(directionsDisplay, directionsService, results1, recommend, center);
            
/////////////////////////////////////////////////////////////////////////////////////////////////            
   
            var cityCircle = new google.maps.Circle({
                         strokeColor: '#FF0000',
                         strokeOpacity: 0.8,
                         strokeWeight: 2.5, 
                         fillColor: '#FF0000', 
                         fillOpacity: 0.35, 
                         map: map,
                         center: center,
                         radius: setradius(longlat)});
          }
           else
          {
            alert('One or more of the addresses you entered cannot be located : ' + status);
          }
        });
      }
      else
      {
        alert('The first address you entered cannot be located : ' + status);
      }
    });
    return longlat;
  }
  
////////////////////////////////////////////////////////////////////////////////////////////////

</script>
<br> 
<form class="" action="project_home.php" method="post">
          <div class="form-group">
            <input type="submit" class="form-control" value="Return to Homepage">
          </div>
</form>
  
<div id = "recommend">
  <div class="panel panel-default">
            <div class="panel-body"> 
              
              <h4 id="header"> <strong>Recommended Place of Meeting... </strong><br> </h4> 
              <h5 id = "placename"></h5>
              <h5 id = "type"> Type : </h5> 
              <h5 id = "address"> Address : </h5> 
              <h5 id = "number">Contact Number : </h5>
              
              <h5><a id = "website" style = "border: solid 1px #C0C0C0"> Visit their Website </a></h5>
              <h5><a id = "directions" style = "border: solid 1px #C0C0C0"> Get Directions </a> </h5>
              
             </div>
   </div> 
</div>
  




<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU&libraries=places&callback=initialise"async defer></script>

</body>
</html>

