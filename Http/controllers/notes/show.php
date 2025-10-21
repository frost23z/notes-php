<?php

use Core\App;
use Core\Repositories\NoteRepository;
use Core\Session;

$noteRepo = App::resolve(NoteRepository::class);

$note = $noteRepo->findById($_GET['id']);

authorizeNoteOwner($note);

$notes = $noteRepo->findAll(Session::user()['id']);

view("notes/show.view.php", [
    'heading' => "Note Details",
    'note' => $note,
    'notes' => $notes,
    'currentNoteId' => $note['id']
]);