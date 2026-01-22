<?php
session_start();
session_unset();
session_destroy();

header("Location: login.php"); // redirect to login after session is cleared
exit;
?>