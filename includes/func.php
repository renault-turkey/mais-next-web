<?php

//include './include.php';

function uploadBlob($filetoUpload, $originalFn) {

    $now = gmdate("D, d M Y H:i:s T", time());
    $handle = fopen($filetoUpload, "r");
    $len = filesize($filetoUpload);

    $version = "2017-04-17";

    $fName = @end(explode("/", $filetoUpload));

    $fn = @uniqid() . rand(1000, 200000) . "." . end(explode(".", $originalFn));

    $bytes = utf8_encode("PUT\n\n\n$len\n\n\n\n\n\n\n\n\nx-ms-blob-type:BlockBlob\nx-ms-date:" . $now .
            "\nx-ms-version:" .
            $version .
            "\n/rshub/assets/temp/$fn");

    $signature = base64_encode(hash_hmac('sha256', utf8_encode($bytes), base64_decode(AZURE_KEY), true));

    $headers = [
        "x-ms-blob-type: BlockBlob",
        "x-ms-date: $now",
        "x-ms-version: $version",
        "Authorization: SharedKey rshub:" . $signature,
    ];

    ///$fields = array('file' => '@' . $filetoUpload);

    $ch = curl_init("https://rshub.blob.core.windows.net/assets/temp/$fn");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_INFILE, $handle);
    curl_setopt($ch, CURLOPT_INFILESIZE, $len);
    curl_setopt($ch, CURLOPT_UPLOAD, true);
    $result = curl_exec($ch);

    curl_close($ch);
//
//    echo "RESULT FROM CH:\n\n";
//    echo $result;
//    die;

    return "https://rshub.blob.core.windows.net/assets/temp/$fn";
}

function postSuggestion($post) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, AIR_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $headers = [
        "Authorization: Bearer " . AIR_API_KEY,
        "Content-Type: application/json",
    ];

    $body = [
        'fields' => $post
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

    $server_output = curl_exec($ch);

//    echo "RESULT FROM AIR\n\n";
//    echo $server_output;
//    die;
    curl_close($ch);
}
