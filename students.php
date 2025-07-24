<?php
header('Content-Type: application/json');
$dataFile = 'students.json';

function loadData($file) {
    return file_exists($file) ? json_decode(file_get_contents($file), true) : [];
}

function saveData($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$method = $_SERVER['REQUEST_METHOD'];
$students = loadData($dataFile);
parse_str(file_get_contents("php://input"), $body);
$id = $_GET['id'] ?? null;

switch ($method) {
    case 'GET':
        if ($id !== null) {
            $student = array_filter($students, fn($s) => $s['id'] == $id);
            echo json_encode(array_values($student));
        } else {
            echo json_encode($students);
        }
        break;

    case 'POST':
        $new = [
            'id' => count($students) + 1,
            'name' => $_POST['name'] ?? '未知',
            'score' => $_POST['score'] ?? 0
        ];
        $students[] = $new;
        saveData($dataFile, $students);
        echo json_encode(['msg' => '新增成功', 'data' => $new]);
        break;

    case 'PUT':
        foreach ($students as &$s) {
            if ($s['id'] == $id) {
                $s['name'] = $body['name'] ?? $s['name'];
                $s['score'] = $body['score'] ?? $s['score'];
            }
        }
        saveData($dataFile, $students);
        echo json_encode(['msg' => '更新成功']);
        break;

    case 'DELETE':
        $students = array_filter($students, fn($s) => $s['id'] != $id);
        saveData($dataFile, array_values($students));
        echo json_encode(['msg' => '刪除成功']);
        break;
}
?>
