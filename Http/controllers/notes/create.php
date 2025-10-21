<?php

use Core\App;
use Core\Repositories\NoteRepository;
use Core\Session;

$noteRepo = App::resolve(NoteRepository::class);

$notes = $noteRepo->findAll(Session::user()['id']);

view("notes/create.view.php", [
    'heading' => "Create Note",
    'errors' => [],
    'notes' => $notes,
    'currentNoteId' => null
]);