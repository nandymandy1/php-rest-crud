<?php
$id = $_GET['id'];
try {
    if (!$id) {
        throw new Exception(
            "ID of the post is required."
        );
    }
    include_once('./functions.php');
    get_single_poem_by_id($id);
} catch (Exception $e) {
    echo json_encode(
        array(
            'message' => 'ID of the posts is not defined.',
            'success' => false
        )
    );
}
