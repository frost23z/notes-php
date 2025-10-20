<?php

use Core\Session;

// If user is logged in, show notes app
if (!Session::isGuest()) {
    require base_path("Http/controllers/notes/index.php");
    return;
}

// Otherwise show landing page
view("index.view.php");