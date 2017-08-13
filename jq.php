<?php

function call_jq($contents, $filter)
{
    $filter = escapeshellarg($filter);

    $cmd = './jq ' . $filter;

    $temp = tmpfile();
    $filename = stream_get_meta_data($temp)['uri'];

    fwrite($temp, $contents);

    $cmd .= " $filename";

    exec($cmd, $output, $return);

    if ($return !== 0 )
    {
        header("Content-Type: plain/text");
        // Assuming jq failed because of your error
        // Might map jq error codes later
        http_response_code(400 + $return);
        return 'jq execution failed';
    }
    else if(count($output) === 1)
    {
        // Just guessing
        header("Content-Type: application/json");
        return $output[0];
    }
    else
    {
        header("Content-Type: application/x-ndjson");
        return join("\n", $output);
    }

}

