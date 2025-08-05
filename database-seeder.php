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
        ['element_id' => 'hero-btn-primary-link', 'content_type' => 'url', 'content' => '#vision'],
        ['element_id' => 'hero-btn-secondary', 'content_type' => 'text', 'content' => 'Contact Us'],
        ['element_id' => 'hero-btn-secondary-link', 'content_type' => 'url', 'content' => '#contact'],
        ['element_id' => 'hero-video-url', 'content_type' => 'url', 'content' => 'oo74I-aNlUw'],

        // About/Collaboration Section
        ['element_id' => 'about-subtitle', 'content_type' => 'text', 'content' => 'the collaboration'],
        ['element_id' => 'about-title', 'content_type' => 'text', 'content' => 'CHANEL x LEE JUN HO Partnership'],
        ['element_id' => 'about-description', 'content_type' => 'text', 'content' => 'Through this strategic partnership, CHANEL and Lee Jun Ho are launching exclusive collections, immersive digital experiences, and cultural initiatives that bridge the gap between haute couture excellence and contemporary pop culture. Their collaborative vision extends beyond fashion, encompassing art, technology, and social impact, setting new standards for brand collaborations in the luxury sector.'],
        ['element_id' => 'about-btn', 'content_type' => 'text', 'content' => 'explore collection'],
        ['element_id' => 'about-btn-link', 'content_type' => 'url', 'content' => '#gallery'],

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
        ['element_id' => 'team-btn-link', 'content_type' => 'url', 'content' => '#gallery'],

        // Team Members
        ['element_id' => 'team-member-1-name', 'content_type' => 'text', 'content' => 'Rubi Holloway'],
        ['element_id' => 'team-member-1-role', 'content_type' => 'text', 'content' => 'CHANEL Creative Director'],
        ['element_id' => 'team-member-1-indicator', 'content_type' => 'text', 'content' => 'Partnership Strategy Lead'],
        ['element_id' => 'team-member-1-profile', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'team-member-1-instagram', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'team-member-1-facebook', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'team-member-1-linkedin', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'team-member-2-name', 'content_type' => 'text', 'content' => 'Connie Menn'],
        ['element_id' => 'team-member-2-role', 'content_type' => 'text', 'content' => 'Lee Jun Ho\'s Manager'],
        ['element_id' => 'team-member-2-indicator', 'content_type' => 'text', 'content' => 'Global Brand Ambassador'],
        ['element_id' => 'team-member-2-profile', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'team-member-2-instagram', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'team-member-2-facebook', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'team-member-2-linkedin', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'team-member-3-name', 'content_type' => 'text', 'content' => 'Lena Sofia'],
        ['element_id' => 'team-member-3-role', 'content_type' => 'text', 'content' => 'Partnership Coordinator'],
        ['element_id' => 'team-member-3-indicator', 'content_type' => 'text', 'content' => 'Campaign Development'],
        ['element_id' => 'team-member-3-profile', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'team-member-3-instagram', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'team-member-3-facebook', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'team-member-3-linkedin', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'team-member-4-name', 'content_type' => 'text', 'content' => 'Ella Marie'],
        ['element_id' => 'team-member-4-role', 'content_type' => 'text', 'content' => 'Digital Innovation Lead'],
        ['element_id' => 'team-member-4-indicator', 'content_type' => 'text', 'content' => 'Technology Integration'],
        ['element_id' => 'team-member-4-profile', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'team-member-4-instagram', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'team-member-4-facebook', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'team-member-4-linkedin', 'content_type' => 'url', 'content' => '#'],

        // Partnership Showcase
        ['element_id' => 'showcase-subtitle', 'content_type' => 'text', 'content' => 'partnership showcase'],
        ['element_id' => 'showcase-title', 'content_type' => 'text', 'content' => 'Witness the fusion of luxury & innovation'],
        
        // Image Content
        ['element_id' => 'logo-loading', 'content_type' => 'image', 'content' => '{"src":"/images/logo/logo-chanel.png","alt":"CHANEL x LEE JUN HO"}'],
        ['element_id' => 'logo-loading-alt', 'content_type' => 'text', 'content' => 'CHANEL x LEE JUN HO'],
        ['element_id' => 'logo-navbar', 'content_type' => 'image', 'content' => '{"src":"/images/logo/logo-chanel.png","alt":"CHANEL x LEE JUN HO"}'],
        ['element_id' => 'logo-navbar-alt', 'content_type' => 'text', 'content' => 'CHANEL x LEE JUN HO'],
        ['element_id' => 'logo-footer', 'content_type' => 'image', 'content' => '{"src":"/images/logo/logo-chanel.png","alt":"CHANEL x LEE JUN HO"}'],
        ['element_id' => 'logo-footer-alt', 'content_type' => 'text', 'content' => 'CHANEL x LEE JUN HO'],
        
        ['element_id' => 'about-image-src', 'content_type' => 'image', 'content' => '{"src":"/images/media/about.png","alt":"CHANEL x LEE JUN HO Partnership"}'],
        ['element_id' => 'about-image-alt', 'content_type' => 'text', 'content' => 'CHANEL x LEE JUN HO Partnership'],
        
        ['element_id' => 'team-member-1-image', 'content_type' => 'image', 'content' => '{"src":"/images/team/1.png","alt":"Rubi Holloway - Beneficiary Lead"}'],
        ['element_id' => 'team-member-2-image', 'content_type' => 'image', 'content' => '{"src":"/images/team/2.jpg","alt":"Connie Menn - Beneficiary Manager"}'],
        ['element_id' => 'team-member-3-image', 'content_type' => 'image', 'content' => '{"src":"/images/team/3.jpg","alt":"Lena Sofia - Cultural Innovator"}'],
        ['element_id' => 'team-member-4-image', 'content_type' => 'image', 'content' => '{"src":"/images/team/4.jpg","alt":"Ella Marie - Innovation Nexus Lead"}'],
        
        ['element_id' => 'showcase-image-1-src', 'content_type' => 'image', 'content' => '{"src":"images/media/partnership-2.png","alt":""}'],
        ['element_id' => 'showcase-image-1-alt', 'content_type' => 'text', 'content' => ''],
        
        ['element_id' => 'collection-image-1-src', 'content_type' => 'image', 'content' => '{"src":"images/collections/bleu-de-chanel-eau-de-toilette-spray-3-4fl-oz--packshot-default-107460-9564920184862.avif","alt":"CHANEL x LEE JUN HO Exclusive Collection"}'],
        ['element_id' => 'collection-image-1-alt', 'content_type' => 'text', 'content' => 'CHANEL x LEE JUN HO Exclusive Collection'],
        ['element_id' => 'collection-image-2-src', 'content_type' => 'image', 'content' => '{"src":"images/collections/1690923071641-10204538568734jpeg_600x600.webp","alt":"CHANEL x LEE JUN HO Luxury Collection"}'],
        ['element_id' => 'collection-image-2-alt', 'content_type' => 'text', 'content' => 'CHANEL x LEE JUN HO Luxury Collection'],
        ['element_id' => 'collection-image-3-src', 'content_type' => 'image', 'content' => '{"src":"images/collections/1690923149624-10196617134110jpeg_600x600.webp","alt":"CHANEL x LEE JUN HO Premium Collection"}'],
        ['element_id' => 'collection-image-3-alt', 'content_type' => 'text', 'content' => 'CHANEL x LEE JUN HO Premium Collection'],
        ['element_id' => 'collection-image-4-src', 'content_type' => 'image', 'content' => '{"src":"images/collections/1690923306843-10198472359966jpeg_600x600.webp","alt":"CHANEL x LEE JUN HO Signature Collection"}'],
        ['element_id' => 'collection-image-4-alt', 'content_type' => 'text', 'content' => 'CHANEL x LEE JUN HO Signature Collection'],
        ['element_id' => 'collection-image-5-src', 'content_type' => 'image', 'content' => '{"src":"images/collections/bleu-de-chanel-eau-de-toilette-spray-3-4fl-oz--packshot-default-107460-9564920184862.avif","alt":"CHANEL x LEE JUN HO Global Collection"}'],
        ['element_id' => 'collection-image-5-alt', 'content_type' => 'text', 'content' => 'CHANEL x LEE JUN HO Global Collection'],
        ['element_id' => 'collection-image-6-src', 'content_type' => 'image', 'content' => '{"src":"images/collections/1690923071641-10204538568734jpeg_600x600.webp","alt":"CHANEL x LEE JUN HO Innovation Collection"}'],
        ['element_id' => 'collection-image-6-alt', 'content_type' => 'text', 'content' => 'CHANEL x LEE JUN HO Innovation Collection'],
        
        ['element_id' => 'testimonial-author-1-src', 'content_type' => 'image', 'content' => '{"src":"images/author-1.jpg","alt":"Marco Bizzarri"}'],
        ['element_id' => 'testimonial-author-1-alt', 'content_type' => 'text', 'content' => 'Marco Bizzarri'],
        ['element_id' => 'testimonial-author-2-src', 'content_type' => 'image', 'content' => '{"src":"images/author-2.jpg","alt":"Dr. Elena Rodriguez"}'],
        ['element_id' => 'testimonial-author-2-alt', 'content_type' => 'text', 'content' => 'Dr. Elena Rodriguez'],
        ['element_id' => 'testimonial-author-3-src', 'content_type' => 'image', 'content' => '{"src":"images/author-2.jpg","alt":"Alexander Kim"}'],
        ['element_id' => 'testimonial-author-3-alt', 'content_type' => 'text', 'content' => 'Alexander Kim'],
        
        ['element_id' => 'blog-post-1-image-src', 'content_type' => 'image', 'content' => '{"src":"images/post-1.jpg","alt":"CHANEL x LEE JUN HO Fashion Week"}'],
        ['element_id' => 'blog-post-1-image-alt', 'content_type' => 'text', 'content' => 'CHANEL x LEE JUN HO Fashion Week'],
        ['element_id' => 'blog-post-2-image-src', 'content_type' => 'image', 'content' => '{"src":"images/post-2.jpg","alt":"Cultural Innovation Summit"}'],
        ['element_id' => 'blog-post-2-image-alt', 'content_type' => 'text', 'content' => 'Cultural Innovation Summit'],
        ['element_id' => 'blog-post-3-image-src', 'content_type' => 'image', 'content' => '{"src":"images/post-3.jpg","alt":"Digital Renaissance Project"}'],
        ['element_id' => 'blog-post-3-image-alt', 'content_type' => 'text', 'content' => 'Digital Renaissance Project'],
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
        ['element_id' => 'cta-btn-link', 'content_type' => 'url', 'content' => '#contact'],

        // Footer Section
        ['element_id' => 'footer-address', 'content_type' => 'text', 'content' => 'Milan - Via del Babuino, 21, 00187 Roma RM, Italy'],
        ['element_id' => 'footer-email', 'content_type' => 'email', 'content' => 'partnership@chanel.com'],
        ['element_id' => 'footer-phone', 'content_type' => 'phone', 'content' => '+39 012 345 6789'],
        ['element_id' => 'footer-newsletter', 'content_type' => 'text', 'content' => 'Subscribe to our newsletter and be the first to know about exclusive CHANEL x LEE JUN HO collaboration updates, limited edition releases, and behind-the-scenes content.'],
        ['element_id' => 'footer-copyright', 'content_type' => 'text', 'content' => 'Copyright © 2025 CHANEL x LEE JUN HO Partnership. All Rights Reserved.'],
        ['element_id' => 'footer-facebook', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'footer-instagram', 'content_type' => 'url', 'content' => '#'],
        ['element_id' => 'footer-twitter', 'content_type' => 'url', 'content' => '#']
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