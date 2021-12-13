<?php
    require "/var/www/html/php/constants.php";

    if ($_COOKIE["graphic_access_key"] !== $access_key) {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        exit;
    }

    session_start();
