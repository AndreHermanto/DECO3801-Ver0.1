
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map { height: 100% ; margin: top; padding: 0 }
    </style>
	<!--<script type="text/javascript" src="js/javascript.js"></script>-->
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.js"></script>
	
	<link type="text/css" rel="stylesheet" href="css/stylebono.css" />
	<link href='http://fonts.googleapis.com/css?family=Overlock:400,900' rel='stylesheet' type='text/css'>

	
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAo3z4buaY-xjj9YXQexPl_DQLCv03XRFo&sensor=true"></script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=drawing&sensor=true"></script>
	
	<script type="text/javascript">
	 function init() {
	      var apiKey = "1md9UwiFfywVXX8iPH5x4srBHQ9XwXFA3LO3wEDAT";
		  
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
									   position: google.maps.ControlPosition.RIGHT_TOP
							   },
							   // Turn off street view
							   streetViewControl: false,

							   
							   

							   
		   // The latitude and longitude to center the map (always required)
		   center: new google.maps.LatLng(-25.161050, 134.496046),

		   // Map Styling
		  styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#3ca196"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f1eaca"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#29768a"},{"lightness":-37}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#3e606f"},{"weight":2},{"gamma":0.84}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"weight":0.6},{"color":"#1a3541"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#2c5a71"}]}]
	   };
					   
					   

	   // Get the HTML DOM element that will contain your map 
	   // We are using a div with id="map" seen below in the <body>
	   var mapElement = document.getElementById('map');

	   // Create the Google Map using out element and options defined above
	   var map = new google.maps.Map(mapElement, mapOptions);
	   
		var strictBounds = new google.maps.LatLngBounds( 
		new google.maps.LatLng(-40.739861, 115.205078), 
   	    new google.maps.LatLng(-15.449624, 150.048828) 
     
   );

   // Listen for the dragend event
   google.maps.event.addListener(map, 'dragend', function() {
     if (strictBounds.contains(map.getCenter())) return;

     // We're out of bounds - Move the map back within the bounds

     var c = map.getCenter(),
         x = c.lng(),
         y = c.lat(), 
         maxX = strictBounds.getNorthEast().lng(),
         maxY = strictBounds.getNorthEast().lat(),
         minX = strictBounds.getSouthWest().lng(),
         minY = strictBounds.getSouthWest().lat();

     if (x < minX) x = minX;
     if (x > maxX) x = maxX;
     if (y < minY) y = minY;
     if (y > maxY) y = maxY;

     map.setCenter(new google.maps.LatLng(y, x));
   });
	   
	   
	  // Hardcode variables for testing purposes
	   var gender = "";
	   var age = "";
	   var nationality = "";
	   var flag = ''; //takes the flag from session
		var education ="";
		var language="";
		var religion="";
	   
	   		if(flag == "go")
		{	//put the values from the session to javascript variables
			gender = ''; 
			age = '';
			nationality = '';
			education = '';
			language = '';
			religion = '';
		}
	   // Create Google Fusion Table layer



	   var layer = new google.maps.FusionTablesLayer({
		 query: {
			select: 'geography',
			from: apiKey
			}, styles: [{
			   polygonOptions: {
				  fillColor: "#f1ecce",
				  fillOpacity: 1,
				  strokeColor: "#ffffff",
				  strokeWeight: 0.01
			   }
			}, {
			   where: gender + " > 0.45 AND " + age + "  > 0.08 AND " + nationality + " > 0.003 AND " +education + " < 0.015 AND " + language + " > 0.05 AND " + religion + " > 0.01",
			   polygonOptions: {
				  fillColor: "#eecec8"
			   }
			}, {
			   where: gender + " > 0.47 AND " + age + "  > 0.132 AND " + nationality + " > 0.0227 AND " +education + " < 0.0095 AND " + language + " > 0.1 AND " + religion + " > 0.05",
			   polygonOptions: {
				  fillColor: "#e9c0b9"
			   }
			}, {
			   where: gender + " > 0.49 AND " + age + "  > 0.184 AND " + nationality + " > 0.0424 AND " +education + " < 0.00085 AND " + language + " > 0.2 AND " + religion + " > 0.09",
			   polygonOptions: {
				  fillColor: "#e4b3aa"
			   }
			}, {
			   where: gender + " > 0.51 AND " + age + "  > 0.236 AND " + nationality + " > 0.0621 AND " +education + " < 0.0075 AND " + language + " > 0.25 AND " + religion + " > 0.14",
			   polygonOptions: {
				  fillColor: "#e0a59c"
			   }
			}, {
			   where: gender + " > 0.53 AND " + age + "  > 0.288 AND " + nationality + " > 0.0818 AND " +education + " < 0.0065 AND " + language + " > 0.3 AND " + religion + " > 0.19",
			   polygonOptions: {
				  fillColor: "#db988d"
			   }
			}, {
			   where: gender + " > 0.55 AND " + age + "  > 0.34 AND " + nationality + " > 0.1015 AND " +education + " < 0.0055 AND " + language + " > 0.4 AND " + religion + " > 0.24",
			   polygonOptions: {
				  fillColor: "#d68a7e"
			   }
			}, {
			   where: gender + " > 0.57 AND " + age + "  > 0.392 AND " + nationality + " > 0.1212 AND " +education + " < 0.0045 AND " + language + " > 0.5 AND " + religion + " > 0.29",
			   polygonOptions: {
				  fillColor: "#d17d6f"
			   }
			}, {
			   where: gender + " > 0.59 AND " + age + "  > 0.444 AND " + nationality + " > 0.1409 AND " +education + " < 0.0035 AND " + language + " > 0.6 AND " + religion + " > 0.34",
			   polygonOptions: {
				  fillColor: "#cd6f60"
			   }
			}, {
			   where: gender + " > 0.61 AND " + age + "  > 0.496 AND " + nationality + " > 0.1606 AND " +education + " < 0.0025 AND " + language + " > 0.7 AND " + religion + " > 0.39",
			   polygonOptions: {
				  fillColor: "#c86251"
			   }
			}, {
			   where: gender + " > 0.63 AND " + age + "  > 0.548 AND " + nationality + " > 0.1803 AND " +education + " < 0.0015 AND " + language + " > 0.8 AND " + religion + " > 0.44",
			   polygonOptions: {
				  fillColor: "#c35542"
			   }
			}, {
			   where: gender + " > 0.65 AND " + age + "  > 0.6 AND " + nationality + " > 0.2 AND " +education + " < 0.001 AND " + language + " > 0.9 AND " + religion + " > 0.49",
			   polygonOptions: {
				  fillColor: "#b34b39"
			   }
			}]
	  });



	   layer.setMap(map);
	   
      } // belongs to init()
		
		
	</script>
	
	<!--GOOGLE CHART API-->
	
	 <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Preference');
        data.addColumn('number', 'Percentage Match');
        data.addRows([
          ['Gender', 50],
          ['Age Bracket', 24],
          ['Nationality', 68],
		  ['education', 80]
        ]);

        

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
      
    </script>
	<script>
				
				function setCookie(cname,cvalue,exdays)
				{
					var d = new Date();
					d.setTime(d.getTime()+(exdays*24*60*60*1000));
					var expires = "expires="+d.toGMTString();
					document.cookie = cname + "=" + cvalue + "; " + expires;
				}

				function getCookie(cname)
				{
					var name = cname + "=";
					var ca = document.cookie.split(';');
					for(var i=0; i<ca.length; i++) 
					  {
					  var c = ca[i].trim();
					  if (c.indexOf(name)==0) return c.substring(name.length,c.length);
					}
					return "";
				}
				function getIndex()
				{ 
					
					var natIndex = document.getElementById("natForm").selectedIndex;
					setCookie("nat", natIndex, 1);
				}
	</script>
	
	
	
	
    <script type="text/javascript">
            // When the window has finished loading create our google map below
            google.maps.event.addDomListener(window, 'load', init);
        
           
        </script>

	
  </head>
  <body onload="">
		<div id="header">
			<div class="logo-main"><a href="#"><img src="images/logo2.png" alt="Census Matchmaker"></a>
			</div>
		</div> 
    	<div id="map" >
    	</div>
    	<div class="search-box">
    		<div class="content-search">
    			<div class="title">
    				<h3>Match Criterias</h3>
    			</div>
    			<form action="setSession.php" method="post">
    				<p class="form-title">Gender</p>
    				<input type="radio" name="gender" value="Males_Total_Percentage" >Male</input>
    				<input type="radio" name="gender" value="Females_Total_Percentage">Female</input>
    				<p class="form-title">Age</p>
    				<select name="ageRange">
						<option value="Persons_Percentage_Age_15_24_years"  >15-24 years</option>
    					<option value="Persons_Percentage_Age_25_44_years"  >25-44 years</option>
    					<option value="Persons_Percentage_Age_45_54_years"  >45-54 years</option>
    					<option value="Persons_Percentage_Age_55_64_years"  >55-64 years</option>
    				</select>
    				<p class="form-title">Nationality</p>
					<select name="nationality" id="natForm">
						<option value="">-- select one --</option>
					  <option value="Persons_Australia_Percentage"  >Australia</option>
					  <option value="Persons_China_excludes_SARs_and_Taiwan_Percentage" >China excludes SARs &amp; Taiwan</option>
					  <option value="Persons_Croatia_Percentage" >Croatia</option>
					  <option value="Persons_England_Percentage" >England</option>
					  <option value="Persons_Fiji_Percentage" >Fiji</option>
					  <option value="Persons_Germany_Percentage" >Germany</option>
					  <option value="Persons_Greece_Percentage" >Greece</option>
					  <option value="Persons_Hong_Kong_SAR_of_China_Percentage" >Hong Kong SAR of China</option>
					  <option value="Persons_India_Percentage" >India</option>
					  <option value="Persons_Indonesia_Percentage" >Indonesia</option>
					  <option value="Persons_Iraq_Percentage" >Iraq</option>
					  <option value="Persons_Ireland_Percentage" >Ireland</option>
					  <option value="Persons_Italy_Percentage" >Italy</option>
					  <option value="Persons_Korea_Republic_of_South_Percentage" >Korea Republic of Souuth</option>
					  <option value="Persons_Lebanon_Percentage" >Lebanon</option>
					  <option value="Persons_Malaysia_Percentage" >Malaysia</option>>
					  <option value="Persons_Netherlands_Percentage" >Netherlands</option>
					  <option value="Persons_New_Zealand_Percentage" >New Zealand</option>
					  <option value="Persons_Philippines_Percentage" >Philippines</option>
					  <option value="Persons_Scotland_Percentage" >Scotland</option>
					  <option value="Persons_Singapore_Percentage" >Singapore</option>
					  <option value="Persons_South_Africa_Percentage" >South Africa</option>
					  <option value="Persons_Sri_Lanka_Percentage" >Sri Lanka</option>  
					  <option value="Persons_United_States_of_America_Percentage" >United States of America</option>
					  <option value="Persons_Vietnam_Percentage" >Vietnam</option>
					  </select>
					  <p class="form-title">Education Important?</p>
					  <select name="education">
					  <option value="Highest_year_of_school_completed_Did_not_go_to_school">Yes</option>
					  <option value="no">No</option>
					  </select>
					  <p class="form-title">Language</p>
					  <input type="radio" name="language" value="Language_spoken_at_home_English_only" >English</input>
					  <input type="radio" name="language" value="Language_spoken_at_home_Other_Language">Other Language</input>
					<p class="form-title">Religion</p>
						<select name="religion">
						<option value="Buddhism"  >Buddhism</option>
    					<option value="Christianity"  >Christianity</option>
    					<option value="Hinduism"  >Hinduism</option>
    					<option value="Islam"  >Islam</option>
						<option value="Judaism"  >Judaism</option>
    					<option value="Other_Religions_Total"  >Other</option>
    					<option value="No_Religion"  >No Religion</option>
						<option value="Religious_affiliation_not_stated"  >Religious not stated</option>
    				</select>
					<p class="form-title">Salary</p>
					
					
					<input id="joni" type="submit" value="Search" name="submit" onsubmit="getIndex()">
    			</form>
				
				
				
    		</div>
    		<div class="softener">
    		</div>
    		<div class="show-hide">
				
    			<p id="magic"><a href="#"><img src="images/logo3.png" alt="Census Matchmaker"></p>
				<script>
					$(document).ready(function(){
				$(".show-hide").click(function(){
					$(".content-search").toggle();
					});
				});
				</script>
    		</div>
    	</div>
		
			
		
  	</body>
</html>
<!-- Hosting24 Analytics Code -->
<script type="text/javascript" src="http://stats.hosting24.com/count.php"></script>
<!-- End Of Analytics Code -->
