<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';

// Set content type to JSON
header('Content-Type: application/json');

// Check if action is provided
if (!isset($_POST['action'])) {
    echo json_encode(['success' => false, 'message' => 'No action specified']);
    exit;
}

$action = $_POST['action'];

try {
    switch ($action) {
        case 'admin_login':
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $stmt = $pdo->prepare("SELECT * FROM tbl_admin WHERE username = ? AND password = ?");
            $stmt->execute([$username, $password]);
            $admin = $stmt->fetch();
            
            if ($admin) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_name'] = $admin['full_name'];
                echo json_encode(['success' => true, 'message' => 'Login successful']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
            }
            break;

        case 'customer_login':
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $stmt = $pdo->prepare("SELECT * FROM tbl_customers WHERE email = ? AND password = ? AND status = 'Active'");
            $stmt->execute([$email, $password]);
            $customer = $stmt->fetch();
            
            if ($customer) {
                $_SESSION['customer_logged_in'] = true;
                $_SESSION['customer_id'] = $customer['id'];
                $_SESSION['customer_name'] = $customer['full_name'];
                echo json_encode(['success' => true, 'message' => 'Login successful']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
            }
            break;

        case 'customer_register':
            $full_name = $_POST['full_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $password = $_POST['password'] ?? '';
            
            // Check if email already exists
            $stmt = $pdo->prepare("SELECT id FROM tbl_customers WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                echo json_encode(['success' => false, 'message' => 'Email already registered']);
                break;
            }
            
            $stmt = $pdo->prepare("INSERT INTO tbl_customers (full_name, email, phone, password, status, created_at) VALUES (?, ?, ?, ?, 'Active', NOW())");
            if ($stmt->execute([$full_name, $email, $phone, $password])) {
                echo json_encode(['success' => true, 'message' => 'Registration successful! Please login.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Registration failed']);
            }
            break;

        case 'logout':
            session_destroy();
            echo json_encode(['success' => true]);
            break;

        case 'get_categories':
            $conditions = [];
            $params = [];
            
            if (isset($_POST['active'])) {
                $conditions[] = "active = ?";
                $params[] = $_POST['active'];
            }
            
            $sql = "SELECT * FROM tbl_menu_category";
            if (!empty($conditions)) {
                $sql .= " WHERE " . implode(" AND ", $conditions);
            }
            $sql .= " ORDER BY id DESC";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $categories = $stmt->fetchAll();
            
            echo json_encode($categories);
            break;

        case 'get_products':
            $conditions = [];
            $params = [];
            
            if (isset($_POST['active'])) {
                $conditions[] = "p.active = ?";
                $params[] = $_POST['active'];
            }
            
            if (isset($_POST['featured'])) {
                $conditions[] = "p.featured = ?";
                $params[] = $_POST['featured'];
            }
            
            if (isset($_POST['category_id']) && $_POST['category_id'] !== '') {
                $conditions[] = "p.category_id = ?";
                $params[] = $_POST['category_id'];
            }
            
            $sql = "SELECT p.*, c.title as category_name, 
                    CASE 
                        WHEN p.discount > 0 THEN p.price - (p.price * p.discount / 100)
                        ELSE p.price 
                    END as discounted_price
                    FROM tbl_products p 
                    LEFT JOIN tbl_menu_category c ON p.category_id = c.id";
            
            if (!empty($conditions)) {
                $sql .= " WHERE " . implode(" AND ", $conditions);
            }
            $sql .= " ORDER BY p.id DESC";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $products = $stmt->fetchAll();
            
            echo json_encode($products);
            break;

        case 'get_orders':
            $sql = "SELECT o.*, p.title as product_name 
                    FROM tbl_orders o 
                    LEFT JOIN tbl_products p ON o.product_id = p.id 
                    ORDER BY o.id DESC";
            $stmt = $pdo->query($sql);
            echo json_encode($stmt->fetchAll());
            break;

        case 'get_customers':
            $stmt = $pdo->query("SELECT * FROM tbl_customers ORDER BY id DESC");
            echo json_encode($stmt->fetchAll());
            break;

        case 'get_dashboard_stats':
            $stats = [];
            
            // Categories count
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM tbl_menu_category WHERE active = 'Yes'");
            $stats['categories'] = $stmt->fetch()['count'];
            
            // Products count
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM tbl_products WHERE active = 'Yes'");
            $stats['products'] = $stmt->fetch()['count'];
            
            // Total orders count
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM tbl_orders");
            $stats['orders'] = $stmt->fetch()['count'];
            
            // Today's orders count
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM tbl_orders WHERE DATE(order_date) = CURDATE()");
            $stats['today_orders'] = $stmt->fetch()['count'];
            
            // Active customers count
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM tbl_customers WHERE status = 'Active'");
            $stats['customers'] = $stmt->fetch()['count'];
            
            // FIXED: Total revenue calculation
            $stmt = $pdo->query("SELECT COALESCE(SUM(total), 0) as revenue FROM tbl_orders WHERE status IN ('Completed', 'Ready')");
            $stats['revenue'] = $stmt->fetch()['revenue'];
            
            echo json_encode($stats);
            break;

        case 'get_recent_orders':
            $sql = "SELECT o.*, p.title as product_name 
                    FROM tbl_orders o 
                    LEFT JOIN tbl_products p ON o.product_id = p.id 
                    ORDER BY o.order_date DESC 
                    LIMIT 10";
            $stmt = $pdo->query($sql);
            $orders = $stmt->fetchAll();
            echo json_encode($orders);
            break;

        case 'add_category':
            $title = $_POST['title'] ?? '';
            $featured = $_POST['featured'] ?? 'No';
            $active = $_POST['active'] ?? 'Yes';
            
            $stmt = $pdo->prepare("INSERT INTO tbl_menu_category (title, featured, active) VALUES (?, ?, ?)");
            if ($stmt->execute([$title, $featured, $active])) {
                echo json_encode(['success' => true, 'message' => 'Category added successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add category']);
            }
            break;

        case 'update_category':
            $id = $_POST['id'] ?? '';
            $title = $_POST['title'] ?? '';
            $featured = $_POST['featured'] ?? 'No';
            $active = $_POST['active'] ?? 'Yes';
            
            $stmt = $pdo->prepare("UPDATE tbl_menu_category SET title = ?, featured = ?, active = ? WHERE id = ?");
            if ($stmt->execute([$title, $featured, $active, $id])) {
                echo json_encode(['success' => true, 'message' => 'Category updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update category']);
            }
            break;

        case 'delete_category':
            $id = $_POST['id'] ?? '';
            
            $stmt = $pdo->prepare("DELETE FROM tbl_menu_category WHERE id = ?");
            if ($stmt->execute([$id])) {
                echo json_encode(['success' => true, 'message' => 'Category deleted successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete category']);
            }
            break;

        case 'add_product':
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $discount = $_POST['discount'] ?? 0;
            $category_id = $_POST['category_id'] ?? '';
            $featured = $_POST['featured'] ?? 'No';
            $active = $_POST['active'] ?? 'Yes';
            
            // Handle image upload
            $image_name = '';
            if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
                $image_name = handleImageUpload($_FILES['product_image']);
                if (!$image_name) {
                    echo json_encode(['success' => false, 'message' => 'Failed to upload image']);
                    break;
                }
            }
            
            $stmt = $pdo->prepare("INSERT INTO tbl_products (title, description, price, discount, category_id, image_name, featured, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$title, $description, $price, $discount, $category_id, $image_name, $featured, $active])) {
                echo json_encode(['success' => true, 'message' => 'Product added successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add product']);
            }
            break;

        case 'update_product':
            $id = $_POST['id'] ?? '';
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $discount = $_POST['discount'] ?? 0;
            $category_id = $_POST['category_id'] ?? '';
            $featured = $_POST['featured'] ?? 'No';
            $active = $_POST['active'] ?? 'Yes';
            
            // Get current product data
            $stmt = $pdo->prepare("SELECT image_name FROM tbl_products WHERE id = ?");
            $stmt->execute([$id]);
            $current_product = $stmt->fetch();
            
            $image_name = $current_product['image_name'];
            
            // Handle image upload
            if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
                $new_image = handleImageUpload($_FILES['product_image']);
                if ($new_image) {
                    // Delete old image
                    if ($image_name && file_exists("uploads/$image_name")) {
                        unlink("uploads/$image_name");
                    }
                    $image_name = $new_image;
                }
            }
            
            $stmt = $pdo->prepare("UPDATE tbl_products SET title = ?, description = ?, price = ?, discount = ?, category_id = ?, image_name = ?, featured = ?, active = ? WHERE id = ?");
            if ($stmt->execute([$title, $description, $price, $discount, $category_id, $image_name, $featured, $active, $id])) {
                echo json_encode(['success' => true, 'message' => 'Product updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update product']);
            }
            break;

        case 'delete_product':
            $id = $_POST['id'] ?? '';
            
            // Get product data to delete image
            $stmt = $pdo->prepare("SELECT image_name FROM tbl_products WHERE id = ?");
            $stmt->execute([$id]);
            $product = $stmt->fetch();
            
            $stmt = $pdo->prepare("DELETE FROM tbl_products WHERE id = ?");
            if ($stmt->execute([$id])) {
                // Delete image file
                if ($product && $product['image_name'] && file_exists("uploads/{$product['image_name']}")) {
                    unlink("uploads/{$product['image_name']}");
                }
                echo json_encode(['success' => true, 'message' => 'Product deleted successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete product']);
            }
            break;

        case 'create_order':
            $customer_name = $_POST['customer_name'] ?? '';
            $customer_contact = $_POST['customer_contact'] ?? '';
            $customer_email = $_POST['customer_email'] ?? '';
            $customer_address = $_POST['customer_address'] ?? '';
            $table_number = $_POST['table_number'] ?? '';
            $payment_method = $_POST['payment_method'] ?? 'Cash';
            $notes = $_POST['notes'] ?? '';
            $cart_items = json_decode($_POST['cart_items'] ?? '[]', true);
            
            if (empty($cart_items)) {
                echo json_encode(['success' => false, 'message' => 'Cart is empty']);
                break;
            }
            
            try {
                $pdo->beginTransaction();
                
                foreach ($cart_items as $item) {
                    $total = $item['price'] * $item['quantity'];
                    
                    $stmt = $pdo->prepare("INSERT INTO tbl_orders (product_id, customer_name, customer_contact, customer_email, customer_address, table_number, payment_method, qty, price, total, status, notes, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Ordered', ?, NOW())");
                    $stmt->execute([
                        $item['id'],
                        $customer_name,
                        $customer_contact,
                        $customer_email,
                        $customer_address,
                        $table_number,
                        $payment_method,
                        $item['quantity'],
                        $item['price'],
                        $total,
                        $notes
                    ]);
                }
                
                $pdo->commit();
                echo json_encode(['success' => true, 'message' => 'Order placed successfully!']);
            } catch (Exception $e) {
                $pdo->rollBack();
                echo json_encode(['success' => false, 'message' => 'Failed to place order']);
            }
            break;

        case 'update_order_status':
            $id = $_POST['id'] ?? '';
            $status = $_POST['status'] ?? '';
            
            $stmt = $pdo->prepare("UPDATE tbl_orders SET status = ? WHERE id = ?");
            if ($stmt->execute([$status, $id])) {
                echo json_encode(['success' => true, 'message' => 'Order status updated']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update status']);
            }
            break;

        case 'delete_order':
            $id = $_POST['id'] ?? '';
            
            $stmt = $pdo->prepare("DELETE FROM tbl_orders WHERE id = ?");
            if ($stmt->execute([$id])) {
                echo json_encode(['success' => true, 'message' => 'Order deleted successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete order']);
            }
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
}

function handleImageUpload($file) {
    $upload_dir = 'uploads/';
    
    // Create uploads directory if it doesn't exist
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $max_size = 5 * 1024 * 1024; // 5MB
    
    if (!in_array($file['type'], $allowed_types)) {
        return false;
    }
    
    if ($file['size'] > $max_size) {
        return false;
    }
    
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;
    $filepath = $upload_dir . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return $filename;
    }
    
    return false;
}
?>
