Café Ordering System ☕📱

View the video here 
https://drive.google.com/drive/folders/1XphkmlRP7UtiILFEfejR2Oh-MTjaqc-k?usp=sharing

🌟 Overview
A PHP-based café ordering system that allows:

👨‍🍳 Admin panel for menu and order management

📱 Customer interface for browsing menu and placing orders

📊 Order tracking with real-time updates

🔐 Secure authentication for both staff and customers


✨ Key Features
Admin Panel (/admin/)
📝 Menu Management - Add/update/delete food & drink items

📦 Order Management - View and process customer orders

📊 Sales Dashboard - Visualize daily/weekly sales

👥 User Management - Manage staff accounts

Customer Interface
☕ Menu Browsing - View all available items with prices

🛒 Order Placement - Add items to cart and checkout

🔍 Order Tracking - Check order status in real-time


🛠️ Installation
Requirements
PHP 7.4+

MySQL 5.7+

Web server (Apache/Nginx)

Setup
Clone the repository:

bash
git clone https://github.com/yourusername/cafe-ordering-system.git
Import the database:

bash
mysql -u username -p cafe_db < database.sql
Configure the system:
Edit config.php with your database credentials.

Set permissions:

bash
chmod -R 755 uploads/

cafe-system/
├── admin/
│   ├── dashboard.php      # Admin dashboard
│   ├── login_admin.php    # Admin login
│   └── logout.php         # Admin logout
├── assets/
│   ├── css/               # Stylesheets
│   └── images/            # Menu item images
├── config.php             # Database configuration
├── index.php              # Customer landing page
└── includes/              # Shared PHP functions

🔐 Default Login Credentials
Admin
Username: admin

Password: admin123 (Change this immediately after setup!)

Customer
Register via the customer portal

