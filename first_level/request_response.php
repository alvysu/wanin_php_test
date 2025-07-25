<?php
// 取得來自 URL 的參數與請求資訊
$method = $_SERVER['REQUEST_METHOD'];
$name = $_GET['name'] ?? $_POST['name'] ?? '訪客';
$agent = $_SERVER['HTTP_USER_AGENT'];
$ip = $_SERVER['REMOTE_ADDR'];
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>Request & Response 生命週期</title>
</head>
<body>
    <h2>🔁 Request & Response 生命週期展示</h2>

    <h3>🟢 使用者發出請求（Request）</h3>
    <ul>
        <li>請求方法：<strong><?= $method ?></strong></li>
        <li>傳入參數（name）：<strong><?= htmlspecialchars($name) ?></strong></li>
        <li>使用者 IP：<strong><?= $ip ?></strong></li>
        <li>User-Agent：<strong><?= $agent ?></strong></li>
    </ul>

    <h3>📦 伺服器處理與回應（Response）</h3>
    <ul>
        <li>伺服器接收到請求後，由 PHP 腳本執行邏輯。</li>
        <li>產生 HTML 結果，回傳給瀏覽器。</li>
        <li>這就是你目前看到的這個頁面。</li>
    </ul>

    <h3>📝 測試方式</h3>
    <ol>
        <li>直接訪問：<code>https://wanin-php-test.onrender.com/first_level/request_response.php?name=Alvy</code></li>
        <li>或使用下方表單測試 POST 請求：</li>
    </ol>

    <form method="POST">
        <label for="name">請輸入你的名字：</label>
        <input type="text" name="name" id="name">
        <button type="submit">送出</button>
    </form>

    <h3>📘 補充說明：Request 與 Response 是什麼？</h3>
    <ul>
        <li><strong>Request（請求）：</strong> 使用者（如瀏覽器）向伺服器發出的資料，可能包含方法、表單資料、參數等。</li>
        <li><strong>Response（回應）：</strong> 伺服器將處理結果（通常是 HTML、JSON、圖片等）傳回使用者。</li>
    </ul>
</body>
</html>
