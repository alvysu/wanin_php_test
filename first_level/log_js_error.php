<?php
$logFile = __DIR__ . '/../tmp/status_log.txt';
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $log = sprintf(
        "[%s] JS 錯誤：%s in %s on line %d, column %d\nStack: %s\n",
        date('Y-m-d H:i:s'),
        $data['message'],
        $data['source'],
        $data['lineno'],
        $data['colno'],
        $data['stack']
    );
    file_put_contents($logFile, $log, FILE_APPEND);
}
