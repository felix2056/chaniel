# 🎨 Content Editor System for CHANEL x LEE JUN HO Website

A lightweight, self-hosted content management system that allows real-time editing of website content through an intuitive modal interface.

## ✨ Features

- **🔧 Admin Mode Toggle**: Click the admin button to enable editing mode
- **📝 Inline Editing**: Hover over editable elements to see edit indicators
- **💾 Database Storage**: All changes are persisted to SQLite database
- **🎯 Modal Interface**: Clean, professional editing experience
- **📱 Responsive Design**: Works on desktop and mobile devices
- **🔒 Simple Authentication**: Basic login system to protect editing functionality

## 🚀 Quick Start

### 1. Prerequisites

- PHP 7.4+ with SQLite support
- Web server (Apache, Nginx, or built-in PHP server)
- Modern web browser

### 2. Setup

1. **Upload files** to your web server
2. **Set permissions** for the database directory:
   ```bash
   chmod 755 database/
   chmod 644 api/content.php
   ```

3. **Start the server** (if using PHP built-in server):
   ```bash
   php -S localhost:8000
   ```

4. **Access the admin panel**:
   - Go to: `http://localhost:8000/admin/login.php`
   - Username: `admin`
   - Password: `chanel2025`

### 3. Using the Editor

1. **Login** to the admin panel
2. **Navigate** to the homepage with `?admin=1` parameter
3. **Click** the "🔧 Admin Mode" button in the top-right corner
4. **Hover** over editable elements to see the edit icon
5. **Click** the edit icon to open the modal editor
6. **Make changes** and save

## 📁 File Structure

```
corporate-promo/
├── index.html                 # Main website with editor integration
├── css/
│   ├── custom.css            # Original website styles
│   └── editor.css            # Content editor styles
├── js/
│   ├── function.js           # Original website scripts
│   └── content-editor.js     # Content editor functionality
├── api/
│   └── content.php           # Backend API for content storage
├── admin/
│   └── login.php             # Admin authentication
├── database/                 # SQLite database (auto-created)
│   └── content.db
└── README-EDITOR.md          # This file
```

## 🎯 Editable Elements

The system includes **60+ editable elements** across all major sections:

### Hero Section
- Subtitle, title, description
- Button texts
- YouTube video URL

### About/Collaboration Section
- Section titles and descriptions
- Counter metrics (numbers and labels)
- Call-to-action buttons

### Team Section
- Team member names, roles, and indicators
- Section titles

### Partnership Showcase
- Section titles
- Video URLs

### Gallery Section
- Section titles

### Testimonials Section
- Testimonial content and author information
- Section titles

### Blog Section
- Blog post titles, authors, and dates
- Section titles

### Footer Section
- Contact information
- Newsletter description
- Copyright text

## 🔧 Configuration

### Changing Admin Credentials

Edit `admin/login.php`:
```php
$admin_username = 'your_username';
$admin_password = 'your_secure_password';
```

### Database Location

The SQLite database is automatically created at `database/content.db`. You can change the location by editing `api/content.php`:
```php
private $dbPath = '../your/custom/path/content.db';
```

### API Endpoint

The JavaScript expects the API at `/api/content.php`. Update `js/content-editor.js` if needed:
```javascript
this.apiEndpoint = '/your/custom/api/path.php';
```

## 🛡️ Security Considerations

### For Production Use

1. **Change default credentials** in `admin/login.php`
2. **Use HTTPS** for all admin access
3. **Implement proper session management**
4. **Add rate limiting** to the API
5. **Validate and sanitize** all input data
6. **Set proper file permissions**

### Recommended Security Enhancements

```php
// In admin/login.php - Add session timeout
$_SESSION['admin_logged_in'] = true;
$_SESSION['admin_login_time'] = time();

// Check session timeout
if (time() - $_SESSION['admin_login_time'] > 3600) {
    session_destroy();
    header('Location: login.php');
    exit();
}
```

## 🐛 Troubleshooting

### Common Issues

1. **"Database connection failed"**
   - Check PHP SQLite extension is enabled
   - Verify database directory permissions

2. **"Admin toggle not appearing"**
   - Ensure you're logged in via `admin/login.php`
   - Check URL contains `?admin=1` parameter

3. **"Changes not saving"**
   - Check browser console for JavaScript errors
   - Verify API endpoint is accessible
   - Check database file permissions

4. **"Modal not opening"**
   - Ensure `editor.css` and `content-editor.js` are loaded
   - Check for JavaScript conflicts

### Debug Mode

Add this to `js/content-editor.js` for debugging:
```javascript
console.log('Content Editor Debug:', {
    isAuthenticated: this.isAuthenticated,
    isAdminMode: this.isAdminMode,
    apiEndpoint: this.apiEndpoint
});
```

## 📊 Database Schema

```sql
CREATE TABLE content_blocks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    element_id VARCHAR(100) UNIQUE NOT NULL,
    content_type VARCHAR(20) NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

## 🔄 API Endpoints

### Save Content
```
POST /api/content.php
Content-Type: application/json

{
    "elementId": "hero-title",
    "contentType": "text",
    "content": "New Title"
}
```

### Get All Content
```
GET /api/content.php?action=getAll
```

## 🎨 Customization

### Adding New Editable Elements

1. **Add to JavaScript** in `js/content-editor.js`:
```javascript
{ selector: '.your-element', type: 'text', id: 'your-element-id' }
```

2. **Add CSS styles** in `css/editor.css` if needed

### Styling the Editor

Modify `css/editor.css` to match your brand:
```css
.editor-modal-content {
    background: your-brand-color;
    border-radius: your-border-radius;
}
```

## 📱 Browser Support

- Chrome 80+
- Firefox 75+
- Safari 13+
- Edge 80+

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🆘 Support

For support or questions:
1. Check the troubleshooting section
2. Review browser console for errors
3. Verify all files are properly uploaded
4. Test with a fresh browser session

---

**Made with ❤️ for the CHANEL x LEE JUN HO partnership** 