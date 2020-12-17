<?php
include_once('../../config/config.php');

function create_new_poem($title, $poem)
{
    DB::query(
        "INSERT INTO poems VALUES(null, :title, :content, :author)",
        array(
            ':title' => $title,
            ':content' => $poem,
            ':author' => $_SESSION['user_id']
        )
    );

    echo json_encode(
        array(
            "success" => true,
            "message" => "Poem added successfully.",
        )
    );
}

function get_poems()
{
    $data = DB::query("SELECT * FROM poems");
    echo json_encode($data);
}

function get_my_poems($user_id)
{
    $data = DB::query(
        "SELECT * FROM poems WHERE  author=:author",
        array(
            ':author' => $user_id
        )
    );

    echo json_encode(
        array(
            "poems" => $data
        )
    );
}

function get_single_poem_by_id($id)
{
    $data = DB::query(
        "SELECT * FROM poems WHERE id=:id",
        array(
            ':id' => $id
        )
    );

    echo json_encode($data[0]);
}

function update_single_poem_by_id($id, $title, $poem)
{
    DB::query(
        "UPDATE poems SET title=:title, content=:poem WHERE id = :id",
        array(
            ':id' => $id,
            ':poem' => $poem,
            ':title' => $title,
        )
    );

    $data = DB::query(
        "SELECT * FROM poems WHERE id=:id",
        array(
            ':id' => $id
        )
    );

    echo json_encode(
        array(
            'poem' => $data[0],
            'success' => true,
            'message' => 'Poem Updated successfully.',
        )
    );
}

function delete_single_poem_by_id($id)
{
    DB::query(
        "DELETE FROM poems WHERE id=:id",
        array(
            ':id' => $id
        )
    );

    echo json_encode(
        array(
            'success' => true,
            'message' => 'Poem Deleted successfully',
        )
    );
}

function poem_belongs_to_authenticated_user($id, $user_id)
{
    $data = DB::query(
        "SELECT * FROM poems WHERE id=:id AND author=:author",
        array(
            ':id' => $id,
            'author' => $user_id
        )
    );

    if (count($data) > 0) {
        return true;
    }
    return false;
}
