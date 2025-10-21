<?php

use Core\App;
use Core\Repositories\NoteRepository;
use Core\Session;

// Set JSON response header
header('Content-Type: application/json');

try {
    // Get note ID from URL
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    preg_match('/\/notes\/(\d+)/', $path, $matches);

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

    // Delete note
    $noteRepo->delete($id);

    echo json_encode([
        'success' => true,
        'message' => 'Note deleted successfully'
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred: ' . $e->getMessage()
    ]);
}
