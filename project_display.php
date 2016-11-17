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
  $type = $_POST['type'];
 ?> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>

<!----------------------------CREATE MAP + GEOCODE------------------------------------------>  
  
<script>
  
var labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
var results1;
var results2; 
var placetype = ["<?php echo $placetype?>"];
var geocoder;
var map;
var longlat = [];
  
var pinColor = "blue";
var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
new google.maps.Size(21, 34),
new google.maps.Point(0,0),
new google.maps.Point(10, 34));
var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
new google.maps.Size(40, 37),
new google.maps.Point(0, 0),
new google.maps.Point(12, 35));
 
/////////////// INITIALISE MAP + GEOCODER \\\\\\\\\\\\\\\\\\\
  
function main(addresses, lati, lngi, list, place) 
  {
    var bounds = new google.maps.LatLngBounds();
    var center;
    var center_lat;
    var center_lng;
    geocoder.geocode( { 'address': addresses[0]}, function(results, status) 
    {
      if (status == 'OK')
      {
        console.log(results[0].geometry)
        results1 = results[0].geometry.location;
        geocoder.geocode( { 'address': addresses[1]}, function(results, status) 
        {
          if (status == 'OK')
          {
            console.log(results[0].geometry)
            results2 = results[0].geometry.location;
           
            var marker = new google.maps.Marker({map: map,position: results1, icon: pinImage, animation: google.maps.Animation.DROP, title: results1.formatted_address});
            var marker2 = new google.maps.Marker({map: map,position: results2, animation: google.maps.Animation.DROP, title: results2.formatted_address});
            marker.setAnimation(google.maps.Animation.BOUNCE);
            marker2.setAnimation(google.maps.Animation.BOUNCE);
            
            bounds.extend(results1);
            bounds.extend(results2);
            longlat = [results1.lat(), results1.lng(), results2.lat(), results2.lng()];
            center_lat = ((results1.lat() + results2.lat()) / 2) 
            center_lng = ((results1.lng() + results2.lng()) / 2);
            center = {lat: center_lat, lng: center_lng};
            
            //var marker3 = new google.maps.Marker({map: map,position: center, title: 'centerpoint'});
            map.panTo(center);
            map.fitBounds(bounds);
            
            var request = {
              location: center,
              radius: setradius(longlat),
              types: [place]
            };
            
            service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, callback);
            
            var cityCircle = new google.maps.Circle({
                         strokeColor: '#FF0000',
                         strokeOpacity: 0.8,
                         strokeWeight: 2, 
                         fillColor: '#FF0000', 
                         fillOpacity: 0.35, 
                         map: map,
                         center: center,
                         radius: setradius(longlat)});

            function callback(place_results, status)
            {
              if (status != 'OK') 
              {
                console.error(status);
                return;
              }
              for (var i = 0, place_results; result = place_results[i]; i++) 
              {
                console.log(result)
                addMarker(result);
              }
            }
            
            function setradius(longlat)
            {
              var latdiff;
              var lngdiff;
              
              if (longlat[0]>longlat[2])
                {
                  latdiff = (longlat[0] - longlat[2]);
                }
              else
              {
                latdiff = (longlat[2] - longlat[0]);
              }
              if (longlat[1]>longlat[3])
                {
                  lngdiff = (longlat[1] - longlat[3]);
                }
              else
              {
                lngdiff = (longlat[3] - longlat[1]);
              }
              
            var radius = ((lngdiff+latdiff)*7000);
            console.log(radius)
            return radius;
            }
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


  function addMarker(result) 
  {
    var placeLoc = result.geometry.location;
    var marker = new google.maps.Marker({
    map: map, position: result.geometry.location, title: result.name});
  }

  
  
function initialise() 
  {
    var list = [];
    var i;
    var lati;
    var lngi;
    var addresses = ["<?php echo $address1?>","<?php echo $address2?>"];
    var place = "<?php echo $type?>";
    console.log(addresses);
    console.log(place)
    var address_count = (addresses.length)-1;
    
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {zoom: 1, center: latlng};
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    
    main(addresses, i, lati, lngi, place);
    
    //wait for geocoding to have occurred
  }
    
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU&libraries=places&callback=initialise"async defer></script>

</body>
</html>

<!--
//function handler(results, status, addresses)
  //{
    //if (status == 'OK') 
      //{
        //map.setCenter(results[0].geometry.location);
        //var marker = new google.maps.Marker({map: map,position: results[0].geometry.location, title: results[0].formatted_address});
        //var latlng = {lati: parseFloat(results[0].geometry.location.lat()), lngi:  parseFloat(results[0].geometry.location.lng())};
      //}
      //else 
      //{
        ///alert('The address(es) you entered cannot be located : ' + status);
      //  return "failed";
    //  }
  //}
 
//function handler2(results,status)
  //{
    //if (status == 'OK') 
      //{
        //map.setCenter(results[0].geometry.location);
        //var marker = new google.maps.Marker({map: map,position: results[0].geometry.location, title: results[0].formatted_address});
        //var latlng = {lati:  parseFloat(results[0].geometry.location.lat()), lngi:  parseFloat(results[0].geometry.location.lng())};
        //console.log(latlng);
        //longlat.push(latlng);
        //return latlng;
      //}
      //else 
      //{
        //alert('The address(es) you entered cannot be located : ' + status);
        //return "failed";
      //}
 // }
 -!>
  
