<?php

session_start();
session_destroy();

header("Location: ../html-pages/login-register.php");

exit;