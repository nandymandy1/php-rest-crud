<?php
extract($_POST);

$username = rtrim($username);
$password = rtrim($password);

try {
    if ($username == '' || $password == '') {
        throw new Exception("Username and Password is required to create authenticate the user.");
    } else {
        include_once('./functions.php');
        authenticate_user(
            $username,
            $password
        );
    }
} catch (Exception $e) {
    echo json_encode(
        array(
            "success" => false,
            "message" => $e->getMessage(),
        )
    );
}
