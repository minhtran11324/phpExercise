<?php
session_start();

// Định nghĩa đường dẫn gốc của dự án
define('PROJECT_ROOT', dirname(__DIR__));

// Nạp file autoload của Composer (chỉ 1 lần)
require_once PROJECT_ROOT . '/vendor/autoload.php';

// Sử dụng namespace tương thích với các controller trong src/Controllers
use Admin\Bai01QuanlySv\Controllers\SinhvienController;
use Admin\Bai01QuanlySv\Controllers\UserController;

// Simple Router
$action = $_GET['action'] ?? 'index';

// Danh sách các action không yêu cầu đăng nhập
$public_actions = [
    'login',
    'do_login',
    'register',
    'do_register'
];

// Nếu action không nằm trong danh sách public và người dùng chưa đăng nhập thì chuyển hướng về trang đăng nhập
if (!in_array($action, $public_actions, true) && !isset($_SESSION['user_id'])) {
    header('Location: index.php?action=login');
    exit();
}

// Khởi tạo controller dựa trên action
if (in_array($action, ['login', 'register', 'do_login', 'do_register', 'logout'], true)) {
    $controller = new UserController();
} else {
    $controller = new SinhvienController();
}

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'add':
        // $controller->add();
        $controller->$action();
        break;
    // THÊM 2 CASE MỚI (bài 03)
    case 'edit':
        $controller->edit();
        break;
    case 'update':
        $controller->update();
        break;
    // THÊM CASE MỚI
    case 'delete':
        $controller->delete();
        break;
    // Các action của UserController
    case 'login':
        $controller->showLoginForm();
        break;
    case 'do_login':
        $controller->login();
        break;
    case 'register':
        $controller->showRegisterForm();
        break;
    case 'do_register':
        $controller->register();
        break;
    case 'logout':
        $controller->logout();
        break;
    default:
        $controller = new SinhvienController();
        $controller->index();
        break;
}
