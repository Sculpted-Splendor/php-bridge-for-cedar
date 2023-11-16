<?php

require_once __DIR__ . '/fixture.php';

$start = microtime(true);
$count = 0;

while (microtime(true) - $start < 10) {
    fixture();
    $count ++;
}

echo json_encode(['executions' => $count, 'time_taken' => microtime(true) - $start]);
