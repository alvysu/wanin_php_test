<?php
$host = '127.0.0.1';  // 若未來部署到 Render，要改成資料庫網址
$db   = 'intern_practice';    // 剛剛建立的資料庫名稱
$user = 'root';       // 資料庫帳號
$pass = 'qwe123';       // 資料庫密碼（如沒改過）
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // echo "✅ 成功連上資料庫！"; ← 拿掉這一行！！
} catch (PDOException $e) {
    // 建議這裡也回傳 JSON 格式的錯誤
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '連線失敗：' . $e->getMessage()]);
    exit;
}
