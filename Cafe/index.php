<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop - Premium Coffee Experience</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #fef7e7 0%, #fed7aa 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: bold;
            color: #d97706;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #666;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #d97706;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .search-container {
            position: relative;
            margin-right: 1rem;
        }

        .search-container input {
            padding: 8px 35px 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 20px;
            width: 200px;
            font-size: 14px;
        }

        .search-container i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            pointer-events: none;
        }

        .cart-btn,
        .auth-btn {
            background: #d97706;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 500;
            position: relative;
            transition: background 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .cart-btn:hover,
        .auth-btn:hover {
            background: #b45309;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 4rem 0;
            background: linear-gradient(135deg, #fef7e7 0%, #fed7aa 100%);
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #1f2937;
        }

        .hero p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #d97706;
            color: white;
        }

        .btn-primary:hover {
            background: #b45309;
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            color: #d97706;
            border: 2px solid #d97706;
        }

        .btn-outline:hover {
            background: #d97706;
            color: white;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        /* Categories */
        .categories {
            padding: 4rem 0;
            background: white;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: #1f2937;
        }

        .category-filters {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 16px;
            border: 2px solid #d97706;
            background: transparent;
            color: #d97706;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: #d97706;
            color: white;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            border-radius: 8px;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-image i {
            font-size: 3rem;
            color: #d97706;
        }

        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ef4444;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }

        .featured-badge {
            background: #f59e0b;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #1f2937;
        }

        .product-description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .product-price {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .current-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #059669;
        }

        .original-price {
            font-size: 1rem;
            color: #666;
            text-decoration: line-through;
        }

        .category-tag {
            background: #f3f4f6;
            color: #666;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            margin-bottom: 1rem;
            display: inline-block;
        }

        .add-to-cart {
            width: 100%;
            background: #d97706;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
        }

        .add-to-cart:hover {
            background: #b45309;
        }

        /* Admin Sidebar */
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 280px;
            background: #1f2937;
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid #374151;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #f59e0b;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            display: block;
            padding: 12px 1.5rem;
            color: #d1d5db;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .nav-item:hover,
        .nav-item.active {
            background: #374151;
            color: white;
            border-left-color: #f59e0b;
        }

        .nav-item i {
            width: 20px;
            margin-right: 10px;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem 1.5rem;
            border-top: 1px solid #374151;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
        }

        .logout-btn {
            width: 100%;
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .admin-main {
            margin-left: 280px;
            flex: 1;
            background: #f9fafb;
            min-height: 100vh;
        }

        .admin-header {
            background: white;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-content {
            padding: 2rem;
        }

        /* Dashboard Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            border-left: 4px solid #d97706;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #d97706;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        /* Forms and Tables */
        .form-section {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-textarea {
            resize: vertical;
            min-height: 80px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .data-table th,
        .data-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .data-table th {
            background: #f9fafb;
            font-weight: 600;
            color: #374151;
        }

        .action-btn {
            padding: 4px 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            margin-right: 4px;
        }

        .edit-btn {
            background: #3b82f6;
            color: white;
        }

        .delete-btn {
            background: #ef4444;
            color: white;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-ordered {
            background: #fef3c7;
            color: #92400e;
        }

        .status-preparing {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-ready {
            background: #d1fae5;
            color: #065f46;
        }

        .status-completed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Loading */
        .loading {
            text-align: center;
            padding: 3rem;
        }

        .loading i {
            font-size: 2rem;
            color: #d97706;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
        }

        /* Cart Items */
        .cart-items {
            margin-bottom: 1.5rem;
        }

        .cart-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .cart-item-image {
            width: 60px;
            height: 60px;
            background: #f3f4f6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-title {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .cart-item-price {
            color: #666;
            font-size: 0.9rem;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .qty-btn {
            width: 30px;
            height: 30px;
            border: 1px solid #d1d5db;
            background: white;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-btn:hover {
            background: #f3f4f6;
        }

        .remove-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 4px 8px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        /* Login Form */
        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #fef7e7 0%, #fed7aa 100%);
        }

        .login-form {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h2 {
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #666;
            font-size: 0.9rem;
        }

        .login-tabs {
            display: flex;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .tab-btn {
            flex: 1;
            padding: 10px;
            border: none;
            background: none;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            font-weight: 500;
        }

        .tab-btn.active {
            color: #d97706;
            border-bottom-color: #d97706;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .admin-tab-content {
            display: none;
        }

        .admin-tab-content.active {
            display: block;
        }

        /* Toast Notifications */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #059669;
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 3000;
            transform: translateX(400px);
            transition: transform 0.3s;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.error {
            background: #ef4444;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #d1d5db;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .nav-links {
                display: none;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }

            /* Mobile Header Fixes */
            .header-content {
                flex-wrap: wrap;
                gap: 1rem;
            }

            .search-container {
                order: 3;
                width: 100%;
                margin-right: 0 !important;
            }

            .search-container input {
                width: 100% !important;
            }

            /* Mobile Stats Grid */
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            /* Mobile Tables */
            .data-table {
                font-size: 12px;
                overflow-x: auto;
                display: block;
                white-space: nowrap;
            }

            .data-table th,
            .data-table td {
                padding: 8px 4px;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 10px;
            }

            .logo {
                font-size: 1.2rem;
            }

            .cart-btn,
            .auth-btn {
                padding: 8px 12px;
                font-size: 14px;
            }

            .product-image {
                height: 180px;
            }

            .product-info {
                padding: 1rem;
            }

            .product-title {
                font-size: 1rem;
            }

            .product-description {
                font-size: 0.85rem;
            }

            .current-price {
                font-size: 1rem;
            }

            .original-price {
                font-size: 0.85rem;
            }

            .add-to-cart {
                padding: 8px;
                font-size: 0.9rem;
            }

            .hero p {
                font-size: 1rem;
                padding: 0 10px;
            }

            .search-container input {
                font-size: 12px;
                padding: 8px 30px 8px 10px;
            }

            .nav-links {
                display: none;
            }

            .product-card {
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            }

            .data-table {
                font-size: 11px;
            }

            .login-form {
                padding: 1.5rem;
            }

            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .cart-item-image {
                width: 100%;
                height: auto;
            }

            .toast {
                top: auto;
                bottom: 10px;
                right: 10px;
                left: 10px;
                transform: none !important;
                font-size: 14px;
            }
        }

        @media (max-width: 768px) {
            #about .container>div {
                grid-template-columns: 1fr !important;
                gap: 2rem !important;
            }

            #about .container>div>div:last-child {
                order: -1;
                /* Move the image above the text */
            }

            #about img {
                height: auto !important;
                max-height: 300px;
                width: 100% !important;
                object-fit: cover !important;
            }
        }
    </style>
</head>

<body>
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    if ($page === 'admin-login'): ?>
        <!-- Admin Login Page -->
        <div class="login-container">
            <form class="login-form" id="adminLoginForm">
                <div class="login-header">
                    <div class="logo">
                        <i class="fas fa-coffee"></i>
                        <span>Coffee Shop Admin</span>
                    </div>
                    <h2>Admin Login</h2>
                    <p>Enter your credentials to access the admin panel</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-input" name="username" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-input" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </button>

                <div style="margin-top: 1rem; text-align: center;">
                    <a href="index.php" style="color: #d97706; text-decoration: none;">← Back to Website</a>
                </div>

                <div style="margin-top: 1rem; text-align: center; font-size: 0.9rem; color: #666;">
                    <!-- <p>Default credentials:</p>
                    <p><strong>Username:</strong> admin</p>
                    <p><strong>Password:</strong> admin123</p> -->
                </div>
            </form>
        </div>

    <?php elseif ($page === 'admin' && isAdminLoggedIn()): ?>
        <!-- Enhanced Admin Panel with Sidebar -->
        <div class="admin-layout">
            <aside class="admin-sidebar">
                <div class="sidebar-header">
                    <div class="sidebar-logo">
                        <i class="fas fa-coffee"></i>
                        <span>Abdul Coffee Shop</span>
                    </div>
                </div>

                <nav class="sidebar-nav">
                    <a href="#" class="nav-item active" onclick="showAdminTab('dashboard')">
                        <i class="fas fa-chart-bar"></i>
                        Dashboard
                    </a>
                    <a href="#" class="nav-item" onclick="showAdminTab('categories')">
                        <i class="fas fa-list"></i>
                        Categories
                    </a>
                    <a href="#" class="nav-item" onclick="showAdminTab('products')">
                        <i class="fas fa-coffee"></i>
                        Products
                    </a>
                    <a href="#" class="nav-item" onclick="showAdminTab('orders')">
                        <i class="fas fa-shopping-cart"></i>
                        Orders
                    </a>
                    <a href="#" class="nav-item" onclick="showAdminTab('customers')">
                        <i class="fas fa-users"></i>
                        Customers
                    </a>
                </nav>

                <div class="sidebar-footer">
                    <div class="user-info">
                        <i class="fas fa-user-circle" style="font-size: 1.5rem;"></i>
                        <div>
                            <div style="font-weight: 500;"><?php echo $_SESSION['admin_name']; ?></div>
                            <div style="font-size: 0.8rem; color: #9ca3af;">Administrator</div>
                        </div>
                    </div>
                    <button class="logout-btn" onclick="logout()">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </div>
            </aside>

            <main class="admin-main">
                <header class="admin-header">
                    <h1 id="pageTitle">Dashboard</h1>
                    <div style="color: #666; font-size: 0.9rem;">
                        <i class="fas fa-calendar"></i>
                        <?php echo date('l, F j, Y'); ?>
                    </div>
                </header>

                <div class="admin-content">
                    <!-- Dashboard Tab -->
                    <div id="admin-dashboard" class="admin-tab-content active">
                        <div class="stats-grid" id="statsGrid">
                            <!-- Stats will be loaded here -->
                        </div>

                        <div class="form-section">
                            <h3>Recent Orders</h3>
                            <div id="recentOrders">
                                <!-- Recent orders will be loaded here -->
                            </div>
                        </div>
                    </div>

                    <!-- Categories Tab -->
                    <div id="admin-categories" class="admin-tab-content">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                            <h2>Manage Categories</h2>
                            <button class="btn btn-primary" onclick="showCategoryForm()">
                                <i class="fas fa-plus"></i>
                                Add Category
                            </button>
                        </div>

                        <div id="categoryForm" class="form-section" style="display: none;">
                            <h3 id="categoryFormTitle">Add New Category</h3>
                            <form id="categoryFormElement">
                                <input type="hidden" id="categoryId" name="id">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Category Title</label>
                                        <input type="text" class="form-input" id="categoryTitle" name="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Featured</label>
                                        <select class="form-select" id="categoryFeatured" name="featured">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" id="categoryActive" name="active">
                                        <option value="Yes">Active</option>
                                        <option value="No">Inactive</option>
                                    </select>
                                </div>
                                <div style="display: flex; gap: 1rem;">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i>
                                        Save Category
                                    </button>
                                    <button type="button" class="btn btn-secondary" onclick="hideCategoryForm()">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>

                        <table class="data-table" id="categoriesTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Featured</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Categories will be loaded here -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Products Tab -->
                    <div id="admin-products" class="admin-tab-content">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                            <h2>Manage Products</h2>
                            <button class="btn btn-primary" onclick="showProductForm()">
                                <i class="fas fa-plus"></i>
                                Add Product
                            </button>
                        </div>

                        <div id="productForm" class="form-section" style="display: none;">
                            <h3 id="productFormTitle">Add New Product</h3>
                            <form id="productFormElement" enctype="multipart/form-data">
                                <input type="hidden" id="productId" name="id">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Product Title</label>
                                        <input type="text" class="form-input" id="productTitle" name="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Category</label>
                                        <select class="form-select" id="productCategory" name="category_id" required>
                                            <option value="">Select Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-textarea" id="productDescription" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Product Image</label>
                                    <input type="file" class="form-input" id="productImage" name="product_image" accept="image/*">
                                    <div id="currentImage" style="margin-top: 10px;"></div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Price (IDR)</label>
                                        <input type="number" class="form-input" id="productPrice" name="price" step="0.01" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Discount (%)</label>
                                        <input type="number" class="form-input" id="productDiscount" name="discount" min="0" max="100" step="0.01" value="0">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Featured</label>
                                        <select class="form-select" id="productFeatured" name="featured">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" id="productActive" name="active">
                                            <option value="Yes">Active</option>
                                            <option value="No">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 1rem;">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i>
                                        Save Product
                                    </button>
                                    <button type="button" class="btn btn-secondary" onclick="hideProductForm()">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>

                        <table class="data-table" id="productsTable">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Featured</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Products will be loaded here -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Orders Tab -->
                    <div id="admin-orders" class="admin-tab-content">
                        <h2>Manage Orders</h2>
                        <table class="data-table" id="ordersTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Customer</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date & Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Orders will be loaded here -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Customers Tab -->
                    <div id="admin-customers" class="admin-tab-content">
                        <h2>Manage Customers</h2>
                        <table class="data-table" id="customersTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Registered</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Customers will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>

    <?php else: ?>
        <!-- Enhanced Customer Frontend -->
        <header>
            <div class="container">
                <div class="header-content">
                    <div class="logo">
                        <i class="fas fa-coffee"></i>
                        <span>Abdul Coffee Shop</span>
                    </div>
                    <nav>
                        <ul class="nav-links">
                            <li><a href="#menu" onclick="scrollToMenu()">Menu</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </nav>
                    <div class="header-actions">
                        <!-- SEARCH BAR -->
                        <div class="search-container">
                            <input type="text" id="searchInput" placeholder="Search products...">
                            <i class="fas fa-search"></i>
                        </div>

                        <?php if (isCustomerLoggedIn()): ?>
                            <span style="color: #666;">Welcome, <?php echo $_SESSION['customer_name']; ?></span>
                            <button class="auth-btn" onclick="logout()" style="background: #6b7280;">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </button>
                        <?php else: ?>
                            <button class="auth-btn" onclick="showAuthModal()" style="background: #6b7280;">
                                <i class="fas fa-user"></i>
                                Login
                            </button>
                        <?php endif; ?>
                        <button class="cart-btn" onclick="openCart()">
                            <i class="fas fa-shopping-cart"></i>
                            Cart
                            <span class="cart-count" id="cartCount">0</span>
                        </button>
                        <a href="?page=admin-login" class="auth-btn" style="font-size: 0.9rem;">
                            <i class="fas fa-cog"></i>
                            Admin
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <!-- Hero Section -->
            <section class="hero">
                <div class="container">
                    <h1>Premium Coffee Experience</h1>
                    <p>Discover the perfect blend of quality, taste, and atmosphere. From expertly crafted espresso to delicious pastries, we serve excellence in every cup.</p>
                    <div class="hero-buttons">
                        <button class="btn btn-primary" onclick="scrollToMenu()">
                            <i class="fas fa-coffee"></i>
                            Explore Menu
                        </button>
                        <button class="btn btn-outline" onclick="openLocationModal()">
                            <i class="fas fa-map-marker-alt"></i>
                            Find Location
                        </button>
                    </div>
                </div>
            </section>

            <!-- Categories & Products -->
            <section class="categories" id="menu">
                <div class="container">
                    <h2 class="section-title">Our Menu</h2>

                    <div class="category-filters" id="categoryFilters">
                        <button class="filter-btn active" data-category="" onclick="filterProducts('')">
                            Featured
                        </button>
                        <!-- Category filters will be loaded here -->
                    </div>

                    <div id="productsContainer">
                        <div class="loading">
                            <i class="fas fa-spinner"></i>
                            <p>Loading products...</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- About Section -->
            <section id="about" style="padding: 4rem 0; background: white;">
                <div class="container">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center;">
                        <div>
                            <h2 class="section-title" style="text-align: left; margin-bottom: 1.5rem;">About Our Coffee Shop</h2>
                            <p style="color: #666; margin-bottom: 1.5rem;">Since 2024, we've been passionate about serving the finest coffee experience. Our expert baristas craft each cup with precision, using premium beans sourced from the best coffee regions around the world.</p>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div style="text-align: center; padding: 1.5rem; background: #fef7e7; border-radius: 10px;">
                                    <i class="fas fa-coffee" style="font-size: 2rem; color: #d97706; margin-bottom: 0.5rem;"></i>
                                    <h4 style="margin-bottom: 0.5rem;">Premium Quality</h4>
                                    <p style="font-size: 0.9rem; color: #666;">Finest coffee beans</p>
                                </div>
                                <div style="text-align: center; padding: 1.5rem; background: #fef7e7; border-radius: 10px;">
                                    <i class="fas fa-clock" style="font-size: 2rem; color: #d97706; margin-bottom: 0.5rem;"></i>
                                    <h4 style="margin-bottom: 0.5rem;">Fresh Daily</h4>
                                    <p style="font-size: 0.9rem; color: #666;">Roasted every morning</p>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: center;">
                            <div style="width: 100%; height: 300px; border-radius: 15px; overflow: hidden;">
                                <img src="images/semarang.jpg" alt="About Our Coffee Shop" style="width: 100%; height: 100%; object-fit: cover; border-radius: 15px;">
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <!-- Contact Section -->
            <section id="contact" style="padding: 4rem 0; background: #f9fafb;">
                <div class="container">
                    <h2 class="section-title">Visit Us Today</h2>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                        <div class="product-card" style="text-align: center;">
                            <div style="padding: 2rem;">
                                <i class="fas fa-map-marker-alt" style="font-size: 3rem; color: #d97706; margin-bottom: 1rem;"></i>
                                <h4 style="margin-bottom: 1rem;">Location</h4>
                                <p style="color: #666;">123 Coffee Street<br>Semarang, Indonesia</p>
                            </div>
                        </div>
                        <div class="product-card" style="text-align: center;">
                            <div style="padding: 2rem;">
                                <i class="fas fa-clock" style="font-size: 3rem; color: #d97706; margin-bottom: 1rem;"></i>
                                <h4 style="margin-bottom: 1rem;">Hours</h4>
                                <p style="color: #666;">Mon - Fri: 7:00 AM - 9:00 PM<br>Sat - Sun: 8:00 AM - 10:00 PM</p>
                            </div>
                        </div>
                        <div class="product-card" style="text-align: center;">
                            <div style="padding: 2rem;">
                                <i class="fas fa-phone" style="font-size: 3rem; color: #d97706; margin-bottom: 1rem;"></i>
                                <h4 style="margin-bottom: 1rem;">Contact</h4>
                                <p style="color: #666;">+62 123 456 7890<br>info@coffeeshop.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer style="background: #1f2937; color: white; padding: 2rem 0; text-align: center;">
            <div class="container">
                <div class="logo" style="justify-content: center; margin-bottom: 1rem; color: #f59e0b;">
                    <i class="fas fa-coffee"></i>
                    <span>Coffee Shop</span>
                </div>
                <p style="color: #9ca3af;">© 2024 Coffee Shop. All rights reserved. Made with ❤️ and ☕</p>
            </div>
        </footer>
    <?php endif; ?>

    <!-- Auth Modal -->
    <div class="modal" id="authModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Account</h3>
                <button class="close-btn" onclick="closeAuthModal()">&times;</button>
            </div>

            <div class="login-tabs">
                <button class="tab-btn active" onclick="showAuthTab('login')">Login</button>
                <button class="tab-btn" onclick="showAuthTab('register')">Register</button>
            </div>

            <div id="loginTab" class="tab-content active">
                <form id="customerLoginForm">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-input" name="email" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-input" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </button>
                </form>
            </div>

            <div id="registerTab" class="tab-content">
                <form id="customerRegisterForm">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-input" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-input" name="email" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="tel" class="form-input" name="phone">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-input" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <i class="fas fa-user-plus"></i>
                        Register
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Cart Modal -->
    <div class="modal" id="cartModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="fas fa-shopping-cart"></i>
                    Shopping Cart (<span id="cartItemCount">0</span> items)
                </h3>
                <button class="close-btn" onclick="closeCart()">&times;</button>
            </div>

            <div id="cartItems" class="cart-items">
                <!-- Cart items will be loaded here -->
            </div>

            <div id="cartFooter" style="border-top: 1px solid #e5e7eb; padding-top: 1rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <strong>Total: <span id="cartTotal">Rp 0</span></strong>
                </div>
                <button class="btn btn-primary" style="width: 100%;" onclick="proceedToCheckout()">
                    <i class="fas fa-credit-card"></i>
                    Proceed to Checkout
                </button>
            </div>
        </div>
    </div>

    <!-- Order Modal -->
    <div class="modal" id="orderModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Place Your Order</h3>
                <button class="close-btn" onclick="closeOrderModal()">&times;</button>
            </div>

            <form id="orderForm">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <input type="text" class="form-input" name="customer_name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number *</label>
                        <input type="tel" class="form-input" name="customer_contact" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" name="customer_email">
                </div>

                <!-- <div class="form-group">
                    <label class="form-label">Address</label>
                    <textarea class="form-textarea" name="customer_address"></textarea>
                </div> -->

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Table Number (if dining in)</label>
                        <input type="text" class="form-input" name="table_number">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Payment Method</label>
                        <select class="form-select" name="payment_method">
                            <option value="Cash">Cash</option>
                            <option value="Card">Card</option>
                            <option value="Digital Wallet">QRIS</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Special Notes</label>
                    <textarea class="form-textarea" name="notes" placeholder="Any special requests..."></textarea>
                </div>

                <div style="border-top: 1px solid #e5e7eb; padding-top: 1rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                        <strong>Total: <span id="orderTotal">Rp 0</span></strong>
                        <span id="orderItemCount">0 items</span>
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <button type="button" class="btn btn-outline" style="flex: 1;" onclick="closeOrderModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="flex: 1;">
                            <i class="fas fa-check"></i>
                            Place Order
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Location Modal -->
    <div class="modal" id="locationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="fas fa-map-marker-alt"></i>
                    Our Locations
                </h3>
                <button class="close-btn" onclick="closeLocationModal()">&times;</button>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <div style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 1rem; margin-bottom: 1rem;">
                    <h4 style="margin-bottom: 0.5rem;">Main Branch</h4>
                    <p style="margin-bottom: 0.5rem;"><i class="fas fa-map-marker-alt" style="color: #d97706; margin-right: 0.5rem;"></i>123 Coffee Street, Semarang, Indonesia</p>
                    <p style="margin-bottom: 0.5rem;"><i class="fas fa-clock" style="color: #d97706; margin-right: 0.5rem;"></i>Mon-Fri: 7:00 AM - 9:00 PM, Sat-Sun: 8:00 AM - 10:00 PM</p>
                    <p><i class="fas fa-phone" style="color: #d97706; margin-right: 0.5rem;"></i>+62 123 456 7890</p>
                </div>

                <div style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 1rem; margin-bottom: 1rem;">
                    <h4 style="margin-bottom: 0.5rem;">Mall Branch</h4>
                    <p style="margin-bottom: 0.5rem;"><i class="fas fa-map-marker-alt" style="color: #d97706; margin-right: 0.5rem;"></i>Grand Mall, Level 2, Semarang, Indonesia</p>
                    <p style="margin-bottom: 0.5rem;"><i class="fas fa-clock" style="color: #d97706; margin-right: 0.5rem;"></i>Daily: 10:00 AM - 10:00 PM</p>
                    <p><i class="fas fa-phone" style="color: #d97706; margin-right: 0.5rem;"></i>+62 123 456 7891</p>
                </div>

                <div style="background: #fef7e7; border-radius: 8px; padding: 1rem;">
                    <h4 style="color: #d97706; margin-bottom: 0.5rem;">Coming Soon!</h4>
                    <p style="color: #92400e; font-size: 0.9rem;">We're opening a new branch in Bandung this month. Stay tuned for updates!</p>
                </div>
            </div>

            <button class="btn btn-primary" style="width: 100%;" onclick="closeLocationModal()">
                Got it!
            </button>
        </div>
    </div>

    <script>
        // Global variables
        let cart = JSON.parse(localStorage.getItem('coffeeShopCart')) || [];
        let categories = [];
        let products = [];
        let currentEditingCategory = null;
        let currentEditingProduct = null;

        // Debug function
        function debugLog(message, data = null) {
            console.log('[Coffee Shop Debug]', message, data);
        }

        // Enhanced makeRequest function with better error handling
        function makeRequest(action, data = {}) {
            debugLog('Making request:', {
                action,
                data
            });

            return fetch('backend.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        action: action,
                        ...data
                    })
                })
                .then(response => {
                    debugLog('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.text();
                })
                .then(text => {
                    debugLog('Response text:', text);
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        console.error('JSON parse error:', e);
                        console.error('Response text:', text);
                        throw new Error('Invalid JSON response');
                    }
                })
                .catch(error => {
                    console.error('Request error:', error);
                    showToast('Connection error: ' + error.message, 'error');
                    throw error;
                });
        }

        // Enhanced loadCategories function
        function loadCategories() {
            debugLog('Loading categories...');
            makeRequest('get_categories', {
                    active: 'Yes'
                })
                .then(data => {
                    debugLog('Categories loaded:', data);
                    categories = data;
                    renderCategoryFilters();
                })
                .catch(error => {
                    console.error('Error loading categories:', error);
                    showToast('Failed to load categories', 'error');
                });
        }

        // Enhanced loadProducts function
        function loadProducts(categoryId = '') {
            debugLog('Loading products...', {
                categoryId
            });
            const params = {
                active: 'Yes'
            };
            if (categoryId) {
                params.category_id = categoryId;
            } else {
                params.featured = 'Yes';
            }

            makeRequest('get_products', params)
                .then(data => {
                    debugLog('Products loaded:', data);
                    products = data;
                    renderProducts();
                })
                .catch(error => {
                    console.error('Error loading products:', error);
                    document.getElementById('productsContainer').innerHTML = `
                        <div class="empty-state">
                            <i class="fas fa-exclamation-triangle" style="color: #ef4444;"></i>
                            <h3>Failed to load products</h3>
                            <p>Please check your database connection and try again.</p>
                            <button class="btn btn-primary" onclick="loadProducts('${categoryId}')">
                                <i class="fas fa-refresh"></i>
                                Retry
                            </button>
                        </div>
                    `;
                });
        }

        // Add search functionality
        function initializeSearch() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    searchProducts(searchTerm);
                });
            }
        }

        function searchProducts(searchTerm) {
            if (searchTerm === '') {
                renderProducts(products); // Show all products if search is empty
                return;
            }

            const filteredProducts = products.filter(product =>
                product.title.toLowerCase().includes(searchTerm) ||
                (product.description && product.description.toLowerCase().includes(searchTerm)) ||
                (product.category_name && product.category_name.toLowerCase().includes(searchTerm))
            );

            renderProducts(filteredProducts);
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateCartUI();
            initializeSearch(); // ADD THIS LINE

            <?php if ($page === 'home'): ?>
                loadCategories();
                loadProducts();
            <?php elseif ($page === 'admin' && isAdminLoggedIn()): ?>
                loadDashboardStats();
                loadAdminCategories();
                loadAdminProducts();
                loadOrders();
                loadCustomers();
            <?php endif; ?>
        });

        // Utility functions
        function formatPrice(price) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(price);
        }

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast ${type === 'error' ? 'error' : ''}`;
            toast.textContent = message;
            document.body.appendChild(toast);

            setTimeout(() => toast.classList.add('show'), 100);
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => document.body.removeChild(toast), 300);
            }, 3000);
        }

        // Auth functions
        function showAuthModal() {
            document.getElementById('authModal').classList.add('active');
        }

        function closeAuthModal() {
            document.getElementById('authModal').classList.remove('active');
        }

        function showAuthTab(tab) {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            event.target.classList.add('active');
            document.getElementById(tab + 'Tab').classList.add('active');
        }

        // Customer functions
        function renderCategoryFilters() {
            const container = document.getElementById('categoryFilters');
            let html = '<button class="filter-btn active" data-category="" onclick="filterProducts(\'\')">Featured</button>';

            categories.forEach(category => {
                html += `<button class="filter-btn" data-category="${category.id}" onclick="filterProducts('${category.id}')">${category.title}</button>`;
            });

            container.innerHTML = html;
        }

        function renderProducts(productsToRender = products) {
            const container = document.getElementById('productsContainer');

            if (productsToRender.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-search"></i>
                        <h3>No products found</h3>
                        <p>Try searching with different keywords</p>
                    </div>
                `;
                return;
            }

            let html = '<div class="products-grid">';
            productsToRender.forEach(product => {
                const hasDiscount = product.discount > 0;
                const imageUrl = product.image_name ? `uploads/${product.image_name}` : null;

                html += `
                    <div class="product-card">
                        <div class="product-image">
                            ${imageUrl ? `<img src="${imageUrl}" alt="${product.title}">` : '<i class="fas fa-coffee"></i>'}
                            ${hasDiscount ? `<div class="product-badge">${product.discount}% OFF</div>` : ''}
                            ${product.featured === 'Yes' ? '<div class="product-badge featured-badge">Featured</div>' : ''}
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">${product.title}</h3>
                            <p class="product-description">${product.description || ''}</p>
                            <div class="product-price">
                                <span class="current-price">${formatPrice(product.discounted_price)}</span>
                                ${hasDiscount ? `<span class="original-price">${formatPrice(product.price)}</span>` : ''}
                            </div>
                            <div class="category-tag">${product.category_name || 'Uncategorized'}</div>
                            <button class="add-to-cart" onclick="addToCart(${product.id})">
                                <i class="fas fa-cart-plus"></i>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                `;
            });
            html += '</div>';

            container.innerHTML = html;
        }

        function filterProducts(categoryId) {
            // Update active filter button
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Show loading
            document.getElementById('productsContainer').innerHTML = `
                <div class="loading">
                    <i class="fas fa-spinner"></i>
                    <p>Loading products...</p>
                </div>
            `;

            // Load products
            loadProducts(categoryId);
        }

        function addToCart(productId) {
            const product = products.find(p => p.id == productId);
            if (!product) return;

            const existingItem = cart.find(item => item.id == productId);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: product.id,
                    title: product.title,
                    price: product.discounted_price,
                    quantity: 1
                });
            }

            localStorage.setItem('coffeeShopCart', JSON.stringify(cart));
            updateCartUI();
            showToast(`${product.title} added to cart`);
        }

        function updateCartUI() {
            const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0);
            document.getElementById('cartCount').textContent = cartCount;
        }

        function openCart() {
            renderCartItems();
            document.getElementById('cartModal').classList.add('active');
        }

        function closeCart() {
            document.getElementById('cartModal').classList.remove('active');
        }

        function renderCartItems() {
            const container = document.getElementById('cartItems');
            const itemCount = document.getElementById('cartItemCount');
            const total = document.getElementById('cartTotal');

            if (cart.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-shopping-cart"></i>
                        <h3>Your cart is empty</h3>
                        <p>Add some delicious items to get started</p>
                    </div>
                `;
                document.getElementById('cartFooter').style.display = 'none';
                return;
            }

            document.getElementById('cartFooter').style.display = 'block';

            let html = '';
            let totalPrice = 0;
            let totalItems = 0;

            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                totalPrice += itemTotal;
                totalItems += item.quantity;

                html += `
                    <div class="cart-item">
                        <div class="cart-item-image">
                            <i class="fas fa-coffee"></i>
                        </div>
                        <div class="cart-item-info">
                            <div class="cart-item-title">${item.title}</div>
                            <div class="cart-item-price">${formatPrice(item.price)}</div>
                        </div>
                        <div class="quantity-controls">
                            <button class="qty-btn" onclick="updateQuantity(${item.id}, ${item.quantity - 1})">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span>${item.quantity}</span>
                            <button class="qty-btn" onclick="updateQuantity(${item.id}, ${item.quantity + 1})">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button class="remove-btn" onclick="removeFromCart(${item.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
            itemCount.textContent = totalItems;
            total.textContent = formatPrice(totalPrice);
        }

        function updateQuantity(productId, newQuantity) {
            if (newQuantity <= 0) {
                removeFromCart(productId);
                return;
            }

            const item = cart.find(item => item.id == productId);
            if (item) {
                item.quantity = newQuantity;
                localStorage.setItem('coffeeShopCart', JSON.stringify(cart));
                updateCartUI();
                renderCartItems();
            }
        }

        function removeFromCart(productId) {
            cart = cart.filter(item => item.id != productId);
            localStorage.setItem('coffeeShopCart', JSON.stringify(cart));
            updateCartUI();
            renderCartItems();
        }

        function proceedToCheckout() {
            if (cart.length === 0) {
                showToast('Your cart is empty', 'error');
                return;
            }

            closeCart();

            const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

            document.getElementById('orderTotal').textContent = formatPrice(totalPrice);
            document.getElementById('orderItemCount').textContent = `${totalItems} items`;
            document.getElementById('orderModal').classList.add('active');
        }

        function closeOrderModal() {
            document.getElementById('orderModal').classList.remove('active');
        }

        function scrollToMenu() {
            document.getElementById('menu').scrollIntoView({
                behavior: 'smooth'
            });
        }

        function openLocationModal() {
            document.getElementById('locationModal').classList.add('active');
        }

        function closeLocationModal() {
            document.getElementById('locationModal').classList.remove('active');
        }

        // Admin functions
        function showAdminTab(tabName) {
            // Update nav items
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });
            event.target.classList.add('active');

            // Update tab content
            document.querySelectorAll('.admin-tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById('admin-' + tabName).classList.add('active');

            // Update page title
            const titles = {
                'dashboard': 'Dashboard',
                'categories': 'Categories',
                'products': 'Products',
                'orders': 'Orders',
                'customers': 'Customers'
            };
            document.getElementById('pageTitle').textContent = titles[tabName];

            // Load data for specific tabs
            if (tabName === 'dashboard') {
                loadDashboardStats();
            } else if (tabName === 'categories') {
                loadAdminCategories();
            } else if (tabName === 'products') {
                loadAdminProducts();
                loadCategoriesForSelect();
            } else if (tabName === 'orders') {
                loadOrders();
            } else if (tabName === 'customers') {
                loadCustomers();
            }
        }

        function loadDashboardStats() {
            makeRequest('get_dashboard_stats')
                .then(data => {
                    document.getElementById('statsGrid').innerHTML = `
                        <div class="stat-card">
                            <div class="stat-number">${data.categories}</div>
                            <div class="stat-label">Categories</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">${data.products}</div>
                            <div class="stat-label">Products</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">${data.orders}</div>
                            <div class="stat-label">Total Orders</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">${data.today_orders}</div>
                            <div class="stat-label">Today's Orders</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">${data.customers}</div>
                            <div class="stat-label">Customers</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">${formatPrice(data.revenue)}</div>
                            <div class="stat-label">Total Revenue</div>
                        </div>
                    `;

                    // Load recent orders
                    loadRecentOrders();
                })
                .catch(error => console.error('Error loading stats:', error));
        }

        function loadRecentOrders() {
            makeRequest('get_recent_orders')
                .then(data => {
                    let html = '<table class="data-table"><thead><tr><th>Order ID</th><th>Product</th><th>Customer</th><th>Total</th><th>Status</th><th>Date</th></tr></thead><tbody>';

                    if (data.length === 0) {
                        html += '<tr><td colspan="6" style="text-align: center; color: #666;">No recent orders</td></tr>';
                    } else {
                        data.forEach(order => {
                            const statusClass = {
                                'Ordered': 'status-ordered',
                                'Preparing': 'status-preparing',
                                'Ready': 'status-ready',
                                'Completed': 'status-completed',
                                'Cancelled': 'status-cancelled'
                            } [order.status] || 'status-ordered';

                            html += `
                                <tr>
                                    <td>#${order.id}</td>
                                    <td>${order.product_name || 'N/A'}</td>
                                    <td>${order.customer_name}</td>
                                    <td>${formatPrice(order.total)}</td>
                                    <td><span class="status-badge ${statusClass}">${order.status}</span></td>
                                    <td>${new Date(order.order_date).toLocaleDateString()}</td>
                                </tr>
                            `;
                        });
                    }

                    html += '</tbody></table>';
                    document.getElementById('recentOrders').innerHTML = html;
                })
                .catch(error => console.error('Error loading recent orders:', error));
        }

        function loadAdminCategories() {
            makeRequest('get_categories', {})
                .then(data => {
                    const tbody = document.querySelector('#categoriesTable tbody');
                    let html = '';

                    data.forEach(category => {
                        html += `
                            <tr>
                                <td>${category.id}</td>
                                <td>${category.title}</td>
                                <td><span class="status-badge ${category.featured === 'Yes' ? 'status-completed' : 'status-ordered'}">${category.featured}</span></td>
                                <td><span class="status-badge ${category.active === 'Yes' ? 'status-completed' : 'status-cancelled'}">${category.active}</span></td>
                                <td>
                                    <button class="action-btn edit-btn" onclick="editCategory(${category.id})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete-btn" onclick="deleteCategory(${category.id})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    });

                    tbody.innerHTML = html;
                })
                .catch(error => console.error('Error loading categories:', error));
        }

        function loadAdminProducts() {
            makeRequest('get_products', {})
                .then(data => {
                    const tbody = document.querySelector('#productsTable tbody');
                    let html = '';

                    data.forEach(product => {
                        const imageUrl = product.image_name ? `uploads/${product.image_name}` : null;
                        html += `
                            <tr>
                                <td>
                                    <div style="width: 50px; height: 50px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                        ${imageUrl ? `<img src="${imageUrl}" alt="${product.title}" style="width: 100%; height: 100%; object-fit: cover;">` : '<i class="fas fa-coffee"></i>'}
                                    </div>
                                </td>
                                <td>${product.title}</td>
                                <td>${product.category_name || 'N/A'}</td>
                                <td>${formatPrice(product.discounted_price)}</td>
                                <td>${product.discount}%</td>
                                <td><span class="status-badge ${product.featured === 'Yes' ? 'status-completed' : 'status-ordered'}">${product.featured}</span></td>
                                <td><span class="status-badge ${product.active === 'Yes' ? 'status-completed' : 'status-cancelled'}">${product.active}</span></td>
                                <td>
                                    <button class="action-btn edit-btn" onclick="editProduct(${product.id})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete-btn" onclick="deleteProduct(${product.id})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    });

                    tbody.innerHTML = html;
                })
                .catch(error => console.error('Error loading products:', error));
        }

        function loadOrders() {
            makeRequest('get_orders')
                .then(data => {
                    const tbody = document.querySelector('#ordersTable tbody');
                    let html = '';

                    data.forEach(order => {
                        const statusClass = {
                            'Ordered': 'status-ordered',
                            'Preparing': 'status-preparing',
                            'Ready': 'status-ready',
                            'Completed': 'status-completed',
                            'Cancelled': 'status-cancelled'
                        } [order.status] || 'status-ordered';

                        html += `
                            <tr>
                                <td>${order.id}</td>
                                <td>${order.product_name || 'N/A'}</td>
                                <td>${order.customer_name}</td>
                                <td>${order.qty}</td>
                                <td>${formatPrice(order.total)}</td>
                                <td>
                                    <select onchange="updateOrderStatus(${order.id}, this.value)" class="form-select" style="padding: 4px; font-size: 12px;">
                                        <option value="Ordered" ${order.status === 'Ordered' ? 'selected' : ''}>Ordered</option>
                                        <option value="Preparing" ${order.status === 'Preparing' ? 'selected' : ''}>Preparing</option>
                                        <option value="Ready" ${order.status === 'Ready' ? 'selected' : ''}>Ready</option>
                                        <option value="Completed" ${order.status === 'Completed' ? 'selected' : ''}>Completed</option>
                                        <option value="Cancelled" ${order.status === 'Cancelled' ? 'selected' : ''}>Cancelled</option>
                                    </select>
                                </td>
                                <td>${new Date(order.order_date).toLocaleString()}</td>
                                <td>
                                    <button class="action-btn delete-btn" onclick="deleteOrder(${order.id})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    });

                    tbody.innerHTML = html;
                })
                .catch(error => console.error('Error loading orders:', error));
        }

        function loadCustomers() {
            makeRequest('get_customers')
                .then(data => {
                    const tbody = document.querySelector('#customersTable tbody');
                    let html = '';

                    data.forEach(customer => {
                        html += `
                            <tr>
                                <td>${customer.id}</td>
                                <td>${customer.full_name}</td>
                                <td>${customer.email}</td>
                                <td>${customer.phone || 'N/A'}</td>
                                <td><span class="status-badge ${customer.status === 'Active' ? 'status-completed' : 'status-cancelled'}">${customer.status}</span></td>
                                <td>${new Date(customer.created_at).toLocaleDateString()}</td>
                            </tr>
                        `;
                    });

                    tbody.innerHTML = html;
                })
                .catch(error => console.error('Error loading customers:', error));
        }

        function loadCategoriesForSelect() {
            makeRequest('get_categories', {
                    active: 'Yes'
                })
                .then(data => {
                    const select = document.getElementById('productCategory');
                    let html = '<option value="">Select Category</option>';

                    data.forEach(category => {
                        html += `<option value="${category.id}">${category.title}</option>`;
                    });

                    select.innerHTML = html;
                })
                .catch(error => console.error('Error loading categories:', error));
        }

        // Category management
        function showCategoryForm() {
            document.getElementById('categoryForm').style.display = 'block';
            document.getElementById('categoryFormTitle').textContent = 'Add New Category';
            document.getElementById('categoryFormElement').reset();
            document.getElementById('categoryId').value = '';
            currentEditingCategory = null;
        }

        function hideCategoryForm() {
            document.getElementById('categoryForm').style.display = 'none';
            currentEditingCategory = null;
        }

        function editCategory(id) {
            makeRequest('get_categories', {})
                .then(data => {
                    const category = data.find(c => c.id == id);
                    if (category) {
                        document.getElementById('categoryForm').style.display = 'block';
                        document.getElementById('categoryFormTitle').textContent = 'Edit Category';
                        document.getElementById('categoryId').value = category.id;
                        document.getElementById('categoryTitle').value = category.title;
                        document.getElementById('categoryFeatured').value = category.featured;
                        document.getElementById('categoryActive').value = category.active;
                        currentEditingCategory = category;
                    }
                });
        }

        function deleteCategory(id) {
            if (confirm('Are you sure you want to delete this category?')) {
                makeRequest('delete_category', {
                        id: id
                    })
                    .then(data => {
                        if (data.success) {
                            showToast(data.message);
                            loadAdminCategories();
                        } else {
                            showToast(data.message, 'error');
                        }
                    });
            }
        }

        // Product management
        function showProductForm() {
            document.getElementById('productForm').style.display = 'block';
            document.getElementById('productFormTitle').textContent = 'Add New Product';
            document.getElementById('productFormElement').reset();
            document.getElementById('productId').value = '';
            document.getElementById('currentImage').innerHTML = '';
            currentEditingProduct = null;
            loadCategoriesForSelect();
        }

        function hideProductForm() {
            document.getElementById('productForm').style.display = 'none';
            currentEditingProduct = null;
        }

        function editProduct(id) {
            makeRequest('get_products', {})
                .then(data => {
                    const product = data.find(p => p.id == id);
                    if (product) {
                        document.getElementById('productForm').style.display = 'block';
                        document.getElementById('productFormTitle').textContent = 'Edit Product';
                        document.getElementById('productId').value = product.id;
                        document.getElementById('productTitle').value = product.title;
                        document.getElementById('productDescription').value = product.description;
                        document.getElementById('productPrice').value = product.price;
                        document.getElementById('productDiscount').value = product.discount;
                        document.getElementById('productCategory').value = product.category_id;
                        document.getElementById('productFeatured').value = product.featured;
                        document.getElementById('productActive').value = product.active;

                        // Show current image
                        if (product.image_name) {
                            document.getElementById('currentImage').innerHTML = `
                                <div style="margin-top: 10px;">
                                    <p style="font-size: 0.9rem; color: #666; margin-bottom: 5px;">Current Image:</p>
                                    <img src="uploads/${product.image_name}" alt="${product.title}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                                </div>
                            `;
                        }

                        currentEditingProduct = product;
                        loadCategoriesForSelect();
                    }
                });
        }

        function deleteProduct(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                makeRequest('delete_product', {
                        id: id
                    })
                    .then(data => {
                        if (data.success) {
                            showToast(data.message);
                            loadAdminProducts();
                        } else {
                            showToast(data.message, 'error');
                        }
                    });
            }
        }

        function updateOrderStatus(orderId, status) {
            makeRequest('update_order_status', {
                    id: orderId,
                    status: status
                })
                .then(data => {
                    if (data.success) {
                        showToast(data.message);
                    } else {
                        showToast(data.message, 'error');
                    }
                });
        }

        function deleteOrder(id) {
            if (confirm('Are you sure you want to delete this order?')) {
                makeRequest('delete_order', {
                        id: id
                    })
                    .then(data => {
                        if (data.success) {
                            showToast(data.message);
                            loadOrders();
                        } else {
                            showToast(data.message, 'error');
                        }
                    });
            }
        }

        function logout() {
            makeRequest('logout')
                .then(data => {
                    if (data.success) {
                        window.location.href = 'index.php';
                    }
                });
        }

        // Form submissions
        document.getElementById('adminLoginForm')?.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            formData.append('action', 'admin_login');

            fetch('backend.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '?page=admin';
                    } else {
                        showToast(data.message, 'error');
                    }
                })
                .catch(error => {
                    showToast('Login failed', 'error');
                    console.error('Error:', error);
                });
        });

        document.getElementById('customerLoginForm')?.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            formData.append('action', 'customer_login');

            fetch('backend.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message);
                        closeAuthModal();
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        showToast(data.message, 'error');
                    }
                })
                .catch(error => {
                    showToast('Login failed', 'error');
                    console.error('Error:', error);
                });
        });

        document.getElementById('customerRegisterForm')?.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            formData.append('action', 'customer_register');

            fetch('backend.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message);
                        showAuthTab('login');
                    } else {
                        showToast(data.message, 'error');
                    }
                })
                .catch(error => {
                    showToast('Registration failed', 'error');
                    console.error('Error:', error);
                });
        });

        document.getElementById('orderForm')?.addEventListener('submit', function(e) {
            e.preventDefault();

            if (cart.length === 0) {
                showToast('Your cart is empty', 'error');
                return;
            }

            const formData = new FormData(this);
            formData.append('action', 'create_order');
            formData.append('cart_items', JSON.stringify(cart));

            fetch('backend.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message);
                        cart = [];
                        localStorage.setItem('coffeeShopCart', JSON.stringify(cart));
                        updateCartUI();
                        closeOrderModal();
                        this.reset();
                    } else {
                        showToast(data.message, 'error');
                    }
                })
                .catch(error => {
                    showToast('Error placing order', 'error');
                    console.error('Error:', error);
                });
        });

        document.getElementById('categoryFormElement')?.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const action = currentEditingCategory ? 'update_category' : 'add_category';
            formData.append('action', action);

            fetch('backend.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message);
                        hideCategoryForm();
                        loadAdminCategories();
                    } else {
                        showToast(data.message, 'error');
                    }
                })
                .catch(error => {
                    showToast('Error saving category', 'error');
                    console.error('Error:', error);
                });
        });

        document.getElementById('productFormElement')?.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const action = currentEditingProduct ? 'update_product' : 'add_product';
            formData.append('action', action);

            // Calculate discounted price
            const price = parseFloat(formData.get('price')) || 0;
            const discount = parseFloat(formData.get('discount')) || 0;
            const discountedPrice = price - (price * discount / 100);
            formData.append('discounted_price', discountedPrice);

            fetch('backend.php', {
                    method: 'POST',
                    body: formData // Don't set Content-Type header for FormData with files
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message);
                        hideProductForm();
                        loadAdminProducts();
                    } else {
                        showToast(data.message, 'error');
                    }
                })
                .catch(error => {
                    showToast('Error saving product', 'error');
                    console.error('Error:', error);
                });
        });

        // Close modals when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('modal')) {
                e.target.classList.remove('active');
            }
        });
    </script>
</body>

</html>