<?php
// status_demo.php

$code = $_GET['code'] ?? '200';
$logFile = __DIR__ . '/logs/status_log.txt';  // log 檔案位置
$title = '';
$description = '';

switch ($code) {
    case '200':
        http_response_code(200);
        $title = "✅ 200 OK";
        $description = "這是伺服器正常回應的狀態，表示一切運作正常。";
        break;
    case '404':
        http_response_code(404);
        $title = "❌ 404 Not Found";
        $description = "找不到你請求的資源，請確認網址是否正確。";
        break;
    case '500':
        http_response_code(500);
        $title = "💥 500 Internal Server Error";
        $description = "伺服器在處理請求時發生錯誤（可能是 PHP 錯誤或系統錯誤）。";
        break;
    default:
        http_response_code(400);
        $title = "⚠️ 400 Bad Request";
        $description = "你輸入的狀態碼不正確，請重新選擇。";
        break;
}

// ✅ 寫入 log：只有非 200 才記錄
if ($code !== '200') {
    $log = sprintf(
        "[%s] 狀態碼: %s | IP: %s | URL: %s\n",
        date('Y-m-d H:i:s'),
        $code,
        $_SERVER['REMOTE_ADDR'],
        $_SERVER['REQUEST_URI']
    );
    file_put_contents($logFile, $log, FILE_APPEND);
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>
<body style="font-family:sans-serif;">
    <h1><?= $title ?></h1>
    <p><?= $description ?></p>

    <hr>
    <h2>🔍 快速測試：</h2>
    <ul>
        <li><a href="?code=200">模擬 <code>200 OK</code></a></li>
        <li><a href="?code=404">模擬 <code>404 Not Found</code></a></li>
        <li><a href="?code=500">模擬 <code>500 Internal Server Error</code></a></li>
        <li><a href="?code=999">模擬 <code>錯誤狀態碼</code></a></li>
    </ul>

    <p>你也可以手動改網址列，例如：<br>
    <code>http://localhost:8081/status_demo.php?code=500</code></p>
</body>
</html>
