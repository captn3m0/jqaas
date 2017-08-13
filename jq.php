<?php

function call_jq($contents, $filter)
{
    $filter = escapeshellarg($filter);

    $cmd = './jq ' . $filter;

    $temp = tmpfile();

    $filename = stream_get_meta_data($temp)['uri'];

    fwrite($temp, $contents);

    $filename = escapeshellarg($filename);

    
    $cmd .= " --raw-output --join-output --compact-output $filename";

    exec($cmd, $output, $return);

    /**
     * Normally jq exits with 2 if there was any usage problem or system error, 3 if there was a jq program compile error, or 0
     * if the jq program ran.
     */
    switch ($return) {
        case 2:
        case 3:
            http_response_code(400);
            $error = join("\n", $output);
            return 'jq eror: '. $error;
            break;

        case 0:
        default:
            if(count($output) === 1 and $return === 0)
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
            break;
    }
}

