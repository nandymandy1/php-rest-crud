<?php
session_start();

try {
    if (!$_SESSION['user_id']) {
        throw new Exception(
            'Unauthenticated Request.'
        );
    }
    include_once('./functions.php');
    get_my_poems($_SESSION['user_id']);
} catch (Exception $e) {
    echo json_encode(
        array(
            "stauts" => false,
            "message" => $e->getMessage(),
        )
    );
}
