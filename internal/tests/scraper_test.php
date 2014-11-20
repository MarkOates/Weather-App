<?php




//
// grab the contents from the source
//

$location = "internal/tests/scraper_test_data.htm"; // a locally stored copy of...
//$location = "https://weather.gc.ca/canada_e.html"; // <-- this

$content_to_scrape = file_get_contents($location);



//
// extract just the tbody
//

$table_start_pos = strpos($content_to_scrape, "<tbody");
$table_end_pos = strpos($content_to_scrape, "</tbody>") + strlen("</tbody>");

$table_of_data = substr($content_to_scrape, $table_start_pos, $table_end_pos - $table_start_pos);



//
// Now we have just the tbody with data. Scrape my monkeys! ScRAPE!
//

$matches = array();
$scraper_pattern = '/html\'>(.+)<\/a>.+<td>(.+)&deg;C<\/td><\/tr/';
$results = null;

if (preg_match_all($scraper_pattern, $table_of_data, $matches))
{
	// patterns captured successfully
	$results = array();
	for ($i=0; $i<sizeof($matches[0]); $i++)
	{
		$results[$i]["city"] = $matches[1][$i];
		$results[$i]["temp"] = (int)$matches[2][$i];
	}
}
else
{
	echo "there was an error matching the patterns.";
}



//
// Output the results in json format
//

echo json_encode($results);