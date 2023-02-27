<?php
/**
 * @var $conn
 */
require_once '../config.php';

$query = "UPDATE users SET ";

if (isset($_POST['name']) || isset($_POST['city_id'])) {
    if (isset($_POST['name'])) {
        $name = sanitizeMySQL($conn, $_POST['name']);
        $query .= "name = '$name', ";
    }
    if (isset($_POST['city_id'])) {
        $city_id = sanitizeMySQL($conn, $_POST['city_id']);
        $query .= "city_id = '$city_id' ";
    }
    $id = sanitizeMySQL($conn, $_POST['id']);
    $query .= "WHERE id='$id'";
    $result = $conn->query($query);
    if (!$result) die($query);
}
else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

$conn->close();

header("Location: ../index.php");
exit();

function sanitizeString($string)
{
    return htmlentities(strip_tags($string));
}

function sanitizeMySQL($conn, $string)
{
    $string = $conn->real_escape_string($string);
    return sanitizeString($string);
}