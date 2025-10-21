<?php

use Core\App;
use Core\Repositories\NoteRepository;
use Core\Router;
use Http\Forms\NoteForm;

$form = NoteForm::validate($_POST);

$noteRepo = App::resolve(NoteRepository::class);

$id = $_POST['id'];

$note = $noteRepo->findById($id);

authorizeNoteOwner($note);

// Title is optional now, defaults to '' which triggers auto-generation
$noteRepo->update($id, $form->title ?? '', $form->content);

success('Note updated successfully!');
Router::redirect("/notes/show?id={$id}");
