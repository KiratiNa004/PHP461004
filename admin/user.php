<!DOCTYPE html>
<?php

require '../config.php'; // เชื่อมต่อฐานข้อมูล
require_once 'auth_admin.php';

// ลบสมาชิก
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];

    if ($user_id != $_SESSION['user_id']) {
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ? AND role = 'member'");
        $stmt->execute([$user_id]);
    }
    header("Location: user.php");
    exit;
}

// ดึงข้อมูลสมาชิก
$stmt = $conn->prepare("SELECT * FROM users WHERE role = 'member' ORDER BY created_at DESC");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>จัดการสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa, #f3e5f5);
            font-family: "Sarabun", sans-serif;
        }

        .header-box {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-weight: 700;
        }

        .btn {
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        table {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
        }

        thead {
            background: #6a11cb;
            color: #fff;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .alert {
            border-radius: 12px;
        }
    </style>
</head>

<body class="container py-4">

    <div class="header-box mb-4">
        <h2>📋 จัดการสมาชิก</h2>
        <p class="mb-0">ตรวจสอบและจัดการบัญชีสมาชิกทั้งหมด</p>
    </div>

    <a href="index.php" class="btn btn-secondary mb-3">← กลับหน้าผู้ดูแล</a>

    <?php if (count($users) === 0): ?>
        <div class="alert alert-warning text-center shadow-sm">
            🚫 ยังไม่มีสมาชิกในระบบ
        </div>
    <?php else: ?>
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th>ชื่อผู้ใช้</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>อีเมล</th>
                        <th>วันที่สมัคร</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['full_name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= $user['created_at'] ?></td>
                            <td>
                                <a href="edit_user.php?id=<?= $user['user_id'] ?>" class="btn btn-sm btn-info text-white">✏️
                                    แก้ไข</a>

                                <!-- <a href="user.php?delete=<?= $user['user_id'] ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('คุณต้องการลบสมาชิกนี้หรือไม่?')">🗑️ ลบ</a> -->

                                <form action="delUser_Sweet.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="u_id" value="<?php echo $user['user_id']; ?>">
                                    <button type="button" class="delete-button btn btn-danger btn-sm " data-user-id="<?php echo
                                        $user['user_id']; ?>">ลบ</button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <script>
        // ฟังกช์ นั ส ำหรับแสดงกลอ่ งยนื ยัน SweetAlert2
        function showDeleteConfirmation(userId) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: 'คุณจะไม่สำมำรถเรียกคืนข ้อมูลกลับได ้!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ลบ',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {
                    // หำกผใู้ชย้นื ยัน ใหส้ ง่ คำ่ ฟอรม์ ไปยัง delete.php เพื่อลบข ้อมูล
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'delUser_Sweet.php';
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'u_id';
                    input.value = userId;
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
        // แนบตัวตรวจจับเหตุกำรณ์คลิกกับองค์ปุ ่่มลบทั ่ ้งหมดที่มีคลำส delete-button
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const userId = button.getAttribute('data-user-id');
                showDeleteConfirmation(userId);
            });
        });
    </script>

</body>

</html>