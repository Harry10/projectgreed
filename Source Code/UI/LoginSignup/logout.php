<?php
session_start();
session_unset();
session_destroy();
header("Location: http://pluto.hood.edu/~htun/projectgreed/index.php");
?>
