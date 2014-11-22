function WeatherApp($scope, $http, $timeout) {
	$scope.cities = [
		{name:"---",temp:0,population:6000,x:0,y:100},
		{name:"---",temp:0,population:6000,x:0,y:100},
		{name:"---",temp:0,population:6000,x:0,y:100},
		{name:"---",temp:0,population:6000,x:0,y:100},
		{name:"---",temp:0,population:6000,x:0,y:100},
		{name:"---",temp:0,population:6000,x:0,y:100},
		{name:"---",temp:0,population:6000,x:0,y:100},
		{name:"---",temp:0,population:6000,x:0,y:100},
		{name:"---",temp:0,population:6000,x:0,y:100},
		{name:"---",temp:0,population:6000,x:0,y:100},
	];
	$scope.show_map = true;
	$scope.last_refresh_time = null;
	$scope.refresh_rate_sec = 30;
	$scope.refresh = function()
	{
		$http.get("http://localhost/api/cities")
		.success(function(data, status, headers, config) {
			$scope.cities = data;
		});

		var d = new Date();
		$scope.last_refresh_time = d.toLocaleDateString() + " " + d.toLocaleTimeString();

		$timeout($scope.update, $scope.refresh_rate_sec * 1000);
	}
	$scope.get_map_coordinates = function(city_name)
	{
		switch(city_name)
		{
			case "Calgary": return {x:20,y:74}; break;
			case "Charlottetown": return {x:89,y:76}; break;
			case "Edmonton": return {x:22,y:68}; break;
			case "Fredericton": return {x:85,y:79}; break;
			case "Halifax": return {x:90,y:80}; break;
			case "Iqaluit": return {x:68,y:39}; break;
			case "Montr\u00e9al": return {x:76,y:86}; break;
			case "Ottawa (Kanata - Orl\u00e9ans)": return {x:73,y:87}; break;
			case "Prince George": return {x:12,y:62}; break;
			case "Qu\u00e9bec": return {x:78,y:81}; break;
			case "Regina": return {x:32,y:78}; break;
			case "Saskatoon": return {x:30,y:74}; break;
			case "St. John's": return {x:100,y:63}; break;
			case "Thunder Bay": return {x:53,y:84}; break;
			case "Toronto": return {x:69,y:93}; break;
			case "Vancouver": return {x:7,y:73}; break;
			case "Victoria": return {x:6,y:75}; break;
			case "Winnipeg": return {x:42,y:81}; break;
			case "Yellowknife": return {x:26,y:46}; break;
			case "Whitehorse": return {x:6,y:38}; break;
			default: return {x:0,y:100}; break;		
		}
	}
}


	
