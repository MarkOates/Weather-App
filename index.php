<?php

$args = array();

if (isset($_GET['url']))
{

    // split URL
    $url = rtrim($_GET['url'], '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = explode('/', $url);

    $args = $url;

    print_r($args);
    echo "\n";
}

if (empty($args)) echo "empty args\n";