<?php
/**
 * Test Script for Content Editor System
 * Verifies database connectivity and API functionality
 */

echo "<h1>🧪 Content Editor System Test</h1>";

// Test 1: Check PHP SQLite extension
echo "<h2>1. PHP SQLite Extension</h2>";
if (extension_loaded('pdo_sqlite')) {
    echo "✅ PDO SQLite extension is loaded<br>";
} else {
    echo "❌ PDO SQLite extension is NOT loaded<br>";
    echo "Please install it: <code>sudo apt-get install php-sqlite3</code><br>";
}

// Test 2: Check database directory
echo "<h2>2. Database Directory</h2>";
$dbDir = 'database';
if (!is_dir($dbDir)) {
    if (mkdir($dbDir, 0755, true)) {
        echo "✅ Created database directory: $dbDir<br>";
    } else {
        echo "❌ Failed to create database directory: $dbDir<br>";
    }
} else {
    echo "✅ Database directory exists: $dbDir<br>";
}

// Test 3: Test database connection
echo "<h2>3. Database Connection</h2>";
try {
    $db = new PDO("sqlite:database/content.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Database connection successful<br>";
    
    // Test table creation
    $sql = "CREATE TABLE IF NOT EXISTS test_table (id INTEGER PRIMARY KEY)";
    $db->exec($sql);
    echo "✅ Table creation test successful<br>";
    
    // Clean up test table
    $db->exec("DROP TABLE test_table");
    echo "✅ Database cleanup successful<br>";
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
}

// Test 4: Check API file
echo "<h2>4. API File</h2>";
$apiFile = 'api/content.php';
if (file_exists($apiFile)) {
    echo "✅ API file exists: $apiFile<br>";
} else {
    echo "❌ API file missing: $apiFile<br>";
}

// Test 5: Check admin login file
echo "<h2>5. Admin Login File</h2>";
$loginFile = 'admin/login.php';
if (file_exists($loginFile)) {
    echo "✅ Admin login file exists: $loginFile<br>";
} else {
    echo "❌ Admin login file missing: $loginFile<br>";
}

// Test 6: Check CSS and JS files
echo "<h2>6. Frontend Files</h2>";
$files = [
    'css/editor.css',
    'js/content-editor.js'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        echo "✅ File exists: $file<br>";
    } else {
        echo "❌ File missing: $file<br>";
    }
}

// Test 7: Test API endpoint
echo "<h2>7. API Endpoint Test</h2>";
$apiUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/api/content.php?action=getAll';

$context = stream_context_create([
    'http' => [
        'method' => 'GET',
        'timeout' => 5
    ]
]);

$response = @file_get_contents($apiUrl, false, $context);
if ($response !== false) {
    $data = json_decode($response, true);
    if ($data && isset($data['success'])) {
        echo "✅ API endpoint is working<br>";
        echo "Response: " . htmlspecialchars($response) . "<br>";
    } else {
        echo "⚠️ API endpoint responded but with unexpected format<br>";
        echo "Response: " . htmlspecialchars($response) . "<br>";
    }
} else {
    echo "❌ API endpoint test failed<br>";
    echo "URL: $apiUrl<br>";
}

// Test 8: Check file permissions
echo "<h2>8. File Permissions</h2>";
$permissions = [
    'database' => '755',
    'api/content.php' => '644',
    'admin/login.php' => '644'
];

foreach ($permissions as $file => $expected) {
    if (file_exists($file)) {
        $perms = substr(sprintf('%o', fileperms($file)), -3);
        if ($perms === $expected) {
            echo "✅ Permissions correct for $file: $perms<br>";
        } else {
            echo "⚠️ Permissions for $file: $perms (expected: $expected)<br>";
        }
    }
}

echo "<h2>🎯 Next Steps</h2>";
echo "<p>If all tests pass, you can:</p>";
echo "<ol>";
echo "<li>Go to <a href='admin/login.php'>Admin Login</a></li>";
echo "<li>Login with username: <code>admin</code> and password: <code>chanel2025</code></li>";
echo "<li>Navigate to the homepage with <code>?admin=1</code> parameter</li>";
echo "<li>Click the '🔧 Admin Mode' button to start editing</li>";
echo "</ol>";

echo "<h2>🔧 Manual Test</h2>";
echo "<p>Test the API manually:</p>";
echo "<pre>";
echo "curl -X POST http://localhost/api/content.php \\\n";
echo "  -H 'Content-Type: application/json' \\\n";
echo "  -d '{\"elementId\":\"test-element\",\"contentType\":\"text\",\"content\":\"Test content\"}'";
echo "</pre>";

echo "<style>";
echo "body { font-family: Arial, sans-serif; margin: 20px; }";
echo "h1 { color: #D4AF37; }";
echo "h2 { color: #1A1A1A; margin-top: 30px; }";
echo "code { background: #f5f5f5; padding: 2px 4px; border-radius: 3px; }";
echo "pre { background: #f5f5f5; padding: 15px; border-radius: 5px; overflow-x: auto; }";
echo "</style>";
?> 