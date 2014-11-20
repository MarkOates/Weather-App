function WeatherApp($scope) {
	$scope.cities = [
		// these need to be plotted, on a 0-100% positioning on the map
		// toronto is given as an example
		{name:"Toronto",temp:4,population:6000,x:68,y:93},
		{name:"Ottawa",temp:6,population:6000,x:50,y:50},
		{name:"Montreal",temp:8,population:6000,x:50,y:50},
		{name:"Quebec",temp:3,population:6000,x:50,y:50},
		{name:"Fredericton",temp:2,population:6000,x:50,y:50},
		{name:"Halifax",temp:2,population:6000,x:50,y:50},
		{name:"Charlottetown",temp:7,population:6000,x:50,y:50},
		{name:"St. Johns",temp:7,population:6000,x:50,y:50},
		{name:"Thunder Bay",temp:9,population:6000,x:50,y:50},
		{name:"Winnipeg",temp:9,population:6000,x:50,y:50}
	];
	$scope.show_map = false;
}
