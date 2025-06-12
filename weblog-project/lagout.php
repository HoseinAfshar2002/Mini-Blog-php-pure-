<?php

session_start();

include "database/pdo.php";


session_destroy();


header("location:index.php");


?>
