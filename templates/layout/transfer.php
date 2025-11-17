<?php
// Các biến được truyền từ Functions::transfer():
// $basehref      - base URL (thường là $configBase)
// $showtext      - thông báo hiển thị cho người dùng
// $page_transfer - đường dẫn đích (ví dụ: "index.php" hoặc "gio-hang")
// $numb          - true/false: có tự động chuyển trang hay không

if (!isset($basehref)) {
    $basehref = '/';
}

$redirectUrl = $basehref . $page_transfer;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Thông báo</title>
    <?php if (!empty($numb)): ?>
        <meta http-equiv="refresh" content="2;url=<?= htmlspecialchars($redirectUrl, ENT_QUOTES, 'UTF-8') ?>">
    <?php endif; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .transfer-box {
            background: #ffffff;
            padding: 24px 28px;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
            max-width: 420px;
            text-align: center;
        }
        .transfer-box h1 {
            margin: 0 0 8px;
            font-size: 20px;
            color: #111827;
        }
        .transfer-box p {
            margin: 0 0 16px;
            font-size: 14px;
            color: #4b5563;
        }
        .transfer-box a {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 6px;
            background: #2563eb;
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="transfer-box">
    <h1>Thông báo</h1>
    <p><?= htmlspecialchars($showtext, ENT_QUOTES, 'UTF-8') ?></p>
    <a href="<?= htmlspecialchars($redirectUrl, ENT_QUOTES, 'UTF-8') ?>">Tiếp tục</a>
</div>
</body>
</html>


