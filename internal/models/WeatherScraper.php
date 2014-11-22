<?php


class WeatherScraper
{
	private $remote_source_address = "https://weather.gc.ca/canada_e.html";
	private $local_copy_filename = "internal/scrape_data/last_scraped_source_data.htm";
	private $local_copy_json_filename = "internal/scrape_data/last_scraped_data.json";
	private $last_scrape_time_filename = "internal/scrape_data/last_scraped_data_time.txt";

	public function get_last_update_time()
	{
		return file_get_contents($this->last_scrape_time_filename);
	}

	public function get_last_scrape_json()
	{
		return file_get_contents($this->local_copy_json_filename);
	}

	public function fetch_scrape_data()
	{
		if (file_put_contents($this->local_copy_filename, file_get_contents($this->remote_source_address)))
		{
			date_default_timezone_set("UTC");
			file_put_contents($this->last_scrape_time_filename, date("Y-m-d H:i:s", time()));
			return true;
		}
		return false;
	}

	public function parse_scrape_data()
	{
		//
		// grab the contents from the source
		//

		$location = $this->local_copy_filename; // a locally stored copy of...
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
				$results[$i]["name"] = $matches[1][$i];
				$results[$i]["temp"] = (int)$matches[2][$i];
			}
		}
		else
		{
			// patterns did not capture successfully.
			echo "there was an error matching the patterns.";
		}


		//
		// Output the results in json format
		//

		file_put_contents($this->local_copy_json_filename, json_encode($results));

		return true;
	}
};