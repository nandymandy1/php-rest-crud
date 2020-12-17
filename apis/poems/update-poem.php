<?php
session_start();

try {
    if (!$_GET['id']) {
        throw new Exception(
            'ID is required to delete the poem.'
        );
    }

    if (!$_SESSION['user_id']) {
        throw new Exception(
            'Unauthenticated Request.'
        );
    }

    include_once('./functions.php');

    $id = $_GET['id'];
    $user_id = $_SERVER['user_id'];

    if (poem_belongs_to_authenticated_user(
        $id,
        $user_id
    )) {
        throw new Exception(
            'Unauthorized Request.'
        );
    }

    extract($_POST);

    $title = rtrim($title);
    $poem = rtrim($poem);
    if ($title == '' || $poem == '') {
        throw new Exception(
            "Poem Title and Poem is required."
        );
    } else {
        update_single_poem_by_id(
            $id,
            $title,
            $poem,
        );
    }
} catch (Exception $e) {
    echo json_encode(
        array(
            "stauts" => false,
            "message" => $e->getMessage(),
        )
    );
}
