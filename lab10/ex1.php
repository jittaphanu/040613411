<html>
<body>
<?php
//ถา้คุ้กกี้ visit เป็นค่าว่าง ให้สร้าง คุกกี้ visit เเละกำหนดค่าเริ่มต้นเป็น 0
if (empty($_COOKIE["visit"])) {
setcookie("visit", 0, time() + 3600 * 24);
}
// ตรวจสอบว่าคุกกี้ชอ

// ถ ้ายังไม่ก าหนด
if (!isset($_COOKIE["visit"])) {
echo "Welcome to my website! Click here for a tour";
// ถ ้าก าหนดค่าแล ้ว จะเพิ่มค่าขึ้น 1 ค่า
} else {
$visit = $_COOKIE["visit"] + 1;
setcookie("visit", $visit, time() + 3600 * 24);
echo "This is visit number $visit.";
}
?>
</body>
</html>