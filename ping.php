<?php
/**
 * Created by PhpStorm.
 * User: aliaxander
 * Date: 27.06.17
 * Time: 12:51
 */
$testHost = "www.google.com";
$testPort = 80;
$timeout = 1;

$logDir = "logs";
$errorLogDir = "errors";

$date = date('Y.m.d');
$time = date('H:i');

$result = ping($testHost, $testPort, $timeout);

if ($result['status'] === false) {
    addToFile(__DIR__ . '/' . $logDir . '/' . $date . '.txt', $time . ': ' . $result['error']);
    $result = getTrace($testHost);
    if (empty($result)) {
        $result = 'traceroute: unknown host (DNS problem)';
    }
    addToFile(__DIR__ . '/' . $errorLogDir . '/' . $date . '-' . date('H_i') . '.txt', $result);
} else {
    addToFile(__DIR__ . '/' . $logDir . '/' . $date . '.txt', $time . ': ' . $result['result']);
}


function ping($host, $port, $timeout)
{
    $tB = microtime(true);
    $fP = @fSockOpen($host, $port, $errno, $errstr, $timeout);
    $errstr = str_replace('php_network_getaddresses: ', '', $errstr);
    if (!$fP) {
        return ['status' => false, 'error' => $errstr];
    }
    $tA = microtime(true);
    
    return ['status' => true, 'result' => round((($tA - $tB) * 1000), 0) . " ms"];
}

function addToFile($file, $text)
{
    file_put_contents($file, PHP_EOL . $text, FILE_APPEND);
    
}

function getTrace($host)
{
    return shell_exec('traceroute ' . $host);
}