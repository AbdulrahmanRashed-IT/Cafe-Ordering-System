# Coffee Shop Management System

A complete PHP-based coffee shop management system built without frameworks, using only PHP, MySQL, HTML, CSS, and JavaScript. Works perfectly with XAMPP.

## 🚀 Features

### 👥 Customer Features
- **Browse Menu**: View products by categories with filtering
- **Shopping Cart**: Add items, modify quantities, persistent storage
- **Place Orders**: Complete order form with customer details
- **Responsive Design**: Works on all devices
- **Location Information**: Multiple branch locations

### 🔧 Admin Features
- **Dashboard**: Overview statistics and recent orders
- **Category Management**: Add, edit, delete categories
- **Product Management**: Full CRUD operations for products
- **Order Management**: View orders, update status, delete orders
- **Secure Authentication**: Admin login system

## 📋 Requirements

- **XAMPP** (Apache + MySQL + PHP)
- **PHP 7.4+**
- **MySQL 5.7+**
- **Modern Web Browser**

## 🛠️ Installation

### 1. Download and Setup XAMPP
1. Download XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. Install XAMPP
3. Start **Apache** and **MySQL** services

### 2. Setup Project Files
1. Copy all project files to `C:\xampp\htdocs\coffee-shop\` (Windows) or `/opt/lampp/htdocs/coffee-shop/` (Linux)
2. Your folder structure should look like:
   \`\`\`
   htdocs/coffee-shop/
   ├── index.php
   ├── config.php
   ├── backend.php
   ├── database.sql
   └── README.md
   \`\`\`

### 3. Create Database
1. Open your browser and go to [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Click "Import" tab
3. Choose the `database.sql` file
4. Click "Go" to import

**OR** create manually:
1. Create a new database named `coffee_shop`
2. Copy and paste the SQL from `database.sql` file
3. Execute the SQL commands

### 4. Configure Database Connection
1. Open `config.php`
2. Update database credentials if needed:
   \`\`\`php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'coffee_shop');
   \`\`\`

### 5. Access the Application
- **Customer Site**: [http://localhost/coffee-shop/](http://localhost/coffee-shop/)
- **Admin Login**: [http://localhost/coffee-shop/?page=login](http://localhost/coffee-shop/?page=login)

## 🔐 Default Admin Credentials

- **Username**: `admin`
- **Password**: `admin123`

## 📱 How to Use

### Customer Interface
1. **Browse Products**: View featured products or filter by category
2. **Add to Cart**: Click "Add to Cart" on any product
3. **View Cart**: Click the cart button in header
4. **Place Order**: Fill out the order form with your details
5. **Track Order**: Orders are sent to admin for processing

### Admin Interface
1. **Login**: Use admin credentials to access admin panel
2. **Dashboard**: View statistics and recent orders
3. **Manage Categories**: 
   - Add new categories
   - Edit existing categories
   - Delete categories
   - Set featured status
4. **Manage Products**:
   - Add new products with pricing and discounts
   - Edit product details
   - Delete products
   - Set featured status
5. **Manage Orders**:
   - View all customer orders
   - Update order status (Ordered → On Delivery → Delivered)
   - Delete orders if needed

## 🗂️ Database Structure

### Tables
- **tbl_admin**: Admin user accounts
- **tbl_menu_category**: Product categories
- **tbl_products**: Coffee shop products
- **tbl_orders**: Customer orders

### Sample Data Included
- 1 Admin user
- 5 Categories (Hot Coffee, Cold Coffee, Tea, Pastries, Sandwiches)
- 8 Sample products
- 3 Sample orders

## 🎨 Customization

### Styling
- All CSS is included in `index.php`
- Coffee shop color scheme (amber/orange tones)
- Fully responsive design
- Font Awesome icons

### Adding Features
- Modify `backend.php` for new API endpoints
- Update `index.php` for new UI components
- Extend database schema in `database.sql`

## 🔧 Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Make sure MySQL is running in XAMPP
   - Check database credentials in `config.php`
   - Ensure database `coffee_shop` exists

2. **Page Not Found**
   - Make sure files are in correct XAMPP directory
   - Check Apache is running
   - Verify URL: `http://localhost/coffee-shop/`

3. **Admin Login Not Working**
   - Check if database was imported correctly
   - Verify admin user exists in `tbl_admin` table
   - Use default credentials: admin/admin123

4. **Products Not Loading**
   - Check browser console for JavaScript errors
   - Verify database has sample data
   - Check `backend.php` for PHP errors

### File Permissions
- Ensure XAMPP has read/write permissions to project folder
- On Linux: `chmod -R 755 /opt/lampp/htdocs/coffee-shop/`

## 📊 Features Overview

| Feature | Customer | Admin |
|---------|----------|-------|
| Browse Products | ✅ | ✅ |
| Shopping Cart | ✅ | ❌ |
| Place Orders | ✅ | ❌ |
| Manage Categories | ❌ | ✅ |
| Manage Products | ❌ | ✅ |
| Manage Orders | ❌ | ✅ |
| Dashboard Stats | ❌ | ✅ |
| User Authentication | ❌ | ✅ |

## 🔒 Security Features

- **SQL Injection Protection**: PDO prepared statements
- **Input Sanitization**: All user inputs are sanitized
- **Session Management**: Secure admin sessions
- **Password Hashing**: MD5 hashing (can be upgraded to bcrypt)
- **CSRF Protection**: Form-based protection

## 🚀 Future Enhancements

- Image upload for products and categories
- Customer registration and login
- Order history for customers
- Email notifications
- Payment gateway integration
- Inventory management
- Sales reports and analytics
- Multi-language support

## 📞 Support

If you encounter any issues:

1. Check the troubleshooting section above
2. Verify XAMPP services are running
3. Check browser console for errors
4. Ensure database is properly imported

## 📄 License

This project is open source and available under the MIT License.

---

**Made with ❤️ and ☕ for coffee lovers everywhere!**

Enjoy your coffee shop management system! ☕
