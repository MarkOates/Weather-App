<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="public/weather_style.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
</head>

<body>

	<img id="maple_flag" src="public/canadian_maple.png">
	<h1>Top 10<br>Coldest Canadian Cities</h1>
	<div ng-app="" ng-controller="WeatherApp" ng-init="refresh();">
		<ul id="controls">
			<li><button type="button" ng-click="refresh();">Update Manually</button></li>
			<li><button type="button" ng-click="show_map=true;">Show Map</button></li>
			<li><button type="button" ng-click="show_map=false;">Show List</button></li>
		</ul>
		<br clear="all">
		<table ng-hide="show_map">
			<tr ng-repeat="city in cities | orderBy:'temp' | limitTo:10">
				<td>{{ $index + 1 }}</td>
				<td>{{ city.name }}</td>
				<td>{{ city.temp }}&deg; C</td>
			</tr>
		</table>
		<div class="canada_map" ng-show="show_map">
			<img src="public/canada_map_large-01.png" style="width: 100%;">
			<div class="city_marker" ng-style="{'left':'{{city.x}}%','top':'{{city.y}}%'}" ng-repeat="city in cities | orderBy:'y' | limitTo:10">
				<img class="marker" src="public/marker_point-01.png">
				<span>{{ city.name + " (" + city.temp + "&deg;C)" }}</span>
			</div>
		</div>
		<div id="update_data">Page was last refresh {{ last_refresh_time }}</div>
	</div>

	<script type="text/javascript" src="public/WeatherApp.js"></script>

</body>

</html>