<?php
// 判斷本地環境
$isLocal = in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) || php_sapi_name() === 'cli';

// 決定 log 路徑
$logFile = $isLocal
    ? __DIR__ . '/../tmp/status_log.txt'
    : '/var/www/html/tmp/status_log.txt';

// ⚠️ 只在本地才 mkdir
if ($isLocal) {
    $logDir = dirname($logFile);
    if (!is_dir($logDir)) {
        mkdir($logDir, 0777, true);
    }
}

// 讀取 log
$logs = file_exists($logFile) ? file($logFile, FILE_IGNORE_NEW_LINES) : [];
?>



<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>Log Viewer - 錯誤紀錄檢視器</title>
    <style>
        body { font-family: sans-serif; padding: 2rem; }
        h1 { margin-bottom: 1rem; }
        pre {
            background: #f9f9f9;
            padding: 1rem;
            border: 1px solid #ccc;
            max-height: 500px;
            overflow: auto;
        }
        .log-entry { margin-bottom: 0.5rem; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>📝 Log Viewer - 錯誤紀錄</h1>

    <?php if (empty($logs)): ?>
        <p class="error">目前尚無任何錯誤紀錄。</p>
    <?php else: ?>
        <pre>
<?php foreach ($logs as $line): ?>
<?= htmlspecialchars($line) . "\n" ?>
<?php endforeach; ?>
        </pre>
    <?php endif; ?>

    <p><a href="status_demo.php">🔁 回到狀態碼測試頁</a></p>
</body>
</html>
