<?php



//
// this file represents our bare-bones API, which only
// responds to GET requests, and has only one command, "cities"
//
// you might use it like:
//		curl -X GET http://weatherapp.zeoxdesign.com/api/cities
//
// or in angular.js, like:
//		$http.get("http://weatherapp.zeoxdesign.com/api/cities").success( ... );



if (!isset($args[1]))
{
	// if there are no args, then the default page is displayed
	echo ("<!DOCTYPE html><html><head><link rel=\"stylesheet\" href=\"/public/api_style.css\"></head><body>");
	echo ("<h1>WeatherApp API</h1><p>The following api commands are supported:</p>\n");
	echo ("<div>\n");
	echo ("<h3>cities</h3>");
	echo ("<pre>curl -X GET http://weatherapp.zeoxdesign.com/api/cities</pre><p>Returns a list of city names and temperatures in json format.</p>");
	echo ("<h3>last_update_time</h3>");
	echo ("<pre>curl -X GET http://weatherapp.zeoxdesign.com/api/last_update_time</pre><p>Returns the last time the data on the host server was refreshed.</p>");
	echo ("<h3>update</h3>");
	echo ("<pre>curl -X PUT http://weatherapp.zeoxdesign.com/api/update</pre><p>Asks the host server to perform a refresh.</p>");
	echo ("</div></body>\n");
}
else
{
	switch ($_SERVER['REQUEST_METHOD'])
	{
		case "GET":
			if ($args[1]=="cities")
			{
				require "internal/models/WeatherScraper.php";
				$scraper = new WeatherScraper();
				echo $scraper->get_last_scrape_json();
			}
			else if ($args[1]=="last_update_time")
			{
				require "internal/models/WeatherScraper.php";
				$scraper = new WeatherScraper();
				echo $scraper->get_last_update_time();
			}
			else
			{
				echo "404 - API command not found\n";
			}
		break;
		case "POST":
		case "PUT":
			if ($args[1]=="update")
			{
				require "internal/models/WeatherScraper.php";
				$scraper = new WeatherScraper();
				if (!$scraper->fetch_scrape_data()) die ("403 - could not fetch data.");
				if (!$scraper->parse_scrape_data()) die ("403 - could not parse data.");
				echo "update was successfull\n";
			}
			else
			{
				echo "404 - API command not found\n";
			}
		break;
		case "DELETE":
		default:
			echo "405 - API request method not supported\n";
		break;
	}
}
