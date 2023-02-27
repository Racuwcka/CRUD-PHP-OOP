<?php
/**
 * @var $conn
 */
require_once '../config.php';

$stmt = $conn->prepare("INSERT INTO users (name, city_id) VALUES (?,?)");
$stmt->bind_param('si', $name, $city_id);

$name = sanitizeMySQL($conn, $_POST['name']);
$city_id = sanitizeMySQL($conn, $_POST['city_id']);

$stmt->execute();
printf("%d Row inserted.\n", $stmt->affected_rows);
$stmt->close();
$conn->close();

header("Location: ../index.php");
exit();

function sanitizeString($string): string
{
    return htmlentities(strip_tags($string));
}

function sanitizeMySQL($conn, $string): string
{
    $string = $conn->real_escape_string($string);
    return sanitizeString($string);
}