<?php
require 'connect.php';
if (isset($_GET['CustomerID'])) {
    $id = $_GET['CustomerID'];
    $sql = "DELETE FROM customer WHERE CustomerID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    try {
        if ($stmt->execute()) {
            echo "<script>alert('ลบข้อมูลสมาชิกเรียบร้อยแล้ว'); window.location.href='index.php';</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    
    header("Location: index.php");
}
$conn = null;
?>