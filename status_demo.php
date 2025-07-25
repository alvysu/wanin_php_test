<?php
// status_demo.php

// === ✅ 1. 設定錯誤紀錄 ===
$logFile = __DIR__ . '/logs/status_log.txt';

// 一般 PHP 錯誤
set_error_handler(function($errno, $errstr, $errfile, $errline) use ($logFile) {
    $log = sprintf(
        "[%s] PHP 錯誤：%s in %s on line %d\n",
        date('Y-m-d H:i:s'), $errstr, $errfile, $errline
    );
    file_put_contents($logFile, $log, FILE_APPEND);
    return false;
});

// 致命錯誤
register_shutdown_function(function() use ($logFile) {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        $log = sprintf(
            "[%s] 致命錯誤：%s in %s on line %d\n",
            date('Y-m-d H:i:s'), $error['message'], $error['file'], $error['line']
        );
        file_put_contents($logFile, $log, FILE_APPEND);
    }
});

// === ✅ 2. 狀態碼處理 ===
$code = $_GET['code'] ?? '200';
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
    case 'debug500':
        undefined_function(); // 故意觸發致命錯誤
        break;
    default:
        http_response_code(400);
        $title = "⚠️ 400 Bad Request";
        $description = "你輸入的狀態碼不正確，請重新選擇。";
        break;
}

// ✅ 若不是 200 就記錄
if ($code !== '200' && $code !== 'debug500') {
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
        <li><a href="?code=debug500" style="color:red;">🔴 產生真實 PHP 錯誤（500）</a></li>
    </ul>

    <p>你也可以手動改網址列，例如：<br>
    <code>http://localhost:8081/status_demo.php?code=500</code></p>

    <hr>
    <h2>🔧 測試 JS 錯誤：</h2>
    <button onclick="triggerError()">點我觸發 JS 錯誤</button>

    <p>🔍 錯誤說明</p>
    <p>obj 是 undefined。</p>
    <p>嘗試呼叫 obj.map(...)。</p>
    <p>但 .map() 是 陣列（Array） 的方法，undefined 根本沒有 .map 這個方法。</p>
    <p>所以會出現錯誤</p>

    <script>
    function triggerError() {
        let obj;
        obj.map(x => x); // 故意錯誤
    }

    window.onerror = function(message, source, lineno, colno, error) {
        fetch('log_js_error.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                message,
                source,
                lineno,
                colno,
                stack: error?.stack || ''
            })
        });
    };
    </script>
</body>
</html>
