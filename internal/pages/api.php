<?php



//
// this file represents our bare-bones API, which only
// responds to GET requests, and has only one command, "cities"
//
// you might use it like:
//		curl -X GET http://localhost/api/cities
//
// or in angular.js, like:
//		$http.get("http://localhost/api/cities").success( ... );


switch ($_SERVER['REQUEST_METHOD'])
{
	case "GET":
		if (!isset($args[1]))
		{
			echo ("<h1>API</h1><p>You can access the only API command available by sending a <tt>GET</tt> request through <tt>http://localhost/api/cities</tt>.</p>");
			echo ("<p>This will provide you with a JSON-formatted response with city name and its temperature. e.g.: <tt>[{city:\"CityName\",temp:1234}, ...}]</tt>.</p>");
			echo ("<p>The API only supports temperatures from the top 20 most populus cities in the Canadian province.</p>");
		}
		else if ($args[1]=="cities")
		{
			require("internal/tests/scraper_test.php");
		}
		else
		{
			echo "404 - API command not found";
		}
	break;
	case "POST":
	case "PUT":
	case "DELETE":
	default:
		echo "405 - API request method not allowed\n";
	break;
}
