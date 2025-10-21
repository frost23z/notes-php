<?php

use Core\App;
use Core\Repositories\NoteRepository;
use Core\Session;

// Set JSON response header
header('Content-Type: application/json');

try {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['title'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Title is required']);
        exit;
    }

    $title = trim($input['title']);

    if (empty($title)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Title cannot be empty']);
        exit;
    }

    if (strlen($title) > 255) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Title must be less than 255 characters']);
        exit;
    }

    // Get note ID from URL (we'll extract from path)
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    preg_match('/\/notes\/(\d+)\/title/', $path, $matches);

    if (!isset($matches[1])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid note ID']);
        exit;
    }

    $id = (int)$matches[1];

    $noteRepo = App::resolve(NoteRepository::class);

    // Verify note exists and belongs to user
    $note = $noteRepo->findById($id);

    if (!$noteRepo->belongsToUser($note, Session::user()['id'])) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        exit;
    }

    // Update title
    $noteRepo->updateTitle($id, $title);

    echo json_encode([
        'success' => true,
        'message' => 'Title updated successfully',
        'title' => $title
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred: ' . $e->getMessage()
    ]);
}
