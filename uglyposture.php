<?php
require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

const SESSIONID = 'PHPSESSID=rh8222p5dtinfcltd7qi2tgd53';

$stdin = fopen('php://stdin', 'r');

while (empty($email))  {
    echo 'Input your email address: ';
    $email = trim(fgets($stdin));
}

while (empty($phpSession))  {
    echo 'Input your email session id [\''.SESSIONID.'\']: ';
    $phpSession = trim(fgets($stdin)) ?: SESSIONID;
}

$host = 'www.uglyposture.stream';
$base_url = 'http://'.$host;
$client = new Client(['cookies' => true]);

$clientOptions = [
    'headers' => [
        'Host' => $host,
        'Origin' => $base_url,
        'Pragma' => 'no-cache',
        'Upgrade-Insecure-Requests' => 1,
        'Cookie' => $phpSession,
    ],
    'form_params' => [
        'mail' => $email,
        'save' => 'Unsubscribe',
    ]
];

$alphabet = range('A', 'Z');
for ($i = 0, $l = count($alphabet); $i < $l; ++$i) {
    for ($n = 1; $n < 1000; ++$n) {
        $url = $base_url.'/unsub.php?c='.$n.$alphabet[$i];
        echo $url.PHP_EOL;

        $clientOptions['headers']['Referer'] = $url;
        $result = $client->request('POST', $url, $clientOptions);

        if($response = getHtmlResponse($result->getBody()->getContents())) {
            echo 'Response: '.$response.PHP_EOL;
            continue;
        }

        var_dump($result->getBody()->getContents());
    }
}

function getHtmlResponse(string $html): ?string
{
    preg_match_all('|<h[^>]+>(.*)</h[^>]+>|iU', $html, $matches);

    return $matches[1][1] ?? null;
}
