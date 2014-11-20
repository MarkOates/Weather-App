<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="public/weather_style.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
<script type="text/javascript" src="public/WeatherApp.js"></script>
</head>

<body>
	<h1>Top 10<br>Coldest Canadian Cities</h1>
	<div ng-app="" ng-controller="WeatherApp">
		<table>
			<tr ng-repeat="city in cities | orderBy:temp">
				<td>{{ $index + 1 }}</td>
				<td>{{ city.name }}</td>
				<td>{{ city.temp }}&deg; C</td>
			</tr>
		</table>
	</div>
</body>

</html>