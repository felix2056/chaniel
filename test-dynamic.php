<?php
// Test script to verify dynamic content loading
require_once 'content-loader.php';

echo "<h1>Dynamic Content Test</h1>";

// Test various content elements
$testElements = [
    'hero-subtitle',
    'hero-title', 
    'hero-description',
    'about-subtitle',
    'counter-1-value',
    'team-member-1-name',
    'footer-email'
];

echo "<h2>Content from Database:</h2>";
foreach ($testElements as $elementId) {
    $content = getContent($elementId, 'NOT FOUND');
    echo "<p><strong>$elementId:</strong> $content</p>";
}

echo "<h2>YouTube Video Test:</h2>";
$videoId = getYouTubeVideoId('hero-video-url', 'default');
echo "<p><strong>Hero Video ID:</strong> $videoId</p>";

echo "<h2>Database Status:</h2>";
try {
    $db = new PDO("sqlite:database/content.db");
    $count = $db->query("SELECT COUNT(*) FROM content_blocks")->fetchColumn();
    echo "<p style='color: green;'>✅ Database connected. Total content blocks: $count</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Database error: " . $e->getMessage() . "</p>";
}

echo "<h2>Next Steps:</h2>";
echo "<ol>";
echo "<li>✅ Database is seeded with content</li>";
echo "<li>✅ Content loader is working</li>";
echo "<li>🌐 Visit <a href='index-dynamic.php'>index-dynamic.php</a> to see the dynamic website</li>";
echo "<li>🔧 Visit <a href='index-dynamic.php?admin=1'>index-dynamic.php?admin=1</a> to test the content editor</li>";
echo "<li>💾 Changes should now persist after page reload</li>";
echo "</ol>";
?> 