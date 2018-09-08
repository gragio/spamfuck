<?php

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

$email = 'example@email.com';
$phpSession = 'PHPSESSID=yoursession';

$host = 'www.uglyposture.stream';
$base_url = 'http://'.$host;
$client = new Client(['cookies' => true]);

$alphabet = range('A', 'Z');
for ($i = 0, $l = count($alphabet); $i < $l; ++$i) {
    for ($n = 1; $n < 1000; ++$n) {
        $url = $base_url.'/unsub.php?c='.$n.$alphabet[$i];
        echo $url.PHP_EOL;
        $result = $client->request('POST', $url, [
                'headers' => [
                    'Host' => $host,
                    'Origin' => $base_url,
                    'Referer' => $url,
                    'Pragma' => 'no-cache',
                    'Upgrade-Insecure-Requests' => 1,
                    'Cookie' => $phpSession,
                ],
                'form_params' => [
                    'mail' => $email,
                    'save' => 'Unsubscribe',
                ]
            ]);

        preg_match_all('|<h[^>]+>(.*)</h[^>]+>|iU', $result->getBody()->getContents(), $matches);
        if(isset($matches[1][1])) {
            echo $matches[1][1].PHP_EOL;
            continue;
        }

        var_dump($result->getBody()->getContents());
    }
}
