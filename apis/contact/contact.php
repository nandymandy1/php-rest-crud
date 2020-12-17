<?php
extract($_POST);
$name = rtrim($name);
$email = rtrim($email);
$message = rtrim($message);
$contact = rtrim($contact);

try {
    if ($name == '' || $email == '' || $message == '' || $contact == '') {
        throw new Exception("Name, Email, Message, and Contact Number is required.");
    }
    include_once("../../config/config.php");
    DB::query(
        "INSERT INTO contacts VALUES(null, :name, :email, :contact, :message)",
        array(
            ':name' => $name,
            ':email' => $email,
            ':contact' => $contact,
            ':message' => $message,
        )
    );

    echo json_encode(
        array(
            "success" => true,
            "message" => "Your message is sent successfully.",
        )
    );
} catch (Exception $e) {
    echo json_encode(
        array(
            "success" => false,
            "message" => $e->getMessage(),
        )
    );
}
