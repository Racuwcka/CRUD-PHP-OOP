<?php
/**
 * @var $conn
 */
require_once '../config.php';
$id = $_POST['id'];
$query = "DELETE FROM users WHERE id='$id'";
$result = $conn->query($query);
if (!$result) die('Error');
header("Location: ../index.php");