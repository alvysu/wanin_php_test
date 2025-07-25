<?php
// ✅ 統一 log 檔案路徑（與 log_viewer.php、status_demo.php 一致）
$logFile = '/var/www/html/status_log.txt';


// ✅ 自動建立 log 資料夾（通常這裡不需要，但保留容錯）
$logDir = dirname($logFile);
if (!is_dir($logDir)) {
    mkdir($logDir, 0777, true);
}

// ✅ 接收 POST 傳入的 JSON 錯誤資料
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
