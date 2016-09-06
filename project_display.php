
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
    
    <script>
    
    var var_lat;
    var var_long;
    
    var xmlhttp = new XMLHttpRequest();
    var entered_location = "<?php echo $address; ?>";
    var url = "https://maps.googleapis.com/maps/api/geocode/json?address="$address1"&key=AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU";
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var myArr = JSON.parse(xmlhttp.responseText);
            FormatAddress(myArr.results[0]);
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    
    function FormatAddress(arr) 
    {
        var var_address = "";
        var_address += arr.formatted_address;
        var_lat = parseFloat((arr.geometry.location.lat));
        var_long = parseFloat((arr.geometry.location.lng));
        
        console.log(var_lat, var_long);
        
        
        document.getElementById("geocode").innerHTML = var_address;
        $("#geocode").text(out);
        return var_lat;
        return var_long;
    }
</script>
    
    
    <!-- create map -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>
    <script>
          var map;
          function initMap() 
            {
                map = new google.maps.Map(document.getElementById('map'),
                {center: {lat: 52.2831, lng: -1.5621},zoom: 5});
                 console.log(var_lat, var_long);
                var myLatLng = {lat: var_lat, lng: var_long};
                var marker = new google.maps.Marker({position: myLatLng, map: map, title: 'Address 1'});
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU&callback=initMap"
        async defer></script>

    <!-- geolocation -->
    
</body>
</html>

<!--AIzaSyBN5Q_GVvi5ONp6lwgmIlWG72NKtZUB9pU-->
