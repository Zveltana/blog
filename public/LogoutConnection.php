<?php

session_start();
session_destroy();
setcookie(
    'LOGGED_USER',
    null,
    -1
);

header('Location: index.php');