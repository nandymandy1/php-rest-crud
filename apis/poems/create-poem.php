<?php
session_start();

try {
    if (!$_SESSION['auth']) {
        throw new Exception(
            "Unauthenticated"
        );
    } else {
        extract($_POST);
        $title = rtrim($title);
        $poem = rtrim($poem);
        if ($title == '' || $poem == '') {
            throw new Exception(
                "Poem Title and Poem is required."
            );
        } else {
            include_once('./functions.php');
            create_new_poem(
                $title,
                $poem
            );
        }
    }
} catch (Exception $e) {
    echo json_encode(
        array(
            "success" => false,
            "message" => $e->getMessage()
        )
    );
}
