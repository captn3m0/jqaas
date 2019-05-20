<?php

require('./jq.php');

header("Access-Control-Allow-Origin: *");

$contents = null;

if(isset($_GET['url']))
{
    $url = $_GET['url'];
    if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED||FILTER_FLAG_HOST_REQUIRED) !== false)
    {
        $contents = file_get_contents($url);

        if ($contents === false)
        {
            http_response_code(400);
            header("Content-Type: plain/text");
            die("Fetching URL failed: ".$url);
        }   
    }
}
else if(is_null($contents))
{
    // Read Input JSON off the request POST
    $contents = file_get_contents('php://input');
}

if (empty($contents))
{
    // We don't have a request body or a URL
    // Send user to the wiki
    header("Location: https://github.com/captn3m0/jqaas");
    exit;
}

if (isset($_SERVER['HTTP_JQ_FILTER']))
{
    $filter = $_SERVER['HTTP_JQ_FILTER'];
}
else
{
    $filter = '.';
}

echo call_jq($contents, $filter);