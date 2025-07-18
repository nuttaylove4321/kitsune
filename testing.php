<?php
$filename = "jsonPhp.json";
$text = "data";

// ตรวจสอบข้อมูลที่ส่งมาครบหรือไม่
if (empty($filename) || empty($text)) {
    echo json_encode(['status' => 'error', 'message' => 'Missing filename or text']);
    exit;
}

// ป้องกันการโจมตีด้วย path traversal เช่น ../ หรือ /
$filename = basename($filename);

// โฟลเดอร์เก็บไฟล์
$folder = "texts";
if (!is_dir($folder)) {
    mkdir($folder, 0755, true);
}

$filepath = $folder . "/" . $filename;

// ✅ เขียนทับข้อมูลลงไฟล์ (จะลบทิ้งแล้วเขียนใหม่โดยอัตโนมัติ)
if (file_put_contents($filepath, $text) === false) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to write file']);
    exit;
}

// สร้างลิงก์กลับ
$link = "https://yourdomain.com/$filepath";

echo json_encode([
    'status' => 'success',
    'message' => 'File saved successfully',
    'link' => $link
]);
?>
