<?php
require_once(__DIR__ . '/../../app/app.php');

use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;

set_time_limit(0);
//header('Content-Type: application/json');

$concurrency = getInput('concurrency', 1);
$data = getInput('data');
$size = filter_var(getInput('size', 1), FILTER_VALIDATE_INT);
if (!$size) {
    $size = 1;
}
$sizeFile = __DIR__ . "/../../data/{$size}mb.blob";
if ($size && !file_exists($sizeFile)) {
    http_response_code(422);
    echo json_encode((object) [
        'error' => 'Invalid filesize'
    ]);
    die();
}

$uri = env('PERFTEST_DATASINK');

$config = [
    'verify' => false
];

if ($data) {
    $config['form_params'] = [
        'data' => $data
    ];
} else {
    $config['multipart'] = [
        [
            'name' => 'data',
            'contents' => fopen(__DIR__ . "/../../data/{$size}mb.blob", 'r')
        ]
    ];
}


$results = (object) [
    'timestamp' => date('c'),
    'duration' => 0,
    'concurrency' => $concurrency,
    'size' => $size,
    'data' => $data,
    'requests' => []
];

$client = new Client($config);

$requests = [];
for ($i = 0; $i < $concurrency; $i++) {
    $requests[] = new Request('POST', $uri);
}

$start = microtime(true);
$responses = Pool::batch($client, $requests);
$duration = microtime(true) - $start;
if ($duration < 0) {
    $duration = 0;
}
$results->duration = $duration * 1000;

foreach ($responses as $response) {
    if ($response instanceof \Throwable) {
        $results->requests[] = (object) [
            'success' => false,
            'error' => $response->getMessage()
        ];
    } else {
        $results->requests[] = (object) [
            'success' => true,
            'code' => $response->getStatusCode(),
            'response' => json_decode($response->getBody()->getContents())
        ];
    }
}

echo json_encode($results);