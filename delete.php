<?php

include 'db.php';
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = $conn->prepare('delete from student where id=?');
    $sql->bind_param('i',$id);
    if($sql->execute()){
        header('Location:dashboard.php');
    }
}

?>