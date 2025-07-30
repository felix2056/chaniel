<?php
/**
 * Content Editor API Backend
 * Handles content storage and retrieval for the CHANEL x LEE JUN HO website
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

class ContentAPI {
    private $db;
    private $dbPath = '../database/content.db';

    public function __construct() {
        $this->initDatabase();
    }

    private function initDatabase() {
        // Create database directory if it doesn't exist
        $dbDir = dirname($this->dbPath);
        if (!is_dir($dbDir)) {
            mkdir($dbDir, 0755, true);
        }

        try {
            $this->db = new PDO("sqlite:" . $this->dbPath);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createTables();
        } catch (PDOException $e) {
            $this->sendError('Database connection failed: ' . $e->getMessage());
        }
    }

    private function createTables() {
        $sql = "
        CREATE TABLE IF NOT EXISTS content_blocks (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            element_id VARCHAR(100) UNIQUE NOT NULL,
            content_type VARCHAR(20) NOT NULL,
            content TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
        
        CREATE INDEX IF NOT EXISTS idx_element_id ON content_blocks(element_id);
        ";

        try {
            $this->db->exec($sql);
        } catch (PDOException $e) {
            $this->sendError('Failed to create tables: ' . $e->getMessage());
        }
    }

    public function handleRequest() {
        $method = $_SERVER['REQUEST_METHOD'];
        $action = $_GET['action'] ?? '';

        try {
            switch ($method) {
                case 'GET':
                    if ($action === 'getAll') {
                        $this->getAllContent();
                    } else {
                        $this->sendError('Invalid action for GET request');
                    }
                    break;

                case 'POST':
                    $this->saveContent();
                    break;

                default:
                    $this->sendError('Method not allowed');
            }
        } catch (Exception $e) {
            $this->sendError('Server error: ' . $e->getMessage());
        }
    }

    private function saveContent() {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            $this->sendError('Invalid JSON input');
        }

        $elementId = $input['elementId'] ?? '';
        $contentType = $input['contentType'] ?? '';
        $content = $input['content'] ?? '';

        if (empty($elementId) || empty($contentType) || empty($content)) {
            $this->sendError('Missing required fields: elementId, contentType, content');
        }

        // Validate content type
        $validTypes = ['text', 'url', 'email', 'phone', 'number'];
        if (!in_array($contentType, $validTypes)) {
            $this->sendError('Invalid content type');
        }

        // Sanitize content
        $content = $this->sanitizeContent($content, $contentType);
        
        // Special handling for hero video URL - extract video ID
        if ($elementId === 'hero-video-url' && $contentType === 'url') {
            $videoId = $this->extractYouTubeId($content);
            if ($videoId) {
                $content = $videoId; // Store only the video ID
            }
        }

        try {
            // Check if content already exists
            $stmt = $this->db->prepare("SELECT id FROM content_blocks WHERE element_id = ?");
            $stmt->execute([$elementId]);
            $exists = $stmt->fetch();

            if ($exists) {
                // Update existing content
                $stmt = $this->db->prepare("
                    UPDATE content_blocks 
                    SET content = ?, content_type = ?, updated_at = CURRENT_TIMESTAMP 
                    WHERE element_id = ?
                ");
                $stmt->execute([$content, $contentType, $elementId]);
            } else {
                // Insert new content
                $stmt = $this->db->prepare("
                    INSERT INTO content_blocks (element_id, content_type, content) 
                    VALUES (?, ?, ?)
                ");
                $stmt->execute([$elementId, $contentType, $content]);
            }

            $this->sendSuccess('Content saved successfully', [
                'elementId' => $elementId,
                'content' => $content,
                'contentType' => $contentType
            ]);

        } catch (PDOException $e) {
            $this->sendError('Database error: ' . $e->getMessage());
        }
    }

    private function getAllContent() {
        try {
            $stmt = $this->db->prepare("
                SELECT element_id, content_type, content, updated_at 
                FROM content_blocks 
                ORDER BY updated_at DESC
            ");
            $stmt->execute();
            $content = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->sendSuccess('Content retrieved successfully', [
                'content' => $content,
                'count' => count($content)
            ]);

        } catch (PDOException $e) {
            $this->sendError('Database error: ' . $e->getMessage());
        }
    }

    private function sanitizeContent($content, $type) {
        $content = trim($content);
        
        switch ($type) {
            case 'email':
                if (!filter_var($content, FILTER_VALIDATE_EMAIL)) {
                    $this->sendError('Invalid email format');
                }
                break;

            case 'url':
                if (!filter_var($content, FILTER_VALIDATE_URL) && !empty($content)) {
                    // Enhanced YouTube URL validation
                    $youtubePatterns = [
                        '/^(https?:\/\/)?(www\.)?youtube\.com\/watch\?v=[a-zA-Z0-9_-]{11}/', // youtube.com/watch?v=VIDEO_ID
                        '/^(https?:\/\/)?(www\.)?youtu\.be\/[a-zA-Z0-9_-]{11}/', // youtu.be/VIDEO_ID
                        '/^(https?:\/\/)?(www\.)?youtube\.com\/embed\/[a-zA-Z0-9_-]{11}/', // youtube.com/embed/VIDEO_ID
                        '/^[a-zA-Z0-9_-]{11}$/' // Just video ID (11 characters)
                    ];
                    
                    $isValidYouTube = false;
                    foreach ($youtubePatterns as $pattern) {
                        if (preg_match($pattern, $content)) {
                            $isValidYouTube = true;
                            break;
                        }
                    }
                    
                    if (!$isValidYouTube) {
                        $this->sendError('Invalid YouTube URL format. Please enter a valid YouTube URL or video ID.');
                    }
                }
                break;

            case 'number':
                if (!is_numeric($content)) {
                    $this->sendError('Invalid number format');
                }
                break;

            case 'phone':
                // Basic phone validation - allow various formats
                if (!preg_match('/^[\+]?[0-9\s\-\(\)]+$/', $content)) {
                    $this->sendError('Invalid phone number format');
                }
                break;
        }

        // General sanitization
        $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
        
        return $content;
    }
    
    private function extractYouTubeId($url) {
        $regExp = '/^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/';
        $match = preg_match($regExp, $url, $matches);
        return ($match && strlen($matches[2]) === 11) ? $matches[2] : null;
    }

    private function sendSuccess($message, $data = []) {
        echo json_encode([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
        exit();
    }

    private function sendError($message, $code = 400) {
        http_response_code($code);
        echo json_encode([
            'success' => false,
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
        exit();
    }
}

// Initialize and handle the request
$api = new ContentAPI();
$api->handleRequest();
?> 