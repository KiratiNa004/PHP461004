<?php
    session_start(); // เริ่ม session
    require_once 'config.php'; // เชื่อมต่อฐานข้อมูล
    if (!isset($_GET['id'])) { // ตรวจสอบว่ามีการส่ง ID ของสินค้าเข้ามาหรือไม่
        header("Location: index.php");
        exit;
    }
    $product_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT p.*, c.category_name
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.category_id
        WHERE p.product_id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        echo "<h3>ไม่พบสินค้าที่คุณต้องการ</h3>";
        exit;
    }
    $isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>รายละเอียดสินค้า</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: linear-gradient(to right, #f0f9ff, #ffffff);
        font-family: "Sarabun", sans-serif;
    }
    .card {
        border-radius: 18px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.12);
        padding: 25px;
        border: none;
    }
    .card-title {
        font-weight: 700;
        color: #0d6efd;
        font-size: 1.8rem;
    }
    .card-text {
        font-size: 1rem;
        line-height: 1.6;
        color: #444;
    }
    .btn {
        border-radius: 25px;
        padding: 10px 22px;
        font-weight: 600;
        transition: all 0.25s ease;
    }
    .btn:hover {
        transform: scale(1.05);
    }
    .product-info p {
        font-size: 1.05rem;
        margin-bottom: 6px;
    }
    .back-btn {
        border-radius: 25px;
        padding: 8px 18px;
    }
    .alert {
        border-radius: 12px;
    }
</style>
</head>
<body class="container mt-4">

    <a href="index.php" class="btn btn-secondary mb-3 back-btn">← กลับหน้ารายการสินค้า</a>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title mb-3"><?= htmlspecialchars($product['product_name']) ?></h3>
            <h6 class="text-muted mb-3">📂 หมวดหมู่: <?= htmlspecialchars($product['category_name']) ?></h6>
            
            <p class="card-text mt-3"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            
            <div class="product-info mt-3">
                <p><strong>💰 ราคา:</strong> <?= number_format($product['price'], 2) ?> บาท</p>
                <p><strong>📦 คงเหลือ:</strong> <?= $product['stock'] ?> ชิ้น</p>
            </div>

            <?php if ($isLoggedIn): ?>
                <form action="cart.php" method="post" class="mt-4">
                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                    <label for="quantity" class="form-label">จำนวน:</label>
                    <div class="d-flex align-items-center">
                        <input type="number" name="quantity" id="quantity" 
                               class="form-control w-25 me-2"
                               value="1" min="1" max="<?= $product['stock'] ?>" required>
                        <button type="submit" class="btn btn-success">🛒 เพิ่มในตะกร้า</button>
                    </div>
                </form>
            <?php else: ?>
                <div class="alert alert-info mt-4 text-center">
                    🔑 กรุณาเข้าสู่ระบบเพื่อสั่งซื้อสินค้า
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
