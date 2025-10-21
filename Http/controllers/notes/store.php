<?php

use Core\App;
use Core\Repositories\NoteRepository;
use Core\Router;
use Core\Session;
use Http\Forms\NoteForm;

$form = NoteForm::validate($_POST);

$noteRepo = App::resolve(NoteRepository::class);

// Title is optional now, defaults to '' which triggers auto-generation
$noteRepo->create($form->title ?? '', $form->content, Session::user()['id']);

success('Note created successfully!');
Router::redirect('/notes');
