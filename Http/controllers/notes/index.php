<?php

use Core\App;
use Core\Repositories\NoteRepository;
use Core\Session;

$noteRepo = App::resolve(NoteRepository::class);

$notes = $noteRepo->findAll(Session::user()['id']);

view("notes/index.view.php", [
    'heading' => "My Notes",
    'notes' => $notes,
    'currentNoteId' => null
]);