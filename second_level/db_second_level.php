<?php
$host = '127.0.0.1';  // 若未來部署到 Render，要改成資料庫網址
$db   = 'second_level';    // 剛剛建立的資料庫名稱
$user = 'root';       // 資料庫帳號
$pass = 'qwe123';       // 資料庫密碼（如沒改過）
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "✅ 成功連上資料庫！";
} catch (PDOException $e) {
    echo "❌ 連線失敗：" . $e->getMessage();
}
