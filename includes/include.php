<?php

session_start();

defined("AIR_URL") or define("AIR_URL", "https://api.airtable.com/v0/appHQjoAwqIUL1ASC/%C3%96neriler");
defined("AIR_URL_LK") or define("AIR_URL_LK", 'https://api.airtable.com/v0/appHQjoAwqIUL1ASC/Lookups');
defined("AIR_API_KEY") or define("AIR_API_KEY", "keyhla68YAD5DdYed");
defined("AZURE_KEY") or define("AZURE_KEY", "Fv/1P3C0y9QJljuxzaISxdfazrC1JHZk/tlb7juSAeFZwBQmmqse23VkNPaHnbVM/soVnudGI3MQoLbUAmwqTg==");

if (empty($_SESSION['LOOKUPS']) || isset($_SESSION['lookups']['erease'])) {
    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, AIR_URL_LK);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = [
            "Authorization: Bearer " . AIR_API_KEY,
            "Content-Type: application/json",
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $server_output = curl_exec($ch);
        curl_close($ch);

        $temp = json_decode($server_output, true)['records'];
        $_SESSION['LOOKUPS'] = [];
        foreach ($temp as $r) {
            $v = $r['fields'];
            if (empty($_SESSION['LOOKUPS'][$v['set']])) {
                $_SESSION['LOOKUPS'][$v['set']] = [];
            }
            $_SESSION['LOOKUPS'][$v['set']][$v['key']] = $v['value'];
        }
    } catch (Exception $e) {
        $_SESSION['LOOKUPS'] = [
            'erease' => true,
            'branch' => [],
            'department' => [],
            'suggestionType' => [],
            'text' => [
                'caption' => "Fikir Atölyesi",
                'home' => "MAİS Fikir Atölyesi'ne Hoşgeldiniz!",
                "done" => "Gösterdiğiniz ilgi ve ayırdığınız zaman için teşekkür ederiz.",
            ],
        ];
    }
}
