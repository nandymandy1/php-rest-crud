<?php
include_once('../../config/config.php');

function register_new_user($username,  $password, $email)
{
    try {
        if (check_if_username_is_registred($username)) {
            throw new Exception("Username is already taken.");
        }

        if (check_if_email_is_registred($email)) {
            throw new Exception("Email is already registred.");
        }

        DB::query(
            "INSERT INTO users VALUES(null, :username, :email, :password)",
            array(
                ':email' => $email,
                ':username' => $username,
                ':password' => md5($password)
            )
        );

        echo json_encode(
            array(
                "success" => true,
                "message" => "User Registration successful"
            )
        );
    } catch (Exception $e) {
        echo json_encode(
            array(
                "message" => $e->getMessage(),
                "success" => false
            )
        );
    }
}

function authenticate_user($username, $password)
{
    if (!check_if_username_is_registred($username)) {
        echo json_encode(array(
            "message" => "Username not found.",
            "success" => false
        ));
    } else {
        $data = DB::query(
            "SELECT * FROM users WHERE username=:username",
            array(':username' => $username)
        );
        $user = $data[0];

        if ($user['password'] == md5($password)) {
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['auth'] = true;

            echo json_encode(array(
                'message' => 'You are now logged in.',
                'success' => true
            ));
        } else {
            echo json_encode(array(
                'message' => 'Invalid Password.',
                'success' => false
            ));
        }
    }
}

function check_if_username_is_registred($username)
{
    try {
        $data = DB::query("SELECT * FROM users WHERE username=:username", array(':username' => $username));
        $user = $data[0];
        if ($user) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "There is some problem in connection: " . $e->getMessage();
    }
}

function check_if_email_is_registred($email)
{
    try {
        $data = DB::query(
            "SELECT * FROM users WHERE email=:email",
            array(':email' => $email)
        );

        $user = $data[0];

        if ($user) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "There is some problem in connection: " . $e->getMessage();
    }
}
