<?php

session_start();

$s = isset($_GET['search']) ? $_GET['search'] : "";

$deps = [];
foreach ($_SESSION['LOOKUPS']['department'] as $k => $v) {

    if (empty($s) || stripos($v, $s) !== false) {
        $deps[] = [
            'id' => $k,
            'name' => $v,
        ];
    }
}
//$deps = [
//    0 => [
//        "id" => "Bilgi İşlem",
//        "name" => "Bilgi İşlem",
//        "content" => "France",
//        "image" => "https://avatars2.githubusercontent.com/u/3149526?v=3&s=80"
//    ]
//];

echo json_encode($deps);
