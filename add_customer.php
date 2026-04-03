<?php
require 'connect.php';

if (isset($_POST['submit'])) {
    if (!empty($_POST['FirstName']) && !empty($_POST['Phone'])) {
        
        // --- ส่วนจัดการรูปภาพ ---
        $imageName = "default.png"; // ค่าเริ่มต้น
        if (isset($_FILES['ProfileImage']) && $_FILES['ProfileImage']['error'] == 0) {
            $ext = pathinfo($_FILES['ProfileImage']['name'], PATHINFO_EXTENSION);
            $imageName = "cust_" . time() . "." . $ext; // ตั้งชื่อใหม่กันชื่อซ้ำ
            
            // สร้างโฟลเดอร์ชื่อ 'uploads' ไว้ในโปรเจกต์ด้วยนะครับ
            move_uploaded_file($_FILES['ProfileImage']['tmp_name'], "uploads/" . $imageName);
        }
        // -----------------------

        $sql = "INSERT INTO customer (FirstName, Phone, TotalPoints, ProfileImage) 
                VALUES (:FirstName, :Phone, 0, :ProfileImage)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':FirstName', $_POST['FirstName']);
        $stmt->bindParam(':Phone', $_POST['Phone']);
        $stmt->bindParam(':ProfileImage', $imageName);

        try {
            if ($stmt->execute()) {
                echo "<script>alert('เพิ่มสมาชิกเรียบร้อย'); window.location.href='index.php';</script>";
            }
        } catch (PDOException $e) { echo "Error: " . $e->getMessage(); }
    }
}
?>

<form action="add_customer.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">ชื่อ-นามสกุล</label>
        <input type="text" name="FirstName" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">เบอร์โทรศัพท์</label>
        <input type="text" name="Phone" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">รูปโปรไฟล์</label>
        <input type="file" name="ProfileImage" class="form-control" accept="image/*">
    </div>
    <button type="submit" name="submit" class="btn btn-primary w-100">ยืนยันลงทะเบียน</button>
</form> 
