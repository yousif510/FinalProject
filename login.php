<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($username) || empty($password)) {
        echo "الرجاء إدخال اسم المستخدم وكلمة المرور<br><br>";
        echo "<a href='login.html'>عودة</a>";
    } else {
        $sql = "SELECT * FROM employees WHERE username='" . $conn->real_escape_string($username) . "' AND password='" . $conn->real_escape_string($password) . "'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $_SESSION['user'] = $username;
            echo "تسجيل الدخول نجح!<br><br>";
            echo "أهلا وسهلا، " . $username . "<br>";
            echo "<a href='index.html'>العودة</a>";
        } else {
            echo "الحساب غير موجود في قاعدة البيانات<br><br>";
            echo "<a href='login.html'>حاول مجددا</a>";
        }
    }
}

if ($conn) {
    $conn->close();
}
?>