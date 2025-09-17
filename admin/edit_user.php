<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            background: #f0f4fb;
            font-family: "Sarabun", sans-serif;
        }

        .container {
            max-width: 900px;
        }

        .page-header {
            background: linear-gradient(90deg, #0d6efd, #0b5ed7);
            color: white;
            padding: 20px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 64, 128, 0.2);
        }

        .page-header h2 {
            margin: 0;
            font-weight: bold;
            font-size: 1.6rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card {
            border-radius: 14px;
            border: none;
            background: #ffffff;
            box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.08);
            padding: 25px;
        }

        label {
            font-weight: 600;
            color: #0d47a1;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #cfd9e8;
        }

        .btn-primary {
            background: #0d6efd;
            border: none;
            border-radius: 8px;
            padding: 8px 18px;
        }

        .btn-primary:hover {
            background: #0b5ed7;
        }

        .btn-secondary {
            border-radius: 8px;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>

<body class="container mt-4">

    <!-- Header -->
    <div class="page-header">
        <h2><i class="bi bi-person-lines-fill"></i> แก้ไขข้อมูลสมาชิก</h2>
    </div>

    <!-- Card Content -->
    <div class="card">
        <a href="users.php" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> กลับหน้ารายชื่อสมาชิก
        </a>

        <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">ชื่อผู้ใช้</label>
                <input type="text" name="username" class="form-control" required
                    value="<?= htmlspecialchars($user['username']) ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">ชื่อ - นามสกุล</label>
                <input type="text" name="full_name" class="form-control"
                    value="<?= htmlspecialchars($user['full_name']) ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">อีเมล</label>
                <input type="email" name="email" class="form-control" required
                    value="<?= htmlspecialchars($user['email']) ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">รหัสผ่านใหม่ <small class="text-muted">(ถ้าไม่เปลี่ยนให้เว้นว่าง)</small></label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">ยืนยันรหัสผ่านใหม่</label>
                <input type="password" name="confirm_password" class="form-control">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="bi bi-save"></i> บันทึกการแก้ไข
                </button>
            </div>
        </form>
    </div>
</body>