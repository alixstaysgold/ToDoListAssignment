<?php
require('database.php');

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);


if ($id) {
    $query = 'DELETE FROM todoitems
                WHERE ItemNum = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $success = $statement->execute();
    $statement->closeCursor();
    header("location:index.php");

}

$deleted = true;

include('index.php');
?>