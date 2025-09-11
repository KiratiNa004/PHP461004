<?php

require '../config.php';
// ตรวจสอบสิทธิ์admin
require 'auth_admin.php';
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>แผงควบคุมผู้ดูแลระบบ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f0f9ff, #ffffff);
            font-family: "Sarabun", sans-serif;
        }

        .dashboard-box {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        }

        h2 {
            font-weight: 700;
            color: #0d6efd;
            margin-bottom: 10px;
        }

        p {
            color: #444;
        }

        .btn {
            border-radius: 12px;
            font-weight: 600;
            padding: 14px;
            font-size: 1.05rem;
            transition: all 0.25s ease-in-out;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .logout-btn {
            border-radius: 12px;
            font-weight: 600;
        }
    </style>
</head>

<body class="container mt-5">
    <div class="dashboard-box">
        <h2>📊 ระบบผู้ดูแลระบบ</h2>
        <p class="mb-4">ยินดีต้อนรับ, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>

        <div class="row">
            <div class="col-md-6 col-lg-3 mb-3">
                <a href="products.php" class="btn btn-primary w-100">📦 จัดการสินค้า</a>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <a href="orders.php" class="btn btn-success w-100">🛒 จัดการคำสั่งซื้อ</a>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <a href="user.php" class="btn btn-warning w-100">👥 จัดการสมาชิก</a>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <a href="category.php" class="btn btn-dark w-100">📂 จัดการหมวดหมู่</a>
            </div>
        </div>

        <a href="../logout.php" class="btn btn-secondary mt-3 logout-btn">🚪 ออกจากระบบ</a>
    </div>
</body>

</html>