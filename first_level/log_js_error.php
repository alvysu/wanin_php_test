<?php
// log_js_error.php

// 判斷是否在本地環境（localhost 或 CLI）
$isLocal = in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) || php_sapi_name() === 'cli';

// 動態設定 log 檔路徑
$logFile = $isLocal
    ? __DIR__ . '/../tmp/status_log.txt'        // local: first_level/../tmp
    : '/var/www/html/tmp/status_log.txt';       // Docker: 明確位置

// ✅ 若資料夾不存在，自動建立
if (!file_exists(dirname($logFile))) {
    mkdir(dirname($logFile), 0777, true);
}

// 取得 POST JSON 資料
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
