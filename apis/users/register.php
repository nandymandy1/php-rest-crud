<?php
extract($_POST);

$email = rtrim($email);
$username = rtrim($username);
$password = rtrim($password);

try {
    if ($username == '' || $password == '' || $email == '') {
        throw new Exception(
            "Username, Email and Password is required to create new User."
        );
    } else {
        include_once('./functions.php');
        register_new_user(
            $username,
            $password,
            $email,
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
