<?php
$id = $_POST['id'];
session_start();
$_SESSION['id'] = $id;
header("Location: ../views/edit.php");