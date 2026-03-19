<?php
// public/index.php 
// Nạp file autoload của Composer 
require_once __DIR__ . '/../vendor/autoload.php';
use Admin\Bai01QuanlySv\Controllers\SinhvienController;
// Simple Router 
$action = $_GET['action'] ?? 'index';
$controller = new SinhvienController();
switch ($action) {
    case 'add':
        $controller->add();
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
    case 'index':
    default:
        $controller->index();
        break;
}