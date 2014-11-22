<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="public/weather_style.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
</head>

<body>

	<h1>Top 10<br>Coldest Canadian Cities</h1>
	<div style="position: relative;" ng-app="" ng-controller="WeatherApp" ng-init="refresh();">
		<img id="maple_flag" ng-hide="show_map" src="public/canadian_maple.png">
		<ul id="controls">
			<li><button type="button" ng-click="show_map=true;">Show Map View</button></li>
			<li><button type="button" ng-click="show_map=false;">Show List View</button></li>
		</ul>
		<br clear="all">
		<div id="refreshing_spinner" ng-show="refreshing">REFRESHING...</div>
		<table ng-hide="show_map">
			<tr ng-repeat="city in cities | orderBy:'temp' | limitTo:10">
				<td>{{ $index + 1 }}</td>
				<td>{{ city.name }}</td>
				<td>{{ city.temp }}&deg; C</td>
			</tr>
		</table>
		<div class="canada_map" ng-show="show_map">
			<img src="public/canada_map_large-01.png" style="width: 100%;">
			<div class="city_marker" ng-style="{'left':'{{get_map_coordinates(city.name).x}}%','top':'{{get_map_coordinates(city.name).y}}%'}" ng-repeat="city in cities | orderBy:'temp' | limitTo:10">
				<img class="marker" src="public/marker_point-01.png">
				<span>{{ city.name + " (" + city.temp + "&deg;C)" }}</span>
			</div>
		</div>
		<div id="footer">Page was last refreshed {{ last_refresh_time }}<br><a href="/api">API</a> &bull; <a href="https://github.com/MarkOates/Weather-App">This project on GitHub</a> &bull; <span ng-click="refresh();" style="cursor: pointer;"><u>Refresh Manually</u></span></div>
	</div>

	<script type="text/javascript" src="public/WeatherApp.js"></script>

</body>

</html>