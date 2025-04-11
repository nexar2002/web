<?php
session_start();
echo isset($_SESSION['ci']) ? $_SESSION['ci'] : "Invitado";
?>
