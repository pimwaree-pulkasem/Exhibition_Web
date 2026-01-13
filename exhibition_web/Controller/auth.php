<?php
session_start();
require_once __DIR__ . '/../connect.php';

function register($name, $surname, $email, $password = 'user') {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO user (Name, Surname, Email, Password) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$name, $surname, $email, $password]);
}

function login($email, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM user WHERE Email = ? AND Password = ?");
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user'] = [
            'id' => $user['UserID'],
            'name' => $user['Name'],
            'surname' => $user['Surname'],
            'email' => $user['Email'],
        ];
        return true;
    }
    return false;
}

function logout() {
    session_unset();
    session_destroy();
    header("Location: ../homepage/homepage.php");
    exit();
}

function is_logged_in() {
    return isset($_SESSION['user']);
}

function is_admin() {
    return is_logged_in() && $_SESSION['user']['id'] === 1;
}

function require_login() {
    if (!is_logged_in()) {
        echo "<script>alert('Please log in or register before proceeding.'); window.location.href = 'signIn.php';</script>";
        exit();
    }
}

function require_admin() {
    if (!is_admin()) {
        echo "<script>alert('Admin access required.'); window.location.href = 'homepage.php';</script>";
        exit();
    }
}

//รับ Log out
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    logout();
}

// ตรวจสอบว่าผู้ใช้ต้องการลงทะเบียนหรือเข้าสู่ระบบ
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ลงทะเบียน
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // ตรวจสอบ input
        if (empty($name) || empty($surname) || empty($email) || empty($password)) {
            echo "<script>alert('Please fill in all information completely.'); window.history.back();</script>";
            exit();
        }

        // ตรวจสอบ Email ซ้ำ
        $stmt = $conn->prepare("SELECT * FROM user WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $check = $stmt->get_result();

        if ($check->num_rows > 0) {
            echo "<script>alert('This email address is already in use.'); window.history.back();</script>";
            exit();
        }

        if (register($name, $surname, $email, $password)) {
            echo "<script>alert('Registration successful! You can now log in.'); window.location.href = '../signInpage/signIn.php';</script>";
        } else {
            echo "<script>alert('Registration failed. Please try again.'); window.history.back();</script>";
        }
    }
    // เข้าสู่ระบบ
    elseif (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (login($email, $password)) {
            // ถ้าล็อกอินสำเร็จ
            if (is_admin()){
                header("Location: ../Admin_Dashboard/adminDashboard.php"); // ไปหน้า admin
            }
            else{
                header("Location: ../homepage/homepage.php"); // เปลี่ยนเป็นหน้า homepage
            }
            exit();
        } else {
            echo "<script>alert('Invalid email or password. Please try again.'); window.history.back();</script>";
        }
    }
}
?>