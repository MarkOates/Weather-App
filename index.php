<?php



// errors and config settings

error_reporting(E_ALL);



// parse split url into an $args array

$args = array();

if (isset($_GET['url']))
{
    // split URL
    $url = rtrim($_GET['url'], '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = explode('/', $url);

    $args = $url;
}



// decide which page to load

if (empty($args))
{
	require ("internal/index.php");
}
else if ($args[0] == "api")
{
	require ("internal/api.php");
}
else
{
	echo "<h1>404</h1>";
}
