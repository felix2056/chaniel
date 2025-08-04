<?php
/**
 * Content Loader for CHANEL x LEE JUN HO Website
 * Loads content from database and provides functions to replace hardcoded content
 */

class ContentLoader {
    private $db;
    private $contentCache = [];
    
    public function __construct() {
        $this->initDatabase();
        $this->loadAllContent();
    }
    
    private function initDatabase() {
        $dbPath = __DIR__ . '/database/content.db';
        
        if (!file_exists($dbPath)) {
            throw new Exception("Database not found. Please run database-seeder.php first.");
        }
        
        try {
            $this->db = new PDO("sqlite:$dbPath");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }
    
    private function loadAllContent() {
        try {
            $stmt = $this->db->query("SELECT element_id, content_type, content FROM content_blocks");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->contentCache[$row['element_id']] = [
                    'content' => $row['content'],
                    'type' => $row['content_type']
                ];
            }
        } catch (PDOException $e) {
            throw new Exception("Failed to load content: " . $e->getMessage());
        }
    }
    
    public function getContent($elementId, $default = '') {
        $content = $this->contentCache[$elementId]['content'] ?? $default;
        $type = $this->getContentType($elementId);
        
        // Handle JSON image data
        if ($type === 'image') {
            $imageData = json_decode($content, true);
            if ($imageData && isset($imageData['src'])) {
                return $imageData['src'];
            }
            return $default;
        }
        
        return $content;
    }
    
    public function getContentType($elementId) {
        return $this->contentCache[$elementId]['type'] ?? 'text';
    }
    
    public function getImageAlt($elementId, $default = '') {
        $content = $this->contentCache[$elementId]['content'] ?? $default;
        $type = $this->getContentType($elementId);
        
        // Handle JSON image data
        if ($type === 'image') {
            $imageData = json_decode($content, true);
            if ($imageData && isset($imageData['alt'])) {
                return $imageData['alt'];
            }
            return $default;
        }
        
        return $default;
    }
    
    public function getAllContent() {
        return $this->contentCache;
    }
    
    public function renderContent($elementId, $default = '') {
        $content = $this->getContent($elementId, $default);
        $type = $this->getContentType($elementId);
        
        // Handle different content types
        switch ($type) {
            case 'url':
                return htmlspecialchars($content);
            case 'email':
                return htmlspecialchars($content);
            case 'phone':
                return htmlspecialchars($content);
            case 'number':
                return htmlspecialchars($content);
            default:
                return htmlspecialchars($content);
        }
    }
    
    public function renderYouTubeVideo($elementId, $defaultVideoId = 'oo74I-aNlUw') {
        $content = $this->getContent($elementId, $defaultVideoId);
        
        // Extract video ID from URL if it's a full URL
        if (strpos($content, 'youtube.com') !== false || strpos($content, 'youtu.be') !== false) {
            $videoId = $this->extractYouTubeId($content);
        } else {
            $videoId = $content; // Assume it's already a video ID
        }
        
        return $videoId;
    }
    
    private function extractYouTubeId($url) {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
        if (preg_match($pattern, $url, $match)) {
            return $match[1];
        }
        return 'oo74I-aNlUw'; // Default fallback
    }
}

// Initialize content loader
try {
    $contentLoader = new ContentLoader();
} catch (Exception $e) {
    // If content loader fails, we'll use default content
    $contentLoader = null;
}

// Helper function to safely get content
function getContent($elementId, $default = '') {
    global $contentLoader;
    if ($contentLoader) {
        return $contentLoader->renderContent($elementId, $default);
    }
    return $default;
}

// Helper function to get YouTube video ID
function getYouTubeVideoId($elementId, $default = 'oo74I-aNlUw') {
    global $contentLoader;
    if ($contentLoader) {
        return $contentLoader->renderYouTubeVideo($elementId, $default);
    }
    return $default;
}

// Helper function to get image alt text
function getImageAlt($elementId, $default = '') {
    global $contentLoader;
    if ($contentLoader) {
        return $contentLoader->getImageAlt($elementId, $default);
    }
    return $default;
}
?> 