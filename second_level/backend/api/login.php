<?php
header('Content-Type: application/json');
require_once '../db_second_level.php';

$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = $data['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo json_encode(['success' => false, 'message' => '帳號不存在']);
    exit;
}

// 驗證密碼
if (password_verify($password, $user['password'])) {
    echo json_encode(['success' => true, 'message' => '登入成功', 'user_id' => $user['id']]);
} else {
    echo json_encode(['success' => false, 'message' => '密碼錯誤']);
}
