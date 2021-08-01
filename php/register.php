<?php
require_once 'utils.php';
$validationErrors = [];
if (!isset($_POST['firstname']) || strlen($_POST['firstname']) > 100 || !preg_match('/^[a-zA-Z]+$/', $_POST['firstname'])) {
    $validationErrors[] = 1;
}
if (!isset($_POST['lastname']) || strlen($_POST['lastname']) > 100 || !preg_match('/^[a-zA-Z]+$/', $_POST['lastname'])) {
    $validationErrors[] = 2;
}
if (!isset($_POST['email']) || strlen($_POST['email']) > 100 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $validationErrors[] = 3;
} else if (!checkdnsrr(substr($_POST['email'], strpos($_POST['email'], '@') + 1), 'MX')) {
    $validationErrors[] = 4;
}
if (!isset($_POST['password']) || strlen($_POST['password']) > 100 || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/', $_POST['password'])) {
    $validationErrors[] = 5;
} else if (!isset($_POST['confirm-password']) || $_POST['confirm-password'] !== $_POST['password']) {
    $validationErrors[] = 6;
}
if (count($validationErrors) == 0) {
    $con = connection();
    if ($con) {
        $result = SQLSelect($con, 'SELECT ID From users WHERE email=?', 's', $_POST['email']);
        if ($result && $result->num_rows == 0) {
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $id = SQLInsert(
                $con,
                'INSERT INTO users VALUES (null,?,?,?,?,0,null,0)',
                'ssss',
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $hash
            );
            if ($id !== -1) {
                $validationErrors[] = 0;
            } else {
                $validationErrors[] = 7;
            }
        } else {
            $validationErrors[] = 8;
        }
    } else {
        $validationErrors[] = 9;
    }
}
echo json_encode($validationErrors);
