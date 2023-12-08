<?php
require '../config/db.php';
if (!empty($_SESSION["user"])) {
    $user = $conne->prepare("SELECT * FROM User WHERE id = ?");
    $user->execute([$_SESSION["user"]]);
    $row = $user->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: ../");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="./assets/SF_white.png" alt="logo">
                </span>
                <div class="text header-text">
                    <span class="name">STOCKFULL</span>
                    <span class="profession">Wep Developer</span>

                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">
                    <i class='bx bx-search-alt-2 icon'></i>
                    <input type="text" class="search" placeholder="Search...">
                </li>
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="/stockfull/admin/">
                            <i class='bx bxs-home icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="product">
                            <i class='bx bxs-store icon'></i>
                            <span class="text nav-text">Product Stock</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="order">
                            <i class='bx bxs-paper-plane icon'></i>
                            <span class="text nav-text">Order</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="provider">
                            <i class='bx bxs-truck icon'></i>
                            <span class="text nav-text">Provider</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a>
                            <i class='bx bxs-user icon'></i>
                            <span class="text nav-text">User</span>
                            <i class='bx bx-chevron-right dropdown'></i>
                        </a>
                    </li>
                    <div class="sub-menu">
                        <a href="" class="text sub-item">Active</a>
                        <a href="" class="text sub-item">Inactive</a>
                        <a href="" class="text sub-item">Role</a>
                    </div>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bxs-group icon'></i>
                            <span class="text nav-text">Client</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a>
                            <i class='bx bx-history icon'></i>
                            <span class="text nav-text">Activity Log</span>
                            <i class='bx bx-chevron-right dropdown'></i>
                        </a>
                    </li>
                    <div class="sub-menu">
                        <a href="" class="text sub-item">Users</a>
                        <a href="" class="text sub-item">Products</a>
                        <a href="" class="text sub-item">Provider</a>
                    </div>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bxs-bell icon'></i>
                            <span class="text nav-text">Notifications</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../">
                            <i class='bx bxs-cart icon'></i>
                            <span class="text nav-text">Product View</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="bottom-content">

                <li class="mode">
                    <div class="moon-sun">
                        <i class='bx bxs-moon icon moon'></i>
                        <i class='bx bxs-sun icon sun '></i>
                    </div>
                    <span class="mode-text text"></span>
                    <div class="toggle-switch">
                        <span class="switch">

                        </span>
                    </div>
                </li>
                <li class="">
                    <a href="../config/logout.php">
                        <i class='bx bxs-log-out icon'></i>
                        <span class="text nav-text">Log out</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>