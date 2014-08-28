  
 function init() {
   // Basic options for a simple Google Map
   // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
   var mapOptions = {
       // How zoomed in you want the map to start at (always required)
       zoom: 5,
                           minZoom: 5,
                           // Turns off/on the zoom controls. Positioned at bottom-right.
                           zoomControl: true,
                           zoomControlOptions: {
                                   style: google.maps.ZoomControlStyle.LARGE,
                                   position: google.maps.ControlPosition.RIGHT_CENTER
                           },
                           // Turn off street view
                           streetViewControl: false,

                           
                           

                           
       // The latitude and longitude to center the map (always required)
       center: new google.maps.LatLng(-25.161050, 134.496046),

       // Map Styling
      styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#193341"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#2c5a71"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#29768a"},{"lightness":-37}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#3e606f"},{"weight":2},{"gamma":0.84}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"weight":0.6},{"color":"#1a3541"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#2c5a71"}]}]
   };
                   
                   

   // Get the HTML DOM element that will contain your map 
   // We are using a div with id="map" seen below in the <body>
   var mapElement = document.getElementById('map');

   // Create the Google Map using out element and options defined above
   var map = new google.maps.Map(mapElement, mapOptions);
   
   // ANDY'S CODE TO GO HERE
   
  // Hardcode variables for testing purposes
   var gender = "Females_Total_Percentage";
   var age = "Persons_Percentage_Age_25_44_years";
   var nationality = "Persons_Australia_Percentage";
   
   // Create Google Fusion Table layer
   // ATTENTION: This will NOT WORK until we have created the Fusion Table correctly
   // I've just put this together to get an idea of how to construct the queries.
   var layer = new google.maps.FusionTablesLayer({
     query: {
        select: 'geography',
        from: '1Y0tYa1JTKMsqe3LYhOaJCf_sJNQilowmweasGSsz'
        }, styles: [{
           polygonOptions: {
              fillColor: "#f1ecce",
              fillOpacity: 1,
              strokeColor: "#ffffff",
              strokeWeight: 0.01
           }
        }, {
           where: gender + " > 0.45 AND " + age + "  > 0.08 AND " + nationality + " > 0.003",
           polygonOptions: {
              fillColor: "#eecec8"
           }
        }, {
           where: gender + " > 0.47 AND " + age + "  > 0.132 AND " + nationality + " > 0.0227",
           polygonOptions: {
              fillColor: "#e9c0b9"
           }
        }, {
           where: gender + " > 0.49 AND " + age + "  > 0.184 AND " + nationality + " > 0.0424",
           polygonOptions: {
              fillColor: "#e4b3aa"
           }
        }, {
           where: gender + " > 0.51 AND " + age + "  > 0.236 AND " + nationality + " > 0.0621",
           polygonOptions: {
              fillColor: "#e0a59c"
           }
        }, {
           where: gender + " > 0.53 AND " + age + "  > 0.288 AND " + nationality + " > 0.0818",
           polygonOptions: {
              fillColor: "#db988d"
           }
        }, {
           where: gender + " > 0.55 AND " + age + "  > 0.34 AND " + nationality + " > 0.1015",
           polygonOptions: {
              fillColor: "#d68a7e"
           }
        }, {
           where: gender + " > 0.57 AND " + age + "  > 0.392 AND " + nationality + " > 0.1212",
           polygonOptions: {
              fillColor: "#d17d6f"
           }
        }, {
           where: gender + " > 0.59 AND " + age + "  > 0.444 AND " + nationality + " > 0.1409",
           polygonOptions: {
              fillColor: "#cd6f60"
           }
        }, {
           where: gender + " > 0.61 AND " + age + "  > 0.496 AND " + nationality + " > 0.1606",
           polygonOptions: {
              fillColor: "#c86251"
           }
        }, {
           where: gender + " > 0.63 AND " + age + "  > 0.548 AND " + nationality + " > 0.1803",
           polygonOptions: {
              fillColor: "#c35542"
           }
        }, {
           where: gender + " > 0.65 AND " + age + "  > 0.6 AND " + nationality + " > 0.2",
           polygonOptions: {
              fillColor: "#b34b39"
           }
        }]
  });



   layer.setMap(map);
   }