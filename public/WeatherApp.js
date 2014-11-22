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
	$scope.show_map = false;
	$scope.last_refresh_time = null;
	$scope.refresh_rate_sec = 30;
	$scope.refreshing = false;
	$scope.refresh_promise = null;


	$scope.refresh = function(){

		// clear any active refresh timeouts
		if ($scope.refresh_promise) $timeout.cancel($scope.refresh_promise);

		// this will show the "REFRESHING..." notification
		$scope.refreshing = true;

		 // get weather data from our api

		$http.get("/api/cities")
		.success(function(data, status, headers, config) {
			// update our city data
			$scope.cities = data;
			// update the last_refresh_time
			var d = new Date();
			$scope.last_refresh_time = d.toLocaleDateString() + " " + d.toLocaleTimeString();

			// create a new timeout for the next auto-refresh, it will fire after refresh_rate_sec seconds
			$scope.refresh_promise = $timeout($scope.refresh, $scope.refresh_rate_sec * 1000);

			// hide the "REFRESHING..." notification after 1 second
			$timeout(function(){ $scope.refreshing = false; }, 1000);
		})
		.error(function(data, status, headers, config) {
			// report an error if something goes wrong
			alert("There was an error retrieving data from the API.\n\n" + data);
			$scope.refreshing = false;
		});
	}

	$scope.get_map_coordinates = function(city_name){

		// returns the coordinates of the city on our map

		switch(city_name)
		{
			case "Calgary": return {x:19,y:71}; break;
			case "Charlottetown": return {x:88,y:73}; break;
			case "Edmonton": return {x:21,y:65}; break;
			case "Fredericton": return {x:84,y:76}; break;
			case "Halifax": return {x:89,y:77}; break;
			case "Iqaluit": return {x:67,y:36}; break;
			case "Montr\u00e9al": return {x:75,y:83}; break;
			case "Ottawa (Kanata - Orl\u00e9ans)": return {x:72,y:84}; break;
			case "Prince George": return {x:11,y:59}; break;
			case "Qu\u00e9bec": return {x:77,y:78}; break;
			case "Regina": return {x:31,y:75}; break;
			case "Saskatoon": return {x:29,y:71}; break;
			case "St. John's": return {x:99,y:60}; break;
			case "Thunder Bay": return {x:52,y:81}; break;
			case "Toronto": return {x:68,y:90}; break;
			case "Vancouver": return {x:6,y:70}; break;
			case "Victoria": return {x:5,y:72}; break;
			case "Winnipeg": return {x:41,y:78}; break;
			case "Yellowknife": return {x:25,y:43}; break;
			case "Whitehorse": return {x:5,y:35}; break;
			default: return {x:0,y:100}; break;		
		}
	}
}


	
