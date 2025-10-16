<?php
require "Database.php";

$config = require "config.php";
$db = new Database($config['db']);

$heading = "Details";

$id = $_GET['id'];

$note = $db->query('SELECT * FROM notes WHERE id = :id', ['id' => $id])->fetchOrFail();

authorize($note['user_id'] === 1);

require "views/notes/details.view.php";