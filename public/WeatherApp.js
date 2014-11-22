function WeatherApp($scope, $http, $timeout) {
	$scope.cities = [
		{name:"---",temp:0,population:6000,x:68,y:93},
		{name:"---",temp:0,population:6000,x:73,y:87},
		{name:"---",temp:0,population:6000,x:76,y:85},
		{name:"---",temp:0,population:6000,x:78,y:81},
		{name:"---",temp:0,population:6000,x:85,y:79},
		{name:"---",temp:0,population:6000,x:90,y:80},
		{name:"---",temp:0,population:6000,x:89,y:75},
		{name:"---",temp:0,population:6000,x:100,y:63},
		{name:"---",temp:0,population:6000,x:52,y:84},
		{name:"---",temp:0,population:6000,x:42,y:81}
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
}


	
