<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<?php
	session_start();
	?>
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map { height: 82% }
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
		  
	     var mapOptions = {
		   // How zoomed in you want the map to start at (always required)
		   zoom: 5,
							   minZoom: 5,
							   maxZoom: 10,
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
		new google.maps.LatLng(-45.739861, 110.205078), 
   	    new google.maps.LatLng(-10.449624, 155.048828) 
     
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
   
      google.maps.event.addListener(map, 'zoom_changed', function() {
     if (map.getZoom() < minZoomLevel) map.setZoom(minZoomLevel);
   });
	   
	   
	  // Hardcode variables for testing purposes
	   var gender = "";
	   var age = "Persons_Percentage_Age_15_24_years";
	   var nationality = "Persons_Australia_Percentage";
	   var flag = '<?=$_SESSION['flag']?>'; //takes the flag from session
		var education ="Highest_year_of_school_completed_Did_not_go_to_school";
		var language="Language_spoken_at_home_English_only";
		var religion="Christianity";
		var salary="Total_Eight_Thousand";
		var employment="Employed_worked_Full_time_Total_Percentage";
		var children = "Total_Number_of_children_ever_born_No_children";
	   
	   <?php 
		if(isset($_SESSION['gender'])) 
		{	//takes the values from session
			$gender = $_SESSION['gender'];
			$age = $_SESSION['ageRange'];
			$nationality = $_SESSION['nationality'];
			$education = $_SESSION['education'];
			$language = $_SESSION['language'];
			$religion = $_SESSION['religion'];
			$salary= $_SESSION['salary'];
			$employment = $_SESSION['employment'];
			$children = $_SESSION['children'];
		}
		
		if (isset($_GET['gender'])) 
		{
			$gender = $_GET['gender'];
			$age = $_GET['ageRange'];
			$nationality = $_GET['nationality'];
			$education = $_GET['education'];
			$language = $_GET['language'];
			$religion = $_GET['religion'];
			$salary= $_GET['salary'];
			$employment = $_GET['employment'];
			$children = $_GET['children'];
		}		
		?>
		if(flag == "go")
		{	//put the values from the session to javascript variables
			gender = '<?=$gender;?>'; 
			age = '<?=$age;?>';
			nationality = '<?=$nationality;?>';
			education = '<?=$education;?>';
			language = '<?=$language;?>';
			religion = '<?=$religion;?>';
			salary = '<?=$salary;?>';
			employment = '<?=$employment;?>';
			children = '<?=$children;?>';
		}
	var url = "http://deco3801-22.uqcloud.net/Sharing/index.php" + "?gender=" + gender + "&ageRange="+ age + "&nationality=" + nationality + "&education=" + education + "&language=" + language + "&religion=" + religion + "&salary=" + salary + "&employment=" + employment + "&children=" + children;
	var fParam = document.getElementById( "shareface" );
	var tParam = document.getElementById( "sharetweet" );
	fParam.setAttribute( "data-href", url );
	tParam.setAttribute( "data-url", url );
	
		
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
			   where: gender + " > 0.40 AND " + age + " > 0.08 AND " + nationality + " > 0.003 AND " + education + " < 0.0015 AND " + language + " > 0.05 AND " + religion + " > 0.01  AND " + salary + " > 0.01 AND " + children + " > 0.01 AND " + employment + " > 0.01",
			   polygonOptions: {
				  fillColor: "#e9c0b9"
			   }
			},{
				  where: gender + " > 0.42 AND " + age + "  > 0.132 AND " + nationality + " > 0.0227 AND " +education + " < 0.0095 AND " + language + " > 0.1 AND " + religion + " > 0.05 AND " + salary + " > 0.05 AND " + children + " > 0.05 AND " + employment + " > 0.05",
			    polygonOptions: {
					  fillColor: "#EB13DD"
				   }
				},
				{
			   where: gender + " > 0.46 AND " + age + "  > 0.236 AND " + nationality + " > 0.0621 AND " +education + " < 0.0075 AND " + language + " > 0.25 AND " + religion + " > 0.14 AND " + salary + " > 0.15 AND " + children + " > 0.1 AND " + employment + " > 0.1",
			  polygonOptions: {
				  fillColor: "#13EAE6"
			   }
			}
			]
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

        // Set chart options
        var options = {'title':'National Statistics Based On Your Preferences',
                       'width':400,
                       'height':300};

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
		//function for fb share
		<div id="fb-root"></div>
		<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}
		(document, 'script', 'facebook-jssdk'));
		</script>
		
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
    				<input type="radio" name="gender" value="Males_Total_Percentage" <?php echo ($gender == "Males_Total_Percentage" ? "checked" : "") ;?>>Male</input>
    				<input type="radio" name="gender" value="Females_Total_Percentage"<?php echo ($gender == "Females_Total_Percentage" ? "checked" : "" ) ;?>>Female</input>
    				<p class="form-title">Age</p>
    				<select name="ageRange">
						<option value="Persons_Percentage_Age_15_24_years" <?php echo ($age == "Persons_Percentage_Age_15_24_years" ? "selected" : "") ;?> >15-24 years</option>
    					<option value="Persons_Percentage_Age_25_44_years" <?php echo ($age == "Persons_Percentage_Age_25_44_years" ? "selected" : "") ;?> >25-44 years</option>
    					<option value="Persons_Percentage_Age_45_54_years" <?php echo ($age == "Persons_Percentage_Age_45_54_years" ? "selected" : "") ;?> >45-54 years</option>
    					<option value="Persons_Percentage_Age_55_64_years" <?php echo ($age == "Persons_Percentage_Age_55_64_years" ? "selected" : "") ;?> >55-64 years</option>
    				</select>
    				<p class="form-title">Nationality</p>
					<select name="nationality" id="natForm">
						<option value="">-- select one --</option>
					  <option value="Persons_Australia_Percentage" <?php echo ($nationality == "Persons_Australia_Percentage" ? "selected" : "") ;?> >Australia</option>
					  <option value="Persons_China_excludes_SARs_and_Taiwan_Percentage" <?php echo ($nationality == "Persons_China_excludes_SARs_and_Taiwan_Percentage" ? "selected" : "") ;?>>China excludes SARs &amp; Taiwan</option>
					  <option value="Persons_Croatia_Percentage" <?php echo ($nationality == "Persons_Croatia_Percentage" ? "selected" : "") ;?>>Croatia</option>
					  <option value="Persons_England_Percentage" <?php echo ($nationality == "Persons_England_Percentage" ? "selected" : "") ;?>>England</option>
					  <option value="Persons_Fiji_Percentage" <?php echo ($nationality == "Persons_Fiji_Percentage" ? "selected" : "") ;?>>Fiji</option>
					  <option value="Persons_Germany_Percentage" <?php echo ($nationality == "Persons_Germany_Percentage" ? "selected" : "") ;?>>Germany</option>
					  <option value="Persons_Greece_Percentage" <?php echo ($nationality == "Persons_Greece_Percentage" ? "selected" : "") ;?>>Greece</option>
					  <option value="Persons_Hong_Kong_SAR_of_China_Percentage" <?php echo ($nationality == "Persons_Hong_Kong_SAR_of_China_Percentage" ? "selected" : "") ;?>>Hong Kong SAR of China</option>
					  <option value="Persons_India_Percentage" <?php echo ($nationality == "Persons_India_Percentage" ? "selected" : "") ;?>>India</option>
					  <option value="Persons_Indonesia_Percentage" <?php echo ($nationality == "Persons_Indonesia_Percentage" ? "selected" : "") ;?>>Indonesia</option>
					  <option value="Persons_Iraq_Percentage" <?php echo ($nationality == "Persons_Iraq_Percentage" ? "selected" : "") ;?>>Iraq</option>
					  <option value="Persons_Ireland_Percentage" <?php echo ($nationality == "Persons_Ireland_Percentage" ? "selected" : "") ;?>>Ireland</option>
					  <option value="Persons_Italy_Percentage" <?php echo ($nationality == "Persons_Italy_Percentage" ? "selected" : "") ;?>>Italy</option>
					  <option value="Persons_Korea_Republic_of_South_Percentage" <?php echo ($nationality == "Persons_Korea_Republic_of_South_Percentage" ? "selected" : "") ;?>>Korea Republic of Souuth</option>
					  <option value="Persons_Lebanon_Percentage" <?php echo ($nationality == "Persons_Lebanon_Percentage" ? "selected" : "") ;?>>Lebanon</option>
					  <option value="Persons_Malaysia_Percentage" <?php echo ($nationality == "Persons_Malaysia_Percentage" ? "selected" : "") ;?>>Malaysia</option>>
					  <option value="Persons_Netherlands_Percentage" <?php echo ($nationality == "Persons_Netherlands_Percentage" ? "selected" : "") ;?>>Netherlands</option>
					  <option value="Persons_New_Zealand_Percentage" <?php echo ($nationality == "Persons_New_Zealand_Percentage" ? "selected" : "") ;?>>New Zealand</option>
					  <option value="Persons_Philippines_Percentage" <?php echo ($nationality == "Persons_Philippines_Percentage" ? "selected" : "") ;?>>Philippines</option>
					  <option value="Persons_Scotland_Percentage" <?php echo ($nationality == "Persons_Scotland_Percentage" ? "selected" : "") ;?>>Scotland</option>
					  <option value="Persons_Singapore_Percentage" <?php echo ($nationality == "Persons_Singapore_Percentage" ? "selected" : "") ;?>>Singapore</option>
					  <option value="Persons_South_Africa_Percentage" <?php echo ($nationality == "Persons_South_Africa_Percentage" ? "selected" : "") ;?>>South Africa</option>
					  <option value="Persons_Sri_Lanka_Percentage" <?php echo ($nationality == "Persons_Sri_Lanka_Percentage" ? "selected" : "") ;?>>Sri Lanka</option>  
					  <option value="Persons_United_States_of_America_Percentage" <?php echo ($nationality == "Persons_United_States_of_America_Percentage" ? "selected" : "") ;?>>United States of America</option>
					  <option value="Persons_Vietnam_Percentage" <?php echo ($nationality == "Persons_Vietnam_Percentage" ? "selected" : "") ;?>>Vietnam</option>
					  </select>
					  <p class="form-title">Education Important?</p>
					  <select name="education">
					  <option value="Highest_year_of_school_completed_Did_not_go_to_school">Yes</option>
					  <option value="no">No</option>
					  </select>
					  <p class="form-title">Language</p>
					  <input type="radio" name="language" value="Language_spoken_at_home_English_only" <?php echo ($language == "Language_spoken_at_home_English_only" ? "checked" : "") ;?>>English</input>
					  <input type="radio" name="language" value="Language_spoken_at_home_Other_Language"<?php echo ($language == "Language_spoken_at_home_Other_Language" ? "checked" : "" ) ;?>>Other Language</input>
					<p class="form-title">Religion</p>
						<select name="religion">
						<option value="Buddhism" <?php echo ($religion == "Buddhism" ? "selected" : "") ;?> >Buddhism</option>
    					<option value="Christianity" <?php echo ($religion == "Christianity" ? "selected" : "") ;?> >Christianity</option>
    					<option value="Hinduism" <?php echo ($religion == "Hinduism" ? "selected" : "") ;?> >Hinduism</option>
    					<option value="Islam" <?php echo ($religion == "Islam" ? "selected" : "") ;?> >Islam</option>
						<option value="Judaism" <?php echo ($religion == "Judaism" ? "selected" : "") ;?> >Judaism</option>
    					<option value="Other_Religions_Total" <?php echo ($religion == "Other_Religions_Total" ? "selected" : "") ;?> >Other</option>
    					<option value="No_Religion" <?php echo ($religion == "No_Religion" ? "selected" : "") ;?> >No Religion</option>
						<option value="Religious_affiliation_not_stated" <?php echo ($religion == "Religious_affiliation_not_stated" ? "selected" : "") ;?> >Religious not stated</option>
    				</select>
					<p class="form-title">Salary</p>
					<select name="salary">
						<option value="Negative_Nil_income_Total_Percentage" <?php echo ($religion == "Negative_Nil_income_Total_Percentage" ? "selected" : "") ;?> >0</option>
    					<option value="Total_One_Two_Hundred" <?php echo ($salary == "Total_One_Two_Hundred" ? "selected" : "") ;?> >1-199 per week</option>
    					<option value="Total_Two_Three_Hundred" <?php echo ($salary == "Total_Two_Three_Hundred" ? "selected" : "") ;?> >200-299 per week</option>
    					<option value="Total_Three_Four_Hundred" <?php echo ($salary == "Total_Three_Four_Hundred" ? "selected" : "") ;?> >300-399 per week</option>
						<option value="Total_Four_Six_Hundred" <?php echo ($salary == "Total_Four_Six_Hundred" ? "selected" : "") ;?> >400-599 per week</option>
    					<option value="Total_Six_Eight_Hundred" <?php echo ($salary == "Total_Six_Eight_Hundred" ? "selected" : "") ;?> >600-799 per week</option>
    					<option value="Total_Eight_Thousand" <?php echo ($salary == "Total_Eight_Thousand" ? "selected" : "") ;?> >800-899 per week</option>
						<option value="Total_Thousand_Twelve_Thousand" <?php echo ($salary == "Total_Thousand_Twelve_Thousand" ? "selected" : "") ;?> >1000-1249 per week</option>
						<option value="Total_Twelve_Fifteen_Thousand" <?php echo ($salary == "Total_Twelve_Fifteen_Thousand" ? "selected" : "") ;?> >1250-1499 per week</option>
    					<option value="Total_Fifteen_Two_Thousand" <?php echo ($salary == "Total_Fifteen_Two_Thousand" ? "selected" : "") ;?> >1500-1999 per week</option>
    					<option value="Total_Two_Thousand" <?php echo ($salary == "Total_Two_Thousand" ? "selected" : "") ;?> >2000 or more</option>
						<option value="Personal_income_not_stated_Total_Percentage" <?php echo ($salary == "Personal_income_not_stated_Total_Percentage" ? "selected" : "") ;?> >Salary not stated</option>		
    				</select>
					<p class="form-title">Employment</p>
						<input type="radio" name="employment" value="Employed_worked_Full_time_Total_Percentage" <?php echo ($employment == "Employed_worked_Full_time_Total_Percentage" ? "checked" : "") ;?>>Full-Time</input>
						<input type="radio" name="employment" value="Employed_worked_Part_time_Total_Percentage"<?php echo ($employment == "Employed_worked_Part_time_Total_Percentage" ? "checked" : "" ) ;?>>Part-Time</input>
					<p class="form-title">Children</p>
						<select name="children">
						<option value="Total_Number_of_children_ever_born_No_children" <?php echo ($children == "Total_Number_of_children_ever_born_No_children" ? "selected" : "") ;?> >0</option>
    					<option value="Total_Number_of_children_ever_born_One_child" <?php echo ($children == "Total_Number_of_children_ever_born_One_child" ? "selected" : "") ;?> >1</option>
    					<option value="Total_Number_of_children_ever_born_Two_children" <?php echo ($children == "Total_Number_of_children_ever_born_Two_children" ? "selected" : "") ;?> >2</option>
    					<option value="Total_Number_of_children_ever_born_Three_children" <?php echo ($children == "Total_Number_of_children_ever_born_Three_children" ? "selected" : "") ;?> >3</option>
						<option value="Total_Number_of_children_ever_born_Four_children" <?php echo ($children == "Total_Number_of_children_ever_born_Four_children" ? "selected" : "") ;?> >4</option>
    					<option value="Total_Number_of_children_ever_born_Five_children" <?php echo ($children == "Total_Number_of_children_ever_born_Five_children" ? "selected" : "") ;?> >5</option>
    					<option value="Total_Number_of_children_ever_born_Six_or_more_children" <?php echo ($children == "Total_Number_of_children_ever_born_Six_or_more_children" ? "selected" : "") ;?> >6 or more</option>
						</select>				
					
					<input id="joni" type="submit" value="Find Your Match" name="submit" onsubmit="getIndex()">
    			</form>
			<div id="shareface" class="fb-share-button" data-width="30"></div>
				<a id="sharetweet" href="https://twitter.com/share" class="twitter-share-button" data-text="sdfgadfg" data-count="none">Tweet</a>
				<script>
					!function(d,s,id){
						var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
						if(!d.getElementById(id)){
							js=d.createElement(s);
							js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
							fjs.parentNode.insertBefore(js,fjs);
						}
					}
					(document, 'script', 'twitter-wjs');
				</script>	
								
    		</div>
    		<div class="softener">
    		</div>
    		<div class="show-hide">
    			<p id="magic" class="rotate">Hide <?=$_SESSION['formIndex']?></p>
				<script>
					$(document).ready(function(){
				$(".show-hide").click(function(){
					$(".content-search").toggle();
					});
				});
				</script>
    		</div>
    	</div>
		<div class="graph-box" >
			<div class="show-hide-graph">
    			<p id="magic" class="rotate">Hide</p>
				<script>
					$(document).ready(function(){
				$(".show-hide-graph").click(function(){
					$(".graph-area").toggle();
					});
				});
				</script>
    		</div>
    		<div class="softener-graph">
    		</div>
			<div class="graph-area">
				<div id="chart_div">
				</div>
			</div>
		</div>
		<div id="footer">
		</div>
  	</body>
</html>