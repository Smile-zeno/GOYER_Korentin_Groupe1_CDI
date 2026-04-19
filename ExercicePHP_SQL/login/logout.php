<?php

session_start(); // pour récuperer les informations de la session
session_unset();
session_destroy();

header('Location: login.php');
exit;

?>