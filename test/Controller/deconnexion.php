<?php
session_start();
session_destroy();
//require '../view/home.php';
header('Location: ../view/home.php');
