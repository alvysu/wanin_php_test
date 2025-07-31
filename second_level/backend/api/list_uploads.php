<?php
require_once 'db_second_level.php';

$stmt = $pdo->query("SELECT * FROM files ORDER BY upload_time DESC");
$files = $stmt->fetchAll();

echo "<h2>上傳檔案清單</h2><ul>";
foreach ($files as $file) {
    $url = "/uploads/" . htmlspecialchars($file['file_path']);
    echo "<li><a href='{$url}' target='_blank'>{$file['file_path']}</a> | 上傳時間：{$file['upload_time']}</li>";
}
echo "</ul><a href='../../frontend/upload.html'>返回上傳頁面</a>";
