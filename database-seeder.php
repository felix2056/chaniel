<?php
/**
 * Database Seeder for CHANEL x LEE JUN HO Website
 * Populates the database with all current hardcoded content
 */

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Database Seeder for CHANEL x LEE JUN HO Website</h1>";

// Database configuration
$dbPath = 'database/content.db';

// Check if database exists
if (!file_exists($dbPath)) {
    echo "<p style='color: red;'>❌ Database not found at: $dbPath</p>";
    echo "<p>Please run the test script first to create the database.</p>";
    exit;
}

try {
    // Connect to database
    $db = new PDO("sqlite:$dbPath");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color: green;'>✅ Connected to database successfully</p>";

    // Clear existing content
    $db->exec("DELETE FROM content_blocks");
    echo "<p>🗑️ Cleared existing content</p>";

    // Define all content to seed
    $contentData = [
        // Hero Section
        ['element_id' => 'hero-subtitle', 'content_type' => 'text', 'content' => 'luxury redefined'],
        ['element_id' => 'hero-title', 'content_type' => 'text', 'content' => 'CHANEL X LEE JUN HO'],
        ['element_id' => 'hero-description', 'content_type' => 'text', 'content' => 'Where luxury meets innovation: CHANEL and Lee Jun Ho unite to redefine cultural boundaries, creating an unprecedented fusion of haute couture excellence and contemporary artistic vision that transcends traditional brand collaborations.'],
        ['element_id' => 'hero-btn-primary', 'content_type' => 'text', 'content' => 'Discover More'],
        ['element_id' => 'hero-btn-secondary', 'content_type' => 'text', 'content' => 'Contact Us'],
        ['element_id' => 'hero-video-url', 'content_type' => 'url', 'content' => 'oo74I-aNlUw'],

        // About/Collaboration Section
        ['element_id' => 'about-subtitle', 'content_type' => 'text', 'content' => 'the collaboration'],
        ['element_id' => 'about-title', 'content_type' => 'text', 'content' => 'CHANEL x LEE JUN HO Partnership'],
        ['element_id' => 'about-description', 'content_type' => 'text', 'content' => 'Through this strategic partnership, CHANEL and Lee Jun Ho are launching exclusive collections, immersive digital experiences, and cultural initiatives that bridge the gap between haute couture excellence and contemporary pop culture. Their collaborative vision extends beyond fashion, encompassing art, technology, and social impact, setting new standards for brand collaborations in the luxury sector.'],
        ['element_id' => 'about-btn', 'content_type' => 'text', 'content' => 'explore collection'],

        // Counter Items
        ['element_id' => 'counter-1-value', 'content_type' => 'number', 'content' => '50'],
        ['element_id' => 'counter-1-label', 'content_type' => 'text', 'content' => 'Social Media Reach'],
        ['element_id' => 'counter-2-value', 'content_type' => 'number', 'content' => '25'],
        ['element_id' => 'counter-2-label', 'content_type' => 'text', 'content' => 'Partnership Value'],
        ['element_id' => 'counter-3-value', 'content_type' => 'number', 'content' => '8'],
        ['element_id' => 'counter-3-label', 'content_type' => 'text', 'content' => 'Exclusive Collections'],
        ['element_id' => 'counter-4-value', 'content_type' => 'number', 'content' => '15'],
        ['element_id' => 'counter-4-label', 'content_type' => 'text', 'content' => 'Global Campaigns'],

        // Team Section
        ['element_id' => 'team-subtitle', 'content_type' => 'text', 'content' => 'partnership team'],
        ['element_id' => 'team-title', 'content_type' => 'text', 'content' => 'CHANEL x LEE JUN HO Collaboration'],
        ['element_id' => 'team-btn', 'content_type' => 'text', 'content' => 'explore partnership'],

        // Team Members
        ['element_id' => 'team-member-1-name', 'content_type' => 'text', 'content' => 'Rubi Holloway'],
        ['element_id' => 'team-member-1-role', 'content_type' => 'text', 'content' => 'CHANEL Creative Director'],
        ['element_id' => 'team-member-1-indicator', 'content_type' => 'text', 'content' => 'Partnership Strategy Lead'],
        ['element_id' => 'team-member-2-name', 'content_type' => 'text', 'content' => 'Connie Menn'],
        ['element_id' => 'team-member-2-role', 'content_type' => 'text', 'content' => 'Lee Jun Ho\'s Manager'],
        ['element_id' => 'team-member-2-indicator', 'content_type' => 'text', 'content' => 'Global Brand Ambassador'],
        ['element_id' => 'team-member-3-name', 'content_type' => 'text', 'content' => 'Lena Sofia'],
        ['element_id' => 'team-member-3-role', 'content_type' => 'text', 'content' => 'Partnership Coordinator'],
        ['element_id' => 'team-member-3-indicator', 'content_type' => 'text', 'content' => 'Campaign Development'],
        ['element_id' => 'team-member-4-name', 'content_type' => 'text', 'content' => 'Ella Marie'],
        ['element_id' => 'team-member-4-role', 'content_type' => 'text', 'content' => 'Digital Innovation Lead'],
        ['element_id' => 'team-member-4-indicator', 'content_type' => 'text', 'content' => 'Technology Integration'],

        // Partnership Showcase
        ['element_id' => 'showcase-subtitle', 'content_type' => 'text', 'content' => 'partnership showcase'],
        ['element_id' => 'showcase-title', 'content_type' => 'text', 'content' => 'Witness the fusion of luxury & innovation'],
        ['element_id' => 'showcase-video-url', 'content_type' => 'url', 'content' => 'https://www.youtube.com/watch?v=fVsbt8c4HWo'],

        // Gallery Section
        ['element_id' => 'gallery-subtitle', 'content_type' => 'text', 'content' => 'partnership gallery'],
        ['element_id' => 'gallery-title', 'content_type' => 'text', 'content' => 'A visual symphony of our collaboration'],

        // Testimonials Section
        ['element_id' => 'testimonials-subtitle', 'content_type' => 'text', 'content' => 'industry insights'],
        ['element_id' => 'testimonials-title', 'content_type' => 'text', 'content' => 'Voices from the luxury frontier'],
        ['element_id' => 'testimonial-1-content', 'content_type' => 'text', 'content' => 'The CHANEL x LEE JUN HO promotional collaboration represents a revolutionary breakthrough in luxury brand partnerships. Their innovative approach to merging haute couture with contemporary pop culture has set unprecedented standards for the industry. This strategic alliance has created a cultural phenomenon that transcends traditional celebrity endorsements.'],
        ['element_id' => 'testimonial-1-author', 'content_type' => 'text', 'content' => 'Marco Bizzarri / Luxury Industry Expert'],
        ['element_id' => 'testimonial-2-content', 'content_type' => 'text', 'content' => 'This promotional collaboration transcends traditional boundaries between luxury fashion and global entertainment. The way CHANEL and Lee Jun Ho have integrated cultural innovation with premium branding creates an entirely new ecosystem for strategic partnerships. It\'s a masterclass in modern luxury brand collaboration that redefines industry standards.'],
        ['element_id' => 'testimonial-2-author', 'content_type' => 'text', 'content' => 'Dr. Elena Rodriguez / Cultural Innovation Director'],
        ['element_id' => 'testimonial-3-content', 'content_type' => 'text', 'content' => 'The digital renaissance CHANEL and Lee Jun Ho are spearheading through this promotional collaboration is remarkable. Their approach to blending haute couture with cutting-edge technology while maintaining cultural authenticity and luxury standards is exactly what the industry needs to evolve and thrive in the digital age.'],
        ['element_id' => 'testimonial-3-author', 'content_type' => 'text', 'content' => 'Alexander Kim / Digital Innovation Strategist'],

        // Blog Section
        ['element_id' => 'blog-subtitle', 'content_type' => 'text', 'content' => 'latest insights'],
        ['element_id' => 'blog-title', 'content_type' => 'text', 'content' => 'Stay updated with our latest innovations'],
        ['element_id' => 'blog-post-1-title', 'content_type' => 'text', 'content' => 'Exclusive: CHANEL x LEE JUN HO Debut Collection at Milan Fashion Week'],
        ['element_id' => 'blog-post-1-author', 'content_type' => 'text', 'content' => 'Creative Team'],
        ['element_id' => 'blog-post-1-date', 'content_type' => 'text', 'content' => '2 Feb 2025'],
        ['element_id' => 'blog-post-2-title', 'content_type' => 'text', 'content' => 'Behind the Scenes: CHANEL x LEE JUN HO Partnership Launch'],
        ['element_id' => 'blog-post-2-author', 'content_type' => 'text', 'content' => 'Innovation Team'],
        ['element_id' => 'blog-post-2-date', 'content_type' => 'text', 'content' => '9 Feb 2025'],
        ['element_id' => 'blog-post-3-title', 'content_type' => 'text', 'content' => 'CHANEL x LEE JUN HO: Digital Innovation in Luxury'],
        ['element_id' => 'blog-post-3-author', 'content_type' => 'text', 'content' => 'Tech Team'],
        ['element_id' => 'blog-post-3-date', 'content_type' => 'text', 'content' => '16 Feb 2025'],

        // CTA Section
        ['element_id' => 'cta-title', 'content_type' => 'text', 'content' => 'Experience the CHANEL x LEE JUN HO collaboration'],
        ['element_id' => 'cta-btn', 'content_type' => 'text', 'content' => 'connect with us'],

        // Footer Section
        ['element_id' => 'footer-address', 'content_type' => 'text', 'content' => 'Milan - Via del Babuino, 21, 00187 Roma RM, Italy'],
        ['element_id' => 'footer-email', 'content_type' => 'email', 'content' => 'partnership@chanel.com'],
        ['element_id' => 'footer-phone', 'content_type' => 'phone', 'content' => '+39 012 345 6789'],
        ['element_id' => 'footer-newsletter', 'content_type' => 'text', 'content' => 'Subscribe to our newsletter and be the first to know about exclusive CHANEL x LEE JUN HO collaboration updates, limited edition releases, and behind-the-scenes content.'],
        ['element_id' => 'footer-copyright', 'content_type' => 'text', 'content' => 'Copyright © 2025 CHANEL x LEE JUN HO Partnership. All Rights Reserved.']
    ];

    // Insert content
    $stmt = $db->prepare("INSERT INTO content_blocks (element_id, content_type, content) VALUES (?, ?, ?)");
    
    $insertedCount = 0;
    foreach ($contentData as $data) {
        try {
            $stmt->execute([$data['element_id'], $data['content_type'], $data['content']]);
            $insertedCount++;
            echo "<p style='color: green;'>✅ Inserted: {$data['element_id']}</p>";
        } catch (PDOException $e) {
            echo "<p style='color: red;'>❌ Failed to insert {$data['element_id']}: " . $e->getMessage() . "</p>";
        }
    }

    echo "<h2>Seeding Complete!</h2>";
    echo "<p style='color: green; font-weight: bold;'>✅ Successfully seeded $insertedCount content blocks</p>";
    
    // Verify seeding
    $count = $db->query("SELECT COUNT(*) FROM content_blocks")->fetchColumn();
    echo "<p>📊 Total content blocks in database: $count</p>";

    echo "<h3>Next Steps:</h3>";
    echo "<ol>";
    echo "<li>✅ Database has been seeded with all current content</li>";
    echo "<li>🔄 Now you need to modify the website to load content from database</li>";
    echo "<li>🌐 Visit the website and test the content editor</li>";
    echo "<li>💾 Changes should now persist after page reload</li>";
    echo "</ol>";

} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Database Error: " . $e->getMessage() . "</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ General Error: " . $e->getMessage() . "</p>";
}
?> 