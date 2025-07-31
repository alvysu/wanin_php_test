<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../db_second_level.php';

use Ramsey\Uuid\Uuid;
use Symfony\Component\Mime\MimeTypes;

$uploadDir = __DIR__ . '/../../../uploads';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $fileTmp   = $_FILES['file']['tmp_name'];
    $fileName  = $_FILES['file']['name'];
    $fileSize  = $_FILES['file']['size'];
    $fileExt   = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $uuidName  = Uuid::uuid4()->toString() . '.' . $fileExt;
    $mimeType  = mime_content_type($fileTmp);

    // 驗證副檔名是否合規
    $mimeTypes = new MimeTypes();
    $validExts = $mimeTypes->getExtensions($mimeType);
    if (!in_array($fileExt, $validExts)) {
        die("❌ 副檔名與檔案內容不符，請重新上傳");
    }

    // 搬移檔案
    $destination = $uploadDir . '/' . $uuidName;
    if (move_uploaded_file($fileTmp, $destination)) {
        // ✅ 寫入資料庫
        $stmt = $pdo->prepare("INSERT INTO files (user_id, file_path, upload_time) VALUES (?, ?, NOW())");
        $userId = 1; // 暫定固定用戶 ID，如未來要擴充登入可改
        $stmt->execute([$userId, $uuidName]);

        echo "✅ 上傳成功！<br>";
        echo "<a href='list_uploads.php'>查看所有檔案</a>";
    } else {
        echo "❌ 檔案儲存失敗";
    }
}
