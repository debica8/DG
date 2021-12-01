<?php
session_start();

session_unset();
session_destroy();

header("Location: navigacija.php?x=1")
?>