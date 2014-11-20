function WeatherApp($scope, $http) {
	$scope.cities = [
		{name:"Toronto",temp:4,population:6000,x:68,y:93},
		{name:"Ottawa",temp:6,population:6000,x:73,y:87},
		{name:"Montreal",temp:8,population:6000,x:76,y:85},
		{name:"Quebec",temp:3,population:6000,x:78,y:81},
		{name:"Fredericton",temp:2,population:6000,x:85,y:79},
		{name:"Halifax",temp:2,population:6000,x:90,y:80},
		{name:"Charlottetown",temp:7,population:6000,x:89,y:75},
		{name:"St. Johns",temp:7,population:6000,x:100,y:63},
		{name:"Thunder Bay",temp:9,population:6000,x:52,y:84},
		{name:"Winnipeg",temp:9,population:6000,x:42,y:81}
	];
	$scope.show_map = false;
	$scope.update = function()
	{
		$http.get("http://localhost/api/cities")
		.success(function(data, status, headers, config) {
			$scope.cities = data;
		});
	}
}


	
