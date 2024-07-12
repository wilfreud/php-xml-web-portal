<?php

session_start();
session_destroy();
header('Location: /tp-portail/login.php');
exit;
