<?php
require "Database.php";

$config = require "config.php";
$db = new Database($config['db']);

$heading = "My Notes";

$notes = $db->query('SELECT * FROM notes where user_id = :user_id', ['user_id' => 1])->fetchAll();

require "views/notes/index.view.php";