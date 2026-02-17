<?php

// Include the random string file
require_once 'rand.php';

// Begin a new session
if (!isset($_SESSION)
    && !headers_sent()
) {
    session_start();
}

// Set the session contents
$_SESSION['captcha_id'] = $str;

?>