<?php 
// 1. ต้อง require ไฟล์เชื่อมต่อก่อนเสมอ
require 'connect.php'; 

// 2. ดึงข้อมูลจากฐานข้อมูลมาเก็บไว้ใน $result ก่อนที่จะเริ่มเขียน HTML
$sql = "SELECT * FROM customer"; 
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(); // ตัวแปร $result จะถูกกำหนดค่าที่นี่
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cafe Point System</title>
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 15px; border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .table thead { background-color: #0d6efd; color: white; }
        .point-badge { font-weight: bold; color: #0d6efd; font-size: 1.1rem; }
        .img-profile { width: 50px; height: 50px; object-fit: cover; border-radius: 50%; }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>☕ รายชื่อสมาชิกสะสมแต้ม</h3>
            <a href="add_customer.php" class="btn btn-primary">+ เพิ่มสมาชิกใหม่</a>
        </div>

        <table class="table table-hover table-bordered align-middle">
            <thead class="text-center">
                <tr>
                    <th>รูป</th>
                    <th>ชื่อลูกค้า</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>แต้มสะสม</th>
                    <th>จัดการ</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // ตรวจสอบว่ามีข้อมูลใน $result หรือไม่ก่อนวนลูป
                if (count($result) > 0) {
                    foreach ($result as $r) { ?>
                        <tr>
                            <td class="text-center">
                                <?php 
                                    $img = (!empty($r['ProfileImage'])) ? $r['ProfileImage'] : 'default.png'; 
                                ?>
                                <img src="uploads/<?= $img ?>" class="img-profile border">
                            </td>
                            <td><?= $r['FirstName'] ?></td>
                            <td class="text-center"><?= $r['Phone'] ?></td>
                            <td class="text-center">
                                <span class="point-badge"><?= number_format($r['TotalPoints']) ?> แต้ม</span>
                            </td>
                            <td class="text-center">
                                <a href="earn_point.php?CustomerID=<?= $r['CustomerID'] ?>" class="btn btn-success btn-sm px-3">สะสมแต้ม</a>
                            </td>
                            <td class="text-center">
                                <a href="delete_customer.php?CustomerID=<?= $r['CustomerID'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูลสมาชิก !!');">ลบ</a>
                            </td>
                        </tr>
                <?php } 
                } else { ?>
                    <tr>
                        <td colspan="6" class="text-center">ยังไม่มีข้อมูลสมาชิก</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
 

</body>
</html>