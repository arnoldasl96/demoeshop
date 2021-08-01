<?php
require_once 'config.php';

function connection()
{
    $con = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    if ($con->connection_error) {
        return false;
    }
    return $con;
}

function SQLSelect($connection,$query,$format =false,...$variables)
{
    $stmt = $connection->prepare($query);
    if($format){
        $stmt->bind_param($format,...$variables);
    }
    if($stmt->execute()){
        $result= $stmt->get_result();
        $stmt ->close();
        return $result;
    }
    $stmt->close();
    return false;

}
function SQLInsert($connection,$query,$format = false,...$variables)
{
    $stmt = $connection->prepare($query);
    if($format){
        $stmt->bind_param($format,...$variables);
    }
    if($stmt->execute()){
        $id= $stmt->insert_id;
        $stmt ->close();
        return $id;
    }
    $stmt->close();
    return -1;

}
function sqlUpdate($C, $query, $format = false, ...$vars) {
    $stmt = $C->prepare($query);
    if($format) {
        $stmt->bind_param($format, ...$vars);
    }
    if($stmt->execute()) {
        $stmt->close();
        return true;
    }
    $stmt->close();
    return false;
}