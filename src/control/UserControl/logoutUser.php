<?php

session_start();
session_unset();
session_destroy();

header("Location: ../../views/page/home.php");

exit;