<?php
require 'connect.php';

// ส่วนที่ 1: ดึงข้อมูลลูกค้าเพื่อมาแสดงชื่อในฟอร์ม
if (isset($_GET['CustomerID'])) {
    $id = $_GET['CustomerID'];
    $stmt_cust = $conn->prepare("SELECT * FROM customer WHERE CustomerID = :id");
    $stmt_cust->execute(['id' => $id]);
    $cust = $stmt_cust->fetch();
    
    if (!$cust) {
        die("ไม่พบข้อมูลลูกค้าในระบบ");
    }
} else {
    header("Location: index.php");
    exit();
}


// ส่วนที่ 2: ประมวลผลเมื่อกดปุ่มบันทึกแต้ม
if (isset($_POST['submit'])) {
    $amount = $_POST['amount'];
    $CustomerID = $_POST['CustomerID'];
    $earnedPoints = floor($amount / 20); // ทุก 20 บาทได้ 1 แต้ม

    $sql = "UPDATE customer SET TotalPoints = TotalPoints + :points WHERE CustomerID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':points', $earnedPoints);
    $stmt->bindParam(':id', $CustomerID);

    if ($stmt->execute()) {
        echo "<script>alert('สะสมแต้มสำเร็จ! ได้รับ $earnedPoints แต้ม'); window.location.href='index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Earn Points</title>
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 15px; border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h3 class="text-center mb-4">💰 สะสมแต้ม</h3>
                <div class="alert alert-info">
                    <strong>ลูกค้า:</strong> <?= $cust['FirstName'] ?> <br>
                    <strong>แต้มปัจจุบัน:</strong> <?= number_format($cust['TotalPoints']) ?> แต้ม
                </div>
                <form method="POST">
                    <input type="hidden" name="CustomerID" value="<?= $cust['CustomerID'] ?>">
                    <div class="mb-3">
                        <label class="form-label">ยอดซื้อสินค้า (บาท)</label>
                        <input type="number" name="amount" class="form-control" placeholder="เช่น 100" required min="1">
                        <small class="text-muted">* ทุกๆ 20 บาท จะได้รับ 1 แต้ม</small>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success w-100">บันทึกแต้ม</button>
                    <a href="index.php" class="btn btn-light w-100 mt-2">กลับหน้าหลัก</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>