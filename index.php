<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<?php session_start(); ?>


	<!-- Page Width and Height -->
	<style type="text/css">
		html {
			height: 100%
		}
		body {
			height: 100%;
			margin: 0;
			padding: 0
		}
		#map {
			height: 100%;
			margin: top;
			padding: 0
		}
	</style>
	<!--Link to JQuery-->
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.js"></script>
	<!--Link to CSS-->
	<link type="text/css" rel="stylesheet" href="css/stylebono.css" />
	<link href='http://fonts.googleapis.com/css?family=Overlock:400,900' rel='stylesheet' type='text/css'>
	
	<!--Link to POP-UP-->
	<link rel="stylesheet" href="css/colorbox.css" />
	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
	
	<!--Google Map Api-->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAo3z4buaY-xjj9YXQexPl_DQLCv03XRFo&sensor=true"></script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=drawing&sensor=true"></script>




	<!--Initialize google map API-->
	<script type="text/javascript">
		function init() {
				var apiKey = "1md9UwiFfywVXX8iPH5x4srBHQ9XwXFA3LO3wEDAT";

				var mapOptions = {
					//map configuration
					//Set minimum zoom 5 and maximum zoom 10
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
					styles: [{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [{
							"color": "#3ca196"
						}]
					}, {
						"featureType": "landscape",
						"elementType": "geometry",
						"stylers": [{
							"color": "#f1eaca"
						}]
					}, {
						"featureType": "road",
						"elementType": "geometry",
						"stylers": [{
							"color": "#29768a"
						}, {
							"lightness": -37
						}]
					}, {
						"featureType": "poi",
						"elementType": "geometry",
						"stylers": [{
							"color": "#406d80"
						}]
					}, {
						"featureType": "transit",
						"elementType": "geometry",
						"stylers": [{
							"color": "#406d80"
						}]
					}, {
						"elementType": "labels.text.stroke",
						"stylers": [{
							"visibility": "on"
						}, {
							"color": "#3e606f"
						}, {
							"weight": 2
						}, {
							"gamma": 0.84
						}]
					}, {
						"elementType": "labels.text.fill",
						"stylers": [{
							"color": "#ffffff"
						}]
					}, {
						"featureType": "administrative",
						"elementType": "geometry",
						"stylers": [{
							"weight": 0.6
						}, {
							"color": "#1a3541"
						}]
					}, {
						"elementType": "labels.icon",
						"stylers": [{
							"visibility": "off"
						}]
					}, {
						"featureType": "poi.park",
						"elementType": "geometry",
						"stylers": [{
							"color": "#2c5a71"
						}]
					}]
				};




				// Get the HTML DOM element that will contain your map 
				// We are using a div with id="map" seen below in the <body>
				var mapElement = document.getElementById('map');

				// Create the Google Map using out element and options defined above
				var map = new google.maps.Map(mapElement, mapOptions);
				//Set LatLng boundary
				var strictBounds = new google.maps.LatLngBounds(
					new google.maps.LatLng(-45.739861, 110.205078),
					new google.maps.LatLng(-10.449624, 155.048828)

				);

				// Listen for the dragend event
				google.maps.event.addListener(map, 'dragend', function() {
					if (strictBounds.contains(map.getCenter())) return;

					//If users reach out of bound, go back 

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
				var gender = "Males_Total_Percentage";
				var age = "Persons_Percentage_Age_15_24_years";
				var nationality = "Persons_Australia_Percentage";
				var flag = '<?=$_SESSION['
				flag ']?>'; //takes the flag from session
				var education = "Highest_year_of_school_completed_Did_not_go_to_school";
				var language = "Language_spoken_at_home_English_only";
				var religion = "Christianity";
				var salary = "Total_Eight_Thousand";
				var employment = "Employed_worked_Full_time_Total_Percentage";
				var children = "Total_Number_of_children_ever_born_No_children";

				<? php
				if (isset($_GET['gender'])) {
					$_SESSION['gender'] = $_GET['gender'];
					$_SESSION['ageRange'] = $_GET['ageRange'];
					$_SESSION['nationality'] = $_GET['nationality'];
					$_SESSION['education'] = $_GET['education'];
					$_SESSION['language'] = $_GET['language'];
					$_SESSION['religion'] = $_GET['religion'];
					$_SESSION['salary'] = $_GET['salary'];
					$_SESSION['employment'] = $_GET['employment'];
					$_SESSION['children'] = $_GET['children'];
				}

				if (isset($_SESSION['gender'])) { //takes the values from session
					$gender = $_SESSION['gender'];
					$age = $_SESSION['ageRange'];
					$nationality = $_SESSION['nationality'];
					$education = $_SESSION['education'];
					$language = $_SESSION['language'];
					$religion = $_SESSION['religion'];
					$salary = $_SESSION['salary'];
					$employment = $_SESSION['employment'];
					$children = $_SESSION['children'];
				} ?>

				if (flag == "go") { //put the values from the session to javascript variables
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
				var url = "http://deco3801.host22.com/index.php" + "?gender=" +
					gender + "&ageRange=" + age + "&nationality=" + nationality +
					"&education=" + education + "&language=" + language + "&religion=" +
					religion + "&salary=" + salary + "&employment=" + employment + "&children=" +
					children;
				var fParam = document.getElementById("shareface");
				fParam.setAttribute("data-href", url);
				twttr.ready(function(twttr) {
					twttr.widgets.createShareButton(
						url,
						document.getElementById('shareface'),
						function(el) {
							console.log("Button created.")
						}, {
							text: 'fff',
							count: 'none'
						});
				});
				// Create Google Fusion Table layer
				var layer = new google.maps.FusionTablesLayer({
					query: {
						//Design Query
						select: 'geography',
						from: apiKey
					},
					styles: [{
						polygonOptions: {
							fillColor: "#f1ecce",
							fillOpacity: 1,
							strokeColor: "#ffffff",
							strokeWeight: 0.01
						}
					}, {
						where: gender + " > 0.30 AND " + age + " > 0.06 AND " +
							nationality + " > 0.003 AND " + education + " < 0.0015 AND " +
							language + " > 0.05 AND " + religion + " > 0.01  AND " + salary +
							" > 0.01 AND " + children + " > 0.01 AND " + employment + " > 0.01",
						polygonOptions: {
							fillColor: "#e9c0b9"
						}
					}, {
						where: gender + " > 0.35 AND " + age + "  > 0.12 AND " +
							nationality + " > 0.0227 AND " + education + " < 0.0095 AND " +
							language + " > 0.1 AND " + religion + " > 0.05 AND " + salary +
							" > 0.05 AND " + children + " > 0.05 AND " + employment + " > 0.05",
						polygonOptions: {
							fillColor: "#EB13DD"
						}
					}, {
						where: gender + " > 0.40 AND " + age + "  > 0.2 AND " +
							nationality + " > 0.0421 AND " + education + " < 0.0075 AND " +
							language + " > 0.25 AND " + religion + " > 0.14 AND " + salary +
							" > 0.15 AND " + children + " > 0.1 AND " + employment + " > 0.1",
						polygonOptions: {
							fillColor: "#13EAE6"
						}
					}]
				});

				//Set Google Fusion layer on Google Map
				layer.setMap(map);

				//No Match Found Pop Up
				var query2 = "SELECT * FROM " + '1md9UwiFfywVXX8iPH5x4srBHQ9XwXFA3LO3wEDAT' +
					" WHERE " + gender + " > 0.30 AND " + age + " > 0.06 AND " + nationality +
					" > 0.003 AND " + education + " < 0.0015 AND " + language + " > 0.05 AND " +
					religion + " > 0.01  AND " + salary + " > 0.01 AND " + children + " > 0.01 AND " +
					employment + " > 0.01";

				var encodedQuery2 = encodeURIComponent(query2);

				// Construct the URL
				var url2 = ['https://www.googleapis.com/fusiontables/v1/query'];
				url2.push('?sql=' + encodedQuery2);
				url2.push('&key=AIzaSyCBFaI1QuWlLRciCDKj1U9gX3kEsh55zpg');
				url2.push('&callback=?');

				// Send the JSONP request using jQuery
				$.ajax({
					url: url2.join(''),
					dataType: 'jsonp',
					success: function(data) {
						var empty = true;
						var rows = data['rows'];
						for (var i in rows) {
							empty = false;
						}
						if (empty) {
							alert("No Match Found");
							$(document).ready(function() {
								setTimeout(function() {
									$.fn.colorbox({
										href: "images/V2.jpg",
										open: true
									});
								}, 1500);
							});
						}
					}
				})



			} // belongs to init()
	</script>

	<!--GOOGLE CHART API-->

	<!--Load the AJAX API-->
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
		// Load the Visualization API and the piechart package.
		google.load('visualization', '1.0', {
			'packages': ['corechart']
		});

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
			var options = {
				'title': 'National Statistics Based On Your Preferences',
				'width': 400,
				'height': 300
			};

			// Instantiate and draw our chart, passing in some options.
			var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		}
	</script>
	<script>
		function setCookie(cname, cvalue, exdays) {
			var d = new Date();
			d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
			var expires = "expires=" + d.toGMTString();
			document.cookie = cname + "=" + cvalue + "; " + expires;
		}

		function getCookie(cname) {
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for (var i = 0; i < ca.length; i++) {
				var c = ca[i].trim();
				if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
			}
			return "";
		}

		function getIndex() {

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
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s);
				js.id = id;
				js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.0";
				fjs.parentNode.insertBefore(js, fjs);
			}
			(document, 'script', 'facebook-jssdk'));
	</script>

	<div id="header">
		<div class="logo-main">
			<a href="#">
				<img src="images/logo2.png" alt="Census Matchmaker">
			</a>
		</div>
	</div>
	<div id="map">
	</div>



	<div class="search-box">
		<div class="content-search">
			<div class="title">
				<h3>Match Criterias</h3>
			</div>
			<form action="setSession.php" method="post">

				<!--This is the start of the dropdown menu as the first dropdownbar is the gender-->
				<section class="main">
					<!--Calls in the css for the position of the dropdown bar .wraper-demo-->
					<div class="wrapper-demo">
						<div id="dd" class="wrapper-dropdown-1" tabindex="1">
							<span>Gender</span>
							<ul class="dropdown" tabindex="1">
								<!--Lets users select the choices -->
								<li id="male"><a value="Males_Total_Percentage"><i <?php echo ($gender == "Males_Total_Percentage" ? "selected" : "") ;?> ></i>Male</a>
								</li>
								<li id="female"><a value="Females_Total_Percentage"><i <?php echo ($gender == "Females_Total_Percentage" ? "selected" : "") ;?> ></i>Female</a>
								</li>
							</ul>
						</div>
						​</div>
				</section>





				<section class="main">
					<!--Calls in the css for the position of the dropdown bar .wraper-demo1-->
					<div class="wrapper-demo1">
						<div id="dd3" class="wrapper-dropdown-Age" tabindex="1">
							<span>Age Group</span>
							<!--Lets users select the choices -->
							<ul class="dropdownAge" tabindex="1">
								<li id="age15"><a value="Persons_Percentage_Age_15_24_years"><i <?php echo ($ageRange == "Persons_Percentage_Age_15_24_years" ? "selected" : "") ;?> ></i>18-24 years</a>
								</li>
								<li id="age25"><a value="Persons_Percentage_Age_25_44_years"><i <?php echo ($ageRange == "Persons_Percentage_Age_25_44_years" ? "selected" : "") ;?> ></i>25-44 years</a>
								</li>
								<li id="age45"><a value="Persons_Percentage_Age_45_54_years"><i <?php echo ($ageRange == "Persons_Percentage_Age_45_54_years" ? "selected" : "") ;?> ></i>45-54 years</a>
								</li>
								<li id="age55"><a value="Persons_Percentage_Age_55_64_years"><i <?php echo ($ageRange == "Persons_Percentage_Age_55_64_years" ? "selected" : "") ;?> ></i>55-64 years</a>
								</li>
							</ul>
						</div>
						​</div>
				</section>


				<section class="main">
					<!--Calls in the css for the position of the dropdown bar-->
					<div class="wrapper-demoEdu">
						<div id="dd4" class="wrapper-dropdown-Edu" tabindex="1">
							<span>Educated</span>
							<!--Lets users select the choices -->
							<ul class="dropdownEdu" tabindex="1">
								<!--Because the selection is send to the age variable thus we send it to education == "Highest_year_of_school_completed_Did_not_go_to_school-->
								<li id="yes"><a value="Highest_year_of_school_completed_Did_not_go_to_school"><i <?php echo ($education == "Highest_year_of_school_completed_Did_not_go_to_school" ? "selected" : "") ;?> ></i>Yes</a>
								</li>
								<li id="no"><a value="no"><i <?php echo ($education == "no" ? "selected" : "") ;?> ></i>No</a>
								</li>
							</ul>
						</div>
						​</div>
				</section>



				<section class="main">
					<!--Calls in the css for the position of the drop down bar-->
					<div class="wrapper-demoLang">
						<!--Lets users select the choices -->
						<div id="ddLang" class="wrapper-dropdown-Lang" tabindex="1">
							<span>Language</span>
							<ul class="dropdownLanguage" tabindex="1">
								<li id="langy"><a value="Language_spoken_at_home_English_only"><i <?php echo ($language == "Language_spoken_at_home_English_only" ? "selected" : "") ;?> ></i>English</a>
								</li>
								<li id="langn"><a value="Language_spoken_at_home_Other_Language"><i <?php echo ($language == "Language_spoken_at_home_Other_Language" ? "selected" : "") ;?> ></i>Other</a>
								</li>
							</ul>
						</div>
						​</div>
				</section>





				<section class="main">
					<!--Calls in the css for the position of the drop down bar-->
					<div class="wrapper-Reli">
						<!--Lets users select the choices -->
						<div id="ddReli" class="wrapper-dropdown-Reli" tabindex="1">
							<span>Religion</span>
							<ul class="dropdownReli">
								<li id="Buddhism1"><a value="Buddhism"><i <?php echo ($religion == "Buddhism" ? "selected" : "") ;?> ></i>Buddhism</a>
								</li>
								<li id="Christianity1"><a value="Christianity"><i <?php echo ($religion == "Christianity" ? "selected" : "") ;?> ></i>Christianity</a>
								</li>
								<li id="Hinduism1"><a value="Hinduism"><i <?php echo ($religion == "Hinduism" ?  "selected" : "") ;?> ></i>Hinduism</a>
								</li>
								<li id="Islam1"><a value="Islam"><i <?php echo ($religion == "Islam" ?  "selected" : "") ;?> ></i>Islam</a>
								</li>
								<li id="Judaism1"><a value="Judaism"><i <?php echo ($religion == "Judaism"  ? "selected" : "") ;?> ></i>Judaism</a>
								</li>
								<li id="Other1"><a value="Other_Religions_Total"><i <?php echo ($religion == "Other_Religions_Total" ? "selected" : "") ;?> ></i>Others</a>
								</li>
								<li id="Free_Thinker1"><a value="No_Religion"><i <?php echo ($religion == "No_Religion" ? "selected" : "") ;?> ></i>Free Thinker</a>
								</li>
							</ul>
						</div>
					</div>
				</section>









				<section class="main">
					<div class="wrapper-Salary">
						<!--Calls in the css for the position of the dropdown bar-->
						<div id="ddSalary" class="wrapper-dropdown-Salary" tabindex="1">
							<span>Salary</span>
							<!--Lets users select the choices -->
							<ul class="dropdownSalary">
								<li id="salary1"><a value="Negative_Nil_income_Total_Percentage"><i <?php echo ($salary == "Negative_Nil_income_Total_Percentage" ? "selected" : "") ;?> ></i>No Income</a>
								</li>
								<li id="salary2"><a value="Total_One_Two_Hundred"><i <?php echo ($salary == "Total_One_Two_Hundred" ? "selected" : "") ;?> ></i>1 - 199 Weekly</a>
								</li>
								<li id="salary3"><a value="Total_Two_Three_Hundred"><i <?php echo ($salary == "Total_Two_Three_Hundred" ?  "selected" : "") ;?> ></i>200 - 299 Weekly</a>
								</li>
								<li id="salary4"><a value="Total_Three_Four_Hundred"><i <?php echo ($salary == "Total_Three_Four_Hundred" ?  "selected" : "") ;?> ></i>300 - 399 Weekly</a>
								</li>
								<li id="salary5"><a value="Total_Four_Six_Hundred"><i <?php echo ($salary == "Total_Four_Six_Hundred"  ? "selected" : "") ;?> ></i>400 - 599 Weekly</a>
								</li>
								<li id="salary6"><a value="Total_Six_Eight_Hundred"><i <?php echo ($salary == "Total_Six_Eight_Hundred" ? "selected" : "") ;?> ></i>600 - 799 Weekly</a>
								</li>
								<li id="salary7"><a value="Total_Eight_Thousand"><i <?php echo ($salary == "Total_Eight_Thousand" ? "selected" : "") ;?> ></i>800 - 899 Weekly</a>
								</li>
								<li id="salary8"><a value="Total_Thousand_Twelve_Thousand"><i <?php echo ($salary == "Total_Thousand_Twelve_Thousand" ? "selected" : "") ;?> ></i>1000 - 1249 Weekly</a>
								</li>
								<li id="salary9"><a value="Total_Twelve_Fifteen_Thousand"><i <?php echo ($salary == "Total_Twelve_Fifteen_Thousand" ? "selected" : "") ;?> ></i>1250 - 1499 Weekly</a>
								</li>
								<li id="salary10"><a value="Total_Fifteen_Two_Thousand"><i <?php echo ($salary == "Total_Fifteen_Two_Thousand" ?  "selected" : "") ;?> ></i>1500 - 1999 Weekly</li>
							<li id="salary11"><a value="Total_Two_Thousand"><i <?php echo ($salary == "Total_Two_Thousand" ?  "selected" : "") ;?> ></i>More than 2000</a>
								</li>
								<li id="salary12"><a value="Personal_income_not_stated_Total_Percentage"><i <?php echo ($salary == "Personal_income_not_stated_Total_Percentage"  ? "selected" : "") ;?> ></i>Undisclosed</a>
								</li>

							</ul>
						</div>
					</div>
				</section>


				<section class="main">
					<!--Calls in the css for the position of the dropdown bar-->
					<div class="wrapper-Employment">
						<div id="ddEmployment" class="wrapper-dropdown-Employment" tabindex="1">
							<span>Employment</span>
							<!--Lets users select the choices -->
							<ul class="dropdownEmployment" tabindex="1">
								<li id="Employment1"><a value="Employed_worked_Full_time_Total_Percentage"><i <?php echo ($employment == "Employed_worked_Full_time_Total_Percentage" ? "selected" : "") ;?> ></i>Full-Time</a>
								</li>
								<li id="Employment2"><a value="Employed_worked_Part_time_Total_Percentage"><i <?php echo ($employment == "Employed_worked_Part_time_Total_Percentage" ? "selected" : "") ;?> ></i>Part-Time</a>
								</li>
							</ul>
						</div>
						​</div>
				</section>





				<section class="main">
					<!--Calls in the css for the position of the dropdown bar-->
					<div class="wrapper-Children">
						<div id="ddChildren" class="wrapper-dropdown-Children" tabindex="1">
							<span>Children</span>
							<!--Lets users select the choices -->
							<ul class="dropdownChildren">
								<li id="child1"><a value="Total_Number_of_children_ever_born_No_children"><i <?php echo ($children == "Total_Number_of_children_ever_born_No_children" ? "selected" : "") ;?> ></i>0</a>
								</li>
								<li id="child2"><a value="Total_Number_of_children_ever_born_One_child"><i <?php echo ($children == "Total_Number_of_children_ever_born_One_child" ? "selected" : "") ;?> ></i>1</a>
								</li>
								<li id="child3"><a value="Total_Number_of_children_ever_born_Two_children"><i <?php echo ($children == "Total_Number_of_children_ever_born_Two_children" ?  "selected" : "") ;?> ></i>2</a>
								</li>
								<li id="child4"><a value="Total_Number_of_children_ever_born_Three_children"><i <?php echo ($children == "Total_Number_of_children_ever_born_Three_children" ?  "selected" : "") ;?> ></i>3</a>
								</li>
								<li id="child5"><a value="Total_Number_of_children_ever_born_Four_children"><i <?php echo ($children == "Total_Number_of_children_ever_born_Four_children"  ? "selected" : "") ;?> ></i>4</a>
								</li>
								<li id="child6"><a value="Total_Number_of_children_ever_born_Five_children"><i <?php echo ($children == "Total_Number_of_children_ever_born_Five_children" ? "selected" : "") ;?> ></i>5</a>
								</li>
								<li id="child7"><a value="Total_Number_of_children_ever_born_Six_or_more_children"><i <?php echo ($children == "Total_Number_of_children_ever_born_Six_or_more_children" ? "selected" : "") ;?> ></i>6</a>
								</li>
							</ul>
						</div>
					</div>
				</section>







				<section class="main">
					<!--Calls in the css for the position of the dropdown bar-->
					<div class="wrapper-demo2">
						<div id="dd2" class="wrapper-dropdown-Nat" tabindex="1">
							<span>Nationality</span>
							<!--Lets users select the choices -->
							<ul class="dropdownNationality">
								<li id="australia"><a value="Persons_Australia_Percentage"><i <?php echo ($nationality == "Persons_Australia_Percentage" ? "selected" : "") ;?> ></i>Australian</a>
								</li>
								<li id="china"><a value="Persons_China_excludes_SARs_and_Taiwan_Percentage"><i <?php echo ($nationality == "Persons_China_excludes_SARs_and_Taiwan_Percentage" ? "selected" : "") ;?> ></i>China</a>
								</li>
								<li id="croatia"><a value="Persons_Croatia_Percentage"><i <?php echo ($nationality == "Persons_Croatia_Percentage" ? "selected" : "") ;?> ></i>Croatian</a>
								</li>
								<li id="england"><a value="Persons_England_Percentage"><i <?php echo ($nationality == "Persons_England_Percentage" ? "selected" : "") ;?> ></i>English</a>
								</li>
								<li id="fiji"><a value="Persons_Fiji_Percentage"><i <?php echo ($nationality == "Persons_Fiji_Percentage" ? "selected" : "") ;?> ></i>Fijian</a>
								</li>
								<li id="germany"><a value="Persons_Germany_Percentage"><i <?php echo ($nationality == "Persons_Germany_Percentage" ? "selected" : "") ;?> ></i>German</a>
								</li>
								<li id="greece"><a value="Persons_Greece_Percentage"><i <?php echo ($nationality == "Persons_Greece_Percentage" ? "selected" : "") ;?> ></i>Greek</a>
								</li>
								<li id="hk"><a value="Persons_Hong_Kong_SAR_of_China_Percentage"><i <?php echo ($nationality == "Persons_Hong_Kong_SAR_of_China_Percentage" ? "selected" : "") ;?> ></i>Hong Kongese</a>
								</li>
								<li id="india"><a value="Persons_India_Percentage"><i <?php echo ($nationality == "Persons_India_Percentage" ? "selected" : "") ;?> ></i>Indian</a>
								</li>
								<li id="indo"><a value="Persons_Indonesia_Percentage"><i <?php echo ($nationality == "Persons_Indonesia_Percentage" ? "selected" : "") ;?> ></i>Indonesian</a>
								</li>
								<li id="iraq"><a value="Persons_Iraq_Percentage"><i <?php echo ($nationality == "Persons_Iraq_Percentage" ? "selected" : "") ;?> ></i>Iraqi</a>
								</li>
								<li id="ireland"><a value="Persons_Ireland_Percentage"><i <?php echo ($nationality == "Persons_Ireland_Percentage" ? "selected" : "") ;?> ></i>Irish</a>
								</li>
								<li id="italy"><a value="Persons_Italy_Percentage"><i <?php echo ($nationality == "Persons_Italy_Percentage" ? "selected" : "") ;?> ></i>Italian</a>
								</li>
								<li id="korea"><a value="Persons_Korea_Republic_of_South_Percentage"><i <?php echo ($nationality == "Persons_Korea_Republic_of_South_Percentage" ? "selected" : "") ;?> ></i>Korean</a>
								</li>
								<li id="lebanon"><a value="Persons_Lebanon_Percentage"><i <?php echo ($nationality == "Persons_Lebanon_Percentage" ? "selected" : "") ;?> ></i>Labanese</a>
								</li>
								<li id="malaysia"><a value="Persons_Malaysia_Percentage"><i <?php echo ($nationality == "Persons_Malaysia_Percentage" ? "selected" : "") ;?> ></i>Malaysian</a>
								</li>
								<li id="netherlands"><a value="Persons_Netherlands_Percentage"><i <?php echo ($nationality == "Persons_Netherlands_Percentage" ? "selected" : "") ;?> ></i>Dutch</a>
								</li>
								<li id="nz"><a value="Persons_New_Zealand_Percentage"><i <?php echo ($nationality == "Persons_New_Zealand_Percentage" ? "selected" : "") ;?> ></i>New Zealander</a>
								</li>
								<li id="philippines"><a value="Persons_Philippines_Percentage"><i <?php echo ($nationality == "Persons_Philippines_Percentage" ? "selected" : "") ;?> ></i>Philippino</a>
								</li>
								<li id="scotland"><a value="Persons_Scotland_Percentage"><i <?php echo ($nationality == "Persons_Scotland_Percentage" ? "selected" : "") ;?> ></i>Scottish</a>
								</li>
								<li id="singapore"><a value="Persons_Singapore_Percentage"><i <?php echo ($nationality == "Persons_Singapore_Percentage" ? "selected" : "") ;?> ></i>Singaporean</a>
								</li>
								<li id="africa"><a value="Persons_South_Africa_Percentage"><i <?php echo ($nationality == "Persons_South_Africa_Percentage" ? "selected" : "") ;?> ></i>South African</a>
								</li>
								<li id="srilanka"><a value="Persons_Sri_Lanka_Percentage"><i <?php echo ($nationality == "Persons_Sri_Lanka_Percentage" ? "selected" : "") ;?> ></i>Sri Lankan</a>
								</li>
								<li id="usa"><a value="Persons_United_States_of_America_Percentage"><i <?php echo ($nationality == "Persons_United_States_of_America_Percentage" ? "selected" : "") ;?> ></i>American</a>
								</li>
								<li id="vietnam">
									<a value="Persons_Vietnam_Percentage"><i <?php echo ($nationality == "Persons_Vietnam_Percentage" ? "selected" : "") ;?> ></i>Vietnamese</a>
								</li>

							</ul>
						</div>
					</div>
				</section>






				<script>
					/*Gender when a user selects*/
					$('#male').click(function() {
						document.getElementById('gender').value = "Males_Total_Percentage";
					})
					 $('#female').click(function() {
						document.getElementById('gender').value = "Females_Total_Percentage";
					})

					/*Education when a user selects*/
					 $('#yes').click(function() {
						document.getElementById('education').value = "Highest_year_of_school_completed_Did_not_go_to_school";
					})
					 $('#no').click(function() {
						document.getElementById('education').value = "no";
					})

					/*Language when a user selects*/
					 $('#langy').click(function() {
						document.getElementById('language').value = "Language_spoken_at_home_English_only";
					})
					 $('#langn').click(function() {
						document.getElementById('language').value = "Language_spoken_at_home_Other_Language";
					})



					/*Religion when a user selects*/
					 $('#Buddhism1').click(function() {
						document.getElementById('religion').value = "Buddhism";
					})
					 $('#Christianity1').click(function() {
						document.getElementById('religion').value = "Christianity";
					})
					 $('#Hinduism1').click(function() {
						document.getElementById('religion').value = "Hinduism";
					})
					 $('#Islam1').click(function() {
						document.getElementById('religion').value = "Islam";
					})
					 $('#Judaism1').click(function() {
						document.getElementById('religion').value = "Judaism";
					})
					 $('#Other1').click(function() {
						document.getElementById('religion').value = "Other_Religions_Total";
					})
					 $('#Free_Thinker1').click(function() {
						document.getElementById('religion').value = "No_Religion";
					})

					/*Salary when a user selects*/
					 $('#salary1').click(function() {
						document.getElementById('salary').value = "Negative_Nil_income_Total_Percentage";
					})
					 $('#salary2').click(function() {
						document.getElementById('salary').value = "Total_One_Two_Hundred";
					})
					 $('#salary3').click(function() {
						document.getElementById('salary').value = "Total_Two_Three_Hundred";
					})
					 $('#salary4').click(function() {
						document.getElementById('salary').value = "Total_Three_Four_Hundred";
					})
					 $('#salary5').click(function() {
						document.getElementById('salary').value = "Total_Four_Six_Hundred";
					})
					 $('#salary6').click(function() {
						document.getElementById('salary').value = "Total_Six_Eight_Hundred";
					})
					 $('#salary7').click(function() {
						document.getElementById('salary').value = "Total_Eight_Thousand";
					})
					 $('#salary8').click(function() {
						document.getElementById('salary').value = "Total_Thousand_Twelve_Thousand";
					})
					 $('#salary9').click(function() {
						document.getElementById('salary').value = "Total_Twelve_Fifteen_Thousand";
					})
					 $('#salary10').click(function() {
						document.getElementById('salary').value = "Total_Fifteen_Two_Thousand";
					})
					 $('#salary11').click(function() {
						document.getElementById('salary').value = "Total_Two_Thousand";
					})
					 $('#salary12').click(function() {
						document.getElementById('salary').value = "Personal_income_not_stated_Total_Percentage";
					})




					/*Nationality when user selects*/
					 $('#australia').click(function() {
						document.getElementById('nationality').value = "Persons_Australia_Percentage";
					})
					 $('#china').click(function() {
						document.getElementById('nationality').value = "Persons_China_excludes_SARs_and_Taiwan_Percentage";
					})
					 $('#croatia').click(function() {
						document.getElementById('nationality').value = "Persons_Croatia_Percentage";
					})
					 $('#england').click(function() {
						document.getElementById('nationality').value = "Persons_England_Percentage";
					})
					 $('#fiji').click(function() {
						document.getElementById('nationality').value = "Persons_Fiji_Percentage";
					})
					 $('#germany').click(function() {
						document.getElementById('nationality').value = "Persons_Germany_Percentage";
					})
					 $('#greece').click(function() {
						document.getElementById('nationality').value = "Persons_Greece_Percentage";
					})
					 $('#hk').click(function() {
						document.getElementById('nationality').value = "Persons_Hong_Kong_SAR_of_China_Percentage";
					})
					 $('#india').click(function() {
						document.getElementById('nationality').value = "Persons_India_Percentage";
					})
					 $('#indo').click(function() {
						document.getElementById('nationality').value = "Persons_Indonesia_Percentage";
					})
					 $('#iraq').click(function() {
						document.getElementById('nationality').value = "Persons_Iraq_Percentage";
					})
					 $('#ireland').click(function() {
						document.getElementById('nationality').value = "Persons_Ireland_Percentage";
					})
					 $('#italy').click(function() {
						document.getElementById('nationality').value = "Persons_Italy_Percentage";
					})
					 $('#korea').click(function() {
						document.getElementById('nationality').value = "Persons_Korea_Republic_of_South_Percentage";
					})
					 $('#lebenon').click(function() {
						document.getElementById('nationality').value = "Persons_Lebanon_Percentage";
					})
					 $('#malaysia').click(function() {
						document.getElementById('nationality').value = "Persons_Malaysia_Percentage";
					})
					 $('#netherlands').click(function() {
						document.getElementById('nationality').value = "Persons_Netherlands_Percentage";
					})
					 $('#nz').click(function() {
						document.getElementById('nationality').value = "Persons_New_Zealand_Percentage";
					})
					 $('#philippines').click(function() {
						document.getElementById('nationality').value = "Persons_Philippines_Percentage";
					})
					 $('#scoutland').click(function() {
						document.getElementById('nationality').value = "Persons_Scotland_Percentage";
					})
					 $('#singapore').click(function() {
						document.getElementById('nationality').value = "Persons_Singapore_Percentage";
					})
					 $('#africa').click(function() {
						document.getElementById('nationality').value = "Persons_South_Africa_Percentage";
					})
					 $('#africa').click(function() {
						document.getElementById('nationality').value = "Persons_South_Africa_Percentage";
					})
					 $('#africa').click(function() {
						document.getElementById('nationality').value = "Persons_South_Africa_Percentage";
					})
					 $('#africa').click(function() {
						document.getElementById('nationality').value = "Persons_South_Africa_Percentage";
					})
					 $('#srilanka').click(function() {
						document.getElementById('nationality').value = "Persons_Sri_Lanka_Percentage";
					})
					 $('#usa').click(function() {
						document.getElementById('nationality').value = "Persons_United_States_of_America_Percentage";
					})
					 $('#vietnam').click(function() {
						document.getElementById('nationality').value = "Persons_Vietnam_Percentage";
					})

					/* Age Group when user selects */
					 $('#age15').click(function() {
						document.getElementById('ageRange').value = "Persons_Percentage_Age_15_24_years";
					})
					 $('#age25').click(function() {
						document.getElementById('ageRange').value = "Persons_Percentage_Age_25_44_years";
					})
					 $('#age45').click(function() {
						document.getElementById('ageRange').value = "Persons_Percentage_Age_45_54_years";
					})
					 $('#age55').click(function() {
						document.getElementById('ageRange').value = "Persons_Percentage_Age_55_64_years";
					})


					/*  Amount of children when user selects */
					 $('#child1').click(function() {
						document.getElementById('children').value = "Total_Number_of_children_ever_born_No_children";
					})
					 $('#child2').click(function() {
						document.getElementById('children').value = "Total_Number_of_children_ever_born_One_child";
					})
					 $('#child3').click(function() {
						document.getElementById('children').value = "Total_Number_of_children_ever_born_Two_children";
					})
					 $('#child4').click(function() {
						document.getElementById('children').value = "Total_Number_of_children_ever_born_Three_children";
					})
					 $('#child5').click(function() {
						document.getElementById('children').value = "Total_Number_of_children_ever_born_Four_children";
					})
					 $('#child6').click(function() {
						document.getElementById('children').value = "Total_Number_of_children_ever_born_Five_children";
					})
					 $('#child7').click(function() {
						document.getElementById('children').value = "Total_Number_of_children_ever_born_Six_or_more_children";
					})


					/* Employment status when user selects */
					 $('#Employment1').click(function() {
						document.getElementById('employment').value = "Employed_worked_Full_time_Total_Percentage";
					})
					 $('#Employment2').click(function() {
						document.getElementById('employment').value = "Employed_worked_Part_time_Total_Percentage";
					})
				</script>

				<!--Saves all the input from the search constraint-->
				<input type="hidden" id="gender" name="gender" value=""></input>
				<input type="hidden" name="ageRange" id="ageRange" value=""></input>
				<input type="hidden" id="education" name="education" value=""></input>
				<input type="hidden" id="language" name="language" value=""></input>
				<input type="hidden" id="religion" name="religion" value=""></input>
				<input type="hidden" id="nationality" name="nationality" value=""></input>
				<input type="hidden" id="salary" name="salary" value=""></input>
				<input type="hidden" id="employment" name="employment" value=""></input>
				<input type="hidden" id="children" name="children" value=""></input>
				<!--Submit Button-->
				<input id="joni" type="submit" value="Find Your Match" name="submit" onsubmit="getIndex()">
			</form>

			<div id="shareface" class="fb-share-button" data-width="30"></div>
			<!--<div id="sharetweet"></div>-->
			<script>
				window.twttr = (function(d, s, id) {
					var t, js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s);
					js.id = id;
					js.src = "https://platform.twitter.com/widgets.js";
					fjs.parentNode.insertBefore(js, fjs);
					return window.twttr || (
						t = {
							_e: [],
							ready: function(f) {
								t._e.push(f)
							}
						});
				}(document, "script", "twitter-wjs"));
			</script>
			<!--				<section class="main">
				<div class="wrapper-Sharing">
					   <span class='st_twitter_large' displayText='Tweet'></span>
						<span class='st_linkedin_large' displayText='LinkedIn'></span>
						<span class='st_facebook_large' displayText='Facebook'></span>
						<span class='st_pinterest_large' displayText='Pinterest'></span>
					</div>
			</section>		
    		</div>-->



			<div class="softener">
			</div>
			<div class="show-hide">
				<p id="magic">
					<a href="#">
						<img src="images/logo3.png" alt="Census Matchmaker">
				</p>
				<script>
					$(document).ready(function() {
						$(".show-hide").click(function() {
							$(".content-search").toggle();
						});
					});
				</script>
			</div>
		</div>
	</div>
	</div>
	</div>



	<!-- jQuery if needed -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type="text/javascript">
		//Drop down Controls Gender
		function DropDown(el) {
			this.dd = el;
			this.placeholder = this.dd.children('span');
			this.opts = this.dd.find('ul.dropdown > li');
			this.val = '';
			this.index = -1;
			this.initEvents();
		}
		DropDown.prototype = {
			initEvents: function() {
				var obj = this;

				obj.dd.on('click', function(event) {
					$(this).toggleClass('active');
					return false;
				});

				obj.opts.on('click', function() {
					var opt = $(this);
					obj.val = opt.text();
					obj.index = opt.index();
					obj.placeholder.text('Gender ' + obj.val);
				});
			},
			getValue: function() {
				return this.val;
			},
			getIndex: function() {
				return this.index;
			}
		}



		function DropDown1(el) {
			this.dd = el;
			this.initEvents();

		}
		DropDown1.prototype = {
				initEvents: function() {
					var obj = this;

					obj.dd.on('click', function(event) {
						$(this).toggleClass('active');
						event.stopPropagation();
					});
				}
			}
			//Drop down Controls Nationality

		function dropdownNationality(el) {
			this.dd = el;
			this.placeholder = this.dd.children('span');
			this.opts = this.dd.find('ul.dropdownNationality > li');
			this.val = '';
			this.index = -1;
			this.initEvents();
		}
		dropdownNationality.prototype = {
			initEvents: function() {
				var obj = this;

				obj.dd.on('click', function(event) {
					$(this).toggleClass('active');
					return false;
				});

				obj.opts.on('click', function() {
					var opt = $(this);
					obj.val = opt.text();
					obj.index = opt.index();
					obj.placeholder.text('Nationality ' + obj.val);
				});
			},
			getValue: function() {
				return this.val;
			},
			getIndex: function() {
				return this.index;
			}
		}


		 //Drop down Controls Age
		function dropdownAge(el) {
			this.dd = el;
			this.placeholder = this.dd.children('span');
			this.opts = this.dd.find('ul.dropdownAge > li');
			this.val = '';
			this.index = -1;
			this.initEvents();
		}
		dropdownAge.prototype = {
			initEvents: function() {
				var obj = this;

				obj.dd.on('click', function(event) {
					$(this).toggleClass('active');
					return false;
				});

				obj.opts.on('click', function() {
					var opt = $(this);
					obj.val = opt.text();
					obj.index = opt.index();
					obj.placeholder.text('Age ' + obj.val);
				});
			},
			getValue: function() {
				return this.val;
			},
			getIndex: function() {
				return this.index;
			}
		}

		 //Drop down Controls Education
		function dropdownEdu(el) {
			this.dd = el;
			this.placeholder = this.dd.children('span');
			this.opts = this.dd.find('ul.dropdownEdu > li');
			this.val = '';
			this.index = -1;
			this.initEvents();
		}
		dropdownEdu.prototype = {
			initEvents: function() {
				var obj = this;

				obj.dd.on('click', function(event) {
					$(this).toggleClass('active');
					return false;
				});

				obj.opts.on('click', function() {
					var opt = $(this);
					obj.val = opt.text();
					obj.index = opt.index();
					obj.placeholder.text('Education ' + obj.val);
				});
			},
			getValue: function() {
				return this.val;
			},
			getIndex: function() {
				return this.index;
			}
		}


		 //Drop down Controls Language
		function dropdownLanguage(el) {
			this.dd = el;
			this.placeholder = this.dd.children('span');
			this.opts = this.dd.find('ul.dropdownLanguage > li');
			this.val = '';
			this.index = -1;
			this.initEvents();
		}
		dropdownLanguage.prototype = {
			initEvents: function() {
				var obj = this;

				obj.dd.on('click', function(event) {
					$(this).toggleClass('active');
					return false;
				});

				obj.opts.on('click', function() {
					var opt = $(this);
					obj.val = opt.text();
					obj.index = opt.index();
					obj.placeholder.text('Language ' + obj.val);
				});
			},
			getValue: function() {
				return this.val;
			},
			getIndex: function() {
				return this.index;
			}
		}

		 //Drop down Controls religion
		function dropdownReli(el) {
			this.dd = el;
			this.placeholder = this.dd.children('span');
			this.opts = this.dd.find('ul.dropdownReli > li');
			this.val = '';
			this.index = -1;
			this.initEvents();
		}
		dropdownReli.prototype = {
			initEvents: function() {
				var obj = this;

				obj.dd.on('click', function(event) {
					$(this).toggleClass('active');
					return false;
				});

				obj.opts.on('click', function() {
					var opt = $(this);
					obj.val = opt.text();
					obj.index = opt.index();
					obj.placeholder.text('Religion ' + obj.val);
				});
			},
			getValue: function() {
				return this.val;
			},
			getIndex: function() {
				return this.index;
			}
		}


		 //Drop down Controls Salary
		function dropdownSalary(el) {
			this.dd = el;
			this.placeholder = this.dd.children('span');
			this.opts = this.dd.find('ul.dropdownSalary > li');
			this.val = '';
			this.index = -1;
			this.initEvents();
		}
		dropdownSalary.prototype = {
			initEvents: function() {
				var obj = this;

				obj.dd.on('click', function(event) {
					$(this).toggleClass('active');
					return false;
				});

				obj.opts.on('click', function() {
					var opt = $(this);
					obj.val = opt.text();
					obj.index = opt.index();
					obj.placeholder.text('Salary ' + obj.val);
				});
			},
			getValue: function() {
				return this.val;
			},
			getIndex: function() {
				return this.index;
			}
		}





		 //Drop down Controls Employment
		function dropdownEmployment(el) {
			this.dd = el;
			this.placeholder = this.dd.children('span');
			this.opts = this.dd.find('ul.dropdownEmployment > li');
			this.val = '';
			this.index = -1;
			this.initEvents();
		}
		dropdownEmployment.prototype = {
			initEvents: function() {
				var obj = this;

				obj.dd.on('click', function(event) {
					$(this).toggleClass('active');
					return false;
				});

				obj.opts.on('click', function() {
					var opt = $(this);
					obj.val = opt.text();
					obj.index = opt.index();
					obj.placeholder.text('Employment ' + obj.val);
				});
			},
			getValue: function() {
				return this.val;
			},
			getIndex: function() {
				return this.index;
			}
		}



		 //Drop down Controls Children
		function dropdownChildren(el) {
			this.dd = el;
			this.placeholder = this.dd.children('span');
			this.opts = this.dd.find('ul.dropdownChildren > li');
			this.val = '';
			this.index = -1;
			this.initEvents();
		}
		dropdownChildren.prototype = {
			initEvents: function() {
				var obj = this;

				obj.dd.on('click', function(event) {
					$(this).toggleClass('active');
					return false;
				});

				obj.opts.on('click', function() {
					var opt = $(this);
					obj.val = opt.text();
					obj.index = opt.index();
					obj.placeholder.text('Children ' + obj.val);
				});
			},
			getValue: function() {
				return this.val;
			},
			getIndex: function() {
				return this.index;
			}
		}









		$(function() {

			//Saves the selection on the display of the dropdown container
			var dd2 = new dropdownNationality($('#dd2'));
			var dd3 = new dropdownAge($('#dd3'));
			var dd = new DropDown($('#dd'));
			var dd1 = new DropDown1($('#dd1'));
			var dd4 = new dropdownEdu($('#dd4'));
			var ddLang = new dropdownLanguage($('#ddLang'));
			var ddReli = new dropdownReli($('#ddReli'));
			var ddSalary = new dropdownSalary($('#ddSalary'));
			var ddEmployment = new dropdownEmployment($('#ddEmployment'));
			var ddChildren = new dropdownChildren($('#ddChildren'));




			$(document).click(function() {
				// all dropdowns
				$('.wrapper-dropdown-Salary').removeClass('active');
				$('.wrapper-dropdown-Nat').removeClass('active');
				$('.wrapper-dropdown-Age').removeClass('active');
				$('.wrapper-dropdown-1').removeClass('active');
				$('.wrapper-dropdown-Edu').removeClass('active');
				$('.wrapper-dropdown-Lang').removeClass('active');
				$('.wrapper-dropdown-Reli').removeClass('active');
				$('.wrapper-dropdown-Employment').removeClass('active');
				$('.wrapper-dropdown-Children').removeClass('active');



			});

		});
	</script>






</body>

</html>