<?php

use Core\App;
use Core\Repositories\NoteRepository;
use Core\Router;

$noteRepo = App::resolve(NoteRepository::class);

$note = $noteRepo->findById($_GET['id']);

authorizeNoteOwner($note);

$noteRepo->delete($note['id']);

success('Note deleted successfully!');
Router::redirect('/notes');