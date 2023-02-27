<?php
/**
 * @var $conn
 */
require_once './config.php';

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    $login_temp = sanitizeMySQL($conn, $_SERVER['PHP_AUTH_USER']);
    $pw_temp = sanitizeMySQL($conn, $_SERVER['PHP_AUTH_PW']);
    $query = "SELECT name, password FROM users WHERE name='$login_temp'";
    $result = $conn->query($query);

    if (!$result) die('User not found.');
    elseif ($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $result->close();

        if (password_verify($pw_temp, $row['password'])) {
            session_start();
            $_SESSION['name'] = $row['name'];

            echo "Welcome User: " . $login_temp . " Password: " . $pw_temp;
        } else die('Неверная комбинация логин пароль');
    } else die('Неверная комбинация логин пароль');
} else {
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    die("Please enter your username and password");
}

function sanitizeString($string): string
{
    return htmlentities(strip_tags($string));
}

function sanitizeMySQL($conn, $string): string
{
    $string = $conn->real_escape_string($string);
    return sanitizeString($string);
}