<?php
$file = './vbe3.pdf';
// 检查文件是否存在
if (file_exists($file)) {
    // 设置Content-Type为PDF
    header('Content-Type: application/pdf');
    // 设置Content-Disposition为inline，这样PDF将在浏览器中直接显示而不是下载
    header('Content-Disposition: inline; filename="' . basename($file) . '"');
    // 设置Content-Length为文件大小
    header('Content-Length: ' . filesize($file));
    // 清理缓冲区，确保没有输出缓存干扰
    ob_clean();
    flush();
    // 读取文件并输出到浏览器
    readfile($file);
    exit;
} else {
    echo 'File does not exist.';
}
?>
