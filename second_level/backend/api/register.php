<?php
header('Content-Type: application/json');
require_once '../db_second_level.php';

$data = json_decode(file_get_contents('php://input'), true);

$username = trim($data['username']);
$password = $data['password'];
$email = trim($data['email']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => '信箱格式錯誤']);
    exit;
}
if (strlen($password) < 6) {
    echo json_encode(['success' => false, 'message' => '密碼至少 6 字']);
    exit;
}

// ✅ 產生不重複的 user ID
$id = 'user_' . bin2hex(random_bytes(8));

// ✅ 加密密碼
$hashedPwd = password_hash($password, PASSWORD_DEFAULT);

// ✅ 插入資料
$stmt = $pdo->prepare("INSERT INTO users (id, username, password, email) VALUES (?, ?, ?, ?)");

try {
    $stmt->execute([$id, $username, $hashedPwd, $email]);
    echo json_encode(['success' => true, 'message' => '註冊成功']);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => '註冊失敗：' . $e->getMessage()
    ]);
}
